<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reviewer extends CI_Model {

	function getAllReviewers(){
		$this->db->from('users');
		$this->db->join('reviewer', 'reviewer.id_user = users.id');
		// $this->db->join('assignment', 'assignment.id_reviewer = reviewer.id_reviewer');
		// $this->db->join('task', 'task.id_task = assignment.id_task');
		// $this->db->where('assignment.id_reviewer != reviewer.id_reviewer AND assignment.id_task != task.id_task');
		return $this->db->get();
	}
	function updateStsAssignment($id){
		$this->db->set('status', 1);
		$this->db->where('id_task', $id);
		$this->db->update('assignment');
	}
}
?>