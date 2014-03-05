<?php
class Search extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('projects_model');
	}

	public function search_project()
	{
		$project = $this->input->post('project');
		return $project;
	}

}
?>