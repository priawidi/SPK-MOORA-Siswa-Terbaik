<?php

namespace App\Controllers;
use App\Models\UserModel;
use CodeIgniter\Debug\Toolbar\Collectors\Views;

class Home extends BaseController
{
    public function index()
    {

       if(!session('loggedIn')) {
        redirect()->route('login');
       } else {
        $data = $userModel->where('username', $username)->first();
        if ($data['role'] == 1){
            return redirect()->route('admin');
        } elseif ($data['role'] == 2) {
            return redirect()->route('guru');
        } elseif ($data['role'] == 3) {
            return redirect()->route('siswa');
        }
       }
             
     
    }
}

