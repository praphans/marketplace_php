<?php
class Model_news extends CI_Model {
  
  public function getNewsByID($new_id) 
  {     
		$this->db->select('*');
		$this->db->from('news');
		$this->db->where('new_id',$new_id);
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
  }
 
  public function getNewsList($new_cate_id,$page_number,$per_page) 
  {     
		$this->db->select('*');
		$this->db->from('news');
		if(isset($new_cate_id) && $new_cate_id != 0)$this->db->where("new_cate_id",$new_cate_id);
		$this->db->limit($per_page,$page_number);
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
  	}
	public function getLatestNew($limit = 5) 
  	{     
		$this->db->select('*');
		$this->db->from('news');
		$this->db->limit($limit);
		$this->db->order_by("timestamp","DESC");
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
  	}
	
  public function getTagsList($page_number,$per_page,$tag_id) 
  {     
		$this->db->select('*');
		$this->db->from('news');
		if(isset($tag_id) && !empty($tag_id))$this->db->like("new_tags",$tag_id);
		$this->db->limit($per_page,$page_number);
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
  	}
  
  public function getNewsTotalRows($new_cate_id) 
  {     
		$this->db->select('new_id');
		$this->db->from('news');
		
		if(isset($new_cate_id) && $new_cate_id != 0)$this->db->where("new_cate_id",$new_cate_id);
		$query = $this->db->get();
		return $query->num_rows();
  	}
	public function getTagsTotalRows($tag_id) 
  {     
		$this->db->select('new_id');
		$this->db->from('news');
		if(isset($tag_id) && !empty($tag_id))$this->db->like("new_tags",$tag_id);
		$query = $this->db->get();
		return $query->num_rows();
  	}
   public function getCategory() 
   {     
		$this->db->select('*');
		$this->db->from('news_category');
		
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
  	}
	public function getTags() 
   {     
		$this->db->select('*');
		$this->db->from('news_tags');
		
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
  	}
	public function getTagsByID($tag_id) 
   {     
		$this->db->select('*');
		$this->db->from('news_tags');
		$this->db->where("tag_id",$tag_id);
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
  	}
   public function getCategoryByID($new_cate_id) 
   {     
		$this->db->select('*');
		$this->db->from('news_category');
		$this->db->where("id",$new_cate_id);
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
  	}
	
}

?>
