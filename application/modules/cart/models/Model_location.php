<?php
class Model_location extends CI_Model {
	public function getStoreByID($store_id)
	{
		$query = $this->db->query('SELECT * FROM  store WHERE store_id = '.$store_id);
		if($query->num_rows() > 0 ) {
			$result = $query->result();
			return $result;
		} else {
			return array();
		}
	}
	public function getStoreShipping($store_id)
	{
		$query = $this->db->query('SELECT store_shipping,store_shipping_charge FROM  store WHERE store_id = '.$store_id);
		if($query->num_rows() > 0 ) {
			$result = $query->result();
			if(empty($result[0]->store_shipping)){
				return "";
			}else{
				return $result[0]->store_shipping;
			}
		} else {
			return "";
		}
	}
	public function getStoreShippingCharge($store_id)
	{
		$query = $this->db->query('SELECT store_shipping_charge FROM  store WHERE store_id = '.$store_id);
		if($query->num_rows() > 0 ) {
			$result = $query->result();
			return $result[0]->store_shipping_charge;
		} else {
			return 0;
		}
	}
	
	public function getUserPlace($member_id)
	{
		$query = $this->db->query('SELECT * FROM  store_place WHERE member_id = '.$member_id.' AND shipping_type_id = 4 AND place_status = 2');
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	public function getStorePlace($store_id)
	{
		$query = $this->db->query('SELECT * FROM  store_place WHERE store_id = '.$store_id.' AND shipping_type_id = 1  AND place_status = 2');
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	public function getAgentPlace($store_id)
	{
		$query = $this->db->query('SELECT * FROM  store_place WHERE store_id = '.$store_id.' AND shipping_type_id = 2  AND place_status = 2');
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	public function getServicePlace($store_id)
	{
		$query = $this->db->query('SELECT * FROM  store_place WHERE store_id = '.$store_id.' AND shipping_type_id = 3  AND place_status = 2');
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	public function getPlaceByID($place_id)
	{
		$query = $this->db->query('SELECT * FROM  store_place WHERE place_id = '.$place_id);
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	/*public function getCreditor($creditor_store_id,$debtor_store_id)
	{
		$query = $this->db->query('SELECT creditor_store_id,amount_total_remaining FROM  store_transaction WHERE creditor_store_id = '.$creditor_store_id.' AND debtor_store_id = '.$debtor_store_id.' ORDER BY timestamp DESC LIMIT 1');
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}*/
	public function getDebtor($debtor_store_id)
	{
		$query = $this->db->query('SELECT * FROM  store_transaction WHERE debtor_store_id = '.$debtor_store_id.' ORDER BY timestamp DESC LIMIT 1');
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	public function getRequestPlace($request_place_id)
	{
		$query = $this->db->query('SELECT * FROM  store_place WHERE place_id = '.$request_place_id);
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	public function getAddressBillTax($member_id)
	{
		$query = $this->db->query('SELECT * FROM  store_place WHERE member_id = '.$member_id.' AND place_is_default_tax =  1');
		if($query->num_rows() > 0 ) {
			$result = $query->result();
			return $result;
		} else {
			return array();
		}
	}
	public function checkProductStore($store_id,$product_id)
	{
		$query = $this->db->query('SELECT store_id,product_id FROM  product WHERE store_id = '.$store_id.' AND  product_id = '.$product_id);
		return $query->num_rows();
	}
	public function checkProductRelateByID($product_id)
	{
		$query = $this->db->query('SELECT relate_id,product_is_relate,product_id,product_name FROM  product WHERE product_id = '.$product_id);
		if($query->num_rows() > 0 ) {
			$result = $query->result();
			return $result;
		} else {
			return array();
		}
	}
	
	public function getProductNameByID($product_id)
	{
		$query = $this->db->query('SELECT product_name FROM  product WHERE product_id = '.$product_id);
		if($query->num_rows() > 0 ) {
			$result = $query->result();
			return $result;
		} else {
			return array();
		}
	}
	
}

?>
