<?php
class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('executive_model');
		if($this->session->userdata('username')&&$this->session->userdata('userid')){
			redirect('manage');
		}
	}

	public function index()
	{	
		//var_dump($this->session->userdata);
		$this->form_validation->set_rules('username', 'Username', 'required|trim|xss_safe');
		$this->form_validation->set_rules('password', 'Password', 'required|trim|xss_safe');
		if($this->form_validation->run()==FALSE){
				$this->load->view('header');
				$this->load->view('login_index');
				$this->load->view('footer');
		}
		else{
			if($this->executive_model->authenticate()==TRUE){
				redirect('manage');
			}
			else{
				$data['error'] = "<span style='background:yellow;'>Invalid Credentials</span>";
				$this->load->view('header');
				$this->load->view('login_index', $data);
				$this->load->view('footer');
			}
		}
		
	}

}