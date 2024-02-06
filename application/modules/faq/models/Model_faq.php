<?php
class Model_faq extends CI_Model {
  
  public function getFaqCategoryByFaqType($faq_type_id) 
  {     
		$this->db->select('*');
		$this->db->from('faq');
		$this->db->where('faq_type',$faq_type_id);
		$this->db->join('faq_category','faq.faq_category = faq_category.id');
		$this->db->group_by('faq.faq_category');
		$this->db->order_by('faq_category.category_index');
		$query=$this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
  	}
	
	public function getFaq($faq_type_id,$faq_category_id) 
   {     
		$this->db->select('*');
		$this->db->from('faq');
		$this->db->where('faq_type',$faq_type_id);
		$this->db->where('faq_category',$faq_category_id);
	
		$query=$this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
  	}
}

?>
