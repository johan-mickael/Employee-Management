<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_Administrateur extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Administrateur_model', 'admin');
    }
	public function index()
	{
		$this->load->view('back/login');
	}

	public function se_connecter()
	{
		try {
			$this->admin->connexion($this->input->post(), "Nom d'utilisateur ou mot de passe incorrect.");
			redirect("Employee");
		} catch (Exception $e) {
			$data['error'] = $e->getMessage();
			$this->load->view('back/login', $data);
		}
	}

	public function deco() {
		session_destroy();
		redirect('Login_Administrateur');
	}

	public function inscription() {
		$this->load->view('inscription');
	}
}
