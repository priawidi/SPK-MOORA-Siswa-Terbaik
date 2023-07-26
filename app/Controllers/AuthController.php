<?php

namespace App\Controllers;

use App\Models\UserModel;
use Myth\Auth\Config\Auth as AuthConfig;
use Myth\Auth\Entities\User;

class AuthController extends BaseController
{

    protected $auth;

    protected $config;

    protected $session;

    public function __construct()
    {
        // Most services in this controller require
        // the session to be started - so fire it up!
        $this->session = service('session');

        $this->config = config('Auth');
        $this->auth   = service('authentication');
    }

    public function index()
    {
        helper(['form']);
        // No need to show a login form if the user
        // is already logged in.
        if ($this->auth->check()) {
            $redirectURL = session('redirect_url') ?? site_url('/');
            unset($_SESSION['redirect_url']);

            return redirect()->to($redirectURL);
        }
        $User = new UserModel();
        if (session('loggedIn')) {
            redirect('AuthController/accessBlocked');
        }

        $rules = [
            'username' => [
                'label'    => 'Username',
                'rules'    => 'required',
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

        if ($this->validate($rules) == false) {
            $data['title'] = "Halaman Login";
            return view('login', $data);
        } else {
            // validation success
            $this->loginAuth();
        }
        // return view('login');
    }

    public function loginAuth()
    {
        $session = session();
        $userModel = new UserModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $data = $userModel->where('username', $username)->first();

        if ($data) {
            $pass = $data['password'];
            $authenticatePassword = password_verify($password, $pass);
            if ($authenticatePassword) {
                $ses_data = [
                    'id' => $data['id'],
                    'username' => $data['username'],
                    'role' => $data['role'],
                    'isLoggedIn' => TRUE
                ];
                $session->set($ses_data);

                if ($data['role'] == 1) {
                    return redirect()->to('admin');
                } elseif ($data['role'] == 2) {
                    return redirect()->to('guru');
                } elseif ($data['role'] == 3) {
                    return redirect()->to('siswa');
                }

                //return redirect()->to('/profile');

            } else {
                $session->setFlashdata('msg', 'Password is incorrect.');
                return redirect()->to('');
            }
        } else {
            $session->setFlashdata('msg', 'Username is incorrect.');
            return redirect()->to('');
        }
    }


    public function logout()
    {
        //$session = new session();
        session()->destroy();
        return redirect()->to('/login');
    }

    public function accessBlocked()
    {
        return view('block');
    }
}
