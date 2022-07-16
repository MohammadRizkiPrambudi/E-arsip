<?php

namespace App\Controllers;

use App\Models\ArsipModel;
use \Hermawan\DataTables\DataTable;
use App\Models\DepartemenModel;
use App\Models\KategoriModel;

class Arsip extends BaseController
{
    public function __construct()
    {
        $this->ArsipModel = new ArsipModel();
        $this->KategoriModel = new KategoriModel();
        $this->DepartemenModel = new DepartemenModel();
    }
    public function index()
    {
        $data = [
            "title" => 'Arsip',
            "arsip" => $this->ArsipModel->tampil()
        ];
        return view('admin/arsip', $data);
    }
    public function list_arsip()
    {
        if ($this->request->isAJAX()) {
            $db = \Config\Database::connect();
            $builder = $db->table('tbl_arsip')
                ->select('id_arsip,no_arsip,nama_arsip,deskripsi,tgl_upload, file_arsip,tbl_kategori.nama_kategori,tbl_dep.nama_dep, tbl_user.nama_user ')
                ->join('tbl_kategori', 'tbl_kategori.id_kategori=tbl_arsip.id_kategori')
                ->join('tbl_dep', 'tbl_dep.id_dep = tbl_arsip.id_dep')
                ->join('tbl_user', 'tbl_user.id_user = tbl_arsip.id_user');
            return DataTable::of($builder)
                ->addNumbering('no')
                ->add('view', function ($row) {
                    return '<center><a href="/Arsip/view/' . $row->id_arsip . '"><i class="fas fa-file-pdf text-danger fa-lg"></i></a>';
                })
                ->add('aksi', function ($row) {
                    return '<a href="/Arsip/ubah/' . $row->id_arsip . '" class="btn btn-warning btn-sm mb-1"><i class="fas fa-edit"></i></a> <button type="button" class="btn btn-danger btn-sm" data-target="#hapusarsip' . $row->id_arsip . '" data-toggle="modal"><i class="fas fa-trash"></i></button>';
                })
                ->toJson(true);
        }
    }
    public function tambah()
    {
        $data = [
            'title' => 'Tambah Arsip',
            'departemen' => $this->DepartemenModel->tampil(),
            "kategori" => $this->KategoriModel->tampil(),
            'validasi' => \Config\Services::validation()
        ];
        return view('admin/tambah_arsip', $data);
    }

    public function simpan()
    {
        if (!$this->validate([
            'no_arsip' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'No Arsip Tidak Boleh Kosong',
                ]
            ],
            'id_kategori' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kategori Tidak Boleh Kosong'
                ]
            ],
            'nama_arsip' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Arsip Tidak Boleh Kosong',
                ]
            ],
            'deskripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Deskripsi Tidak Boleh Kosong'
                ]
            ],
            'file_arsip' => [
                'rules' => 'max_size[file_arsip,2048]|ext_in[file_arsip,pdf]|uploaded[file_arsip]',
                'errors' => [
                    'max_size' => 'File Arsip Tidak Boleh Lebih Dari 2 MB',
                    'ext_in' => 'Hanya Boleh .PDF',
                    'uploaded' => 'File Arsip Harus Diisi'
                ]
            ]
        ])) {
            return redirect()->to(base_url('Arsip/tambah'))->withInput();
        }
        $file = $this->request->getFile('file_arsip');
        $file->move('assets/arsip');
        $namafile = $file->getName();

        $data = [
            'id_kategori' => $this->request->getVar('id_kategori'),
            'no_arsip' => $this->request->getVar('no_arsip'),
            'nama_arsip' => $this->request->getVar('nama_arsip'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'tgl_upload' => date('Y-m-d'),
            'tgl_update' => date('Y-m-d'),
            'file_arsip' => $namafile,
            'id_dep' => session()->get('id_dep'),
            'id_user' => session()->get('id_user'),

        ];
        $this->ArsipModel->simpan($data);
        session()->setFlashdata('pesan', 'Data Arsip Berhasil Ditambahkan');
        return redirect()->to(base_url('Arsip'));
    }
    public function ubah($id_arsip)
    {
        $data = [
            'title' => 'Ubah Data Arsip',
            'validasi' => \Config\Services::validation(),
            'kategori' => $this->KategoriModel->tampil(),
            'arsip' => $this->ArsipModel->detail_data($id_arsip)
        ];
        return view('admin/edit_arsip', $data);
    }
    public function edit($id_arsip)
    {
        if (!$this->validate([
            'no_arsip' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'No Arsip Tidak Boleh Kosong',
                ]
            ],
            'id_kategori' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kategori Tidak Boleh Kosong'
                ]
            ],
            'nama_arsip' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Arsip Tidak Boleh Kosong',
                ]
            ],
            'deskripsi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Deskripsi Tidak Boleh Kosong'
                ]
            ],
            'file_arsip' => [
                'rules' => 'max_size[file_arsip,2048]|ext_in[file_arsip,pdf]',
                'errors' => [
                    'max_size' => 'File Arsip Tidak Boleh Lebih Dari 2 MB',
                    'ext_in' => 'Hanya Boleh .PDF'
                ]
            ]
        ])) {
            return redirect()->to(base_url('Arsip/ubah/' . $this->request->getVar('id_arsip')))->withInput();
        }
        $file = $this->request->getFile('file_arsip');
        if ($file->getError() == 4) {
            $data = [
                'id_arsip' => $id_arsip,
                'id_kategori' => $this->request->getVar('id_kategori'),
                'no_arsip' => $this->request->getVar('no_arsip'),
                'nama_arsip' => $this->request->getVar('nama_arsip'),
                'deskripsi' => $this->request->getVar('deskripsi'),
                'id_dep' => session()->get('id_dep'),
                'id_user' => session()->get('id_user'),

            ];
        } else {
            $file->move('assets/arsip');
            $namafile = $file->getName();
            if ($this->request->getVar('file_arsiplama')) {
                unlink('assets/arsip/' . $this->request->getVar('file_arsiplama'));
            }
            $data = [
                'id_arsip' => $id_arsip,
                'id_kategori' => $this->request->getVar('id_kategori'),
                'no_arsip' => $this->request->getVar('no_arsip'),
                'nama_arsip' => $this->request->getVar('nama_arsip'),
                'deskripsi' => $this->request->getVar('deskripsi'),
                'file_arsip' => $namafile,
                'id_dep' => session()->get('id_dep'),
                'id_user' => session()->get('id_user'),
            ];
        }

        $this->ArsipModel->edit($data);
        session()->setFlashdata('pesan', 'Data Arsip Berhasil Diedit');
        return redirect()->to(base_url('Arsip'));
    }
    public function hapus($id_arsip)
    {
        $data = [
            'id_arsip' => $id_arsip
        ];
        $arsip = $this->ArsipModel->detail_data($id_arsip);
        if ($arsip['file_arsip']) {
            unlink('assets/arsip/' . $arsip['file_arsip']);
        }
        $this->ArsipModel->hapus($data);
        session()->setFlashdata('pesan', 'Data Arsip Berhasil Dihapus');
        return redirect()->to(base_url('Arsip'));
    }
    public function view($id_arsip)
    {
        $data = [
            'title' => 'View Arsip',
            'arsip' => $this->ArsipModel->detail_data($id_arsip)
        ];

        return view('admin/view_arsip', $data);
    }
}
