<?php
class Incentives_model extends CI_Model{

	public function __construct(){
		$this->load->database();
	}
	public function get_data($month, $executive_id){
		$query = $this->db->query("SELECT * FROM client_booking AS cb
			RIGHT OUTER JOIN executive_client_unit_relation AS ecur ON cb.id = ecur.booking_id
			LEFT OUTER JOIN new_invoice ON cb.id = new_invoice.booking_id
			WHERE ecur.executive_id LIKE $executive_id AND MONTH(cb.booking_date) LIKE $month");
		return $query->result();
	}
	public function freeze_incentive($executive_id,$month,$spot_inc,$first_inc,$second_inc,$third_inc){
		$query = $this->db->query("SELECT id FROM new_exec_incentive WHERE exec_id LIKE $executive_id AND month LIKE $month");
		if($query->num_rows() > 0){
			$data = array(
				'20spot_deal' => $spot_inc,
				'15spot_deal' => $first_inc,
				'15spot_deal' => $second_inc,
				'40spot_deal' => $third_inc
				);
			$this->db->where('exec_id', $executive_id);
			$this->db->where('month', $month);
			$this->db->update('new_exec_incentive', $data); 
			return TRUE;
		}else{
			$data = array(
				'exec_id' => $executive_id ,
				'month' => $month ,
				'20spot_deal' => $spot_inc,
				'15spot_deal' => $first_inc,
				'15spot_deal' => $second_inc,
				'40spot_deal' => $third_inc
				);

			$this->db->insert('new_exec_incentive', $data); 
			return TRUE;
		}
	}
	public function get_all_data(){
		$years = $this->input->post('year');
		$months = $this->input->post('month');
		$exec_ids = $this->input->post('exec_id');
		$query = $this->db->query("SELECT cb.*, executive.firstname, new_invoice.invoice_serial, new_invoice.invoice_no, new_invoice.invoice_month, new_invoice.invoice_amount, new_invoice.percent, new_invoice.collected, ecur.* FROM client_booking AS cb
			RIGHT OUTER JOIN executive_client_unit_relation AS ecur ON cb.id = ecur.booking_id
			LEFT OUTER JOIN new_invoice ON cb.id = new_invoice.booking_id
			LEFT OUTER JOIN executive ON ecur.executive_id = executive.id
			WHERE ecur.executive_id IN (" . implode(',', $exec_ids) . ") AND MONTH(cb.booking_date) IN (" . implode(',', $months) . ") AND YEAR(cb.booking_date) IN (" . implode(',', $years) . ")");
		return $query->result();
	}
}
?>