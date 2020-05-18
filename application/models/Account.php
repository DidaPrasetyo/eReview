<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Model {

	function insertNewUser($photo){
		$q = "INSERT INTO users (nama,username,password,email,photo,date_updated)VALUES (
			'". $this->input->post('nama') ."',
			'". $this->input->post('username') ."',
			MD5('". $this->input->post('password') ."'),
			'". $this->input->post('email') ."',
			'". $photo ."',
			now()
		)";
		$this->db->query($q);
		$id_user	=	$this->db->insert_id();

		$roles = $this->input->post('roles');
		if ($roles == NULL) {
			$roles[] = 3;
		}
		foreach ($roles as $item) {
			$peran	=	$item;
			if ($peran == 1) {

				$q2 = "INSERT INTO editor (id_user,nama,date_updated)VALUES (
				". $id_user .",'". $this->input->post('nama') ."', now()
				)";
				$this->db->query($q2);

				$q3 = "INSERT INTO member (id_user,no_rek,id_grup,date_updated)VALUES (
				'". $id_user ."','". $this->input->post('no_rek') ."','". $peran ."', now()
				)";
				$this->db->query($q3);

			} elseif ($peran == 2) {

				$q2 = "INSERT INTO reviewer (id_user,no_rek,kompetensi,date_updated)VALUES (
				". $id_user .",'". $this->input->post('no_rek') ."','". $this->input->post('kompetensi') ."', now()
				)";
				$this->db->query($q2);

				$q3 = "INSERT INTO member (id_user,id_grup,date_updated)VALUES (
				'". $id_user ."','". $peran ."', now()
				)";
				$this->db->query($q3);

			} else {
				$q2 = "INSERT INTO makelar (id_user,date_updated)VALUES (
				". $id_user .", now()
				)";
				$this->db->query($q2);

				$q3 = "INSERT INTO member (id_user,id_grup,date_updated)VALUES (
				'". $id_user ."','". $peran ."', now()
				)";
				$this->db->query($q3);
			}
		}
		return $id_user;
	}

	function getUser($id_user = -1){
		$q = 
		"SELECT t1.*, t3.id_grup, t3.nama_grup FROM ( SELECT * FROM users 
		t0 WHERE t0.id=". $id_user ." AND t0.sts_user=1) t1
		INNER JOIN member t2 ON t1.id=t2.id_user AND t2.sts_member=1
		INNER JOIN grup t3 ON t2.id_grup=t3.id_grup AND t3.sts_grup=1";
		$res = $this->db->query($q);
		return $res->result_array();
	}

	function getRoles($id_user = -1){
		$q = "SELECT t1.*, t2.nama_grup FROM (SELECT t0.* FROM member t0 WHERE t0.sts_member=1 AND t0.id_user=". $id_user.") t1 
			INNER JOIN grup t2 ON t1.id_grup=t2.id_grup AND t2.sts_grup=1";
		$res = $this->db->query($q);
		return $res->result_array();
	}

	function getIdUser(){
		$q = 
		"SELECT t1.*, t3.id_grup, t3.nama_grup FROM ( SELECT * FROM users t0 
		WHERE t0.username='". $this->input->post('username') ."'
		AND t0.password=MD5('". $this->input->post('password') ."')
		AND t0.sts_user=1) t1
		INNER JOIN member t2 ON t1.id=t2.id_user AND t2.sts_member=1
		INNER JOIN grup t3 ON t2.id_grup=t3.id_grup AND t3.sts_grup=1";
		$res = $this->db->query($q);
		$users = $res->result_array();

		if (count($users)>0) {
			return $users;
		}
		return [];
	}
	function getPeranUser($id_user = -1){
		$q = "SELECT * FROM member WHERE id_user=". $id_user;
		$res = $this->db->query($q);
		$peran = $res->result_array();
		return $peran[0]['id_grup'];
	}
	function getEIdTask($id){
		$this->db->select('users.id');
		$this->db->from('users');
		$this->db->join('editor', 'editor.id_user = users.id');
		$this->db->join('task', 'task.id_editor = editor.id_editor');
		$this->db->join('assignment', 'assignment.id_task = task.id_task');
		$this->db->where('assignment.id_assign', $id);
		return $this->db->get()->row()->id;
	}

	function getRIdTask($id){
		$this->db->select('users.id');
		$this->db->from('users');
		$this->db->join('reviewer', 'reviewer.id_user = users.id');
		$this->db->join('assignment', 'assignment.id_reviewer = reviewer.id_reviewer');
		$this->db->where('assignment.id_assign', $id);
		return $this->db->get()->row()->id;
	}

	function getRole($id){
		$this->db->select('grup.nama_grup, grup.id_grup, users.id, users.nama, users.username');
		$this->db->from('grup');
		$this->db->join('member', 'grup.id_grup = member.id_grup');
		$this->db->join('users', 'member.id_user = users.id');
		$this->db->where('member.id_user',$id);
		return $this->db->get()->result_array();
	}
}
?>