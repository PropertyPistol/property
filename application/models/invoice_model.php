<?php
	/**
	* 
	*/
class Invoice_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function add_invoice($booking_id)
	{
		$invoice_no = $this->input->post('invoice_no');
		$invoice = $this->input->post('invoice');
		$invoice_month = $this->input->post('invoice_month');
			$query = $this->db->query("INSERT INTO unit_invoicing (`booking_id`, `invoice_no`, `invoice`, `invoice_month`) VALUES ($booking_id, $invoice_no, $invoice, '$invoice_month') ");
	}
	public function add_invoice_data($booking_id, $percent){
		$data = array(
			'invoice_serial' 	=>	$this->input->post('invoice_no'),
			'invoice_no'		=> 	implode('-', $this->input->post('invoice_serial')),
			'invoice_amount'	=> 	$this->input->post('invoice_amount'),
			'invoice_month'		=>	$this->input->post('invoice_month'),
			'booking_id'		=>	$booking_id,
			'percent'			=>	$percent
			);
		$query = $this->db->insert('new_invoice', $data);
		if($query){
			return TRUE;
		}
	}
	public function get_all_invoice(){
		$qu = $this->db->query("SELECT * FROM new_invoice");
		return $qu->result();
	}
	public function update_invoice($invoice_no){
		$this->db->set('collected', '1')->where('invoice_no', $invoice_no);
		$this->db->update('new_invoice');
	}
	public function get_data_for_booking($id){
		$query = $this->db->query("SELECT * FROM new_invoice WHERE `booking_id` LIKE $id");
		return $query->result();
	}
}
?>