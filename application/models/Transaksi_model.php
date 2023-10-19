<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;


class Transaksi_model extends CI_Model
{

    public function get_transaksi_by_id($id)
    {
        // Mengambil data transaksi berdasarkan ID
        $this->db->where('id', $id);
        return $this->db->get('transaksi')->row();
    }

    // Anda dapat menambahkan metode lain di sini sesuai kebutuhan Anda

}
