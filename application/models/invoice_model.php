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
}
?>