<?php
class Model_massage extends CI_Model {
    
    public function getMassage(){
        $query = $this->db->query('SELECT * FROM message WHERE message_type = 4');
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function getMemberByID($sender_id)
    {
        $query = $this->db->query('SELECT * FROM member WHERE member_id ='.$sender_id);
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function getOrderByID($order_id){
        $query = $this->db->query('SELECT store_id,order_code FROM  order WHERE order_id = '.$order_id);
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function getImgByID($message_id){
        $query = $this->db->query('SELECT image_url FROM message_image WHERE message_id = '.$message_id);
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getMassageByID($message_id){
        $query = $this->db->query('SELECT * FROM message WHERE message_id = '.$message_id);
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getStoreByID($receiver_id){
        $query = $this->db->query('SELECT * FROM  store WHERE store_id = '.$receiver_id);
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
   
}

?>
