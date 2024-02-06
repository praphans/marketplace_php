<?php
class Model_user extends CI_Model {
  
  	public function getOrderTotalRows($member_id,$filter,$post)
	{
		$start_date = (isset($post['start_date']))?$post['start_date']:"";
		$end_date = (isset($post['end_date']))?$post['end_date']:"";
		$status_id = (isset($post['status_id']))?$post['status_id']:"";
		$gateway_type = (isset($post['gateway_type']))?$post['gateway_type']:"";
		$keyword_code = (isset($post['keyword_code']))?$post['keyword_code']:"";
		
		$this->db->select("order_id");
		$this->db->from("order");
		$this->db->where("order.order_member_id",$member_id);
		//$this->db->where("order_status != ",4);
		
		if($filter == "all"){
			
		}else if($filter == "myplace"){ // ส่งที่อยู่ผู้ซื้อ
			$this->db->where("order_shipping_type_id",4);
		}else if($filter == "otherplace"){ // รับของเอง
			$this->db->where("order_shipping_type_id != ",4);
		}
		if(isset($gateway_type) && !empty($gateway_type))$this->db->where("gateway_type_id",$gateway_type);
		if(isset($start_date) && !empty($start_date))$this->db->where("DATE(order.timestamp) >= ",$start_date);
		if(isset($end_date) && !empty($end_date))$this->db->where("DATE(order.timestamp) <= ",$end_date);
		if(isset($status_id) && !empty($status_id))$this->db->where("order_status",$status_id);
		if(isset($keyword_code) && !empty($keyword_code)){
			$this->db->where("(store.store_name LIKE '%".$keyword_code."%' OR store.first_name LIKE '%".$keyword_code."%' OR store.last_name LIKE '%".$keyword_code."%' OR order.order_code LIKE '%".$keyword_code."%' OR order.product_name LIKE '%".$keyword_code."%')", NULL, FALSE);
		}
		
		//$this->db->join("order_coupon","order.coupon_id = order_coupon.coupon_id");
		$this->db->join("store","order.store_id = store.store_id");
		$this->db->group_by("order_code");
		$query = $this->db->get();
		
		//$query = $this->db->query('SELECT order_id FROM  order WHERE member_id = '.$member_id.' AND order_status != 4 GROUP BY order_code');
		return $query->num_rows();
	}
	
