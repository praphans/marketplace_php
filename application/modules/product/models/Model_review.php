<?php
class Model_review extends CI_Model {
  
	
  	public function getReviewByStoreID($store_id) 
	{     
		$this->db->select('*');
		$this->db->from('review');
		$this->db->where('review_status',1); 
		if(isset($store_id))$this->db->where('store_id',$store_id);
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
	}
	
	public function getReviewMemberByID($member_id) 
	{     
		$this->db->select('*');
		$this->db->from('member');
		$this->db->where('member_id',$member_id); 
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
	}
	
}

?>
