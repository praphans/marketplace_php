<?php
class Model_place extends CI_Model {
    
    public function getPlace($current_shipping_type_id){

        $query = $this->db->select('place_id,store_id,member_id,shipping_type_id,place_code,place_name,place_mobile');
        $this->db->from('store_place');


        if(isset($current_shipping_type_id) && $current_shipping_type_id != 0){
           $this->db->where('shipping_type_id',$current_shipping_type_id);
        }
        $this->db->where('request_place_id',NULL);
        // $this->db->order_by("place_id", "desc");
        $query = $this->db->get();
        
        if($query->num_rows() > 0 ){
            return $query->result();
        } else {
            return array();
        }
    }

    public function getStoreByID($store_id){

        $query = $this->db->query('SELECT store_code,store_name FROM  store WHERE store_id ='.$store_id);
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function getShippingTypeByID($shipping_type_id){

        $query = $this->db->query('SELECT type_name FROM  shipping_type WHERE id ='.$shipping_type_id);
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function getPlaceByID($place_id){

        $query = $this->db->select('*');
        $this->db->from('store_place');
        $this->db->where('place_id',$place_id);
        $query = $this->db->get();
        
        if($query->num_rows() > 0 ){
            return $query->result();
        } else {
            return array();
        }
    }
    public function getStoreDiscripByID($store_id){

        $query = $this->db->select('store_code,store_name,tel');
        $this->db->from('store');
        $this->db->where('store_id',$store_id);
        $query = $this->db->get();
        
        if($query->num_rows() > 0 ){
            return $query->result();
        } else {
            return array();
        }
    }
    public function getWorkingTimeByID($working_time_id){

        $query = $this->db->select('work_day,work_starttime,work_endtime,open_all_day');
        $this->db->from('store_working_time');
        $this->db->where('work_id',$working_time_id);
        $query = $this->db->get();
        
        if($query->num_rows() > 0 ){
            return $query->result();
        } else {
            return array();
        }
    }
    public function getCountAgentByID($store_id){

        $query = $this->db->select('count(request_place_id) as agent_count');
        $this->db->from('store_place');
        $this->db->where('store_id',$store_id);
        $this->db->where('shipping_type_id',2);
        $this->db->where('place_status',2);
        $query = $this->db->get();
        
        if($query->num_rows() > 0 ){
            return $query->result();
        } else {
            return array();
        }
    }
    public function getCountStorePlaceByID($place_id){

        $query = $this->db->select('count(place_id) as place_count');
        $this->db->from('store_place');
        $this->db->where('request_place_id',$place_id);
        $this->db->where('shipping_type_id',2);
        $this->db->where('place_status',2);
        $query = $this->db->get();
        
        if($query->num_rows() > 0 ){
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
    public function getWorkingByID($place_id)
    {
        $query = $this->db->query("SELECT * FROM  store_working_time WHERE place_id = ".$place_id);
        if($query->num_rows() > 0 ) {
            $result = $query->result();
            return $result;
        } else {
            return array();
        }
    }
    public function getStorePlaceByID($store_id){

        $query = $this->db->select('*');
        $this->db->from('store_place');
        $this->db->where('store_id',$store_id);
        $this->db->where('shipping_type_id',2);
        $this->db->where('place_status',2);
        $query = $this->db->get();
        
        if($query->num_rows() > 0 ){
            return $query->result();
        } else {
            return array();
        }
    }
    public function getRequestPlaceByID($agent_request_place_id){

        $query = $this->db->select('place_id,store_id');
        $this->db->from('store_place');
        $this->db->where('place_id',$agent_request_place_id);
        $query = $this->db->get();
        
        if($query->num_rows() > 0 ){
            return $query->result();
        } else {
            return array();
        }
    }

    public function getStorePlace2ByID($place_id){

        $query = $this->db->select('*');
        $this->db->from('store_place');
        $this->db->where('request_place_id',$place_id);
        $this->db->where('shipping_type_id',2);
        $this->db->where('place_status',2);
        $query = $this->db->get();
        
        if($query->num_rows() > 0 ){
            return $query->result();
        } else {
            return array();
        }
    }






    



}

?>
