<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Membermanager{
	
	private $CI;
	
	public function __construct()
	{
		$this->CI =& get_instance();
	}
	public function coin(){ 
		if($this->member_id()){
			$query = $this->CI->db->query('SELECT * FROM member WHERE member_id = '.$this->member_id());
			if($query->num_rows() > 0 ) {
				$res = $query->result();
				foreach($res as $row){
					$coin = $row->coin;	
				}
				return $coin;
			} else {
				return 0;
			}
		}else{
			return 0;//$this->CI->session->userdata("coin");
		}
	}
	public function member_id(){ 
		return $this->CI->session->userdata("member_id");
	}
	public function first_name(){ 
		return $this->CI->session->userdata("first_name");
	}
	public function last_name(){ 
		return $this->CI->session->userdata("last_name");
	}
	public function isMyFollowStore($store_id){
		$this->CI->db->select("store_id");
		$this->CI->db->where("store_id",$store_id);
		$this->CI->db->where("member_id",$this->member_id());
		$query = $this->CI->db->get('store_follow');
		return $query->num_rows();
	}
	public function activeUser($user,$isActive = FALSE){ 
		$this->CI->session->set_userdata("isLoggedIn",$isActive);
		foreach ($user as $key => $value){
			if($isActive){
				$this->CI->session->set_userdata($key,$value);
			}else{
				$this->CI->session->unset_userdata($key,$value);
			}
		}
	}
	public function activeStore($user,$isActive = FALSE){ 
		//$this->cache->save('incorrect_time', 0);
		foreach ($user as $key => $value){
			if($isActive){
				$this->CI->session->set_userdata($key,$value);
			}else{
				$this->CI->session->unset_userdata($key,$value);
			}
		}
	}
	public function checkLogin(){
		if(!$this->CI->session->userdata("isLoggedIn")){
			if($this->CI->session->userdata("admin_id") != 1){
				redirect("member");
			}
		}
	}
	public function isLoggedIn(){
		if($this->CI->session->userdata("admin_id") != 1){
			return $this->CI->session->userdata("isLoggedIn");
		}else{
			return 1;
		}
	}
	
}
