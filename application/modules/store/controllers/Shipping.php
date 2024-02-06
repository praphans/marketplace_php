<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shipping extends MX_Controller {   

	public $PAGE;
	public function __construct() {
        parent::__construct();
		
		$this->PAGE['title'] = 'ช่องทางการจัดส่งสินค้า | '.$this->load->get_var("default_title");
		$this->membermanager->checkLogin();
		
		$this->load->model("model_shipping");
		$this->load->helper(array('form', 'url'));
		$config['upload_path'] = 'uploads';
		$config['allowed_types'] = 'svg|gif|jpg|png|doc|doc'; 
		$config['encrypt_name'] = TRUE;
		$this->load->library('upload', $config);
		$this->storemanager->hasStore();
	}
	public function index()
	{
		$myStore = $this->storemanager->myStore();
		$this->PAGE['myStore'] = $myStore;
		$this->load->view("store/8_".$this->router->fetch_class()."/shipping_view",$this->PAGE);
	}
	public function storePlace(){
		$store_place = $this->storemanager->store_place();
		$this->PAGE['store_place'] = $store_place;
		
		$this->load->view("store/8_".$this->router->fetch_class()."/tabs/storeplace",$this->PAGE);
	}
	public function agentPlace(){
		$agent_place = $this->storemanager->agent_place();
		$this->PAGE['agent_place'] = $agent_place;
		//print_r($agent_place);
		$this->load->view("store/8_".$this->router->fetch_class()."/tabs/agentplace",$this->PAGE);
	}
	public function servicePlace(){
		$service_place = $this->storemanager->service_place();
		$this->PAGE['service_place'] = $service_place;
		//print_r($service_place);
		$this->load->view("store/8_".$this->router->fetch_class()."/tabs/serviceplace",$this->PAGE);
	}
	
	public function editPlace($place_id){
		$store_place = $this->model_storemanager->getPlaceByID($place_id);
		$this->PAGE['store_place'] = $store_place;
		$this->load->view("store/8_".$this->router->fetch_class()."/shipping_edit_place_view",$this->PAGE);
	}
	public function findAgentPlace($place_id){
		$store_place = $this->model_storemanager->getPlaceByID($place_id);
		$this->PAGE['store_place'] = $store_place;
		$this->load->view("store/8_".$this->router->fetch_class()."/modal_shop_agent_address",$this->PAGE);
	}
	public function saveService(){
		
		$store_id = $this->storemanager->store_id();
		$place['place_name'] = 'เขตพื้นที่บริการจัดส่ง';
		$place['place_province'] = $this->input->post('service_province');
		$place['place_amphur'] = $this->input->post('service_amphur');
		$place['place_condition'] = $this->input->post('service_condition');
		$place['store_id'] = $store_id;
		$place['shipping_type_id'] = 3;
		$place['place_status'] = 2;
		$place['place_code'] = "P".time();
		
		$this->db->insert("store_place",$place);
		$this->updatePlaceList();
		redirect("store/shipping","refresh");
	}
	public function savePlace(){
		$place = $this->input->post();
		$store_id = $this->storemanager->store_id();
		$place['store_id'] = $store_id;
		$place['place_code'] = "P".time();
		$amphur_id = $this->input->post('place_amphur');
		
		$working_time = $place['working_time'];
		$open_time = $place['open_time'];
		$close_time = $place['close_time'];
		$open_all_day = (isset($place['open_all_day']))?$place['open_all_day']:array();
		$open_all_day_stop = (isset($place['open_all_day_stop']))?$place['open_all_day_stop']:array();
		
		//print_r($working_time);
		//exit();
		//$place['place_status'] = (isset($place['place_status']))?$place['place_status']:array();
		
		
		unset($place['working_time']);
		unset($place['open_time']);
		unset($place['close_time']);
		unset($place['open_all_day']);
		unset($place['open_all_day_stop']);
		
		$this->db->insert("store_place",$place);
		$place_id = $this->db->insert_id();
		
		for($i = 0;$i<count($working_time);$i++){
			$work_day = $working_time[$i];
			$work_starttime = (isset($open_time[$i]))?$open_time[$i]:0;
			$work_endtime = (isset($close_time[$i]))?$close_time[$i]:0;
			if(isset($open_all_day[$i])){
				$all_day = ($open_all_day[$i] == 0)?1:0;
			}else{
				$all_day = 0;
			}
			if(isset($open_all_day_stop[$i])){
				$is_holiday = ($open_all_day_stop[$i] == 0)?1:0;
			}else{
				$is_holiday = 0;
			}
			
			
			
			
			$working = array(
				"place_id"=>$place_id,
				"work_day"=>$work_day,
				"work_starttime"=>$work_starttime,
				"work_endtime"=>$work_endtime,
				"open_all_day"=>$all_day,
				"is_holiday"=>$is_holiday
			);
			
			$this->db->insert("store_working_time",$working);
		}
		$this->updatePlaceList();
		redirect("store/shipping","refresh");
	}
	public function updatePlace(){
		$place = $this->input->post();
		$store_id = $this->storemanager->store_id();
		$place_id = $this->input->post('place_id');
		$amphur_id = $this->input->post('place_amphur');
		$open_all_day = (isset($place['open_all_day']))?$place['open_all_day']:array();
		$open_all_day_stop = (isset($place['open_all_day_stop']))?$place['open_all_day_stop']:array();
		$place['store_id'] = $store_id;
		//$place['place_code'] = "P".time();
		
		$working_time = $place['working_time'];
		$open_time = $place['open_time'];
		$close_time = $place['close_time'];
		//$open_all_day = $place['open_all_day'];
		
		unset($place['place_id']);
		unset($place['working_time']);
		unset($place['open_time']);
		unset($place['close_time']);
		unset($place['open_all_day']);
		unset($place['open_all_day_stop']);
		
		$this->db->where("place_id",$place_id);
		$this->db->update("store_place",$place);
		
		
		unset($place['place_code']);
		unset($place['place_is_default']);
		unset($place['store_id']);
		unset($place['member_id']);
		unset($place['shipping_type_id']);
		
		$this->db->where("request_place_id",$place_id);
		$this->db->update("store_place",$place);
		
		if($place_id){
			$this->db->where("place_id",$place_id);
			$this->db->delete("store_working_time");
			
			for($i = 0;$i<count($working_time);$i++){
				$work_day = $working_time[$i];
				$work_starttime = (isset($open_time[$i]))?$open_time[$i]:0;
				$work_endtime = (isset($close_time[$i]))?$close_time[$i]:0;
				if(isset($open_all_day[$i])){
					$all_day = ($open_all_day[$i] == 0)?1:0;
				}else{
					$all_day = 0;
				}
				if(isset($open_all_day_stop[$i])){
					$is_holiday = ($open_all_day_stop[$i] == 0)?1:0;
				}else{
					$is_holiday = 0;
				}
				
				$working = array(
					"place_id"=>$place_id,
					"work_day"=>$work_day,
					"work_starttime"=>$work_starttime,
					"work_endtime"=>$work_endtime,
					"open_all_day"=>$all_day,
					"is_holiday"=>$is_holiday
				);
				
				$this->db->insert("store_working_time",$working);
			}
		}
		$this->updatePlaceList();
		redirect("store/shipping","refresh");
	}
	public function cancelPlace($place_id) {
		if(isset($place_id)){
			$this->db->where("place_id",$place_id);
			$this->db->or_where("request_place_id",$place_id);
			//$this->db->set("place_status",4);
			$this->db->delete("store_place");
		}
		$this->updatePlaceList();
		redirect("store/shipping","refresh");
	}
	public function updatePlaceList(){
		$store_id = $this->storemanager->store_id();
		$this->db->select("place_amphur");
		$this->db->from("store_place");
		$this->db->where("store_id",$store_id);
		$query = $this->db->get();
		$result = $query->result();
		$place_list = array();
		$store_place_list = '';
		foreach($result as $row){
			$place_amphur = $row->place_amphur;
			if(isset($place_amphur)){
				array_push($place_list,$place_amphur);
			}
			
		}
		$place_list = array_unique($place_list);
		$store_place_list = implode(",",$place_list);
		$this->db->set("store_place_list",$store_place_list);
		$this->db->where("store_id",$store_id);
		$this->db->update("store");
	}
}