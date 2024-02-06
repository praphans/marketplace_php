<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Product extends MX_Controller{

	public $PAGE;
	public function __construct() { 
	
		parent::__construct(); 
		
		$this->PAGE['title'] = 'สินค้าทั้งหมด | '.$this->load->get_var("default_title");
		$this->load->model("model_product");
		$this->load->model("model_review");
		$this->load->model("shop/model_shop");
		
	}
	public function index($page_number = 0,$main_category_id = 0,$sub_category_id = 0)
	{
		$featured = $this->input->get("featured");
		$keyword = $this->utils->shareClean($this->input->get("keyword"));
		$amphur_id = $this->input->get("amphur");
		/*$post = $this->input->post();
		$total_rows = $this->model_product->getProductTotalRows2($keyword,$amphur_id);
		
		
		$url = base_url('product/');
		$this->load->library('pagination');
		$config['base_url'] = $url;
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page = 12;
		
		
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
		$config['page_query_string'] = FALSE;
		$config['query_string_segment'] = 'page';
		$config['use_page_numbers'] = TRUE;
		$this->pagination->initialize($config);
		
		$this->PAGE['product'] = $product = $this->model_product->getProductList2($post,$main_category_id,$sub_category_id,$per_page,$page_number,$keyword,$amphur_id);
		$pages = ceil($total_rows/$per_page);
		$min_page = ($page_number+1);
		$max_page = count($product);
		$max_page = $min_page+($max_page-1);
		$this->PAGE['page_showing'] = 'แสดง '.$min_page.' ถึง '.$max_page.' จาก '.$total_rows.' รายการ ( '.$pages.' หน้า )';
		$this->PAGE['pagination'] = $this->pagination->create_links();*/
		
		//echo $amphur_id."<br>";
		if(isset($amphur_id))$this->session->set_userdata("current_amphur_id",$amphur_id);
		//echo $this->session->userdata("current_amphur_id");
		$this->PAGE['current_featured'] = $featured;
		$this->PAGE['current_amphur_id'] = $amphur_id;
		$this->PAGE['current_keyword'] = $keyword;
		$this->PAGE['current_main_category_id'] = $main_category_id;
		$this->PAGE['current_sub_category_id'] = $sub_category_id;
		//$this->PAGE['main_category_name'] = $main_category_name;
		
		$this->load->view("product_view",$this->PAGE);	
	}
	
}