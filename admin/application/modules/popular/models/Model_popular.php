<?php
class Model_popular extends CI_Model {
    
    public function getPopular(){

        $query = $this->db->query('SELECT product_id,product_code,product_name,product_qty,product_price,product_price_discount,product_featured,product_status,product_point,store_id FROM  product WHERE product_status != 5 AND relate_id = 0');
        
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getStoreByID($store_id){
        
        $query = $this->db->query('SELECT store_name FROM  store WHERE store_id ='.$store_id); 

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getProductStatusName($product_status){
        
        $query = $this->db->query('SELECT status_name FROM  product_status WHERE id ='.$product_status); 

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getCountRelateByID($product_id){
        
        $query = $this->db->query('SELECT COUNT(product_id) as count_product_id FROM  product WHERE relate_id ='.$product_id); 

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getProductQtyByID($product_id){
        
        $query = $this->db->query('SELECT SUM(product_qty) as sum_product_qty FROM  product WHERE relate_id ='.$product_id); 

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
   
    




}

?>
