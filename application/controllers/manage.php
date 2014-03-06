<?php
class Manage extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('username') && !$this->session->userdata('userid')){
			redirect('login');
		}
		$this->load->model('executive_model');
		$this->load->model('projects_model');
		$this->load->model('units_model');
	}

	public function index()
	{
		$this->load->view('header');
		$this->load->view('manage_index');
		$this->load->view('footer');
	}
	public function logout(){
		$this->session->sess_destroy();
		redirect('login');
	}
	public function check(){
		echo (12*30)/100;
	}

	public function add_property(){
		$data['projects'] = $this->projects_model->get_all_projects();
		$this->form_validation->set_rules('project', 'Project Name', 'required|xss_safe|min_length[4]');
		$this->form_validation->set_rules('builder', 'Builder Name', 'required|xss_safe|min_length[4]');
		if($this->form_validation->run()==FALSE){
			$this->load->view('header');
			$this->load->view('manage_add_property', $data);
			$this->load->view('footer');
		}else{
			$this->projects_model->add_project();
			redirect('manage');
		}
		
	}
	public function search_project(){
		$project = $this->input->post('project');
		$suggestion = $this->projects_model->search($project);
		foreach ($suggestion as $key => $value) {
			echo anchor("manage/add_unit_value/$value->id", $value->project).'<br/>';
		}
		
	}
	public function add_unit_value($projects_id){
		$this->form_validation->set_rules('type', 'Unit Type', 'required|xss_safe|max_length[3]');
		$this->form_validation->set_rules('unit_no', 'Unit Number', 'required');
		$this->form_validation->set_rules('size', 'Unit Size', 'required|numeric');
		$this->form_validation->set_rules('basic_rate', 'Basic Rate', 'required|numeric');
		$this->form_validation->set_rules('floor_rise', 'Floor Rise Cose', 'required|numeric');
		$this->form_validation->set_rules('plc', 'PLC', 'required|numeric');
		$this->form_validation->set_rules('rev_rate', 'Revenue Rate', 'required|numeric');
		if($this->form_validation->run()==FALSE){
			$this->load->view('header');
			$this->load->view('manage_add_unit_value');
			$this->load->view('footer');
		}else{
			if($this->units_model->enter_data($projects_id)){
				redirect('manage');
			}else{
				echo "There Was Some Error!";
			}
		}
		
	}
	public function add_units(){
		$this->load->view('header');
		$this->load->view('manage_add_units');
		$this->load->view('footer');
	}
	public function search_unit(){
		$unit = $this->input->post('unit');
		$suggestion = $this->units_model->search($unit);
		foreach ($suggestion as $key => $value) {
			echo anchor("manage/make_booking/$value->id", $value->project).'<br/>';
		}
		
	}
	public function booking(){
		$this->load->view('header');
		$this->load->view('manage_booking');
		$this->load->view('footer');
	}
	public function make_booking($unit_id){
		$this->load->view('header');
		$this->load->view('manage_make_booking');
		$this->load->view('footer');
	}
	public function booking_edit(){
		$this->load->view('header');
		$this->load->view('manage_booking_edit');
		$this->load->view('footer');
	}


}
?>