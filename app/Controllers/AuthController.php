<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    protected UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function login()
    {
        if (session()->get('logged_in')) {
            return redirect()->to(site_url('tasks'));
        }

        return view('auth/login');
    }

    public function attemptLogin()
    {
        $rules = [
            'username' => 'required|max_length[50]',
            'password' => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $user = $this->userModel->findByUsername((string) $this->request->getPost('username'));
        if (! $user || ! password_verify((string) $this->request->getPost('password'), $user['password'])) {
            return redirect()->back()->withInput()->with('error', 'Invalid username or password.');
        }

        session()->regenerate(true);
        session()->set([
            'user_id'   => $user['id'],
            'username'  => $user['username'],
            'full_name' => $user['full_name'],
            'logged_in' => true,
        ]);

        return redirect()->to(site_url('tasks'));
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(site_url('login'))->with('success', 'You have been logged out.');
    }
}
