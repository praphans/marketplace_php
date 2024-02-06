<?php
class Model_setting extends CI_Model {
	public function getGatewayTypeByID($product_id)
	{
		$query = $this->db->query('SELECT * FROM  payment_gateway WHERE product_id = '.$product_id);
		if($query->num_rows() > 0 ) {
		  	return $query->result();
		} else {
		  	return array();
		}
	}
}

?>
