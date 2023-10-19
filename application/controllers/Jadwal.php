<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal extends CI_Controller
{

	function __construct(){

		parent::__construct();
    }
    public function index()
    {
        $data['title'] = 'KING FC - Jadwal Main Bola';
        $data['memberadmin'] = $this->db->get_where('memberadmin', ['username' =>
        $this->session->userdata('username')])->row_array();

        // Cek role_id pengguna
        if ($data['memberadmin']['role_id'] == 1) {
            // Jika role_id adalah 1 (admin), tampilkan view admin
            $this->load->view('templates/header', $data);
            $this->load->view('topbar', $data);
            $this->load->view('page/jadwal/jadwalbola', $data);
            $this->load->view('templates/footer');
        } elseif ($data['memberadmin']['role_id'] == 2) {
            // Jika role_id adalah 2 (user), tampilkan view user
            $this->load->view('templates/header', $data);
            $this->load->view('topbar', $data);
            $this->load->view('page/jadwal/jadwalbola', $data);
            $this->load->view('templates/footer');
        } else {
            // Jika role_id tidak valid, tampilkan pesan error
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/error', $data);
            $this->load->view('templates/footer');
        }

     
    }


        public function edit() {

        $data['title'] = 'KING FC - Edit Jadwal';
        $data['memberadmin'] = $this->db->get_where('memberadmin', ['username' =>
        $this->session->userdata('username')])->row_array();


        $this->load->view('templates/header', $data);
        // $this->load->view('topbar', $data);
        $this->load->view('page/jadwal/edit', $data);
        $this->load->view('templates/footer');
        }


}
