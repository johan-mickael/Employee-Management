<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pointage extends CI_Controller
{
    public function __construct()
	{
		parent::__construct();
        $this->load->model('Pointage_model', 'pointage');
        $this->admin->is_logged();
	}

    public function index($employee) {
        $this->load->model('Employee_model', 'emp');
        $data['employee'] = $this->emp->get_by_id($employee);
        $this->load->view('back/pointage/saisie', $data);
    }

    public function valider() {
        try {
            $id_pointage_mere = $this->pointage->inserer_pointage($this->input->post());
            redirect('Pointage/calcul_heure/'.$this->input->post('id_employee'));
        } catch(\Exception $e) {
            $this->session->set_flashdata('message', $e->getMessage());
            redirect('Pointage/index/'.$this->input->post('id_employee'));
        }
    }

    public function calcul_heure($id_emp) {
        $data['calcul'] = $this->pointage->get_calcul_heure($id_emp);
        if(is_null($data['calcul'])) {
            $this->session->set_flashdata('message', 'Pas encode de pointage');
            redirect('Employee');
        }
        $this->load->model('Employee_model', 'emp');
        $data['employee'] = $this->emp->get_by_id($data['calcul']['id_employee']);
        $this->load->view('back/pointage/heure', $data);
    }
}