	public function getOrderByMemberID($member_id,$per_page,$page_number,$post)
	{
		$start_date = (isset($post['start_date']))?$post['start_date']:"";
		$end_date = (isset($post['end_date']))?$post['end_date']:"";
		$status_id = (isset($post['status_id']))?$post['status_id']:"";
		$gateway_type = (isset($post['gateway_type']))?$post['gateway_type']:"";
		$keyword_code = (isset($post['keyword_code']))?$post['keyword_code']:"";
		
		$this->db->select("*,order.timestamp AS order_time");
		$this->db->from("order");
		$this->db->where("order.order_member_id",$member_id);
		//$this->db->where("order_status != ",4);
	
		if(isset($gateway_type) && !empty($gateway_type))$this->db->where("gateway_type_id",$gateway_type);
		if(isset($start_date) && !empty($start_date))$this->db->where("DATE(order.timestamp) >= ",$start_date);
		if(isset($end_date) && !empty($end_date))$this->db->where("DATE(order.timestamp) <= ",$end_date);
		if(isset($status_id) && !empty($status_id))$this->db->where("order_status",$status_id);
		if(isset($keyword_code) && !empty($keyword_code)){
			$this->db->where("(store.store_name LIKE '%".$keyword_code."%' OR store.first_name LIKE '%".$keyword_code."%' OR store.last_name LIKE '%".$keyword_code."%' OR order.order_code LIKE '%".$keyword_code."%' OR order.product_name LIKE '%".$keyword_code."%')", NULL, FALSE);
		}
		
		//$this->db->join("order_coupon","order.coupon_id = order_coupon.coupon_id");
		$this->db->join("store","order.store_id = store.store_id");
		$this->db->group_by("order_code");
		$this->db->order_by("order.timestamp","DESC");
		$this->db->limit($page_number,$per_page);
		$query = $this->db->get();
		
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	public function getOrderMyPlaceByMemberID($member_id,$per_page,$page_number,$post)
	{
		$start_date = (isset($post['start_date']))?$post['start_date']:"";
		$end_date = (isset($post['end_date']))?$post['end_date']:"";
		$status_id = (isset($post['status_id']))?$post['status_id']:"";
		$gateway_type = (isset($post['gateway_type']))?$post['gateway_type']:"";
		$keyword_code = (isset($post['keyword_code']))?$post['keyword_code']:"";
		
		$this->db->select("*,order.timestamp AS order_time");
		$this->db->from("order");
		$this->db->where("order.order_member_id",$member_id);
		//$this->db->where("order_status != ",4);
		$this->db->where("order_shipping_type_id",4);
		
		if(isset($gateway_type) && !empty($gateway_type))$this->db->where("gateway_type_id",$gateway_type);
		if(isset($start_date) && !empty($start_date))$this->db->where("DATE(order.timestamp) >= ",$start_date);
		if(isset($end_date) && !empty($end_date))$this->db->where("DATE(order.timestamp) <= ",$end_date);
		if(isset($status_id) && !empty($status_id))$this->db->where("order_status",$status_id);
		if(isset($keyword_code) && !empty($keyword_code)){
			$this->db->where("(store.store_name LIKE '%".$keyword_code."%' OR store.first_name LIKE '%".$keyword_code."%' OR store.last_name LIKE '%".$keyword_code."%' OR order.order_code LIKE '%".$keyword_code."%' OR order.product_name LIKE '%".$keyword_code."%')", NULL, FALSE);
		}
		
		//$this->db->join("order_coupon","order.coupon_id = order_coupon.coupon_id");
		$this->db->join("store","order.store_id = store.store_id");
		$this->db->group_by("order_code");
		$this->db->order_by("order.timestamp","DESC");
		$this->db->limit($page_number,$per_page);
		$query = $this->db->get();
		
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
		
	}
	public function getOrderOtherPlaceByMemberID($member_id,$per_page,$page_number,$post)
	{
		$start_date = (isset($post['start_date']))?$post['start_date']:"";
		$end_date = (isset($post['end_date']))?$post['end_date']:"";
		$status_id = (isset($post['status_id']))?$post['status_id']:"";
		$gateway_type = (isset($post['gateway_type']))?$post['gateway_type']:"";
		$keyword_code = (isset($post['keyword_code']))?$post['keyword_code']:"";
		
		$this->db->select("*,order.timestamp AS order_time");
		$this->db->from("order");
		$this->db->where("order.order_member_id",$member_id);
		//$this->db->where("order_status != ",4);
		$this->db->where("order_shipping_type_id != ",4);
		
		if(isset($gateway_type) && !empty($gateway_type))$this->db->where("gateway_type_id",$gateway_type);
		if(isset($start_date) && !empty($start_date))$this->db->where("DATE(order.timestamp) >= ",$start_date);
		if(isset($end_date) && !empty($end_date))$this->db->where("DATE(order.timestamp) <= ",$end_date);
		if(isset($status_id) && !empty($status_id))$this->db->where("order_status",$status_id);
		if(isset($keyword_code) && !empty($keyword_code)){
			$this->db->where("(store.store_name LIKE '%".$keyword_code."%' OR store.first_name LIKE '%".$keyword_code."%' OR store.last_name LIKE '%".$keyword_code."%' OR order.order_code LIKE '%".$keyword_code."%' OR order.product_name LIKE '%".$keyword_code."%')", NULL, FALSE);
		}
		
		//$this->db->join("order_coupon","order.coupon_id = order_coupon.coupon_id");
		$this->db->join("store","order.store_id = store.store_id");
		$this->db->group_by("order_code");
		$this->db->order_by("order.timestamp","DESC");
		$this->db->limit($page_number,$per_page);
		$query = $this->db->get();
		
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	
	//coupon
	public function getCouponTotalRows($member_id,$post,$coupon_status)
	{
		$start_date = (isset($post['start_date']))?$post['start_date']:"";
		$end_date = (isset($post['end_date']))?$post['end_date']:"";
		$status_id = (isset($post['status_id']))?$post['status_id']:"";
		$gateway_type = (isset($post['gateway_type']))?$post['gateway_type']:"";
		$keyword_code = (isset($post['keyword_code']))?$post['keyword_code']:"";
		
		$this->db->select("order_id");
		$this->db->from("order");
		$this->db->where("order.order_member_id",$member_id);
		$this->db->where("order.order_status != ",4);
		$this->db->where("order_coupon.coupon_status",$coupon_status);
		
		if(isset($start_date) && !empty($start_date))$this->db->where("DATE(order.timestamp) >= ",$start_date);
		if(isset($end_date) && !empty($end_date))$this->db->where("DATE(order.timestamp) <= ",$end_date);
		if(isset($status_id) && !empty($status_id))$this->db->where("order_status",$status_id);
		if(isset($keyword_code) && !empty($keyword_code)){
			$this->db->where("(store.store_name LIKE '%".$keyword_code."%' OR store.first_name LIKE '%".$keyword_code."%' OR store.last_name LIKE '%".$keyword_code."%' OR order.order_code LIKE '%".$keyword_code."%' OR order.product_name LIKE '%".$keyword_code."%')", NULL, FALSE);
		}
		
		$this->db->join("order_coupon","order.coupon_id = order_coupon.coupon_id");
		$this->db->join("store","order.store_id = store.store_id");
		$this->db->group_by("order.order_code");
		$query = $this->db->get();
		
		//$query = $this->db->query('SELECT order_id FROM  order WHERE member_id = '.$member_id.' AND order_status != 4 GROUP BY order_code');
		return $query->num_rows();
	}
	public function getCouponByMemberID($member_id,$per_page,$page_number,$post)
	{
		$start_date = (isset($post['start_date']))?$post['start_date']:"";
		$end_date = (isset($post['end_date']))?$post['end_date']:"";
		$status_id = (isset($post['status_id']))?$post['status_id']:"";
		$gateway_type = (isset($post['gateway_type']))?$post['gateway_type']:"";
		$keyword_code = (isset($post['keyword_code']))?$post['keyword_code']:"";
		
		$this->db->select("*,order.timestamp AS order_time");
		$this->db->from("order");
		$this->db->where("order.order_member_id",$member_id);
		$this->db->where("order_coupon.coupon_status",1);
		//$this->db->where("order.order_status != ",4);
	
		
		if(isset($start_date) && !empty($start_date))$this->db->where("DATE(order.timestamp) >= ",$start_date);
		if(isset($end_date) && !empty($end_date))$this->db->where("DATE(order.timestamp) <= ",$end_date);
		if(isset($status_id) && !empty($status_id))$this->db->where("order.order_status",$status_id);
		if(isset($keyword_code) && !empty($keyword_code)){
			$this->db->where("(store.store_name LIKE '%".$keyword_code."%' OR store.first_name LIKE '%".$keyword_code."%' OR store.last_name LIKE '%".$keyword_code."%' OR order.order_code LIKE '%".$keyword_code."%' OR order.product_name LIKE '%".$keyword_code."%')", NULL, FALSE);
		}
		
		$this->db->join("order_coupon","order.coupon_id = order_coupon.coupon_id");
		$this->db->join("store","order.store_id = store.store_id");
		$this->db->group_by("order.order_code");
		$this->db->order_by("order.timestamp","DESC");
		$this->db->limit($page_number,$per_page);
		$query = $this->db->get();
		
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	public function getCouponExpireByMemberID($member_id,$per_page,$page_number,$post)
	{
		$start_date = (isset($post['start_date']))?$post['start_date']:"";
		$end_date = (isset($post['end_date']))?$post['end_date']:"";
		$status_id = (isset($post['status_id']))?$post['status_id']:"";
		$gateway_type = (isset($post['gateway_type']))?$post['gateway_type']:"";
		$keyword_code = (isset($post['keyword_code']))?$post['keyword_code']:"";
		
		$this->db->select("*,order.timestamp AS order_time");
		$this->db->from("order");
		$this->db->where("order.order_member_id",$member_id);
		$this->db->where("order_coupon.coupon_status",3); // คูปองหมดอายุ
		//$this->db->where("order_status != ",4);
		$this->db->where("order_shipping_type_id",4);
		
		if(isset($start_date) && !empty($start_date))$this->db->where("DATE(order.timestamp) >= ",$start_date);
		if(isset($end_date) && !empty($end_date))$this->db->where("DATE(order.timestamp) <= ",$end_date);
		if(isset($status_id) && !empty($status_id))$this->db->where("order_status",$status_id);
		if(isset($keyword_code) && !empty($keyword_code)){
			$this->db->where("(store.store_name LIKE '%".$keyword_code."%' OR store.first_name LIKE '%".$keyword_code."%' OR store.last_name LIKE '%".$keyword_code."%' OR order.order_code LIKE '%".$keyword_code."%' OR order.product_name LIKE '%".$keyword_code."%')", NULL, FALSE);
		}
		
		$this->db->join("order_coupon","order.coupon_id = order_coupon.coupon_id");
		$this->db->join("store","order.store_id = store.store_id");
		$this->db->group_by("order_code");
		$this->db->order_by("order.timestamp","DESC");
		$this->db->limit($page_number,$per_page);
		$query = $this->db->get();
		
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
		
	}
	public function getCouponSuccessByMemberID($member_id,$per_page,$page_number,$post)
	{
		$start_date = (isset($post['start_date']))?$post['start_date']:"";
		$end_date = (isset($post['end_date']))?$post['end_date']:"";
		$status_id = (isset($post['status_id']))?$post['status_id']:"";
		$gateway_type = (isset($post['gateway_type']))?$post['gateway_type']:"";
		$keyword_code = (isset($post['keyword_code']))?$post['keyword_code']:"";
		
		$this->db->select("*,order.timestamp AS order_time");
		$this->db->from("order");
		$this->db->where("order.order_member_id",$member_id);
		$this->db->where("order_coupon.coupon_status",2); // ใช้คูปองสำเร็จ
		//$this->db->where("order_status != ",4);
		//$this->db->where("order_shipping_type_id != ",4);
		
		
		if(isset($start_date) && !empty($start_date))$this->db->where("DATE(order.timestamp) >= ",$start_date);
		if(isset($end_date) && !empty($end_date))$this->db->where("DATE(order.timestamp) <= ",$end_date);
		if(isset($status_id) && !empty($status_id))$this->db->where("order_status",$status_id);
		if(isset($keyword_code) && !empty($keyword_code)){
			$this->db->where("(store.store_name LIKE '%".$keyword_code."%' OR store.first_name LIKE '%".$keyword_code."%' OR store.last_name LIKE '%".$keyword_code."%' OR order.order_code LIKE '%".$keyword_code."%' OR order.product_name LIKE '%".$keyword_code."%')", NULL, FALSE);
		}
		
		$this->db->join("order_coupon","order.coupon_id = order_coupon.coupon_id");
		$this->db->join("store","order.store_id = store.store_id");
		$this->db->group_by("order_code");
		$this->db->order_by("order.timestamp","DESC");
		$this->db->limit($page_number,$per_page);
		$query = $this->db->get();
		
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	
	
	
	public function getOrderByOrderCode($order_code)
	{
		$query = $this->db->query('SELECT * FROM  order WHERE order_code = "'.$order_code.'" ORDER BY timestamp DESC');
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	public function getOrderStatus($status_id)
	{
		$query = $this->db->query('SELECT * FROM  order_status WHERE id = '.$status_id);
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	public function getAllOrderGatewayType()
	{
		$query = $this->db->query('SELECT * FROM  payment_gateway_type');
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	public function getAllOrderStatus()
	{
		$query = $this->db->query('SELECT * FROM  order_status');
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	public function getProductByID($product_id)
	{
		$query = $this->db->query('SELECT * FROM  product WHERE product_id = '.$product_id);
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	public function getStoreByID($store_id)
	{
		$query = $this->db->query('SELECT * FROM  store WHERE store_id = '.$store_id);
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	public function getProductImage($product_id)
	{
		$query = $this->db->query('SELECT * FROM  product_image WHERE product_id = '.$product_id.' LIMIT 1');
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	public function getMemberByID($member_id)
	{
		$query = $this->db->query('SELECT * FROM member WHERE member_id = '.$member_id);
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
}

?>
