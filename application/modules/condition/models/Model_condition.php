<?php
class Model_condition extends CI_Model {
 
 	
 	public function getMessageType() 
	{     
		$this->db->select('*');
		$this->db->from('message_type');
		$this->db->where_in("id",$this->message_type_for_user);
		$query = $this->db->get();
		
		if($query->num_rows() > 0 ) {
		  	return $query->result();
		} else {
		  	return array();
		}
	}
	
	
}
?>
