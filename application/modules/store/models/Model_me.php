<?php
class Model_me extends CI_Model {
	public function getMe()
	{
		$store_id = $this->storemanager->store_id();
		$query = $this->db->query('SELECT * FROM  product_category_customer WHERE store_id = '.$store_id.' AND category_status != 3');
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
}

?>
