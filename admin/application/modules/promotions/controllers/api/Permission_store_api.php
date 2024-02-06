<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permission_store_api extends MX_Controller {
	
	public $PAGE;
	public function __construct() {
        parent::__construct();
		$this->load->model('promotions/model_promotions');
		$this->utils->checkLogin();
	}

	public function getPermission_store()
	{
		$permission_store_arr = array();
        $permission_store_arr['data'] = array();
        $join_id = $this->input->post("join_id"); 
		$permission_store = $this->model_promotions->getStore();
		
        if(!empty($permission_store)):
			foreach($permission_store as $row):	
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
				$timestamp = $row->timestamp;
				$product_id = 0;
				$review_type = 0;

				$title = "คุณ";
				if($first_name == "" || $last_name == ""){
					$title = " -";
				}
				
				$sum_product_qty_result = $this->model_promotions->getQtyProductByID($store_id);
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

				$checked = "";
				$per_status = "";

				
				$join_promo_rerult = $this->model_promotions->getJoinPromoByID($join_id);
				if(count($join_promo_rerult)>0){
					$join_store_list = $join_promo_rerult[0]->join_store_list;
				}else{
					$join_store_list = 0;
				}
				
				$join_store_arr = explode(",",$join_store_list);
				if(in_array($store_id, $join_store_arr)){
					$checked = "checked";
					$per_status = '<span class="badge badge-success w-100 text-center ">ส่งคำเชิญแล้ว</span>';
				}

				$checkbox = '<input type="checkbox" id="category_'.$store_id.'" value="'.$store_id.'" join_id="'.$join_id.'" class="filled-in chk-col-light-green chx_jion_promo" '.$checked.'><label for="category_'.$store_id.'" class="chk-mps"></label>';
				
				$thaidate = $this->utils->getThaiDate($timestamp);

				$url = base_url("store/storeDescription/".$store_id);
				$link = '<a href="'.$url.'">'.$store_name.'</a>';
				$permission_store_arr['data'][] = array(
					$checkbox,
					$timestamp,
					$store_code,
					$link,
					$per_status,
					number_format($sum_product_qty)." รายการ",
					$title.' '.$first_name.' '.$last_name,
					$tel,
				);
			
            endforeach;
        endif;
        $json = json_encode($permission_store_arr);
		echo $json;
	}

		// add data
	public function addPermisStore(){
		
		$isAdd  = $this->input->post("isAdd");
		$join_id  = $this->input->post("join_id");
		$store_id  = $this->input->post("store_id");

		$this->db->select('join_store_list');
		$this->db->from('product_promo_join');
		$this->db->where("join_id",$join_id);
		$query = $this->db->get();
		$result = $query->result();
		$current_join_store_list = '';
		if(count($result) > 0)$current_join_store_list = $result[0]->join_store_list;

		$current_join_store_list = explode(",",$current_join_store_list);
	
		if($isAdd){
			array_push($current_join_store_list, $store_id);
		}else{
			if (($key = array_search($store_id, $current_join_store_list)) !== false) {
			    unset($current_join_store_list[$key]);
			}
		}

		$current_arr = array_unique($current_join_store_list);
		$current = implode(",", $current_arr);
		
		$output = str_replace(',,', ',', $current);
		$current_join_store_list = trim($output, ',');

		$this->db->set('join_store_list', $current_join_store_list);
		$this->db->where('join_id', $join_id);
		$result = $this->db->update('product_promo_join');
		if($result){
			$success = 1;
			//echo $success;
		}else{
			$success = 0;
			//echo $success;
		}
		$respond = array('success' => $success,'current_join_store_list' =>$current_join_store_list);
		echo json_encode($respond);
	}

	
}
