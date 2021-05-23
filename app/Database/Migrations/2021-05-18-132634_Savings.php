<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Savings extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'          => [
				'type'           => 'BIGINT',
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'nominal'       => [
				'type'       => 'VARCHAR',
				'constraint' => '255',
			],
			'target_id' => [
				'type' => 'BIGINT',
			],
			'description' => [
				'type' => 'TEXT',
				'null' => true
			],
			'created_at' => [
				'type' => 'TIMESTAMP'
			],
			'updated_at' => [
				'type' => 'TIMESTAMP'
			]
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('savings');
	}

	public function down()
	{
		//
	}
}
