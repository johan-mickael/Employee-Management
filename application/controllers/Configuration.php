<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Configuration extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Configuration_model', 'conf');
        $this->admin->is_logged();
	}

    public function index() {
        $data['hs'] = $this->conf->get_all_hs();
        $this->load->view('back/configuration/hs', $data);
    }

    public function f_modifier_impot() {
        $data['impot'] = $this->conf->get_impot();
        $this->load->view('back/configuration/impot', $data);
    }

    public function modifier_impot() {
        try {
			$this->conf->modifier_impot($this->input->post());
			redirect('Configuration/f_modifier_impot/');
		} catch (\Exception $e) {
			$this->session->set_flashdata('message', $e->getMessage());
			redirect('Configuration/f_modifier_impot/');
		}
    }

    public function hm() {
        $data['hm'] = $this->conf->get_all_hm();
        $this->load->view('back/configuration/hm', $data);
    }


    public function f_modifier_hm($id) {
        $data['hm'] = $this->conf->get_hm($id);
        $this->load->view('back/configuration/modifier_hm', $data);
    }

    public function modifier_hm() {
        try {
			$this->conf->modifier_hm($this->input->post());
			redirect('Configuration/f_modifier_hm/'.$this->input->post('id_h_majoree'));
		} catch (\Exception $e) {
			$this->session->set_flashdata('message', $e->getMessage());
			redirect('Configuration/f_modifier_hm/'.$this->input->post('id_h_majoree'));
		}
    }

    public function f_modifier_hs($id) {
        $data['hs'] = $this->conf->get_hs($id);
        $this->load->view('back/configuration/modifier_hs', $data);
    }

    public function modifier_hs() {
        try {
			$this->conf->modifier_hs($this->input->post());
			redirect('Configuration/f_modifier_hs/'.$this->input->post('id_h_supplementaire'));
		} catch (\Exception $e) {
			$this->session->set_flashdata('message', $e->getMessage());
			redirect('Configuration/f_modifier_hs/'.$this->input->post('id_h_supplementaire'));
		}
    }

}