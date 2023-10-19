<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gambar_model extends CI_Model
{

    public function get_gambar()
    {
        $query = $this->db->get('stokbarang');
        return $query->result();
    }
}
