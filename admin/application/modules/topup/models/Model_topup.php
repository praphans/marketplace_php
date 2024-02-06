<?php
class Model_topup extends CI_Model {
    
    public function getTopup(){
        $query = $this->db->query('SELECT * FROM  topup');
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function getMemberById($member_id){
        
        $query = $this->db->query('SELECT first_name,last_name FROM member WHERE member_id ='.$member_id); 

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function getCoinByID(){
        
        $query = $this->db->query('SELECT coin_value FROM  contact_info WHERE id = 1'); 

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }

}

?>
