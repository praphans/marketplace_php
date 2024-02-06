<?php
class Model_store extends CI_Model {
    
    public function getStore($store_status_id){
        
        $query = $this->db->select('*');
        $this->db->from('store');

        if(isset($store_status_id) && $store_status_id != 0){
           $this->db->where('store_status',$store_status_id);
        }
        $query = $this->db->get();

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }

    }
    public function getStoreByID($id){
        
        $query = $this->db->query('SELECT * FROM  store WHERE store_id ='.$id); 

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getStoreStatus($id){
            
        $query = $this->db->query('SELECT * FROM  store_status WHERE id ='.$id); 

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getStorePlace($store_id){
        
        $query = $this->db->query('SELECT * FROM  store_place WHERE store_id ='.$store_id); 

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getStoreWorking($place_id){
        $query = $this->db->query('SELECT * FROM  store_working_time WHERE place_id ='.$place_id); 

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getProvincesByID($province){
        $query = $this->db->query('SELECT * FROM  provinces WHERE province_id ='.$province); 

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getAmphuresByID($amphur_id){
        $query = $this->db->query('SELECT * FROM amphures WHERE amphur_id ='.$amphur_id); 

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getDistrictsByID($district_id){
		
		if(!isset($district_id) || !$district_id || $district_id == "" || $district_id == "-")return array();
        $query = $this->db->query('SELECT * FROM districts WHERE district_id ='.$district_id); 

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getStoreTypeByID($id){
        $query = $this->db->query('SELECT * FROM  store_type WHERE id ='.$id); 

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getShippingType($id){
        if(count($id)<=0){	
            return array();	
        }
    
        $this->db->select('*');
        $this->db->from('shipping_type');
        $this->db->where_in('id',$id);            
        $query = $this->db->get();               
        

        if($query->num_rows() > 0){
            return $query->result();
        }	
        else{
            return array();
        }
        
    }
    public function geStoreCategoryByID($id){
        $query = $this->db->query('SELECT * FROM  store_category WHERE id ='.$id); 

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getQtyProductByID($store_id){
        $query = $this->db->query('SELECT count(product_qty) as sum_product_qty  FROM  product WHERE store_id ='.$store_id); 

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getStoreRecom($category_id){
        

        $query = $this->db->select('*');
        $this->db->from('store');

        if(isset($category_id) && $category_id != 0){
           $this->db->where('store_category',$category_id);
        }
        $this->db->where_in('store_status', array('2','5'));
        $this->db->order_by("store_id", "desc");
        $query = $this->db->get();

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }


    }
    public function getStoreCatRecom($store_category){
        
        $query = $this->db->query('SELECT * FROM  store_category WHERE id ='.$store_category); 

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getStoreCatList(){
        
        $query = $this->db->query('SELECT * FROM  store_category'); 

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function getSalesByID($store_id){
        
        $query = $this->db->query('SELECT SUM(product_qty) AS sum_product_qty, SUM(product_price_discount) AS sum_price_discount FROM  order WHERE store_id ='.$store_id); 

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function getDocumentByID($store_id){
        
        $query = $this->db->query('SELECT * FROM  store_document WHERE store_id ='.$store_id); 

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getEditDocumentByID($store_id){
        
        $query = $this->db->query('SELECT * FROM  store_document_edit WHERE store_id ='.$store_id); 

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function getCountAllOrderByID($store_id){
        $query = $this->db->select('COUNT(order_status) AS count_allorder_status');
        $this->db->from('order');

        $this->db->where('store_id',$store_id);
        $query = $this->db->get();
        
        if($query->num_rows() > 0 ){
            return $query->result();
        } else {
            return array();
        }
    }
    public function getCountOrderByID($store_id){
        
        $query = $this->db->select('COUNT(order_status) AS count_order_status');
        $this->db->from('order');
        $this->db->where('store_id',$store_id);
        $this->db->where_in('order_status',array('3','10','11'));
        $query = $this->db->get();
        
        if($query->num_rows() > 0 ){
            return $query->result();
        } else {
            return array();
        }
    }

    public function getStoreStatusList(){
            
        $query = $this->db->query('SELECT * FROM  store_status'); 

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getMemberByID($member_id){
            
        $query = $this->db->query('SELECT email,mobile FROM member WHERE member_id='.$member_id); 

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function getStoryEditByID($store_id){
            
        $query = $this->db->query('SELECT * FROM  store_edit WHERE store_id='.$store_id); 

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
   
    public function getProvincesEditByID($edit_province){
        $query = $this->db->query('SELECT * FROM  provinces WHERE province_id ='.$edit_province); 

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getAmphuresEditByID($edit_amphur){
        $query = $this->db->query('SELECT * FROM amphures WHERE amphur_id ='.$edit_amphur); 

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getDistrictsEditByID($edit_district){
        $query = $this->db->query('SELECT * FROM districts WHERE district_id ='.$edit_district); 

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getStoreTypeEditByID($edit_store_type){
        $query = $this->db->query('SELECT * FROM  store_type WHERE id ='.$edit_store_type); 

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function geStoreCategoryEditByID($edit_store_category){
        $query = $this->db->query('SELECT * FROM  store_category WHERE id ='.$edit_store_category); 

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function getStoreEditByID($store_id){
        
        $query = $this->db->query('SELECT * FROM  store_edit WHERE store_id ='.$store_id); 

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function getStoreDocEditByID($store_id){
        
        $query = $this->db->query('SELECT * FROM  store_document_edit WHERE store_id ='.$store_id); 

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getMyDocument($store_id)
    {
        if(!isset($store_id))return array();
        $query = $this->db->query("SELECT * FROM  store_document WHERE store_id = ".$store_id);
        if($query->num_rows() > 0 ) {
            $result = $query->result();
            return $result;
        } else {
            return array();
        }
    }
    public function getMyDocumentEdit($store_id)
    {
        if(!isset($store_id))return array();
        $query = $this->db->query("SELECT * FROM  store_document_edit WHERE store_id = ".$store_id);
        if($query->num_rows() > 0 ) {
            $result = $query->result();
            return $result;
        } else {
            return array();
        }
    }

    public function getOrderByMemberID($seller_store_id)
    {
        

        $this->db->select("*");
        $this->db->from("store_transaction");
        $this->db->where("seller_store_id",$seller_store_id);
        $this->db->where("amount_total !=",0);

        $this->db->group_by("store_transaction.depositor_store_id");
        $this->db->order_by("store_transaction.timestamp","DESC");

        $query = $this->db->get();
        
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getOrderMyPlaceByMemberID($seller_store_id)
    {

        $this->db->select("*");
        $this->db->from("store_transaction");
        $this->db->where("seller_store_id",$seller_store_id);
        $this->db->where("amount_total <",0);

        $this->db->group_by("store_transaction.depositor_store_id");
        $this->db->order_by("store_transaction.timestamp","DESC");
        $query = $this->db->get();
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
        
    }
    public function getOrderOtherPlaceByMemberID($seller_store_id)
    {
 
        $this->db->select("*");
        $this->db->from("store_transaction");
        $this->db->where("amount_total >",0);
        $this->db->where("seller_store_id",$seller_store_id);

        $this->db->group_by("store_transaction.depositor_store_id");
        $this->db->order_by("store_transaction.timestamp","DESC");
        $query = $this->db->get();
        
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getPlaceByID($place_id)
    {
        $query = $this->db->query('SELECT * FROM  store_place WHERE place_id = '.$place_id);
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getInfoOrderByMemberID($seller_store_id,$depositor_store_id)
    {

        $this->db->select("*");
        $this->db->from("store_transaction");
        $this->db->where("seller_store_id",$seller_store_id);
        $this->db->where("depositor_store_id",$depositor_store_id);
        $this->db->where("amount !=",0);

        $this->db->order_by("store_transaction.timestamp","DESC");
        $query = $this->db->get();
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getTranType($tran_id)
    {
        $query = $this->db->query('SELECT * FROM  store_transaction_type WHERE id = '.$tran_id);
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }


}

?>
