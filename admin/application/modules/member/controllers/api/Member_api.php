<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member_api extends MX_Controller {
	
	public $PAGE;
	public function __construct() {
        parent::__construct();
		$this->load->model('member/model_member');
		$this->load->library('member/member_libs');
		$this->utils->checkLogin();
	}

	public function getMember()
	{
		$member_type_id = $this->input->post("member_type_id");
		$settings_arr = array();
        $settings_arr['data'] = array();
		$member = $this->model_member->getMember($member_type_id);
        if(!empty($member)):
			foreach($member as $row):

				$member_id		= $row->member_id;
				$first_name		= $row->first_name;
				$last_name		= $row->last_name;
				$email			= $row->email;
				$member_type	= $row->member_type;
				$member_status	= $row->member_status;
				$timestamp		= $row->timestamp;

				$member_name	= "คุณ ".$first_name." ".$last_name;

				if(strlen($first_name) > 60){
					$first_name = iconv_substr($first_name,0,30,"UTF-8")."...";
				}else{
					$first_name =  iconv_substr($first_name,0,30,"UTF-8");
				}

				$member_type_result = $this->model_member->getMemberType($member_type);
				if(count($member_type_result)>0){
					$type_name = $member_type_result[0]->type_name;
					
				}else{
					$type_name = "";
				}
				$thaidate = $this->member_libs->getThaiDate($timestamp);
				if($member_type == 1){
					$type_name = '<span class="label label-success w-100 text-center">'.$type_name.'</span>';
				}else{
					$type_name = '<span class="label label-warning w-100 text-center">'.$type_name.'</span>';
				}

				$banned_url = base_url("member/banned/".$member_id);
				$un_banned_url = base_url("member/unbanned/".$member_id);
				// $inbox_url = base_url("member/api/member_api/fake_inbox/".$member_id);
				$inbox_url = base_url("message_inbox/index/".$member_id);
				

				if($member_status == 1){

					$btn_ban = "<a href='".$banned_url."' class='btn btn-danger w-100 text-center'>บล็อก</a>";
					$icon_key = '';
				}else{
					$btn_ban = "<a href='".$un_banned_url."' class='btn btn-info w-100 text-center'>ปลดบล็อก</a>";
					$icon_key = '<span class="text-danger font-weight-bold mdi mdi-lock-outline f-20"> </span><span class="label label-warning text-center">ระงับการใช้งาน</span>';
				}
				
				$inbox_btn = "<a href='".$inbox_url."' target='_blank' class='btn btn-info w-100 text-center'>ดู inbox</a>";


				$count_all_order_result = $this->model_member->getCountAllOrderByID($member_id);
				$count_order_result = $this->model_member->getCountOrderByID($member_id);

				if(count($count_all_order_result)>0){
					$count_allorder_status = $count_all_order_result[0]->count_allorder_status;
					$count_allorder_status_val = $count_all_order_result[0]->count_allorder_status;
					if($count_allorder_status <= 0){
						$count_allorder_status = 1;
					}else{
						$count_allorder_status = $count_allorder_status;
					}
				}else{
					$count_allorder_status = 1;
				}
				if(count($count_order_result)>0){
					$count_order_status = $count_order_result[0]->count_order_status;
					if($count_order_status <= 0){
						$count_order_status = 1;
					}else{
						$count_order_status = $count_order_status;
					}
				}else{
					$count_order_status = 1;
				}

				$order_success = ($count_order_status / $count_allorder_status)* 100;
				// $order_persen = $order_success * 100;
				if($count_allorder_status_val <= 0){
					$order_persen = '<span class="badge badge-danger w-100 text-center text-white">ยังไม่มีการซื้อ</span>';
				}else{
					$order_persen = '<div class="progress m-t-20"><div class="progress-bar bg-warning active progress-bar-striped" style="width: '.$order_success.'%; height:15px;" role="progressbar">'.number_format($order_success).'%</div></div>';
				}


				if(strlen($member_name) > 60){
					$member_name = iconv_substr($member_name,0,33,"UTF-8")."...";
				}else{
					$member_name =  iconv_substr($member_name,0,33,"UTF-8");
				}

				$settings_arr['data'][] = array(
					$timestamp,
					$first_name." ".$icon_key,
					$email,
					$order_persen,
					$inbox_btn,
					$btn_ban,
					
				
				);
               
            endforeach;
        endif;
        $json = json_encode($settings_arr);
		echo $json;
	}
	
	public function fake_inbox($member_id){
		//$this->session->set_userdata("member_id",$member_id);
		
		$query = $this->db->query("SELECT * FROM member WHERE member_id = ".$member_id);
		$user = $query->result();
		$user = $user[0];
		$this->session->set_userdata("isLoggedIn",TRUE);
		foreach ($user as $key => $value){
			$this->session->set_userdata($key,$value);
		}
		
		$query = $this->db->query("SELECT * FROM  store WHERE member_id = ".$member_id);
		$store = $query->result();
		if(count($store) > 0){
			$store = $store[0];
			foreach ($store as $key => $value){
				$this->session->set_userdata($key,$value);
			}
		}
		redirect("../message/inbox/receive");
	}
	


	
}
