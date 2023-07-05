<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\SiswaModel;

class SiswaController extends BaseController
{
    protected $Siswa;
    public function __construct()
    {
      $this->Siswa = new SiswaModel();
    }
    
    public function index()
    {
      return view('siswa/index');
    }
  
    public function delete($id)
    {
      $hapus = $this->Siswa->hapus_siswa($id);
  
      if ($hapus) {
        session()->setFlashdata('warning', 'Hapus Data Siswa Berhasil');
        return redirect()->to('/SiswaController/index');
      }
    }
  
    public function create()
    {
      $data = [
        'title' => 'Tambah data',
      ];
      return view('siswa/create', $data);
    }
  
    public function store()
    {
      $nama_siswa = $this->request->getPost('nama_siswa');
      $nis = $this->request->getPost('nis');
      $kelas = $this->request->getPost('kelas');
  
      $data = [
        'nama_siswa' => $nama_siswa,
        'nis' => $nis,
        'kelas' => $kelas
      ];
  
      $simpan = $this->Siswa->tambah_siswa($data);
  
      if ($simpan) {
        session()->setFlashdata('success', 'Tambah Data Berhasil');
  
        return redirect()->to('/SiswaController/index');
      }
    }
  
    public function edit($id)
    {
      $data = [
        'title' => 'Edit siswa',
        'siswa' => $this->Siswa->getsiswa($id)
      ];
      return view('siswa/edit', $data);
    }
  
    public function update($id)
    {
      $nama_siswa = $this->request->getPost('nama_siswa');
      $nis = $this->request->getPost('nis');
      $kelas = $this->request->getPost('kelas');
  
      $data = [
        'nama_siswa' => $nama_siswa,
        'nis' => $nis,
        'kelas' => $kelas
      ];
  
      $ubah = $this->Siswa->ubah_siswa($data, $id);
  
      if ($ubah) {
        session()->setFlashdata('info', 'Ubah siswa Berhasil');
        return redirect()->to('/SiswaController/index');
      }
    }
}
