<?php
class Model_home extends CI_Model {
   public function getBanner() 
   {     
		$this->db->select('*');
		$this->db->from('banner');
		$query=$this->db->get();
		if($query->num_rows() > 0 ){
			return $query->result();
		} else {
			return array();
		}
  	}
   public function getFeatured() 
   {     
		$this->db->select('*');
		$this->db->from('product_featured');
		$this->db->where('CURDATE() >= starttime');
		$this->db->where('CURDATE() <= endtime');
		$this->db->where('featured_type != ',3);
		$query=$this->db->get();
		if($query->num_rows() > 0 ){
			return $query->result();
		} else {
			return array();
		}
  	}
	
	public function getProductByFeatured($featured_id) 
  	{     
		$this->db->select('*');
		$this->db->from('product');
		$this->db->where('product.product_featured',$featured_id);
		$this->db->where("product.relate_id",0);
		$this->db->where('product.product_status',3);
		$this->db->where('product.product_show',1); 
		
		$this->db->where_in("store.store_status",array(2,5));
		
		$this->db->join("store","store.store_id = product.store_id");
		
		
		$query=$this->db->get();
		if($query->num_rows() > 0 ){
			return $query->result();
		} else {
			return array();
		}
  	}
	
}

?>
