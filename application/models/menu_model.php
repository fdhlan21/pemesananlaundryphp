<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{

    public function getSubMenu()
    {

        $query = "SELECT `admin_sub_menu`.*,`admin_menu`.`menu`
FROM `admin_sub_menu` JOIN `admin_menu`
ON `admin_sub_menu`.`menu_id` = `admin_menu`.`id`
";

        return $this->db->query($query)->result_array();
    }
}
