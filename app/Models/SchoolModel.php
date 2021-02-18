<?php

namespace App\Models;

use CodeIgniter\Model;

class SchoolModel extends Model
{

	const ORDERABLE = [
			1 => 'id',
			2 => 'name',
			3 => 'created_at',
			4 => 'created_at',
			5 => 'created_at',
			6 => 'created_at',
	];

	protected $DBGroup              = 'default';
	protected $table                = 'schools';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = true;
	protected $allowedFields        = [ 'name', 'user_id', 'logo', 'theme_color'];

	// Dates
	protected $useTimestamps        = true;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [
		"name" => 'required|string|is_unique[schools.name]',
		"user_id" => 'required|string|is_unique[schools.user_id]',
		// 'logo' => 'required|string', //as we're adding logo as file, validation will be done by CI fileupload
		'theme_color' => 'required|string',
	];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	// Callbacks
	protected $allowCallbacks       = true;
	protected $beforeInsert         = [];
	protected $afterInsert          = [];
	protected $beforeUpdate         = [];
	protected $afterUpdate          = [];
	protected $beforeFind           = [];
	protected $afterFind            = [];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];


	public function getResource(string $search = ''){
		$builder = $this->builder()
                		->select('schools.id, schools.name, logo, theme_color, schools.created_at')
			             	->join("users", "users.id = schools.user_id")
			  						->select('users.first_name, users.last_name, users.phone, users.email');
		 $condition = empty($search)
            ? $builder
            : $builder->groupStart()
                ->like('name', $search)
                ->orLike('schools.created_at', $search)
            ->groupEnd();

      $condition->where('schools.deleted_at', null);

		 return $condition;
	}

	public function schools($active=1)
	{
	   $result = $this->select("id, name")
			     // ->where("active", $active) //need to add the column
					 ->asArray()
					 ->findAll();

			return $result;
	}


}
