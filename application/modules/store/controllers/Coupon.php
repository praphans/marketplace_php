<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Coupon extends MX_Controller {   

	public $PAGE;
	public function __construct() {
        parent::__construct();
		
		$this->PAGE['title'] = 'จัดการคูปอง | '.$this->load->get_var("default_title");
		$this->membermanager->checkLogin();
		$this->load->model("model_coupon");
		$this->load->model("model_delivery");
		$this->load->model("user/model_user");
		
		$this->load->model("model_saleitem");
		$this->load->helper(array('form', 'url'));
		$config['upload_path'] = 'uploads';
		$config['allowed_types'] = 'svg|gif|jpg|png|doc|doc'; 
		$config['encrypt_name'] = TRUE;
		$this->load->library('upload', $config);
		$this->storemanager->hasStore();
	}
	public function index()
	{
		redirect("store/coupon/order");
	}
	public function order()
	{
		/*$order_status = 2;
		if($order_status == 2 || $order_status == 7 || $order_status == 8 || $order_status == 9 || $order_status == 10 || $order_status == 11){
		
			echo "asdfasdf";
			exit();
		}*/
		
		$keyword = $this->input->post("keyword");
		
		$store_id = $this->storemanager->store_id();
		$per_page = 10;
		$page_number = ($this->uri->segment(4) != '')?$this->uri->segment(4):0; 
		
		
		
		$total_rows = $this->model_coupon->getOrderTotalRow($store_id,$keyword);
		
		$this->load->library('pagination');
		$config['base_url'] = base_url('store/coupon/order/');
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page;
		
		
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = false;
		$config['last_link'] = false;
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['prev_link'] = '&laquo';
		$config['prev_tag_open'] = '<li class="prev">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '&raquo';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['use_page_numbers'] = TRUE;
		
		$this->pagination->initialize($config);
		
		$orders = $this->model_coupon->getOrderByStoreID($store_id,$page_number,$per_page,$keyword);
		
		
		$pages = ceil($total_rows/$per_page);
		$min_page = ($page_number+1);
		$max_page = count($orders);
		$max_page = $min_page+($max_page-1);
		$this->PAGE['page_showing'] = 'แสดง '.$min_page.' ถึง '.$max_page.' จาก '.$total_rows.' รายการ ( '.$pages.' หน้า )';
		$this->PAGE['pagination'] = $this->pagination->create_links();
		
		$this->PAGE['orders'] = $orders;
		$this->load->view("store/5_".$this->router->fetch_class()."/coupon_view",$this->PAGE);
	}
	public function orderinfo($order_code){
		$this->membermanager->checkLogin();
		if(!isset($order_code)){
			redirect("store/".$this->router->fetch_class());
		}
		$orders = $this->model_saleitem->getOrderGroupByOrderCode($order_code);
		$this->PAGE['orders'] = $orders;
		$this->PAGE['order_code'] = $order_code;
		$this->load->view("store/orderinfo_view",$this->PAGE);
	}
}