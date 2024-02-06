<?php
class Model_product_category extends CI_Model {
    
    public function getProductCategory(){
        $query = $this->db->query('SELECT * FROM  product_category ORDER BY id DESC');
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getProductCategoryByID($id){
        $query = $this->db->query('SELECT * FROM  product_category WHERE  id ='.$id);
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getCatArr(){

        $query = $this->db->query('SELECT product_category FROM  product'); 
        if($query->num_rows() > 0 ) {
            return $query->result();
        }else{
            return array();
        }
    }
}

?>
