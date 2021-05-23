<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\HistoryModel;
use App\Models\SettingModel;
use App\Models\TargetModel;

class History extends BaseController
{
	protected $historyModel, $targetModel;

	public function __construct()
	{
		$this->historyModel = new HistoryModel();
		$this->targetModel = new TargetModel();
	}

	public function index()
	{
		$histories = $this->historyModel->orderBy('time', 'DESC')->paginate(4, 'histories');
		if (!$histories) {
			return redirect()->to('/');
		}
		$settingModel = new SettingModel();

		return view('/pages/history', [
			'title' => 'History',
			'histories' => $histories,
			'pager' => $this->historyModel->pager,
			'settings' => $settingModel->first()
		]);
	}
}
