<?php
class Model_store_category extends CI_Model {
    
    public function getStoreCategory(){
        $query = $this->db->query('SELECT * FROM  store_category WHERE category_status = 1');
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getStoreCategoryByID($id){
        $query = $this->db->query('SELECT * FROM  store_category WHERE  id ='.$id);
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getCatArr(){

        $query = $this->db->query('SELECT store_category FROM  store'); 
        if($query->num_rows() > 0 ) {
            return $query->result();
        }else{
            return array();
        }
    }
    
}

?>
