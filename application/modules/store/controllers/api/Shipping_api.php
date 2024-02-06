<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shipping_api extends MX_Controller {
	public function __construct() {
        parent::__construct();
	}
	public function saveShipping(){
		$this->membermanager->checkLogin();
		
		$store_shipping = $this->input->post("store_shipping");
		$store_shipping_charge = $this->input->post("store_shipping_charge");
		
		$store_id = $this->storemanager->store_id();
		$this->db->set("store_shipping",$store_shipping);
		$this->db->set("store_shipping_charge",$store_shipping_charge);
		$this->db->where("store_id",$store_id);
		$query = $this->db->update("store");
		echo json_encode($query);
	}
	public function requestAgentPlace(){
		$this->membermanager->checkLogin();
		$respond = array();
		$respond['success'] = false;
		
		$place_id = $this->input->post("place_id");
		$store_id = $this->storemanager->store_id();
		$query = $this->db->query("SELECT * FROM  store_place WHERE store_id = ".$store_id." AND request_place_id =  ".$place_id);
		if($query->num_rows() <= 0){
			$working = $this->storemanager->working_time($place_id);
			$new_place = $this->model_storemanager->getPlaceByID_as_array($place_id);
			$new_place['shipping_type_id'] = 2; // duplicate เป็น agent
			$new_place['request_place_id'] = $place_id; // ไอดีสถานที่เดิมร้านที่ขอใช้สถานที่
			$new_place['store_id'] = $store_id;
			$new_place['place_status'] = 1;
			unset($new_place['place_id']);
			$query = $this->db->insert("store_place",$new_place);
			$new_place_id = $this->db->insert_id();
			foreach($working as $w){
				$work_id = $w->work_id;
				$work_day = $w->work_day;
				$work_starttime = $w->work_starttime;
				$work_endtime = $w->work_endtime;
				$open_all_day = $w->open_all_day;
				$working = array(
					"place_id"=>$new_place_id,
					"work_day"=>$work_day,
					"work_starttime"=>$work_starttime,
					"work_endtime"=>$work_endtime,
					"open_all_day"=>$open_all_day
				);
				$this->db->insert("store_working_time",$working);
			}
			
			$respond['success'] = true;
		}else{
			$respond['success'] = false;
		}
		echo json_encode($respond);
	}
	public function findAgentPlaceByID(){
		$this->membermanager->checkLogin();
		$place_code = $this->input->post("place_code"); //'P1548815765';//
		$store_id = $this->storemanager->store_id(); //P1555396023
		$status_store = array(2,5); // 2 อนุมัติแล้ว 5 ร้านค้าแนะนำ
		$this->db->select('store_status');
		$this->db->from('store');
		$this->db->where_in('store_status',$status_store);
		$query = $this->db->get();
		$num_store = $query->num_rows();
		if($num_store > 0){
			
			$query = $this->db->query("SELECT * FROM  store_place WHERE place_code =  '".$place_code."' AND store_id != ".$store_id);
			if($query->num_rows()){
				$respond = $query->result();	
				$respond[0]->place_province = $this->storemanager->getProvinceName($respond[0]->place_province);
				$respond[0]->place_amphur = $this->storemanager->getAmphurName($respond[0]->place_amphur);
				$respond[0]->place_district = $this->storemanager->getDistrictName($respond[0]->place_district);
				$respond[0]->google_map = 'https://www.google.com/maps/search/?api=1&query='.$respond[0]->place_lat.','.$respond[0]->place_long;
				$working = $this->storemanager->working_time($respond[0]->place_id);
				$place_working = '<table class="table-responsive table table-bordered">
				  <thead>
					<tr>
					  <th scope="col">วัน</th>
					  <th scope="col">เวลาเปิด</th>
					  <th scope="col">เวลาปิด</th>
					  <th scope="col">เปิด 24 ชั่วโมง</th>
					</tr>
				  </thead>
				  <tbody>';
				  
				foreach($working as $w){
					$work_id = $w->work_id;
					$work_day = $w->work_day;
					$work_starttime = $w->work_starttime;
					$work_endtime = $w->work_endtime;
					$open_all_day = $w->open_all_day;
					$is_holiday = $w->is_holiday;
					
					if($open_all_day == 1){
						$open_all_day = "เปิด 24 ชั่วโมง";
						$work_starttime = "-";
						$work_endtime = "-";	
					}else{
						$open_all_day = "เปิดตามเวลา";
					}
					if($is_holiday){
						$open_all_day = "วันหยุด";
						$work_starttime = "-";
						$work_endtime = "-";	
					}else{
						//$open_all_day = "เปิดตามเวลา";
					}
						
					
				   $place_working .= '<tr>
					  <td>'.$work_day.'</td>
					  <td>'.$work_starttime.'</td>
					  <td>'.$work_endtime.'</td>
					  <td>'.$open_all_day.'</td>
					</tr>';
				   
				   }
					
			   $place_working .= '</tbody></table>';
			   $respond[0]->place_working = $place_working;
			   $respond['success'] = true;
			}else{
				$respond = array();
				$respond['success'] = false;
			}
		}else{
			$respond = array();
			$respond['success'] = false;
		}
		echo json_encode($respond);
	}
		
}
