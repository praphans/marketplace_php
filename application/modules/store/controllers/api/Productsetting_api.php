<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productsetting_api extends MX_Controller { 
	public function __construct() {
        parent::__construct();
	}
	public function updateCategoryCustomer(){
		$this->membermanager->checkLogin();
		$respond = array();
		$respond['success'] = false;
		
		$product_id = $this->input->post("product_id");
		$product_category_customer = $this->input->post("product_category_customer");
		
		
		$respond['product_id'] = $product_id;
		$respond['product_category_customer'] = $product_category_customer;
		$this->db->set("product_category_customer",$product_category_customer);
		$this->db->where("product_id",$product_id);
		$query = $this->db->update("product");
		
		$this->db->select("product_category_customer");
		$this->db->from("product");
		$this->db->where("product_id",$product_id);
		$query = $this->db->get();
		$result = $query->result();
		foreach($result as $row){
			$product_category_customer = $row->product_category_customer;
		}
		
		$product_category_customer_list = explode(",",$product_category_customer);
		$this->db->select("category_name");
		$this->db->from("product_category_customer");
		$this->db->where_in("id",$product_category_customer_list);
		$query = $this->db->get();
		$result = $query->result();
		$product_tags = array();
		foreach($result as $row){
			$category_name = $row->category_name;
			array_push($product_tags,$category_name);
		}
		$product_tags = implode(",",$product_tags);
		$this->db->set("product_tags",$product_tags);
		$this->db->where("product_id",$product_id);
		$query = $this->db->update("product");
		
		if($query)$respond['success'] = true;
		echo json_encode($respond);
	}
	public function updateIsRelate(){
		$this->membermanager->checkLogin();
		$respond = array();
		$respond['success'] = false;
		
		$product_id = $this->input->post("product_id");
		$product_is_relate = $this->input->post("product_is_relate");
		
		$respond['product_id'] = $product_id;
		$respond['product_is_relate'] = $product_is_relate;
		$this->db->set("product_is_relate",$product_is_relate);
		$this->db->where("product_id",$product_id);
		$query = $this->db->update("product");
		
		//$query = $this->db->query("SELECT relate_id FROM  product_relate WHERE relate_id = ".$promo_id);
		
		if($query)$respond['success'] = true;
		echo json_encode($respond);
	}
	public function updateQty(){
		$this->membermanager->checkLogin();
		$respond = array();
		$respond['success'] = false;
		
		$product_id = $this->input->post("product_id");
		$product_qty = $this->input->post("product_qty");
		
		$respond['product_id'] = $product_id;
		$respond['product_qty'] = $product_qty;
		$this->db->set("product_qty",$product_qty);
		$this->db->where("product_id",$product_id);
		$query = $this->db->update("product");
		if($query)$respond['success'] = true;
		echo json_encode($respond);
	}
	public function updatePriceAndDiscount(){
		$this->membermanager->checkLogin();
		$respond = array();
		$respond['success'] = false;
		
		$product_id = $this->input->post("product_id");
		$product_price = $this->input->post("product_price");
		$product_percentage_discount = $this->input->post("product_percentage_discount");
		$product_price_discount = $this->input->post("product_price_discount");
		
		
		$respond['product_id'] = $product_id;
		$respond['product_price'] = $product_price;
		$respond['product_percentage_discount'] = $product_percentage_discount;
		$respond['product_price_discount'] = $product_price_discount;
		
		$this->db->set("product_price",$product_price);
		$this->db->set("product_percentage_discount",$product_percentage_discount);
		$this->db->set("product_price_discount",$product_price_discount);
		
		$this->db->where("product_id",$product_id);
		$query = $this->db->update("product");
		
		
		$this->db->set("product_price_discount",$product_price_discount);
		$this->db->where("product_id",$product_id);
		$query2 = $this->db->update("cart");
		
		
		if($query)$respond['success'] = true;
		echo json_encode($respond);
	}
	public function updatePromo(){
		$this->membermanager->checkLogin();
		$respond = array();
		$respond['success'] = false;
		
		$promo_id = $this->input->post("promo_id");
		$product_id = $this->input->post("product_id");
		$promo_name = $this->input->post("promo_name");
		$promo_startdate = $this->input->post("promo_startdate");
		$promo_starttime = $this->input->post("promo_starttime");
		$promo_enddate = $this->input->post("promo_enddate");
		$promo_endtime = $this->input->post("promo_endtime");
		$promo_price = $this->input->post("promo_price");
		$promo_status = $this->input->post("promo_status");
			
		$respond['promo_id'] = $promo_id;
		$respond['product_id'] = $product_id;
		$respond['promo_name'] = $promo_name;
		$respond['promo_startdate'] = $promo_startdate;
		$respond['promo_starttime'] = $promo_starttime;
		$respond['promo_enddate'] = $promo_enddate;
		$respond['promo_endtime'] = $promo_endtime;
		$respond['promo_price'] = $promo_price;
		$respond['promo_status'] = $promo_status;
		
		$query = $this->db->query("SELECT promo_id FROM  product_promo WHERE promo_id = ".$promo_id);
		
		$this->db->set("promo_name",$promo_name);
		$this->db->set("promo_startdate",$promo_startdate);
		$this->db->set("promo_starttime",$promo_starttime);
		$this->db->set("promo_enddate",$promo_enddate);
		$this->db->set("promo_endtime",$promo_endtime);
		$this->db->set("promo_price",$promo_price);
		$this->db->set("promo_status",$promo_status);
		
		if($query->num_rows()){
			$this->db->where("promo_id",$promo_id);
			$query = $this->db->update("product_promo");
		}else{
			$this->db->set("product_id",$product_id);
			$query = $this->db->insert("product_promo");
			$respond['promo_id'] = $this->db->insert_id();
		}
		
		
		$this->db->set("product_price_discount",$promo_price);
		$this->db->where("product_id",$product_id);
		$query2 = $this->db->update("cart");
		
		
		if($query)$respond['success'] = true;
		echo json_encode($respond);
	}
	public function updatePromoJoin(){
		$this->membermanager->checkLogin();
		$respond = array();
		$respond['success'] = false;
		
		$join_id = $this->input->post("join_id");
		$product_id = $this->input->post("product_id");
		$promo_price = $this->input->post("promo_price");
		$promo_type = $this->input->post("promo_type");
		$promo_status = $this->input->post("promo_status");
			
		$respond['join_id'] = $join_id;
		$respond['product_id'] = $product_id;
		$respond['promo_price'] = $promo_price;
		$respond['promo_type'] = $promo_type;
		$respond['promo_status'] = $promo_status;
		
		$this->db->set("join_id",$join_id);
		$this->db->set("product_id",$product_id);
		$this->db->set("promo_price",$promo_price);
		$this->db->set("promo_type",$promo_type);
		$this->db->set("promo_status",$promo_status);
		
		$query = $this->db->query("SELECT promo_id FROM  product_promo WHERE join_id = ".$join_id." AND product_id = ".$product_id);
		$num_rows = $query->num_rows();
		$respond['num_rows'] = $num_rows;
		if($num_rows){
			//$this->db->where("join_id",$join_id);
			//$this->db->where("product_id",$product_id);
			//$query = $this->db->update("product_promo");
		}else{
			$this->db->set("product_id",$product_id);
			$query = $this->db->insert("product_promo");
			$respond['promo_id'] = $this->db->insert_id();
		}
		
		$this->db->set("product_price_discount",$promo_price);
		$this->db->where("product_id",$product_id);
		$query2 = $this->db->update("cart");
		
		
		if($query)$respond['success'] = true;
		echo json_encode($respond);
	}
	public function delPromo(){
		$this->membermanager->checkLogin();
		$respond = array();
		$respond['success'] = false;
		
		$promo_id = $this->input->post("promo_id");
		$respond['promo_id'] = $promo_id;
		$query = $this->db->query("SELECT promo_id FROM  product_promo WHERE promo_id = ".$promo_id);
		if($query->num_rows()){
			$this->db->where("promo_id",$promo_id);
			$query = $this->db->delete("product_promo");
		}
		if($query)$respond['success'] = true;
		echo json_encode($respond);
	}
	
	public function delPromoJoin(){
		$this->membermanager->checkLogin();
		$respond = array();
		$respond['success'] = false;
		
		$product_id = $this->input->post("product_id");
		$join_id = $this->input->post("join_id");
		
		$query = $this->db->query("SELECT * FROM  product_promo WHERE product_id = ".$product_id." AND join_id = ".$join_id);
		if($query->num_rows()){
			$this->db->where("product_id",$product_id);
			$this->db->where("join_id",$join_id);
			$query = $this->db->delete("product_promo");
		}
		if($query)$respond['success'] = true;
		echo json_encode($respond);
	}
	
	public function savePayment(){
		$this->membermanager->checkLogin();
		$respond = array();
		$respond['success'] = false;
		
		$product_id = $this->input->post("product_id");
		$gateway_type_id = $this->input->post("gateway_type_id");
		$option1 = $this->input->post("option1");
		$option2 = $this->input->post("option2");
		
		$product_id = $this->input->post("product_id");
		$gateway_type_id = $this->input->post("gateway_type_id");
		$option1 = $this->input->post("option1");
		$option2 = $this->input->post("option2");
		
		$respond['product_id'] = $product_id;
		$respond['gateway_type_id'] = $gateway_type_id;
		$respond['option1'] = $option1;
		$respond['option2'] = $option2;
		
		$this->db->set("product_id",$product_id);
		$this->db->set("gateway_type_id",$gateway_type_id);
		$this->db->set("option1",$option1);
		$this->db->set("option2",$option2);
		
		$query = $this->db->query("SELECT gateway_id FROM  payment_gateway WHERE product_id = ".$product_id);
		if($query->num_rows()){
			$this->db->where("product_id",$product_id);
			$query = $this->db->update("payment_gateway");
			
			$this->db->set("gateway_type_id",$gateway_type_id);
			$this->db->where("product_id",$product_id);
			$query = $this->db->update("product");
			
			$this->db->set("gateway_type_id",$gateway_type_id);
			$this->db->where("product_id",$product_id);
			$query = $this->db->update("wishlist");
			
			
		}else{
			$query = $this->db->insert("payment_gateway");
			$gateway_id = $this->db->insert_id();
			$respond['gateway_id'] = $gateway_id;
			$this->db->set("gateway_id",$gateway_id);
			$this->db->set("gateway_type_id",$gateway_type_id);
			$this->db->where("product_id",$product_id);
			$query = $this->db->update("product");
			
			$this->db->set("gateway_type_id",$gateway_type_id);
			$this->db->where("product_id",$product_id);
			$query = $this->db->update("wishlist");
		}
		
		if($query)$respond['success'] = true;
		echo json_encode($respond);
	}
	
}
