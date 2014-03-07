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
		$query = $this->db->query("SELECT  DISTINCT projects.id, projects.project, units.type FROM projects LEFT OUTER JOIN units ON projects.id = units.projects_id WHERE units.is_booked = '0' AND units.type LIKE '".$unit."'");
		//$return_array = array('' => , );
		return $query->result();
	}
}
?>