<?php
class Model_warehouse extends CI_Model {
	
	   public function getWarehouse()
       {
           	$query = $this->db->query('SELECT * FROM warehouse WHERE warehouse_status = 1');
			if($query->num_rows() > 0 ) {
				return $query->result();
			} else {
				return array();
			}
       }
	   public function getWarehouseByType($warehouse_type_id)
       {
           	$query = $this->db->query('SELECT * FROM warehouse WHERE warehouse_type_id = '.$warehouse_type_id.' AND warehouse_status = 1');
			if($query->num_rows() > 0 ) {
				return $query->result();
			} else {
				return array();
			}
       }
	   
	   public function getWarehouseByID($id)
       {
           	$query = $this->db->query('SELECT * FROM warehouse WHERE id = '.$id.' AND warehouse_status = 1');
			if($query->num_rows() > 0 ) {
				return $query->result();
			} else {
				return array();
			}
       }
	   public function getWarehouseType()
       {
           	$query = $this->db->query('SELECT * FROM warehouse_type');
			if($query->num_rows() > 0 ) {
				return $query->result();
			} else {
				return array();
			}
       }
	   public function getWarehouseTypeByID($warehouse_type_id)
       {
           	$query = $this->db->query('SELECT * FROM warehouse_type WHERE id='.$warehouse_type_id.'');
			if($query->num_rows() > 0 ) {
				return $query->result();
			} else {
				return array();
			}
       }
}

?>
