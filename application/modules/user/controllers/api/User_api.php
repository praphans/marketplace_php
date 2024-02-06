<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_api extends MX_Controller {

	public $PAGE;
	public function __construct() {
        parent::__construct();
		$this->load->model('model_user');
		$this->membermanager->checkLogin();
	}
	public function index()
	{
		redirect("user/setting/info");
	}
	
	public function saveShipping(){
		$is_tax = $this->input->post('is_tax');
		$place_id = $this->input->post('place_id');
		$place_is_default = $this->input->post('place_is_default');
		$place_is_default_tax = $this->input->post('place_is_default_tax');
		
		$member_id = $this->membermanager->member_id();
		$store_id = $this->storemanager->store_id();
		if($is_tax == 0){
			$this->db->set("place_is_default",0);
		}else{
			$this->db->set("place_is_default_tax",0);
		}
		if(!empty($member_id))$this->db->where("member_id",$member_id);
		if(!empty($store_id))$this->db->or_where("store_id",$store_id);
		$this->db->update("store_place");
		
		$this->db->set("place_is_default",$place_is_default);
		$this->db->set("place_is_default_tax",$place_is_default_tax);
		$this->db->where("place_id",$place_id);
		$query = $this->db->update("store_place");
		echo $query;
	}
	
}