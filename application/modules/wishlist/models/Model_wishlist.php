<?php
class Model_wishlist extends CI_Model {
 
 	public function getWishlistTotalRows($post = array()) 
	{     
	
		$store_id_list = (isset($post["store_id_list"]))?$post["store_id_list"]:array();
		$view_page_number = (isset($post["view_page_number"]))?$post["view_page_number"]:0;
		$view_per_page = (isset($post["view_per_page"]))?$post["view_per_page"]:0;
		$main_category_id = (isset($post["main_category_id"]))?$post["main_category_id"]:0;
		$sub_category_id = (isset($post["sub_category_id"]))?$post["sub_category_id"]:0;
		$new_product = (isset($post["new_product"]))?$post["new_product"]:0;
		$second_hand_product = (isset($post["second_hand_product"]))?$post["second_hand_product"]:0;
		$is_delivery = (isset($post["is_delivery"]))?$post["is_delivery"]:0;
		$no_delivery = (isset($post["no_delivery"]))?$post["no_delivery"]:0;
		$gateway_type_1 = (isset($post["gateway_type_1"]))?$post["gateway_type_1"]:0;
		$gateway_type_2 = (isset($post["gateway_type_2"]))?$post["gateway_type_2"]:0;
		$gateway_type_3 = (isset($post["gateway_type_3"]))?$post["gateway_type_3"]:0;
		
		
		$gateway = array();
		$type = array();
		
		if(isset($gateway_type_1) && $gateway_type_1 != 0)array_push($gateway,$gateway_type_1);
		if(isset($gateway_type_2) && $gateway_type_2 != 0)array_push($gateway,$gateway_type_2);
		if(isset($gateway_type_3) && $gateway_type_3 != 0)array_push($gateway,$gateway_type_3);
		
		
		if(isset($new_product) && $new_product != 0)array_push($type,$new_product);
		if(isset($second_hand_product) && $second_hand_product != 0)array_push($type,$second_hand_product);
		
		
		$this->db->select('*');
		$this->db->from('wishlist');
		
		
		//$this->db->join("payment_gateway","payment_gateway.gateway_type_id = wishlist.gateway_id");
		
		if(count($store_id_list)>0)$this->db->where_in("store_id",$store_id_list);
		if(count($gateway)>0)$this->db->where_in("gateway_type_id",$gateway);
		if(count($type)>0)$this->db->where_in("product_type",$type);
		/*if(isset($gateway_type_1) && $gateway_type_1 != 0)$this->db->or_where("gateway_type_id",1);
		if(isset($gateway_type_2) && $gateway_type_2 != 0)$this->db->or_where("gateway_type_id",2);
		if(isset($gateway_type_3) && $gateway_type_3 != 0)$this->db->or_where("gateway_type_id",3);*/
		
		//if(isset($new_product) && $new_product != 0)$this->db->where("product_type",1);
		//if(isset($second_hand_product) && $second_hand_product != 0)$this->db->where("product_type",2);
		if(isset($main_category_id) && $main_category_id != 0)$this->db->where("product_category",$main_category_id);
		if(isset($sut_category_id) && $sut_category_id != 0)$this->db->where("product_subcategory",$sut_category_id);
		
		if($this->membermanager->isLoggedIn()){
			$member_id = $this->membermanager->member_id();
			$this->db->where("member_id",$member_id);
		}else{
			$sess_id = $this->session->userdata("sess_id");
			$this->db->where("sess_id",$sess_id);
		}
		$query = $this->db->get();
		return $query->num_rows();
	}
 	
