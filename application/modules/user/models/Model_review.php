<?php
class Model_review extends CI_Model {
  
  	public function getReviewTotalRows($member_id,$post){
		
		//$review_type = (isset($post['review_type']))?$post['review_type']:"";
		
		$this->db->select("*");
		$this->db->from("order");
		$this->db->where("order.order_member_id",$member_id);
		$this->db->where("order_status != ",4);
		
		//if(isset($review_type) && !empty($review_type) && $review_type != 0)$this->db->where("review_type",$review_type);
		
		//$this->db->join("review","review.order_id = order.order_id");
		$this->db->group_by("order_code");
		$query = $this->db->get();
		
		return $query->num_rows();
	}
	public function getReviewOrder($member_id,$per_page,$page_number,$post)
	{
		//$review_type = (isset($post['review_type']))?$post['review_type']:"";
		
		$this->db->select("*");
		$this->db->from("order");
		$this->db->where("order.order_member_id",$member_id);
		$this->db->where("order_status != ",4);
		//if(isset($review_type) && !empty($review_type) && $review_type != 0)$this->db->where("review_type",$review_type);
		//$this->db->join("review","review.order_id = order.order_id");
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
	
	public function getReviewHistoryTotalRows($member_id,$post){
		$review_type = (isset($post['review_type']))?$post['review_type']:"";
		
		$this->db->select("*");
		$this->db->from("order");
		$this->db->where("order.order_member_id",$member_id);
		$this->db->where("order_status != ",4);
		$this->db->where("review.review_status",1);
		$this->db->join("review","review.order_id = order.order_id");
		if(isset($review_type) && !empty($review_type) && $review_type != 0)$this->db->where("review_type",$review_type);
		
		//$this->db->group_by("order_code");
		$query = $this->db->get();
		
		return $query->num_rows();
	}
	public function getReviewHistoryOrder($member_id,$per_page,$page_number,$post)
	{
		$review_type = (isset($post['review_type']))?$post['review_type']:"";
		
		$this->db->select("*");
		$this->db->from("order");
		$this->db->where("order.order_member_id",$member_id);
		$this->db->where("order_status != ",4);
		$this->db->where("review.review_status",1);
		$this->db->join("review","review.order_id = order.order_id");
		if(isset($review_type) && !empty($review_type) && $review_type != 0)$this->db->where("review_type",$review_type);
		//$this->db->group_by("order_code");
		$this->db->order_by("review.timestamp","DESC");
		$this->db->limit($page_number,$per_page);
		$query = $this->db->get();
		
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	
	public function getOrderStorePlaceID($order_place_id) // ดึงร้านตัวแทนที่จัดส่ง
	{
		$this->db->select("*");
		$this->db->from("store_place");
		$this->db->where("place_id",$order_place_id);
		
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
											
	public function getNumSellReview($order_id,$sell_store_id)
	{
		$this->db->select("*");
		$this->db->from("review");
		$this->db->where("order_id",$order_id);
		$this->db->where("store_id",$sell_store_id);
		$this->db->where("review_type",1);
		$this->db->where("review_status",1);
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function getNumAgentReview($order_id,$agent_store_id)
	{
		$this->db->select("*");
		$this->db->from("review");
		$this->db->where("order_id",$order_id);
		$this->db->where("store_id",$agent_store_id);
		$this->db->where("review_type",2);
		$this->db->where("review_status",1);
		$query = $this->db->get();
		return $query->num_rows();
	}
	public function getNumProductReview($order_id,$product_id)
	{
		$this->db->select("*");
		$this->db->from("review");
		$this->db->where("order_id",$order_id);
		$this->db->where("product_id",$product_id);
		$this->db->where("review_type",3);
		$this->db->where("review_status",1);
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	public function getReviewByMemberID($member_id)
	{
		$this->db->select("*");
		$this->db->from("review");
		$this->db->where("member_id",$member_id);
		$this->db->where("review_status",1);
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	public function getReviewByOrderID($order_id)
	{
		$this->db->select("*");
		$this->db->from("review");
		$this->db->where("order_id",$order_id);
		$this->db->where("review_status",1);
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	public function getStoreByID($store_id)
	{
		$this->db->select("store_name,store_avatar,store_url");
		$this->db->from("store");
		$this->db->where("store_id",$store_id);
		
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	public function getReview($product_id,$review_type)
	{
		$this->db->select("review_rating");
		$this->db->from("review");
		$this->db->where("product_id",$product_id);
		$this->db->where("review_type",$review_type);
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	public function getProductByID($product_id)
	{
		$this->db->select("product_name");
		$this->db->from("product");
		$this->db->where("product_id",$product_id);
		$query = $this->db->get();
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
}

?>
