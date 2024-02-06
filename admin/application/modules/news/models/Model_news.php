<?php
class Model_news extends CI_Model {
    
    public function getNews()
    {
        $query = $this->db->query('SELECT * FROM  news ORDER BY new_id DESC');

        if($query->num_rows() > 0 ) 
        {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getNewsCategory()
    {
        $query = $this->db->query('SELECT * FROM  news_category');

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getNewsCategoryByID($new_id)
    {
        $query = $this->db->query('SELECT * FROM  news WHERE new_id ='.$new_id);

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getNewsTageByID($new_tags)
    {

        $query = $this->db->select('tag_name');
        $this->db->from('news_tags');
        $this->db->where_in('tag_id',$new_tags);
        $query = $this->db->get();
        
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getNewsTage()
    {

        $query = $this->db->select('tag_id,tag_name');
        $this->db->from('news_tags');
        $query = $this->db->get();
        
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function getTagsIdByName($new_tags)
    {

        $query = $this->db->select('tag_id');
        $this->db->from('news_tags');
        $this->db->where_in('tag_name',$new_tags);
        $query = $this->db->get();
        
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getMessageType()
    {

        $query = $this->db->select('id,message');
        $this->db->from('message_type');
        $query = $this->db->get();
        
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getCategory()
    {

        $query = $this->db->select('id,category_name');
        $this->db->from('news_category');
        $query = $this->db->get();
        
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getCategoryByID($new_cate_id)
    {
        $query = $this->db->query('SELECT category_name FROM  news_category WHERE id = '.$new_cate_id);

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getMessageSentType()
    {
        $query = $this->db->query('SELECT * FROM message_sent_type');

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function getMember($tags)
   {
        $this->db->select('member_id,first_name,last_name,email');
        $this->db->like('member_id', $tags);
        $this->db->or_like('first_name', $tags);
        $this->db->or_like('last_name', $tags);
        $this->db->or_like('email', $tags);
        $this->db->limit(50);
        return $this->db->get('member')->result();
   }
   // ส่งข้อความเฉพาะสมาชิกที่ไม่ใช่ร้านค้า
   // public function getAllMember()
   //  {
   //      $query = $this->db->query('SELECT member_id FROM member AS km WHERE NOT km.member_id IN (SELECT ks.member_id FROM  store AS ks )');

   //      if($query->num_rows() > 0 ) {
   //          return $query->result();
   //      } else {
   //          return array();
   //      }
   //  }

   // ส่งข้อความเฉพาะสมาชิกที่รวมร้านค้า
    public function getAllMember()
    {
        $query = $this->db->query('SELECT member_id FROM member AS km');

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function getStoreMember()
    {
        $query = $this->db->query('SELECT DISTINCT(member_id) FROM  store');

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
   
    
}

?>
