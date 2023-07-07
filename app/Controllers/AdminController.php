<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SiswaModel;
use App\Models\UserModel;
use App\Models\KriteriaModel;

class AdminController extends BaseController
{


    public function index()
    {

        return view('/admin/index');
    }

    public function manajemen_user()
    {
        $User = new UserModel();
        $username = session('username');
        $role = session('role');
        $data['user_data'] = $User->getUserByUsername($username);
        $data['users'] = $User->getAllUser();
        $data['role'] = $User->getUserByRole($role);
        $data['title'] = "Manage User";

        return view('admin/user/index', $data);
    }

    public function add_user()
    {

        $User = new UserModel();
        $username = session('username');
        $data['user_data'] = $User->getUserByUsername($username);

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

            $User->insert([
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
        $User = new UserModel();
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
            $data['user'] = $User->getUserByID($id);


            return view('admin/user/edit_user', $data);
        } else {

            $post = $this->request->getPost(['username', 'password', 'role']);

            $User->update($id, [
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

        $User = new UserModel();
        $User->delete($id);
        session()->setFlashdata('success_alert', 'User berhasil dihapus!');
        return redirect()->to(base_url('user'));
    }

    public function detail_user($id)
    {
        $User = new UserModel();
        $data['user'] = $User->getUserByID($id);

        $data['title'] = "Detail User";

        return view('admin/user/detail_user', $data,);
    }

    public function data_siswa()
    {

        $Siswa = new SiswaModel();
        $User = new UserModel();
        $username = session('username');
        $data['user_data'] = $User->getUserByUsername($username);
        $data['siswa'] = $Siswa->getAllSiswa();
        $data['title'] = "Manage Siswa";

        return view('admin/siswa/index', $data,);
    }

    public function add_siswa()
    {

        $User = new UserModel();
        $Siswa = new SiswaModel();
        $username = session('username');
        // $nama_siswa = session('nama_siswa');
        $data['user_data'] = $User->getUserByUsername($username);
        // $data['user_data'] = $Siswa->getSiswaByNmSiswa($nama_siswa);

        $validation = \Config\Services::validation();
        $rules = [
            'nama_siswa' => [
                'label'    => 'Nama Siswa',
                'rules'    => 'required|trim',
                'errors'    => [
                    'required'    => 'Nama Siswa harus diisi.'
                ]

            ],
            'nis' => [
                'label'    => 'NISN',
                'rules'    => 'required|trim',
                'errors'    => [
                    'required'    => 'NISN harus diisi.'
                ]

            ],
            'kelas' => [
                'label'    => 'Kelas',
                'rules'    => 'required|trim',
                'errors'    => [
                    'required'    => 'Kelas harus diisi.'
                ]

            ],
            'jenis_kelamin' => [
                'label'    => 'Jenis Kelamin',
                'rules'    => 'required|trim',
                'errors'    => [
                    'required'    => 'Jenis Kelamin harus diisi.'
                ]

            ],
            'alamat' => [
                'label'    => 'Alamat',
                'rules'    => 'required|trim',
                'errors'    => [
                    'required'    => 'Alamat harus diisi.'
                ]

            ],
            'no_telepon' => [
                'label'    => 'No. Telepon',
                'rules'    => 'required|trim',
                'errors'    => [
                    'required'    => 'No. Telepon harus diisi.'
                ]
            ],

        ];
        if (!$this->validate($rules)) {
            $data['title'] = "Admin|Tambah Siswa";
            return view('admin/siswa/tambah_siswa', $data);
        } else {
            $post = $this->request->getPost(['nama_siswa', 'nis', 'kelas', 'jenis_kelamin', 'alamat', 'no_telepon']);

            $Siswa->insert($post);

            $this->session->setFlashdata('success_alert', 'User berhasil ditambah!');
            return redirect()->to(base_url('datasiswa'));
        }
    }

    public function delete_siswa($id)
    {

        $Siswa = new SiswaModel();
        $Siswa->delete($id);
        session()->setFlashdata('success_alert', 'User berhasil dihapus!');
        return redirect()->to(base_url('datasiswa'));
    }

    public function detail_siswa($id)
    {
        $User = new UserModel();
        $Siswa = new SiswaModel();
        $data['siswa'] = $Siswa->getSiswaByID($id);

        $data['title'] = "Detail Siswa";

        return view('admin/siswa/detail_siswa', $data);
    }

    public function edit_siswa($id)
    {
        $User = new UserModel();
        $Siswa = new SiswaModel();
        $username = session('username');
        // $nama_siswa = session('nama_siswa');
        // $data['user_data'] = $User->getUserByUsername($username);
        // $data['user_data'] = $Siswa->getSiswaByNmSiswa($nama_siswa);
        $data = [
            'title' => 'Admin|Edit User',
        ];

        $rules = [
            'nama_siswa' => [
                'label'    => 'Nama Siswa',
                'rules'    => 'required|trim',
                'errors'    => [
                    'required'    => 'Nama Siswa harus diisi.'
                ]

            ],
            'nis' => [
                'label'    => 'NISN',
                'rules'    => 'required|trim',
                'errors'    => [
                    'required'    => 'NISN harus diisi.'
                ]

            ],
            'kelas' => [
                'label'    => 'Kelas',
                'rules'    => 'required|trim',
                'errors'    => [
                    'required'    => 'Kelas harus diisi.'
                ]

            ],
            'jenis_kelamin' => [
                'label'    => 'Jenis Kelamin',
                'rules'    => 'required|trim',
                'errors'    => [
                    'required'    => 'Jenis Kelamin harus diisi.'
                ]

            ],
            'alamat' => [
                'label'    => 'Alamat',
                'rules'    => 'required|trim',
                'errors'    => [
                    'required'    => 'Alamat harus diisi.'
                ]

            ],
            'no_telepon' => [
                'label'    => 'No. Telepon',
                'rules'    => 'required|trim',
                'errors'    => [
                    'required'    => 'No. Telepon harus diisi.'
                ]
            ],

        ];
        if (!$this->validate($rules)) {
            $data['title'] = "Admin|Edit Siswa";
            $data['siswa'] = $Siswa->getSiswaByID($id);


            return view('admin/siswa/edit_siswa', $data);
        } else {

            $post = $this->request->getPost(['username', 'password', 'role']);

            $Siswa->update($id, [
                'nama_siswa' => $this->request->getVar('nama_siswa'),
                'nis' => $this->request->getVar('nis'),
                'kelas' => $this->request->getVar('kelas'),
                'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
                'alamat' => $this->request->getVar('alamat'),
                'no_telepon' => $this->request->getVar('no_telepon')

            ]);

            session()->setFlashdata('success_alert', 'Siswa berhasil diubah!');
            return redirect()->to(base_url('datasiswa'));
        }
    }


    public function kriteria()
    {

        $Kriteria = new KriteriaModel();
        $User = new UserModel();
        $username = session('username');
        $data['user_data'] = $User->getUserByUsername($username);
        $data['kriteria'] = $Kriteria->getAllKriteria();
        $data['title'] = "Manage Kriteria";

        return view('admin/nilai/kriteria', $data,);
    }

    public function add_kriteria()
    {

        $User = new UserModel();
        $Kriteria = new KriteriaModel();
        $username = session('username');
        $data['user_data'] = $User->getUserByUsername($username);
        $rules = [
            'nama_kriteria' => [
                'label'    => 'Nama Kriteria',
                'rules'    => 'required|trim',
                'errors'    => [
                    'required'    => 'Nama Kriteria harus diisi.'
                ]

            ],
            'kode_kriteria' => [
                'label'    => 'Kode Kriteria',
                'rules'    => 'required|trim',
                'errors'    => [
                    'required'    => 'Kode Kriteria harus diisi.'
                ]

            ],
            'jenis_nilai' => [
                'label'    => 'Jenis Nilai',
                'rules'    => 'required|trim',
                'errors'    => [
                    'required'    => 'Jenis Nilai harus diisi.'
                ]

            ],
            'bobot_nilai' => [
                'label'    => 'Bobot Nilai',
                'rules'    => 'trim|required',
                'errors'    => [
                    'required'    => 'Bobot Nilai harus diisi.'
                ]

            ],

        ];
        if (!$this->validate($rules)) {
            $data['title'] = "Admin|Tambah Kriteria";
            return view('admin/nilai/tambah_kriteria', $data);
        } else {
            $post = $this->request->getPost(['nama_kriteria', 'kode_kriteria', 'jenis_nilai', 'bobot_nilai']);

            $Kriteria->insert($post);

            $this->session->setFlashdata('success_alert', 'Kriteria berhasil ditambah!');
            return redirect()->to(base_url('kriteria'));
        }
    }
    public function delete_kriteria($id)
    {

        $Kriteria = new KriteriaModel();
        $Kriteria->delete($id);
        session()->setFlashdata('success_alert', 'Kriteria berhasil dihapus!');
        return redirect()->to(base_url('kriteria'));
    }

    public function detail_kriteria($id)
    {
        $User = new UserModel();
        $Kriteria = new KriteriaModel();
        $data['kriteria'] = $Kriteria->getKriteriaByID($id);

        $data['title'] = "Detail Kriteria";

        return view('admin/nilai/detail_kriteria', $data);
    }

    public function edit_kriteria($id)
    {
        $User = new UserModel();
        $Kriteria = new KriteriaModel();
        $username = session('username');
        // $nama_siswa = session('nama_siswa');
        // $data['user_data'] = $User->getUserByUsername($username);
        // $data['user_data'] = $Siswa->getSiswaByNmSiswa($nama_siswa);
        $data = [
            'title' => 'Admin|Edit Kriteria',
        ];

        $rules = [
            'nama_kriteria' => [
                'label'    => 'Nama kriteria',
                'rules'    => 'required|trim',
                'errors'    => [
                    'required'    => 'Nama kriteria harus diisi.'
                ]

            ],
            'kode_kriteria' => [
                'label'    => 'kode_kriteria',
                'rules'    => 'required|trim',
                'errors'    => [
                    'required'    => 'kode_kriteria harus diisi.'
                ]

            ],
            'jenis_nilai' => [
                'label'    => 'jenis_nilai',
                'rules'    => 'required|trim',
                'errors'    => [
                    'required'    => 'jenis_nilai harus diisi.'
                ]

            ],
            'bobot_nilai' => [
                'label'    => 'Bobot Nilai',
                'rules'    => 'required|trim',
                'errors'    => [
                    'required'    => 'Bobot Nilai harus diisi.'
                ]

            ],

        ];
        if (!$this->validate($rules)) {
            $data['title'] = "Admin|Edit Siswa";
            $data['kriteria'] = $Kriteria->getKriteriaByID($id);


            return view('admin/nilai/edit_kriteria', $data);
        } else {

            // $post = $this->request->getPost(['username', 'password', 'role']);

            $Kriteria->update($id, [
                'nama_kriteria' => $this->request->getVar('nama_kriteria'),
                'kode_kriteria' => $this->request->getVar('kode_kriteria'),
                'jenis_nilai' => $this->request->getVar('jenis_nilai'),
                'bobot_nilai' => $this->request->getVar('bobot_nilai'),


            ]);

            session()->setFlashdata('success_alert', 'Kriteria berhasil diubah!');
            return redirect()->to(base_url('kriteria'));
        }
    }
}
