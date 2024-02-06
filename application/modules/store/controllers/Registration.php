<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends MX_Controller {   

	public $PAGE;
	public function __construct() {
        parent::__construct();
		
		$this->PAGE['title'] = 'ทะเบียนร้านค้า | '.$this->load->get_var("default_title");
		$this->membermanager->checkLogin();
		$this->load->helper(array('form', 'url'));
		$config['upload_path'] = 'uploads';
		$config['allowed_types'] = 'svg|gif|jpg|png|doc|doc'; 
		$config['encrypt_name'] = TRUE;
		$this->load->library('upload', $config);
		$this->load->model('store/model_registration');
		//$this->storemanager->hasStore();
	}
	public function index()
	{
		$myStore = $this->storemanager->myStore();
		$this->PAGE['myStore'] = $myStore;
		$this->load->view("store/10_".$this->router->fetch_class()."/registration_view",$this->PAGE);
	}
	public function edit(){
		$myStore = $this->storemanager->myStore();
		$this->PAGE['myStore'] = $myStore;
		$this->load->view("store/10_".$this->router->fetch_class()."/registration_edit_view",$this->PAGE);
		
	}
}