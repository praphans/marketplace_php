<?php
class Model_itemstores extends CI_Model {
  
  	public function getOrderTotalRows($seller_store_id,$post)
	{
		$keyword_code = (isset($post['keyword_code']))?$post['keyword_code']:"";
		
		$this->db->select("tran_id");
		$this->db->from("store_transaction");
		$this->db->where("seller_store_id",$seller_store_id);
		$this->db->where("amount_total !=",0);
		if(isset($keyword_code) && !empty($keyword_code)){
			$this->db->where("(store.store_name LIKE '%".$keyword_code."%' OR store.first_name LIKE '%".$keyword_code."%' OR store.last_name LIKE '%".$keyword_code."%')", NULL, FALSE);
		}
		$this->db->join("store","store.store_id = store_transaction.depositor_store_id");
		$this->db->group_by("store_transaction.depositor_store_id");
		$query = $this->db->get();
		
		return $query->num_rows();
	}
	
	public function getOrderByMemberID($seller_store_id,$per_page,$page_number,$post)
	{
		
		$keyword_code = (isset($post['keyword_code']))?$post['keyword_code']:"";
		
		$this->db->select("*");
		$this->db->from("store_transaction");
		$this->db->where("seller_store_id",$seller_store_id);
		$this->db->where("amount_total !=",0);
		if(isset($keyword_code) && !empty($keyword_code)){
			$this->db->where("(store.store_name LIKE '%".$keyword_code."%' OR store.first_name LIKE '%".$keyword_code."%' OR store.last_name LIKE '%".$keyword_code."%')", NULL, FALSE);
		}
		$this->db->join("store","store.store_id = store_transaction.depositor_store_id");
		$this->db->group_by("store_transaction.depositor_store_id");
		$this->db->order_by("store_transaction.timestamp","DESC");
		$this->db->limit($page_number,$per_page);
		$query = $this->db->get();
		
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	public function getOrderMyPlaceByMemberID($seller_store_id,$per_page,$page_number,$post)
	{
		
		$keyword_code = (isset($post['keyword_code']))?$post['keyword_code']:"";
		
		$this->db->select("*");
		$this->db->from("store_transaction");
		$this->db->where("seller_store_id",$seller_store_id);
		$this->db->where("amount_total <",0);
		//$this->db->or_where("debtor_store_id",$store_id);
		
		if(isset($keyword_code) && !empty($keyword_code)){
			$this->db->where("(store.store_name LIKE '%".$keyword_code."%' OR store.first_name LIKE '%".$keyword_code."%' OR store.last_name LIKE '%".$keyword_code."%')", NULL, FALSE);
		}
		$this->db->join("store","store.store_id = store_transaction.depositor_store_id");
		$this->db->group_by("store_transaction.depositor_store_id");
		$this->db->order_by("store_transaction.timestamp","DESC");
		$this->db->limit($page_number,$per_page);
		$query = $this->db->get();
		
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
		
	}
	public function getOrderOtherPlaceByMemberID($seller_store_id,$per_page,$page_number,$post)
	{
		
		$keyword_code = (isset($post['keyword_code']))?$post['keyword_code']:"";
		
		$this->db->select("*");
		$this->db->from("store_transaction");
		$this->db->where("amount_total >",0);
		$this->db->where("seller_store_id",$seller_store_id);
		
		if(isset($keyword_code) && !empty($keyword_code)){
			$this->db->where("(store.store_name LIKE '%".$keyword_code."%' OR store.first_name LIKE '%".$keyword_code."%' OR store.last_name LIKE '%".$keyword_code."%')", NULL, FALSE);
		}
		$this->db->join("store","store.store_id = store_transaction.depositor_store_id");
		$this->db->group_by("store_transaction.depositor_store_id");
		$this->db->order_by("store_transaction.timestamp","DESC");
		$this->db->limit($page_number,$per_page);
		$query = $this->db->get();
		
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	
	
	
	
	public function getInfoOrderTotalRows($seller_store_id,$depositor_store_id)
	{
		$keyword_code = (isset($post['keyword_code']))?$post['keyword_code']:"";
		
		
		$this->db->select("tran_id");
		$this->db->from("store_transaction");
		$this->db->where("seller_store_id",$seller_store_id);
		$this->db->where("depositor_store_id",$depositor_store_id);
		$this->db->where("amount !=",0);
		/*if(isset($keyword_code) && !empty($keyword_code)){
			$this->db->where("(store.store_name LIKE '%".$keyword_code."%' OR store.first_name LIKE '%".$keyword_code."%' OR store.last_name LIKE '%".$keyword_code."%' OR order.order_code LIKE '%".$keyword_code."%' OR order.product_name LIKE '%".$keyword_code."%' OR store_place.place_name LIKE '%".$keyword_code."%')", NULL, FALSE);
		}*/
		
		//$this->db->group_by("store_transaction.depositor_store_id");
		$query = $this->db->get();
		
		return $query->num_rows();
	}
	
	public function getInfoOrderByMemberID($seller_store_id,$page_number,$per_page,$depositor_store_id)
	{
		
		$keyword_code = (isset($post['keyword_code']))?$post['keyword_code']:"";
		
		$this->db->select("*");
		$this->db->from("store_transaction");
		$this->db->where("seller_store_id",$seller_store_id);
		$this->db->where("depositor_store_id",$depositor_store_id);
		$this->db->where("amount !=",0);
		/*if(isset($keyword_code) && !empty($keyword_code)){
			$this->db->where("(store.store_name LIKE '%".$keyword_code."%' OR store.first_name LIKE '%".$keyword_code."%' OR store.last_name LIKE '%".$keyword_code."%' OR order.order_code LIKE '%".$keyword_code."%' OR order.product_name LIKE '%".$keyword_code."%' OR store_place.place_name LIKE '%".$keyword_code."%')", NULL, FALSE);
		}*/
		
		//$this->db->group_by("store_transaction.order_code");
		$this->db->order_by("store_transaction.timestamp","DESC");
		
		$page_number = $per_page*($page_number-1);
		if($page_number < 0)$page_number = 0;
		$this->db->limit($per_page,$page_number);
		$query = $this->db->get();
		
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	/*public function getInfoOrderMyPlaceByMemberID($seller_store_id,$per_page,$page_number,$depositor_store_id)
	{
		
		$keyword_code = (isset($post['keyword_code']))?$post['keyword_code']:"";
		
		$this->db->select("*");
		$this->db->from("store_transaction");
		$this->db->where("seller_store_id",$seller_store_id);
		//$this->db->where("depositor_store_id",$depositor_store_id);
		$this->db->where("amount_total <",0);
		//$this->db->or_where("debtor_store_id",$store_id);
		
		if(isset($keyword_code) && !empty($keyword_code)){
			$this->db->where("(store.store_name LIKE '%".$keyword_code."%' OR store.first_name LIKE '%".$keyword_code."%' OR store.last_name LIKE '%".$keyword_code."%' OR order.order_code LIKE '%".$keyword_code."%' OR order.product_name LIKE '%".$keyword_code."%' OR store_place.place_name LIKE '%".$keyword_code."%')", NULL, FALSE);
		}
		
		//$this->db->group_by("store_transaction.depositor_store_id");
		$this->db->order_by("store_transaction.timestamp","DESC");
		$this->db->limit($page_number,$per_page);
		$query = $this->db->get();
		
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
		
	}
	public function getInfoOrderOtherPlaceByMemberID($seller_store_id,$per_page,$page_number,$depositor_store_id)
	{
		
		$keyword_code = (isset($post['keyword_code']))?$post['keyword_code']:"";
		
		$this->db->select("*");
		$this->db->from("store_transaction");
		$this->db->where("amount_total >",0);
		$this->db->where("seller_store_id",$seller_store_id);
		//$this->db->where("depositor_store_id",$depositor_store_id);
		if(isset($keyword_code) && !empty($keyword_code)){
			$this->db->where("(store.store_name LIKE '%".$keyword_code."%' OR store.first_name LIKE '%".$keyword_code."%' OR store.last_name LIKE '%".$keyword_code."%' OR order.order_code LIKE '%".$keyword_code."%' OR order.product_name LIKE '%".$keyword_code."%' OR store_place.place_name LIKE '%".$keyword_code."%')", NULL, FALSE);
		}
		
		//$this->db->group_by("store_transaction.creditor_store_id");
		//$this->db->group_by("store_transaction.depositor_store_id");
		$this->db->order_by("store_transaction.timestamp","DESC");
		$this->db->limit($page_number,$per_page);
		$query = $this->db->get();
		
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}*/
	
	
	
	
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
	public function getPlaceByID($place_id)
	{
		$query = $this->db->query('SELECT * FROM  store_place WHERE place_id = '.$place_id);
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	public function getTranType($tran_id)
	{
		$query = $this->db->query('SELECT * FROM  store_transaction_type WHERE id = '.$tran_id);
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	
}

?>
