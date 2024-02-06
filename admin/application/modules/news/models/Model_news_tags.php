<?php
class Model_news_tags extends CI_Model {
    
    public function getNewsTags()
    {
        $query = $this->db->query('SELECT * FROM  news_tags');

        if($query->num_rows() > 0 ) 
        {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getNewsTagsByID($tag_id)
    {
        $query = $this->db->query('SELECT * FROM  news_tags WHERE tag_id = '.$tag_id);

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
  /*   public function getNewsCategoryByID($new_id)
    {
        $query = $this->db->query('SELECT * FROM  news WHERE new_id ='.$new_id);

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    } */
   
    
}

?>
