<?php
class Model_store extends CI_Model {
  public function getMemberByEmail($member_email)
  {
      echo $member_email."<br>";
  }

public function getMemberByID($member_id) 
  {     
		$this->db->select('*');
		$this->db->from('member');
		$this->db->where('member_id',$member_id);
		$query=$this->db->get();
		
		if($query->num_rows() > 0 ) {
		  $user = $query->result_array();
		  $user = $user[0];
		  return $user;
		} else {
		  return array();
		}
  }

  public function register_user($user)
  {
    $this->db->insert('store', $user);
  }
  
  public function getStore()
  {
    $query = $this->db->query('SELECT * FROM  store');
  
    if($query->num_rows() > 0 ) {
      return $query->result();
    } else {
      return array();
    }
  }
  public function getStoreById($member_id)
  {
    $query = $this->db->query('SELECT * FROM  store WHERE member_id = '.$member_id);
  
    if($query->num_rows() > 0 ) {
      return $query->result();
    } else {
      return array();
    }
  }
  public function getMember()
  {
    $query = $this->db->query('SELECT * FROM member');
  
    if($query->num_rows() > 0 ) {
      return $query->result();
    } else {
      return array();
    }
  }
  public function getMemberLogIn($email,$password)
  {
    $query = $this->db->query('SELECT email,password FROM member WHERE email = '.$this->db->escape($email).' AND password = '.$this->db->escape(md5($password)));
  
    if($query->num_rows() > 0 ) {
      return $query->result();
    } else {
      return array();
    }
  }
  public function checkPassword($password) 
  {     
    $this->db->select('*');
    $this->db->from('member');
    $this->db->where('password',$password);
    $query=$this->db->get();
  
    if($query->num_rows() > 0 ) {
      return $query->result();
    } else {
      return array();
    }
  }
 
  public function storeInsert($data)
  {
    $this->db->insert('store', $data);
  }
  
  public function storeUpdate($data,$member_id)
  {
    $this->db->where('member_id', $member_id);
		$this->db->update('store', $data);
  }
  
  public function getStoreOrderByID($store_id)
  {
    $query = $this->db->query('SELECT * FROM  store WHERE store_id = '.$store_id);
  
    if($query->num_rows() > 0 ) {
      return $query->result();
    } else {
      return array();
    }
  }



}

?>
