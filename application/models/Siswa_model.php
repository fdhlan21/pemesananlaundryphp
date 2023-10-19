<?php

// application/models/Siswa_model.php

class Siswa_model extends CI_Model
{
    public function get_nama_by_nis($nis)
    {
        $this->db->select('nama');
        $this->db->where('nis', $nis);
        $query = $this->db->get('siswa');

        if ($query->num_rows() > 0) {
            return $query->row()->nama;
        } else {
            return 'Siswa tidak ditemukan';
        }
    }
}


?>