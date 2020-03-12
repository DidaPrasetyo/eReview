<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Model {

	function insertNewUser(){
		$q = "INSERT INTO users (nama,username,password,email,date_updated)VALUES (
			'". $this->input->post('nama') ."',
			'". $this->input->post('username') ."',
			'". $this->input->post('password') ."',
			'". $this->input->post('email') ."',
			now()
		)";
		$this->db->query($q);
		$id_user	=	$this->db->insert_id();
		$peran	=	$this->input->post('peran');
		if ($peran == 1) {

			$q2 = "INSERT INTO editor (id_user,date_updated)VALUES (
			". $id_user .", now()
			)";
			$this->db->query($q2);

			$q3 = "INSERT INTO member (id_user,id_grup,date_updated)VALUES (
			'". $id_user ."','". $peran ."', now()
			)";
			$this->db->query($q3);

		} else {

			$q2 = "INSERT INTO reviewer (id_user,date_updated)VALUES (
			". $id_user .", now()
			)";
			$this->db->query($q2);

			$q3 = "INSERT INTO member (id_user,id_grup,date_updated)VALUES (
			'". $id_user ."','". $peran ."', now()
			)";
			$this->db->query($q3);

		}
		return $id_user;
	}
	function getIdUser(){
		$q = "SELECT * FROM users WHERE username='". $this->input->post('username') ."',"."password='". $this->input->post('password') ."'";
		$res = $this->db->query($q);
		$users = $res->result_array();

		if (count($users)>0) {
			return $users[0]['id_user'];
		}
		return -1;
	}
	function getPeranUser($id_user = -1){
		$q = "SELECT * FROM member WHERE id_user='". $id_user ."'";
		$res = $this->db->query($q);
		$peran = $res->result_array();
		$peran[0]['id_group'];
	}
}
?>