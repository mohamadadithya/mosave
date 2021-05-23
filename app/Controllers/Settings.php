<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AuthModel;
use App\Models\HistoryModel;
use App\Models\SettingModel;

class Settings extends BaseController
{
	protected $settingModel, $historyModel, $authModel, $validation;
	public function __construct()
	{
		$this->settingModel = new SettingModel();
		$this->historyModel = new HistoryModel();
		$this->validation = \Config\Services::validation();
		$this->authModel = new AuthModel();
	}

	public function index()
	{
		session();
		return view('pages/settings', [
			'title' => 'Settings',
			'settings' => $this->settingModel->first(),
			'validation' => $this->validation,
			'histories' => $this->historyModel->findAll(),
			'user' => $this->authModel->first()
		]);
	}

	public function save()
	{
		if (!$this->validate([
			'web-title' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Web title is required'
				]
			]
		])) {
			return redirect()->to('/settings')->withInput();
		} else {
			$currentSettings = $this->settingModel->first();
			if ($currentSettings) {
				$this->settingModel->save([
					'id' => $currentSettings['id'],
					'web_title' => $this->request->getVar('web-title'),
					'history_in_target' => $this->request->getVar('history-in-target')
				]);
			} else {
				$this->settingModel->save([
					'web_title' => $this->request->getVar('web-title'),
					'history_in_target' => $this->request->getVar('history-in-target')
				]);
			}
			session()->setFlashdata('message', 'Web Setting has been updated.');
			return redirect()->to('/settings');
		}
	}

	public function change_password()
	{
		session();
		return view('/pages/change-password', [
			'title' => 'Change Password',
			'validation' => $this->validation,
			'user' => $this->authModel->first(),
			'settings' => $this->settingModel->first(),
			'histories' => $this->historyModel->findAll()
		]);
	}

	public function update_password()
	{
		if (!$this->validate([
			'current-password' => [
				'rules' => 'required',
				'errors' => ['required' => 'Current password is required']
			],
			'new-password' => [
				'rules' => 'required|min_length[8]',
				'errors' => [
					'required' => 'New password is required',
					'is_unique' => 'The new password cannot be the same as the old password'
				]
			]
		])) {
			return redirect()->to('/user/change-password')->withInput();
		} else {
			$user = $this->authModel->first();
			$currentPassword = $this->request->getVar('current-password');
			$newPassword = $this->request->getVar('new-password');
			// If password match
			if (!password_verify($currentPassword, $user['password'])) {
				session()->setFlashdata('error', 'Your current password is wrong.');
				return redirect()->to('/user/change-password');
			} else {
				if ($currentPassword == $newPassword) {
					session()->setFlashdata('error', 'Your new password cannot be same as current password.');
					return redirect()->to('/user/change-password');
				} else {
					$this->authModel->save([
						'id' => session()->get('isLoggedIn'),
						'password' => password_hash($this->request->getVar('new-password'), PASSWORD_BCRYPT)
					]);
					session()->setFlashdata('message', 'Your password has been changed.');
					return redirect()->to('/settings');
				}
			}
		}
	}

	public function update_user()
	{
		if (!$this->validate([
			'username' => [
				'rules' => 'required',
				'errors' => ['required' => 'Username is required']
			],
			'photo-input' => [
				'rules' => 'max_size[photo-input,1024]|mime_in[photo-input,image/jpg,image/jpeg,image/png]'
			]
		])) {
			return redirect()->to('/settings')->withInput();
		} else {
			$user = $this->authModel->first();
			$photoFile = $this->request->getFile('photo-input');
			// If user haven't upload photo
			if ($photoFile->getError() == 4) {
				$photoName = $user['photo'];
			} else {
				// Get random name from photo file
				$photoName = $photoFile->getRandomName();
				// Move photo to profile-photo folder in public
				$photoFile->move('assets/photos/', $photoName);
				// Check if photo is default
				if ($user['photo'] != 'default.svg') {
					unlink('assets/photos/' . $user['photo']);
				}
			}
			// Save to database
			$this->authModel->save([
				'id' => session()->get('isLoggedIn'),
				'username' => $this->request->getVar('username'),
				'photo' => $photoName
			]);
			session()->setFlashdata('message', 'User setting has been updated.');
			return redirect()->to('/settings');
		}
	}
}
