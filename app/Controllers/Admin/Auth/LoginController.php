<?php

namespace App\Controllers\Admin\Auth;

use App\Controllers\BaseController;
use App\Models\AdminModel;

class LoginController extends BaseController
{
    public function index()
    {
        return view('admin/auth/login');
    }

    public function login()
    {
        $session = session();
        $model = new AdminModel();

        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $data = $model->where('username', $username)->first();

        if ($data) {
            $pass = $data['password'];
            $verify_pass = password_verify($password, $pass);

            if ($verify_pass) {
                $ses_data = [
                    'id'            => $data['id'],
                    'name'          => $data['name'],
                    'username'      => $data['username'],
                    'isLoggedIn'    => TRUE
                ];

                $session->set($ses_data);

                return redirect()->to(base_url(route_to('adminHome')));
            } else {
                $session->setFlashdata('msg', 'Password tidak benar');
                return redirect()->to(base_url(route_to('login')));
            }
        } else {
            $session->setFlashdata('msg', 'Username tidak ditemukan');
            return redirect()->to(base_url(route_to('login')));
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url(route_to('login')));
    }
}
