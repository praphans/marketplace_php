<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends MX_Controller {

	public $PAGE;

	public function __construct() {
        parent::__construct();
		$this->load->model('member/model_member');
		$this->PAGE['title'] = 'เข้าสู่ระบบ | '.$this->load->get_var("default_title");
		
	}
	public function index()
	{
		//$this->utils->IsLogin();
		$titleName = $this->model_member->getNameTitle();
		$coppyRight = $this->model_member->getNameCoppyRight();

		$default_title 	=  $titleName[0]->default_title;
		$copyright 	=  $coppyRight[0]->copyright;
		
		$this->PAGE['default_title'] = $default_title;
		$this->PAGE['copyright'] = $copyright;
		$this->load->view('login_view',$this->PAGE);
	}
	public function loginMember()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$member = $this->model_member->getMemberLogIn($username,$password);

		if(!empty($member)){

			/* ดึงข้อมูลของ ยูสเซอร์ */
			foreach ($member as $rs) {
				$admin_id = $rs->admin_id;
				$username = $rs->username;
				$user_type = $rs->user_type;
				$name = $rs->name;
				$allow_to_login = $rs->allow_to_login;
			}
			if(!$allow_to_login){
				redirect("member/logout");
			}
			/* สร้างตัวแปรการ ล็อกอิน */
			$logged_in = 1;
			/* บันทึกค่าการเข้าสู่ระบบ */
			$this->db->set('logged_in', $logged_in);
			$this->db->where('admin_id',$admin_id);
			$this->db->update('admin');

			/* เก็บข้อมูลลงใน session*/
			$newdata = array(
		        'admin_id'     	 => $admin_id,
		        'username'  	 => $username,
		        'user_type' 	 => $user_type,
		        'name'      	 => $name,
		        'allow_to_login' => $allow_to_login,
		        'logged_in' 	 => $logged_in
			);
			$this->db->set("timestamp",date("Y-m-d H:i:s"));
			$this->db->where('admin_id',$admin_id);

			$this->session->set_userdata($newdata);
			redirect("statistics","refresh");
		}else{
			$error_title = '';
			$error_message = 'ชื่อผู้ใช้งาน หรือ รหัสผ่านของคุณไม่ถูกต้อง';
			redirect("member","refresh");
		}
	}
	public function logout()
	{
		$admin_id = $this->utils->admin_id();
		$this->db->set('logged_in', 0);
		$this->db->where('admin_id',$admin_id);
		$this->db->update('admin');

		$this->session->sess_destroy();
		redirect("member","refresh");
	}

	public function memberList(){
		$this->PAGE['title'] = 'รายการสมาชิก | '.$this->load->get_var("default_title");
		$this->load->view('member_view',$this->PAGE);
	}
	public function banned($member_id){
		$this->db->set("member_status",0);
		$this->db->where("member_id",$member_id);
		$this->db->update("member");


		redirect("member/memberList");
	}
	public function unbanned($member_id){
		$this->db->set("member_status",1);
		$this->db->where("member_id",$member_id);
		$this->db->update("member");


		redirect("member/memberList");
	}


}