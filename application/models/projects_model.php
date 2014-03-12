<?php
	/**
	* 
	*/
class Projects_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

	public function add_project()
	{
			$project = $this->input->post('project');
			$builder = $this->input->post('builder');
			$brokerage = $this->input->post('brokerage');
			$this->db->insert('projects', array('builder'=>$builder, 'project'=>$project, 'brokerage'=>$brokerage));
			return true;
	}
	public function search($project){
		$query = $this->db->query("SELECT id,project FROM projects WHERE project LIKE '".$project."%'");
		return $query->result();
	}
	public function get_all_projects(){
		$query = $this->db->query('SELECT id, project, builder, brokerage FROM projects');
		return $query->result();
	}
	public function get_revenue($project){
		$query = $this->db->query("SELECT brokerage FROM projects WHERE id LIKE $project");
		return $query->row()->brokerage;
	}
}
?>