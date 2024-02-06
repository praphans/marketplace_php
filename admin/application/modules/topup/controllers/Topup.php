<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Topup extends MX_Controller { 
	
	public $PAGE;
	public function __construct() {
        parent::__construct();
		$this->PAGE['title'] = 'เติมเงิน | '.$this->load->get_var("default_title");
	
		$this->load->model('topup/model_topup');
		$this->load->model('topup/model_account');
		$this->utils->checkLogin();
	}
	
	public function index()
	{
		$this->load->view("topup_view",$this->PAGE);
	}

	public function myModalSetCoin(){
		
		$this->load->view('topup/modals/edit_coin_view');	
	}

	public function edit_topup(){
		
		$coin_value = $this->input->post("coin_value");
	
		$data = array(
			"coin_value"=>$coin_value,
		);
		// print_r($data);
		// exit();
		$this->db->where("id",1);
		$this->db->update("contact_info",$data);
		redirect("topup","refresh");
	}
	public function account_topup()
	{
		$this->load->view("account_topup_view",$this->PAGE);
	}
	public function myModalViewAccount($member_id){
		$this->PAGE['member_id'] = $member_id;
		$this->load->view('topup/modals/his_account_view',$this->PAGE);
	}
	


	
}
