<?php
class Model_feature extends CI_Model {
    
    public function getFeature()
    {
        $query = $this->db->query('SELECT * FROM  product_featured ORDER BY id DESC');

        if($query->num_rows() > 0 ) 
        {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getFeaturedTypeByID($featured_type)
    {
        $query = $this->db->query('SELECT type_name FROM  product_featured_type WHERE id = '.$featured_type);

        if($query->num_rows() > 0 ) 
        {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getFeaturedType()
    {
        $query = $this->db->query('SELECT id,type_name FROM  product_featured_type');

        if($query->num_rows() > 0 ) 
        {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getFeaturedByID($featured_id)
    {
        $query = $this->db->query('SELECT * FROM  product_featured WHERE id ='.$featured_id);

        if($query->num_rows() > 0 ) 
        {
            return $query->result();
        } else {
            return array();
        }
    }

    // public function getNewsTage()
    // {

    //     $query = $this->db->select('tag_id,tag_name');
    //     $this->db->from('news_tags');
    //     $query = $this->db->get();
        
    //     if($query->num_rows() > 0 ) {
    //         return $query->result();
    //     } else {
    //         return array();
    //     }
    // }

   
    
}

?>
