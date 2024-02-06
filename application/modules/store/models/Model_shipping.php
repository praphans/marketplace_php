<?php
class Model_shipping extends CI_Model {
  
  	
	public function getStoreByID($store_id)
	{
		$query = $this->db->query('SELECT * FROM  store WHERE store_id = '.$store_id);
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	public function getStoreByRequestPlaceID($request_place_id)
	{
		$query = $this->db->query('SELECT * FROM  store_place WHERE place_id = '.$request_place_id);
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
		
	}
	
}

?>
