<?php

namespace App\Models;

use CodeIgniter\Model;

class SavingModel extends Model
{
	protected $table                = 'savings';
	protected $useTimestamps        = true;
	protected $allowedFields        = [
		'nominal',
		'target_id',
		'description'
	];

	public function getTotalSaving()
	{
		$result = \Config\Database::connect()
			->table('savings')
			->selectSum('nominal')
			->get();
		return $result->getRow();
	}
}
