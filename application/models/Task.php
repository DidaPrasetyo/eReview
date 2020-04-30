<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends CI_Model {

	function insertNewTaskOld(){
		$q = "INSERT INTO task (judul,keywords)
		VALUES ('". $this->input->post('judul') ."','". $this->input->post('katakunci') ."')";
		$this->db->query($q);
		return $this->db->insert_id();
	}

	function InsertNewTask($id = 0,$filename = ''){
		$this->db->set('judul',$this->input->post('judul'));
		$this->db->set('keywords',$this->input->post('katakunci'));
		$this->db->set('authors',$this->input->post('authors'));
		$this->db->set('file_loc',$filename);
		$this->db->set('id_editor',$id);
		$this->db->set('date_uploaded', 'NOW()', FALSE);
		$this->db->insert("task");
		return $this->db->insert_id();
	}

	function getTheTask($id_task){
		$q = "SELECT * FROM task WHERE id_task=".$id_task;
		$res = $this->db->query($q);
		return $res->result_array();
	}

	function getMyTask($id_editor=-1){
		$this->db->where('id_editor', $id_editor);
		$this->db->where('sts_task', 0);
		$res = $this->db->get('task');
		return $res->result_array();
	}
}
?>