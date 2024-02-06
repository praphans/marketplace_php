<?php
class Model_category extends CI_Model {
	public function getAllCategory()
	{
		$store_id = $this->storemanager->store_id();
		$query = $this->db->query('SELECT * FROM  product_category_customer WHERE store_id = '.$store_id.' AND category_status != 3');
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	public function getCategoryList($page_number,$per_page)
	{
		$store_id = $this->storemanager->store_id();
		$query = $this->db->query("SELECT * FROM  product_category_customer WHERE store_id = ".$store_id." AND category_status != 3 ORDER BY id DESC LIMIT ".$page_number.",".$per_page);
		if($query->num_rows() > 0 ) {
			$result = $query->result();
			return $result;
		} else {
			return array();
		}
	}
	
	public function getCategoryTotalRows()
	{
		$store_id = $this->storemanager->store_id();
		$query = $this->db->query('SELECT id FROM  product_category_customer WHERE store_id = '.$store_id.' AND category_status != 3');
		return $query->num_rows();
	}
	
}

?>
