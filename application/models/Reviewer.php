<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reviewer extends CI_Model {

	function getAllReviewers(){
		$this->db->from('users');
		$this->db->join('reviewer', 'reviewer.id_user = users.id');
		return $this->db->get();
	}
}
?>