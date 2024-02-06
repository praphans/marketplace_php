<?php
class Model_category extends CI_Model {
  
	public function getCategoryByID($category_id) 
	{     
		$this->db->select('*');
		$this->db->from('store_category');
		$this->db->where('id',$category_id);
		$this->db->where('category_status',1);
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
	}
	public function getCategoryName($id) 
	{     
		$this->db->select('category_name');
		$this->db->from('store_category');
		$this->db->where('id',$id);
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			$result = $query->result();
			
			return $result[0]->category_name;
		} else {
			return '-';
		}
	}
	public function getShopCategoryList($post,$page_number,$per_page,$category_id) 
	{     
		$view_type = (count($post) && $post["view_type"])?$post["view_type"]:0;
		$view_follower =  (count($post) && $post["view_follower"])?$post["view_follower"]:0;
		$view_vat =  (count($post) && $post["view_vat"])?$post["view_vat"]:0;
		
		$this->db->select('*');
		$this->db->from('store');
		$this->db->where('store_category',$category_id);
		$this->db->where_in('store_status',array(2,5));
		
		
		if(isset($view_follower) && $view_follower != 0){
			$member_id = $this->membermanager->member_id();
			if(isset($member_id)){
				$this->db->join("store_follow","store_follow.member_id = ".$member_id." ANDstore_follow.store_id = store.store_id");
			}
		}
		
		if(isset($view_vat) && $view_vat){
			$this->db->where('store_is_vat',1);
		}
		
		
		$this->db->limit($per_page,$page_number);
		
		if($view_type == "popular"){
			$this->db->order_by('store_view','DESC');
		}else if($view_type == "follow"){
			$this->db->order_by('store_fallower','DESC');
		}else if($view_type == "rating"){
			$this->db->order_by('store_rating','DESC');
		}else if($view_type == "new"){
			$this->db->order_by('timestamp','DESC');
		}else{
			$this->db->order_by('timestamp','DESC');
		}
		
		
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
	}
	public function getShopRecommendList($category_id = 0,$per_page) 
	{     
		
		$this->db->select('*');
		$this->db->from('store');
		$this->db->where('store_status',5); // ร้านค้าแนะนำ
		$this->db->where('store_category',$category_id);
		$this->db->limit($per_page);
		$this->db->order_by('timestamp','DESC');
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
	}
	public function getShopCategoryTotalRows($post,$category_id) 
	{     
		$view_type = (count($post) && $post["view_type"])?$post["view_type"]:0;
		$view_follower =  (count($post) && $post["view_follower"])?$post["view_follower"]:0;
		$view_vat =  (count($post) && $post["view_vat"])?$post["view_vat"]:0;
		
		$this->db->select('store.store_id');
		$this->db->from('store');
		$this->db->where('store_category',$category_id); // เฉพาะร้านที่อนุมัติแล้ว
		$this->db->where_in('store_status',array(2,5)); // เฉพาะร้านที่อนุมัติแล้ว
		
		if(isset($view_follower) && $view_follower != 0){
			$member_id = $this->membermanager->member_id();
			if(isset($member_id)){
				$this->db->join("store_follow","store_follow.member_id = ".$member_id." ANDstore_follow.store_id = store.store_id");
			}
		}
		
		if(isset($view_vat) && $view_vat){
			$this->db->where('store_is_vat',1);
		}
		
		$query = $this->db->get();
		return $query->num_rows();
	}
}

?>
