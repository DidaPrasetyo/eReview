<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends CI_Model {

	function insertNewTaskOld(){
		$q = "INSERT INTO task (judul,keywords)
		VALUES ('". $this->input->post('judul') ."','". $this->input->post('katakunci') ."')";
		$this->db->query($q);
		return $this->db->insert_id();
	}

	function InsertNewTask($id_user = 0,$filename = ''){
		$id_editor = $this->db->select('id_editor')->where('id_user', $id_user)->get('editor')->row();
		$this->db->set('judul',$this->input->post('judul'));
		$this->db->set('keywords',$this->input->post('katakunci'));
		$this->db->set('authors',$this->input->post('authors'));
		$this->db->set('file_loc',$filename);
		$this->db->set('id_editor',$id_editor->id_editor);
		$this->db->set('date_uploaded', 'NOW()', FALSE);
		$this->db->insert("task");
		return $this->db->insert_id();
	}

	function getTheTask($id_task){
		$q = "SELECT * FROM task WHERE id_task=".$id_task;
		$res = $this->db->query($q);
		return $res->result_array();
	}

	function getMyTask($id_user=-1){
		$id_editor = $this->db->select('id_editor')->where('id_user', $id_user)->get('editor')->row();
		$this->db->where('id_editor', $id_editor->id_editor);
		$this->db->where('sts_task', 0);
		$res = $this->db->get('task');
		return $res->result_array();
	}

	function getMyAssignment($id_user=-1){
		$id_reviewer = $this->db->select('id_reviewer')->where('id_user', $id_user)->get('reviewer')->row();
		$id_task = $this->db->select('id_task')->where('id_reviewer', $id_reviewer->id_reviewer)->get('assignment')->row();
		$this->db->where('id_task', $id_task->id_task);
		$this->db->where('sts_task', 1);
		$res = $this->db->get('task');
		return $res->result_array();
	}

	function setAssignment($data){
		$this->db->set('tgl_assign', 'NOW()', FALSE);
		$this->db->set('date_updated', 'NOW()', FALSE);
		$this->db->insert('assignment',$data);
	}
}
?>