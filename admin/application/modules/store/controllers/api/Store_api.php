<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Store_api extends MX_Controller {
	
	public $PAGE;
	public function __construct() {
        parent::__construct();
		$this->load->model('store/model_store');
		$this->utils->checkLogin();
	}

	public function getStore()
	{
		$store_status_id = $this->input->post("store_status_id");
		$store_arr = array();
        $store_arr['data'] = array();
		$store = $this->model_store->getStore($store_status_id);
        if(!empty($store)):
			foreach($store as $row):	
				$store_id = $row->store_id;
				$store_code = $row->store_code;
				$store_name = $row->store_name;
				$store_avatar = $row->store_avatar;
				$store_description = $row->store_description;
				$first_name = $row->first_name;
				$last_name = $row->last_name;
				$tel = $row->tel;
				$address = $row->address;
				$bank_name = $row->bank_name;
				$store_status = $row->store_status;
				$store_view = $row->store_view;
				$product_id = 0;
				$review_type = 0;
				$store_popular = $row->store_popular;

				if(strlen($store_name) > 60){
					$store_name = iconv_substr($store_name,0,30,"UTF-8")."...";
				}else{
					$store_name =  iconv_substr($store_name,0,30,"UTF-8");
				}

				$title = "คุณ";
				if($first_name == "" || $last_name == ""){
					$title = " -";
				}
				
				$store_status_result = $this->model_store->getStoreStatus($store_status);
				$sum_product_qty_result = $this->model_store->getQtyProductByID($store_id);
				$count_all_order_result = $this->model_store->getCountAllOrderByID($store_id);
				$count_order_result = $this->model_store->getCountOrderByID($store_id);


				if(count($count_all_order_result)>0){
					$count_allorder_status = $count_all_order_result[0]->count_allorder_status;
					$count_allorder_status_val = $count_all_order_result[0]->count_allorder_status;
					if($count_allorder_status <= 0){
						$count_allorder_status = 1;
					}else{
						$count_allorder_status = $count_allorder_status;
					}
				}else{
					$count_allorder_status = 1;
				}
				if(count($count_order_result)>0){
					$count_order_status = $count_order_result[0]->count_order_status;
					if($count_order_status <= 0){
						$count_order_status = 1;
					}else{
						$count_order_status = $count_order_status;
					}
				}else{
					$count_order_status = 1;
				}

				$order_success = ($count_order_status / $count_allorder_status)* 100;
				// $order_persen = $order_success * 100;

				if($count_allorder_status_val <= 0){
					$order_persen = '<span class="badge badge-danger w-100 text-center text-white">ยังไม่มีการขาย</span>';
				}else{
					$order_persen = '<div class="progress m-t-20"><div class="progress-bar bg-warning active progress-bar-striped" style="width: '.$order_success.'%; height:15px;" role="progressbar">'.number_format($order_success).'%</div></div>';
				}
				


				if(count($store_status_result)>0){
					$status_name = $store_status_result[0]->status_name;
				}
				
				if(count($sum_product_qty_result)>0){
					$sum_product_qty = $sum_product_qty_result[0]->sum_product_qty;
					if(!empty($sum_product_qty)){
						$sum_product_qty = $sum_product_qty;
					}else{
						$sum_product_qty = 0;
					}
				}else{
					$sum_product_qty = 0;
				}
				$sum_product_qty_css = '<span class="d-flex justify-content-end">'.number_format($sum_product_qty).'</span>';

				$sum_product_price_result = $this->model_store->getSalesByID($store_id);
				if(count($sum_product_price_result)>0){
					$sum_product_qty = $sum_product_price_result[0]->sum_product_qty;
					$sum_price_discount = $sum_product_price_result[0]->sum_price_discount;
					$sum_price_all = $sum_price_discount * $sum_product_qty;
				}else{
					$sum_price_all = 0;
				}
				$sum_price_all_css = '<span class="d-flex justify-content-end">'.number_format($sum_price_all,2).'</span>';

				$verify_url = base_url("store/verify/".$store_id);
				$edit_verify_url = base_url("store/editVerify/".$store_id);
				$canceled_url = base_url("store/canceled/".$store_id);
				$not_allowed_url = base_url("store/not_allowed/".$store_id);

				if($store_status == 1){
					$status_name = '<span class="badge badge-primary w-100 text-center ">'.$status_name.'</span>';
					$btn_confirm = "<a href='".$verify_url."' class='btn btn-info btn-block'>อนุมัติ</a>";
					$btn_notconfirm = "<a href='".$not_allowed_url."' class='btn btn-danger btn-block'>ไม่อนุมัติ</a>";
				}else if($store_status == 2){
					$status_name = '<span class="badge badge-success w-100 text-center ">'.$status_name.'</span>';
					$btn_confirm = "<a href='".$canceled_url."' class='btn btn-warning btn-block'>ยกเลิกการอนุมัติ</a>";
					$btn_notconfirm = "";
				}else if($store_status == 3){
					$status_name = '<span class="badge badge-danger w-100 text-center ">'.$status_name.'</span>';
					$btn_confirm = "<a href='".$canceled_url."' class='btn btn-danger btn-block'>ยกเลิกการไม่อนุมัติ</a>";
					$btn_notconfirm = "";
				}else if($store_status == 4){
					$status_name = '<span class="badge badge-warning w-100 text-center ">'.$status_name.'</span>';
					$btn_confirm = "";
					$btn_notconfirm = "";
				}else if($store_status == 5){
					$status_name = '<span class="badge badge-warning w-100 text-center text-white">'.$status_name.'</span>';
					$btn_confirm = "<a href='".$canceled_url."' class='btn btn-warning btn-block'>ยกเลิกการอนุมัติ</a>";
					$btn_notconfirm = "";
				}else if($store_status == 6){
					$status_name = '<span class="badge badge-warning w-100 text-center text-white">'.$status_name.'</span>';
					$btn_confirm = "<a href='".$edit_verify_url."' class='btn btn-info btn-block'>อนุมัติ</a>";
					$btn_notconfirm = "<a href='".$not_allowed_url."' class='btn btn-danger btn-block'>ไม่อนุมัติ</a>";
				}else{
					$status_name = '<span class="badge badge-warning w-100 text-center text-white">ไม่ระบุ</span>';
					$btn_confirm = "";
					$btn_notconfirm = "";
				}

				$url_store = base_url("review/".$review_type."/".$store_id);
				$link_store_btn = '<a  href="'.$url_store.'" class="btn btn-success btn-block text-white">รีวิว</a>';

				$checkbox = '<input type="checkbox" id="category_'.$store_id.'" value="'.$store_id.'" class="filled-in chk-col-light-green add_recom_store"><label for="category_'.$store_id.'" class="chk-mps"></label>';

				$input_popular = '<input type="text" name="store_popular[]" pattern="[0,1,2,3,4,5,6,7,8,9]" value="'.$store_popular.'" class="form-control text-center">';
				$store_id_input = '<input type="hidden" name="store_id[]" value="'.$store_id.'">';

				$url = base_url("store/storeDescription/".$store_id);
				$link = '<a class="text-secondary" target="_blank" href="'.$url.'">'.$store_name.'</a>';
				$link_code = '<a target="_blank" href="'.$url.'">'.$store_code.'</a>';
				$store_arr['data'][] = array(
					// $checkbox,
					$link_code,
					$link,
					$sum_product_qty_css,
					// $title.' '.$first_name.' '.$last_name,
					$sum_price_all_css,
					$store_view,
					$order_persen,
					// $tel,
					$status_name,
					// $link_store_btn,
					// $btn_confirm,
					// $btn_notconfirm,
					$input_popular.$store_id_input,
				);
			
            endforeach;
        endif;
        $json = json_encode($store_arr);
		echo $json;
	}

	public function getRecomStore()
	{	
		$category_id = $this->input->post("category_id");
		$store_arr = array();
        $store_arr['data'] = array();
		$store_recom = $this->model_store->getStoreRecom($category_id);
	
        if(!empty($store_recom)):
			foreach($store_recom as $row):	
				$store_id = $row->store_id;
				$store_code = $row->store_code;
				$store_name = $row->store_name;
				$store_avatar = $row->store_avatar;
				$store_description = $row->store_description;
				$first_name = $row->first_name;
				$last_name = $row->last_name;
				$tel = $row->tel;
				$address = $row->address;
				$store_category = $row->store_category;
				$bank_name = $row->bank_name;
				$store_status = $row->store_status;
				$timestamp = $row->timestamp;
				$product_id = 0;
				$review_type = 0;

				if(strlen($store_name) > 60){
					$store_name = iconv_substr($store_name,0,30,"UTF-8")."...";
				}else{
					$store_name =  iconv_substr($store_name,0,30,"UTF-8");
				}

				$title = "คุณ";
				if($first_name == "" || $last_name == ""){
					$title = " -";
				}
				
				$store_status_result = $this->model_store->getStoreStatus($store_status);
				$sum_product_qty_result = $this->model_store->getQtyProductByID($store_id);
				$category_result = $this->model_store->getStoreCatRecom($store_category);

				if(count($store_status_result)>0){
					$status_name = $store_status_result[0]->status_name;
				}
				if(count($category_result)>0){
					$category_name = $category_result[0]->category_name;
				}
				if(count($sum_product_qty_result)>0){
					$sum_product_qty = $sum_product_qty_result[0]->sum_product_qty;
					if(!empty($sum_product_qty)){
						$sum_product_qty = $sum_product_qty;
					}else{
						$sum_product_qty = 0;
					}
				}else{
					$sum_product_qty = 0;
				}

				$sum_product_qty_css = '<span class="d-flex justify-content-end">'.number_format($sum_product_qty).'</span>';

				if($store_status == 5){
					$checked = 'checked';
				}else{
					$checked = '';
				}

				if($store_status == 1){
					$status_name = '<span class="badge badge-primary w-100 text-center ">'.$status_name.'</span>';
				}else if($store_status == 2){
					$status_name = '<span class="badge badge-success w-100 text-center ">'.$status_name.'</span>';
				}else if($store_status == 3){
					$status_name = '<span class="badge badge-danger w-100 text-center ">'.$status_name.'</span>';
				}else if($store_status == 4){
					$status_name = '<span class="badge badge-warning w-100 text-center ">'.$status_name.'</span>';
				}else{
					$status_name = '<span class="badge badge-warning w-100 text-center text-white">'.$status_name.'</span>';
				}

				$checkbox = '<input type="checkbox" id="category_'.$store_id.'" value="'.$store_id.'" class="filled-in chk-col-light-green add_recom_store" '.$checked.'><label for="category_'.$store_id.'" class="chk-mps"></label>';

				$thaidate = $this->utils->getThaiDate($timestamp);
				
				$url = base_url("store/storeDescription/".$store_id);
				$link = '<a class="text-secondary" cl target="_blank" href="'.$url.'">'.$store_name.'</a>';
				$link_code = '<a target="_blank" href="'.$url.'">'.$store_code.'</a>';
				$store_arr['data'][] = array(
					$checkbox,
					// $thaidate,
					$link_code,
					$link,
					$sum_product_qty_css,
					$category_name,
					// $title.' '.$first_name.' '.$last_name,
					// $tel,
					$status_name,
				);
			
            endforeach;
        endif;
        $json = json_encode($store_arr);
		echo $json;
	}

	public function getItemstores()
	{	
		$itemstores_type_id = $this->input->post("itemstores_type_id");
		$seller_store_id = $this->input->post("store_id");
		$itemstores_arr = array();
        $itemstores_arr['data'] = array();

		if($itemstores_type_id == 0){
			$itemstores = $this->model_store->getOrderByMemberID($seller_store_id);
		}else if($itemstores_type_id == 1){ // เจ้าหนี้
			$itemstores = $this->model_store->getOrderMyPlaceByMemberID($seller_store_id);
		}else if($itemstores_type_id == 2){ // ลูกหนี้
			$itemstores = $this->model_store->getOrderOtherPlaceByMemberID($seller_store_id);
		}
	
        if(!empty($itemstores)):
			foreach($itemstores as $row):	
				$tran_id = $row->tran_id;
				$order_code = $row->order_code;
				$request_place_id = $row->request_place_id;
				$seller_store_id = $row->seller_store_id;
				$depositor_store_id = $row->depositor_store_id;
				$amount = $row->amount;
				$amount_total = $row->amount_total;
				$place_name = "-";
				$places = $this->model_store->getPlaceByID($request_place_id);
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
					
				$store_in_order = $this->model_store->getStoreByID($display_store_id);
				
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
		$ref_depositor_store_id = $this->input->post("depositor_store_id");
		$ref_seller_store_id = $this->input->post("seller_store_id");

		$itemstores_info_arr = array();
        $itemstores_info_arr['data'] = array();

		$itemstores_info = $this->model_store->getInfoOrderByMemberID($ref_seller_store_id,$ref_depositor_store_id);
	
        if(!empty($itemstores_info)):
			foreach($itemstores_info as $row):	
				$tran_type = $row->tran_type;
				$order_code = $row->order_code;
				$request_place_id = $row->request_place_id;
				$seller_store_id = $row->seller_store_id;
				$depositor_store_id = $row->depositor_store_id;
				$amount = $row->amount;
				$amount_total = $row->amount_total;
				$timestamp = $row->timestamp;

				
				$type_name = '-';
				$trans = $this->model_store->getTranType($tran_type);
				if(count($trans)>0)$type_name = $trans[0]->type_name;
				
				$place_name = "-";
				$places = $this->model_store->getPlaceByID($request_place_id);
				if(count($places)) $place_name = $places[0]->place_name;
				if($amount <= 0){
					$is_creditor = "";
					$btn_text_type = "รายละเอียด";
					$btn_text_class = "btn-success";
					$text = " text-danger ";
				}else{
					$is_creditor = "+";
					$btn_text_type = "รายละเอียด";
					$btn_text_class = "btn-success";
					$text = " text-info ";
				}
				
				
				$display_store_id = $depositor_store_id;
					
				$store_in_order = $this->model_store->getStoreByID($display_store_id);
				
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
				$amount_lable = '<span class="'.$text.'">'.$is_creditor.$amount.'</span>';
				$itemstores_info_arr['data'][] = array(
					$timestamp,
					$order_code,
					$type_name,
					$amount_lable,

				);
			
            endforeach;
        endif;
        $json = json_encode($itemstores_info_arr);
		echo $json;
	}


	// update data
	public function updateStatusStoreRecom(){
		$store_id  = $this->input->post("store_id");
		$this->db->set('store_status',2);
		$this->db->where('store_id',$store_id);
		$result = $this->db->update("store");
		if($result){
			$success = 1;
		}else{
			$success = 0;
		}
		$respond = array('success' => $success);
	}
	public function updateStoreRecom(){
		$store_id  = $this->input->post("store_id");
		$this->db->set('store_status',5);
		$this->db->where('store_id',$store_id);
		$result = $this->db->update("store");
		if($result){
			$success = 1;
		}else{
			$success = 0;
		}
		$respond = array('success' => $success);

	}

	public function fake_doc($member_id){
		//$this->session->set_userdata("member_id",$member_id);
		
		$query = $this->db->query("SELECT * FROM member WHERE member_id = ".$member_id);
		$user = $query->result();
		$user = $user[0];
		$this->session->set_userdata("isLoggedIn",TRUE);
		foreach ($user as $key => $value){
			$this->session->set_userdata($key,$value);
		}
		
		$query = $this->db->query("SELECT * FROM  store WHERE member_id = ".$member_id);
		$store = $query->result();
		if(count($store) > 0){
			$store = $store[0];
			foreach ($store as $key => $value){
				$this->session->set_userdata($key,$value);
			}
		}
		redirect("../store/registration");
	}

	public function partner_doc($member_id){
		//$this->session->set_userdata("member_id",$member_id);
		
		$query = $this->db->query("SELECT * FROM member WHERE member_id = ".$member_id);
		$user = $query->result();
		$user = $user[0];
		$this->session->set_userdata("isLoggedIn",TRUE);
		foreach ($user as $key => $value){
			$this->session->set_userdata($key,$value);
		}
		
		$query = $this->db->query("SELECT * FROM  store WHERE member_id = ".$member_id);
		$store = $query->result();
		if(count($store) > 0){
			$store = $store[0];
			foreach ($store as $key => $value){
				$this->session->set_userdata($key,$value);
			}
		}
		redirect("../store/itemstores/order/all");
	}

	
}
