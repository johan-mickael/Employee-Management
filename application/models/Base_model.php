<?php
class Base_model extends CI_Model {

    public function get($table) {
        return $this->db->get($table)->result_array();
    }

    public function get_last_id($table) {
        $sql = "SELECT `AUTO_INCREMENT` id FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'Pointage' AND TABLE_NAME   = '{$table}'";
        $query = $this->db->query($sql);
        return $query->row_array()['id'];
    }

    public function get_max_id($column, $table) {
        $this->db->select_max($column);
        return $this->db->get($table)->row_array()[$column];
    }

}