<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends MX_Controller { 
	
	public $PAGE;
	public function __construct() {
        parent::__construct();
		$this->PAGE['title'] = 'Test | '.$this->load->get_var("default_title");
	
		// $this->load->model('topup/model_topup');
		// $this->load->model('topup/model_account');
		// $this->utils->checkLogin();
	}
	
	public function index()
	{
		$this->load->view("test_view",$this->PAGE);
	}

	
	


	
}
