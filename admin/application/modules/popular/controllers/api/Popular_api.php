<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Popular_api extends MX_Controller {
	
	public $PAGE;
	public function __construct() {
        parent::__construct();
		$this->load->model('popular/model_popular');
		$this->utils->checkLogin();
	}

	public function getPopular()
	{

		$popular_arr = array();
        $popular_arr['data'] = array();
		$popular = $this->model_popular->getPopular();
        if(!empty($popular)):
			foreach($popular as $row):

				$product_id		= $row->product_id;
				$product_code	= $row->product_code;
				$product_name 	= $row->product_name;
				$product_qty  	= $row->product_qty;
				$product_price  = $row->product_price;
				$product_featured  = $row->product_featured;
				$product_status = $row->product_status;
				$store_id  		= $row->store_id;
				$product_point  = $row->product_point;
				$product_price_discount  = $row->product_price_discount;

				if(strlen($product_name) > 60){
					$product_name = iconv_substr($product_name,0,40,"UTF-8")."...";
				}else{
					$product_name =  iconv_substr($product_name,0,40,"UTF-8");
				}

				$store_list = $this->model_popular->getStoreByID($store_id);
				if(count($store_list)>0){
					$store_name = $store_list[0]->store_name;
				}else{
					$store_name = " -";
				}
				if(strlen($store_name) > 60){
					$store_name = iconv_substr($store_name,0,30,"UTF-8")."...";
				}else{
					$store_name =  iconv_substr($store_name,0,30,"UTF-8");
				}

				$url_product_id = base_url("product/productDescription/".$product_id);
				$link_product_id = '<a href="'.$url_product_id.'">'.$product_code.'</a>';
				$link_product_name = '<a href="'.$url_product_id.'" class="text-secondary">'.$product_name.'</a>';

				
				if($product_price_discount > 0){
					$product_price = '<span class="d-flex justify-content-end">'.number_format($product_price_discount,2).'</span>';
				}else{
					$product_price = '<span class="d-flex justify-content-end">'.number_format($product_price,2).'</span>';
				}

				// if($product_qty == 0){
				// 	$product_qty = '<label class="label label-danger w-100 text-center">สินค้าหมด</label>';
				// }else{
				// 	$product_qty = '<span class="d-flex justify-content-end">'.number_format($product_qty).'</span>';
				// }
				
				$url_store_name = base_url("store/storeDescription/".$store_id);
				$link_url_store_name = '<a href="'.$url_store_name.'" class="text-secondary">'.$store_name.'</a>';

				$status_name = "-";
				$status = $this->model_popular->getProductStatusName($product_status);
				if(count($status))$status_name = $status[0]->status_name;

				if($product_status == 1){
					$status_name = '<span class="badge badge-info  w-100 text-center">'.$status_name.'</span>';
				}else if($product_status == 2){
					$status_name = '<span class="badge badge-warning  w-100 text-center text-white">'.$status_name.'</span>';
				}else if($product_status == 3){
					$status_name = '<span class="badge badge-success  w-100 text-center">'.$status_name.'</span>';
				}else if($product_status == 4){
					$status_name = '<span class="badge badge-danger  w-100 text-center">'.$status_name.'</span>';
				}else if($product_status == 5){
					$status_name = '<span class="badge badge-danger  w-100 text-center">'.$status_name.'</span>';
				}
				$input_popular = '<input type="text" name="product_point[]" pattern="[0,1,2,3,4,5,6,7,8,9]"  value="'.$product_point.'" class="form-control text-center">';
				$product_id_input = '<input type="hidden" name="product_id[]" value="'.$product_id.'">';

				$count_relate_result = $this->model_popular->getCountRelateByID($product_id);
				if(count($count_relate_result)>0){
					$count_product_id = $count_relate_result[0]->count_product_id;
				}else{
					$count_product_id = 0;
				}
				$sum_product_qty_result = $this->model_popular->getProductQtyByID($product_id);
				if(count($sum_product_qty_result)>0){
					$sum_product_qty = $sum_product_qty_result[0]->sum_product_qty;
				}else{
					$sum_product_qty = 0;
				}
				
				if($count_product_id == 0){
					if($product_qty == 0){
						$product_qty_total = '<label class="label label-danger w-100 text-center">สินค้าหมด</label>';
					}else{
						$product_qty_total = '<span class="d-flex justify-content-end">'.number_format($product_qty).'</span>';
					}
				}else{
					if($sum_product_qty == 0){
						$product_qty_total = '<label class="label label-danger w-100 text-center">สินค้าหมด</label>';
					}else{
						$product_qty_total = '<span class="d-flex justify-content-end">'.number_format($sum_product_qty).'</span>';
					}
				}

				$popular_arr['data'][] = array(
					$link_product_id,
					$link_product_name,
					$product_price,
					$product_qty_total,
					$link_url_store_name,
					$status_name,
					$input_popular.$product_id_input,
				);
               
            endforeach;
        endif;
        $json = json_encode($popular_arr);
		echo $json;
	}
	


	
}
