<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Histories extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'          => [
				'type'           => 'BIGINT',
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'nominal' => [
				'type' => 'VARCHAR',
				'constraint' => '255'
			],
			'description'       => [
				'type'       => 'VARCHAR',
				'constraint' => '255',
			],
			'target_id' => [
				'type' => 'BIGINT'
			],
			'time' => [
				'type' => 'TIMESTAMP'
			],
			'created_at' => [
				'type' => 'DATE'
			],
			'updated_at' => [
				'type' => 'DATE'
			]
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('histories');
	}

	public function down()
	{
		//
	}
}
