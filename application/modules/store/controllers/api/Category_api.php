<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_api extends MX_Controller {
	public function __construct() {
        parent::__construct();
	}
	public function updateCategory(){
		$this->membermanager->checkLogin();
		$respond = array();
		$respond['success'] = false;
		
		$category_id = $this->input->post("category_id");
		$category_status = $this->input->post("category_status");
		
		$this->db->set("category_status",$category_status);
		$this->db->where("id",$category_id);
		$query = $this->db->update("product_category_customer");
		
		if($query)$respond['success'] = true;
		
		echo json_encode($query);
	}
	public function delCategory(){
		$this->membermanager->checkLogin();
		$respond = array();
		$respond['success'] = false;
		
		$category_id = $this->input->post("category_id");
		$category_status = $this->input->post("category_status");
		
		$this->db->set("category_status",$category_status);
		$this->db->where("id",$category_id);
		$query = $this->db->update("product_category_customer");
		
		if($query)$respond['success'] = true;
		
		echo json_encode($query);
	}
}
