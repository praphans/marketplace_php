<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promotions_api extends MX_Controller {
	
	public $PAGE;
	public function __construct() {
        parent::__construct();
		$this->load->model('promotions/model_promotions');
		$this->utils->checkLogin();
	}

	public function getPromotions()
	{
		$promotions_arr = array();
        $promotions_arr['data'] = array();
		$promotions = $this->model_promotions->getPromotions();
        if(!empty($promotions)):
			foreach($promotions as $row):
				$join_id = $row->join_id;
				$join_name = $row->join_name;
				$join_price = $row->join_price;
				$join_image = $row->join_image;
				$join_startdate = $row->join_startdate;
				$join_starttime = $row->join_starttime;
				$join_enddate = $row->join_enddate;
				$join_endtime = $row->join_endtime;
				$join_store_list = $row->join_store_list;

				if(!empty($join_store_list)){
					$count_promo_rerult = $this->model_promotions->getCountStorePomoByID($join_store_list);
					if(count($count_promo_rerult)>0){
						$count_store_id = $count_promo_rerult[0]->count_store_id;
					}else{
						$count_store_id = 0;
					}
				}else{
					$count_store_id = 0;
				}

				$product_id = array();
				$product_arr_result = $this->model_promotions->getProductPromoByID($join_id);
				foreach($product_arr_result as $row){
					$product_id_val = $row->product_id; 
					array_push($product_id,$product_id_val);
				}

				if(!empty($product_id)){
					$count_store_result = $this->model_promotions->getProductByID($product_id);
					if(count($count_store_result)>0){
						$count_join_store = $count_store_result[0]->count_join_store;
					}else{
						$count_join_store = 0;
					}
				}else{
					$count_join_store = 0;
				}

				
				$images =  '<img src="'.base_url('../'.$join_image).'" width="50" />';
				$checkbox = '<input type="checkbox" id="promotion_'.$join_id.'" value="'.$join_id.'" class="filled-in chk-col-light-green del_store"><label for="promotion_'.$join_id.'" class="chk-mps "></label>';
				$edit_btn = '<button type="button" onClick="loadModalEdit('.$join_id.');" id="edit" class="btn btn-warning text-light btn-block mdi mdi-pencil"> แก้ไข</button>';

				$allow_btn = '<a href="'.base_url('promotions/promotionsStore/'.$join_id).'" type="button" class="btn btn-info text-light btn-block mdi mdi-account-check"> ร้านค้าที่อนุญาต</a>';
				$participation_btn = '<span class="badge badge-warning w-100 text-center text-light">ส่งคำเชิญ '.$count_store_id.'</span><br><span class="badge badge-success w-100 text-center ">เข้าร่วม '.$count_join_store.'</span>';

				$promotions_arr['data'][] = array(
					$checkbox,
					$join_name,
					// $join_price,
					$images,
					$participation_btn,
					$join_starttime.' '.$join_startdate , 
					$join_endtime.'  '.$join_enddate,
					$allow_btn,
					$edit_btn,
				);
               
            endforeach;
        endif;
        $json = json_encode($promotions_arr);
		echo $json;
	}
	
	// delete data
	public function deletePromotions(){
		
		$join_id  = $this->input->post("join_id");
		$this->db->where('join_id', $join_id);
		$result = $this->db->delete('product_promo_join');

		$this->db->where('join_id', $join_id);
		$result = $this->db->delete('product_promo');
		
		if($result){
			$success = 1;
		}else{
			$success = 0;
		}
		$respond = array('success' => $success);
	}
	
}
