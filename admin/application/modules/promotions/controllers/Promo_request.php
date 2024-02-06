<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promo_request extends MX_Controller { 
	
	public $PAGE;
	public function __construct() { 
        parent::__construct();
		$this->PAGE['title'] = 'โปรโมชั่น | '.$this->load->get_var("default_title");
	
		$this->load->model('promotions/model_promotions');
		$this->utils->checkLogin();
	}
	
	public function firstPromoRequest()
	{
		$this->load->view("promo_request_view",$this->PAGE);
	}
	
	public function verify($promo_id){
		$this->db->set("promo_status",2);
		$this->db->where("promo_id",$promo_id);
		$this->db->update("product_promo");


		redirect("promotions/promo_request/firstPromoRequest");
	}
	public function refuse($promo_id){
		$this->db->set("promo_status",3);
		$this->db->where("promo_id",$promo_id);
		$this->db->update("product_promo");


		redirect("promotions/promo_request/firstPromoRequest");
	}
	
}
