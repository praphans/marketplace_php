<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promo_wabsite_api extends MX_Controller {
	
	public $PAGE;
	public function __construct() {
        parent::__construct();
		$this->load->model('promotions/model_promotions');
		$this->utils->checkLogin();
	}

	public function getPromoWebsite()
	{
		$promotions_arr = array();
        $promotions_arr['data'] = array();
		$promotions = $this->model_promotions->getPromotionsWebsite();
        if(!empty($promotions)):
			foreach($promotions as $row):
				$promo_id = $row->promo_id;
				$promo_name = $row->promo_name;
				$promo_url = $row->promo_url;
				$promo_image = $row->promo_image;
				$timestamp = $row->timestamp;

				$link = '<a href="'.$promo_url.'">'.$promo_url.'</a>';
		
				$images =  '<img src="'.base_url('../'.$promo_image).'" width="80" />';
				$checkbox = '<input type="checkbox" id="promotion_'.$promo_id.'" value="'.$promo_id.'" promo_id="'.$promo_id.'" class="filled-in chk-col-light-green del_promo_website"><label for="promotion_'.$promo_id.'" class="chk-mps "></label>';
				$edit_btn = '<button type="button" onClick="loadModalPromoWebEdit('.$promo_id.');" id="edit" class="btn btn-warning text-light btn-block mdi mdi-pencil"> แก้ไข</button>';

				$promotions_arr['data'][] = array(
					$checkbox,
					$promo_name,
					$link,
					$images,
					$edit_btn,
				);
               
            endforeach;
        endif;
        $json = json_encode($promotions_arr);
		echo $json;
	}
	
	// delete data
	public function deletegetPromoWebsite(){
		
		$promo_id  = $this->input->post("promo_id");
		$this->db->where('promo_id', $promo_id);
		$result = $this->db->delete('promotion');
		
		if($result){
			$success = 1;
		}else{
			$success = 0;
		}
		$respond = array('success' => $success);
	}
	
}
