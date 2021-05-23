<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\HistoryModel;
use App\Models\SavingModel;
use App\Models\SettingModel;
use App\Models\TargetModel;

class Saving extends BaseController
{
	protected $targetModel, $savingModel, $historyModel;
	public function __construct()
	{
		$this->targetModel = new TargetModel();
		$this->savingModel = new SavingModel();
		$this->historyModel = new HistoryModel();
	}

	public function index()
	{
		session();
		// Get the target_id from the url for the options that match the target on the Save Money page
		$target_id = $this->request->getVar('target_id');
		$settingModel = new SettingModel();
		return view('/pages/save-money', [
			'title' => 'Save Money',
			'targets' => $this->targetModel->orderBy('created_at', 'DESC')->findAll(),
			'validation' => \Config\Services::validation(),
			'target_id' => $target_id,
			'settings' => $settingModel->first(),
			'histories' => $this->historyModel->findAll()
		]);
	}

	public function save_money()
	{
		if (!$this->validate([
			'nominal' => [
				'rules' => 'required|numeric',
				'errors' => [
					'required' => 'Nominal is required'
				]
			]
		])) {
			return redirect()->to('/save-money')->withInput();
		} else {
			$target_id = $this->request->getVar('target');
			$target = $this->targetModel->where('id', $target_id)->first();
			$saving = $this->savingModel->where('target_id', $target_id)->first();
			// If target_id of Saving data is available, overwrite data
			if ($saving) {
				$this->savingModel->save([
					'id' => $saving['id'],
					'nominal' => $saving['nominal'] + $this->request->getVar('nominal'),
					'target_id' => $target_id,
				]);
			} else {
				$this->savingModel->save([
					'nominal' => $this->request->getVar('nominal'),
					'target_id' => $target_id,
				]);
			}
			// Save history log
			$description = $this->request->getVar('description');
			$this->historyModel->save([
				'nominal' => $this->request->getVar('nominal'),
				'description' => ($description) ? $description : 'No Description',
				'target_id'	=> $target_id
			]);
			session()->setFlashdata('message', 'Saving money success.');
			return redirect()->to('/targets/' . $target['slug']);
		}
	}
}
