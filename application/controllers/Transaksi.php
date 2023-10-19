<?php
defined('BASEPATH') or exit('No direct script access allowed');
// require_once APPPATH . 'third_party/tcpdf/tcpdf.php';
use Dompdf\Dompdf;
use Dompdf\Options;


class Transaksi extends CI_Controller
{


    function __construct()
    {

        parent::__construct();
    }
    public function index()
    {
        $data['title'] = 'SPP - Transaksi';
        $data['admin'] = $this->db->get_where('admin', ['username' =>
        $this->session->userdata('username')])->row_array();

        // Cek role_id pengguna
        if ($data['admin']['role_id'] == 1) {
            // Jika role_id adalah 1 (admin), tampilkan view admin
            $this->load->view('templates/header', $data);
            $this->load->view('topbar', $data);
            $this->load->view('page/transaksi/transaksi', $data);
            $this->load->view('templates/footer');
        } elseif ($data['admin']['role_id'] == 2) {
            // Jika role_id adalah 2 (user), tampilkan view user
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('page/transaksi/transaksi.php', $data);
            $this->load->view('templates/footer');
        } else {
            // Jika role_id tidak valid, tampilkan pesan error
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/error', $data);
            $this->load->view('templates/footer');
        }
    }

    public function ubah()
    {
        $data['title'] = 'SPP - Ubah Data Transaksi';
        $data['admin'] = $this->db->get_where('admin', ['username' =>
        $this->session->userdata('username')])->row_array();


        $this->load->view('templates/header', $data);
        // $this->load->view('topbar', $data);
        $this->load->view('page/transaksi/edittransaksi', $data);
        $this->load->view('templates/footer');
    }

   
    public function add()
    {
        $data['title'] = 'SPP - Tambah Transaksi';
        $data['admin'] = $this->db->get_where('admin', ['username' =>
        $this->session->userdata('username')])->row_array();
        $data['options'] = $this->db->get('siswa')->result_array();
        $data['input'] = $this->db->get('siswa')->result_array();


        $this->load->view('templates/header', $data);
        // $this->load->view('topbar', $data);
        $this->load->view('page/transaksi/tambah', $data);
        $this->load->view('templates/footer');
    }


    public function info()
    {
        $data['title'] = 'BESTI - Tambah Slider';
        $data['admin'] = $this->db->get_where('admin', ['username' =>
        $this->session->userdata('username')])->row_array();
        // Ambil view PDF
        $this->load->view('page/transaksi/infotransaksi', $data);

  
}


    public function cetak()
    {
        $data['title'] = 'SPP - Cetak Transaksi';
        $data['admin'] = $this->db->get_where('admin', ['username' =>
        $this->session->userdata('username')])->row_array();


        $this->load->view('templates/header', $data);
        // $this->load->view('topbar', $data);
        $this->load->view('page/transaksi/cetak', $data);
        $this->load->view('templates/footer');
    }

   
}