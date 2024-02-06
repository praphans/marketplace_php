<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promo_request_api extends MX_Controller {
	
	public $PAGE;
	public function __construct() {
        parent::__construct();
		$this->load->model('promotions/model_promotions');
		$this->utils->checkLogin();
	}

	public function getPromoRequest()
	{
		$promotions_arr = array();
        $promotions_arr['data'] = array();
		$promotions = $this->model_promotions->getPromoRequest();
        if(!empty($promotions)):
			foreach($promotions as $row):
				$promo_id = $row->promo_id;
				$product_id = $row->product_id;
				$join_id = $row->join_id;
				$promo_name = $row->promo_name;
				$promo_price = $row->promo_price;
				$promo_startdate = $row->promo_startdate;
				$promo_starttime = $row->promo_starttime;
				$promo_enddate = $row->promo_enddate;
				$promo_endtime = $row->promo_endtime;
				$promo_status = $row->promo_status;
				$promo_type = $row->promo_type;
				$timestamp = $row->timestamp;

				$join_name = $row->join_name;
				$join_startdate = $row->join_startdate;
				$join_starttime = $row->join_starttime;
				$join_enddate = $row->join_enddate;
				$join_endtime = $row->join_endtime;
				$join_status = $row->join_status;


				$dateStart = $promo_starttime.' '.$promo_startdate;
				$dateStop = $promo_endtime.'  '.$promo_enddate;

				$joinDateStart = $join_starttime.'  '.$join_startdate;
				$joinDateStop = $join_endtime.'  '.$join_enddate;

				$verify_url = base_url("promotions/promo_request/verify/".$promo_id);
				$refuse_url = base_url("promotions/promo_request/refuse/".$promo_id);
				
				$promo_type_result = $this->model_promotions->getPromoTypeByID($promo_type);
				

				if(count($promo_type_result)>0){
					$type_name = $promo_type_result[0]->type_name;
				}else{
					$type_name = '';
				}

				if($promo_type == 1){
					$type_name_label = '<span class="badge badge-info w-100 text-center ">'.$type_name.'</span>';
					$promo_name_and_join = $promo_name;

					$dateStart_and_join = $dateStart;
					$dateStop_and_join = $dateStop;

				}else{
					$type_name_label = '<span class="badge badge-warning text-light w-100 text-center ">'.$type_name.'</span>';
					$promo_name_and_join = $join_name;

					$dateStart_and_join = $joinDateStart;
					$dateStop_and_join = $joinDateStop;

				}

				$promo_status_result = $this->model_promotions->getPromoStatusByID($promo_status);
				if(count($promo_status_result)>0){
					$status_name = $promo_status_result[0]->status_name;
				}else{
					$status_name = '';
				}

				$product_result = $this->model_promotions->getPromoProductByID($product_id);
				if(count($product_result)>0){
					$product_name = $product_result[0]->product_name;
					$store_id = $product_result[0]->store_id;
				}else{
					$product_name = '';
					$store_id = 0;
				}

				$store_result = $this->model_promotions->getstoreByID($store_id);
				if(count($store_result)>0){
					$store_name = $store_result[0]->store_name;
				}else{
					$store_name = '';
				}

				
				if($promo_status == 1){
					$status_name_label = '<span class="badge badge-info w-100 text-center ">'.$status_name.'</span>';
					$btn_confirm = "<a href='".$verify_url."' class='btn btn-warning w-100 text-center'>อนุมัติ</a>";
					$btn_refuse = "<a href='".$refuse_url."' class='btn btn-danger w-100 text-center'>ไม่อนุมัติ</a>";
				}else if($promo_status == 2){
					$status_name_label = '<span class="badge badge-success w-100 text-center ">'.$status_name.'</span>';
					$btn_confirm = "<a href='#' class='btn btn-success disabled w-100 text-center'>อนุมัติแล้ว</a>";
					$btn_refuse = "";
				}else if($promo_status == 3){
					$status_name_label = '<span class="badge badge-warning w-100 text-center text-white">'.$status_name.'</span>';
					$btn_confirm = "<a href='#' class='btn btn-danger disabled w-100 text-center '>ไม่อนุมัติ</a>";
					$btn_refuse = "";
				}else if($promo_status == 4){
					$status_name_label = '<span class="badge badge-danger w-100 text-center ">'.$status_name.'</span>';
					$btn_confirm = "";
					$btn_refuse = "";
				}else{
					$status_name_label = '';
					$btn_confirm = "";
					$btn_refuse = "";
				}

				$thaidate = $this->utils->getThaiDate($timestamp);
				$promotions_arr['data'][] = array(
					// $timestamp,
					$promo_name_and_join,
					$product_name,
					$store_name,
					number_format($promo_price,2),
					// $dateStart_and_join, 
					// $dateStop_and_join,
					$status_name_label,
					$btn_confirm,
					$btn_refuse,
				);
               
            endforeach;
        endif;
        $json = json_encode($promotions_arr);
		echo $json;
	}
	
	
}
