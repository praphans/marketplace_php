<?php
class Model_faq extends CI_Model {
    
    public function getFaqBuy($faq_cat_id){

        $query = $this->db->select('*');
        $this->db->from('faq');

        if(isset($faq_cat_id) && $faq_cat_id != 0){
           $this->db->where('faq_category',$faq_cat_id);
        }
        $this->db->where('faq_type',1);
        $this->db->order_by("faq_id", "desc");
        $query = $this->db->get();
        
        if($query->num_rows() > 0 ){
            return $query->result();
        } else {
            return array();
        }
    }

    public function getFaqCategoryByID($faq_category){
        
        $query = $this->db->query('SELECT * FROM faq_category WHERE id ='.$faq_category); 
        if($query->num_rows() > 0 ) {
            return $query->result();
        }else{
            return array();
        }
    }
    public function getFaqCategory(){
        
        $query = $this->db->query('SELECT * FROM faq_category'); 
        if($query->num_rows() > 0 ) {
            return $query->result();
        }else{
            return array();
        }
    }
    
    public function getFaqByID($faq_id){

        $query = $this->db->query('SELECT * FROM faq WHERE faq_id ='.$faq_id); 
        if($query->num_rows() > 0 ) {
            return $query->result();
        }else{
            return array();
        }
    }
    public function getFaqSeller($faq_cat_id){

        $query = $this->db->select('*');
        $this->db->from('faq');

        if(isset($faq_cat_id) && $faq_cat_id != 0){
           $this->db->where('faq_category',$faq_cat_id);
        }
        $this->db->where('faq_type',2);
        $this->db->order_by("faq_id", "desc");
        $query = $this->db->get();
        
        if($query->num_rows() > 0 ){
            return $query->result();
        } else {
            return array();
        }
    }
    
    public function getCatArr(){

        $query = $this->db->query('SELECT faq_category FROM faq'); 
        if($query->num_rows() > 0 ) {
            return $query->result();
        }else{
            return array();
        }
    }

}

?>
