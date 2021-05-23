<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthCheck implements FilterInterface
{
	public function before(RequestInterface $request, $arguments = null)
	{
		if (!session()->has('isLoggedIn')) {
			return redirect()->to('/login');
		}
	}

	public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
	{
		//
	}
}
