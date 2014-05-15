<?php
class Manage extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('username') && !$this->session->userdata('userid')){
			redirect('login');
		}
		$this->userid = $this->session->userdata('userid');
		$this->load->model('executive_model');
		$this->load->model('projects_model');
		$this->load->model('units_model');
		$this->load->model('invoice_model');
		$this->load->model('collection_model');
		$this->load->model('incentives_model');
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
		$this->form_validation->set_rules('brokerage', 'Brokerage', 'required|xss_safe|numeric');


		$this->form_validation->set_rules('type[]', 'Unit Type', 'required|xss_safe');

		$this->form_validation->set_rules('size[]', 'Unit Size', 'required|numeric');

		if($this->form_validation->run()==FALSE){
			$this->load->view('header');
			$this->load->view('manage_add_property', $data);
			$this->load->view('manage_add_unit_value');
			$this->load->view('manage_show_added_projects');
			$this->load->view('footer');
		}else{
			$project_id = $this->projects_model->add_project();
			$array = $this->input->post('size');
			$type = $this->input->post('type');
			foreach ($array as $key => $value) {
				$this->units_model->enter_data($project_id, $type[$key], $key+1, $value);
			}
			redirect('manage/add_property');
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
		$this->form_validation->set_rules('type', 'Unit Type', 'required|xss_safe');

		$this->form_validation->set_rules('size[]', 'Unit Size', 'required|numeric');
		if($this->form_validation->run()==FALSE){
			$this->load->view('header');
			$this->load->view('manage_add_unit_value');
			$this->load->view('footer');
		}else{
			
			redirect('manage');
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
		echo anchor("manage/booking_edit/$suggestion->id", $suggestion->unit_no, array('class'=>'suggestion'));
	}
	public function project_booking_search(){
		$project = $this->input->post('project');
		$suggestion = $this->projects_model->search($project);
		foreach ($suggestion as $key => $value) {
			
			echo "<a class='disable' onClick=init() data-id=\"$value->id\" data-name=\"$value->project\" value=$value->id href=\"javascript:void(0)\">$value->project</a><br/>";
		}
	}	
	public function search_types(){
		$project_id = $this->input->post('project');
		$types = $this->units_model->search_all_types($project_id);

			$options = array();
			foreach ($types as $key => $value) {
				$options[$value->unit_type] = $value->unit_type;
			}
			echo form_dropdown('types', $options);
		/*$suggestion = $this->projects_model->search($project);
		foreach ($suggestion as $key => $value) {
			echo "<a class='disable' onClick=init($value->id) value=$value->id href=\"javascript:void(0)\">$value->project</a><br/>";
		}*/
	}
	public function account(){
		$this->form_validation->set_rules('old_password', 'Old Password', 'required|xss_safe');
		$this->form_validation->set_rules('new_password', 'New Password', 'required|xss_safe');
		$this->form_validation->set_rules('conf_new_password', 'Confirm Password', 'required|xss_safe');
		if($this->form_validation->run()===FALSE){
			$this->load->view('header');
			$this->load->view('manage_account');
			$this->load->view('footer');
		}else{
			$o_password = $this->input->post('old_password');
			$n_password = $this->input->post('new_password');
			$c_password = $this->input->post('conf_new_password');
			if($this->check_old_password_validity_for_user($this->userid, $o_password)){
				if($n_password===$c_password){
					$this->executive_model->update_password($this->userid, $n_password);
					$this->session->set_flashdata('success', "<span style='background:yellow;'>Success</span>");
					redirect('manage/account');
				}else{
					$this->session->set_flashdata('error', "<span style='background:yellow;'>Confirm password does not matches</span>");
					redirect('manage/account');
				}
			}else{
				$this->session->set_flashdata('error', "<span style='background:yellow;'>Old Password is incorrect</span>");
				redirect('manage/account');
			}
		}
		//echo $this->userid;
	}
	public function booking(){
		$this->form_validation->set_rules('project', 'Project', 'required|xss_safe');
		$this->form_validation->set_rules('types', 'Unit Type', 'required|xss_safe');
		if($this->form_validation->run()==FALSE){
			$this->load->view('header');
			$this->load->view('manage_booking');
			$this->load->view('footer');
		}else{
			$project = $this->input->post('project_id');
			$types = $this->input->post('types');
			$data['executives'] = $this->executive_model->get_all();
			$data['options'] = $this->units_model->get_options($project, $types);
			$data['types'] = $types;
			$data['project'] = $project;
			$this->load->view('header');
			$this->load->view('manage_make_booking', $data);
			$this->load->view('footer');
		}
		
	}
	public function make_booking($project){

		$revenue_rate = $this->projects_model->get_revenue($project);
		$type = $this->input->post('types');
		//$this->units_model->save_data($project, $revenue_rate);
		$client_name = $this->input->post('client_name');
		$client_id = $this->input->post('client_id');
		$client_address = $this->input->post('client_address');
		$client_city = $this->input->post('client_city');
		$client_email = $this->input->post('client_email');
		$client_contact = $this->input->post('client_contact');
		$booking_date = $this->input->post('booking_date');
		$options = $this->input->post('options');
		$unit_no = $this->input->post('unit_no');
		$rate = $this->input->post('rate');
		$floor_rise = $this->input->post('floor_rise');
		$plc = $this->input->post('plc');
		$car_park = $this->input->post('car_park');
		$car_park_cost = $this->input->post('car_park_cost');
		$cashback = $this->input->post('cashback');
		$exec_array = $this->input->post('executive');
		$contri_array = $this->input->post('contribution');
		$comments = $this->input->post('comments');
		$booking_id = $this->units_model->save_data($project, $revenue_rate, $type, $options, $client_name, $client_id, $client_address, $client_city, $client_email, $client_contact, $booking_date, $unit_no, $rate, $floor_rise, $plc, $car_park, $car_park_cost, $cashback, $comments);
		foreach ($exec_array as $key => $value) {
			$this->executive_model->save_contributions($booking_id, $exec_array[$key], $contri_array[$key]);
			
		}
		$this->session->set_flashdata('booking_done', "<span class='flash'>Booking Success!</span>");
		redirect('manage/booking');
		/*echo $project;
		echo br();
		
		var_dump($this->input->post('executive'));
		echo br();
		var_dump($this->input->post('contribution'));
		$revenue_rate = $this->projects_model->get_revenue($project);
		echo $revenue_rate;
		// */
	}
	public function incentives(){
		$data['executives'] = $this->executive_model->get_all();
		$this->load->view('header');
		$this->load->view('manage_incentives', $data);
		$this->load->view('footer');
	}
	public function booking_edit($booking_id){
		$this->load->view('header');
		$this->load->view('manage_booking_edit', array('booking_id'=>$booking_id));
		$this->load->view('footer');
	}
	public function booking_details(){
		$this->load->view('header');
		$this->load->view('manage_booking_details');
		$this->load->view('footer');

	}
	public function add_invoice(){
		$this->form_validation->set_rules('invoice_no', 'Invoice Number', 'numeric|required|xss_safe');
		$this->form_validation->set_rules('invoice_serial[]', 'Invoice Serial', 'required|xss_safe|trim');
		$this->form_validation->set_rules('invoice_amount', 'Invoice Amount', 'numeric|required|xss_safe');
		$this->form_validation->set_rules('invoice_month', 'Invoice Month', 'required');
		$this->form_validation->set_rules('booking_id[]', 'Booking Id', 'required|xss_safe|trim');
		$this->form_validation->set_rules('percent[]', 'Percent', 'required|numeric');
		if($this->form_validation->run()==FALSE){
			//$data['invoices'] = $this->units_model->get_invoices($booking_id);
			//$data['booking_id'] = $booking_id;
			$data['all_units'] = $this->units_model->get_all_units();
			$data['invoices'] = $this->invoice_model->get_all_invoice();
			$this->load->view('header');			
			$this->load->view('manage_invoice', $data);
			$this->load->view('footer');
		}else{
			$booking_ids = $this->input->post('booking_id');
			$percent = $this->input->post('percent');
			foreach ($booking_ids as $key => $value) {
				$this->invoice_model->add_invoice_data($booking_ids[$key], $percent[$key]);
			}
			redirect('manage/add_invoice');
			/*
			foreach ($this->input->post('booking_id') as $key => $value) {
				$this->invoice_model->add_invoice_data($this->input->post('booking_id')[$key], $this->input->post('percent')[$key]);
			}
			redirect('manage');
			*/
			//$this->invoice_model->add_invoice($booking_id);
			//redirect('manage');
		}
	}
	public function collection_done($invoice_no){
		$this->invoice_model->update_invoice($invoice_no);
		redirect('manage/add_invoice');
	}
	public function get_incentive($executive_id){
		$this->load->view('header');
		$data['executive_id'] = $executive_id;
		$this->load->view('manage_get_incentive', $data);
		if($this->input->post('submit')){
			$this->get_incentive_data($this->input->post('month'), $executive_id);
		}
		$this->load->view('footer');
	}
	private function get_incentive_data($month, $executive_id){
		$user_incentive = $this->incentives_model->get_data($month, $executive_id);
		$data['incentive_array'] = $user_incentive;
		$data['executive_id'] = $executive_id;
		$data['month'] = $month;
		$this->load->view('manage_show_incentives', $data);
	}
	public function freeze_incentive($executive_id,$month,$spot_inc,$first_inc,$second_inc,$third_inc){
		if($this->incentives_model->freeze_incentive($executive_id,$month,$spot_inc,$first_inc,$second_inc,$third_inc)){
			redirect('manage');
		}
	}
	public function edit_project($project_id){
		$data['project_details'] = $this->projects_model->get_array($project_id);
		$data['projects'] = $this->projects_model->get_all_projects();

		$this->form_validation->set_rules('project', 'Project Name', 'required|xss_safe|min_length[4]');
		$this->form_validation->set_rules('builder', 'Builder Name', 'required|xss_safe|min_length[4]');
		$this->form_validation->set_rules('brokerage', 'Brokerage', 'required|xss_safe|numeric');
		//$this->form_validation->set_rules('type', 'Unit Type', 'required|xss_safe');
		//$this->form_validation->set_rules('size[]', 'Unit Size', 'required|numeric');
		
		if($this->form_validation->run()==FALSE && !$this->input->post('submit')){
			$this->load->view('header');
			$this->load->view('manage_edit_project', $data);
			$this->load->view('footer');
		}else{
			$this->projects_model->update_project($project_id);
			$array = $this->input->post('size');
			$type = $this->input->post('type');
			if($array && $type){
				foreach ($array as $key => $value) {
					$this->units_model->enter_data($project_id, $type[$key], $key+1, $value);
				}
			}
			
			redirect("manage/edit_project/$project_id");
		}
		
	}
	public function delete_unit_value($project_id, $uid){
		if($this->check_admin()){
			$this->units_model->delete_unit_value($project_id, $uid);
			$this->session->set_flashdata('unit_deletion', "<span class='flash'>Successfully removed unit option</span>");
			redirect("manage/edit_project/$project_id");
		}else{
			$this->session->set_flashdata('unit_deletion', "<span style='background:yellow;'>You are not authorized for this!</span>");
			redirect("manage/edit_project/$project_id");
		}
	}
	private function check_old_password_validity_for_user($userid, $password){
		return $this->executive_model->check_old_password_validity_for_user($userid, $password);
	}
	public function delete_project($project_id){
		if($this->check_admin()){
			if($this->projects_model->delete_entry($project_id)){
				$this->session->set_flashdata('project_deleted', "<span style='background:yellow;'>Project Deleted</span>");
				redirect('manage/add_property');
			}
		}else{
			$this->session->set_flashdata('project_deleted', "<span style='background:yellow;'>You are not authorized for this!</span>");
			redirect('manage/add_property');
		}
	}
	private function check_admin(){
		if($this->session->userdata('is_admin')==1){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	public function reporting(){
		if($this->check_admin()){
			$this->form_validation->set_rules('year[]', 'Year', 'required');
			$this->form_validation->set_rules('month[]', 'Month', 'required');
			$this->form_validation->set_rules('exec_id[]', 'Executive', 'required');
			if($this->form_validation->run()===FALSE){
				$data['executives'] = $this->executive_model->get_all();
				$this->load->view('header');
				$this->load->view('manage_reporting', $data);
				$this->load->view('footer');
			}else{
				$data['all_data'] = $this->incentives_model->get_all_data();
				$this->load->view('manage_show_reporting', $data);
				//var_dump($this->input->post('year'));
				//var_dump($this->input->post('month'));
				//var_dump($this->input->post('exec_id'));
			}
			
		}else{
			$this->session->set_flashdata('authorized', "<span class='flash'>Not Authorized</span>");
			redirect('manage');
		}
	}
	/*
	public function add_invoice($booking_id){
		$this->form_validation->set_rules('invoice_no', 'Invoice Number', 'numeric|required|xss_safe');
		$this->form_validation->set_rules('invoice', 'Invoice Value', 'numeric|required|xss_safe');
		$this->form_validation->set_rules('invoice_month', 'Invoice Month', 'required');
		if($this->form_validation->run()==FALSE){
			$this->load->view('header');
			$data['invoices'] = $this->units_model->get_invoices($booking_id);
			$data['booking_id'] = $booking_id;
			$this->load->view('manage_add_invoice', $data);
			$this->load->view('footer');
		}else{
			$this->invoice_model->add_invoice($booking_id);
			redirect('manage');
		}
	}
	public function add_collection($booking_id){
		$this->form_validation->set_rules('collection_no', 'Collection Number', 'numeric|required|xss_safe');
		$this->form_validation->set_rules('collection', 'Collection Value', 'numeric|required|xss_safe');
		$this->form_validation->set_rules('collection_month', 'Collection Value', 'required');
		$last_net_outstanding = $this->collection_model->get_last_outstanding($booking_id);
		$booking_amount = $this->units_model->get_booking_amount($booking_id);
		if($this->form_validation->run()==FALSE){
			$this->load->view('header');
			$data['collections'] = $this->units_model->get_collections($booking_id);
			$data['booking_id'] = $booking_id;
			$this->load->view('manage_add_collection', $data);
			$this->load->view('footer');
		}else{
			$this->collection_model->add_collection($booking_id, $last_net_outstanding, $booking_amount);
			redirect('manage');
		}

	}
	*/

}
?>