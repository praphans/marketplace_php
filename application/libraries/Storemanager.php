<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Storemanager{
	
	private $CI;
	
	public function __construct()
	{
		$this->CI =& get_instance();
	}
	/*public function detectLogin(){
		$this->CI->db->select("store_id");
		$this->CI->db->from("store");
		$this->CI->db->where("store_id",$this->store_id());
		$query = $this->CI->db->get();
		if($query->num_rows()<=0){
			redirect("home");
		}
	}*/
	//รูป store avatar default
	public function default_avatar_image()
	{
		return "assets/default/default_avatar_image.jpg";
	}
	//รูป store cover default
	public function default_cover_image()
	{
		return "assets/default/default_cover_image.jpg";
	}
	
	//รูป store avatar default
	public function store_avatar_image()
	{
		return base_url($this->CI->session->userdata("store_avatar"));
	}
	//รูป store cover default
	public function store_cover_image()
	{
		return base_url($this->CI->session->userdata("store_cover"));
	}
	
	//รูป store cover default
	public function store_description()
	{
		return $this->CI->session->userdata("store_description");
	}
	//หมวดหมู่ทั้งหมด
	public function getStoreCategory(){
		return $this->CI->model_storemanager->getStoreCategory();
	}
	//ประเภททั้งหมด
	public function getStoreType(){
		return $this->CI->model_storemanager->getStoreType();
	}
	//ธนาคารทั้งหมด
	public function getStoreBank(){
		return $this->CI->model_storemanager->getStoreBank();
	}
	//เอกสารของร้านค้าทั้งหมด
	public function getMyDocument(){
		return $this->CI->model_storemanager->getMyDocument($this->store_id());
	}
	//ร้านค้าของคนที่เข้าระบบอยู่
	public function myStore(){

		$this->ckStore();
		return $this->CI->model_storemanager->myStore($this->CI->membermanager->member_id());
	}
	public function myStoreUnLock(){

		return $this->CI->model_storemanager->myStore($this->CI->membermanager->member_id());
	}
	public function statusUpdate(){
		$store_id = $this->CI->session->userdata("store_id");
		$this->CI->db->select("store_status");
		$this->CI->db->from("store");
		$this->CI->db->where("store_id",$store_id);
		$query = $this->CI->db->get();
		
		if($query->num_rows()){
			$result = $query->result();
			$store_status = $result[0]->store_status;
			$this->CI->session->set_userdata('store_status',$store_status);
		}
		
		$store_status = $this->CI->session->userdata('store_status');
		if($store_status == 1 || $store_status == 3 || $store_status == 4 || $store_status == 6){
			
		}
	}
	public function hasStore(){
		$store_id = $this->CI->session->userdata("store_id");
		$this->CI->db->select("store_status");
		$this->CI->db->from("store");
		$this->CI->db->where("store_id",$store_id);
		$query = $this->CI->db->get();
		
		if($query->num_rows()){
			$result = $query->result();
			$store_status = $result[0]->store_status;
			$this->CI->session->set_userdata('store_status',$store_status);
		}
		
		$store_status = $this->CI->session->userdata('store_status');
		if($store_status == 1 || $store_status == 3 || $store_status == 4 || $store_status == 6){
			redirect("home");
		}
	}
	public function ckStore(){
		$store_id = $this->CI->session->userdata("store_id");
		$this->CI->db->select("store_status");
		$this->CI->db->from("store");
		$this->CI->db->where("store_id",$store_id);
		$query = $this->CI->db->get();
		
		if($query->num_rows()){
			$result = $query->result();
			$store_status = $result[0]->store_status;
			$this->CI->session->set_userdata('store_status',$store_status);
		}
		
		$store_status = $this->CI->session->userdata('store_status');
		if($store_status == 1 || $store_status == 3 || $store_status == 4 || $store_status == 6){
			redirect("home");
		}
	}
	//ไอดีร้านค้า
	public function store_id(){
		
		$this->ckStore();
		return $this->CI->session->userdata("store_id");
	}
	//ชื่อร้านค้า
	public function store_name(){
		return $this->CI->session->userdata("store_name");
	}
	//url ร้านค้า
	public function store_url(){
		return $this->CI->session->userdata("store_url");
	}
	// สถานที่ของเจ้าของร้าน
	public function store_place(){
		return $this->CI->model_storemanager->getStorePlace();
	}
	// สถานที่ของ เอเย่นต์
	public function agent_place(){
		return $this->CI->model_storemanager->getAgentPlace();
	}
	// พื้นที่บริการ
	public function service_place(){
		return $this->CI->model_storemanager->getServicePlace();
	}
	// พื้นที่บริการ
	public function getProvinceName($id){
		return $this->CI->model_storemanager->getProvinceByID($id);
	}
	// พื้นที่บริการ
	public function getAmphurName($id){
		return $this->CI->model_storemanager->getAmphurByID($id);
	}
	// พื้นที่บริการ
	public function getDistrictName($id){
		return $this->CI->model_storemanager->getDistrictByID($id);
	}
	// พื้นที่บริการ
	public function working_time($id){
		return $this->CI->model_storemanager->getWorkingTimeByID($id);
	}
	public function responseTime($member_id){
		$receive = $this->CI->model_storemanager->getLastRecieveMessage($member_id);
		$sender = $this->CI->model_storemanager->getLastSenderMessage($member_id);
		
		if(count($receive)>0){
			$time_receive = $receive[0]->timestamp;
		}else{
			$time_receive = date('Y/m/d H:i:s');
		}
		if(count($sender)>0){
			$time_response = $sender[0]->timestamp;
		}else{
			$time_response = date('Y/m/d H:i:s');
		}
		$response_time = $this->CI->utils->time_response_string($time_receive,$time_response);
		
		return $response_time;
	}
}
