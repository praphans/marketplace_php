<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_api extends MX_Controller {
	public function __construct() {
        parent::__construct();
	}
	public function delProduct(){
		$this->membermanager->checkLogin();
		
		$product_id = $this->input->post("product_id");
		
		$this->db->set("product_status",5);
		$this->db->where("product_id",$product_id);
		$query = $this->db->update("product");
		echo json_encode($query);
	}
	public function delImage(){
		$this->membermanager->checkLogin();
		$image_id = $this->input->post("image_id");
		$this->db->where("id",$image_id);
		$query = $this->db->delete("product_image");
		echo json_encode($query);
	}
	
	public function saveProductRecommend(){
		$this->membermanager->checkLogin();
		
		$product_id = $this->input->post("product_id");
		$product_recommend = $this->input->post("product_recommend");
		
		$this->db->set("product_recommend",$product_recommend);
		$this->db->where("product_id",$product_id);
		$query = $this->db->update("product");
		echo json_encode($query);
	}
	public function saveProductShow(){
		$this->membermanager->checkLogin();
		
		$product_id = $this->input->post("product_id");
		$product_show = $this->input->post("product_show");
		
		$this->db->set("product_show",$product_show);
		$this->db->where("product_id",$product_id);
		$query = $this->db->update("product");
		echo json_encode($query);
	}
	public function loadProductSubCategory(){
		$product_category = $this->input->post("product_category");
		$this->db->select("*");
		$this->db->from("product_subcategory");
		$this->db->where("category_id",$product_category);
		$query = $this->db->get();
		echo json_encode($query->result());
	}
}
