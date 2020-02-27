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
		echo "<a href='http://localhost/ereview/index.php/managemytask/addnewtask'>Add New Task</a><br>";
		echo "<a href='http://localhost/ereview/index.php/managemytask/confirmtaskcompletion'>Confirm Task Completion</a><br>";
	}
	public function addNewTask()
	{
		$this->load->view('editor/addNewTask');
	}
	public function selectPotentialReviewer()
	{
		$this->load->view('editor/selectPotentialReviewer');
	}
	public function commitPayment()
	{
		$this->load->view('editor/commitpayment');
	}
	public function confirmTaskCompletion()
	{
		$this->load->view('editor/confirmtaskcompletion');
	}
}
