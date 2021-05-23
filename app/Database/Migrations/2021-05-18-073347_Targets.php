<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Targets extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'          => [
				'type'           => 'BIGINT',
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'target_name'       => [
				'type'       => 'VARCHAR',
				'constraint' => '255',
			],
			'nominal' => [
				'type' => 'VARCHAR',
				'constraint' => '255'
			],
			'duration' => [
				'type' => 'INT',
				'constraint' => '3'
			],
			'priority' => [
				'type' => 'VARCHAR',
				'constraint' => '255'
			],
			'description' => [
				'type' => 'TEXT',
				'null' => true
			],
			'slug' => [
				'type' => 'VARCHAR',
				'constraint' => '255'
			],
			'created_at' => [
				'type' => 'TIMESTAMP'
			],
			'updated_at' => [
				'type' => 'TIMESTAMP'
			]
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('targets');
	}

	public function down()
	{
		//
	}
}
