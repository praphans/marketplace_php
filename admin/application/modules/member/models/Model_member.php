<?php
class Model_member extends CI_Model {

	function __construct()
    {
        parent::__construct();
    }

    public function getMemberLogIn($username,$password)
   	{
        $query = $this->db->query('SELECT * FROM admin WHERE username = '.$this->db->escape($username).' AND password = '.$this->db->escape(md5($password))); //is_active != 0 AND
		
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	public function getMember($member_type_id){

        $query = $this->db->select('member_id,first_name,last_name,email,member_type,member_status,timestamp');
        $this->db->from('member');

        if(isset($member_type_id) && $member_type_id != 0){
           $this->db->where('member_type',$member_type_id);
        }

        $this->db->order_by("member_id", "desc");
        $query = $this->db->get();

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getMemberType($member_type){

        $query = $this->db->query('SELECT type_name FROM member_type WHERE type_id = '.$member_type);
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getMemberTypeList(){

        $query = $this->db->query('SELECT type_id,type_name FROM member_type');
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    
    public function getNameTitle(){

        $query = $this->db->query('SELECT default_title FROM contact_info ORDER BY id DESC LIMIT 1');
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getNameCoppyRight(){

        $query = $this->db->query('SELECT copyright FROM contact_info ORDER BY id DESC LIMIT 1');
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }

     public function getCountAllOrderByID($member_id){
        $query = $this->db->select('COUNT(order_status) AS count_allorder_status');
        $this->db->from('order');

        $this->db->where('order_member_id',$member_id);
        $query = $this->db->get();
        
        if($query->num_rows() > 0 ){
            return $query->result();
        } else {
            return array();
        }
    }
    public function getCountOrderByID($member_id){
        $query = $this->db->select('COUNT(order_status) AS count_order_status');
        $this->db->from('order');

        $this->db->where('order_member_id',$member_id);
        $this->db->where_in('order_status',array('3','10','11'));
        $query = $this->db->get();
        
        if($query->num_rows() > 0 ){
            return $query->result();
        } else {
            return array();
        }
    }



    
	   
}

?>
