<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends CI_Model {

	function insertNewTask(){
		$q = "INSERT INTO task (judul,keywords)
		VALUES ('". $this->input->post('judul') ."','". $this->input->post('katakunci') ."')";
		$this->db->query($q);
		return $this->db->insert_id();
	}

	function getTheTask($id_task){
		$q = "SELECT * FROM task WHERE id_task=".$id_task;
		$res = $this->db->query($q);
		return $res->result_array();
	}
}
?>