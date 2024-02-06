<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inbox_api extends MX_Controller {
	
	public $PAGE;
	public function __construct() {
        parent::__construct();
		$this->load->model('inbox/model_inbox');
		$this->utils->checkLogin();
	}

	public function getInbox()
	{
		$inbox_arr = array();
        $inbox_arr['data'] = array();
		$inbox = $this->model_inbox->getInbox();
        if(!empty($inbox)):
			foreach($inbox as $row):
				$message_id = $row->message_id;
				$sender_id = $row->sender_id;
				$receiver_id = $row->receiver_id;
				$message = $row->message;
				$message_type = $row->message_type;
				$message_topic = $row->message_topic;
				$timestamp = $row->timestamp;

				$disct_btn = '<a href="'.base_url('xxx/xxx/'.$message_id).'" type="button" class="btn btn-info text-light btn-block mdi mdi-facebook-messenger"> รายละเอียด</a>';

				$sender_result = $this->model_inbox->getSenderByID($sender_id);
				if(count($sender_result)>0){
					$first_name = $sender_result[0]->first_name;
					$last_name = $sender_result[0]->last_name;
					$sender_name = "คุณ ".$first_name." ".$last_name;
				}else{
					$sender_name = "";
				}

				$receiver_result = $this->model_inbox->getReceiverByID($receiver_id);
				if(count($receiver_result)>0){
					$first_name = $receiver_result[0]->first_name;
					$last_name = $receiver_result[0]->last_name;
					$receiver_name = "คุณ ".$first_name." ".$last_name;
				}else{
					$receiver_name = "";
				}

				$inbox_arr['data'][] = array(
					$timestamp,
					$message_topic,
					$sender_name,
					$receiver_name,
					$disct_btn,

				);
               
            endforeach;
        endif;
        $json = json_encode($inbox_arr);
		echo $json;
	}
	

	
}
