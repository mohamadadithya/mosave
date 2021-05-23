<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingModel extends Model
{
	protected $table                = 'settings';
	protected $useTimestamps        = false;
	protected $allowedFields        = [
		'web_title',
		'theme',
		'history_in_target'
	];
}
