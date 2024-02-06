<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Itemstores extends MX_Controller { 
	
	public $PAGE;
	public function __construct() {
        parent::__construct();
		$this->PAGE['title'] = 'รายการทางบัญชี | '.$this->load->get_var("default_title");
	
		$this->load->model('itemstores/model_itemstores');
		$this->utils->checkLogin();
	}
	
	public function index()
	{	
		$this->load->view("itemstores_view",$this->PAGE);
	}
	public function itemStoresInfo($depositor_store_id,$seller_store_id)
	{	
		$this->PAGE['depositor_store_id'] = $depositor_store_id;
		$this->PAGE['seller_store_id'] = $seller_store_id;
		$this->load->view('modals/itemstores_info_view',$this->PAGE);	
	}

	
	


	
}
