<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends MX_Controller { 
	
	public $PAGE;	
	public function __construct() {
        parent::__construct();
        $this->PAGE['title'] = 'รายการสั่งซื้อสินค้า | '.$this->load->get_var("default_title");
		$this->load->model('order/model_order');
		$this->load->library('order/order_libs');
		$this->load->helper(array('form', 'url'));
		$config['upload_path'] = 'uploads';
		$config['allowed_types'] = 'svg|gif|jpg|png'; 
		$config['encrypt_name'] = TRUE;
		$this->utils->checkLogin();
		$this->load->library('upload', $config);
	}
	public function index(){
		$this->load->view('order_view',$this->PAGE);
	}
	public function orderDescription($order_code){

		$order_discription = $this->model_order->getOrderDescription($order_code);
		$this->PAGE['order_discription'] = $order_discription;

		$this->load->view('order_description_view',$this->PAGE);
	}
	public function myModalViewHistory($order_id){
		// $admin = $this->model_settings->getAdminByID($admin_id);
		$this->PAGE['order_id'] = $order_id;

		$this->load->view('order/modals/history_view',$this->PAGE);
	}
	
}
