<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Itemstores_api extends MX_Controller {
	
	public $PAGE;
	public function __construct() {
        parent::__construct();
		$this->load->model('itemstores/model_itemstores');
		$this->utils->checkLogin();
	}

	public function getItemstores()
	{	
		$seller_store_id = -1;
		$itemstores_arr = array();
        $itemstores_arr['data'] = array();

		$itemstores = $this->model_itemstores->getOrderByMemberID($seller_store_id);

	
        if(!empty($itemstores)):
			foreach($itemstores as $row):	
				$tran_id = $row->tran_id;
				$order_code = $row->order_code;
				$request_place_id = $row->request_place_id;
				// $seller_store_id = $row->seller_store_id;
				$depositor_store_id = $row->depositor_store_id;
				$amount = $row->amount;
				$amount_total = $row->amount_total;
				$place_name = "-";
				$places = $this->model_itemstores->getPlaceByID($request_place_id);
				if(count($places)) $place_name = $places[0]->place_name;
				if($amount_total <= 0){
					$is_creditor = "-";
					$btn_text_type = "รายละเอียด";
					$btn_text_class = "btn-success";
				}else{
					$is_creditor = "+";
					$btn_text_type = "รายละเอียด";
					$btn_text_class = "btn-success";
				}

				
				$display_store_id = $depositor_store_id;
					
				$store_in_order = $this->model_itemstores->getStoreByID($display_store_id);
				
				$name = "-";
				$store_name = "";
				foreach($store_in_order as $s){
					$first_name = $s->first_name;
					$last_name = $s->last_name;
					$store_url = $s->store_url;
					$store_avatar = $s->store_avatar;
					$store_name = $s->store_name;
					$store_code = $s->store_code;
					$name = $first_name." ".$last_name;
				}

				$dis_btn = '<button type="button" onClick="loadModalView('.$seller_store_id.','.$depositor_store_id.');" class="btn btn-success text-light btn-block mdi mdi-eye"> รายละเอียด</button>';
				$updat_btn = '<a href="javascript void(0)" class="btn btn-warning btn-block text-white mdi mdi-pencil"> ปรับปรุงรายการทางบัญชี</a>';

				if(strlen($store_name) > 60){
					$store_name = iconv_substr($store_name,0,30,"UTF-8")."...";
				}else{
					$store_name =  iconv_substr($store_name,0,30,"UTF-8");
				}
				$amount_total_lable = '<span class="d-flex justify-content-end">'.number_format($amount_total,2).'</span>';
				$itemstores_arr['data'][] = array(
					$store_name,
					$amount_total_lable,
					$dis_btn,
					// $updat_btn,

				);
			
            endforeach;
        endif;
        $json = json_encode($itemstores_arr);
		echo $json;
	}

	public function getItemstoresInfo()
	{	
		$sum_amount = 0;
		$ref_depositor_store_id = $this->input->post("depositor_store_id");
		$ref_seller_store_id = $this->input->post("seller_store_id");

		$itemstores_info_arr = array();
        $itemstores_info_arr['data'] = array();

		$itemstores_info = $this->model_itemstores->getInfoOrderByMemberID($ref_seller_store_id,$ref_depositor_store_id);
		
        if(!empty($itemstores_info)):
			foreach($itemstores_info as $row):	
				$tran_id = $row->tran_id;
				$tran_type = $row->tran_type;
				$order_code = $row->order_code;
				$request_place_id = $row->request_place_id;
				$seller_store_id = $row->seller_store_id;
				$depositor_store_id = $row->depositor_store_id;
				$amount = $row->amount;
				$amount_total = $row->amount_total;
				$tran_status = $row->tran_status;
				$tran_type = $row->tran_type;
				$timestamp = $row->timestamp;
				

				$sum_amount += $amount;

				$type_name = '-';
				$trans = $this->model_itemstores->getTranType($tran_type);
				if(count($trans)>0)$type_name = $trans[0]->type_name;
				
				$place_name = "-";
				$places = $this->model_itemstores->getPlaceByID($request_place_id);
				if(count($places)) $place_name = $places[0]->place_name;
				if($amount <= 0){
					$is_creditor = "";
					$btn_text_type = "รายละเอียด";
					$btn_text_class = "btn-success";
				}else{
					$is_creditor = "+";
					$btn_text_type = "รายละเอียด";
					$btn_text_class = "btn-success";
				}
				
				$color = "#777";
				$text = " text-secondary ";
				if($tran_status == 0 && $tran_type == 4){
					$color = "#d72c17";
					$text = " text-danger ";
				}else if($tran_status == 1 && $tran_type == 4){
					$color = "#2d82c1";
					$text = " text-info ";
				}
				
				$display_store_id = $depositor_store_id;
					
				$store_in_order = $this->model_itemstores->getStoreByID($display_store_id);
				
				$name = "-";
				$store_name = "";
				foreach($store_in_order as $s){
					$first_name = $s->first_name;
					$last_name = $s->last_name;
					$store_url = $s->store_url;
					$store_avatar = $s->store_avatar;
					$store_name = $s->store_name;
					$store_code = $s->store_code;
					$name = $first_name." ".$last_name;
				}

				if(strlen($store_name) > 60){
					$store_name = iconv_substr($store_name,0,30,"UTF-8")."...";
				}else{
					$store_name =  iconv_substr($store_name,0,30,"UTF-8");
				}

				if($tran_type == 4 && $tran_status == 0 && $amount > 0){
					$btn_confirm = '<a onClick="confirm('.$tran_id.','.$ref_seller_store_id.','.$ref_depositor_store_id.')" class="btn btn-info text-light btn-block"> ยืนยัน</button>';
				}else{
					$btn_confirm ='';
				}
				$amount_lable = '<span class="d-flex justify-content-end '.$text.'">'.$is_creditor.number_format($amount,2).'</span>';
				$type_name_lable = '<span class="'.$text.'">'.$type_name.'</span>';
				
				$itemstores_info_arr['data'][] = array(
					$timestamp,
					$order_code,
					$type_name_lable,
					$amount_lable,
					$btn_confirm,

				);
			
            endforeach;
        endif;
        $itemstores_info_arr['sum_amount'] = $sum_amount;
        $json = json_encode($itemstores_info_arr);
		echo $json;
	}

	public function confirmPayment(){
		
		$tran_id = $this->input->post("tran_id");
		$this->db->select("*");
		$this->db->from("store_transaction");
		$this->db->where("tran_id",$tran_id);
		$query = $this->db->get();
		$result = $query->result();
		foreach($result as $row){
			$seller_store_id = $row->seller_store_id;	
			$depositor_store_id = $row->depositor_store_id;	
		}
		
		$this->db->set("tran_status",1); 
		$this->db->where("tran_id",$tran_id);
		$this->db->update("store_transaction");
		
		$this->db->set("tran_status",1); 
		$this->db->where("tran_id",$tran_id+1);
		$this->db->update("store_transaction");
		
		$this->updateAmountTotal($seller_store_id,$depositor_store_id);

		$success = 1;
		$respond = array('success' => $success);
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

	public function accountpayment(){
		$amount = $this->input->post("amount");
		$seller_store_id = $this->input->post("seller_store_id");
		$depositor_store_id = $this->input->post("depositor_store_id");
		
		// insert สำหรับ seller
		$this->db->set("order_code","-");
		$this->db->set("depositor_store_id",$depositor_store_id);
		$this->db->set("seller_store_id",$seller_store_id);
		$this->db->set("amount",-$amount);
		$this->db->set("tran_type",4); // ประเภทค่าฝากส่ง
		$this->db->set("tran_status",1); 
		$this->db->insert("store_transaction");
		
		
		// insert สำหรับ depositor
		$this->db->set("order_code","-");
		$this->db->set("depositor_store_id",$seller_store_id);
		$this->db->set("seller_store_id",$depositor_store_id);
		$this->db->set("amount",$amount);
		$this->db->set("tran_type",4); // ประเภทค่าฝากส่ง
		$this->db->set("tran_status",1); 
		$this->db->insert("store_transaction");

		$this->updateAmountTotal($seller_store_id,$depositor_store_id);

		$success = 1;
		$respond = array('success' => $success);
					
	}


	
}
