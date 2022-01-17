<?php
class Configuration_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->hs30 = 1;
        $this->hs50 = 2;
        $this->hm30 = 1;
        $this->hm40 = 2;
        $this->hm50 = 3;
        $this->hj = 4;
        $this->hf = 5;
    }

    public function get_impot() {
        return $this->db->get('impot')->row_array();
    }

    public function modifier_impot($input) {
        $sql = "update impot set pourcentage='%d' ";
        $sql = sprintf($sql, $input['pourcentage']);
        return $this->db->query($sql);
    }

    public function modifier_hs($input) {
        $sql = "update h_supplementaire set designation='%s', h_max='%d', pourcentage='%d' ";
        $sql .= "where id_h_supplementaire = %s";
        $sql = sprintf($sql, $input['designation'], $input['h_max'], $input['pourcentage']);
        return $this->db->query($sql);
    }

    public function modifier_hm($input) {
        $sql = "update h_majoree set designation='%s', pourcentage='%d' ";
        $sql .= "where id_h_majoree = %s";
        $sql = sprintf($sql, $input['designation'], $input['pourcentage'], $input['id_h_majoree']);
        return $this->db->query($sql);
    }

    public function get_all_hs() {
        return $this->db->get('h_supplementaire')->result_array();
    }

    public function get_all_hm() {
        return $this->db->get('h_majoree')->result_array();
    }

    public function get_hm($id) {
        return $this->db->get_where('h_majoree', array('id_h_majoree' => $id))->row_array();
    }

    public function get_hs($id) {
        return $this->db->get_where('h_supplementaire', array('id_h_supplementaire' => $id))->row_array();
    }

}