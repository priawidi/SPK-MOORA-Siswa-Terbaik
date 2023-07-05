<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use Config\Services;

class UserAuth extends BaseController
{
    protected $UserModel;
    public function __construct()
    {
        $this->UserModel = new UserModel();

        // $this->$validation = \Config\Services::validation();

        $this->session = \Config\Services::session();
        
        
    }

    public function index()
    {
        // if ($this->session->userdata('loggedIn')) {
        //     redirect('UserAuth/accessBlocked');
        // }

        $validation = \Config\Services::validation();
        $rules = [
            'username' =>'required',
            'password' => 'required|min_length[10]',
            'passconf' => 'required|matches[password]',
            'email'    => 'required|valid_email',
        ];
        if (!$this->validate($rules)) {
            return redirect()->to('auth/login')->withInput()->with('validation', $validation);
        }
        
    
    }


    
    public function login()
    {

        $data = $this->request->getPost();

        // get all user information from the database
        $user = $this->UserModel->where('username', $data['username'])->first();

        // check wether user is existed or not
        if ($user) {
            if ($user['password'] != md5($data['password'])) {
                session()->setFlashdata('password','Password salah');
                return redirect()->to('/auth/login');
            }

            else{
                $sessLogin = [
                    'isLogin' =>true,
                    'username' => $user['username'],
                    'role' => $user['role']
                ];
                $this->session->set($sessLogin);
                return redirect()->to('/guru');
            }
             
        // $users = new UserModel();
        // $username = $this->request->getVar('username');
        // $password = $this->request->getVar('password');
        // $dataUser = $users->where([
        //     'username' => $username,
        // ])->first();
        // if ($dataUser) {
        //     if (password_verify($password, $dataUser->password)) {
        //         session()->set([
        //             'username' => $dataUser->username,
        //             'logged_in' => TRUE
        //         ]);
        //         return redirect()->to(base_url('home'));
        //     } else {
        //         session()->setFlashdata('error', 'Username & Password Salah');
        //         return redirect()->back();
        //     }
        // } else {
        //     session()->setFlashdata('error', 'Username & Password Salah');
        //     return redirect()->back();
        }
        else{
            session()->setFlashdata('username', 'Username tidak ditemukan');
            return redirect()->to('/auth/login');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
        // // Remove token and user data from the session
        // $this->session->unset_userdata('username');
        // $this->session->unset_userdata('role');
        // $this->session->unset_userdata('loggedIn');

        // $this->session->set_flashdata('success_alert', 'Anda telah keluar!');
        // redirect('user_auth');
    }

    public function accessBlocked()
    {
        return view('auth/blocked');
    }
}
