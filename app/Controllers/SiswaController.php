<?php

namespace App\Controllers;

use App\Controllers\BaseController;


class SiswaController extends BaseController
{
  public function data_siswa()
  {

    $username = session('username');
    $data['user_data'] = $this->User->getUserByUsername($username);
    $data['siswa'] = $this->Siswa->paginate(10, 'siswa');
    $data['pager'] = $this->Siswa->pager;
    $data['title'] = "Manage Siswa";

    return view('admin/siswa/index', $data,);
  }

  public function add_siswa()
  {

    $username = session('username');
    $data['user_data'] = $this->User->getUserByUsername($username);

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
      return view('admin/siswa/tambah_siswa', $data);
    } else {
      $post = $this->request->getPost(['nama_siswa', 'nis', 'kelas']);
      $this->Siswa->insert($post);

      $this->session->setFlashdata('success_alert', 'Siswa berhasil ditambah!');
      return redirect()->to(base_url('datasiswa'));
    }
  }

  public function delete_siswa($id)
  {

    $this->Siswa->delete($id);
    session()->setFlashdata('success_alert', 'Siswa berhasil dihapus!');
    return redirect()->to(base_url('datasiswa'));
  }

  public function detail_siswa($id)
  {

    $data['siswa'] = $this->Siswa->getSiswaByID($id);

    $data['title'] = "Detail Siswa";

    return view('admin/siswa/detail_siswa', $data);
  }

  public function edit_siswa($id)
  {

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
      'nilai' => [
        'label'    => 'Nilai Siswa',
        'rules'    => 'required|trim',
        'errors'    => [
          'required'    => 'Nilai Siswa harus diisi.'
        ]

      ],


    ];
    if (!$this->validate($rules)) {
      $data['title'] = "Admin|Edit Siswa";
      $data['siswa'] = $this->Siswa->getSiswaByID($id);


      return view('admin/siswa/edit_siswa', $data);
    } else {

      $post = $this->request->getPost(['username', 'password', 'role']);

      $this->Siswa->update($id, [
        'nama_siswa' => $this->request->getVar('nama_siswa'),
        'nis' => $this->request->getVar('nis'),
        'kelas' => $this->request->getVar('kelas'),
      ]);

      session()->setFlashdata('success_alert', 'Siswa berhasil diubah!');
      return redirect()->to(base_url('datasiswa'));
    }
  }

  public function nilai_siswa()
  {


    $username = session('username');
    $data['user_data'] = $this->User->getUserByUsername($username);
    $data['nilai_siswa'] = $this->Nilai->getAllNilaiSiswa();
    $data['siswa'] = $this->Siswa->getAllSiswa();
    $data['kriteria'] = $this->Kriteria->getAllKriteria();
    $data['title'] = "Manage Nilai Siswa";

    return view('admin/nilai/nilai_siswa', $data,);
  }

  public function add_nilai_siswa($id)
  {


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
      return view('admin/nilai/tambah_nilai_siswa', $data);
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
      // $post = $this->request->getPost('nilai');
      // $id_siswa = $this->request->getPost('id_siswa');
      // $i = 1;
      // foreach ($post as $x) {
      //   $data = [
      //     'fk_id_kriteria' => $i,
      //     'fk_id_siswa' => $id_siswa,
      //     'nilai' => $x['nilai'],
      //   ];
      //   $this->Nilai->insert($data);
      //   $i++;
      //   $this->session->setFlashdata('success_alert', 'Nilai Siswa gagal ditambah!');
      // }


      $this->session->setFlashdata('success_alert', 'Nilai Siswa berhasil ditambah!');
      return redirect()->to('datasiswa');
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
    $data['user_data'] = $this->User->getUserByUsername($username);
    // $data['nilai_siswa'] = $Nilai->getAllNilaiSiswa();
    $data['siswa'] = $this->Siswa->getSiswaByID($id);
    $data['kriteria'] = $this->Nilai->getAllNilaiSiswa();
    $data['nilai_siswa'] = $this->Nilai->getAllNilaiSiswa();

    $data['title'] = "Detail Kriteria";


    return view('admin/nilai/detail_nilai_siswa', $data);
  }

  public function edit_nilai_siswa($id)
  {


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
      if (isset($data['nilai_siswa']) && !empty($data['nilai_siswa'])) {
        return view('admin/nilai/edit_nilai_siswa', $data);
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
