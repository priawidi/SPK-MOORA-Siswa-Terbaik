<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class KriteriaController extends BaseController
{
    public function kriteria()
    {
        $username = session('username');
        $role = session('role');
        $data['role'] = $role;
        $data['user_data'] = $this->User->getUserByUsername($username);
        $data['kriteria'] = $this->Kriteria->getAllKriteria();
        $data['title'] = "Manage Kriteria";

        return view('admin/nilai/kriteria', $data,);

        // if ($role == 1) {
        //     return view('admin/nilai/kriteria', $data,);
        // }
        // if ($role == 2) {
        //     return view('guru/nilai/kriteria', $data,);
        // }
    }

    public function add_kriteria()
    {
        $username = session('username');
        $data['user_data'] = $this->User->getUserByUsername($username);
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
            $role = session('role');
            $data['role'] = $role;

            return view('admin/nilai/tambah_kriteria', $data);

            // if ($role == 1) {
            //     return view('admin/nilai/tambah_kriteria', $data);
            // }
            // if ($role == 2) {
            //     return view('guru/nilai/tambah_kriteria', $data);
            // }
        } else {
            $post = $this->request->getPost(['nama_kriteria', 'kode_kriteria', 'jenis_nilai', 'bobot_nilai']);

            $this->Kriteria->insert($post);

            $this->session->setFlashdata('success_alert', 'Kriteria berhasil ditambah!');
            return redirect()->to(base_url('kriteria'));
        }
    }
    public function delete_kriteria($id)
    {
        $this->Kriteria->delete($id);
        session()->setFlashdata('success_alert', 'Kriteria berhasil dihapus!');
        return redirect()->to(base_url('kriteria'));
    }

    public function detail_kriteria($id)
    {
        $role = session('role');
        $data['role'] = $role;
        $data['kriteria'] = $this->Kriteria->getKriteriaByID($id);
        $data['title'] = "Detail Kriteria";

        return view('admin/nilai/detail_kriteria', $data);

        // if ($role == 1) {
        //     return view('admin/nilai/detail_kriteria', $data);
        // }
        // if ($role == 2) {
        //     return view('guru/nilai/detail_kriteria', $data);
        // }
    }

    public function edit_kriteria($id)
    {
        $username = session('username');
        $data['user_data'] = $this->User->getUserByUsername($username);
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
            $data['kriteria'] = $this->Kriteria->getKriteriaByID($id);
            $role = session('role');
            $data['role'] = $role;

            return view('admin/nilai/edit_kriteria', $data);

            // if ($role == 1) {
            //     return view('admin/nilai/edit_kriteria', $data);
            // }
            // if ($role == 2) {
            //     return view('guru/nilai/edit_kriteria', $data);
            // }
        } else {
            // $post = $this->request->getPost(['username', 'password', 'role']);
            $this->Kriteria->update($id, [
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
