<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ReviewerCtl extends CI_Controller {

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
		$this->load->model(array('Task'));
	}

	public function index()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
		}
		$session_data = $this->session->userdata('logged_in');

		if ($session_data['nama_grup'] != 'reviewer') {
			redirect('welcome/redirecting');
		}

		$this->load->view('reviewer/header', array("nama_user" => $session_data['nama'],"current_role" => $session_data['nama_grup']));
		$this->load->view('common/topmenu');
		$this->load->view('common/content');
		$this->load->view('common/footer');
	}

	public function viewTask()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
		}
		$session_data = $this->session->userdata('logged_in');

		if ($session_data['nama_grup'] != 'reviewer') {
			redirect('welcome/redirecting');
		}

		$tasks = $this->Task->getMyAssignment($session_data['id_user']);

		$this->load->view('reviewer/header', array("nama_user" => $session_data['nama'],"current_role" => $session_data['nama_grup']));
		$this->load->view('reviewer/ViewTask_v', array('tasks' => $tasks));
		$this->load->view('common/content');
		$this->load->view('common/footer');
	}
}
