<?php
class News extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('news_model');
	}

	public function index()
	{
		$data['titles'] = $this->news_model->get_news();
		$this->load->view('news/index', $data);
	}

}