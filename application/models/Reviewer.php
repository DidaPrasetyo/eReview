<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reviewer extends CI_Model {

	function getAllReviewers(){
		$q = "SELECT * FROM reviewer";
		$res = $this->db->query($q);
		return $res->result_array();
	}
}
?>