<?php

namespace App\Models;

use CodeIgniter\Model;

class ArsipModel extends Model
{
    public function tampil()
    {
        return $this->db->table('tbl_arsip')
            ->join('tbl_dep', 'tbl_dep.id_dep = tbl_arsip.id_dep', 'left')
            ->join('tbl_kategori', 'tbl_kategori.id_kategori=tbl_arsip.id_kategori', 'left')
            ->join('tbl_user', 'tbl_user.id_user = tbl_arsip.id_user', 'left')
            ->get()->getResultArray();
    }
    public function simpan($data)
    {
        return $this->db->table('tbl_arsip')->insert($data);
    }
    public function detail_data($id_arsip)
    {
        return $this->db->table('tbl_arsip')
            ->join('tbl_dep', 'tbl_dep.id_dep = tbl_arsip.id_dep', 'left')
            ->join('tbl_kategori', 'tbl_kategori.id_kategori=tbl_arsip.id_kategori', 'left')
            ->join('tbl_user', 'tbl_user.id_user = tbl_arsip.id_user', 'left')
            ->where('id_arsip', $id_arsip)->get()->getRowArray();
    }
    public function edit($data)
    {
        return $this->db->table('tbl_arsip')->where('id_arsip', $data['id_arsip'])->update($data);
    }

    public function hapus($data)
    {
        return $this->db->table('tbl_arsip')->where('id_arsip', $data['id_arsip'])->delete($data);
    }
}
