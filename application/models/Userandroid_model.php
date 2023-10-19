<?php

public function update_profile_image($user_id, $image_file) {
    $this->db->set('profile', $image_file);
    $this->db->where('id', $user_id);
    $this->db->update('userandroid'); // Sesuaikan dengan nama tabel di database
}



?>