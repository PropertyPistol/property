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
	public function edit($id){
		$data['executives'] = $this->executive_model->get_all();
		$data['all_data'] = $this->units_model->get_all_booking_data($id);
		$data['invoice_and_collection'] = $this->invoice_model->get_data_for_booking($id);
		$data['id'] = $id;
		$booking_id = $id;
		
		if(!$this->input->post('submit')){
			$this->load->view('header');
			$this->load->view('booking_edit', $data);
			$this->load->view('footer');
		}else{
			$client_name = $this->input->post('client_name');
			$client_id = $this->input->post('client_id');
			$client_address = $this->input->post('client_address');
			$client_city = $this->input->post('client_city');
			$client_email = $this->input->post('client_email');
			$client_contact = $this->input->post('client_contact');
			$booking_date = $this->input->post('booking_date');
			$unit_no = $this->input->post('unit_no');
			$exec_array = $this->input->post('executive');
			$contri_array = $this->input->post('contribution');
			$update = $this->units_model->update_data($booking_id, $client_name, $client_id, $client_address, $client_city, $client_email, $client_contact, $booking_date, $unit_no);
				foreach ($exec_array as $key => $value) {
					if($contri_array[$key]!=0){
						$this->executive_model->save_contributions($id, $exec_array[$key], $contri_array[$key]);
					}
										
				}			
			if($update){
				$this->session->set_flashdata('success', 'Successful');
			}
			redirect("booking/edit/$id");
		}
		
		
	}
	public function remove_executive_contri($booking_id, $executive_id){
		if($this->executive_model->remove_executive_contri($booking_id, $executive_id)){
			$this->session->set_flashdata('exec_remove', "Successful");
		}
		redirect("booking/edit/$booking_id");
	}
	public function delete_booking($booking_id){
		if($this->check_admin()){
			$this->units_model->delete_booking($booking_id);
			$this->executive_model->delete_for_booking($booking_id);
			$this->session->set_flashdata('booking_deleted', "<span class='flash'>Booking Deleted!</span>");
		}else{
			$this->session->set_flashdata('error', "<span class='flash'>Not Authorized!</span>");
		}
		redirect('booking/view');
	}
	private function check_admin(){
		if($this->session->userdata('is_admin')==1){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	

}