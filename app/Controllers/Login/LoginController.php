<?php

namespace App\Controllers\Login;

use App\Controllers\BaseController;
use App\Models\UserModel;

class LoginController extends BaseController
{
    public function index()
    {
        return view('/login/login_view'); // Sesuaikan dengan nama view login Anda
    }

    public function authenticate()
    {
        $session = session();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $users = $userModel->where('email', $email)->first();

        if ($users && password_verify($password, $users['password'])) {
            if ($users && $users['position'] === 'admin') {
                $session->set([
                    'isLoggedIn' => true,
                    'id' => $users['id'],
                    'name'     => $users['name'],
                    'email' => $users['email'],
                    'position' => $users['position'],
                ]);
                return redirect()->to('/admin/dashboard');
            } else {
                return redirect()->back()->with('error', 'Akses hanya untuk admin.');
            }
        } else {
            return redirect()->back()->with('error', 'Email atau password salah.');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Anda telah logout.');
    }
}
