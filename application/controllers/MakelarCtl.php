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
		$pem = $this->Payment->getIfPem($id);
		if ($pem->id_task != 0) {
			if ($sts == 2) {
				$this->Task->updateAssign('1',$id);
			}
		} else {
			$this->Payment->saldoIn($pem->amount, $pem->id_user);
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

	public function fundReq(){
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
		}
		$session_data = $this->session->userdata('logged_in');

		if ($session_data['nama_grup'] != 'makelar') {
			redirect('welcome/redirecting');
		}

		$list = $this->Payment->getAllReq();

		$this->load->view('makelar/header', array("nama_user" => $session_data['nama'],"current_role" => $session_data['nama_grup']));
		$this->load->view('makelar/viewReq_v', array('list' => $list->result()));
		$this->load->view('common/footer');
	}

	public function fundAcc($id){
		$config['upload_path']          = '../../ereview/bukti/penarikan/';
		$config['allowed_types']        = 'jpg|png';
		$config['max_size']             = 10000;

		$new_name = str_replace(' ', '_', time().'_'.$_FILES["buktitf".$id]['name']);
		$config['file_name'] = $new_name;

		$this->upload->initialize($config);
		if ( ! $this->upload->do_upload('buktitf'.$id))
		{
			$error = $this->upload->display_errors();
			echo "<script>alert('".$error."'); window.location.href = 'fundReq';</script>";
			return;
		}

		$data = $this->upload->data();
		$bukti = $data['file_name'];
		$this->Payment->updateReq($id, $bukti, 2);
		redirect('MakelarCtl/fundReq');
	}
}
