<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ManageMyTask extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Task');
		$this->load->model('Reviewer');
		$this->load->model('Payment');
	}
	public function index()
	{
		echo "<h1>Selamat datang di Manage My Task!</h1>";
		echo "<a href='http://localhost/ereview/index.php/manageMyTask/addNewTask'>Add New Task</a><br>";
		echo "<a href='http://localhost/ereview/index.php/manageMyTask/confirmTaskCompletion'>Confirm Task Completion</a><br>";
	}
	public function addNewTask($pesan='')
	{
		$this->load->view('editor/addNewTask', array('msg' => $pesan, ));
	}
	public function addingNewTask(){
		
		$this->form_validation->set_rules(
			'judul','Judul',
			'trim|min_length[2]|max_length[250]|xss_clean');
		$this->form_validation->set_rules(
			'katakunci','Kata Kunci',
			'trim|min_length[2]|max_length[50]|xss_clean');
		
		$res = $this->form_validation->run();
		if ($res == FALSE) {
			$msg = validation_errors();
			$this->load->view('editor/addNewTask', array('msg' => $msg));
			return FALSE;
		}

		$res = $this->Task->insertNewTask();
		echo "New Task is added";
	}
	public function selectPotentialReviewer()
	{
		$this->load->view('editor/selectPotentialReviewer');
	}
	public function commitPayment()
	{
		$this->load->view('editor/commitPayment');
	}
	public function confirmTaskCompletion()
	{
		$this->load->view('editor/confirmTaskCzompletion');
	}
}
