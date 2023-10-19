<?php
class Barang_model extends CI_Model
{
    public function tambahBarang($data)
    {
        $this->db->insert('stokbarang', $data);
        return $this->db->insert_id();
    }
}
