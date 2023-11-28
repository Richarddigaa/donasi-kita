<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelAdmin extends CI_Model {

    public function hapus_kategori($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('kategori');
	}

	public function getrow($where, $tabel)
	{
		$this->db->from($tabel);
		$this->db->where($where);
		return $this->db->get()->row();
	}
}