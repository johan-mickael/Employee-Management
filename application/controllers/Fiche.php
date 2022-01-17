<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Fiche extends CI_Controller
{
    public function __construct()
	{
		parent::__construct();
        $this->load->model('Fiche_model', 'fiche');
        $this->load->model('Employee_model', 'emp');
        $this->admin->is_logged();
	}

    public function get($id_emp) {
        $this->load->model('Pointage', 'pointage');
        $data['emp'] = $this->emp->get_by_id($id_emp);
        $data['fiche'] = $this->fiche->get($id_emp);
        if(is_null($data['fiche']['total'])) {
            $this->session->set_flashdata('message', 'Pas encode de pointage');
            redirect('Employee');
        }
        $this->load->view('back/fiche/fiche', $data);
    }



}