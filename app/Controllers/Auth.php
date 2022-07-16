<?php

namespace App\Controllers;

use App\Models\AuthModel;

class Auth extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->AuthModel = new AuthModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Login',
            'validasi' => \Config\Services::validation()
        ];
        return view('auth/index', $data);
    }

    public function login()
    {
        if ($this->validate([
            'email' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Email harus di isi'
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password harus di isi'
                ]
            ]
        ])) {
            // jika valid
            $email = $this->request->getVar('email');
            $password = $this->request->getVar('password');
            $cek = $this->AuthModel->login($email, $password);
            if ($cek) {
                session()->set('login', true);
                session()->set('nama_user', $cek['nama_user']);
                session()->set('level', $cek['level']);
                session()->set('foto_user', $cek['foto_user']);
                session()->set('id_dep', $cek['id_dep']);
                session()->set('id_user', $cek['id_user']);
                // to('namacontroller/namafunction')
                return redirect()->to(base_url('Home/index'));
            } else {
                session()->setFlashdata('pesan', 'Username atau password anda salah');
                return redirect()->to(base_url('Auth/index'));
            }
        } else {
            // jika belum valid
            return redirect()->to(base_url('Auth/index'))->withInput();
        }
    }

    public function logout()
    {
        session()->remove('login');
        session()->remove('nama_user');
        session()->remove('level');
        session()->remove('foto_user');
        session()->setFlashdata('pesan', 'Anda berhasil logout');
        return redirect()->to(base_url('Auth/index'));
    }
}
