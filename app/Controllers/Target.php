<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\HistoryModel;
use App\Models\SavingModel;
use App\Models\SettingModel;
use App\Models\TargetModel;

class Target extends BaseController
{
	protected $targetModel, $savingModel, $historyModel, $settingModel, $settings;
	public function __construct()
	{
		$this->targetModel = new TargetModel();
		$this->savingModel = new SavingModel();
		$this->historyModel = new HistoryModel();
		$this->settingModel = new SettingModel();
		$this->settings = $this->settingModel->first();
	}

	public function index($slug)
	{
		if (!$slug) {
			return redirect()->to('/');
		}
		$target = $this->targetModel->target($slug);
		return view('/pages/target', [
			'title' => $target['target_name'],
			'target' => $target,
			'histories' => $this->historyModel->orderBy('time', 'DESC')->where('target_id', $target['target_id'])->findAll(),
			'settings' => $this->settings
		]);
	}

	public function make_target()
	{
		session();
		return view('/pages/make-target', [
			'title' => 'Make Target',
			'validation' => \Config\Services::validation(),
			'settings' => $this->settings,
			'histories' => $this->historyModel->findAll()
		]);
	}

	public function save_target()
	{
		if (!$this->validate([
			'target-name' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Target name is required.'
				]
			],
			'nominal' => [
				'rules' => 'required|numeric',
				'errors' => [
					'required' => 'Nominal is required'
				]
			],
			'duration' => [
				'rules' => 'required|numeric|max_length[2]',
				'errors' => [
					'required' => 'Duration is required'
				]
			],
			'description' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Description is required'
				]
			],
		])) {
			return redirect()->to('/make-target')->withInput();
		} else {
			$slug = url_title($this->request->getVar('target-name'), '-', true);
			$this->targetModel->save([
				'target_name' => $this->request->getVar('target-name'),
				'nominal' => $this->request->getVar('nominal'),
				'duration' => $this->request->getVar('duration'),
				'priority' => $this->request->getVar('priority'),
				'description' => $this->request->getVar('description'),
				'slug' => $slug
			]);
			// Get last target and plus with 1 to get new target_id
			$lastTarget = $this->targetModel->orderBy('created_at', 'DESC')->first();
			$this->savingModel->save([
				'nominal' => 0,
				'target_id' => $lastTarget['id']
			]);
			session()->setFlashdata('message', 'New target has been created.');
			return redirect()->to('/');
		}
	}

	public function delete_target($id)
	{
		// Delete Target data
		$this->targetModel->delete($id);
		$saving = $this->savingModel->where('target_id', $id)->first();
		// Delete Saving data
		$this->savingModel->delete($saving);
		// Delete Histories data
		$this->historyModel->where('target_id', $id)->delete();
		session()->setFlashdata('message', 'Your selected target has been deleted.');
		return redirect()->to('/');
	}
}
