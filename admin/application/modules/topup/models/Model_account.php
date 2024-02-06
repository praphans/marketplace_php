<?php
class Model_account extends CI_Model {
    
    public function getTopup(){
        $query = $this->db->query('SELECT * FROM  topup GROUP BY member_id');
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function getMemberById($member_id){
        
        $query = $this->db->query('SELECT first_name,last_name,coin FROM member WHERE member_id ='.$member_id); 

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function getCountBuyTopupByID($member_id){
        $query = $this->db->query('SELECT count(id) as count_buy FROM  topup WHERE member_id='.$member_id);
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getCountUseTopupByID($member_id){
        $query = $this->db->query('SELECT count(order_id) as count_use FROM `order` WHERE order_member_id='.$member_id.' AND order_use_coin_type != 1');
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function getCoinInOrderByID($member_id){
        $query = $this->db->query('SELECT "use" as main, order_use_coin as coin,order_code as code,timestamp FROM  `order` WHERE order_member_id='.$member_id.' AND order_use_coin_type != 1  UNION ALL SELECT "buy" as main, coin_top_up as coin,order_code as code ,timestamp FROM  topup WHERE member_id ='.$member_id);
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }



}

?>
