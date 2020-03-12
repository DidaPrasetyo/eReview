<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AccountCtl extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('Account'));
	}

	public function index()
	{
		$this->load->view('welcome_massage');
	}
	public function login($pesan='')
	{
		$this->load->view('login',array('msg' => $pesan));
	}
	public function createAccount($pesan='')
	{
		$this->load->view('create_account',array('msg' => $pesan));
	}
	public function createingAccount(){
		
		$this->form_validation->set_rules(
			'nama','Nama',
			'trim|min_length[2]|max_length[250]|xss_clean');
		$this->form_validation->set_rules(
			'username','Username',
			'trim|min_length[2]|max_length[128]|xss_clean');
		$this->form_validation->set_rules(
			'email','Email',
			'trim|min_length[2]|max_length[256]|xss_clean');
		$this->form_validation->set_rules(
			'password','Password',
			'trim|min_length[2]|max_length[128]|xss_clean');
		
		$res = $this->form_validation->run();
		if ($res == FALSE) {
			$msg = validation_errors();
			$this->load->view('createAccount', array('msg' => $msg));
			return FALSE;
		}

		$id_user = $this->Account->insertNewUser();
		redirect('AccountCtl/login/'. $id_user);
	}
	public function checkingLogin(){

		$this->form_validation->set_rules(
			'username','Username',
			'trim|min_length[2]|max_length[128]|xss_clean');
		$this->form_validation->set_rules(
			'password','Password',
			'trim|min_length[2]|max_length[128]|xss_clean');
		
		$res = $this->form_validation->run();
		if ($res == FALSE) {
			$msg = validation_errors();
			$this->load->view('login', array('msg' => $msg));
			return FALSE;
		}

		$id_user = $this->Account->getIdUser();

		if ($id_user == -1) {
			$this->load->view('login', array('msg' => 'Username/Password Invalid'));
		} else {
			$peran = $this->Account->getPeranUser($id_user);
			if ($peran == 1) {
				// MATI
				redirect('EditorCtl/index/'. $id_user);
			} elseif ($peran == 2) {
				// Bundir
				redirect('ReviewerCTL/index/'. $id_user);
			} else {
				// Gantung Diri
				redirect('Makelar/index/'. $id_user);
			}
		}		
	}
}
