<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AuthModel;
use App\Models\SettingModel;

class Auth extends BaseController
{
	protected $authModel, $settingModel, $validation, $settings;
	public function __construct()
	{
		$this->authModel = new AuthModel();
		$this->validation = \Config\Services::validation();
		$this->settingModel = new SettingModel();
		$this->settings = $this->settingModel->first();
	}

	public function index()
	{
		$user = $this->authModel->first();
		if (!$user) {
			return redirect()->to('/welcome');
		}
		if (session()->has('isLoggedIn')) {
			return redirect()->to('/');
		}
		session();
		return view('pages/login', [
			'title' => 'Login',
			'validation' => $this->validation,
			'user' => $user,
			'settings' => $this->settings
		]);
	}

	public function register()
	{
		$user = $this->authModel->first();
		if ($user) {
			session()->setFlashdata('error', 'Sorry, you cannot register again.');
			return redirect()->to('/login');
		}
		session();
		return view('pages/register', [
			'title' => 'Register for Once',
			'validation' => $this->validation,
			'settings' => $this->settings
		]);
	}

	public function save_user()
	{
		if (!$this->validate([
			'username' => 'required',
			'password' => 'required|min_length[8]'
		])) {
			return redirect()->to('/register')->withInput();
		} else {
			$this->authModel->save([
				'username' => $this->request->getVar('username'),
				'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
				'photo' => 'default.svg'
			]);
			session()->setFlashdata('message', 'Congrats!, you have successfully registered.');
			return redirect()->to('/login');
		}
	}

	public function login()
	{
		if (!$this->validate([
			'password' => 'required'
		])) {
			return redirect()->to('/login')->withInput();
		} else {
			$password = $this->request->getVar('password'); // Password input
			$user = $this->authModel->first();

			if (password_verify($password, $user['password'])) {
				session()->set('isLoggedIn', $user['id']);
				return redirect()->to('/');
			} else {
				session()->setFlashdata('error', 'Your password is wrong.');
				return redirect()->to('/login');
			}
		}
	}

	public function logout()
	{
		if (session()->has('isLoggedIn')) {
			session()->remove('isLoggedIn');
			return redirect()->to('/login');
		}
	}
}
