<?php
class Model_promotions extends CI_Model {
    
    public function getPromotions(){
        
        $query = $this->db->query('SELECT * FROM  product_promo_join WHERE join_status = 1');

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getPromotionsByID($join_id){
        
        $query = $this->db->query('SELECT * FROM  product_promo_join WHERE join_id ='.$join_id);

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }



    public function getPromoWebByID($promo_id){
        
        $query = $this->db->query('SELECT * FROM  promotion WHERE promo_id ='.$promo_id);

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getPromotionsWebsite(){
        
        $query = $this->db->query('SELECT * FROM  promotion');

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getPromoRequest(){
        
        // $query = $this->db->query('SELECT * FROM  product_promo WHERE promo_status != 4');

        $this->db->select('kpp.promo_id,kpp.product_id,kpp.join_id,kpp.promo_name,kpp.promo_price,kpp.promo_startdate,kpp.promo_starttime,kpp.promo_enddate,kpp.promo_endtime,kpp.promo_status,kpp.promo_type,kpp.timestamp,kppj.join_id,kppj.join_name,kppj.join_startdate,kppj.join_starttime,kppj.join_enddate,kppj.join_endtime,kppj.join_status');
        $this->db->from('product_promo as kpp');
        $this->db->where('kpp.promo_status !=',4);
        $this->db->where('kpp.promo_type !=',1);
        $this->db->join('product_promo_join as kppj', 'kpp.join_id = kppj.join_id', 'LEFT');
        $query = $this->db->get();


        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getPromoStatusByID($promo_status){
        
        $query = $this->db->query('SELECT status_name FROM  product_promo_status WHERE id ='.$promo_status);

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
   
    public function getPromoTypeByID($promo_type){
        
        $query = $this->db->query('SELECT type_name FROM  product_promo_type WHERE id ='.$promo_type);

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getPromoProductByID($product_id){
        
        $query = $this->db->query('SELECT store_id,product_name FROM  product WHERE product_id ='.$product_id);

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getStore(){
        
        $query = $this->db->query('SELECT * FROM  store'); 

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
    public function getQtyProductByID($store_id){
        $query = $this->db->query('SELECT count(product_qty) as sum_product_qty  FROM  product WHERE store_id ='.$store_id); 

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getJoinPromoByID($join_id){
        $query = $this->db->query('SELECT join_store_list FROM  product_promo_join WHERE join_id ='.$join_id); 

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getCountStorePomoByID($join_store_list){
        $query = $this->db->query('SELECT COUNT(store_id) as count_store_id FROM  store WHERE store_id IN ('.$join_store_list.')');
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function getProductPromoByID($join_id){
        $query = $this->db->query('SELECT product_id FROM  product_promo WHERE join_id ='.$join_id);
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function getProductByID($product_id)
    {

        $query = $this->db->select('COUNT(store_id) as count_join_store');
        $this->db->from('product');
        $this->db->where_in('product_id',$product_id);
        $this->db->group_by('store_id');
        $query = $this->db->get();
        
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function getstoreByID($store_id){
        $query = $this->db->query('SELECT store_name FROM  store WHERE store_id ='.$store_id);
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }




}

?>
