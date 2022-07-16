<?php

namespace App\Models;

use CodeIgniter\Model;

class DepartemenModel extends Model
{
    public function tampil()
    {
        return $this->db->table('tbl_dep')->get()->getResultArray();
    }

    public function tambah($data)
    {
        return $this->db->table('tbl_dep')->insert($data);
    }
    public function edit($data)
    {
        return $this->db->table('tbl_dep')->where('id_dep', $data['id_dep'])->update($data);
    }

    public function hapus($data)
    {
        return $this->db->table('tbl_dep')->where('id_dep', $data['id_dep'])->delete($data);
    }
}
