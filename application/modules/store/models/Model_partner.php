<?php
class Model_partner extends CI_Model {
	public function getPartnerPlaceTotalRow($store_id)
	{
		$query = $this->db->query('SELECT * FROM  store_place WHERE store_id = '.$store_id.' AND shipping_type_id = 2 GROUP BY request_place_id');
		return $query->num_rows();
	}
	public function getMyPlace($store_id)
	{
		
		$this->db->select("*");
		$this->db->from("store_place");
		$this->db->where("store_id",$store_id);
		
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	public function getStoreByID($store_id)
	{
		$this->db->select("*");
		$this->db->from("store");
		$this->db->where("store_id",$store_id);
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	
	public function getStorePlaceGive($place_id)
	{
		
		$this->db->select("*");
		$this->db->from("store_place");
		$this->db->where("store_place.request_place_id",$place_id);
		$this->db->join("store","store_place.store_id = store.store_id");
		$this->db->group_by("store_place.store_id");
		
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	public function getStorePlaceRequest($request_place_id)
	{
		
		$this->db->select("*");
		$this->db->from("store_place");
		$this->db->where("store_place.place_id",$request_place_id);
		$this->db->join("store","store_place.store_id = store.store_id");
		$this->db->group_by("store_place.store_id");
		
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
}

?>
