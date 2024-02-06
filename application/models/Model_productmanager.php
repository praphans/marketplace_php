<?php
class Model_productmanager extends CI_Model {
 	
	public function getRelateProductTotalRowsByProductID($product_id)
	{
		$store_id = $this->storemanager->store_id();
		$query = $this->db->query("SELECT product_id FROM  product WHERE relate_id = ".$product_id." AND store_id = ".$store_id." AND product_status = 3");
		return $query->num_rows();
	}
	public function getRelateProductList($product_id,$page_number,$per_page)
	{
		$store_id = $this->storemanager->store_id();
		$query = $this->db->query("SELECT * FROM  product WHERE relate_id = ".$product_id." AND store_id = ".$store_id." AND product_status = 3 ORDER BY timestamp DESC LIMIT ".$page_number.",".$per_page);
		if($query->num_rows() > 0 ) {
			$result = $query->result();
			return $result;
		} else {
			return array();
		}
	}
	public function getProductTotalRows()
	{
		$store_id = $this->storemanager->store_id();
		$query = $this->db->query("SELECT product_id FROM  product WHERE store_id = ".$store_id." AND relate_id = 0 AND product_status = 3");
		return $query->num_rows();
	}
	public function getProductList($page_number,$per_page)
	{
		$store_id = $this->storemanager->store_id();
		$query = $this->db->query("SELECT * FROM  product WHERE store_id = ".$store_id." AND relate_id = 0 AND product_status = 3 ORDER BY timestamp DESC LIMIT ".$page_number.",".$per_page);
		if($query->num_rows() > 0 ) {
			$result = $query->result();
			return $result;
		} else {
			return array();
		}
	}
	public function getNumberRelate($product_id)
	{
		$query = $this->db->query("SELECT product_id FROM  product WHERE relate_id = ".$product_id." AND product_status = 3 ORDER BY timestamp DESC");
		return $query->num_rows();
	}
	public function getRelateByID($product_id)
	{
		$query = $this->db->query("SELECT * FROM  product WHERE relate_id = ".$product_id." AND product_status = 3 ORDER BY timestamp ASC LIMIT 1");
		if($query->num_rows() > 0 ) {
			$result = $query->result();
			return $result;
		} else {
			return array();
		}
	}
	public function getProductByID_as_array($product_id)
	{
		$query = $this->db->query("SELECT * FROM  product WHERE product_id = ".$product_id);
		if($query->num_rows() > 0 ) {
			$result = $query->result_array();
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
	public function getProductCategoryCustomer()
	{
		$store_id = $this->storemanager->store_id();
		$query = $this->db->query("SELECT * FROM  product_category_customer WHERE (store_id = ".$store_id." OR store_id = 0) AND category_status = 1");
		if($query->num_rows() > 0 ) {
			$result = $query->result();
			return $result;
		} else {
			return array();
		}
	}
	public function getProductCategory()
	{
		$query = $this->db->query("SELECT * FROM  product_category");
		if($query->num_rows() > 0 ) {
			$result = $query->result();
			return $result;
		} else {
			return array();
		}
	}
	public function getProductSubcategory()
	{
		$query = $this->db->query("SELECT * FROM  product_subcategory");
		if($query->num_rows() > 0 ) {
			$result = $query->result();
			return $result;
		} else {
			return array();
		}
	}
	public function getProductType()
	{
		$query = $this->db->query("SELECT * FROM  product_type");
		if($query->num_rows() > 0 ) {
			$result = $query->result();
			return $result;
		} else {
			return array();
		}
	}
	public function getProductTypeByID($product_type)
	{
		$query = $this->db->query("SELECT * FROM  product_type WHERE id = ".$product_type);
		if($query->num_rows() > 0 ) {
			$result = $query->result();
			return $result;
		} else {
			return array();
		}
	}
	public function getProductMode()
	{
		$query = $this->db->query("SELECT * FROM  product_mode");
		if($query->num_rows() > 0 ) {
			$result = $query->result();
			return $result;
		} else {
			return array();
		}
	}
	public function getProductImageList($product_id)
	{
		$query = $this->db->query("SELECT * FROM  product_image WHERE product_id = ".$product_id." ORDER BY timestamp DESC");
		if($query->num_rows() > 0 ) {
			$result = $query->result();
			return $result;
		} else {
			return array();
		}
	}
	
	public function getPromoByProductID($product_id,$promo_type = 1)
	{
		$query = $this->db->query('SELECT * FROM  product_promo LEFT JOIN product_promo_status ON product_promo_status.id = product_promo.promo_status WHERE product_promo.product_id = '.$product_id.' ANDproduct_promo.promo_type = '.$promo_type);
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	
	public function getPromoJoinByJoinID($join_id)
	{
		$query = $this->db->query('SELECT * FROM  product_promo_join WHERE join_id = '.$join_id.' AND join_status != 4');
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	public function getPromoJoin($store_id)
	{
		$query = $this->db->query('SELECT * FROM  product_promo_join WHERE join_status != 4 AND join_store_list LIKE "%'.$store_id.'%"');
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	
	public function getProductCategoryName($product_category)
	{
		$query = $this->db->query("SELECT category_name FROM  product_category WHERE id = ".$product_category);
		if($query->num_rows() > 0 ) {
			$result = $query->result();
			return $result[0]->category_name;
		} else {
			return "";
		}
	}
	public function getStoreURLByStoreID($store_id)
	{
		$query = $this->db->query("SELECT store_url FROM  store WHERE store_id = ".$store_id);
		if($query->num_rows() > 0 ) {
			$result = $query->result();
			return $result[0]->store_url;
		} else {
			return "";
		}
	}
	public function getProductPromotion($product_id,$join_id = 0)
	{
		if($join_id > 0){
			$query = $this->db->query("SELECT * FROM  product_promo_join WHERE join_id = ".$join_id);
		}else{
			$query = $this->db->query("SELECT * FROM  product_promo WHERE product_id = ".$product_id." ORDER BY timestamp DESC LIMIT 1");
		}
		if($query->num_rows() > 0 ) {
			$result = $query->result();
			return $result;
		} else {
			return array();
		}
	}
	
}

?>
