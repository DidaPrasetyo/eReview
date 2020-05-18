<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MakelarCtl extends CI_Controller {

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
		$this->load->model(array('Task','Reviewer','Payment','Account'));
	}

	public function index()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
		}
		$session_data = $this->session->userdata('logged_in');

		if ($session_data['nama_grup'] != 'makelar') {
			redirect('welcome/redirecting');
		}

		$this->load->view('makelar/header', array("nama_user" => $session_data['nama'],"current_role" => $session_data['nama_grup']));
		$this->load->view('common/topmenu');
		$this->load->view('common/content');
		$this->load->view('common/footer');
	}

	public function viewPayment()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
		}
		$session_data = $this->session->userdata('logged_in');

		if ($session_data['nama_grup'] != 'makelar') {
			redirect('welcome/redirecting');
		}

		$payment = $this->Payment->getAllList();

		$this->load->view('makelar/header', array("nama_user" => $session_data['nama'],"current_role" => $session_data['nama_grup']));
		$this->load->view('makelar/viewPayment_v', array('list' => $payment->result()));
		$this->load->view('common/footer');
	}

	public function AccDc($sts,$id)
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
		}
		$session_data = $this->session->userdata('logged_in');

		if ($session_data['nama_grup'] != 'makelar') {
			redirect('welcome/redirecting');
		}
		$this->Payment->AccDc($sts,$id);
		if ($sts == 2) {
			$this->Task->updateAssign('1',$id);
		}
		redirect('MakelarCtl/viewPayment');
	}

	public function viewAllTask()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
		}
		$session_data = $this->session->userdata('logged_in');

		if ($session_data['nama_grup'] != 'makelar') {
			redirect('welcome/redirecting');
		}

		$task = $this->Task->getAllList();

		$this->load->view('makelar/header', array("nama_user" => $session_data['nama'],"current_role" => $session_data['nama_grup']));
		$this->load->view('makelar/ViewTask_v', array('list' => $task->result()));
		$this->load->view('common/footer');
	}

	public function ViewReviewer($id)
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
		}
		$session_data = $this->session->userdata('logged_in');

		if ($session_data['nama_grup'] != 'makelar') {
			redirect('welcome/redirecting');
		}

		$task = $this->Task->getTheTask($id);
		$reviewer = $this->Reviewer->getListReviewer($id);

		$this->load->view('makelar/header', array("nama_user" => $session_data['nama'],"current_role" => $session_data['nama_grup']));
		$this->load->view('makelar/viewRev_v', array('list' => $reviewer->result(), 'task' => $task));
		$this->load->view('common/footer');
	}
}
