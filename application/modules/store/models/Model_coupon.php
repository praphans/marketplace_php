<?php
class Model_coupon extends CI_Model {
	public function getOrderTotalRow($store_id,$keyword)
	{
		$this->db->select("*");
		$this->db->from("order");
		//$this->db->where("order.store_id",$store_id);
		if(isset($keyword))$this->db->where("order.order_code",$keyword);
		$this->db->where("(order.store_id = ".$store_id." OR order.depositor_store_id = ".$store_id." )");
		//$this->db->or_where("order.depositor_store_id",$store_id);
		//$this->db->where("order.order_status != ",4);
		$this->db->join("order_coupon","order_coupon.coupon_id = order.coupon_id");
		$this->db->group_by("order.order_code");
		$this->db->order_by("order_coupon.coupon_use_date","DESC");
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function getOrderByStoreID($store_id,$page_number,$per_page,$keyword)
	{
		$this->db->select("*");
		$this->db->from("order");
		if(isset($keyword))$this->db->where("order.order_code",$keyword);
		$this->db->where("(order.store_id = ".$store_id." OR order.depositor_store_id = ".$store_id." )");
		//$this->db->or_where("order.depositor_store_id",$store_id);
		//$this->db->where("order.order_status != ",4);
		$this->db->join("order_coupon","order_coupon.coupon_id = order.coupon_id");
		$this->db->group_by("order.order_code");
		$this->db->order_by("order_coupon.coupon_use_date","DESC");
		$this->db->limit($per_page,$page_number);
		$query = $this->db->get();
		//print_r($this->db->last_query());
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	public function getCouponByID($coupon_id)
	{
		$this->db->select("*");
		$this->db->from("order_coupon");
		$this->db->where("coupon_id",$coupon_id);
		// $this->db->order_by("coupon_use_date","DESC");
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	public function getCouponStatus($id)
	{
		$this->db->select("*");
		$this->db->from("order_coupon_status");
		$this->db->where("id",$id);
		
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	public function getStoreByID($store_id)
	{
		$this->db->select("store_name");
		$this->db->from("store");
		$this->db->where("store_id",$store_id);
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
}

?>
