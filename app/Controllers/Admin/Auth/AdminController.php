<?php

namespace App\Controllers\Admin\Auth;

use App\Controllers\BaseController;
use App\Models\AdminModel;

class AdminController extends BaseController
{
    public function __construct()
    {
        $this->session = session();
        $this->model = new AdminModel();
    }

    public function index()
    {
        $id = $this->session->get('id');
        $data = $this->model->find($id);
        return view('admin/auth/profile', [
            'page' => 'admin', 'admin' => $data
        ]);
    }

    public function update()
    {
        $username = $this->request->getPost('username');
        $name = $this->request->getPost('name');
        $id = $this->session->get('id');

        $this->model->update($id, [
            'username' => $username,
            'name' => $name
        ]);

        $this->session->setFlashdata('success', 'Berhasil mengubah data admin');
        return redirect()->to(base_url(route_to('adminProfile')));
    }

    public function updatePassword()
    {
        $password = $this->request->getPost('password');
        $passwordConfirmation = $this->request->getPost('password_confirmation');

        if ($password !== $passwordConfirmation) {
            $this->session->setFlashdata('fail-password', 'Konfirmasi Password tidak sama!');
        } else {
            $id = $this->session->get('id');

            $passwordHash = password_hash(
                $password,
                PASSWORD_BCRYPT // 60 characters
            );

            $this->model->update($id, [
                'password' => $passwordHash
            ]);

            $this->session->setFlashdata('success', 'Berhasil merubah password admin');
        }

        return redirect()->to(base_url(route_to('adminProfile')));
    }
}
