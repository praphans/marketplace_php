<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MX_Controller {   

	public $PAGE;
	public function __construct() {
        parent::__construct();
		
		$this->PAGE['title'] = 'ข้อมูลส่วนตัว | '.$this->load->get_var("default_title");
		$this->membermanager->checkLogin();
		$this->load->helper(array('form', 'url'));
		$config['upload_path'] = 'uploads';
		$config['allowed_types'] = 'svg|gif|jpg|png|doc|doc'; 
		$config['encrypt_name'] = TRUE;
		$this->load->library('upload', $config);
		//$this->storemanager->hasStore();
	}
	public function index()
	{	$this->PAGE['store'] = $this->storemanager->myStore();
		$this->load->view("store/11_".$this->router->fetch_class()."/me_view",$this->PAGE);
	}
	public function saveProfile(){
		$store_avatar = $this->utils->upload_multiple_file("uploads/store","profile",$_FILES['store_avatar'],300,300);
		$store_cover = $this->utils->upload_multiple_file("uploads/store","profile",$_FILES['store_cover'],1140,385);
		$store_description = $this->input->post("store_description");
		$current_store_avatar = $this->input->post("current_store_avatar");
		$current_store_cover = $this->input->post("current_store_cover");
		
		$store_id = $this->storemanager->store_id();
		$store_avatar = ($store_avatar[0])?$store_avatar[0]:$current_store_avatar;
		$store_cover = ($store_cover[0])?$store_cover[0]:$current_store_cover;
		
		if(!$store_avatar || $store_avatar == "" || empty($store_avatar))$store_avatar = $this->storemanager->default_avatar_image();
		if(!$store_cover || $store_cover == "" || empty($store_cover))$store_cover = $this->storemanager->default_cover_image();
		
		$store_data = array(
			"store_avatar"=>$store_avatar,
			"store_cover"=>$store_cover,
			"store_description"=>$store_description
		);
		$this->db->where("store_id",$store_id);
		$this->db->update("store",$store_data);
		//$product_id = $this->db->insert_id();
		redirect("store/profile");
	}
}