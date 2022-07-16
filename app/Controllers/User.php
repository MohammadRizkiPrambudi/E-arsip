<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Validation\Rules;
use App\Models\DepartemenModel;
use Config\Validation;


class User extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->UserModel = new UserModel();
        $this->DepartemenModel = new DepartemenModel();
    }
    public function index()
    {
        $data = [
            "title" => 'User',
            "user" => $this->UserModel->tampil()
        ];
        return view('admin/user', $data);
    }
    public function tambah()
    {
        $data = [
            "title" => 'Tambah User',
            "validasi" => \Config\Services::validation(),
            "departemen" => $this->DepartemenModel->tampil()
        ];
        return view('admin/tambah_user', $data);
    }

    public function simpan()
    {
        if (!$this->validate([
            'nama_user' => [
                'rules' => 'required|is_unique[tbl_user.nama_user]',
                'errors' => [
                    'required' => 'Nama User Tidak Boleh Kosong',
                    'is_unique' => 'Nama User Sudah Terdaftar'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[tbl_user.email]',
                'errors' => [
                    'required' => 'Email Tidak Boleh Kosong',
                    'valid_email' => 'Email Anda Tidak Benar',
                    'is_unique' => 'Email Sudah Terdaftar'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => 'Password Tidak Boleh Kosong',
                    'min_length' => 'Password Minimal 5 Huruf'
                ]
            ],
            'level' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Level Tidak Boleh Kosong'
                ]
            ],
            'foto_user' => [
                'rules' => 'max_size[foto_user,1024]|is_image[foto_user]|mime_in[foto_user, image/jpg,image/png,image/jpeg]',
                'errors' => [
                    'max_size' => 'Foto User Tidak Boleh Lebih Dari 1 MB',
                    'is_image' => 'Hanya Boleh Gambar',
                    'foto' => 'Hanya Boleh Gambar'
                ]
            ],
            'id_dep' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Departemen Tidak Boleh Kosong'
                ]
            ]
        ])) {
            return redirect()->to(base_url('User/tambah'))->withInput();
        }
        $file = $this->request->getFile('foto_user');
        if ($file->getError() == 4) {
            $namafile = 'default.png';
        } else {
            $file->move('assets/dist/img');
            $namafile = $file->getName();
        }
        $data = [
            'nama_user' => $this->request->getVar('nama_user'),
            'email' => $this->request->getVar('email'),
            'password' => $this->request->getVar('password'),
            'level' => $this->request->getVar('level'),
            'foto_user' => $namafile,
            'id_dep' => $this->request->getVar('id_dep')
        ];

        $this->UserModel->simpan($data);
        session()->setFlashdata('pesan', 'Data User Berhasil Ditambahkan');
        return redirect()->to(base_url('User'));
    }
    public function ubah($id_user)
    {
        $data = [
            "title" => 'Edit User',
            "departemen" => $this->DepartemenModel->tampil(),
            "user" => $this->UserModel->detail_data($id_user),
            "validasi" => \Config\Services::validation(),
        ];
        return view('admin/edit_user', $data);
    }
    public function edit($id_user)
    {
        if (!$this->validate([
            'nama_user' => [
                'rules' => 'required|is_unique[tbl_user.nama_user, id_user, ' . $id_user . ']',
                'errors' => [
                    'required' => 'Nama User Tidak Boleh Kosong',
                    'is_unique' => 'Nama User Sudah Terdaftar'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[tbl_user.email, id_user, ' . $id_user . ']',
                'errors' => [
                    'required' => 'Email Tidak Boleh Kosong',
                    'valid_email' => 'Email Anda Tidak Benar',
                    'is_unique' => 'Email Sudah Terdaftar'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => 'Password Tidak Boleh Kosong',
                    'min_length' => 'Password Minimal 5 Huruf'
                ]
            ],
            'level' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Level Tidak Boleh Kosong'
                ]
            ],
            'foto_user' => [
                'rules' => 'max_size[foto_user,1024]|is_image[foto_user]|mime_in[foto_user, image/jpg,image/png,image/jpeg]',
                'errors' => [
                    'max_size' => 'Foto User Tidak Boleh Lebih Dari 1 MB',
                    'is_image' => 'Hanya Boleh Gambar',
                    'foto' => 'Hanya Boleh Gambar'
                ]
            ],
            'id_dep' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Departemen Tidak Boleh Kosong'
                ]
            ]
        ])) {
            return redirect()->to(base_url('User/ubah/' . $this->request->getVar('id_user')))->withInput();
        }
        $file = $this->request->getFile('foto_user');
        if ($file->getError() == 4) {
            $namafile = $this->request->getVar('fotolama');
        } else {
            $file->move('assets/dist/img');
            $namafile = $file->getName();
            if ($this->request->getVar('fotolama') != 'default.png') {
                unlink('assets/dist/img/' . $this->request->getVar('fotolama'));
            }
        }
        $data = [

            'id_user' => $this->request->getVar('id_user'),
            'nama_user' => $this->request->getVar('nama_user'),
            'password' => $this->request->getVar('password'),
            'level' => $this->request->getVar('level'),
            'foto_user' => $namafile,
            'id_dep' => $this->request->getVar('id_dep'),
        ];
        $this->UserModel->edit($data);
        session()->setFlashdata('pesan', 'Data User Berhasil Diedit');
        return redirect()->to(base_url('User'));
    }

    public function hapus($id_user)
    {
        $data = [
            'id_user' => $id_user
        ];
        $user = $this->UserModel->detail_data($id_user);
        if ($user['foto_user'] != 'default.png') {
            unlink('assets/dist/img/' . $user['foto_user']);
        }
        $this->UserModel->hapus($data);
        session()->setFlashdata('pesan', 'Data User Berhasil Dihapus');
        return redirect()->to(base_url('User'));
    }
}
