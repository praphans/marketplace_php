<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Massage_api extends MX_Controller {
	
	public $PAGE;
	public function __construct() {
        parent::__construct();
		$this->load->model('massage/model_massage');
		$this->utils->checkLogin();
	}

	public function getMassage()
	{
		$massage_arr = array();
        $massage_arr['data'] = array();
		$massage = $this->model_massage->getMassage();
		$store_id = 0;
        if(!empty($massage)):
			foreach($massage as $row):
				$message_id = $row->message_id;
				$sender_id = $row->sender_id;
				$receiver_id = $row->receiver_id;
				$order_id = $row->order_id;
				$message = $row->message;
				$message_type = $row->message_type;
				$timestamp = $row->timestamp;
		
				$thaidate = $this->utils->getThaiDate($timestamp);

				$sender_result = $this->model_massage->getMemberByID($sender_id);
				if(count($sender_result)>0){
					$first_name = $sender_result[0]->first_name;
					$last_name = $sender_result[0]->last_name;
					$member = $first_name." ".$last_name;
				}else{
					$member = " -";
				}
				$order_result = $this->model_massage->getOrderByID($order_id);
				if(count($order_result)>0){
					$order_code = $order_result[0]->order_code;
					$store_id = $order_result[0]->store_id;
				}else{
					$order_code = " -";
					$store_id = 0;
				}
				$img_result = $this->model_massage->getImgByID($message_id);
				if(count($img_result)>0){
					$image_url = $img_result[0]->image_url;
					// $images =  '<img src="'.base_url('../'.$image_url).'" width="100" />';

					$images = ' <a class="example-image-link zoom-in" href="'.base_url('../'.$image_url).'" data-lightbox="example-1"><img class="example-image" src="'.base_url('../'.$image_url).'" width="100"  /></a>';


				}else{
					$image_url = " -";
					$images =  '<img src="https://www.bormel-grice.com/sites/all/themes/riley_sub/img/nopicture.png" width="100" />';
				}

				$order_url = base_url("order/orderDescription/".$order_code);
				$link_order_id = '<a href="'.$order_url.'">'.$order_code.'</a>';

				$message_strip = strip_tags($message);
				$message_url = base_url("massage/descriptMassagr/".$message_id);
				$link_message_id = '<a href="'.$message_url.'">'.$message_strip.'</a>';

				// $new_subject = wordwrap($subject,45, "<br>", true);
				// $new_detail = wordwrap($detail,45, "<br>", true);
				$massage_arr['data'][] = array(
					$timestamp,
					$member,
					$link_order_id,
					$link_message_id,
					$images,
				
					

				);
               
            endforeach;
        endif;
        $json = json_encode($massage_arr);
		echo $json;
	}
	

}
