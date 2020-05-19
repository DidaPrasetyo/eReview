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
		$this->load->model(array('Task','Reviewer','Payment','Account'));
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

		$tasks = $this->Reviewer->getMyAssignment($session_data['id_user']);

		$this->load->view('reviewer/header', array("nama_user" => $session_data['nama'],"current_role" => $session_data['nama_grup']));
		$this->load->view('reviewer/ViewTask_v', array('tasks' => $tasks));
		$this->load->view('common/content');
		$this->load->view('common/footer');
	}

	public function accDc($sts,$id){
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
		}
		$session_data = $this->session->userdata('logged_in');

		if ($session_data['nama_grup'] != 'reviewer') {
			redirect('welcome/redirecting');
		}

		$this->Reviewer->updateStsAssignment($id,$sts,$session_data['id_user']);
		if ($sts == 3) {
			$ket = 1;
			$id_user = $this->Account->getEIdTask($id);
			$this->Payment->valueIn($id,$id_user,$ket);
		}
		
		redirect('ReviewerCtl/viewTask');
	}

	public function uploadReview($id){
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
		}
		$session_data = $this->session->userdata('logged_in');

		if ($session_data['nama_grup'] != 'reviewer') {
			redirect('welcome/redirecting');
		}

		$config['upload_path']          = '../../ereview/berkas/reviewed/';
		$config['allowed_types']        = 'docx|doc|pdf';
		$config['max_size']             = 10000;

		$new_name = str_replace(' ', '_', time().'_'.$_FILES["berkas".$id]['name']);
		$config['file_name'] = $new_name;

		$this->upload->initialize($config);
		if ( ! $this->upload->do_upload('berkas'.$id))
		{
			$error = $this->upload->display_errors();
			echo "<script>alert('".$error."')</script>";
			return;
		}

		$data = $this->upload->data();
		$this->Reviewer->updateStsAssignment($id,4,$session_data['id_user'],$data['file_name']);

		redirect('ReviewerCtl/viewTask');
	}
}
