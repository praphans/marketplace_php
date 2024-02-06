<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_api extends MX_Controller {

	public $PAGE;
	public function __construct() {
        parent::__construct();
		$this->load->model("shop/model_shop");
		$this->load->model("model_product");
	}
	
	public function getProduct(){
		
		$keyword = $this->input->post("keyword");
		$amphur_id = $this->input->post("amphur");
		$featured = $this->input->post("featured");
		
		if(!isset($amphur_id) || $amphur_id == "")$amphur_id = $this->session->userdata("current_amphur_id");
		
		//echo "amphur_id : ".$amphur_id;
		
		$store_id_list = $this->input->post("store_id_list");
		$view_page_number = $this->input->post("view_page_number");
		$view_per_page = $this->input->post("view_per_page");
		$main_category_id = $this->input->post("main_category_id");
		$sub_category_id = $this->input->post("sub_category_id");
		$new_product = $this->input->post("new_product");
		
		$service_delivery = $this->input->post("service_delivery");
		$second_hand_product = $this->input->post("second_hand_product");
		$is_delivery = $this->input->post("is_delivery");
		$no_delivery = $this->input->post("no_delivery");
		$gateway_type_1 = $this->input->post("gateway_type_1");
		$gateway_type_2 = $this->input->post("gateway_type_2");
		$gateway_type_3 = $this->input->post("gateway_type_3");
		
		if(!isset($view_page_number)) $view_page_number = 0;
		if(!isset($view_per_page)) $view_per_page = 20;
		
		$post = $this->input->post();
		
		$total_rows = $this->model_product->getProductTotalRows2($post,$keyword,$amphur_id);
		$this->load->library('pagination');
		$config['base_url'] = base_url('product/'.$main_category_id.'/'.$sub_category_id.'/');
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page = $view_per_page;
		
		
		
		
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
		
		
		
		$this->PAGE['products'] = $products = $this->model_product->getProductList2($post,$main_category_id,$sub_category_id,$per_page,$view_page_number,$keyword,$amphur_id);
		
		
		
		$pages = ceil($total_rows/$per_page);
		$config['num_links'] = $pages;
		$this->pagination->initialize($config);
		
		$min_page = ($view_page_number+1);
		$max_page = count($products);
		$max_page = $min_page+($max_page-1);
		$this->PAGE['page_showing'] = 'แสดง '.$min_page.' ถึง '.$max_page.' จาก '.$total_rows.' รายการ ( '.$pages.' หน้า )';
		$this->PAGE['pagination'] = $this->pagination->create_links();
		$this->PAGE['total_result'] = number_format($total_rows);
		//echo $this->PAGE['pagination']."<br>";
		//echo "view_page_number : ".$view_page_number."<br>";
		//echo "total_rows : ".$total_rows."<br>";
		//echo "products : ".count($products)."<br>";
		
		$this->load->view("product/load/product_load",$this->PAGE);
	}
	
}