<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Settings extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'unsigned' => true,
				'auto_increment' => true
			],
			'web_title' => [
				'type' => 'VARCHAR',
				'constraint' => '255'
			],
			'history_in_target' => [
				'type' => 'INT'
			]
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('settings');
	}

	public function down()
	{
		// 
	}
}
