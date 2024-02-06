<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends MX_Controller {

	public $PAGE;
	public function __construct() {
        parent::__construct();
		$this->load->model('model_member');
		$this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
		//$this->load->library('session');
	}
	public function index()
	{
		redirect("member/login");
	}
	public function login()
	{
		if($this->membermanager->isLoggedIn()){
			redirect("user");
		}else{
			$this->PAGE['title'] = 'เข้าสู่ระบบ | '.$this->load->get_var("default_title");
			$this->load->view("member/login_view",$this->PAGE);
		}
	}
	public function register()
	{  
		if($this->membermanager->isLoggedIn()){
			redirect("user");
		}else{
			$this->PAGE['title'] = 'สมัครสมาชิก | '.$this->load->get_var("default_title");
			$this->load->view("member/register_view",$this->PAGE);
		}
	}
	
	public function saveUser()
	{
		
		$facebook_user_id = $this->input->post('facebook_user_id');
		$first_name = $this->input->post('first_name');
		$last_name = '';$this->input->post('last_name');
		$mobile = $this->input->post('mobile');
		$email = $this->input->post('email');
		$member_type = 1; // USER ธรรมดา
		
		$incorrect_time = $this->cache->get('incorrect_time');
		if($incorrect_time && $incorrect_time >= 5){
			$this->session->set_flashdata('error_msg', 'คุณเข้าสู่ระบบไม่ถูกต้องเกิน 5 ครั้ง \nกรุณารอ 15 นาทีเพื่อลองใหม่อีกครั้ง');
			redirect("member/login");	
		}
		
		if(empty($first_name) || empty($email)){
			
			redirect("member/login");	
		}
		if(isset($facebook_user_id)){
			$login_with_facebook = 1;
			$password = md5($facebook_user_id);
		}else{
			$login_with_facebook = 0;
			$password = md5($this->input->post('password'));
		}
		
		
		$confirm_password = md5($this->input->post('confirm_password'));
		$verify_code = $this->utils->getCode(100);
		
		$user = array(
			'first_name'=>$first_name,
			'last_name'=>$last_name,
			'password'=>$password,
			'email'=>$email,
			'mobile'=>$mobile,
			'verify_code'=>$verify_code,
			'login_with_facebook'=>$login_with_facebook,
			'member_type'=>1
		);
		//$facebook_user_id = 1;
		$has_user = $this->model_member->email_login($email);
		$sess_id = $this->session->userdata("sess_id");
		
		if(count($has_user)){
			 if($facebook_user_id){
				
				 
				 $member_id = $has_user['member_id'];
				 $name = $has_user['first_name']." ".$has_user['last_name'];
				 $login_url = base_url("member/login");
				 $this->utils->sendRegister($email,$name,$login_url);
				 
				 $store = $this->model_storemanager->myStore($member_id);
			     if(count($store))$this->membermanager->activeStore($store[0],TRUE);
				 $this->membermanager->activeUser($has_user,TRUE);
				 $this->updateCartToMember($member_id);
				 
				 if(empty($sess_id)){
					$redirect_url = 'home';
				 }else{
					$redirect_url = 'cart';
				 }
				$respond = array("success"=>TRUE,"redirect_url"=>$redirect_url);
				echo json_encode($respond);
			 }else{
				$this->incorrectLogin();
				$this->session->set_flashdata('error_msg', 'อีเมลนี้เป็นสมาชิกกับ marketplace.com อยู่แล้ว');
				redirect('member/register');
			 }
		}else{
			 $member_id = $this->model_member->register_user($user);
			 $user['member_id'] = $member_id;
			 $member_verify = $user['member_verify'];
			 $name = $user['first_name']." ".$user['last_name'];
			 
			 
			 $login_url = base_url("member/verify/".$verify_code);
			 
			 $this->utils->sendRegister($email,$name,$login_url);
			 $this->session->set_flashdata('error_msg', 'สมัครสมาชิกเรียบร้อยแล้ว กรุณาตรวจสอบอีเมล\n และยืนยันการสมัครสมาชิกก่อนเข้าสู่ระบบ');
			 redirect("member/login");
			 
			 /*$this->membermanager->activeUser($user,TRUE);
				 
			 $store = $this->model_storemanager->myStore($member_id);
			 if(count($store))$this->membermanager->activeStore($store[0],TRUE);
			 
			 $this->updateCartToMember($member_id);
			 
			
			if($login_with_facebook){
				if(empty($sess_id)){
					$redirect_url = 'user';
				}else{
					$redirect_url = 'cart';
				}
				$respond = array("success"=>TRUE,"redirect_url"=>$redirect_url);
				echo json_encode($respond);
			}else{
				
				if(empty($sess_id)){
					redirect('user');
				}else{
					redirect('cart');
				}
			}*/
		} 
		
	}
	public function logout(){
		$this->membermanager->activeUser($this->session->all_userdata(),FALSE);	
		redirect('member/login');
	}
	public function loginMember()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		
		$user = $this->model_member->getMemberLogIn($email,$password);
		
		//$this->cache->save('incorrect_time', 0, 900);
		$incorrect_time = $this->cache->get('incorrect_time');
		if($incorrect_time && $incorrect_time >= 5){
			$this->session->set_flashdata('error_msg', 'คุณเข้าสู่ระบบไม่ถูกต้องเกิน 5 ครั้ง \nกรุณารอ 15 นาทีเพื่อลองใหม่อีกครั้ง');
			redirect("member/login");	
		}
		
		if(count($user)){
			$this->membermanager->activeUser($user,TRUE);
			$query = $this->db->query("SELECT * FROM  store WHERE member_id = ".$this->membermanager->member_id());
			$has_user = $query->result();
			
			$member_id = $has_user[0]->member_id;
			
			$store = $this->model_storemanager->myStore($member_id);
			$this->membermanager->activeStore($store[0],TRUE);
			$this->membermanager->activeUser($user,TRUE);
			$this->updateCartToMember($member_id);
			
			$sess_id = $this->session->userdata("sess_id");
			if(empty($sess_id)){
				redirect('home');
			}else{
				redirect('cart');
			}
		}else{
			$this->incorrectLogin();
			$error_message = 'อีเมล, รหัสผ่านของคุณไม่ถูกต้อง หรือคุณยังไม่ได้ยืนยันตัวตน';
			$this->session->set_flashdata('error_msg', $error_message);
			redirect('member/login','refresh');
		}
	
	}
	private function incorrectLogin(){
		
		if (!$incorrect_time = $this->cache->get('incorrect_time')){
			$incorrect_time = 0;
		}else{
			$incorrect_time = $this->cache->get('incorrect_time');
		}
		$incorrect_time++;
		$this->cache->save('incorrect_time', $incorrect_time, 900);
	}
	private function updateCartToMember($member_id){
		$sess_id = $this->session->userdata("sess_id");
		if(!empty($sess_id)){
			$this->db->set("member_id",$member_id);
			$this->db->where("sess_id",$sess_id);
			$this->db->update("cart");
			
			$this->db->set("member_id",$member_id);
			$this->db->where("sess_id",$sess_id);
			$this->db->update("wishlist");
		}
	}
	public function forgot(){
		if (!$forgot_token = $this->cache->get('forgot_token')){
			redirect("member/login");
		}else{
			$this->PAGE['title'] = 'เปลี่ยนรหัสผ่าน | '.$this->load->get_var("default_title");
			$this->load->view("member/forgot_view",$this->PAGE);
		}
		
	}
	public function forgotpassword(){
		$member_email = $this->input->post('member_email');
		$has_user = $this->model_member->email_login($member_email);
		
		if(count($has_user)){
			$name = $has_user['first_name'].' '.$has_user['last_name'];
			$forgot_token = $this->utils->getForgotToken(150);
			$this->cache->save('forgot_token', $forgot_token, 180);
			$verify_link = base_url("member/forgot/".$forgot_token);
			$this->utils->sendForgotpassword($member_email,$name,$verify_link);	
		}
		$error_message = 'กรุณาตรวจสอบอีเมล';
		$this->session->set_flashdata('error_msg', $error_message);
		redirect('member/login','refresh');
	}
	public function resetpassword(){
		$member_email = $this->input->post('email');
		$has_user = $this->model_member->email_login($member_email);
		
		$newpassword = $this->input->post('new_password');
		
		if(count($has_user)){
			$member_id = $has_user['member_id'];
			$this->db->set("password",md5($newpassword));
			$this->db->where("member_id",$member_id);
			$this->db->update("member");
		}
		redirect('member/login','refresh');
	}
	public function verify($verify_code){
		$this->db->set("member_verify",1);
		$this->db->where("verify_code",$verify_code);
		$this->db->update("member");
		redirect("member/login");
	}
}