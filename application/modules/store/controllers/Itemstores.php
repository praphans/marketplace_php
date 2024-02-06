<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Itemstores extends MX_Controller {   

	public $PAGE;
	public function __construct() {
        parent::__construct();
		
		$this->PAGE['title'] = 'รายการระหว่างร้านค้า | '.$this->load->get_var("default_title");
		$this->membermanager->checkLogin();
		
		$this->load->model('model_itemstores');
		
		
		$this->load->helper(array('form', 'url'));
		$config['upload_path'] = 'uploads';
		$config['allowed_types'] = 'svg|gif|jpg|png|doc|doc'; 
		$config['encrypt_name'] = TRUE;
		$this->load->library('upload', $config);
		$this->storemanager->hasStore();
	}
	public function index()
	{
		redirect("store/itemstores/order/all");
	}
	public function order($filter = "all")
	{
		$seller_store_id = $this->storemanager->store_id();
		
		$post = $this->input->post();
		$page_number = ($this->uri->segment(5) != '')?$this->uri->segment(5):0; 
		
		$total_rows = $this->model_itemstores->getOrderTotalRows($seller_store_id,$post);
		
		$this->load->library('pagination');
		$config['base_url'] = base_url('store/itemstores/order/'.$filter.'/');
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page = 5;
		
		
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
		
		$this->pagination->initialize($config);
		
		if($filter == "all"){
			$orders = $this->model_itemstores->getOrderByMemberID($seller_store_id,$page_number,$per_page,$post);
		}else if($filter == "creditor"){ // เจ้าหนี้
			$orders = $this->model_itemstores->getOrderMyPlaceByMemberID($seller_store_id,$page_number,$per_page,$post);
		}else if($filter == "debtor"){ // ลูกหนี้
			$orders = $this->model_itemstores->getOrderOtherPlaceByMemberID($seller_store_id,$page_number,$per_page,$post);
		}
		
	
		$this->PAGE['orders'] = $orders;
		
		$pages = ceil($total_rows/$per_page);
		$min_page = ($page_number+1);
		$max_page = count($orders);
		$max_page = $min_page+($max_page-1);
		$this->PAGE['page_showing'] = 'แสดง '.$min_page.' ถึง '.$max_page.' จาก '.$total_rows.' รายการ ( '.$pages.' หน้า )';
		$this->PAGE['pagination'] = $this->pagination->create_links();
		
		$this->PAGE['post'] = $post;
		$this->PAGE['current_store_id'] = $seller_store_id;
		$this->PAGE['filter'] = $filter;
		$this->load->view("store/4_".$this->router->fetch_class()."/itemstores_view",$this->PAGE);
	}
	public function info($depositor_store_id){
		$seller_store_id = $this->storemanager->store_id();
		
		$store_name = "-";
		$store = $this->model_itemstores->getStoreByID($depositor_store_id);
		if(count($store)){
			$store_name = $store[0]->store_name;	
		}
		
		$page_number = ($this->uri->segment(5))?$this->uri->segment(5):0; 
		//if($page_number == '')redirect(base_url('store/itemstores/info/'.$depositor_store_id.'/0'));
		if(!isset($page_number))$page_number = 0;
		$total_rows = $this->model_itemstores->getInfoOrderTotalRows($seller_store_id,$depositor_store_id);
		
		$this->load->library('pagination');
		$config['base_url'] = base_url('store/itemstores/info/'.$depositor_store_id.'/'.$page_number);
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page = 20;
		//$config['page_number'] = $page_number;
		//$config['uri_segment'] = $this->uri->segment(5);
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
		
		
		
		$orders = $this->model_itemstores->getInfoOrderByMemberID($seller_store_id,$page_number,$per_page,$depositor_store_id);
		
	
		
		$this->PAGE['orders'] = $orders;
		
		$pages = ceil($total_rows/$per_page);
		$min_page = ($page_number+1);
		$max_page = count($orders);
		$max_page = $min_page+($max_page-1);
		$this->PAGE['page_showing'] = 'แสดง '.$min_page.' ถึง '.$max_page.' จาก '.$total_rows.' รายการ ( '.$pages.' หน้า )';
		$this->PAGE['pagination'] = $this->pagination->create_links();
		
		$this->PAGE['seller_store_id'] = $seller_store_id;
		$this->PAGE['current_store_id'] = $seller_store_id;
		$this->PAGE['store_name'] = $store_name;
		$this->PAGE['depositor_store_id'] = $depositor_store_id;
		$this->load->view("store/4_".$this->router->fetch_class()."/itemstores_info_view",$this->PAGE);
	}
	public function orderinfo($order_code){
		
		if(!isset($order_code)){
			redirect("store/".$this->router->fetch_class());
		}
		$orders = $this->model_saleitem->getOrderGroupByOrderCode($order_code);
		$this->PAGE['orders'] = $orders;
		$this->PAGE['order_code'] = $order_code;
		$this->load->view("store/orderinfo_view",$this->PAGE);
	}
	public function accountpayment(){
		$amount = $this->input->post("amount");
		$seller_store_id = $this->input->post("seller_store_id");
		$depositor_store_id = $this->input->post("depositor_store_id");
		
		
		// insert สำหรับ seller
		$this->db->set("order_code","-");
		$this->db->set("depositor_store_id",$depositor_store_id);
		$this->db->set("seller_store_id",$seller_store_id);
		$this->db->set("amount",-$amount);
		$this->db->set("tran_type",4); // ประเภทค่าฝากส่ง
		$this->db->set("tran_status",0); 
		$this->db->insert("store_transaction");
		
		
		// insert สำหรับ depositor
		$this->db->set("order_code","-");
		$this->db->set("depositor_store_id",$seller_store_id);
		$this->db->set("seller_store_id",$depositor_store_id);
		$this->db->set("amount",$amount);
		$this->db->set("tran_type",4); // ประเภทค่าฝากส่ง
		$this->db->set("tran_status",0); 
		$this->db->insert("store_transaction");
		
		
	    redirect("store/itemstores/info/".$seller_store_id);
		//$this->updateAmountTotal($seller_store_id,$depositor_store_id);
					
	}
	
	public function confirmPayment($tran_id){
		
		$this->db->select("*");
		$this->db->from("store_transaction");
		$this->db->where("tran_id",$tran_id);
		$query = $this->db->get();
		$result = $query->result();
		foreach($result as $row){
			$seller_store_id = $row->seller_store_id;	
			$depositor_store_id = $row->depositor_store_id;	
		}
		
		$this->db->set("tran_status",1); 
		$this->db->where("tran_id",$tran_id);
		$this->db->update("store_transaction");
		
		$this->db->set("tran_status",1); 
		$this->db->where("tran_id",$tran_id+1);
		$this->db->update("store_transaction");
		
		$this->updateAmountTotal($seller_store_id,$depositor_store_id);
		redirect("store/itemstores/info/".$depositor_store_id);
	}
	private function updateAmountTotal($seller_store_id,$depositor_store_id){
		// update seller
		$this->db->select("*");
		$this->db->select_sum("amount");
		$this->db->from("store_transaction");
		$this->db->where("seller_store_id",$seller_store_id);
		$this->db->where("depositor_store_id",$depositor_store_id);
		$this->db->where("tran_status",1);
		$this->db->group_by("depositor_store_id");
		$this->db->order_by("timestamp","DESC");
		$this->db->limit(1);
		$query = $this->db->get();
		$result = $query->result();
		foreach($result as $row){
			$amount = $row->amount;	
		}
		if(count($result) > 0){
		$this->db->set("amount_total",$amount);
		$this->db->where("seller_store_id",$seller_store_id);
		$this->db->where("depositor_store_id",$depositor_store_id);
		$this->db->update("store_transaction");
		}
		// update depositor
		$this->db->select("*");
		$this->db->select_sum("amount");
		$this->db->from("store_transaction");
		$this->db->where("seller_store_id",$depositor_store_id);
		$this->db->where("depositor_store_id",$seller_store_id);
		$this->db->where("tran_status",1);
		$this->db->group_by("depositor_store_id");
		$this->db->order_by("timestamp","DESC");
		$this->db->limit(1);
		$query = $this->db->get();
		$result = $query->result();
		foreach($result as $row){
			$amount = $row->amount;	
		}
		if(count($result) > 0){
		$this->db->set("amount_total",$amount);
		$this->db->where("depositor_store_id",$seller_store_id);
		$this->db->where("seller_store_id",$depositor_store_id);
		$this->db->update("store_transaction");
		}
		
	}
	
}