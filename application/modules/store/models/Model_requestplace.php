<?php
class Model_requestplace extends CI_Model {
  
	public function getRequestPlace() 
	{
		$store_id = $this->storemanager->store_id();
		$place_id_arr = array();
		$query = $this->db->query("SELECT * FROM  store_place WHERE store_id = ".$store_id);
		if($query->num_rows() > 0 ) {
			$result = $query->result();
			
			foreach($result as $row){
				$place_id = $row->place_id;
				array_push($place_id_arr,$place_id);
			}
			$request_place = $this->getRequestPlaceByID_as_array($place_id_arr);
			return $request_place;
		} else {
			return array();
		}
	}
	public function getRequestPlaceByID_as_array($place_id_arr)
	{
		$this->db->select("*");
		$this->db->from("store_place");
		$this->db->where_in("request_place_id",$place_id_arr);
		$this->db->where("place_status !=",4);
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			$result = $query->result();
			return $result;
		} else {
			return array();
		}
	}
	public function getStoreByID($store_id)
	{
		$query = $this->db->query('SELECT * FROM  store WHERE store_id = '.$store_id);
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	public function getStatusByID($place_status)
	{
		$query = $this->db->query('SELECT * FROM  store_place_status WHERE id = '.$place_status.' AND id != 4');
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	
}

?>
