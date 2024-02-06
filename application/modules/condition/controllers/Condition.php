<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Condition extends MX_Controller {

	public $PAGE;
	public function __construct() {
        parent::__construct();
		$this->PAGE['title'] = 'เงื่อนไขและข้อกำหนด | '.$this->load->get_var("default_title");
		
		
	}
	public function index()
	{
		$this->load->view("condition_view",$this->PAGE);
	}
	
}