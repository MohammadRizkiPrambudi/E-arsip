<?php

namespace App\Controllers;

use \App\Models\HomeModel;

class Home extends BaseController
{
    public function __construct()
    {
        $this->HomeModel = new HomeModel();
    }
    public function index()
    {
        $data = [
            'kategori' => $this->HomeModel->total_kategori(),
            'user' => $this->HomeModel->total_user(),
            'dep' => $this->HomeModel->total_dep(),
            'arsip' => $this->HomeModel->total_arsip(),
            "title" => 'Home'
        ];
        return view('admin/index', $data);
    }
}
