<?php
class Model_product extends CI_Model {
  
  	public function getProductTotalRows()
	{
		$store_id = $this->storemanager->store_id();
		$query = $this->db->query("SELECT product_id FROM  product WHERE store_id = ".$store_id." AND relate_id = 0 AND ( product_status = 1 OR product_status = 2 OR product_status = 3)");
		return $query->num_rows();
	}
  	public function getProductList($page_number,$per_page)
	{
		$store_id = $this->storemanager->store_id();
		$query = $this->db->query("SELECT * FROM  product WHERE store_id = ".$store_id." AND relate_id = 0 AND ( product_status = 1 OR product_status = 2 OR product_status = 3 ) ORDER BY timestamp DESC LIMIT ".$page_number.",".$per_page);
		if($query->num_rows() > 0 ) {
			$result = $query->result();
			return $result;
		} else {
			return array();
		}
	}
	public function getProductByID($product_id)
	{
		$query = $this->db->query("SELECT * FROM  product WHERE product_id = ".$product_id);
		if($query->num_rows() > 0 ) {
			$result = $query->result();
			return $result;
		} else {
			return array();
		}
	}
}

?>
