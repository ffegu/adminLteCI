<?php

namespace App\Database\Seeds;

use CodeIgniter\Config\Services;
use CodeIgniter\Database\Seeder;
use App\Entities\User;
use App\Models\UserModel;

/**
 * Class BoilerplateSeeder.
 */
class BoilerplateSeeder extends Seeder
{
    /**
     * @var Authorize
     */
    protected $authorize;

    /**
     * @var Db
     */
    protected $db;

    /**
     * @var Users
     */
    protected $users;

    public function __construct()
    {
        $this->authorize = Services::authorization();
        $this->db = \Config\Database::connect();
        $this->users = new UserModel();
    }

    public function run()
    {
        // User
        $this->users->save(new User([
            'email'    => 'admin@admin.com',
            'first_name' => 'Joan',
            'last_name' => 'Admin',
            'phone' => '+911234567890',
            'username' => 'admin',
            'password' => 'admin',
            'active'   => '1',
        ]));

        $this->users->save(new User([
            'email'    => 'principal@principal.com',
            'first_name' => 'Joan',
            'first_name' => 'Principal',
            'phone' => '+911234567890',
            'username' => 'principal',
            'password' => 'principal',
            'active'   => '1',
        ]));

        $this->users->save(new User([
            'email'    => 'student@student.com',
            'first_name' => 'Joan',
            'first_name' => 'Student',
            'phone' => '+911234567890',
            'username' => 'student',
            'password' => 'student',
            'active'   => '1',
        ]));

        // Role
        $this->authorize->createGroup('admin', 'Administrators. The top of the food chain.');
        $this->authorize->createGroup('student', 'Member everyday student.');
        $this->authorize->createGroup('principal', 'Principals for managing students and schools.');

        // Permission
        $this->authorize->createPermission('back-office', 'User can access to the administration panel.');
        $this->authorize->createPermission('manage-user', 'User can create, delete or modify the users.');
        $this->authorize->createPermission('role-permission', 'User can edit and define permissions for a role.');
        $this->authorize->createPermission('menu-permission', 'User can create, delete or modify the menu.');
        //school
        $this->authorize->createPermission('view-school', 'the principal can view his school');
        $this->authorize->createPermission('edit-school', 'the principal can edit his school.');
        $this->authorize->createPermission('delete-school', 'admin can delete school.');
        $this->authorize->createPermission('add-school', 'admin can add school.');
        //student
        $this->authorize->createPermission('view-student', 'the principal can view his student');
        $this->authorize->createPermission('edit-student', 'the principal can edit his student.');
        $this->authorize->createPermission('delete-student', 'principal can delete student.');
        $this->authorize->createPermission('add-student', 'principal can add student.');

        // Assign Permission to role
        $this->authorize->addPermissionToGroup('back-office', 'admin');
        $this->authorize->addPermissionToGroup('manage-user', 'admin');
        $this->authorize->addPermissionToGroup('role-permission', 'admin');
        $this->authorize->addPermissionToGroup('menu-permission', 'admin');
        $this->authorize->addPermissionToGroup('back-office', 'principal');
        $this->authorize->addPermissionToGroup('back-office', 'student');
        //school
        $this->authorize->addPermissionToGroup('view-school', 'principal');
        $this->authorize->addPermissionToGroup('edit-school', 'principal');
        $this->authorize->addPermissionToGroup('add-school', 'admin');
        $this->authorize->addPermissionToGroup('delete-school', 'admin');
        //student
        $this->authorize->addPermissionToGroup('view-student', 'principal');
        $this->authorize->addPermissionToGroup('edit-student', 'principal');
        $this->authorize->addPermissionToGroup('add-student', 'principal');
        $this->authorize->addPermissionToGroup('delete-student', 'principal');

        // Assign Role to user
        $this->authorize->addUserToGroup(1, 'admin');
        $this->authorize->addUserToGroup(1, 'student');
        $this->authorize->addUserToGroup(1, 'principal');
        $this->authorize->addUserToGroup(2, 'principal');

        $this->db->table('menu')->insertBatch([
            [
                'parent_id'  => '0',
                'title'      => 'Dashboard',
                'icon'       => 'fas fa-tachometer-alt',
                'route'      => 'dashboard',
                'sequence'   => '1',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'parent_id'  => '0',
                'title'      => 'User Management',
                'icon'       => 'fas fa-user',
                'route'      => '#',
                'sequence'   => '2',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'parent_id'  => '2',
                'title'      => 'User Profile',
                'icon'       => 'fas fa-user-edit',
                'route'      => 'admin/user/profile',
                'sequence'   => '3',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'parent_id'  => '2',
                'title'      => 'Users',
                'icon'       => 'fas fa-users',
                'route'      => 'admin/user/manage',
                'sequence'   => '4',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'parent_id'  => '2',
                'title'      => 'Permissions',
                'icon'       => 'fas fa-user-lock',
                'route'      => 'admin/permission',
                'sequence'   => '5',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'parent_id'  => '2',
                'title'      => 'Roles',
                'icon'       => 'fas fa-users-cog',
                'route'      => 'admin/role',
                'sequence'   => '6',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'parent_id'  => '2',
                'title'      => 'Menu',
                'icon'       => 'fas fa-stream',
                'route'      => 'admin/menu',
                'sequence'   => '7',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'parent_id'  => '0',
                'title'      => 'Manage Schools',
                'icon'       => 'fas fa-school',
                'route'      => 'manage/school',
                'sequence'   => '8',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

            [
                'parent_id'  => '0',
                'title'      => 'Manage Students',
                'icon'       => 'fas fa-user-graduate',
                'route'      => 'manage/student',
                'sequence'   => '9',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],

        ]);

        $this->db->table('groups_menu')->insertBatch([
            [
                'group_id' => 1,
                'menu_id'  => 1,
            ],
            [
                'group_id' => 1,
                'menu_id'  => 2,
            ],
            [
                'group_id' => 1,
                'menu_id'  => 3,
            ],
            [
                'group_id' => 1,
                'menu_id'  => 4,
            ],
            [
                'group_id' => 1,
                'menu_id'  => 5,
            ],
            [
                'group_id' => 1,
                'menu_id'  => 6,
            ],
            [
                'group_id' => 1,
                'menu_id'  => 7,
            ],
            [
                'group_id' => 2,
                'menu_id'  => 1,
            ],
            [
                'group_id' => 2,
                'menu_id'  => 2,
            ],
            [
                'group_id' => 2,
                'menu_id'  => 3,
            ],
            [
                'group_id' => 3,
                'menu_id'  => 8,
            ],
            [
                'group_id' => 3,
                'menu_id'  => 9,
            ],
        ]);
    }

    public function down()
    {
        //
    }
}
