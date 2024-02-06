
<?php

class Model_order extends CI_Model {
    
    public function getOrder($order_status_id){

        $query = $this->db->select('order_id,order_code,order_tax,order_buyer_place_is_hidden,store_id,order_member_id,order_status,product_qty,timestamp');
        $this->db->from('order');

        if(isset($order_status_id) && $order_status_id != 0){
           $this->db->where('order_status',$order_status_id);
        }
        $this->db->group_by('order_code');
        $this->db->order_by("order_id", "desc");
        $query = $this->db->get();
        
        if($query->num_rows() > 0 ){
            return $query->result();
        } else {
            return array();
        }
    }

    public function getOrderType(){

        $query = $this->db->select('id,status_name');
        $this->db->from('order_status');
        $query = $this->db->get();
        
        if($query->num_rows() > 0 ){
            return $query->result();
        } else {
            return array();
        }
    }
    public function getOrderStatusByID($order_status){

        $query = $this->db->select('status_name');
        $this->db->from('order_status');
        $this->db->where('id',$order_status);
        $query = $this->db->get();
        
        if($query->num_rows() > 0 ){
            return $query->result();
        } else {
            return array();
        }
    }
    public function getMemberByID($member_id){

        $query = $this->db->select('first_name,last_name');
        $this->db->from('member');
        $this->db->where('member_id',$member_id);
        $query = $this->db->get();
        
        if($query->num_rows() > 0 ){
            return $query->result();
        } else {
            return array();
        }
    }
    public function getStoreByID($store_id){

        $query = $this->db->select('store_name');
        $this->db->from('store');
        $this->db->where('store_id',$store_id);
        $query = $this->db->get();
        
        if($query->num_rows() > 0 ){
            return $query->result();
        } else {
            return array();
        }
    }

    public function getOrderQtyCount($order_code){

        $query = $this->db->select('count(product_qty) as product_qty_count');
        $this->db->from('order');
        $this->db->where('order_code',$order_code);
        $query = $this->db->get();
        
        if($query->num_rows() > 0 ){
            return $query->result();
        } else {
            return array();
        }
    }

    public function getOrderDescription($order_code){

        $query = $this->db->select('*');
        $this->db->from('order');
        $this->db->where('order_code',$order_code);
        $query = $this->db->get();
        
        if($query->num_rows() > 0 ){
            return $query->result();
        } else {
            return array();
        }
    }

    public function getShipByID($order_shipping_type_id){

        $query = $this->db->select('type_name');
        $this->db->from('shipping_type');
        $this->db->where('id',$order_shipping_type_id);
        $query = $this->db->get();
        
        if($query->num_rows() > 0 ){
            return $query->result();
        } else {
            return array();
        }
    }

    public function getOrderHistory($order_id){

        $query = $this->db->select('order_status,timestamp');
        $this->db->from('order_status_history');
        $this->db->where('order_id',$order_id);
        $query = $this->db->get();
        
        if($query->num_rows() > 0 ){
            return $query->result();
        } else {
            return array();
        }
    }
    public function getPlaceByID($place_id)
    {
        $query = $this->db->query('SELECT * FROM  store_place WHERE place_id = '.$place_id.' LIMIT 1');
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getProvinceByID($province_id)
    {
        if(empty($province_id)) return "-";
        $query = $this->db->query("SELECT province_name FROM  provinces WHERE province_id = ".$province_id);
        if($query->num_rows() > 0 ) {
            $result = $query->result();
            return $result[0]->province_name;
        } else {
            return "-";
        }
    }
    public function getAmphurByID($amphur_id)
    {
        if(empty($amphur_id)) return "-";
        $query = $this->db->query("SELECT amphur_name FROM amphures WHERE amphur_id = ".$amphur_id);
        if($query->num_rows() > 0 ) {
            $result = $query->result();
            return $result[0]->amphur_name;
        } else {
            return "-";
        }
    }
    public function getDistrictByID($district_id)
    {
        if(empty($district_id)) return "-";
        $query = $this->db->query("SELECT district_name FROM districts WHERE district_id = ".$district_id);
        if($query->num_rows() > 0 ) {
            $result = $query->result();
            return $result[0]->district_name;
        } else {
            return "-";
        }
    }


    


}

?>
