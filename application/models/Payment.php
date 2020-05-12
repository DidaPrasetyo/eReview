<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Model {

	public function newPayment($data){
		$this->db->set('date_updated', 'NOW()', FALSE);
		$this->db->insert('pembayaran',$data);
	}

	function getPayment($id){
		$this->db->from('pembayaran');
		$this->db->where('id_task', $id);
		return $this->db->get();
	}

	function getPaymentTask($id){
		$this->db->select('pembayaran.*,task.judul,task.id_task');
		$this->db->from('pembayaran');
		$this->db->join('task', 'task.id_task = pembayaran.id_task');
		$this->db->where('task.id_task', $id);
		return $this->db->get();
	}

	function getThePayment($id){
		$q = "SELECT * FROM pembayaran WHERE id_pembayaran=".$id;
		$res = $this->db->query($q);
		return $res->result_array();
	}

	function updateStsPayment($id, $bukti){
		$this->db->set('bukti', $bukti);
		$this->db->set('status', 1);
		$this->db->where('id_pembayaran', $id);
		$this->db->update('pembayaran');
	}
}
?>