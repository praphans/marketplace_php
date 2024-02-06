<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends MX_Controller {

	public $PAGE;
	public function __construct() {
        parent::__construct();
		$this->load->model('model_user');
		$this->PAGE['title'] = 'ตั้งค่าการใช้งาน | '.$this->load->get_var("default_title");
		$this->membermanager->checkLogin();
	}
	public function index()
	{
		redirect("user/setting/info");
	}
	public function info()
	{
		
		if(!empty($this->storemanager->store_id())){
			if($this->storemanager->store_id() > 0 || $this->storemanager->store_id() <= -1){
				redirect("user/setting/repass");
			}
		}
		$member_id = $this->membermanager->member_id();
		$members = $this->model_user->getMemberByID($member_id);
		$this->PAGE['members'] = $members;
		$this->load->view("user/setting_view",$this->PAGE);
	}
	public function repass()
	{
		
		$member_id = $this->membermanager->member_id();
		$members = $this->model_user->getMemberByID($member_id);
		$this->PAGE['members'] = $members;
		$this->load->view("user/repass_view",$this->PAGE);
	}
	public function saveAccount(){
		$post = $this->input->post();
		$member_id = $post['member_id'];
		$post['birthday'] = $post['birthday_date'].'-'.$post['birthday_month'].'-'.$post['birthday_year'];
		unset($post['birthday_date']);
		unset($post['birthday_month']);
		unset($post['birthday_year']);
		$this->db->where("member_id",$member_id);
		$this->db->update("member",$post);
		redirect("user/setting/info");
	}
	public function changePassword(){
		$password = $this->input->post('password');
		$newpassword = $this->input->post('newpassword');
		$confirm_newpassword = $this->input->post('confirm_newpassword');
		$login_with_facebook = $this->input->post('login_with_facebook');
		
		$member_id = $this->membermanager->member_id();
		$this->db->select("member_id");
		$this->db->from("member");
		$this->db->where("password",md5($password));
		$this->db->where("member_id",$member_id);
		$query = $this->db->get();
		
		if(!$query->num_rows() && $login_with_facebook == 0){
			$this->session->set_flashdata("error_msg","รหัสผ่านไม่ถูกต้อง");
		}else{
			$this->session->set_flashdata("error_msg","เปลี่ยนรหัสผ่านเรียบร้อยแล้ว");
			if($login_with_facebook){
				$this->db->set("login_with_facebook",0);
			}
			$this->db->set("password",md5($newpassword));
			$this->db->where("member_id",$member_id);
			$this->db->update("member");
		}
		redirect("user/setting/repass");
	}
}