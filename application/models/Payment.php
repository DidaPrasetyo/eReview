<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Model {

	public function newPayment($data){
		$this->db->set('date_updated', 'NOW()', FALSE);
		$this->db->insert('pembayaran',$data);
		return $this->db->insert_id();
	}

	function getPayment($id){
		$this->db->from('pembayaran');
		$this->db->where('id_task', $id);
		return $this->db->get();
	}

	function getPrice($id){
		$this->db->select('price');
		$this->db->from('assignment');
		$this->db->where('id_assign', $id);
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

	function valueIn($id_assign,$id_user){
		$assign = $this->db->select('price')->from('assignment')->where('id_assign', $id_assign)->get()->row();
		$cek = $this->db->select('*')->from('saldo')->where('id_user', $id_user)->order_by('date','DESC')->get()->row();
		$this->db->set('id_user', $id_user);
		$this->db->set('masuk', $assign->price);
		$this->db->set('keluar', 0);
		$this->db->set('ket', 1);
		$this->db->set('date', 'NOW()', FALSE);
		if ($cek == NULL) {
			$this->db->set('total', $assign->price);
		} else {
			$total = $cek->total + $assign->price;
			$this->db->set('total', $total);
		}
		$this->db->insert('saldo');
	}
}
?>