<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promotion extends MX_Controller {

	public $PAGE;
	public function __construct() {
        parent::__construct();
		$this->PAGE['title'] = 'โปรโมชั่น | '.$this->load->get_var("default_title");
		$this->load->model("promotion/model_promotion");
	}
	public function index()
	{
		$this->PAGE['promotions'] = $this->model_promotion->getAllPromotion();
		$this->load->view("promotion_view",$this->PAGE);	
	}
}