<?php
	/**
	* 
	*/
class Units_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function enter_data($projects_id)
	{
		$type = $this->input->post('type');
		$unit_no = $this->input->post('unit_no');
		$size = $this->input->post('size');
		$basic_rate = $this->input->post('basic_rate');
		$car_park = $this->input->post('car_park');
		$floor_rise = $this->input->post('floor_rise');
		$plc = $this->input->post('plc');
		$rev_rate = $this->input->post('rev_rate');
		$agr_value = $size*$basic_rate + $floor_rise + $plc;
		$revenue = ($agr_value*$rev_rate)/100;
		$data = array(
				'projects_id'	=>	"$projects_id",
				'type'			=>	"$type",
				'unit_no'		=>	"$unit_no",
				'size'			=>	"$size",
				'basic_rate'	=>	"$basic_rate",
				'car_park'		=>	"$car_park",
				'floor_rise'	=>	"$floor_rise",
				'plc'			=>	"$plc",
				'agr_value'		=>	"$agr_value",
				'rev_rate'		=>	"$rev_rate",
				'revenue'		=>	"$revenue",
			);
			$query = $this->db->insert_string('units', $data);
			$result = $this->db->query($query);
			return $result;
	}
	public function search($unit){
		$query = $this->db->query("SELECT units.id, units.unit_no, projects.project FROM units LEFT OUTER JOIN projects ON projects.id = units.projects_id WHERE units.type LIKE '".$unit."%'");
		return $query->result();
	}
}
?>