<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Saleitem extends MX_Controller {   

	public $PAGE;
	public function __construct() {
        parent::__construct();
		
		$this->PAGE['title'] = 'รายการขาย | '.$this->load->get_var("default_title");
		$this->membermanager->checkLogin();
		$this->load->model("store/model_delivery");
		$this->load->model("model_saleitem");
		$this->load->model("cart/model_location");
		
		$this->load->helper(array('form', 'url'));
		$config['upload_path'] = 'uploads';
		$config['allowed_types'] = 'svg|gif|jpg|png|doc|doc'; 
		$config['encrypt_name'] = TRUE;
		$this->load->library('upload', $config);
		$this->storemanager->hasStore();
	}
	public function index()
	{
		redirect("store/saleitem/order/all");
	}
	public function order($filter = "all")
	{
		//$this->session->set_flashdata('error_msg', $this->session->flashdata('error_msg'));
		//echo $this->session->flashdata('error_msg');
		$store_id = $this->storemanager->store_id();
		
		$post = $this->input->post();
		
		//print_r($post);
		
		if(count($post) > 0){
			$per_page = 100;
		}else{
			$per_page = 5;	
		}
		
		$page_number = ($this->uri->segment(5) != '')?$this->uri->segment(5):0; 
		
		
		if($filter == "all"){
			$total_rows = $this->model_saleitem->getOrderTotalRows($store_id,0,$post);
		}else if($filter == "buyer"){ // ส่งที่อยู่ผู้ซื้อ
			$total_rows = $this->model_saleitem->getOrderTotalRows($store_id,4,$post);
		}else if($filter == "agent"){ // รับที่เอเย่นต์
			$total_rows = $this->model_saleitem->getOrderTotalRows($store_id,2,$post);
		}else if($filter == "seller"){ // รับที่ผู้ขาย
			$total_rows = $this->model_saleitem->getOrderTotalRows($store_id,1,$post);
		}
		
		
		
		$this->load->library('pagination');
		$config['base_url'] = base_url('store/saleitem/order/'.$filter.'/');
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page;
		
		
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = false;
		$config['last_link'] = false;
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['prev_link'] = '&laquo';
		$config['prev_tag_open'] = '<li class="prev">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '&raquo';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['use_page_numbers'] = TRUE;
		
		$this->pagination->initialize($config);
		
		if($filter == "all"){
			$orders = $this->model_saleitem->getOrderAll($store_id,$page_number,$per_page,$post);
		}else if($filter == "buyer"){ // ส่งที่อยู่ผู้ซื้อ
			$orders = $this->model_saleitem->getOrderBuyer($store_id,$page_number,$per_page,$post);
		}else if($filter == "agent"){ // รับที่เอเย่นต์
			$orders = $this->model_saleitem->getOrderAgent($store_id,$page_number,$per_page,$post);
		}else if($filter == "seller"){ // รับที่ผู้ขาย
			$orders = $this->model_saleitem->getOrderSeller($store_id,$page_number,$per_page,$post);
		}
		
		$this->PAGE['orders'] = $orders;
		
		$pages = ceil($total_rows/$per_page);
		$min_page = ($page_number+1);
		$max_page = count($orders);
		$max_page = $min_page+($max_page-1);
		$this->PAGE['page_showing'] = 'แสดง '.$min_page.' ถึง '.$max_page.' จาก '.$total_rows.' รายการ ( '.$pages.' หน้า )';
		$this->PAGE['pagination'] = $this->pagination->create_links();
		
		$this->PAGE['allstatus'] = $this->model_delivery->getAllOrderStatus();
		
		$this->PAGE['post'] = $post;
		$this->PAGE['filter'] = $filter;
		$this->PAGE['current_store_id'] = $store_id;
		$this->load->view("store/2_".$this->router->fetch_class()."/saleitem_view",$this->PAGE);
	}
	public function approveDepositcost($order_id){ 
		// หลังจากยอมรับค่าฝากส่ง เก็บข้อมูลลง รายการระหว่างร้านค้า และเปลี่ยนสถานะ order เป็น 4 พร้อมส่งที่เอเย่นต์
		$this->membermanager->checkLogin();
		
		
		$orders = $this->model_saleitem->getOrderByOrderID($order_id);
		foreach($orders as $row){
			$order_code = $row->order_code;  
			$store_id = $row->store_id;
			$depositor_cost = $row->depositor_cost;  
			$order_place_id = $row->order_place_id;
		}
		// อัพเดทเป็นยอมรับค่าฝากส่ง
		$this->db->set("depositor_cost_approve",1);
		$this->db->set("order_status",4);
		$this->db->where("order_code",$order_code);
		$this->db->update("order");
		
		
		redirect("store/saleitem");
	}
	
	private function updateAmountTotal($seller_store_id,$depositor_store_id){
		// update seller
		$this->db->select("*");
		$this->db->select_sum("amount");
		$this->db->from("store_transaction");
		$this->db->where("seller_store_id",$seller_store_id);
		$this->db->where("depositor_store_id",$depositor_store_id);
		$this->db->where("tran_status",1);
		$this->db->group_by("depositor_store_id");
		$this->db->order_by("timestamp","DESC");
		$this->db->limit(1);
		$query = $this->db->get();
		$result = $query->result();
		foreach($result as $row){
			$amount = $row->amount;	
		}
		if(count($result) > 0){
		$this->db->set("amount_total",$amount);
		$this->db->where("seller_store_id",$seller_store_id);
		$this->db->where("depositor_store_id",$depositor_store_id);
		$this->db->update("store_transaction");
		}
		// update depositor
		$this->db->select("*");
		$this->db->select_sum("amount");
		$this->db->from("store_transaction");
		$this->db->where("seller_store_id",$depositor_store_id);
		$this->db->where("depositor_store_id",$seller_store_id);
		$this->db->where("tran_status",1);
		$this->db->group_by("depositor_store_id");
		$this->db->order_by("timestamp","DESC");
		$this->db->limit(1);
		$query = $this->db->get();
		$result = $query->result();
		foreach($result as $row){
			$amount = $row->amount;	
		}
		if(count($result) > 0){
		$this->db->set("amount_total",$amount);
		$this->db->where("depositor_store_id",$seller_store_id);
		$this->db->where("seller_store_id",$depositor_store_id);
		$this->db->update("store_transaction");
		}
		
	}
	
	public function delivered($order_id = 0,$order_status = 1){
		$this->membermanager->checkLogin();
		
		$orders = $this->model_saleitem->getOrderByOrderID($order_id);
		foreach($orders as $row){
			$order_shipping_type_id = $row->order_shipping_type_id;  
			$depositor_cost_approve = $row->depositor_cost_approve;
			$current_order_status = $row->order_status;
		}
		
		if($order_status != 3 || $current_order_status != 3 || $current_order_status != 7 || $current_order_status != 8 || $current_order_status != 9 || $current_order_status != 4 || $current_order_status != 10 || $current_order_status != 11){
		
			$this->db->select("order_status");
			$this->db->from("order");
			$this->db->where("order_id",$order_id);
			$query = $this->db->get();
			$result = $query->result();
			$current_order_status = 0;
			if(count($result) > 0)$current_order_status = $result[0]->order_status;
			
			if($current_order_status != 11){ // ถ้ารีวิวแล้วเปลี่ยนสถานะไม่ได้
				$this->db->set("order_status",$order_status);
				$this->db->where("order_id",$order_id);
				$this->db->update("order");
				$this->productmanager->orderStatusHistoryLog($order_id,$order_status);
			}else{
				$this->session->set_flashdata('error_msg', 'รายการสั่งซื้อที่มีรีวิว ไม่สามารถเปลี่ยนสถานะได้');
			}
		}
		
		
		
		// จะเข้าไปอยุ่ในรายการระหว่างร้านค้าก็ต่อเมื่อ สถานะ เป็นนำส่งสำเร็จ
		$orders = $this->model_saleitem->getOrderForTransactionByOrderID($order_id); 
		
		if(count($orders) > 0){
			foreach($orders as $row){
				$order_code = $row->order_code;  
				$store_id = $row->store_id;
				$depositor_cost = $row->depositor_cost;  
				$order_place_id = $row->order_place_id;
				$order_use_coin = $row->order_use_coin;
				$order_success = $row->order_success;
			}
			if(!$order_success){
				
				$request_place_id = "";
				$depositor_store_id = 0;
				
				$place = $this->model_location->getPlaceByID($order_place_id);
				foreach($place as $row){
					$request_place_id = $row->request_place_id;  
				}
				//echo $request_place_id;
				if(!empty($request_place_id)){
					$request_place = $this->model_location->getRequestPlace($request_place_id);
					foreach($request_place as $request){
						$depositor_store_id = $request->store_id; // ร้านที่รับฝากของเป็นลูกหนี้
					}
					$seller_store_id = $store_id; // ร้านเจ้าของสินค้าเป็นเจ้าหนี้
					
					
					$amount = $depositor_cost;
					// insert สำหรับ seller
					$this->db->set("order_code",$order_code);
					$this->db->set("depositor_store_id",$depositor_store_id);
					$this->db->set("seller_store_id",$seller_store_id);
					$this->db->set("amount",$amount);
					$this->db->set("request_place_id",$request_place_id);
					$this->db->insert("store_transaction");
					
					
					// insert สำหรับ depositor
					$this->db->set("order_code",$order_code);
					$this->db->set("depositor_store_id",$seller_store_id);
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
		
		
		redirect("store/saleitem");
	}
	
	public function orderinfo($order_code){
		$this->membermanager->checkLogin();
		if(!isset($order_code)){
			redirect("store/".$this->router->fetch_class());
		}
		$orders = $this->model_saleitem->getOrderGroupByOrderCode($order_code);
		$this->PAGE['orders'] = $orders;
		$this->PAGE['order_code'] = $order_code;
		$this->load->view("store/orderinfo_view",$this->PAGE);
	}
	
}