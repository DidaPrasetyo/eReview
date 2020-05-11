<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Model {

	public function newPayment($data){
		$this->db->set('date_updated', 'NOW()', FALSE);
		$this->db->insert('pembayaran',$data);
	}
}
?>