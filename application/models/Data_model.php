<?php
class Data_model extends CI_Model {
    public function get_data() {
        $query = $this->db->get('pengguna'); // Ganti "nama_tabel" dengan nama tabel yang sesuai di database Anda
        return $query->result(); // Mengembalikan hasil query sebagai array of objects
    }
}
