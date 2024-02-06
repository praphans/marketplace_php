<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends MX_Controller {

	public $PAGE;
	public function __construct() {
        parent::__construct();
		$this->PAGE['title'] = 'หมวดหมู่ร้านค้า | '.$this->load->get_var("default_title");
		$this->load->model("model_category"); 
		$this->load->model("model_shop"); 
	}
	public function index($product_id,$product_name)
	{
		//$this->PAGE['product'] = $product;
		//$this->PAGE['category'] = $this->model_shop->getCategory();
		$this->load->view("product_detail_view",$this->PAGE);	
	}
}