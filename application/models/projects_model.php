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
			$this->db->insert('projects', array('builder'=>$builder, 'project'=>$project));
			return true;
	}
	public function search($project){
		$query = $this->db->query("SELECT id,project FROM projects WHERE project LIKE '".$project."%'");
		return $query->result();
	}
	public function get_all_projects(){
		$query = $this->db->query('SELECT id, project, builder FROM projects');
		return $query->result();
	}
}
?>