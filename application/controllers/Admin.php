<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function index(){
        $data['title'] = 'Dashboard | Admin Donasi Kita';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function kategori(){
        $data['title'] = 'Kategori | Admin Donasi Kita';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();

        $data['kategori'] = $this->db->get('kategori')->result_array();

        $this->form_validation->set_rules('kategori', 'Kategori', 'required|min_length[3]', 
                                        ['required' => 'Nama kategori harus diisi', 'min_length' => 'Nama Kategori terlalu pendek']);
        
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/kategori', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('kategori', ['kategori' => $this->input->post('kategori')]);
            $this->session->set_flashdata('pesan', 
                                    '<div class="alert alert-success alert-message" role="alert">Menu berhasil ditambahkan</div>
                                    <meta http-equiv="refresh" content="2">');
            redirect('admin/kategori');
        }
    }

    public function edit_kategori($id){
		$data['title'] = 'Edit Kategori | Admin Donasi Kita';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();

		$data['data'] = $this->ModelAdmin->getrow(array('id' => $id), 'kategori');

		$this->form_validation->set_rules('kategori', 'kategori', 'required', ['required'	=>	'Nama kategori tidak boleh kosong']);
        
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/edit-kategori', $data);
            $this->load->view('templates/footer');
		} else {
			$simpan = ['kategori' => $this->input->post('kategori')];
			$this->db->where('id', $id);
			$this->db->update('kategori', $simpan);
			$this->session->set_flashdata('pesan', 
                                    '<div class="alert alert-success alert-message" role="alert">Kategori berhasil diupdate</div>
                                    <meta http-equiv="refresh" content="2">');
			redirect('admin/kategori');
		}
	}

    public function hapus_kategori($id){
		$this->ModelAdmin->hapus_kategori($id);
		$this->session->set_flashdata('pesan', 
                                    '<div class="alert alert-success alert-message" role="alert">Kategori berhasil dihapus</div>
                                    <meta http-equiv="refresh" content="2">');
		redirect('admin/kategori');
	}
}