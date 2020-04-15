<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ManageAssignedTask extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Task');
		$this->load->model('Reviewer');
		$this->load->model('Payment');
	}
	public function index()
	{
		echo "<h1>Selamat datang di Manage Assigned Task!</h1>";
		echo "<a href='http://localhost/ereview/manageassignedtask/accepttask'>Accept Task</a><br>";
		echo "<a href='http://localhost/ereview/manageassignedtask/rejecttask'>Reject Task</a><br>";
		echo "<a href='http://localhost/ereview/manageassignedtask/deductfunds'>Deduct Funds</a><br>";
	}
	public function acceptTask()
	{
		$this->load->view('reviewer/acceptTask');
	}
	public function rejectTask()
	{
		$this->load->view('reviewer/rejectTask');
	}
	public function submitReview()
	{

		$this->load->view('reviewer/submitReview');
	}
	public function deductFunds()
	{
		$this->load->view('reviewer/deductFunds');
	}
}
