<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelAdmin extends CI_Model {

	public function simpanDonasi($data = null)
    {
        $this->db->insert('donasi', $data);
    }

    public function hapus_kategori($id)
	{
		$this->db->where('id_kategori', $id);
		$this->db->delete('kategori');
	}

	public function getrow($where, $tabel)
	{
		$this->db->from($tabel);
		$this->db->where($where);
		return $this->db->get()->row();
	}

	public function hapusDonasi($id)
    {
        $this->db->where('id', $id);
		$this->db->delete('donasi');
    }

	public function donasiWhere($where)
    {
        return $this->db->get_where('donasi', $where);
    }

	public function updateDonasi($data = null, $where = null)
    {
        $this->db->update('donasi', $data, $where);
    }

	public function berdonasiWhere($where)
    {
        return $this->db->get_where('user_berdonasi', $where);
    }
}