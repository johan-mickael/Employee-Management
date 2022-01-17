<?php
class Statistique_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Employee_model', 'emp');
        $this->load->model('Fiche_model', 'fiche');
    }

    function get_employee() {
        return $this->db->get('v_stat_total_a_payer')->result_array();
    }

    function get_heure() {
        return $this->db->get('v_stat_heure')->result_array();
    }
}