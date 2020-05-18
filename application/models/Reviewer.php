<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reviewer extends CI_Model {

	function getReviewerOnAssign($id){
		$this->db->select('id_reviewer');
		$this->db->from('assignment');
		$this->db->where('id_task', $id);
		$id_rev = $this->db->get()->result();
		if (sizeof($id_rev) > 0) {
			foreach ($id_rev as $key) {
				$arr[] = $key->id_reviewer;
			}
			return $arr;
		} else {
			return 0;
		}
	}

	function getAllReviewers($id){
		$id_rev = $this->getReviewerOnAssign($id);
		$this->db->from('users');
		$this->db->join('reviewer', 'reviewer.id_user = users.id');
		if ($id_rev != 0) {
			$this->db->join('assignment', 'reviewer.id_reviewer = assignment.id_reviewer');
			$this->db->where_not_in('assignment.id_reviewer', $id_rev);
		}
		return $this->db->get();
	}

	function getMyAssignment($id_user=-1){
		$id_reviewer = $this->db->select('id_reviewer')->where('id_user', $id_user)->get('reviewer')->row();
		$this->db->select('task.*, assignment.status, assignment.id_assign, assignment.tgl_deadline, assignment.tgl_assign');
		$this->db->from('assignment');
		$this->db->join('task', 'task.id_task = assignment.id_task');
		$this->db->where('assignment.id_reviewer', $id_reviewer->id_reviewer);
		$sts = array('1','2','3','4','5','6');
		$this->db->where_in('assignment.status', $sts);
		$res = $this->db->get();
		return $res->result_array();
	}

	function updateStsAssignment($id,$sts,$id_user,$file=''){
		$id_reviewer = $this->db->select('id_reviewer')->where('id_user', $id_user)->get('reviewer')->row();
		$this->db->set('status', $sts);
		$this->db->set('file', $file);
		$this->db->where('id_assign', $id);
		$this->db->where('id_reviewer', $id_reviewer->id_reviewer);
		$this->db->update('assignment');
	}

	function getListReviewer($id){
		$this->db->select('assignment.status, users.nama');
		$this->db->from('assignment');
		$this->db->join('reviewer', 'assignment.id_reviewer = reviewer.id_reviewer');
		$this->db->join('users', 'reviewer.id_user = users.id');
		$this->db->where('assignment.id_task', $id);
		return $this->db->get();
	}
}
?>