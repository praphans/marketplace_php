<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contactmassage extends MX_Controller { 
	
	public $PAGE;	
	public function __construct() {
        parent::__construct();
        $this->PAGE['title'] = 'ข้อความติดต่อ | '.$this->load->get_var("default_title");
		$this->load->model('contactmassage/model_contactmassage');
		$this->load->helper(array('form', 'url'));
		$config['upload_path'] = 'uploads';
		$config['allowed_types'] = 'svg|gif|jpg|png'; 
		$config['encrypt_name'] = TRUE;
		$this->utils->checkLogin();
		$this->load->library('upload', $config);
	}
	
	public function index(){
	
		$this->load->view('contactmassage_view',$this->PAGE);	
	}
	
	
}
