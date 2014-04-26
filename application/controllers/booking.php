<?php
class Booking extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('username') && !$this->session->userdata('userid')){
			redirect('login');
		}
		$this->load->model('executive_model');
		$this->load->model('projects_model');
		$this->load->model('units_model');
		$this->load->model('invoice_model');
		$this->load->model('collection_model');
		$this->load->model('incentives_model');
	}

	public function index($id)
	{		
		$data['all_data'] = $this->units_model->get_all_booking_data($id);
		$data['invoice_and_collection'] = $this->invoice_model->get_data_for_booking($id);
		$data['id'] = $id;

		$this->load->view('booking_index', $data);

	}
	public function reversal($id){
		if($this->units_model->reverse_booking($id)){
			redirect('manage');
		}
		
	}
	public function view(){
		$data['all_units'] = $this->units_model->get_all_units();
		$this->form_validation->set_rules('booking_id', "Booking Id", 'required|trim|integer|xss_safe');
		$this->load->view('header');
		$this->load->view('booking_dropdown', $data);
		if($this->form_validation->run()==FALSE){
			
		}else{
			$this->index($this->input->post('booking_id'));
		}
		$this->load->view('footer');
	}

}