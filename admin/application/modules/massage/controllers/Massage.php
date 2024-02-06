<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class massage extends MX_Controller { 
	
	public $PAGE;	
	public function __construct() {
        parent::__construct();
        $this->PAGE['title'] = 'ร้องเรียน | '.$this->load->get_var("default_title");
		$this->load->model('massage/model_massage');
		$this->load->helper(array('form', 'url'));
		$config['upload_path'] = 'uploads';
		$config['allowed_types'] = 'svg|gif|jpg|png'; 
		$config['encrypt_name'] = TRUE;
		$this->utils->checkLogin();
		$this->load->library('upload', $config);
	}
	
	public function index(){
	
		$this->load->view('massage_view',$this->PAGE);	
	}
	public function descriptMassagr($message_id){
		$massage = $this->model_massage->getMassageByID($message_id);
		$this->PAGE['massage'] = $massage;
		$this->load->view('massage_description_view',$this->PAGE);	
	}
	
	
}
