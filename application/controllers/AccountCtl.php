<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AccountCtl extends CI_Controller {

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
		$this->load->model(array('Account'));
	}

	public function index()
	{
		redirect('welcome/login');
	}
	public function createAccount($pesan='')
	{
		$this->load->view('create_account',array('msg' => $pesan));
	}
	public function createingAccount()
	{	
		$this->form_validation->set_rules(
			'nama','Nama',
			'trim|min_length[2]|max_length[250]|xss_clean');
		$this->form_validation->set_rules(
			'username','Username',
			'trim|min_length[2]|max_length[128]|xss_clean');
		$this->form_validation->set_rules(
			'email','Email',
			'trim|min_length[2]|max_length[256]|xss_clean');
		$this->form_validation->set_rules(
			'password','Password',
			'trim|min_length[2]|max_length[128]|xss_clean');
		
		$res = $this->form_validation->run();
		if ($res == FALSE) {
			$msg = validation_errors();
			$this->load->view('createAccount', array('msg' => $msg));
			return FALSE;
		}

		$id_user = $this->Account->insertNewUser();
		redirect('AccountCtl/login/'. $id_user);
	}
	public function signingUp()
	{	
		$this->form_validation->set_rules(
			'name','Nama',
			'trim|min_length[2]|max_length[250]|xss_clean');
		$this->form_validation->set_rules(
			'username','Username',
			'trim|min_length[2]|max_length[128]|xss_clean');
		$this->form_validation->set_rules(
			'email','Email',
			'trim|min_length[2]|max_length[256]|xss_clean');
		$this->form_validation->set_rules(
			'password','Password',
			'trim|min_length[2]|max_length[128]|xss_clean');

		$res = $this->form_validation->run();
		if ($res == FALSE) {
			$msg = validation_errors();
			$this->load->view('common/header');
			$this->load->view('signup', array('error' => $msg));
			$this->load->view('common/footer');
			return FALSE;
		}

		$config['upload_path']          = './photos/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 50;
		$config['max_width']            = 150;
		$config['max_height']           = 200;

		$new_name = $this->input->post('username').$_FILES['photo']['name'];
		$config['file_name'] = $new_name;

		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('photo'))
		{
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('common/header');
			$this->load->view('signup',$error);
			$this->load->view('common/footer');
			return;
		}

		$data = $this->upload->data();
		$id_user = $this->Account->insertNewUser($data['file_name']);
		$this->load->view('common/header');
		$this->load->view('signup_success');
		$this->load->view('common/footer');
		return;
	}
	public function checkingLogin()
	{
		$this->form_validation->set_rules(
			'username','Username',
			'trim|min_length[2]|max_length[128]|xss_clean');
		$this->form_validation->set_rules(
			'password','Password',
			'trim|min_length[2]|max_length[128]|xss_clean');
		
		$res = $this->form_validation->run();
		if ($res == FALSE) {
			$msg = validation_errors();
			$this->load->view('login', array('msg' => $msg));
			return FALSE;
		}

		$users = $this->Account->getIdUser();

		if (sizeof($users) <= 0) {
			$this->load->view('login', array('msg' => 'Username/Password Invalid'));
		} else {

			$sess_array = array(
				'id_user'	=> $users[0]['id'],
				'nama'		=> $users[0]['nama'],
				'username'	=> $users[0]['username'],
				'id_grup'	=> $users[0]['id_grup'],
				'nama_grup'	=> $users[0]['nama_grup'],
				'currentgrup'	=> $users[0]['nama_grup']
			);
			$this->session->set_userdata('logged_in', $sess_array);

			// $peran = $this->Account->getPeranUser($id_user);
			if ($users[0]['id_grup'] == 1) {
				
				redirect('editorCtl');
			} elseif ($users[0]['id_grup'] == 2) {
				
				redirect('reviewerCtl');
			} elseif ($users[0]['id_grup'] == 3) {
				
				redirect('makelarCtl');
			} else {
				redirect('welcome');
			}
		}		
	}

	public function profile(){
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/login');
		}
		$session_data = $this->session->userdata('logged_in');

		$user  = $this->Account->getUser($session_data['id_user']);
		$roles  = $this->Account->getRoles($session_data['id_user']);

		$this->load->view($session_data['nama_grup'].'/header',array("nama_user" => $session_data['nama'],"current_role" => $session_data['nama_grup']));
		$this->load->view('profile',array('error' => "",'user' => $user[0],'roles' => $roles));
		$this->load->view('common/footer');
	}

	public function logout(){
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/login');
		}
		$session_data = $this->session->userdata('logged_in');
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect('welcome');
	}
}
