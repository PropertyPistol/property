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
			return $this->db->insert_id();
	}
	public function get_array($project_id){
		$query = $this->db->query("SELECT * FROM projects LEFT OUTER JOIN unit_options ON projects.id = unit_options.project_id WHERE projects.id LIKE $project_id");
		return $query->result();
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
	public function update_project($project_id){
		$data = array(
               'project' => $this->input->post('project'),
               'builder' => $this->input->post('builder'),
               'brokerage' => $this->input->post('brokerage')
            );

			$this->db->where('id', $project_id);
			$this->db->update('projects', $data); 
			return true;
	}
}
?>