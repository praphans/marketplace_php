<?php
class Model_place extends CI_Model {
  
  	
	public function getStoreByID($store_id)
	{
		$query = $this->db->query('SELECT * FROM  store WHERE store_id = '.$store_id);
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
}

?>
