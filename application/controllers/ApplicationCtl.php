<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApplicationCtl extends CI_Controller {

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
		$this->load->model(array('Task','Reviewer'));
	}


	public function download($id_task=0)
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
		}
		$session_data = $this->session->userdata('logged_in');

		$task = $this->Task->getTheTask($id_task);

		if (sizeof($task)<=0) {
			return;
		}

		force_download('../../ereview/berkas/'.$task[0]['file_loc'], NULL);
		return;
	}
	public function debug(){
		$id_task = $this->Reviewer->getAllReviewers();
	}
}
