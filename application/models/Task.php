<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Task extends CI_Model {
	function insertNewTask(){
		$q = "INSERT INTO task (judul) VALUES ('judul')";
		return $this->db->query($q);
	}
}
?>