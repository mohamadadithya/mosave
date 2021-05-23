<?php

namespace App\Controllers;

use App\Models\AuthModel;
use App\Models\HistoryModel;
use App\Models\SavingModel;
use App\Models\SettingModel;
use App\Models\TargetModel;

class Pages extends BaseController
{
	public function index()
	{
		session();
		$dateNow = date('Y-m-d');
		// Call the required models
		$targetModel = new TargetModel();
		$savingModel = new SavingModel();
		$historyModel = new HistoryModel();
		$settingModel = new SettingModel();
		$settings = $settingModel->first();
		return view('/pages/index', [
			'title' => 'MoSave',
			'targets' => $targetModel->target(),
			'totalSaving' => $savingModel->getTotalSaving(),
			'totalToday' => $historyModel->getTotalToday($dateNow),
			'settings' => $settings,
			'histories' => $historyModel->findAll()
		]);
	}

	public function welcome()
	{
		$authModel = new AuthModel();
		$user = $authModel->first();
		if (session()->has('isLoggedIn') || $user) {
			return redirect()->to('/');
		}
		return view('/pages/welcome', [
			'title' => 'Welcome to MoSave',
		]);
	}
}
