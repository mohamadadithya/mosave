<?php

namespace App\Models;

use CodeIgniter\Model;

class TargetModel extends Model
{
	protected $table                = 'targets';
	protected $useTimestamps        = true;
	protected $allowedFields        = [
		'target_name',
		'nominal',
		'duration',
		'priority',
		'description',
		'slug'
	];

	public function target($slug = null)
	{
		$db = \Config\Database::connect();
		$builder = $db->table('targets');
		if ($slug) {
			$builder->select('targets.id as target_id, targets.nominal as target_nominal, savings.nominal as saving_nominal, duration, target_name, targets.description as target_description')
				->join('savings', 'savings.target_id = targets.id');
			$query = $builder->where('slug', $slug)->get();
			return $query->getRowArray();
		} else {
			$builder->select('targets.id as target_id, targets.nominal as target_nominal, savings.nominal as saving_nominal, duration, target_name, targets.description as target_description, slug, targets.created_at as target_createdAt')
				->join('savings', 'savings.target_id = targets.id');
			$query = $builder->orderBy('target_createdAt', 'DESC')->get();
			return $query->getResultArray();
		}
	}
}
