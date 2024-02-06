<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Requestplace extends MX_Controller {   

	public $PAGE;
	public function __construct() {
        parent::__construct();
		
		$this->PAGE['title'] = 'รายการขอใช้สถานที่ | '.$this->load->get_var("default_title");
		$this->membermanager->checkLogin();
		$this->load->helper(array('form', 'url'));
		$config['upload_path'] = 'uploads';
		$config['allowed_types'] = 'svg|gif|jpg|png|doc|doc'; 
		$config['encrypt_name'] = TRUE;
		
		$this->load->model('model_requestplace');
		$this->load->library('upload', $config);
		$this->storemanager->hasStore();
	}
	public function index()
	{
		$requestplace = $this->model_requestplace->getRequestPlace(); 
		
		$this->PAGE['requestplace'] = $requestplace;
		$this->load->view("store/12_".$this->router->fetch_class()."/requestplace_view",$this->PAGE);
	}
	public function approve($place_id){
		if(isset($place_id) && $place_id != "" && $place_id != 0){
			$this->membermanager->checkLogin();
			$this->db->where("place_id",$place_id);
			$this->db->set("place_status",2);
			$this->db->update("store_place");
			
		}
		
		redirect("store/requestplace");
	}
	public function notapprove($place_id){
		if(isset($place_id) && $place_id != "" && $place_id != 0){
			$this->membermanager->checkLogin();
			$this->db->where("place_id",$place_id);
			$this->db->set("place_status",3);
			$this->db->update("store_place");
			
		}
		
		redirect("store/requestplace");
	}
	
	public function cancelUnconfirmed($place_id){
		if(isset($place_id) && $place_id != "" && $place_id != 0){
			$this->membermanager->checkLogin();
			$this->db->where("place_id",$place_id);
			$this->db->set("place_status",1);
			$this->db->update("store_place");
			
		}
		
		redirect("store/requestplace");
	}
	public function cancelConfirmation($place_id){
		if(isset($place_id) && $place_id != "" && $place_id != 0){
			$this->membermanager->checkLogin();
			$this->db->where("place_id",$place_id);
			$this->db->set("place_status",1);
			$this->db->update("store_place");
			
		}
		
		redirect("store/requestplace");
	}
	
}