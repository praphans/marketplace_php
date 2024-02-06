<?php
class Model_registration extends CI_Model {
  

  public function getStoreTypeByID($store_type)
  {
	
    $query = $this->db->query('SELECT * FROM  store_type WHERE id ='.$store_type);
  
    if($query->num_rows() > 0 ) {
      return $query->result();
    } else {
      return array();
    }
  }

  public function getStoreDocumentByID($store_id)
  {
    $query = $this->db->query('SELECT * FROM  store_document WHERE store_id='.$store_id);
  
    if($query->num_rows() > 0 ) {
      return $query->result();
    } else {
      return array();
    }
  }
  public function getMemberByID($member_id)
  {
    $query = $this->db->query('SELECT * FROM member WHERE member_id ='.$member_id);
  
    if($query->num_rows() > 0 ) {
      return $query->result();
    } else {
      return array();
    }
  }




}

?>
