<?php
	/**
	* 
	*/
class Units_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function enter_data($projects_id, $unit_type, $option_id, $option)
	{
		$query = $this->db->insert_string('unit_options', array('project_id' => $projects_id , 'unit_type'=>$unit_type, 'option_id'=>$option_id, 'option'=>$option ));
		return $this->db->query($query);
	}
	public function search($unit){
		$query = $this->db->query("SELECT id,unit_no FROM client_booking WHERE unit_no LIKE '".$unit."%'");
		//$return_array = array('' => , );
		return $query->row();
	}
	public function search_all_types($project_id){
		$query = $this->db->query("SELECT DISTINCT unit_type FROM unit_options WHERE project_id LIKE '".$project_id."'");
		//$return_array = array('' => , );
		return $query->result();
	}
	public function get_options($project, $types){
		$query = $this->db->query("SELECT `option_id`, `option` FROM unit_options WHERE `unit_type`='".$types."' AND project_id LIKE '".$project."'");
		return $query->result();
	}
	public function save_data($project, $revenue_rate, $type, $options, $client_name, $client_id, $client_address, $client_city, $client_email, $client_contact, $booking_date, $unit_no, $rate, $floor_rise, $plc, $car_park, $car_park_cost, $cashback){
		$agr_value = $options*$rate+$floor_rise+$plc+$car_park_cost;
		$revenue = $agr_value*$revenue_rate*.01;
		$net_revenue = $revenue-$cashback;
		$this->db->insert('clients', array('name'=>$client_name, 'clients_id'=>$client_id, 'date'=>$booking_date, 'email'=>$client_email, 'phone'=>$client_contact, 'city'=>$client_city, 'address'=>$client_address));
		$client_id = $this->db->insert_id();
		$this->db->insert('client_booking', array('client_id' => $client_id, 'project_id'=>$project, 'booking_date'=>$booking_date, 'unit_no'=>$unit_no, 'unit_type'=>$type, 'size'=>$options, 'basic_rate'=>$rate, 'car_park'=>$car_park, 'car_park_cost'=>$car_park_cost, 'floor_rise'=>$floor_rise, 'plc'=>$plc, 'agr_value'=> $agr_value, 'revenue'=>$revenue, 'cashback'=>$cashback, 'net_revenue'=>$net_revenue));
		$booking_id = $this->db->insert_id();
		return $booking_id;
		//***********************client info****************
	}
	public function get_invoices($booking_id){
		$query = $this->db->query("SELECT * FROM unit_invoicing WHERE booking_id LIKE $booking_id");
		return $query->result();
	}
	public function get_collections($booking_id){
		$query = $this->db->query("SELECT * FROM unit_collection WHERE cu_id LIKE $booking_id");
		return $query->result();
	}
	public function get_booking_amount($booking_id){
		$query = $this->db->query("SELECT revenue FROM client_booking WHERE id LIKE $booking_id");
		return $query->row()->revenue;
	}
	public function get_all_units(){
		$query = $this->db->query("SELECT cb.id, cb.unit_no, projects.project FROM client_booking AS cb LEFT OUTER JOIN projects ON cb.project_id = projects.id ");
		return $query->result_array();
	}
	public function get_all_booking_data($id){
		$query = $this->db->query(" SELECT cb.*,clients.*, projects.*, executive.firstname, ecr.contribution
									FROM client_booking AS cb
									LEFT OUTER JOIN clients ON clients.id = cb.client_id
									LEFT OUTER JOIN projects ON projects.id = cb.project_id
									LEFT OUTER JOIN executive_client_unit_relation AS ecr ON cb.id = ecr.booking_id
									LEFT OUTER JOIN executive ON executive.id = ecr.executive_id
									WHERE cb.id LIKE  '".$id."' ") or die(mysql_error());
		return $query->result();
	}
	public function reverse_booking($id){
		$query = $this->db->query("UPDATE client_booking SET `is_reversed`='1' WHERE `id` LIKE $id");
		return $query->result();
	}
	public function delete_unit_value($project_id, $uid){
		$query = $this->db->query("DELETE FROM unit_options WHERE project_id LIKE $project_id AND uid LIKE $uid");
		return true;
	}
}
?>