<?php
class Model_storemanager extends CI_Model {
 
	public function getStoreCategory()
	{
		$query = $this->db->query("SELECT * FROM  store_category");
		if($query->num_rows() > 0 ) {
			$result = $query->result();
			return $result;
		} else {
			return array();
		}
	}
	public function getStoreType()
	{
		$query = $this->db->query("SELECT * FROM  store_type");
		if($query->num_rows() > 0 ) {
			$result = $query->result();
			return $result;
		} else {
			return array();
		}
	}
	public function getStoreBank()
	{
		$query = $this->db->query("SELECT * FROM  store_bank");
		if($query->num_rows() > 0 ) {
			$result = $query->result();
			return $result;
		} else {
			return array();
		}
	}
	public function myStore($member_id)
	{
		if(!isset($member_id))return array();
		$query = $this->db->query("SELECT * FROM  store WHERE member_id = ".$member_id);
		if($query->num_rows() > 0 ) {
			$result = $query->result();
			return $result;
		} else {
			return array();
		}
	}
	public function getStoreByID($store_id)
	{
		$query = $this->db->query("SELECT * FROM  store WHERE store_id = ".$store_id);
		if($query->num_rows() > 0 ) {
			$result = $query->result();
			return $result;
		} else {
			return array();
		}
	}
	public function getMyDocument($store_id)
	{
		if(!isset($store_id))return array();
		$query = $this->db->query("SELECT * FROM  store_document WHERE store_id = ".$store_id);
		if($query->num_rows() > 0 ) {
			$result = $query->result();
			return $result;
		} else {
			return array();
		}
	}
	public function getUserPlace()
	{
		$member_id = $this->membermanager->member_id();
		$query = $this->db->query("SELECT * FROM  store_place WHERE member_id = ".$member_id." AND shipping_type_id = 4 AND place_status = 2");
		if($query->num_rows() > 0 ) {
			$result = $query->result();
			return $result;
		} else {
			return array();
		}
	}
	
	public function getStorePlace()
	{
		$store_id = $this->storemanager->store_id();
		$query = $this->db->query("SELECT * FROM  store_place WHERE store_id = ".$store_id." AND shipping_type_id = 1 AND place_status = 2");
		if($query->num_rows() > 0 ) {
			$result = $query->result();
			return $result;
		} else {
			return array();
		}
	}
	public function getAgentPlace()
	{
		$store_id = $this->storemanager->store_id();
		$query = $this->db->query("SELECT * FROM  store_place WHERE store_id = ".$store_id." AND shipping_type_id = 2 AND (place_status = 2 OR place_status = 1)");
		if($query->num_rows() > 0 ) {
			$result = $query->result();
			return $result;
		} else {
			return array();
		}
	}
	public function getServicePlace()
	{
		$store_id = $this->storemanager->store_id();
		$query = $this->db->query("SELECT * FROM  store_place WHERE store_id = ".$store_id." AND shipping_type_id = 3 AND place_status = 2");
		if($query->num_rows() > 0 ) {
			$result = $query->result();
			return $result;
		} else {
			return array();
		}
	}
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
	public function getProvinceByID($province_id)
	{
		if(empty($province_id)) return "-";
		$query = $this->db->query("SELECT province_name FROM  provinces WHERE province_id = ".$province_id);
		if($query->num_rows() > 0 ) {
			$result = $query->result();
			return $result[0]->province_name;
		} else {
			return "-";
		}
	}
	public function getAmphurByID($amphur_id)
	{
		if(empty($amphur_id)) return "-";
		$query = $this->db->query("SELECT amphur_name FROM amphures WHERE amphur_id = ".$amphur_id);
		if($query->num_rows() > 0 ) {
			$result = $query->result();
			return $result[0]->amphur_name;
		} else {
			return "-";
		}
	}
	public function getDistrictByID($district_id)
	{
		if(empty($district_id)) return "-";
		$query = $this->db->query("SELECT district_name FROM districts WHERE district_id = ".$district_id);
		if($query->num_rows() > 0 ) {
			$result = $query->result();
			return $result[0]->district_name;
		} else {
			return "-";
		}
	}
	public function getWorkingTimeByID($place_id)
	{
		$query = $this->db->query("SELECT * FROM  store_working_time WHERE place_id = ".$place_id);
		if($query->num_rows() > 0 ) {
			$result = $query->result();
			return $result;
		} else {
			return array();
		}
	}
	public function getPlaceByID($place_id)
	{
		$query = $this->db->query("SELECT * FROM  store_place WHERE place_id = ".$place_id." AND place_status = 2");
		if($query->num_rows() > 0 ) {
			$result = $query->result();
			return $result;
		} else {
			return array();
		}
	}
	public function getPlaceByID_as_array($place_id)
	{
		$query = $this->db->query("SELECT * FROM  store_place WHERE place_id = ".$place_id." AND place_status = 2");
		if($query->num_rows() > 0 ) {
			$result = $query->result_array();
			return $result[0];
		} else {
			return array();
		}
	}
	public function getRequestPlaceByID_as_array($place_id_arr)
	{
		$this->db->select("*");
		$this->db->from("store_place");
		$this->db->where_in("request_place_id",$place_id_arr);
		$this->db->where("place_status",1);
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			$result = $query->result();
			return $result;
		} else {
			return array();
		}
	}
	public function getLastRecieveMessage($member_id)
	{
		
		$query = $this->db->query("SELECT timestamp FROM message WHERE receiver_id = ".$member_id." ORDER BY timestamp DESC LIMIT 1");
		if($query->num_rows() > 0 ) {
			$result = $query->result();
			return $result;
		} else {
			return array();
		}
	}
	public function getLastSenderMessage($member_id)
	{
		$query = $this->db->query("SELECT timestamp FROM message WHERE sender_id = ".$member_id." ORDER BY timestamp DESC LIMIT 1");
		if($query->num_rows() > 0 ) {
			$result = $query->result();
			return $result;
		} else {
			return array();
		}
	}
	
	
}

?>
