<?php

namespace App\Controllers;

use App\Models\KategoriModel;
use \Hermawan\DataTables\DataTable;

class Kategori extends BaseController
{
    public function __construct()
    {
        $this->KategoriModel = new KategoriModel();
    }
    public function index()
    {
        $data = [
            "title" => 'Kategori',
            'kategori' => $this->KategoriModel->tampil()
        ];
        return view('admin/kategori', $data);
    }

    public function list_kategori()
    {
        if ($this->request->isAJAX()) {
            $db = \Config\Database::connect();
            $builder = $db->table('tbl_kategori')->select('id_kategori, nama_kategori');
            return DataTable::of($builder)
                ->addNumbering('no')
                ->add('aksi', function ($row) {
                    return '<button type="button" class="btn btn-warning btn-sm" data-target="#editkategori' . $row->id_kategori . '" data-toggle="modal"><i class="fas fa-edit"></i></button> <button type="button" class="btn btn-danger btn-sm" data-target="#hapuskategori' . $row->id_kategori . '" data-toggle="modal"><i class="fas fa-trash"></i></button>';
                })
                ->toJson(true);
        }
    }

    public function tambah()
    {
        $data = [
            "nama_kategori" => $this->request->getVar('nama_kategori')
        ];
        $this->KategoriModel->tambah($data);
        session()->setFlashdata('pesan', 'Data kategori berhasil ditambahkan');
        return redirect()->to(base_url('Kategori'));
    }

    public function edit()
    {
        $data = [
            'id_kategori' => $this->request->getVar('id_kategori'),
            "nama_kategori" => $this->request->getVar('nama_kategori')
        ];
        $this->KategoriModel->edit($data);
        session()->setFlashdata('pesan', 'Data kategori berhasil di edit');
        return redirect()->to(base_url('Kategori'));
    }

    public function hapus($id_kategori)
    {
        $data = [
            'id_kategori' => $id_kategori
        ];
        $this->KategoriModel->hapus($data);
        session()->setFlashdata('pesan', 'Data kategori berhasil di hapus');
        return redirect()->to(base_url('Kategori'));
    }
}
