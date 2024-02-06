<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends MX_Controller {

	public $PAGE;
	public function __construct() { 
        parent::__construct();
		$this->PAGE['title'] = 'ตะกร้าสินค้า | '.$this->load->get_var("default_title");
		$this->load->model("model_cart");
		$this->load->model("cart/model_location");
		$this->load->model("user/model_coin");
	}
	public function index()
	{
		$this->PAGE['store_product_list'] = $this->model_cart->getStoreProductCart();
		date_default_timezone_set("Asia/Bangkok");
		$this->load->view("cart_view",$this->PAGE);	
	}
	public function createlocation(){
		$order = $this->input->post();
		
		
		$store_id = $this->input->post('store_id');
		if(!isset($store_id) || empty($store_id)){
			redirect("home");
			exit();
		}
		$this->session->set_userdata("order",$order);
		
		$seller_store = $this->model_location->getStoreByID($store_id);
		$store_is_vat = 0;
		foreach($seller_store as $row){
			$store_is_vat = $row->store_is_vat;	
		}
		if(!isset($store_id)){
			redirect("home");
		}
		if(!$this->membermanager->isLoggedIn()){
			$this->session->set_flashdata('error_msg','การดำเนินการในขั้นตอนต่อไป จำเป็นจะต้องเข้าสู่ระบบ');
			redirect("member/login");
		}
		
		$shipping = $this->model_location->getStoreShipping($store_id);
		
		$storeplace = $this->model_location->getStorePlace($store_id);
		$agentplace = $this->model_location->getAgentPlace($store_id);
		$usereplace = $this->model_location->getUserPlace($this->membermanager->member_id());
		$coin = $this->model_coin->getCoinByMemberID($this->membermanager->member_id());
		
		if(!isset($order['product_checked'])){
			$this->session->set_flashdata('error_msg','ไม่มีสินค้าในตะกร้าที่เลือก');
			redirect("cart");
		}
		
		$product_checked_list = $order['product_checked'];
		
		$product_id_list = $order['product_id'];
		$product_price_discount_list = $order['product_price_discount'];
		$product_price_payment = $order['product_price_payment'];
		$product_price_balance = $order['product_price_balance'];
		$product_qty_list = $order['product_qty'];
		$total_price = 0;
		
		for($i = 0;$i<count($product_id_list);$i++){ 
			
			$product_checked = (isset($product_checked_list[$i]))?$product_checked_list[$i]:0;
			$product_id = $product_id_list[$i];
			$product_price_discount = $product_price_discount_list[$i];
			$product_qty = $product_qty_list[$i];
			$num_product_in_store = $this->model_location->checkProductStore($store_id,$product_id);
			if($num_product_in_store>0){
				if($product_checked == $product_id){
					$total_price += $product_price_discount*$product_qty;
				}
			}
		}
		
		
		$this->PAGE['shipping'] = explode(",",$shipping);
		$this->PAGE['coin'] = $coin;
		$this->PAGE['current_store_id'] = $store_id;
		
		$this->PAGE['product_price_payment'] = $product_price_payment;
		$this->PAGE['product_price_balance'] = $product_price_balance;
		
		$this->PAGE['total_price'] = $total_price;
		$this->PAGE['storeplace'] = $storeplace;
		$this->PAGE['agentplace'] = $agentplace;
		$this->PAGE['usereplace'] = $usereplace;
		$this->PAGE['store_is_vat'] = $store_is_vat;
		$this->load->view("location_view",$this->PAGE);	
	}
	public function createorder(){
		if(!$this->membermanager->isLoggedIn()){
			$this->session->set_flashdata('error_title','สั่งซื้อไม่สำเร็จ');
			$this->session->set_flashdata('error_msg','การดำเนินการในขั้นตอนต่อไป จำเป็นจะต้องเข้าสู่ระบบ');
			redirect("member/login");
		}
		$order = $this->session->userdata("order");
		$order_code = $this->utils->getOrderCode();
		$coupon_id = $this->createCoupon();
		$store_id = $order['store_id'];
		
		$order_place_id = $this->input->post('order_place_id');
		$order_place_is_hidden = $this->input->post('order_place_is_hidden');
		
		if(!isset($order_place_id) || $order_place_id == 0){
			$this->session->set_flashdata('error_msg','กรุณาเลือกช่องทางการรับสินค้า และระบุสถานที่รับสินค้า');
			redirect("cart");
		}
		$member_id = $this->membermanager->member_id();
		$product_checked_list = $order['product_checked'];
		$cart_id_list = $order['cart_id'];
		$product_id_list = $order['product_id'];
		$product_price_discount_list = $order['product_price_discount'];
		$product_price_payment = $order['product_price_payment'];
		$product_price_balance = $order['product_price_balance'];
		
		$product_qty_list = $order['product_qty'];
		$product_name_list = $order['product_name'];
		
		$order_shipping_type_id = $this->input->post('order_shipping_type_id');
		$order_store_shipping_charge = $this->input->post('order_store_shipping_charge');
		$order_buyer_place_is_hidden = $this->input->post('order_buyer_place_is_hidden');
		$order_name = $this->input->post('order_name');
		$order_tax = $this->input->post('order_tax');
		$order_branch = $this->input->post('order_branch');
		$order_address = $this->input->post('order_address');
		$order_use_coin_type = $this->input->post('order_use_coin_type');
		$order_use_coin = $this->input->post('order_use_coin');
		
		
		
		
		
		if(!isset($order_use_coin_type))$order_use_coin_type = 1;
		if(!isset($order_use_coin))$order_use_coin = 0;
		
		$request_place_id = "";
		$depositor_store_id = 0;
		$place = $this->model_location->getPlaceByID($order_place_id);
		
		
		
		for($i = 0;$i<count($product_id_list);$i++){  
			$product_checked = (isset($product_checked_list[$i]))?$product_checked_list[$i]:0;
			$product_id = $product_id_list[$i];
			if($product_checked == $product_id){
				$has_qty_change = $this->model_stockmanager->ckStock($product_id);
			}
		}
		
		// จำนวนสินค้ามีการเปลี่ยนแปลงตอนเริ่มสั่งซื้อ
		if($has_qty_change > 0){
			$this->session->set_flashdata('error_title','สั่งซื้อไม่สำเร็จ');
			$this->session->set_flashdata('error_msg','มีการเปลี่ยนแปลงบางอย่างในสินค้าที่ท่านกำลังสั่งซื้อ กรุณาตรวจสอบ');
			redirect("cart");
			exit();
		}
		
		
		// กรณีที่มีการฝากส่งของ
		foreach($place as $row){
			$request_place_id = $row->request_place_id;  
		}
		
		// สำหรับบริษัท มีเมจเสจ
		$amount_alreay_pay = ($product_price_payment+$order_store_shipping_charge)+$order_use_coin;
		
		$seller_store_id = $store_id; // ร้านเจ้าของสินค้าเป็นเจ้าหนี้
		/*if(!empty($request_place_id) && $order_shipping_type_id == 2){
			$request_place = $this->model_location->getRequestPlace($request_place_id);
			foreach($request_place as $request){
				$depositor_store_id = $request->store_id; // ร้านที่รับฝากของเป็นลูกหนี้
			}
			
			
			
			
			$amount = $product_price_balance;
			
			if($amount_alreay_pay == $amount){
			
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
				
				$this->updateAmountTotal($seller_store_id,$depositor_store_id);
			
			}
			
			
			
			
		}*/
		
		
		
		
		if($amount_alreay_pay > 0){
			$me_message_id = -1;
			// insert สำหรับ seller
			$this->db->set("order_code",$order_code);
			$this->db->set("depositor_store_id",$me_message_id);
			$this->db->set("seller_store_id",$seller_store_id);
			$this->db->set("amount",$amount_alreay_pay);
			$this->db->set("request_place_id",$order_place_id);
			$this->db->set("tran_type",1);
			$this->db->insert("store_transaction");
			
			
			// insert สำหรับ depositor
			$this->db->set("order_code",$order_code);
			$this->db->set("depositor_store_id",$seller_store_id);
			$this->db->set("seller_store_id",$me_message_id);
			$this->db->set("amount",-$amount_alreay_pay);
			$this->db->set("request_place_id",$order_place_id);
			$this->db->set("tran_type",1);
			$this->db->insert("store_transaction");
			
			$this->updateAmountTotal($seller_store_id,$me_message_id); 
		}
				
		
		
		
		for($i = 0;$i<count($product_id_list);$i++){  
			$product_checked = (isset($product_checked_list[$i]))?$product_checked_list[$i]:0;
			$cart_id = $cart_id_list[$i];
			
			$product_id = $product_id_list[$i];
			
			
			$product_price_discount = $product_price_discount_list[$i];
			$product_qty = $product_qty_list[$i];
			$product_name = $product_name_list[$i];
			$num_product_in_store = $this->model_location->checkProductStore($store_id,$product_id);
			if($num_product_in_store>0){
				if($product_checked == $product_id){
					
					$gateway_type_id = 1;
					$this->db->select("gateway_type_id");
					$this->db->from("product");
					$this->db->where("product_id",$product_id);
					$query = $this->db->get();
					$result = $query->result();
					if(count($result)>0){
						$gateway_type_id = $result[0]->gateway_type_id;
					}
					
					$this->db->set("product_id",$product_id);
					$this->db->set("gateway_type_id",$gateway_type_id);
					$this->db->set("cart_id",$cart_id);
					$this->db->set("product_price_discount",$product_price_discount);
					$this->db->set("product_price_payment",$product_price_payment);
					$this->db->set("product_price_balance",$product_price_balance);
					
					$this->db->set("product_qty",$product_qty);
					$this->db->set("product_name",$product_name);
					$this->db->set("order_code",$order_code);
					$this->db->set("coupon_id",$coupon_id);
					$this->db->set("order_member_id",$member_id);
					$this->db->set("order_place_id",$order_place_id);
					$this->db->set("store_id",$store_id);
					
					$this->db->set("depositor_store_id",$depositor_store_id);
					
					$this->db->set("order_shipping_type_id",$order_shipping_type_id);
					$this->db->set("order_store_shipping_charge",$order_store_shipping_charge);
					$this->db->set("order_buyer_place_is_hidden",$order_buyer_place_is_hidden);
					$this->db->set("order_name",$order_name);
					$this->db->set("order_tax",$order_tax);
					$this->db->set("order_branch",$order_branch);
					$this->db->set("order_address",$order_address);
					$this->db->set("order_use_coin_type",$order_use_coin_type);
					$this->db->set("order_use_coin",$order_use_coin);
					//if($order_shipping_type_id == 3 || $order_shipping_type_id == 4){
						$this->db->set("order_status",1); // เปลี่ยนเป็น กำลังดำเนินการ
					//}
					$this->db->insert("order");
					
					$this->db->set("cart_status",2); // เปลี่ยนสินค้าทั้งหมดที่สั่งซื้อเป็น กำลังสั่งซื้อ
					$this->db->where("product_id",$product_id);
					$this->db->where("store_id",$store_id);
					$this->db->where("member_id",$member_id);
					$this->db->update("cart");
					
					$this->db->set('product_qty','product_qty - '.(int) $product_qty, FALSE);// ปรับจำนวนสินค้าในคลัง
					$this->db->where("product_id",$product_id);
					$this->db->update("product");
				}
			}
		}
		
		if(isset($order_use_coin) && $order_use_coin >0){
			$this->db->set('coin','coin - '.(int) $order_use_coin, FALSE);// ปรับจำนวนเหรียญที่ใช้ไปของสมาชิก
			$this->db->where("member_id",$member_id);
			$this->db->update("member");
		}
		redirect("user");
		/*foreach($order as $key => $value){
			if(is_array($value)){
				foreach($value as $k=>$v){
					echo $key."<br>";
					echo "-------- ".$k." = ".$v."<br>";	
				}
			}else{
				echo $key." = ".$value."<br>";
			}
		}*/
		//$this->load->view("payment_view",$this->PAGE);	
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
	public function createCoupon(){
		
		$coupon_code = $this->utils->getCouponCode();	
		$coupon_add_date = date("Y-m-d H:i:s");
		$coupon_expire_date = date("Y-m-d H:i:s",strtotime("+30 days"));
		 
		$this->db->set("coupon_code",$coupon_code);
		$this->db->set("coupon_add_date",$coupon_add_date);
		$this->db->set("coupon_expire_date",$coupon_expire_date);
		$this->db->set("coupon_use_date",$coupon_add_date);
		$this->db->insert("order_coupon");
		$coupon_id = $this->db->insert_id();
		return $coupon_id;
	}
}