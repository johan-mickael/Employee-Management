<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Employee extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Employee_model', 'emp');
		$this->admin->is_logged();
	}

	public function index()
	{
		$this->load->view('back/employee/liste');
	}

	public function f_modifier($id)
	{
		$this->load->model('Categorie_model', 'cat');
		$data['categorie'] = $this->cat->get_all();
		$data['emp'] = $this->emp->get_by_id($id);
		$this->load->view('back/employee/modifier', $data);
	}

	public function modifier()
	{
		try {
			$this->emp->modifier($this->input->post());
			redirect('Employee');
		} catch (\Exception $e) {
			$this->session->set_flashdata('message', $e->getMessage());
			redirect('Employee/f_modifier/'.$this->input->post('id_employee'));
		}

	}

	public function f_ajouter()
	{
		$this->load->model('Categorie_model', 'cat');
		$data['categorie'] = $this->cat->get_all();
		$this->load->view('back/employee/ajouter', $data);
	}

	public function ajouter()
	{
		try {
			$this->emp->ajouter($this->input->post());
			debug($this->db->last_query());
			redirect('Employee');
		} catch (\Exception $e) {
			$this->session->set_flashdata('message', $e->getMessage());
			redirect('Employee/f_ajouter');
		}
	}

	public function supprimer($id)
	{
		try {
			$this->emp->supprimer($id);
			redirect('Employee');
		} catch (\Exception $e) {
			echo $e->getMessage();
		}
	}

	public function datatable()
	{
		$inp = $this->emp->get_input_multicritere($this->input->post());
		$data = $this->emp->getRows($this->input->post());
		$draw = $this->input->post('draw');
		$records_filtered = $this->emp->countFiltered($this->input->post());
		$records_total = $this->emp->countAll();
		$output = array("draw" => $draw, "recordsTotal" => $records_total, "recordsFiltered" => $records_filtered, "data" => $data);
		echo json_encode($output);
	}
}
