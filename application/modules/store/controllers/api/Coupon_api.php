<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coupon_api extends MX_Controller {
	public function __construct() {
        parent::__construct();
		
		$this->load->model("cart/model_location");
		$this->load->model("store/model_saleitem");
		$this->load->model("model_delivery");
		$this->load->model("user/model_user");
		
	}
	public function verifyCoupon(){
		$this->membermanager->checkLogin();
		$coupon_code = $this->input->post("coupon_code");
		$respond = array();
		$respond['success'] = false;
		
		$store_id = $this->storemanager->store_id();
		
		$this->db->select("*");
		$this->db->from("order_coupon");
		$this->db->where("coupon_code",$coupon_code);
		$query = $this->db->get();
		$result = $query->result();
		
		if(count($result) <= 0){
			$respond['success'] = false;
			echo json_encode($respond);
			exit();
		}
		foreach($result as $row){
			$coupon_id = $row->coupon_id;
			$coupon_status = $row->coupon_status;
		}
		
		$query2 = $this->db->query("SELECT * FROM  order WHERE coupon_id = ".$coupon_id." AND ( store_id = ".$store_id." OR depositor_store_id = ".$store_id.")");
		$orders = $query2->result();
		
		
	//1567060022-2536369067

	
                                        
                                        
		if(count($orders) > 0){
			$respond['order_code'] = $orders[0]->order_code;
			$respond['url'] = base_url("store/coupon/orderinfo/".$orders[0]->order_code);
			$respond['success'] = true;
		}
		echo json_encode($respond);
	}
	public function useCoupon(){
		$this->membermanager->checkLogin();
		$coupon_code = $this->input->post("coupon_code");
		//$coupon_code = "6632593755-1550384720";
		$respond = array();
		$respond['success'] = false;
		
		
		
		
		$this->db->select("*");
		$this->db->from("order_coupon");
		$this->db->where("coupon_code",$coupon_code);
		$query = $this->db->get();
		$result = $query->result();
		foreach($result as $row){
			$coupon_id = $row->coupon_id;
			$coupon_status = $row->coupon_status;
			
			$this->db->select("order_status");
			$this->db->from("order");
			$this->db->where("coupon_id",$coupon_id);
			$query2 = $this->db->get();
			$result2 = $query2->result();
			foreach($result2 as $row2){
				$order_status = $row2->order_status;	
			}
			if($order_status == 2 || $order_status == 7 || $order_status == 8 || $order_status == 9 || $order_status == 10 || $order_status == 11){
				echo json_encode($respond);
				exit();
			}
			$this->db->set("order_status",3); // เปลี่ยนสถานะของ order นำส่งสำเร็จ
			$this->db->where("coupon_id",$coupon_id);
			$this->db->update("order");
		}
		$num_rows_coupon = $query->num_rows();
		if($num_rows_coupon && $coupon_status == 1){
			$this->db->set("coupon_status",2);
			$this->db->set("coupon_use_date",date("Y-m-d H:i:s"));
			$this->db->where("coupon_code",$coupon_code);
			$this->db->update("order_coupon");
			$respond['success'] = true;
		}
		
		if(!isset($coupon_id)){
			$respond['success'] = false;
			echo json_encode($respond);
			exit();
		}
		// จะเข้าไปอยุ่ในรายการระหว่างร้านค้าก็ต่อเมื่อ สถานะ เป็นนำส่งสำเร็จ
		$orders = $this->model_saleitem->getOrderForTransactionByCouponID($coupon_id); 
		
		if(count($orders) > 0){
			foreach($orders as $row){
				$order_id = $row->order_id;
				$order_code = $row->order_code;  
				$store_id = $row->store_id;
				$depositor_cost = $row->depositor_cost;  
				$order_place_id = $row->order_place_id;
				$order_success = $row->order_success;
				$order_shipping_type_id = $row->order_shipping_type_id;
				$product_price_balance = $row->product_price_balance;
			}
			
			if(!$order_success){
				
				//echo 'order_place_id : '.$order_place_id.'<br>';
				$request_place_id = "";
				$depositor_store_id = 0;
				
				$place = $this->model_location->getPlaceByID($order_place_id);
				foreach($place as $row){
					$request_place_id = $row->request_place_id;  
				}
				//echo $request_place_id.'<br>';
				if(!empty($request_place_id) && $order_shipping_type_id == 2){
					$request_place = $this->model_location->getRequestPlace($request_place_id);
					foreach($request_place as $request){
						$depositor_store_id = $request->store_id; // ร้านที่รับฝากของเป็นลูกหนี้
					}
					$seller_store_id = $store_id; // ร้านเจ้าของสินค้าเป็นเจ้าหนี้
					
					
					
					// รายการระหว่างร้านค้า ค่าฝากส่ง
					$amount = $depositor_cost;
					// insert สำหรับ seller
					$this->db->set("order_code",$order_code);
					$this->db->set("depositor_store_id",$depositor_store_id);
					$this->db->set("tran_type",2); // ประเภทค่าฝากส่ง
					$this->db->set("seller_store_id",$seller_store_id);
					$this->db->set("amount",-$amount);
					$this->db->set("request_place_id",$request_place_id);
					$this->db->insert("store_transaction");
					
					
					// insert สำหรับ depositor
					$this->db->set("order_code",$order_code);
					$this->db->set("depositor_store_id",$seller_store_id);
					$this->db->set("tran_type",2); // ประเภทค่าฝากส่ง
					$this->db->set("seller_store_id",$depositor_store_id);
					$this->db->set("amount",$amount);
					$this->db->set("request_place_id",$request_place_id);
					$this->db->insert("store_transaction");
					
					
					// รายการระหว่างร้านค้า ค่าขายเก็บเงินปลายทาง
					$amount = $product_price_balance;
					// insert สำหรับ seller
					$this->db->set("order_code",$order_code);
					$this->db->set("depositor_store_id",$depositor_store_id);
					$this->db->set("tran_type",1); // ประเภทค่าฝากส่ง
					$this->db->set("seller_store_id",$seller_store_id);
					$this->db->set("amount",$amount);
					$this->db->set("request_place_id",$request_place_id);
					$this->db->insert("store_transaction");
					
					
					// insert สำหรับ depositor
					$this->db->set("order_code",$order_code);
					$this->db->set("depositor_store_id",$seller_store_id);
					$this->db->set("tran_type",1); // ประเภทค่าฝากส่ง
					$this->db->set("seller_store_id",$depositor_store_id);
					$this->db->set("amount",-$amount);
					$this->db->set("request_place_id",$request_place_id);
					$this->db->insert("store_transaction");
					
					$this->db->set("order_success",1);
					$this->db->where("order_id",$order_id);
					$this->db->update("order");
				
					$this->updateAmountTotal($seller_store_id,$depositor_store_id);
				}
			}
		}
		// สิ้นสุดรายการระหว่างร้านค้า
		
		
		echo json_encode($respond);
	}
	
	private function updateAmountTotal($seller_store_id,$depositor_store_id){
		// update seller
		$this->db->select("*");
		$this->db->select_sum("amount");
		$this->db->from("store_transaction");
		$this->db->where("seller_store_id",$seller_store_id);
		$this->db->where("depositor_store_id",$depositor_store_id);
		$this->db->group_by("depositor_store_id");
		$this->db->order_by("timestamp","DESC");
		$this->db->limit(1);
		$query = $this->db->get();
		$result = $query->result();
		foreach($result as $row){
			$amount = $row->amount;	
		}
		$this->db->set("amount_total",$amount);
		$this->db->where("seller_store_id",$seller_store_id);
		$this->db->where("depositor_store_id",$depositor_store_id);
		$this->db->update("store_transaction");
		
		// update depositor
		$this->db->select("*");
		$this->db->select_sum("amount");
		$this->db->from("store_transaction");
		$this->db->where("seller_store_id",$depositor_store_id);
		$this->db->where("depositor_store_id",$seller_store_id);
		$this->db->group_by("depositor_store_id");
		$this->db->order_by("timestamp","DESC");
		$this->db->limit(1);
		$query = $this->db->get();
		$result = $query->result();
		foreach($result as $row){
			$amount = $row->amount;	
		}
		$this->db->set("amount_total",$amount);
		$this->db->where("depositor_store_id",$seller_store_id);
		$this->db->where("seller_store_id",$depositor_store_id);
		$this->db->update("store_transaction");
		
	}
	
}
