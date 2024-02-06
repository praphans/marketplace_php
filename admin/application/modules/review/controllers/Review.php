<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Review extends MX_Controller { 
	
	public $PAGE;	
	public function __construct() {
        parent::__construct();
        $this->PAGE['title'] = 'รีวิว | '.$this->load->get_var("default_title");
		$this->load->model('review/model_review');
		$this->load->library('review/review_libs');
		$this->load->helper(array('form', 'url'));
		$config['upload_path'] = 'uploads';
		$config['allowed_types'] = 'svg|gif|jpg|png'; 
		$config['encrypt_name'] = TRUE;
		$this->utils->checkLogin();
		$this->load->library('upload', $config);
	}
	public function index($review_type_id = 0,$store_id = 0){
		$this->PAGE['current_review_type_id'] = $review_type_id;
		$this->PAGE['current_store_id'] = $store_id;
		$this->load->view('review_view',$this->PAGE);
	}
	
	
}
