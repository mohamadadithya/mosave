<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'unsigned' => true,
				'auto_increment' => true
			],
			'username' => [
				'type' => 'VARCHAR',
				'constraint' => '60'
			],
			'password' => [
				'type' => 'VARCHAR',
				'constraint' => '255'
			],
			'photo' => [
				'type' => 'VARCHAR',
				'constraint' => '255'
			]
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('user');
	}

	public function down()
	{
		//
	}
}
