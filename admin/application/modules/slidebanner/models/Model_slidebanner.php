<?php
class Model_slidebanner extends CI_Model {
    
    public function getSlidebanner()
    {
        $query = $this->db->query('SELECT * FROM banner');

        if($query->num_rows() > 0 ) 
        {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getSlidebannerByID($banner_id)
    {
        $query = $this->db->query('SELECT * FROM banner WHERE banner_id = '.$banner_id);

        if($query->num_rows() > 0 ) 
        {
            return $query->result();
        } else {
            return array();
        }
    }

    
}

?>
