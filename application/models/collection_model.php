<?php
	/**
	* 
	*/
class Collection_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function add_collection($booking_id, $last_net_outstanding, $booking_amount)
	{
		$invoice_no = $this->input->post('collection_no');
		$invoice = $this->input->post('collection');
		$invoice_month = $this->input->post('collection_month');
		if($last_net_outstanding){
			$net_outstanding = $last_net_outstanding - $invoice;
		}else{
			$net_outstanding = $booking_amount - $invoice;
		}
		$query = $this->db->query("INSERT INTO unit_collection (`cu_id`, `collection_no`, `collection`, `month`, `net_outstanding`) VALUES ($booking_id, $invoice_no, $invoice, '$invoice_month', $net_outstanding) ");
	}
	public function get_last_outstanding($booking_id){
		$query = $this->db->query("SELECT net_outstanding FROM unit_collection WHERE cu_id LIKE $booking_id ORDER BY collection_no DESC LIMIT 1");
		$row = $query->row();
		if($row){
			return $row->net_outstanding;
		}else{
			return 0;
		}
		
	}
}
?>