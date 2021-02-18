<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class School extends Migration
{
	public function up()
	{
		 $this->forge->addField([
		   	 'id'        => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
				 'user_id'   => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
				 'name'      => ['type' => 'varchar', 'constraint' => 255],
				 'logo'      => ['type' => 'varchar', 'constraint' => 255],
				 'theme_color'  => ['type' => 'varchar', 'constraint' => 255, 'default' => "00000"],
				 'created_at'       => ['type' => 'datetime', 'null' => true],
				 'updated_at'       => ['type' => 'datetime', 'null' => true],
				 'deleted_at'       => ['type' => 'datetime', 'null' => true],
		 ]);
		 $this->forge->addKey('id', true);
		 $this->forge->addUniqueKey('user_id');
		 $this->forge->addUniqueKey('name');
		 $this->forge->addForeignKey('user_id', 'users', 'id', false, 'CASCADE');
		 $this->forge->createTable('schools');
	}

	public function down()
	{
		 $this->forge->dropTable('schools');
	}
}
