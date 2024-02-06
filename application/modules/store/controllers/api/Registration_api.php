<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration_api extends MX_Controller { 
	public function __construct() {
        parent::__construct();
	}
	public function updateVat(){
		$this->membermanager->checkLogin();
		$respond = array();
		$respond['success'] = false;
		
		$store_id = $this->storemanager->store_id();
		$store_is_vat = $this->input->post("store_is_vat");
		
		$this->db->set("store_is_vat",$store_is_vat);
		$this->db->where("store_id",$store_id);
		$query = $this->db->update("store");
		if($query)$respond['success'] = true;
		echo json_encode($respond);
	}
	
}
