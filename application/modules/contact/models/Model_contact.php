<?php
class Model_contact extends CI_Model {
  
  public function getContactInfo() 
  {     
		$this->db->select('*');
		$this->db->from('contact_info');
		$query=$this->db->get();
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
  	}
}

?>
