<?php
class Model_inbox extends CI_Model {
    
    public function getInbox(){
        $query = $this->db->select('message_id,sender_id,receiver_id,message,message_type,message_topic,timestamp');
        $this->db->from('message');
        $this->db->group_by('message_code');
        $query = $this->db->get();
        
        if($query->num_rows() > 0 ){
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

    public function getSenderByID($sender_id)
    {
        $query = $this->db->query('SELECT first_name,last_name,email,member_type FROM member WHERE member_id ='.$sender_id);
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getReceiverByID($receiver_id)
    {
        $query = $this->db->query('SELECT first_name,last_name,email,member_type FROM member WHERE member_id ='.$receiver_id);
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }

}

?>
