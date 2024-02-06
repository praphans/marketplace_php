<?php
class Model_member extends CI_Model {
  public function getMemberByEmail($member_email)
  {
      echo $member_email."<br>";
  }

  public function email_login($email) 
  {     
		$this->db->select('*');
		$this->db->from('member');
		$this->db->where('email',$email);
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
    	$this->db->insert('member', $user);
		$member_id = $this->db->insert_id();
		return $member_id;
  }
  
  public function getMemberLogIn($email,$password)
  {
	
    $query = $this->db->query("SELECT * FROM member WHERE member_verify = 1 AND email = ".$this->db->escape($email)." AND password = ".$this->db->escape(md5($password)));
  
    if($query->num_rows() > 0 ) {
	  	$result = $query->result_array();
      	return $result[0];
    } else {
      	return array();
    }
  }




}

?>
