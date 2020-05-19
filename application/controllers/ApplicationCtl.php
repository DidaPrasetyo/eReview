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
		$this->load->model(array('Task','Reviewer','Payment','Account'));
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

	public function buktiEditor($id=0)
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
		}
		$session_data = $this->session->userdata('logged_in');

		$bayar = $this->Payment->getThePayment($id);

		if (sizeof($bayar)<=0) {
			return;
		}

		force_download('../../ereview/bukti/editor/'.$bayar[0]['bukti'], NULL);
		return;
	}

	public function downReview($id=0)
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
		}
		$session_data = $this->session->userdata('logged_in');

		$review = $this->Reviewer->getTheReview($id);

		if (sizeof($review)<=0) {
			return;
		}

		force_download('../../ereview/berkas/reviewed/'.$review[0]['file'], NULL);
		return;
	}

	public function debug(){
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
		}
		$session_data = $this->session->userdata('logged_in');
		// $no = $this->Account->getNoRek('18','2');
		// var_dump($this->Account->getRole('12'));
		// var_dump($no);
		// $this->Payment->AccDc('2','15');
		// $session_data = $this->session->userdata('logged_in');
		// $id = '10';
		// $id_user = $this->Account->getEIdTask($id);
		// var_dump($id_user);
		// $this->Payment->valueIn($id,$id_user);
		// var_dump($this->Reviewer->getMyAssignment($session_data['id_user']));
		// var_dump($this->Reviewer->getAllReviewers('10')->result());

		// $sts = $this->Payment->getPrice('64')->row();
		// var_dump($sts);
		// echo "<br>";
		// echo "<br>";
		// $array = array('1','2','3');
		// var_dump($array);
		// $item['page'] = 20;
		// echo ($item['page']*10)."$";
		// var_dump($sts->result());
		// echo "<br>";
		// var_dump($sts->result_array());
		// echo "<br>";
		// var_dump($sts->row());
		// foreach ($sts->result() as $row) {
		// 	echo $row->judul;
		// }
		// if (in_array('0', $array)) {
		// 	echo "BAYAR CUK";
		// } else {
		// 	echo "ANJIR LUNAS";
		// }
		// $date = date('Y-m-d', now());
		// $page = '10';
		// $deadline = date('Y-m-d', strtotime($date. +$page .' days'));
		// echo $date;
		// echo '<br>'.$deadline;
		// echo 'now() = '. now();
	}
}
