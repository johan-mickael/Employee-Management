<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Statistique extends CI_Controller
{
    public function __construct()
	{
		parent::__construct();
        $this->load->model('Statistique_model', 'stat');
        $this->admin->is_logged();
	}
    public function index() {
        $data['emp']= $this->stat->get_employee();
        $this->load->view('back/statistique/liste', $data);
    }

    public function heure() {
        $data['stat'] = $this->stat->get_heure();
        $this->load->view('back/statistique/heure', $data);
    }
}