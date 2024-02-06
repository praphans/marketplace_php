<?php
class Model_productset extends CI_Model {
    
    public function getProduct($store_id){

        if(isset($store_id) && $store_id != 0){
            $query = $this->db->query('SELECT product_id,product_code,product_mode,product_name,product_qty,product_price,product_price_discount,product_featured,product_status,store_id FROM  product WHERE store_id = '.$store_id.' AND product_status != 5 AND relate_id = 0');
        }else{
            $query = $this->db->query('SELECT product_id,product_code,product_name,product_mode,product_qty,product_price,product_price_discount,product_featured,product_status,store_id FROM  product WHERE product_status != 5 AND relate_id = 0');
        }
        
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
    public function getproductDescriptByID($product_id){

        $query = $this->db->query('SELECT * FROM  product WHERE product_id ='.$product_id);
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getproductTypeByID($product_type){

        $query = $this->db->query('SELECT type_name FROM  product_type WHERE id ='.$product_type);
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getproductImgByID($product_id){

        $query = $this->db->query('SELECT image_url FROM  product_image WHERE product_id ='.$product_id);
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }  
    public function getCategoryID($product_category){

        $query = $this->db->query('SELECT category_name FROM  product_category WHERE id ='.$product_category);
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getReviewByID($product_id){

        $query = $this->db->query('SELECT review_rating,review_content,review_type,review_status,member_id,timestamp FROM  review WHERE product_id ='.$product_id);
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getMemberByID($member_id){

        $query = $this->db->query('SELECT first_name,last_name FROM  member WHERE member_id ='.$member_id);
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getReviewTypeByID($review_type){

        $query = $this->db->query('SELECT type_name FROM  review_type WHERE id ='.$review_type);
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
    public function getProductFeatured(){
        
        $query = $this->db->query('SELECT id,featured_name FROM  product_featured '); 

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getProductFeatureByID($product_featured){
        
        $query = $this->db->query('SELECT id,featured_name FROM  product_featured WHERE id ='.$product_featured); 

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getRelateByID($product_id){
        
        $query = $this->db->query('SELECT * FROM  product WHERE relate_id ='.$product_id); 

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

    public function getProductNameByID($relate_id){
        
        $query = $this->db->query('SELECT product_name FROM  product WHERE product_id ='.$relate_id); 

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }



}

?>
