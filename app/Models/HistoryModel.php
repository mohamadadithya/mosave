<?php

namespace App\Models;

use CodeIgniter\Model;

class HistoryModel extends Model
{
	protected $table                = 'histories';
	protected $useTimestamps        = true;
	protected $allowedFields        = [
		'nominal',
		'description',
		'target_id',
		'time'
	];

	public function getTotalToday($dateNow)
	{
		$result = \Config\Database::connect()
			->table('histories')
			->selectSum('nominal')
			->where('created_at', $dateNow)
			->get();
		return $result->getRow();
	}
}
