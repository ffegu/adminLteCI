<?php namespace App\Models;

use CodeIgniter\Model;
use Myth\Auth\Authorization\GroupModel;
use Myth\Auth\Entities\User;

class UserModel extends Model
{

    const ORDERABLE = [
        1 => 'username',
        2 => 'email',
        4 => 'created_at',
    ];

    protected $table = 'users';
    protected $primaryKey = 'id';

    protected $returnType = User::class;
    protected $useSoftDeletes = true;

    protected $allowedFields = [
         'email', 'first_name', 'last_name', 'student_code', 'school_id', 'father_name', 'father_mobile',
         'phone', 'username', 'password_hash', 'reset_hash', 'reset_at', 'reset_expires', 'activate_hash',
         'status', 'status_message', 'active', 'force_pass_reset', 'permissions', 'deleted_at',
    ];

    protected $useTimestamps = true;

    protected $validationRules = [
        'email'         => 'required|valid_email|is_unique[users.email,id,{id}]',
        'first_name'    => 'required',
        'username'      => 'required|alpha_numeric_punct|min_length[3]|is_unique[users.username,id,{id}]',
        'password_hash' => 'required',
    ];
    protected $validationMessages = [];
    protected $skipValidation = false;

    protected $afterInsert = ['addToGroup'];

    /**
     * The id of a group to assign.
     * Set internally by withGroup.
     * @var int
     */
    protected $assignGroup;

    /**
     * Logs a password reset attempt for posterity sake.
     *
     * @param string      $email
     * @param string|null $token
     * @param string|null $ipAddress
     * @param string|null $userAgent
     */
    public function logResetAttempt(string $email, string $token = null, string $ipAddress = null, string $userAgent = null)
    {
        $this->db->table('auth_reset_attempts')->insert([
            'email' => $email,
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
            'token' => $token,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Logs an activation attempt for posterity sake.
     *
     * @param string|null $token
     * @param string|null $ipAddress
     * @param string|null $userAgent
     */
    public function logActivationAttempt(string $token = null, string $ipAddress = null, string $userAgent = null)
    {
        $this->db->table('auth_activation_attempts')->insert([
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
            'token' => $token,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Sets the group to assign any users created.
     *
     * @param string $groupName
     *
     * @return $this
     */
    public function withGroup(string $groupName)
    {
        $group = $this->db->table('auth_groups')->where('name', $groupName)->get()->getFirstRow();

        $this->assignGroup = $group->id;

        return $this;
    }

    /**
     * Clears the group to assign to newly created users.
     *
     * @return $this
     */
    public function clearGroup()
    {
        $this->assignGroup = null;

        return $this;
    }

    /**
     * If a default role is assigned in Config\Auth, will
     * add this user to that group. Will do nothing
     * if the group cannot be found.
     *
     * @param $data
     *
     * @return mixed
     */
    protected function addToGroup($data)
    {
        if (is_numeric($this->assignGroup))
        {
            $groupModel = model(GroupModel::class);
            $groupModel->addUserToGroup($data['id'], $this->assignGroup);
        }

        return $data;
    }

    /**
    * as we have limited roles so we can defined them attributes
    * but to make it dynamic we can pass the role name as param
     */
    public function principals(){
       $results = $this->join("auth_groups_users", "users.id = auth_groups_users.user_id")
                        ->join("auth_groups", "auth_groups.id = auth_groups_users.group_id")
                        ->where("name", 'principal')
                        ->select('users.id, first_name, last_name')
                        ->asArray()
                        ->findAll();
       return $results;
    }

    /**
     * Get resource data.
     *
     * @param string $search
     *
     * @return \CodeIgniter\Database\BaseBuilder
     */
    public function getResource(string $search = '')
    {
        $builder = $this->builder()
            ->select('id, username, first_name, last_name, phone, email, active, created_at');

        $condition = empty($search)
            ? $builder
            : $builder->groupStart()
                ->like('username', $search)
                ->orLike('email', $search)
            ->groupEnd();

        return $condition->where('deleted_at', null);
    }

    /**
     * Get principal data.
     *
     * @param string $search
     *
     * @return \CodeIgniter\Database\BaseBuilder
     */
    public function getPrincipals(string $search = '')
    {
        $builder = $this->builder()
                    ->select('users.id, first_name, last_name, student_code, father_name, father_mobile,
                     active, users.created_at')
                     ->join('schools', "users.school_id = schools.id")
                     ->select('name');

        $condition = empty($search)
            ? $builder
            : $builder->groupStart()
                ->like('first_name', $search)
                ->orLike('last_name', $search)
            ->groupEnd();

        return $condition->where('users.deleted_at', null);
    }



}
