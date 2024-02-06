<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_api extends MX_Controller {
	
	public $PAGE;
	public function __construct() {
        parent::__construct();
		$this->load->model('order/model_order');
		$this->load->library('order/order_libs');
		$this->utils->checkLogin();
	}

	public function getOrder()
	{
		$order_status_id = $this->input->post("order_status_id");

		$order_arr = array();
        $order_arr['data'] = array();
		$order = $this->model_order->getOrder($order_status_id);
        if(!empty($order)):
			foreach($order as $row):

				$order_id		= $row->order_id;
				$order_code		= $row->order_code;
				$store_id		= $row->store_id;
				$order_tax		= $row->order_tax;
				$order_buyer_place_is_hidden = $row->order_buyer_place_is_hidden;
				$member_id		= $row->order_member_id;
				$order_status	= $row->order_status;
				$product_qty	= $row->product_qty;
				$timestamp		= $row->timestamp;
				
				$member_result = $this->model_order->getMemberByID($member_id);
				if(count($member_result)>0){
					$first_name = $member_result[0]->first_name;
					$last_name = $member_result[0]->last_name;
					$member_name = "คุณ ".$first_name." ".$last_name;
				}else{
					$member_name = "";
					$first_name = "";
					$last_name = "";
				}

				$store_result = $this->model_order->getStoreByID($store_id);
				if(count($store_result)>0){
					$store_name = $store_result[0]->store_name;
				}else{
					$store_name = "";
				}

				if(strlen($store_name) > 60){
					$store_name = iconv_substr($store_name,0,30,"UTF-8")."...";
				}else{
					$store_name =  iconv_substr($store_name,0,30,"UTF-8");
				}
		
				$order_status_result = $this->model_order->getOrderStatusByID($order_status);
				if(count($order_status_result)>0){
					$status_name = $order_status_result[0]->status_name;

					if($order_status == 1){
						$status_name = '<span class="label label-warning w-100 text-center">'.$status_name.'</span>';
					}else if($order_status == 2){
						$status_name = '<span class="label label-info w-100 text-center">'.$status_name.'</span>';
					}else if($order_status == 3){
						$status_name = '<span class="label label-success w-100 text-center">'.$status_name.'</span>';
					}else{
						$status_name = '<span class="label label-danger w-100 text-center">'.$status_name.'</span>';
					}

				}else{
					$status_name = "";
				}


				$product_qty_result = $this->model_order->getOrderQtyCount($order_code);
				if(count($product_qty_result)>0){
					$product_qty_count = $product_qty_result[0]->product_qty_count;
				}else{
					$product_qty_count = "";
				}

				$url_order_id = base_url("order/orderDescription/".$order_code);
				$link_order_id = '<a target="_blank" href="'.$url_order_id.'">'.$order_code.'</a>';

				$url_store_id = base_url("store/storeDescription/".$store_id);
				$link_store_id = '<a target="_blank" href="'.$url_store_id.'" class="text-secondary">'.$store_name.'</a>';
				
				$btn_view = '<button type="button" onClick="myModalView('.$order_id.');" class="btn btn-info text-light btn-block mdi mdi-eye"> ดูประวัติเปลี่ยนสถานะ</button>';
				if($order_buyer_place_is_hidden == 1){
					$tax_lable = '<span class="badge badge-success  w-100 text-center text-white">ขอใบเสร็จรับเงิน</span>';
				}else{
					$tax_lable = '<span class="badge badge-warning  w-100 text-center text-white">ไม่ขอใบเสร็จรับเงิน</span>';
				}
				
				if(strlen($first_name) > 60){
					$first_name = iconv_substr($first_name,0,30,"UTF-8")."...";
				}else{
					$first_name =  iconv_substr($first_name,0,30,"UTF-8");
				}

				$thaidate = $this->order_libs->getThaiDate($timestamp);

				$order_arr['data'][] = array(
					$timestamp,
					$link_order_id,
					$first_name,
					$link_store_id,
					$product_qty_count,
					// $tax_lable,
					$status_name,
					$btn_view,
					
					
				);
               
            endforeach;
        endif;
        $json = json_encode($order_arr);
		echo $json;
	}
	public function getViewHistory()
	{
		//$order_id = 108;//$this->input->post("order_id");
		$order_id = $this->input->post("order_id");
		$history_arr = array();
        $history_arr['data'] = array();
		$history = $this->model_order->getOrderHistory($order_id);
        if(!empty($history)):
			foreach($history as $row):

				$order_status	= $row->order_status;
				$timestamp		= $row->timestamp;

				$order_status_result = $this->model_order->getOrderStatusByID($order_status);
				if(count($order_status_result)>0){
					$status_name = $order_status_result[0]->status_name;

					if($order_status == 1){
						$status_name = '<span class="label label-warning w-100 text-center">'.$status_name.'</span>';
					}else if($order_status == 2){
						$status_name = '<span class="label label-info w-100 text-center">'.$status_name.'</span>';
					}else if($order_status == 3){
						$status_name = '<span class="label label-success w-100 text-center">'.$status_name.'</span>';
					}else{
						$status_name = '<span class="label label-danger w-100 text-center">'.$status_name.'</span>';
					}

				}else{
					$status_name = "";
				}

				$history_arr['data'][] = array(
					
					$timestamp,
					$status_name,
				);
               
            endforeach;
        endif;
        $json = json_encode($history_arr);
		echo $json;
	}
	


	
}
