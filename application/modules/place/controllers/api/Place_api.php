<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Place_api extends MX_Controller {
	
	public $PAGE;
	public function __construct() {
        parent::__construct();
		$this->load->model('place/model_place');
		$this->load->library('place/place_libs');
		$this->utils->checkLogin();
	}

	public function getPlace($current_shipping_type_id = 0)
	{
		$shipping_type_id = $this->input->post("shipping_type_id");

		if(isset($shipping_type_id) && $shipping_type_id != 0){
          $current_shipping_type_id = $shipping_type_id;
        }
	

		$place_arr = array();
        $place_arr['data'] = array();
		$place = $this->model_place->getPlace($current_shipping_type_id);
        if(!empty($place)):
			foreach($place as $row):

				$place_id				= $row->place_id;
				$store_id				= $row->store_id;
				$member_id				= $row->member_id;
				$shipping_type_id		= $row->shipping_type_id;
				$place_code				= $row->place_code;
				$place_name				= $row->place_name;
				$place_mobile			= $row->place_mobile;

				$store_result = $this->model_place->getStoreByID($store_id);
				$shipping_type_result = $this->model_place->getShippingTypeByID($shipping_type_id);
	
				if(count($store_result)>0){
					$store_name = $store_result[0]->store_name;
				}else{
					$store_name = "";
				}

				if(count($shipping_type_result)>0){
					$shipping_type_name = $shipping_type_result[0]->type_name;
				}else{
					$shipping_type_name = "";
				}

				$store_place_result = $this->model_place->getCountStorePlaceByID($store_id);
				if(count($store_place_result)>0){
					$place_count = $store_place_result[0]->place_count;
				}else{
					$place_count = 0;
				}

				$url_place_id = base_url("place/placeDescription/".$place_id);
				$link_place_code = '<a href="'.$url_place_id.'">'.$place_code.'</a>';
				$link_place_name = '<a href="'.$url_place_id.'" class="text-secondary">'.$place_name.'</a>';


				$url_store_id = base_url("store/storeDescription/".$store_id);
				$link_store_name = '<a href="'.$url_store_id.'">'.$store_name.'</a>';

				$place_arr['data'][] = array(
					$link_place_code,
					$link_place_name,
					$link_store_name,
					$place_count,
					// $shipping_type_name,
					// $place_mobile,
					
				);
               
            endforeach;
        endif;
        $json = json_encode($place_arr);
		echo $json;
	}
	


	
}
