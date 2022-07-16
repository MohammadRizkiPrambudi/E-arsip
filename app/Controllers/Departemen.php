<?php

namespace App\Controllers;

use App\Models\DepartemenModel;

class Departemen extends BaseController
{
    public function __construct()
    {
        $this->DepartemenModel = new DepartemenModel();
    }
    public function index()
    {
        $data = [
            "title" => 'Departemen',
            'departemen' => $this->DepartemenModel->tampil()
        ];
        return view('admin/departemen', $data);
    }

    public function tambah()
    {
        $data = [
            'nama_dep' => $this->request->getVar('nama_departemen')
        ];
        $this->DepartemenModel->tambah($data);
        session()->setFlashdata('pesan', 'Data Departemen Berhasil Ditambahakan');
        return redirect()->to(base_url('Departemen'));
    }

    public function edit()
    {
        $data = [
            'id_dep' => $this->request->getVar('id_dep'),
            'nama_dep' => $this->request->getVar('nama_departemen')
        ];
        $this->DepartemenModel->edit($data);
        session()->setFlashdata('pesan', 'Data Departemen Berhasil Diedit');
        return redirect()->to(base_url('Departemen'));
    }

    public function hapus()
    {
        $data = [
            'id_dep' => $this->request->getVar('id_dep'),
        ];
        $this->DepartemenModel->hapus($data);
        session()->setFlashdata('pesan', 'Data Departemen Berhasil Dihapus');
        return redirect()->to(base_url('Departemen'));
    }
}
