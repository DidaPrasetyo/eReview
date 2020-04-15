<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
	public function index()
	{
		$this->load->view('common/header');
		$this->load->view('common/topmenu');
		$this->load->view('common/content');
		$this->load->view('common/footer');
	}
	public function login($pesan='')
	{
		$this->load->view('common/header');
		// $this->load->view('common/topmenu');
		$this->load->view('login',array('msg' => $pesan));
		// $this->load->view('common/content');
		$this->load->view('common/footer');
	}
	public function redirecting(){
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
		}
		$session_data = $this->session->userdata('logged_in');

		switch ($session_data['id_grup']) {
			case 1:
				redirect('EditorCtl');
				break;
			case 2:
				redirect('ReviewerCtl');
				break;
			case 2:
				redirect('MakelarCtl');
				break;
			default:
				redirect('welcome');
				break;
		}
	}
}
