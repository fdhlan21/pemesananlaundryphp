<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Useradmin extends CI_Controller
{

	function __construct(){

		parent::__construct();
    }

    public function index()
    {
        $data['title'] = 'SPP - Admin';
        $data['admin'] = $this->db->get_where('admin', ['username' =>
        $this->session->userdata('username')])->row_array();

        // Cek role_id pengguna
        if ($data['admin']['role_id'] == 1) {
            // Jika role_id adalah 1 (admin), tampilkan view admin
            $this->load->view('templates/header', $data);
            $this->load->view('topbar', $data);
            $this->load->view('page/useradmin/useradmin', $data);
            $this->load->view('templates/footer');
        } elseif ($data['admin']['role_id'] == 2) {
            // Jika role_id adalah 2 (user), tampilkan view user
            $this->load->view('templates/header', $data);
            $this->load->view('topbar', $data);
            $this->load->view('page/useradmin/useradmin', $data);
            $this->load->view('templates/footer');
        } else {
            // Jika role_id tidak valid, tampilkan pesan error
            $this->load->view('templates/header', $data);
            $this->load->view('topbar', $data);
            $this->load->view('admin/error', $data);
            $this->load->view('templates/footer');
        }
    }


    public function add()

    {
        $data['title'] = 'SPP - Tambah Admin';
        $data['admin'] = $this->db->get_where('admin', ['username' =>
        $this->session->userdata('username')])->row_array();


        $this->load->view('templates/header', $data);
        // $this->load->view('topbar', $data);
        $this->load->view('page/useradmin/tambah-admin', $data);
        $this->load->view('templates/footer');
    }


    public function edit()


    {
        $data['title'] = 'SPP - Ubah Data Admin';
        $data['admin'] = $this->db->get_where('admin', ['username' =>
        $this->session->userdata('username')])->row_array();


        $this->load->view('templates/header', $data);
        
        $this->load->view('page/useradmin/ubah-admin', $data);
        $this->load->view('templates/footer');
    }

    public function detail()

    {
        $data['title'] = 'SPP - Detail  Admin';
        $data['admin'] = $this->db->get_where('admin', ['username' =>
        $this->session->userdata('username')])->row_array();


        $this->load->view('templates/header', $data);
        // $this->load->view('topbar', $data);
        $this->load->view('page/useradmin/detail-useradmin.php', $data);
        $this->load->view('templates/footer');
    }
}
