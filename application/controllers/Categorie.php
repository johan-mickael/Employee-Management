<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Categorie extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Categorie_model', 'cat');
		$this->admin->is_logged();
	}

    public function index() {
        $data['cat'] = $this->cat->get_all();
        $this->load->view('back/categorie/liste', $data);
    }

    public function f_modifier($id) {
        $data['cat'] = $this->cat->get_by_id($id);
        $this->load->view('back/categorie/modifier', $data);
    }

    public function modifier()
	{
		try {
			$this->cat->modifier($this->input->post());
			redirect('Categorie');
		} catch (\Exception $e) {
			$this->session->set_flashdata('message', $e->getMessage());
			redirect('Categorie/f_modifier/'.$this->input->post('id_categorie'));
		}

	}

}