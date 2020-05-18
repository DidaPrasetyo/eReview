<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EditorCtl extends CI_Controller {

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

		if ($session_data['nama_grup'] != 'editor') {
			redirect('welcome/redirecting');
		}

		$this->load->view('editor/header', array("nama_user" => $session_data['nama'],"current_role" => $session_data['nama_grup']));
		$this->load->view('common/topmenu');
		$this->load->view('common/content');
		$this->load->view('common/footer');
	}

	public function AddTask()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
		}
		$session_data = $this->session->userdata('logged_in');

		if ($session_data['nama_grup'] != 'editor') {
			redirect('welcome/redirecting');
		}

		$this->load->view('editor/header', array("nama_user" => $session_data['nama'],"current_role" => $session_data['nama_grup']));
		$this->load->view('editor/AddTask_v',array('error' => "", ));
		$this->load->view('common/footer');
	}

	public function AddingTask()
	{	
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
		}
		$session_data = $this->session->userdata('logged_in');

		if ($session_data['nama_grup'] != 'editor') {
			redirect('welcome/redirecting');
		}
		$this->form_validation->set_rules(
			'judul','Title',
			'trim|min_length[2]|max_length[250]|xss_clean');
		$this->form_validation->set_rules(
			'katakunci','Katakunci',
			'trim|min_length[2]|max_length[128]|xss_clean');
		$this->form_validation->set_rules(
			'authors','Authors',
			'trim|min_length[2]|max_length[256]|xss_clean');
		$this->form_validation->set_rules(
			'password','Password',
			'trim|min_length[2]|max_length[128]|xss_clean');

		$res = $this->form_validation->run();
		if ($res == FALSE) {
			$msg = validation_errors();
			$this->load->view('editor/header', array("nama_user" => $session_data['nama'],"current_role" => $session_data['nama_grup']));
			$this->load->view('editor/AddTask_v',array('error' => $msg));
			$this->load->view('common/footer');
			return FALSE;
		}

		$config['upload_path']          = '../../ereview/berkas/';
		$config['allowed_types']        = 'docx|doc|pdf';
		$config['max_size']             = 10000;

		$new_name = str_replace(' ', '_', time().'_'.$_FILES["userfile"]['name']);
		$config['file_name'] = $new_name;

		$this->upload->initialize($config);
		if ( ! $this->upload->do_upload('userfile'))
		{
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('editor/header', array("nama_user" => $session_data['nama'],"current_role" => $session_data['nama_grup']));
			$this->load->view('editor/AddTask_v',$error);
			$this->load->view('common/footer');
			return;
		}

		$data = $this->upload->data();
		$id_task = $this->Task->insertNewTask($session_data['id_user'],$data['file_name']);
		$this->load->view('editor/header', array("nama_user" => $session_data['nama'],"current_role" => $session_data['nama_grup']));
		$this->load->view('editor/Add_success',array('error' => ""));
		$this->load->view('common/footer');
		return;
	}

	public function viewTask()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
		}
		$session_data = $this->session->userdata('logged_in');

		if ($session_data['nama_grup'] != 'editor') {
			redirect('welcome/redirecting');
		}

		$tasks = $this->Task->getMyTask($session_data['id_user']);

		$this->load->view('editor/header', array("nama_user" => $session_data['nama'],"current_role" => $session_data['nama_grup']));
		$this->load->view('editor/ViewTask_v', array('tasks' => $tasks->result()));
		$this->load->view('common/content');
		$this->load->view('common/footer');
	}

	public function selectReviewer($id_task)
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
		}
		$session_data = $this->session->userdata('logged_in');

		if ($session_data['nama_grup'] != 'editor') {
			redirect('welcome/redirecting');
		}

		$data = $this->Reviewer->getAllReviewers($id_task);
		$page = $this->Task->pageTask($id_task)->page;
		
		$this->load->view('editor/header', array("nama_user" => $session_data['nama'],"current_role" => $session_data['nama_grup']));
		if ($data->row() == NULL) {
			$this->load->view('common/message', array('msg' => 'Semua reviewer sudah di pilih untuk task ini'));
		} else {
			$this->load->view('editor/selectReviewer', array('reviewer' => $data->result(), 'id_task' => $id_task, 'pageTask' => $page));
		}
		$this->load->view('common/content');
		$this->load->view('common/footer');
	}

	public function selectingReviewer()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
		}
		$session_data = $this->session->userdata('logged_in');

		if ($session_data['nama_grup'] != 'editor') {
			redirect('welcome/redirecting');
		}

		$task = $this->input->post('id_task');
		$select = $this->input->post('select');
		$price = $this->input->post('price');
		$total = $this->input->post('total');
		$page = $this->input->post('page');
		$date = date('Y-m-d', now());
		$deadline = date('Y-m-d', strtotime($date. +$page .' days'));

		$data2 = array(
			'id_task' => $task,
			'amount' => $total,
			'status' => '0',
			'id_user' => $session_data['id_user']
		);
		$id_pem = $this->Payment->newPayment($data2);

		foreach ($select as $value) {
			$data = array(
				'id_task' => $task,
				'id_reviewer' => $value,
				'price' => $price,
				'tgl_deadline' => $deadline,
				'id_pembayaran' => $id_pem
			);
			$this->Task->setAssignment($data);
		}

		redirect('EditorCtl/viewTask');
	}

	public function listPayment($id,$error = '')
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
		}
		$session_data = $this->session->userdata('logged_in');

		if ($session_data['nama_grup'] != 'editor') {
			redirect('welcome/redirecting');
		}

		$payment = $this->Payment->getPaymentTask($id);

		$this->load->view('editor/header', array("nama_user" => $session_data['nama'],"current_role" => $session_data['nama_grup']));
		if ($payment->row() == NULL) {
			$this->load->view('common/message', array('msg' => 'Belum ada tagihan untuk saat ini, silahkan pilih reviewer terlebih dahulu'));
		} else {
			$this->load->view('editor/ViewPayment_v', array('payment' => $payment->result(),'error' => $error));			
		}
		$this->load->view('common/content');
		$this->load->view('common/footer');
	}

	public function uploadBukti($id,$id_task){
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
		}
		$session_data = $this->session->userdata('logged_in');

		if ($session_data['nama_grup'] != 'editor') {
			redirect('welcome/redirecting');
		}

		$config['upload_path']          = '../../ereview/bukti/editor/';
		$config['allowed_types']        = 'jpg|png';
		$config['max_size']             = 10000;

		$new_name = str_replace(' ', '_', time().'_'.$_FILES["bukti".$id]['name']);
		$config['file_name'] = $new_name;

		$this->upload->initialize($config);
		if ( ! $this->upload->do_upload('bukti'.$id))
		{
			$error = $this->upload->display_errors();
			echo "<script>alert('".$error."')</script>";
			return;
		}

		$data = $this->upload->data();
		$this->Payment->updateStsPayment($id,$data['file_name']);
		// $this->Task->updateAssignment($id,$id_task,0);
		$this->load->view('editor/header', array("nama_user" => $session_data['nama'],"current_role" => $session_data['nama_grup']));
		$this->load->view('editor/Upload_success', array('error' => ''));
		$this->load->view('common/footer');
		return;
	}

	public function assignStatus($id){
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
		}
		$session_data = $this->session->userdata('logged_in');

		if ($session_data['nama_grup'] != 'editor') {
			redirect('welcome/redirecting');
		}

		$tasks = $this->Task->getMyAssignment($id);

		$this->load->view('editor/header', array("nama_user" => $session_data['nama'],"current_role" => $session_data['nama_grup']));
		$this->load->view('editor/ViewAssign_v', array('tasks' => $tasks));
		$this->load->view('common/content');
		$this->load->view('common/footer');
	}

	public function accDc($sts,$id,$id_rev){
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
		}
		$session_data = $this->session->userdata('logged_in');

		if ($session_data['nama_grup'] != 'editor') {
			redirect('welcome/redirecting');
		}

		$this->Task->updateStsAssignment($id,$sts,$id_rev);
		if ($sts == 6) {
			$id_user = $this->Account->getRIdTask($id);
			$this->Payment->valueIn($id,$id_user);
		}
		redirect('editorCtl/assignStatus/'.$id);
	}
}
