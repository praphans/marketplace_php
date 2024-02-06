<?php
class Model_promotion extends CI_Model {
  
  public function getAllPromotion() 
  {     
		$this->db->select('*');
		$this->db->from('promotion');
		$query=$this->db->get();
		if($query->num_rows() > 0 ) {
			  return $query->result();
		} else {
			return array();
		}
  	}
}

?>
