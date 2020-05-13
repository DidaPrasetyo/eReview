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
		$this->db->set('page',$this->input->post('page'));
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
		return $res;
	}

	function setAssignment($data){
		$this->db->set('tgl_assign', 'NOW()', FALSE);
		$this->db->set('date_updated', 'NOW()', FALSE);
		$this->db->insert('assignment',$data);
	}

	function pageTask($id){
		return $this->db->select('page')->where('id_task', $id)->get('task')->row();
	}

	function updateAssignment($id_pem,$id,$sts){
		$this->db->set('status', $sts);
		$this->db->where('id_assign', $id);
		$this->db->where('id_pembayaran', $id_pem);
		$this->db->update('assignment');
	}

	function updateStsAssignment($id,$sts,$id_rev){
		$this->db->set('status', $sts);
		$this->db->where('id_assign', $id);
		$this->db->where('id_reviewer', $id_rev);
		$this->db->update('assignment');
	}

	function getMyAssignment($id){
		$this->db->select('users.nama, task.judul, assignment.*, reviewer.id_reviewer');
		$this->db->from('assignment');
		$this->db->join('task', 'assignment.id_task = task.id_task');
		$this->db->join('reviewer', 'assignment.id_reviewer = reviewer.id_reviewer');
		$this->db->join('users', 'reviewer.id_user = users.id');
		$this->db->where('assignment.id_task', $id);
		$res = $this->db->get();
		return $res->result_array();
	}

}
?>