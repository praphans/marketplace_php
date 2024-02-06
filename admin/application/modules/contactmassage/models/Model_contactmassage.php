<?php
class Model_contactmassage extends CI_Model {
    
    public function getContactmassage(){
        $query = $this->db->query('SELECT * FROM contact');
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
   
}

?>
