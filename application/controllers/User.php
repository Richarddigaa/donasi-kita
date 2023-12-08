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
        $data['title'] = 'Detail Donasi | Donasi Kita';
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

}