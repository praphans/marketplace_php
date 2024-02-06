<?php
class Model_main extends CI_Model {
 	
	
	public function getStoreCategory()
	{
		$query = $this->db->query('SELECT * FROM  store_category');
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	public function getProductCategory()
	{
		$query = $this->db->query('SELECT * FROM  product_category');
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	public function getProductSubCategory($category_id)
	{
		$query = $this->db->query('SELECT * FROM  product_subcategory WHERE category_id = '.$category_id);
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	public function getProvince()
	{
		$query = $this->db->query('SELECT * FROM  provinces');
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	public function getAmphurByProvinceID($province_id)
	{
		$query = $this->db->query('SELECT * FROM amphures WHERE province_id = '.$province_id);
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	public function getAmphurByID($amphur_id)
	{
		$query = $this->db->query('SELECT * FROM amphures WHERE amphur_id = '.$amphur_id);
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
}

?>
