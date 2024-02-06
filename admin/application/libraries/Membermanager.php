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
		return $this->CI->session->userdata("member_id_ref");
	}
	
	
	
	
	
}
