<?php
class Model_review extends CI_Model {
    
    public function getReview($current_review_type_id,$current_store_id){

        $query = $this->db->select('review_id,member_id,review_rating,order_id,product_id,store_id,review_content,review_type,timestamp');
        $this->db->from('review');


        if(isset($current_review_type_id) && $current_review_type_id != 0){
           $this->db->where('review_type',$current_review_type_id);
        }

         if(isset($current_store_id) && $current_store_id != 0){
           $this->db->where('store_id',$current_store_id);
        }

        // $this->db->order_by("timestamp", "desc");
        $query = $this->db->get();
        
        if($query->num_rows() > 0 ){
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
    public function getProductByID($product_id){

        $query = $this->db->query('SELECT product_code FROM  product WHERE product_id ='.$product_id);
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
    public function getReviewType(){

        $query = $this->db->query('SELECT id,type_name FROM  review_type');
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    


}

?>
