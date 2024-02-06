<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inboxs extends MX_Controller {

	public $PAGE;
	public function __construct() {
        parent::__construct();
		$this->PAGE['title'] = 'กล่องข้อความ | '.$this->load->get_var("default_title");
		$this->load->model('inboxs/model_inboxs');
		$this->utils->checkLogin();
	}
	public function index()
	{
		redirect("inboxs/inbox/receive");
	}
	public function inbox($filter = "receive",$message_type = 0)
	{
		// if(!$this->membermanager->isLoggedIn()){
		// 	$this->session->set_flashdata('error_msg','การดำเนินการในขั้นตอนต่อไป จำเป็นจะต้องเข้าสู่ระบบ');
		// 	redirect("member/login");
		// }
		$this->session->set_userdata("message_type_session",$message_type);
		$member_id = 0;//$this->membermanager->member_id();
		
		
		$page_number = ($this->uri->segment(5) != '')?$this->uri->segment(5):0; 
		
		$total_rows = $this->model_inboxs->getMessageTotalRows($member_id,$filter,$message_type);
		$this->load->library('pagination');
		$config['base_url'] = base_url('inboxs/inbox/'.$filter.'/'.$message_type.'/');
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page = 10;
		
		
		
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = false;
		$config['last_link'] = false;
		$config['first_tag_open'] = '<li class="page-item page-link">';
		$config['first_tag_close'] = '</li>';
		$config['prev_link'] = '&laquo';
		$config['prev_tag_open'] = '<li class="page-item page-link">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '&raquo';
		$config['next_tag_open'] = '<li class="page-item page-link">';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="page-item page-link">';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li class="page-item page-link">';
		$config['num_tag_close'] = '</li>';



		
		$this->pagination->initialize($config);
		
		$this->PAGE['message_type_list'] = $this->model_inboxs->getAllMessageType();
		if($filter == "sent"){
			$this->PAGE['messages'] = $messages = $this->model_inboxs->getSenderMessage($member_id,$message_type,$page_number,$per_page);
		}else if($filter == "receive"){
			$this->PAGE['messages'] = $messages = $this->model_inboxs->getReceiveMessage($member_id,$message_type,$page_number,$per_page);
		}
		//echo $total_rows."<br>";
		//echo count($messages)."<br>";
		$pages = ceil($total_rows/$per_page);
		$min_page = ($page_number+1);
		$max_page = count($messages);
		$max_page = $min_page+($max_page-1);
		$this->PAGE['page_showing'] = 'แสดง '.$min_page.' ถึง '.$max_page.' จาก '.$total_rows.' รายการ ( '.$pages.' หน้า )';
		$this->PAGE['pagination'] = $this->pagination->create_links();
		$this->PAGE['filter'] = $filter;
		$this->PAGE['message_type'] = $message_type;
		$this->load->view("inboxs/inboxs_view",$this->PAGE);
	}
	// send_to 0 = ทุกคน
	// send_to 1 = ติดต่อผู้ขาย
	// send_to 2 = ติดต่อผู้ซื้อ
	// send_to 3 = ติดต่อผู้ส่ง
	// send_to 4 = ร้องเรียน
	// send_to 5 = ข่าวสารจากร้าน
	
	//message_type_id 1 = ข่าวสารจาก marketplace.com
	//message_type_id 2 = ข่าวสารจากร้านค้า
	//message_type_id 3 = สนทนา
	//message_type_id 4 = ร้องเรียน
	
	public function create($message_type_id = 0,$order_id = 0,$send_to = 0,$to_store_id = 0)
	{
		$this->PAGE['order_id'] = $order_id;
		$this->PAGE['send_to'] = $send_to;
		$this->PAGE['to_store_id'] = $to_store_id;
		$this->PAGE['message_type_id'] = $message_type_id;
		$this->PAGE['message_type'] = $this->model_inboxs->getMessageType();
		$this->load->view("inboxs/create_view",$this->PAGE);
	}
	
	public function reply()
	{
			$message_reply_id = $this->input->post('message_reply_id');
			$message = $this->input->post('message');
			$sender_id = $this->input->post('sender_id');
			$receiver_id = $this->input->post('receiver_id');
			$messages = $this->model_inboxs->getMessageByID($message_reply_id);


			foreach($messages as $row){
				//$receiver_id = $row->receiver_id;
				//$sender_id = $row->sender_id;
				$order_id = $row->order_id;
				//$message = $row->message;
				$message_topic = $row->message_topic;
				$message_type = $row->message_type;
				$message_code = $row->message_code;
				$topic_code = $row->topic_code;
				$is_read = $row->is_read;
				$is_pin = $row->is_pin;
				$timestamp = $row->timestamp;
			}
			// print_r($messages);
			// exit();
			$topic_code = $this->utils->getCode(20);

			$this->db->set("message_reply_id",$message_reply_id);
			$this->db->set("message_type",$message_type);
			$this->db->set("message_topic",$message_topic);
			$this->db->set("message",$message);
			$this->db->set("order_id",$order_id);
			$this->db->set("is_read",1);
			$this->db->set("receiver_id",$receiver_id);
			$this->db->set("sender_id",$sender_id);
			$this->db->set("message_code",$message_code);
			$this->db->set("topic_code",$topic_code);

			
			$this->db->insert("message");
			
			
			
			$this->db->set("is_read",0);
			$this->db->where("message_code",$message_code);
			//$this->db->or_where("message_reply_id",$message_reply_id);
			$this->db->update("message");
			
			redirect("inboxs/inbox/receive");
				
	}
	public function send()
	{
		
		
		$send_to = $this->input->post('send_to');
		$message_topic = $this->input->post('message_topic');
		$message_type = $this->input->post('message_type');
		$message = $this->input->post('message');
		$order_id = $this->input->post('order_id');
		$store_id = $this->input->post('store_id');
		//$message_reply_id = $this->input->post('message_reply_id');
		
		if(!isset($store_id) || $order_id != 0){
			if(isset($order_id) && $order_id != 0){	
				$order = $this->model_inboxs->getOrderByID($order_id);
				
				foreach($order as $row){
					$order_member_id = $row->order_member_id;
					$order_code = $row->order_code;	
					$store_id = $row->store_id;	
					$depositor_store_id = $row->depositor_store_id;	
				}
			}
		}
		/*echo "store_id : ".$store_id."<br>";
		echo "send_to : ".$send_to."<br>";
		echo "message_type : ".$message_type."<br>";
		echo "message : ".$message."<br>";
		echo "order_id : ".$order_id."<br>";*/
		
		$message_code = $this->utils->getCode(20);
		$topic_code = $this->utils->getCode(20);
		$sender_id = 0;//$this->membermanager->member_id();
		
		
		if(isset($store_id) && $send_to == 2){
			$store = $this->model_inboxs->getMemberIDByStoreID($store_id); // ผู้ซื้อ
			if(count($store)){
				$store_member_id = $order_member_id;
				//if(isset($message_reply_id))$this->db->set("message_reply_id",$message_reply_id);
				$this->db->set("message_topic",$message_topic);
				$this->db->set("message_type",$message_type);
				$this->db->set("message",$message);
				$this->db->set("order_id",$order_id);
				$this->db->set("receiver_id",$store_member_id);
				$this->db->set("sender_id",$sender_id);
				$this->db->set("message_code",$message_code);
				$this->db->set("topic_code",$topic_code);
				$this->db->insert("message");
				$message_id = $this->db->insert_id();
				/*$message_image = $this->utils->upload_multiple_file("uploads/faq","faq",$_FILES['message_image'],800,600,TRUE);
				
				if(count($message_image) > 0){
					for($i=0;$i<count($message_image);$i++){
						$image_url = $message_image[$i];
						if(isset($image_url)){
							$this->db->set("message_id",$message_id);
							$this->db->set("image_url",$image_url);
							$this->db->insert("message_image");
						}
					}
				}*/
			}
		}
		
		if(isset($store_id) && ($send_to == 0 || $send_to == 1)){
			
			$store = $this->model_inboxs->getMemberIDByStoreID($store_id); // ผู้ขาย
			
			if(count($store)){
				
				$store_member_id = $store[0]->member_id;
				//if(isset($message_reply_id))$this->db->set("message_reply_id",$message_reply_id);
				$this->db->set("message_topic",$message_topic);
				$this->db->set("message_type",$message_type);
				$this->db->set("message",$message);
				$this->db->set("order_id",$order_id);
				$this->db->set("receiver_id",$store_member_id);
				$this->db->set("sender_id",$sender_id);
				$this->db->set("message_code",$message_code);
				$this->db->set("topic_code",$topic_code);
				$this->db->insert("message");
				$message_id = $this->db->insert_id();
				/*$message_image = $this->utils->upload_multiple_file("uploads/faq","faq",$_FILES['message_image'],800,600,TRUE);
				
				if(count($message_image) > 0){
					for($i=0;$i<count($message_image);$i++){
						$image_url = $message_image[$i];
						if(isset($image_url)){
							$this->db->set("message_id",$message_id);
							$this->db->set("image_url",$image_url);
							$this->db->insert("message_image");
						}
					}
				}*/
			}
		}
		if(isset($depositor_store_id) && ($send_to == 0 || $send_to == 3)){
			$depositor = $this->model_inboxs->getMemberIDByStoreID($depositor_store_id);  // ผู้ส่ง
			if(count($depositor)){
				$depositor_member_id = $depositor[0]->member_id;
				$store_member_id = $store[0]->member_id;
				//if(isset($message_reply_id))$this->db->set("message_reply_id",$message_reply_id);
				$this->db->set("message_topic",$message_topic);
				$this->db->set("message_type",$message_type);
				$this->db->set("message",$message);
				$this->db->set("order_id",$order_id);
				$this->db->set("receiver_id",$depositor_member_id);
				$this->db->set("sender_id",$sender_id);
				$this->db->set("message_code",$message_code);
				$this->db->set("topic_code",$topic_code);
				$this->db->insert("message");
				$message_id = $this->db->insert_id();
				/*$message_image = $this->utils->upload_multiple_file("uploads/faq","faq",$_FILES['message_image'],800,600,TRUE);
				
				if(count($message_image) > 0){
					for($i=0;$i<count($message_image);$i++){
						$image_url = $message_image[$i];
						if(isset($image_url)){
							$this->db->set("message_id",$message_id);
							$this->db->set("image_url",$image_url);
							$this->db->insert("message_image");
						}
					}
				}*/
			}
		}
		
		if($send_to == 4){
			//if(isset($message_reply_id))$this->db->set("message_reply_id",$message_reply_id);
			$this->db->set("message_topic",$message_topic);
			$this->db->set("message_type",$message_type);
			$this->db->set("message",$message);
			$this->db->set("order_id",$order_id);
			$this->db->set("receiver_id",0);
			$this->db->set("sender_id",$sender_id);
			$this->db->set("message_code",$message_code);
			$this->db->set("topic_code",$topic_code);
			$this->db->insert("message");
			$message_id = $this->db->insert_id();
			/*$message_image = $this->utils->upload_multiple_file("uploads/faq","faq",$_FILES['message_image'],800,600,TRUE);
			
			if(count($message_image) > 0){
				for($i=0;$i<count($message_image);$i++){
					$image_url = $message_image[$i];
					if(isset($image_url)){
						$this->db->set("message_id",$message_id);
						$this->db->set("image_url",$image_url);
						$this->db->insert("message_image");
					}
				}
			}*/
		}
		
		if($send_to == 5){
			$my_store_id = $this->storemanager->store_id();
			$member_list = $this->model_inboxs->getMyFollower($my_store_id);  // ส่งข่าวสาร
			
			
			
			$this->db->set("message_topic",$message_topic);
			$this->db->set("message_type",$message_type);
			$this->db->set("message",$message);
			$this->db->set("order_id",$order_id);
			//$this->db->set("receiver_id",$receiver_member_id);
			$this->db->set("sender_id",$sender_id);
			$this->db->set("message_code",$message_code);
			$this->db->set("topic_code",$topic_code);
			$this->db->insert("message");
			$message_reply_id = $this->db->insert_id();
			
			
			if(count($member_list)){
				foreach($member_list as $row){
					$receiver_member_id = $row->member_id;
					//if(isset($message_reply_id))$this->db->set("message_reply_id",$message_reply_id);
					$this->db->set("message_topic",$message_topic);
					$this->db->set("message_type",$message_type);
					$this->db->set("message",$message);
					$this->db->set("message_reply_id",$message_reply_id);
					$this->db->set("order_id",$order_id);
					$this->db->set("receiver_id",$receiver_member_id);
					$this->db->set("sender_id",$sender_id);
					$this->db->set("message_code",$message_code);
					$this->db->set("topic_code",$topic_code);
					$this->db->insert("message");
					$message_id = $this->db->insert_id();
					/*$message_image = $this->utils->upload_multiple_file("uploads/faq","faq",$_FILES['message_image'],800,600,TRUE);
					
					if(count($message_image) > 0){
						for($i=0;$i<count($message_image);$i++){
							$image_url = $message_image[$i];
							if(isset($image_url)){
								$this->db->set("message_id",$message_id);
								$this->db->set("image_url",$image_url);
								$this->db->insert("message_image");
							}
						}
					}*/
				}
			}
		}
		redirect("inboxs");
	}
	public function info($filter = "receive",$message_type = 0,$message_id = 0){
		
		
		$messages = $this->model_inboxs->getMessageANDReplyMessageByID($message_id);
		foreach($messages as $row){
			$message_id = $row->message_id;
			$message_reply_id = $row->message_reply_id;
		}
		if($message_reply_id > 0){
			$messages = $this->model_inboxs->getMessageANDReplyMessageByID($message_reply_id);
		
			$member_id = 0;//$this->membermanager->member_id();
			
			$result = $this->model_inboxs->getMyReceiveMessage($member_id,$message_reply_id);
			
			foreach($result as $row){
				$message_code = $row->message_code;
			}
			
			
			
			$this->db->set("is_read",1);
			$this->db->where("receiver_id",$member_id);
			if(isset($message_code))$this->db->where("message_code",$message_code);
		}else{
			$this->db->set("is_read",1);
			$this->db->where("message_id",$message_id);
		}
		
		
		$this->db->update("message");
				
		
		
				
		//$messages = $this->model_inboxs->getMessageANDReplyMessageByID($message_reply_id);
		$this->PAGE['messages'] = $messages;
		$this->PAGE['filter'] = $filter;
		$this->PAGE['message_type'] = $message_type;
		$this->PAGE['message_type_list'] = $this->model_inboxs->getAllMessageType();
		$this->load->view("inboxs/inboxs_info_view",$this->PAGE);
	}
	public function pin($message_id,$filter){
		if(isset($message_id)){
			$this->db->set("is_pin",1);
			$this->db->where("message_id",$message_id);
			$this->db->update("message");
		}
		
		redirect("inboxs/inbox/".$filter."/0");
	}
	public function unpin($message_id,$filter){
		if(isset($message_id)){
			$this->db->set("is_pin",0);
			$this->db->where("message_id",$message_id);
			$this->db->update("message");
		}
		redirect("inboxs/inbox/".$filter."/0");
	}
}