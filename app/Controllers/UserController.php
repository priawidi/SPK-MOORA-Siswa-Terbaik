<?php

namespace App\Controllers;

use App\Controllers\BaseController;


class UserController extends BaseController
{
    public function manajemen_user()
    {

        $username = session('username');
        $role = session('role');
        $data['user_data'] = $this->User->getUserByUsername($username);
        $data['users'] = $this->User->getAllUser();
        $data['role'] = $this->User->getUserByRole($role);
        $data['title'] = "Manage User";

        return view('admin/user/index', $data);
    }

    public function add_user()
    {


        $username = session('username');
        $data['user_data'] = $this->User->getUserByUsername($username);

        $validation = \Config\Services::validation();
        $rules = [
            'username' => [
                'label'    => 'Username',
                'rules'    => 'required|trim',
                'errors'    => [
                    'required'    => 'Username harus diisi.'
                ]
            ], 'password' => [
                'label'    => 'Password',
                'rules'    => 'required|trim',
                'errors'    => [
                    'required'    => 'Password harus diisi.'
                ]
            ],

        ];
        if (!$this->validate($rules)) {
            $data['title'] = "Admin|Tambah User";
            return view('admin/user/tambah_user', $data);
        } else {
            $pass_hash = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
            $post = $this->request->getPost(['username', 'password', 'role']);

            $this->User->insert([
                'username' => $this->request->getVar('username'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'role' => $this->request->getVar('role'),

            ]);

            $this->session->setFlashdata('success_alert', 'User berhasil ditambah!');
            return redirect()->to(base_url('user'));
        }
    }

    public function edit_user($id)
    {
        $data = [
            'title' => 'Admin|Edit User',
        ];

        $username = session('username');
        // $data['user_data'] = $User->getUserByUsername($username);
        $rules = [
            'username' => [
                'label'    => 'Username',
                'rules'    => 'required|trim',
                'errors'    => [
                    'required'    => 'Username harus diisi.'
                ]
            ], 'password' => [
                'label'    => 'Password',
                'rules'    => 'required|trim',
                'errors'    => [
                    'required'    => 'Password harus diisi.'
                ]
            ],

        ];
        if (!$this->validate($rules)) {
            $data['title'] = "Admin|Edit User";
            $data['user'] = $this->User->getUserByID($id);


            return view('admin/user/edit_user', $data);
        } else {

            $post = $this->request->getPost(['username', 'password', 'role']);

            $this->User->update($id, [
                'username' => $this->request->getVar('username'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'role' => $this->request->getVar('role'),

            ]);

            session()->setFlashdata('success_alert', 'User berhasil diubah!');
            return redirect()->to(base_url('user'));
        }
    }

    public function delete_user($id)
    {


        $this->User->delete($id);
        session()->setFlashdata('success_alert', 'User berhasil dihapus!');
        return redirect()->to(base_url('user'));
    }

    public function detail_user($id)
    {

        $data['user'] = $this->User->getUserByID($id);

        $data['title'] = "Detail User";

        return view('admin/user/detail_user', $data,);
    }
}
