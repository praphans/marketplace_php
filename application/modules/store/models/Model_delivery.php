<?php
class Model_delivery extends CI_Model {
  
  	public function getOrderTotalRows($store_id,$post)
	{
		$start_date = (isset($post['start_date']))?$post['start_date']:"";
		$end_date = (isset($post['end_date']))?$post['end_date']:"";
		$order_place_id = (isset($post['order_place_id']))?$post['order_place_id']:"";
		$order_status = (isset($post['order_status']))?$post['order_status']:"";
		$keyword_code = (isset($post['keyword_code']))?$post['keyword_code']:"";
		
		$this->db->select("order_id");
		$this->db->from("order");
		$this->db->where("order.depositor_store_id",$store_id);
		//$this->db->where("order_status != ",4);
		
		if(isset($start_date) && !empty($start_date))$this->db->where("DATE(order.timestamp) >= ",$start_date);
		if(isset($end_date) && !empty($end_date))$this->db->where("DATE(order.timestamp) <= ",$end_date);
		if(isset($order_place_id) && $order_place_id != 0)$this->db->where("store_place.request_place_id",$order_place_id);
		if(isset($order_status) && $order_status != 0)$this->db->where("order_status",$order_status);
		if(isset($keyword_code) && !empty($keyword_code)){
			$this->db->where("(store.store_name LIKE '%".$keyword_code."%' OR store.first_name LIKE '%".$keyword_code."%' OR store.last_name LIKE '%".$keyword_code."%' OR order.order_code LIKE '%".$keyword_code."%' OR order.product_name LIKE '%".$keyword_code."%')", NULL, FALSE);
		}
		
		$this->db->join("store_place","store_place.place_id = order.order_place_id");
		$this->db->join("store","order.depositor_store_id = store.store_id");
		$this->db->group_by("order_code");
		$query = $this->db->get();
		
		//$query = $this->db->query('SELECT order_id FROM  order WHERE store_id = '.$store_id.' AND order_status != 4 GROUP BY order_code');
		return $query->num_rows();
	}
	
