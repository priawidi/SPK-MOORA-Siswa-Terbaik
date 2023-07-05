<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class User extends Seeder
{
    public function run()
    {
        $user_data = [
            [
            'username'=>'admin',
            'password'=> password_hash('admin', PASSWORD_DEFAULT),
            'role'=> '1'
            ],

            [
            'username'=>'guru',
            'password'=>password_hash('guru', PASSWORD_DEFAULT),
            'role'=> '2'
            ],
            
            [
            'username'=>'siswa',
            'password'=>password_hash('siswa', PASSWORD_DEFAULT),
            'role'=> '3'
            ],

        ];


        foreach($user_data as $data){
			// insert semua data ke tabel
			$this->db->table('user')->insert($data);
		}
    }
}
