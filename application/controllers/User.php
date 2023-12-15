<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function index(){
        $data['title'] = 'Home | Donasi Kita';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();

        $data['donasi'] = $this->db->get('donasi')->result_array();
        
        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_navbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/user_footer');
    }

    public function donasi(){
        $data['title'] = 'Bantu Mereka | Donasi Kita';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();

        $data['kategori'] = $this->db->get('kategori')->result_array();

        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_navbar', $data);
        $this->load->view('user/donasi', $data);
        $this->load->view('templates/user_footer');
    }

    public function detailDonasi(){
        $data['title'] = 'Detail Donasi | Donasi Kita';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();

        $data['donasi'] = $this->ModelAdmin->donasiWhere(['id' => $this->uri->segment(3)])->result_array();
        
        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_navbar', $data);
        $this->load->view('user/detailDonasi', $data);
        $this->load->view('templates/user_footer');
    }

    public function riwayatDonasi(){
        $data['title'] = 'Detail Donasi | Donasi Kita';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();

        $data['user_berdonasi'] = $this->db->get('user_berdonasi')->result_array();
        
        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_navbar', $data);
        $this->load->view('user/riwayatDonasi', $data);
        $this->load->view('templates/user_footer');
    }

    public function berdonasi(){
        $data['title'] = 'Detail Donasi | Donasi Kita';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();

        $data['donasi'] = $this->ModelAdmin->donasiWhere(['id' => $this->uri->segment(3)])->result_array();

        $data['pembayaran'] = $this->db->get('pembayaran')->result_array();

        $this->form_validation->set_rules('dana', 'Dana Yang Akan Didonasikan', 'required|min_length[4]', 
                                        ['required' => 'Dana Yang Akan Didonasikan harus diisi', 'min_length' => 'Dana Yang Akan Didonasikan Minimal Rp. 1.000']);

        $this->form_validation->set_rules('pembayaran', 'Metode Pembayaran', 'required', 
                                        ['required' => 'Silahkan Pilih Metode Pembayaran']);

        //konfigurasi sebelum gambar diupload 
        $config['upload_path'] = './assets/img/bukti-transfer/';
        $config['allowed_types'] = 'jpg|png|jpeg';

        $this->load->library('upload', $config);
        
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/user_navbar', $data);
            $this->load->view('user/berdonasi', $data);
            $this->load->view('templates/user_footer');
        } else {
            if (!$this->upload->do_upload('gambar')) {
                $this->session->set_flashdata('pesan', 
                                    '<div class="alert alert-danger alert-message" role="alert">Silahkan Upload Bukti Transfer Dahulu</div>
                                    <meta http-equiv="refresh" content="4">');
                redirect('user/donasi');
            } else {
                $gambar = $this->upload->data();
                $img = $gambar['file_name'];

                $data = [
                    'id_user' => $this->input->post('id_user', true),
                    'id_donasi' => $this->input->post('id_donasi', true),
                    'id_pembayaran' => $this->input->post('pembayaran', true),
                    'dana_didonasikan' => $this->input->post('dana', true),
                    'tanggal_donasi' => time(),
                    'bukti' => $img
                ];
                $this->ModelUser->simpanBerdonasi($data);
                $this->session->set_flashdata('pesan', 
                                    '<div class="alert alert-success alert-message" role="alert">Yeay Kamu Berhasil Membantu Mereka Yang Membutuhkan</div>
                                    <meta http-equiv="refresh" content="4">');
                redirect('user/donasi');
            }
        }
    }

    public function profile(){
        $data['title'] = 'Profile Saya | Donasi Kita';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        
        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_navbar', $data);
        $this->load->view('user/profile', $data);
        $this->load->view('templates/user_footer');
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
            $this->load->view('templates/user_header', $data);
            $this->load->view('templates/user_navbar', $data);
            $this->load->view('user/ubahProfile', $data);
            $this->load->view('templates/user_footer');
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
            redirect('user/profile');
        }
    }

    public function tentangKami(){
        $data['title'] = 'Tentang Kami | Donasi Kita';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        
        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_navbar', $data);
        $this->load->view('user/tentangKami', $data);
        $this->load->view('templates/user_footer');
    }
}