	public function getProductWishlist($post,$main_category_id,$sut_category_id,$per_page,$page_number){
		
		$store_id_list = (isset($post["store_id_list"]))?$post["store_id_list"]:array();
		$view_page_number = (isset($post["view_page_number"]))?$post["view_page_number"]:0;
		$view_per_page = (isset($post["view_per_page"]))?$post["view_per_page"]:0;
		$main_category_id = (isset($post["main_category_id"]))?$post["main_category_id"]:0;
		$sub_category_id = (isset($post["sub_category_id"]))?$post["sub_category_id"]:0;
		$new_product = (isset($post["new_product"]))?$post["new_product"]:0;
		$second_hand_product = (isset($post["second_hand_product"]))?$post["second_hand_product"]:0;
		$is_delivery = (isset($post["is_delivery"]))?$post["is_delivery"]:0;
		$no_delivery = (isset($post["no_delivery"]))?$post["no_delivery"]:0;
		$gateway_type_1 = (isset($post["gateway_type_1"]))?$post["gateway_type_1"]:0;
		$gateway_type_2 = (isset($post["gateway_type_2"]))?$post["gateway_type_2"]:0;
		$gateway_type_3 = (isset($post["gateway_type_3"]))?$post["gateway_type_3"]:0;
		
		$view_type = (count($post) && $post["view_type"])?$post["view_type"]:0;
		
		
		$gateway = array();
		$type = array();
		
		if(isset($gateway_type_1) && $gateway_type_1 != 0)array_push($gateway,$gateway_type_1);
		if(isset($gateway_type_2) && $gateway_type_2 != 0)array_push($gateway,$gateway_type_2);
		if(isset($gateway_type_3) && $gateway_type_3 != 0)array_push($gateway,$gateway_type_3);
		
		if(isset($new_product) && $new_product != 0)array_push($type,$new_product);
		if(isset($second_hand_product) && $second_hand_product != 0)array_push($type,$second_hand_product);
		
		$this->db->select('*');
		$this->db->from('wishlist');
		if($this->membermanager->isLoggedIn()){
			$member_id = $this->membermanager->member_id();
			$this->db->where("member_id",$member_id);
		}else{
			$sess_id = $this->session->userdata("sess_id");
			$this->db->where("sess_id",$sess_id);
		}
		
		//$this->db->join("payment_gateway","payment_gateway.gateway_id = wishlist.gateway_id");
		
		if(count($store_id_list)>0)$this->db->where_in("store_id",$store_id_list);
		if(count($gateway)>0)$this->db->where_in("gateway_type_id",$gateway);
		if(count($type)>0)$this->db->where_in("product_type",$type);
		
		/*if(isset($gateway_type_1) && $gateway_type_1 != 0)$this->db->or_where("gateway_type_id",1);
		if(isset($gateway_type_2) && $gateway_type_2 != 0)$this->db->or_where("gateway_type_id",2);
		if(isset($gateway_type_3) && $gateway_type_3 != 0)$this->db->or_where("gateway_type_id",3);*/
		
		//if(isset($new_product) && $new_product != 0)$this->db->where("product_type",1);
		//if(isset($second_hand_product) && $second_hand_product != 0)$this->db->where("product_type",2);
		if(isset($main_category_id) && $main_category_id != 0)$this->db->where("product_category",$main_category_id);
		if(isset($sut_category_id) && $sut_category_id != 0)$this->db->where("product_subcategory",$sut_category_id);
		
		
		if($view_type == "popular"){
			$this->db->order_by('product_point','DESC');
		}else if($view_type == "price_hight"){
			$this->db->order_by('product_price_discount','DESC');
		}else if($view_type == "price_low"){
			$this->db->order_by('product_price_discount','ASC');
		}else if($view_type == "rating"){
			$this->db->order_by('product_rating','DESC');
		}else if($view_type == "news"){
			$this->db->order_by('timestamp','DESC');
		}else{
			$this->db->order_by('timestamp','DESC');
		}
		
		
		//$this->db->join("wishlist","product.product_id = wishlist.product_id");
		$this->db->limit($per_page,$page_number);
		$query = $this->db->get();
		
		if($query->num_rows() > 0 ) {
		  	return $query->result();
		} else {
		  	return array();
		}
	}
	public function getMessageType() 
	{     
		$this->db->select('*');
		$this->db->from('message_type');
		$this->db->where_in("id",$this->message_type_for_user);
		$query = $this->db->get();
		
		if($query->num_rows() > 0 ) {
		  	return $query->result();
		} else {
		  	return array();
		}
	}
	
}
?>
