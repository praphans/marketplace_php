<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productset_api extends MX_Controller {
	
	public $PAGE;
	public function __construct() {
        parent::__construct();
		$this->load->model('productset/model_productset');
		$this->utils->checkLogin();
	}

	public function getProduct($current_store_id = 0)
	{

		$settings_arr = array();
        $settings_arr['data'] = array();
		$product = $this->model_productset->getProduct($current_store_id);
        if(!empty($product)):
			foreach($product as $row):

				$product_id		= $row->product_id;
				$product_code	= $row->product_code;
				$product_name 	= $row->product_name;
				$product_qty  	= $row->product_qty;
				$product_price  = $row->product_price;
				$product_featured  = $row->product_featured;
				$product_status = $row->product_status;
				$store_id  		= $row->store_id;
				$product_price_discount  = $row->product_price_discount;
				$product_mode  = $row->product_mode;

				if(strlen($product_name) > 60){
					$product_name = iconv_substr($product_name,0,40,"UTF-8")."...";
				}else{
					$product_name =  iconv_substr($product_name,0,40,"UTF-8");
				}

				$store_list = $this->model_productset->getStoreByID($store_id);
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

				$product_featured_result = $this->model_productset->getProductFeatureByID($product_featured);
				if(count($product_featured_result)>0){
					$featured_name = $product_featured_result[0]->featured_name;
				}else{
					$featured_name = "สินค้าทั่วไป";
				}

				// $checkbox = '<input type="checkbox" id="product_'.$product_id.'" value="'.$product_id.'" class="filled-in chk-col-light-green del_product"><label for="product_'.$product_id.'" class="chk-mps "></label>';

				$url_product_id = base_url("productset/productDescription/".$product_id);
				$link_product_id = '<a href="'.$url_product_id.'">'.$product_code.'</a>';
				$link_product_name = '<a href="'.$url_product_id.'" class="text-secondary">'.$product_name.'</a>';
				if($product_price_discount > 0){
					$product_price = '<span class="d-flex justify-content-end">'.number_format($product_price_discount,2).'</span>';
				}else{
					$product_price = '<span class="d-flex justify-content-end">'.number_format($product_price,2).'</span>';
				}
					
				$url_store_name = base_url("store/storeDescription/".$store_id);
				$link_url_store_name = '<a href="'.$url_store_name.'" class="text-secondary">'.$store_name.'</a>';

				$status_name = "-";
				$status = $this->model_productset->getProductStatusName($product_status);
				if(count($status))$status_name = $status[0]->status_name;

				$verify_url = base_url("productset/verify/".$product_id."/".$store_id);
				$blocks_url = base_url("productset/blocks/".$product_id."/".$store_id);
				$notblocks_url = base_url("productset/notblocks/".$product_id."/".$store_id);
				if($product_status == 1){
					$status_name = '<span class="badge badge-info  w-100 text-center">'.$status_name.'</span>';
					$btn_confirm = "";
				}else if($product_status == 2){
					//$action_confirm = "";
					$status_name = '<span class="badge badge-warning  w-100 text-center text-white">'.$status_name.'</span>';
					$btn_confirm = "<a href='".$verify_url."' class='btn btn-warning w-100 text-center'>อนุมัติ</a>";
				}else if($product_status == 3){
					//$action_confirm = "disabled";
					$status_name = '<span class="badge badge-success  w-100 text-center">'.$status_name.'</span>';
					$btn_confirm = "<a href='".$blocks_url."' class='btn btn-danger w-100 text-center'>ระงับสินค้า</a>";
				}else if($product_status == 4){
					//$action_confirm = "disabled";
					$status_name = '<span class="badge badge-danger  w-100 text-center">'.$status_name.'</span>';
					$btn_confirm = "<a href='".$verify_url."' class='btn btn-info w-100 text-center'>ยกเลิกการระงับสินค้า</a>";
				}else if($product_status == 5){
					//$action_confirm = "disabled";
					$status_name = '<span class="badge badge-danger  w-100 text-center">'.$status_name.'</span>';
					$btn_confirm = "";
				}
				$checked = "";
				
				//$bnt_banned = "<a href='' class='btn btn-warning' ".$action_banned.">ระงับสินค้า</a>";
				
				if($product_mode == 2){
					$checked = "checked";
					$recommended_lable = '<label class="label label-warning text-center">สินค้าแนะนำ <span class="mdi mdi-star-circle"></span></label>';
				}else{
					$recommended_lable = '';
				}

				$checkbox = '<input type="checkbox" id="category_'.$product_id.'" value="'.$product_id.'" class="filled-in chk-col-light-green chx_add_feature" '.$checked.'><label for="category_'.$product_id.'" class="chk-mps"></label>';

				$count_relate_result = $this->model_productset->getCountRelateByID($product_id);
				if(count($count_relate_result)>0){
					$count_product_id = $count_relate_result[0]->count_product_id;
				}else{
					$count_product_id = 0;
				}

				$sum_product_qty_result = $this->model_productset->getProductQtyByID($product_id);
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
				$btn_featur = '<button type="button"  name="add_fearture" class="btn btn-info text-light btn-block mdi mdi-cards" onclick="loadModalSetFeature('.$product_id.','.$product_featured.');"> เพิ่ม Fearture</button>';

				

				$settings_arr['data'][] = array(
					$checkbox,
					$link_product_id,
					$link_product_name.' '.$recommended_lable,
					// $product_price,
					// number_format($product_qty),
					// $count_product_id.' รายการ',
					$link_url_store_name,
					$featured_name,
					$btn_featur,
					// $btn_confirm
				);
               
            endforeach;
        endif;
        $json = json_encode($settings_arr);
		echo $json;
	}
	

	// add_recommended data
	public function setRecommended(){
		$product_id  = $this->input->post("product_id");
		$product_mode  = $this->input->post("product_mode");

		$this->db->where('product_id', $product_id);
		$this->db->set('product_mode', $product_mode);
		$result = $this->db->update('product');
		if($result){
			$success = 1;
		}else{
			$success = 0;
		}
		$respond = array('success' => $success);
	}
	
}
