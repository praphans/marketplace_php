<?php
class Model_product_subcategory extends CI_Model {
    
    public function getProductSubcategoryCategory(){
        $query = $this->db->query('SELECT * FROM  product_subcategory');
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getProductSubcategoryByID($id){
        $query = $this->db->query('SELECT * FROM  product_subcategory WHERE  id ='.$id);
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getProductCategoryByID($category_id){
        $query = $this->db->query('SELECT * FROM  product_category WHERE id = '.$category_id);
        if($query->num_rows() > 0){
            return $query->result();
        } else {
            return array();
        }
    }
    public function getProductCategory(){
        $query = $this->db->query('SELECT * FROM  product_category');
        if($query->num_rows() > 0){
            return $query->result();
        } else {
            return array();
        }
    }
    public function getCatArr(){

        $query = $this->db->query('SELECT product_subcategory FROM  product'); 
        if($query->num_rows() > 0 ) {
            return $query->result();
        }else{
            return array();
        }
    }
}   

?>
