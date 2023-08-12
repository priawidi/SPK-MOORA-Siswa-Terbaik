<?php

namespace App\Controllers;

use App\Controllers\BaseController;


class SiswaController extends BaseController
{
  public function index()
  {

    return view('siswa/index');
  }
  public function data_siswa($kelas)
  {

    $username = session('username');
    $role = session('role');
    $data['role'] = $role;
    $data['user_data'] = $this->User->getUserByUsername($username);
    $data['title'] = "Manage Siswa";
    $data['grade'] = $this->Siswa->getSiswaBykelas($kelas);




    if ($kelas == 7) {
      return view('admin/siswa/kelas 7/index', $data,);
    } elseif ($kelas == 8) {
      return view('admin/siswa/kelas 8/index', $data,);
    } elseif ($kelas == 9) {
      return view('admin/siswa/kelas 9/index', $data,);
    }
  }

  public function add_siswa($kelas)
  {

    $username = session('username');
    $role = session('role');
    $data['role'] = $role;
    $data['user_data'] = $this->User->getUserByUsername($username);
    $data['grade'] = $this->Siswa->getSiswaBykelas;

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
    ];
    if (!$this->validate($rules)) {
      $data['title'] = "Admin|Tambah Siswa";
      $role = session('role');
      $data['role'] = $role;
      $firstChar = substr($kelas, 0, 1);
      return view('admin/siswa/kelas ' . $firstChar . '/importxls', $data);
    } else {
      $post = $this->request->getPost(['nama_siswa', 'nis', 'kelas']);
      $this->Siswa->insert($post);

      $this->session->setFlashdata('success_alert', 'Siswa berhasil ditambah!');
      return redirect()->to(base_url('datasiswa/' . $kelas));
    }
  }

  public function delete_siswa($id)
  {
    $sis = $this->Siswa->getSiswaByID($id);
    $kelas = $sis['kelas'];
    $this->Siswa->delete($id);
    $this->Nilai->delete($id);
    session()->setFlashdata('success_alert', 'Siswa berhasil dihapus!');
    return redirect()->to(base_url('datasiswa/' . $kelas));
  }

  public function detail_siswa($id)
  {

    $role = session('role');
    $data['role'] = $role;
    $data['siswa'] = $this->Siswa->getSiswaByID($id);
    // $data['kriteria'] = $this->Nilai->getAllNilaiSiswa();
    $data['nilai_siswa'] = $this->Nilai->getNilaiSiswaByIdSiswa($id);

    $data['title'] = "Detail Siswa";



    return view('admin/siswa/detail_siswa', $data);

    // if ($role == 1) {
    //   return view('admin/siswa/detail_siswa', $data);
    // }

    // if ($role == 2) {
    //   return view('guru/siswa/detail_siswa', $data);
    // }
  }

  public function edit_siswa($id)
  {
    $role = session('role');
    $data['role'] = $role;
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



    ];
    if (!$this->validate($rules)) {
      $data['title'] = "Admin|Edit Siswa";
      $data['siswa'] = $this->Siswa->getSiswaByID($id);
      $data['nilai_siswa'] = $this->Nilai->getNilaiSiswaByIdSiswa($id);

      $role = session('role');
      $data['role'] = $role;


      return view('admin/siswa/edit_siswa', $data);

      // if ($role == 1) {
      //   return view('admin/siswa/edit_siswa', $data);
      // }
      // if ($role == 2) {
      //   return view('guru/siswa/edit_siswa', $data);
      // }
    } else {
      $sis = $this->Siswa->getSiswaByID($id);
      $kelas = $sis['kelas'];
      // $post = $this->request->getPost(['username', 'password', 'role']);

      $this->Siswa->update($id, [
        'nama_siswa' => $this->request->getVar('nama_siswa'),
        'nis' => $this->request->getVar('nis'),
        'kelas' => $this->request->getVar('kelas'),
      ]);


      $kriteria = $this->Kriteria->getAllKriteria();
      $count = count($kriteria);
      for ($i = 1; $i <= $count; $i++) {

        $data = [
          'fk_id_kriteria' => $i,
          'fk_id_siswa' => $this->request->getVar('id_siswa'),
          'nilai' => $this->request->getVar('nilai' . $i),
        ];

        $this->Nilai->editNilaiSiswaData($data);
      }


      session()->setFlashdata('success_alert', 'Siswa berhasil diubah!');
      return redirect()->to(base_url('datasiswa/' . $kelas));
    }
  }

  public function nilai_siswa()
  {


    $username = session('username');
    $role = session('role');
    $data['role'] = $role;
    $data['user_data'] = $this->User->getUserByUsername($username);
    $data['nilai_siswa'] = $this->Nilai->getAllNilaiSiswa();
    $data['siswa'] = $this->Siswa->getAllSiswa();
    $data['kriteria'] = $this->Kriteria->getAllKriteria();
    $data['title'] = "Manage Nilai Siswa";

    return view('admin/nilai/nilai_siswa', $data);

    // if ($role == 1) {
    //   return view('admin/nilai/nilai_siswa', $data);
    // }
    // if ($role == 2) {
    //   return view('guru/nilai/nilai_siswa', $data);
    // }
  }

  public function add_nilai_siswa($id)
  {
    $role = session('role');
    $data['role'] = $role;

    $username = session('username');
    $data['user_data'] = $this->User->getUserByUsername($username);
    $rules = [
      'nama_siswa' => [
        'label'    => 'Nilai Siswa',
        'rules'    => 'required|trim',
        'errors'    => [
          'required'    => 'Nilai Siswa harus diisi.'
        ],

      ],

    ];
    if (!$this->validate($rules)) {
      $data['title'] = "Admin|Tambah Nilai Siswa";
      $data['siswa'] = $this->Siswa->getSiswaByID($id);
      $data['nilai_siswa'] = $this->Nilai->getNilaiSiswaByIdSiswa($id);
      $data['kriteria'] = $this->Kriteria->getAllKriteria();
      $role = session('role');
      $data['role'] = $role;

      return view('admin/nilai/tambah_nilai_siswa', $data);

      // if ($role == 1) {
      //   return view('admin/nilai/tambah_nilai_siswa', $data);
      // }
      // if ($role == 2) {
      //   return view('guru/nilai/tambah_nilai_siswa', $data);
      // }
    } else {
      $kriteria = $this->Kriteria->getAllKriteria();
      $count = count($kriteria);
      for ($i = 1; $i <= $count; $i++) {

        $data = [
          'fk_id_kriteria' => $i,
          'fk_id_siswa' => $this->request->getPost('id_siswa'),
          'nilai' => $this->request->getPost('nilai' . $i),
        ];
        $this->Nilai->insert($data);
      }
      $sis = $this->Siswa->getSiswaByID($id);
      $kelas = $sis['kelas'];
      $this->session->setFlashdata('success_alert', 'Nilai Siswa berhasil ditambah!');
      return redirect()->to('datasiswa/' . $kelas);
    }
  }
  public function delete_nilai_siswa($id)
  {
    $this->Nilai->delete($id);
    session()->setFlashdata('success_alert', 'Nilai Siswa berhasil dihapus!');
    return redirect()->to(base_url('nilai_siswa'));
  }

  public function detail_nilai_siswa($id)
  {
    $username = session('username');
    $role = session('role');
    $data['role'] = $role;
    $data['user_data'] = $this->User->getUserByUsername($username);
    $data['siswa'] = $this->Siswa->getSiswaByID($id);
    $data['kriteria'] = $this->Nilai->getAllNilaiSiswa();
    $data['nilai_siswa'] = $this->Nilai->getAllNilaiSiswa();

    $data['title'] = "Detail Kriteria";

    return view('admin/nilai/detail_nilai_siswa', $data);

    // if ($role == 1) {
    //   return view('admin/nilai/detail_nilai_siswa', $data);
    // }
    // if ($role == 2) {
    //   return view('guru/nilai/detail_nilai_siswa', $data);
    // }
  }

  public function edit_nilai_siswa($id)
  {
    $role = session('role');
    $data['role'] = $role;
    $username = session('username');
    $data['user_data'] = $this->User->getUserByUsername($username);
    $rules = [
      'nama_siswa' => [
        'label'    => 'Nilai Siswa',
        'rules'    => 'required|trim',
        'errors'    => [
          'required'    => 'Nilai Siswa harus diisi.'
        ]

      ],

    ];
    if (!$this->validate($rules)) {
      $data['title'] = "Admin|Tambah Nilai Siswa";
      $data['siswa'] = $this->Siswa->getSiswaByID($id);
      $data['nilai_siswa'] = $this->Nilai->getNilaiSiswaByIdSiswa($id);
      $data['kriteria'] = $this->Kriteria->getAllKriteria();
      $role = session('role');
      $data['role'] = $role;
      if (isset($data['nilai_siswa']) && !empty($data['nilai_siswa'])) {

        return view('admin/nilai/edit_nilai_siswa', $data);

        // if ($role == 1) {
        //   return view('admin/nilai/edit_nilai_siswa', $data);
        // }
        // if ($role == 2) {
        //   return view('guru/nilai/edit_nilai_siswa', $data);
        // }
      } else {
        $idsis = $this->Siswa->getSiswaByID($id);
        return redirect()->to('addnilaisiswa/' . $idsis['id_siswa']);
      }
    } else {
      $kriteria = $this->Kriteria->getAllKriteria();
      $count = count($kriteria);
      for ($i = 1; $i <= $count; $i++) {

        $data = [
          'fk_id_kriteria' => $i,
          'fk_id_siswa' => $this->request->getVar('id_siswa'),
          'nilai' => $this->request->getVar('nilai' . $i),
        ];

        $this->Nilai->editNilaiSiswaData($data);
      }


      $this->session->setFlashdata('success_alert', 'Nilai Siswa berhasil diubah!');
      return redirect()->to(base_url('nilaisiswa'));
    }
  }
}
