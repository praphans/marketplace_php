<?php
class Model_news_category extends CI_Model {
    
    public function getNewsCategory()
    {
        $query = $this->db->query('SELECT * FROM  news_category');

        if($query->num_rows() > 0 ) 
        {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getNewsCategoryByID($id)
    {
        $query = $this->db->query('SELECT * FROM  news_category WHERE id = '.$id);

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getCatArr(){

        $query = $this->db->query('SELECT new_cate_id FROM  news'); 
        if($query->num_rows() > 0 ) {
            return $query->result();
        }else{
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
