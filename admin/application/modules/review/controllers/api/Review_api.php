<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Review_api extends MX_Controller {
	
	public $PAGE;
	public function __construct() {
        parent::__construct();
		$this->load->model('review/model_review');
		// $this->load->library('review/review_libs');
		$this->utils->checkLogin();
	}

	public function getReview($current_review_type_id = 0,$current_store_id = 0)
	{
		$review_type_id = $this->input->post("review_type_id");
		$store_id = $this->input->post("store_id");


		if(isset($review_type_id) && $review_type_id != 0){
          $current_review_type_id = $review_type_id;
        }

         if(isset($store_id) && $store_id != 0){
           $current_store_id = $store_id;
        }

	

		$settings_arr = array();
        $settings_arr['data'] = array();
		$review = $this->model_review->getReview($current_review_type_id,$current_store_id);
        if(!empty($review)):
			foreach($review as $row):

				$review_id		= $row->review_id;
				// $order_id		= $row->order_id;
				$member_id		= $row->member_id;
				$store_id		= $row->store_id;
				$product_id		= $row->product_id;
				$review_rating	= $row->review_rating;
				$review_content	= $row->review_content;
				$review_type	= $row->review_type;
				// $review_status	= $row->review_status;
				$timestamp		= $row->timestamp;
		
				$member_result = $this->model_review->getMemberByID($member_id);
				$review_type_result = $this->model_review->getReviewTypeByID($review_type);
				
				$product_result = $this->model_review->getProductByID($product_id);
				$store_result = $this->model_review->getStoreByID($store_id);

				if(count($member_result)>0){
					$first_name = $member_result[0]->first_name;
					$last_name  = $member_result[0]->last_name;
					$member_name = $first_name." ".$last_name;
				}else{
					$member_name = "";
				}
				if(strlen($member_name) > 60){
					$member_name = iconv_substr($member_name,0,30,"UTF-8")."...";
				}else{
					$member_name =  iconv_substr($member_name,0,30,"UTF-8");
				}

				if(count($review_type_result)>0){
					$type_review_name = $review_type_result[0]->type_name;
					if($review_type == 1){
						$type_review_name = '<span class="label label-warning w-100 text-center">'.$type_review_name.'</span>';
					}else if($review_type == 2){
						$type_review_name = '<span class="label label-info w-100 text-center">'.$type_review_name.'</span>';
					}else{
						$type_review_name = '<span class="label label-success w-100 text-center">'.$type_review_name.'</span>';
					}
				}else{
					$type_review_name = "";
				}

				if(count($product_result)>0){
					$product_code = $product_result[0]->product_code;
				}else{
					$product_code = "";
				}

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

				if($review_rating == 1){
					$review_rating	 = '<i class="fa fa-star text-warning"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
				}else if($review_rating == 2){
					$review_rating	 = '<i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
				}else if($review_rating == 3){
					$review_rating	 = '<i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
				}else if($review_rating == 4){
					$review_rating	 = '<i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star"></i>';
				}else if($review_rating == 5){
					$review_rating	 = '<i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i>';
				}else{
					$review_rating	 = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
				}

				
				$url_product_id = base_url("product/productDescription/".$product_id);
				$link_product_id = '<a href="'.$url_product_id.'">'.$product_code.'</a>';

				$url_store_id = base_url("store/storeDescription/".$store_id);
				$link_store_id = '<a href="'.$url_store_id.'">'.$store_name.'</a>';
				$thaidate = $this->utils->getThaiDate($timestamp);

				$settings_arr['data'][] = array(
					$timestamp,
					$link_product_id,
					$link_store_id,
					$member_name,
					$type_review_name,
					$review_content,
					$review_rating,
					
				);
               
            endforeach;
        endif;
        $json = json_encode($settings_arr);
		echo $json;
	}
	


	
}
