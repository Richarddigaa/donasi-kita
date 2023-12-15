<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function index(){
        $data['title'] = 'Dashboard | Admin Donasi Kita';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();

        $data['totalDonasi'] = $this->db->get('donasi')->num_rows();
		$data['totalKategori'] = $this->db->get('kategori')->num_rows();
        $data['totalPembayaran'] = $this->db->get('pembayaran')->num_rows();
        $data['totalRiwayat'] = $this->db->get('user_berdonasi')->num_rows();
        
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

		$data['data'] = $this->ModelAdmin->getrow(array('id_kategori' => $id), 'kategori');

		$this->form_validation->set_rules('kategori', 'Kategori', 'required|min_length[3]', 
                                        ['required' => 'Nama kategori harus diisi', 'min_length' => 'Nama Kategori terlalu pendek']);
        
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/edit-kategori', $data);
            $this->load->view('templates/footer');
		} else {
			$simpan = ['kategori' => $this->input->post('kategori')];
			$this->db->where('id_kategori', $id);
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

    public function donasi(){
		$data['title'] = 'Donasi | Admin Donasi Kita';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();

		$data['donasi'] = $this->db->get('donasi')->result_array();

        $data['kategori'] = $this->db->get('kategori')->result_array();

        $this->form_validation->set_rules('donasi', 'Judul Donasi', 'required|min_length[3]', [
            'required' => 'Judul Donasi harus diisi',
            'min_length' => 'Judul Donasi terlalu pendek'
        ]);
        $this->form_validation->set_rules('kategori', 'Kategori', 'required', [
            'required' => 'Kategori harus diisi',
        ]);
        $this->form_validation->set_rules('dana_dibutuhkan', 'Dana Yang Dibutuhkan', 'required', [
            'required' => 'Dana Yang Dibutuhkan harus diisi'
        ]);
        $this->form_validation->set_rules('detail', 'Detail', 'required|min_length[3]', [
            'required' => 'Detail harus diisi',
            'min_length' => 'Detail terlalu pendek'
        ]);
        //konfigurasi sebelum gambar diupload 
        $config['upload_path'] = './assets/img/upload/';
        $config['allowed_types'] = 'jpg|png|jpeg';

        $this->load->library('upload', $config);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/donasi', $data);
            $this->load->view('templates/footer');
        } else {
            if (!$this->upload->do_upload('gambar')) {
                echo "Gagal upload gambar";
            } else {
                $gambar = $this->upload->data();
                $img = $gambar['file_name'];

                $data = [
                    'judul' => $this->input->post('donasi', true),
                    'id_kategori' => $this->input->post('kategori', true),
                    'dana_dibutuhkan' => $this->input->post('dana_dibutuhkan', true),
                    'detail' => $this->input->post('detail', true),
                    'dana_terkumpul' => 0,
                    'gambar' => $img
                ];
                $this->ModelAdmin->simpanDonasi($data);
                $this->session->set_flashdata('pesan', 
                                    '<div class="alert alert-success alert-message" role="alert">Donasi berhasil ditambahkan</div>
                                    <meta http-equiv="refresh" content="2">');
                redirect('admin/donasi');
            }
        }
	}

    public function hapusDonasi($id)
    {
        $this->ModelAdmin->hapusDonasi($id);
        $this->session->set_flashdata('pesan', 
                                    '<div class="alert alert-success alert-message" role="alert">Donasi berhasil dihapus</div>
                                    <meta http-equiv="refresh" content="2">');
        redirect('admin/donasi');
    }

    public function ubahDonasi(){
		$data['title'] = 'Ubah Donasi | Admin Donasi Kita';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();

        $data['donasi'] = $this->ModelAdmin->donasiWhere(['id' => $this->uri->segment(3)])->result_array();

        $data['kategori'] = $this->db->get('kategori')->result_array();

        $this->form_validation->set_rules('donasi', 'Judul Donasi', 'required|min_length[3]', [
            'required' => 'Judul Donasi harus diisi',
            'min_length' => 'Judul Donasi terlalu pendek'
        ]);
        $this->form_validation->set_rules('kategori', 'Kategori', 'required', [
            'required' => 'Kategori harus diisi',
        ]);
        $this->form_validation->set_rules('dana_dibutuhkan', 'Dana Yang Dibutuhkan', 'required', [
            'required' => 'Dana Yang Dibutuhkan harus diisi'
        ]);
        $this->form_validation->set_rules('dana_terkumpul', 'Dana Yang Terkumpul', 'required', [
            'required' => 'Dana Yang Terkumpul harus diisi'
        ]);
        $this->form_validation->set_rules('detail', 'Detail', 'required|min_length[3]', [
            'required' => 'Detail harus diisi',
            'min_length' => 'Detail terlalu pendek'
        ]);
        //konfigurasi sebelum gambar diupload 
        $config['upload_path'] = './assets/img/upload/';
        $config['allowed_types'] = 'jpg|png|jpeg';

        $this->load->library('upload', $config);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/edit-donasi', $data);
            $this->load->view('templates/footer');
        } else {
            if ($this->upload->do_upload('gambar')) {
                $gambar = $this->upload->data();
                unlink('./assets/img/upload/' . $this->input->post('old_pict', TRUE));
                $img = $gambar['file_name'];
            } else {
                $img = $this->input->post('old_pict', TRUE);
            }
            $data = [
                'judul' => $this->input->post('donasi', true),
                'id_kategori' => $this->input->post('kategori', true),
                'dana_dibutuhkan' => $this->input->post('dana_dibutuhkan', true),
                'detail' => $this->input->post('detail', true),
                'dana_terkumpul' => $this->input->post('dana_terkumpul', true),
                'gambar' => $img
            ];
            $this->ModelAdmin->updateDonasi($data, ['id' => $this->input->post('id')]);
            $this->session->set_flashdata('pesan', 
                                '<div class="alert alert-success alert-message" role="alert">Donasi berhasil diubah</div>
                                <meta http-equiv="refresh" content="2">');
            redirect('admin/donasi');
        }
    }

    public function pembayaran(){
        $data['title'] = 'Metode Pembayaran | Admin Donasi Kita';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();

        $data['pembayaran'] = $this->db->get('pembayaran')->result_array();

        $this->form_validation->set_rules('pembayaran', 'Pembayaran', 'required|min_length[3]', 
                                        ['required' => 'Nama Pembayaran harus diisi', 'min_length' => 'Nama Pembayaran terlalu pendek']);

        $this->form_validation->set_rules('rekening', 'Rekening', 'required|min_length[3]', 
                                        ['required' => 'No Rekening harus diisi', 'min_length' => 'No Rekening terlalu pendek']);
        
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/pembayaran', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('pembayaran', [
                    'nama_pembayaran' => $this->input->post('pembayaran'),
                    'rekening' => $this->input->post('rekening')
            ]);
            $this->session->set_flashdata('pesan', 
                                    '<div class="alert alert-success alert-message" role="alert">Metode Pembayaran berhasil ditambahkan</div>
                                    <meta http-equiv="refresh" content="2">');
            redirect('admin/pembayaran');
        }
    }

    public function edit_pembayaran($id){
        $data['title'] = 'Ubah Metode Pembayaran | Admin Donasi Kita';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();

        $data['data'] = $this->ModelAdmin->getrow(array('id_pembayaran' => $id), 'pembayaran');

        $this->form_validation->set_rules('pembayaran', 'Pembayaran', 'required|min_length[3]', 
                                        ['required' => 'Nama Pembayaran harus diisi', 'min_length' => 'Nama Pembayaran terlalu pendek']);

        $this->form_validation->set_rules('rekening', 'Rekening', 'required|min_length[3]', 
                                        ['required' => 'No Rekening harus diisi', 'min_length' => 'No Rekening terlalu pendek']);
        
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/edit-pembayaran', $data);
            $this->load->view('templates/footer');
        } else {
            $simpan = [
                'nama_pembayaran' => $this->input->post('pembayaran'),
                'rekening' => $this->input->post('rekening')
            ];
			$this->db->where('id_pembayaran', $id);
			$this->db->update('pembayaran', $simpan);
			$this->session->set_flashdata('pesan', 
                                    '<div class="alert alert-success alert-message" role="alert">Metode Pembayaran berhasil diupdate</div>
                                    <meta http-equiv="refresh" content="2">');
			redirect('admin/pembayaran');
        }
    }

    public function riwayatDonasi(){
        $data['title'] = 'Riwayat Donasi | Admin Donasi Kita';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();

        $data['riwayatDonasi'] = $this->db->get('user_berdonasi')->result_array();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/riwayatDonasi', $data);
        $this->load->view('templates/footer');
    }

    public function profile(){
        $data['title'] = 'Profile Saya | Admin Donasi Kita';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/profile', $data);
        $this->load->view('templates/footer');
    }

    public function ubahProfile(){
        $data['title'] = 'Ubah Profile | Donasi Kita';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules(
            'nama',
            'Nama Lengkap',
            'required|trim',
            ['required' => 'Nama tidak Boleh Kosong']
        );
        
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/ubah-profile', $data);
            $this->load->view('templates/footer');
        } else {
            $nama = $this->input->post('nama', true);
            $email = $this->input->post('email', true);
            //jika ada gambar yang akan diupload 
            $config['upload_path'] = './assets/img/profile/';
            $config['allowed_types'] = 'jpeg|jpg|png';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $gambar_lama = $data['user']['gambar'];
                if ($gambar_lama != 'logo-donasi.png') {
                    unlink(FCPATH . 'assets/img/profile/' . $gambar_lama);
                }
                $gambar_baru = $this->upload->data('file_name');
                $this->db->set('gambar', $gambar_baru);
            } else {
                echo "gagal";
            }
            
            $this->db->set('nama', $nama);
            $this->db->where('email', $email);
            $this->db->update('user');
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Profil Berhasil diubah </div>
                                            <meta http-equiv="refresh" content="2">');
            redirect('admin/profile');
        }
    }
}