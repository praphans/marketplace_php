<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Statistics_api extends MX_Controller {
	
	public $PAGE;
	public function __construct() {
        parent::__construct();
		$this->load->model('statistics/model_statistics');
		$this->load->library('statistics/statistics_libs');
		$this->utils->checkLogin();
	}


	public function getProductSale()
	{
		

		$productSale_arr = array();
        $productSale_arr['data'] = array();

        $productSg = $this->model_statistics->getProductSaleGood();
        if(!empty($productSg)):
			foreach($productSg as $rowSg):
				$product_sg_id	= $rowSg->product_id;
				$count_or_id	= $rowSg->count_or_id;

				$productSale = $this->model_statistics->getProductSale($product_sg_id);
				if(count($productSale)>0){
					$product_id		= $productSale[0]->product_id;
					$product_name	= $productSale[0]->product_name;
					$product_qty	= $productSale[0]->product_qty;
					$product_price	= $productSale[0]->product_price;
					$product_status	= $productSale[0]->product_status;
					$timestamp		= $productSale[0]->timestamp;
				}else{
					$product_id		= 0;
					$product_name	= "";
					$product_qty	= "";
					$product_price	= "";
					$product_status	= "";
					$timestamp		= "";
				}

				if(strlen($product_name) > 60){
					$product_name = iconv_substr($product_name,0,30,"UTF-8")."...";
				}else{
					$product_name =  iconv_substr($product_name,0,30,"UTF-8");
				}

				$url_product_id = base_url("product/productDescription/".$product_id);
				$link_product_id = '<a class="text-secondary" href="'.$url_product_id.'">'.$product_name.'</a>';

				$img_result = $this->model_statistics->getImgByID($product_id);
				if(count($img_result)>0){
					$image_url = $img_result[0]->image_url;
					$images =  '<img src="'.base_url('../'.$image_url).'" width="90"/>';
					$link_images = '<a href="'.$url_product_id.'">'.$images.'</a>';
				}else{
					$images =  '<img src="https://www.bormel-grice.com/sites/all/themes/riley_sub/img/nopicture.png" width="90"/>';
					$link_images = '<a href="#">'.$images.'</a>';
				}
				$thaidate = $this->statistics_libs->getThaiDate($timestamp);
				
				

				$productSale_arr['data'][] = array(
					
					$link_product_id,
					$link_images,
					$product_qty,
					$product_price,
					$timestamp,
		
				);
		               
		        
	        endforeach;
	    endif;
        $json = json_encode($productSale_arr);
		echo $json;
	}


	public function getStorePopular()
	{
		
		$StorePopular_arr = array();
        $StorePopular_arr['data'] = array();
		$StorePopular = $this->model_statistics->getStorePopular();
        if(!empty($StorePopular)):
			foreach($StorePopular as $row):

				$store_id		= $row->store_id;
				$count_or_id	= $row->count_or_id;
				$store_name		= $row->store_name;
				$store_avatar	= $row->store_avatar;
				$first_name		= $row->first_name;
				$last_name		= $row->last_name;
				$tel			= $row->tel;
				$nameShop	= "คุน ".$first_name." ".$last_name;

				if(strlen($store_name) > 60){
					$store_name = iconv_substr($store_name,0,30,"UTF-8")."...";
				}else{
					$store_name =  iconv_substr($store_name,0,30,"UTF-8");
				}

				$url_store_id = base_url("store/storeDescription/".$store_id);
				$link_store_name = '<a class="text-secondary" href="'.$url_store_id.'">'.$store_name.'</a>';
				if(!empty($store_avatar)){
					$images =  '<img src="'.base_url('../'.$store_avatar).'" width="90"/>';
					$link_images = '<a href="'.$url_store_id.'">'.$images.'</a>';
				}else{
					$images =  '<img src="https://www.bormel-grice.com/sites/all/themes/riley_sub/img/nopicture.png" width="90"/>';
					$link_images = '<a href="#">'.$images.'</a>';
				}

				$StorePopular_arr['data'][] = array(

					$link_store_name,
					$link_images,
					$nameShop,
					$tel,
				
				);
               
            endforeach;
        endif;
        $json = json_encode($StorePopular_arr);
		echo $json;
	}


	


	
}
