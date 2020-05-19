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

	function getAllList(){
		$this->db->select('pembayaran.*,task.judul,users.nama');
		$this->db->from('pembayaran');
		$this->db->join('task','pembayaran.id_task = task.id_task');
		$this->db->join('users','pembayaran.id_user = users.id');
		return $this->db->get();
	}

	function AccDc($sts,$id){
		$this->db->set('status', $sts);
		$this->db->where('id_pembayaran', $id);
		$this->db->update('pembayaran');
	}

	function getSaldo($id){
		$this->db->select('total');
		$this->db->order_by('date','desc')->limit(1);
		$this->db->where('id_user',$id);
		$data = $this->db->get('saldo')->row();
		if ($data == NULL) {
			$saldo = '0';
		} else {
			$saldo = $data->total;
		}
		return $saldo;
	}

	function valueIn($id_assign,$id_user,$ket){
		$assign = $this->db->select('price')->from('assignment')->where('id_assign', $id_assign)->get()->row();
		$cek = $this->db->select('*')->from('saldo')->where('id_user', $id_user)->order_by('date','DESC')->get()->row();
		$this->db->set('id_user', $id_user);
		$this->db->set('masuk', $assign->price);
		$this->db->set('keluar', 0);
		$this->db->set('ket', $ket);
		$this->db->set('date', 'NOW()', FALSE);
		if ($cek == NULL) {
			$this->db->set('total', $assign->price);
		} else {
			$total = $cek->total + $assign->price;
			$this->db->set('total', $total);
		}
		$this->db->insert('saldo');
	}

	function getMySaldo($id){
		$this->db->from('saldo');
		$this->db->where('id_user', $id);
		return $this->db->get();
	}

	function getMyPayment($id){
		$this->db->from('pembayaran');
		$this->db->join('task', 'pembayaran.id_task = task.id_task');
		$this->db->where('id_user', $id);
		return $this->db->get();
	}

	function getIfPem($id){
		$this->db->select('id_task,amount,id_user');
		$this->db->from('pembayaran');
		$this->db->where('id_pembayaran', $id);
		return $this->db->get()->row();
	}

	function saldoIn($bal,$id_user){
		$cek = $this->db->select('*')->from('saldo')->where('id_user', $id_user)->order_by('date','DESC')->get()->row();
		$this->db->set('id_user', $id_user);
		$this->db->set('masuk', $bal);
		$this->db->set('keluar', 0);
		$this->db->set('ket', 3);
		$this->db->set('date', 'NOW()', FALSE);
		if ($cek == NULL) {
			$this->db->set('total', $bal);
		} else {
			$total = $cek->total + $bal;
			$this->db->set('total', $total);
		}
		$this->db->insert('saldo');
	}

	function saldoOut($bal,$id_user){
		$cek = $this->db->select('*')->from('saldo')->where('id_user', $id_user)->order_by('date','DESC')->get()->row();
		$this->db->set('id_user', $id_user);
		$this->db->set('masuk', 0);
		$this->db->set('keluar', $bal);
		$this->db->set('ket', 4);
		$this->db->set('date', 'NOW()', FALSE);
		$total = $cek->total - $bal;
		$this->db->set('total', $total);
		$this->db->insert('saldo');
	}

	function cutSaldo($bal,$id_user){
		$cek = $this->db->select('*')->from('saldo')->where('id_user', $id_user)->order_by('date','DESC')->get()->row();
		$this->db->set('id_user', $id_user);
		$this->db->set('masuk', 0);
		$this->db->set('keluar', $bal);
		$this->db->set('ket', 5);
		$this->db->set('date', 'NOW()', FALSE);
		$total = $cek->total - $bal;
		$this->db->set('total', $total);
		$this->db->insert('saldo');
	}

	function newDeduct($data){
		$this->db->set('date_updated', 'NOW()', FALSE);
		$this->db->insert('penarikan',$data);
		return $this->db->insert_id();
	}

	function getAllReq(){
		$this->db->from('penarikan');
		$this->db->join('users','penarikan.id_user = users.id');
		return $this->db->get();
	}

	function updateReq($id, $bukti, $sts){
		$this->db->set('date_updated', 'NOW()', FALSE);
		$this->db->set('bukti', $bukti);
		$this->db->set('status', $sts);
		$this->db->where('id_penarikan', $id);
		$this->db->update('penarikan');
	}

	function getMyDeduct($id){
		$this->db->from('penarikan');
		$this->db->where('id_user', $id);
		return $this->db->get();
	}
}
?>