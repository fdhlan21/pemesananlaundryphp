<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengaturan extends CI_Controller
{

    function __construct()
    {

        parent::__construct();
    }

    public function index()

    {
        $data['title'] = 'SPP - Pengaturan';
        $data['admin'] = $this->db->get_where('admin', ['username' =>
        $this->session->userdata('username')])->row_array();


        $this->load->view('templates/header', $data);
        $this->load->view('topbar', $data);
        $this->load->view('page/pengaturan/pengaturan', $data);
        $this->load->view('templates/footer');
    }

    public function pengaturanweb() {
   
        $data['title'] = 'SPP - Ubah Pengaturan';
        $data['admin'] = $this->db->get_where('admin', ['username' =>
        $this->session->userdata('username')])->row_array();


        $this->load->view('templates/header', $data);
        // $this->load->view('topbar', $data);
        $this->load->view('page/pengaturan/pengaturanwebsite', $data);
        $this->load->view('templates/footer');
    
    }
}