	public function getOrderByStoreID($store_id,$per_page,$page_number,$post)
	{
		$start_date = (isset($post['start_date']))?$post['start_date']:"";
		$end_date = (isset($post['end_date']))?$post['end_date']:"";
		$order_place_id = (isset($post['order_place_id']))?$post['order_place_id']:"";
		$order_status = (isset($post['order_status']))?$post['order_status']:"";
		$keyword_code = (isset($post['keyword_code']))?$post['keyword_code']:"";
		
		$this->db->select("*,order.timestamp,order.store_id AS seller_store_id");
		$this->db->from("order");
		$this->db->where("order.depositor_store_id",$store_id);
		//$this->db->where("order_status != ",4);
	
		
		if(isset($start_date) && !empty($start_date))$this->db->where("DATE(order.timestamp) >= ",$start_date);
		if(isset($end_date) && !empty($end_date))$this->db->where("DATE(order.timestamp) <= ",$end_date);
		if(isset($order_place_id) && $order_place_id != 0)$this->db->where("store_place.request_place_id",$order_place_id);
		if(isset($order_status) && $order_status != 0)$this->db->where("order_status",$order_status);
		if(isset($keyword_code) && !empty($keyword_code)){
			$this->db->where("(store.store_name LIKE '%".$keyword_code."%' OR store.first_name LIKE '%".$keyword_code."%' OR store.last_name LIKE '%".$keyword_code."%' OR order.order_code LIKE '%".$keyword_code."%' OR order.product_name LIKE '%".$keyword_code."%')", NULL, FALSE);
		}
		
		$this->db->join("store_place","store_place.place_id = order.order_place_id");
		$this->db->join("store","order.depositor_store_id = store.store_id");
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
	public function getOrderMyPlaceByStoreID($store_id,$per_page,$page_number,$post)
	{
		$start_date = (isset($post['start_date']))?$post['start_date']:"";
		$end_date = (isset($post['end_date']))?$post['end_date']:"";
		$order_place_id = (isset($post['order_place_id']))?$post['order_place_id']:"";
		$order_status = (isset($post['order_status']))?$post['order_status']:"";
		$keyword_code = (isset($post['keyword_code']))?$post['keyword_code']:"";
		
		$this->db->select("*,order.timestamp,order.store_id AS seller_store_id");
		$this->db->from("order");
		$this->db->where("order.depositor_store_id",$store_id);
		//$this->db->where("order_status != ",4);
		$this->db->where("order_shipping_type_id",4);
		
		if(isset($start_date) && !empty($start_date))$this->db->where("DATE(order.timestamp) >= ",$start_date);
		if(isset($end_date) && !empty($end_date))$this->db->where("DATE(order.timestamp) <= ",$end_date);
		if(isset($order_place_id) && $order_place_id != 0)$this->db->where("store_place.request_place_id",$order_place_id);
		if(isset($order_status) && $order_status != 0)$this->db->where("order_status",$order_status);
		if(isset($keyword_code) && !empty($keyword_code)){
			$this->db->where("(store.store_name LIKE '%".$keyword_code."%' OR store.first_name LIKE '%".$keyword_code."%' OR store.last_name LIKE '%".$keyword_code."%' OR order.order_code LIKE '%".$keyword_code."%' OR order.product_name LIKE '%".$keyword_code."%')", NULL, FALSE);
		}
		
		$this->db->join("store_place","store_place.place_id = order.order_place_id");
		$this->db->join("store","order.depositor_store_id = store.store_id");
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
	public function getOrderOtherPlaceByStoreID($store_id,$per_page,$page_number,$post)
	{
		$start_date = (isset($post['start_date']))?$post['start_date']:"";
		$end_date = (isset($post['end_date']))?$post['end_date']:"";
		$order_place_id = (isset($post['order_place_id']))?$post['order_place_id']:"";
		$order_status = (isset($post['order_status']))?$post['order_status']:"";
		$keyword_code = (isset($post['keyword_code']))?$post['keyword_code']:"";
		
		$this->db->select("*,order.timestamp,order.store_id AS seller_store_id");
		$this->db->from("order");
		$this->db->where("order.depositor_store_id",$store_id);
		//$this->db->where("order_status != ",4);
		$this->db->where("order_shipping_type_id != ",4);
		
		if(isset($start_date) && !empty($start_date))$this->db->where("DATE(order.timestamp) >= ",$start_date);
		if(isset($end_date) && !empty($end_date))$this->db->where("DATE(order.timestamp) <= ",$end_date);
		if(isset($order_place_id) && $order_place_id != 0)$this->db->where("store_place.request_place_id",$order_place_id);
		if(isset($order_status) && $order_status != 0)$this->db->where("order_status",$order_status);
		if(isset($keyword_code) && !empty($keyword_code)){
			$this->db->where("(store.store_name LIKE '%".$keyword_code."%' OR store.first_name LIKE '%".$keyword_code."%' OR store.last_name LIKE '%".$keyword_code."%' OR order.order_code LIKE '%".$keyword_code."%' OR order.product_name LIKE '%".$keyword_code."%')", NULL, FALSE);
		}
		
		$this->db->join("store_place","store_place.place_id = order.order_place_id");
		$this->db->join("store","order.depositor_store_id = store.store_id");
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
		$query = $this->db->query('SELECT * FROM  order WHERE order_code = "'.$order_code.'"  ORDER BY timestamp DESC');
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
	
	public function getStoreByID($store_id)
	{
		$query = $this->db->query('SELECT * FROM  store WHERE store_id = '.$store_id);
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
	
	public function getProductImage($product_id)
	{
		$query = $this->db->query('SELECT * FROM  product_image WHERE product_id = '.$product_id.' LIMIT 1');
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	public function getPlaceByID($place_id)
	{
		$query = $this->db->query('SELECT * FROM  store_place WHERE place_id = '.$place_id.' LIMIT 1');
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	public function getPlaceByStoreID($store_id)
	{
		$query = $this->db->query('SELECT * FROM  store_place WHERE store_id = '.$store_id.' AND request_place_id IS NULL AND place_status = 2 AND shipping_type_id != 3;');
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	
	public function getPlaceAndRequestPlaceByStoreID($store_id)
	{
		$query = $this->db->query('SELECT * FROM  store_place WHERE (store_id = '.$store_id.' OR request_place_id = '.$store_id.') AND place_status = 2 AND shipping_type_id != 3;');
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	
}

?>
