<?php
class Model_Statistics extends CI_Model {
    
   public function getStoreCount(){
    
        $query = $this->db->query('SELECT count(store_id) as store_count  FROM  store'); 
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
   public function getProductCount(){
    
        $query = $this->db->query('SELECT count(product_id) as product_count  FROM  product'); 
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getOrderCount(){
    
        $query = $this->db->query('SELECT count(order_id) as order_count  FROM  `order`'); 
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getMemberCount(){
    
        $query = $this->db->query('SELECT count(member_id) as member_count  FROM member'); 
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }


    public function getOrderCountS1(){
    
        $query = $this->db->query('SELECT count(order_id) as order_status_1  FROM  `order` WHERE order_status = 1'); 
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getOrderCountS2(){
    
        $query = $this->db->query('SELECT count(order_id) as order_status_2  FROM  `order` WHERE (product_price_payment != 0 || product_price_payment != 0.0 || product_price_payment != 0.00 || product_price_payment != 00.00)'); 
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    
    public function getOrderCountS3(){
    
        $query = $this->db->query('SELECT count(order_id) as order_status_3  FROM  `order` WHERE order_status = 3'); 
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getOrderCountS4(){
    
        $query = $this->db->query('SELECT count(order_id) as order_status_4  FROM  `order` WHERE order_status = 4'); 
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    
    public function getProductUpdate(){

		$query = $this->db->select('product_id,product_name,product_qty,product_price,product_status,timestamp');
   		$this->db->from('product');
   		$this->db->where('product_status =',3);
		$this->db->order_by("product_id", "desc");
		$this->db->limit(10);
   		$query = $this->db->get();

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getImgByID($product_id){
    
        $query = $this->db->query('SELECT image_url FROM  product_image WHERE product_id ='.$product_id); 
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }

   public function getProductSaleGood(){

		$query = $this->db->query('SELECT product_id,count(order_id) as count_or_id FROM  `order` GROUP BY product_id ORDER BY count_or_id DESC LIMIT 0,5'); 
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }

   public function getProductSale($product_sg_id){

		$query = $this->db->select('product_id,product_name,product_qty,product_price,product_status,timestamp');
   		$this->db->from('product');
   		// $this->db->where('product_status =',3);
   		// $this->db->where('product_id',$product_sg_id);
   		$this->db->where_in('product_id', array($product_sg_id));
   		$query = $this->db->get();

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function getStoreCountByYear1($year1){
    
        $query = $this->db->query('SELECT count(store_id) as store_year  FROM  store WHERE YEAR(timestamp) ='.$year1); 
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getStoreCountByYear2($year2){
    
        $query = $this->db->query('SELECT count(store_id) as store_year  FROM  store WHERE YEAR(timestamp) ='.$year2); 
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getStoreCountByYear3($year3){
    
        $query = $this->db->query('SELECT count(store_id) as store_year  FROM  store WHERE YEAR(timestamp) ='.$year3); 
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getStoreCountByYear4($year4){
    
        $query = $this->db->query('SELECT count(store_id) as store_year  FROM  store WHERE YEAR(timestamp) ='.$year4); 
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getStoreCountByYear5($year5){
    
        $query = $this->db->query('SELECT count(store_id) as store_year  FROM  store WHERE YEAR(timestamp) ='.$year5); 
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getStoreCountByYear6($year6){
    
        $query = $this->db->query('SELECT count(store_id) as store_year  FROM  store WHERE YEAR(timestamp) ='.$year6); 
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getStoreCountByYear7($year7){
    
        $query = $this->db->query('SELECT count(store_id) as store_year  FROM  store WHERE YEAR(timestamp) ='.$year7); 
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }


    public function getMemberCountByYear1($year1){
    
        $query = $this->db->query('SELECT count(member_id) as member_year  FROM member WHERE YEAR(timestamp) ='.$year1); 
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getMemberCountByYear2($year2){
    
        $query = $this->db->query('SELECT count(member_id) as member_year  FROM member WHERE YEAR(timestamp) ='.$year2); 
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getMemberCountByYear3($year3){
    
        $query = $this->db->query('SELECT count(member_id) as member_year  FROM member WHERE YEAR(timestamp) ='.$year3); 
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getMemberCountByYear4($year4){
    
        $query = $this->db->query('SELECT count(member_id) as member_year  FROM member WHERE YEAR(timestamp) ='.$year4); 
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getMemberCountByYear5($year5){
    
        $query = $this->db->query('SELECT count(member_id) as member_year  FROM member WHERE YEAR(timestamp) ='.$year5); 
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getMemberCountByYear6($year6){
    
        $query = $this->db->query('SELECT count(member_id) as member_year  FROM member WHERE YEAR(timestamp) ='.$year6); 
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getMemberCountByYear7($year7){
    
        $query = $this->db->query('SELECT count(member_id) as member_year  FROM member WHERE YEAR(timestamp) ='.$year7); 
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function getStorePopular(){
    
        $query = $this->db->select('t_or.store_id,count(t_or.order_id) as count_or_id,store_name,store_avatar, first_name, last_name,tel');
        $this->db->from('order as t_or');
        $this->db->join('store as t_str', 't_or.store_id = t_str.store_id', 'LEFT');
        $this->db->group_by("store_id");
        $this->db->order_by("count_or_id", "desc");
        $this->db->limit(5);
        $query = $this->db->get();

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }


   //  public function getStorePopularCount(){

   //      $query = $this->db->query('SELECT store_id,count(order_id) as count_or_id FROM  order GROUP BY store_id ORDER BY count_or_id DESC LIMIT 0,5'); 
   //      if($query->num_rows() > 0 ) {
   //          return $query->result();
   //      } else {
   //          return array();
   //      }
   //  }

   // public function getStorePopular($store_id){

   //      $query = $this->db->select('store_name,store_url, first_name, last_name,tel');
   //      $this->db->from('store');
   //      $this->db->where_in('store_id', array($store_id));
   //      $query = $this->db->get();

   //      if($query->num_rows() > 0 ) {
   //          return $query->result();
   //      } else {
   //          return array();
   //      }
   //  }

    public function getReviewStore(){
    
        $query = $this->db->query('SELECT count(review_id) as review_cont_store FROM  review WHERE review_type = 1'); 
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getReviewShipper(){
    
        $query = $this->db->query('SELECT count(review_id) as review_cont_ship FROM  review WHERE review_type = 2'); 
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getReviewProduct(){
    
        $query = $this->db->query('SELECT count(review_id) as review_cont_product FROM  review WHERE review_type = 3'); 
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }

}

?>
