<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ManageMyTask extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('Task','Reviewer','Payment'));
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

		$id_task = $this->Task->insertNewTask();
		redirect('manageMyTask/selectPotentialReviewer/'. $id_task);
	}

	public function selectPotentialReviewer($id_task=-1)
	{
		$thetask = $this->Task->getTheTask($id_task);
		$reviewers = $this->Reviewer->getAllReviewers();
		$this->load->view('editor/selectPotentialReviewer',
			array(
				'task' => $thetask[0],
				'reviewers' => $reviewers
			)
		);
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
