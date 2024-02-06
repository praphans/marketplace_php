<?php
class Model_bank extends CI_Model {
    
    public function getBank(){
        
        $query = $this->db->query('SELECT * FROM  store_bank ORDER BY id DESC');

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getBankById($bank_id){
        
        $query = $this->db->query('SELECT * FROM  store_bank WHERE id ='.$bank_id);

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
   
    

}

?>
