<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends MX_Controller {

	public $PAGE;
	public function __construct() {
        parent::__construct();
		$this->PAGE['title'] = 'หมวดหมู่ร้านค้า | '.$this->load->get_var("default_title");
		$this->load->model("model_category"); 
		$this->load->model("model_shop"); 
	}
	public function index()
	{
		
		
		/*$page_number = ($this->uri->segment(2) != '')?$this->uri->segment(2):0; 
		$category_id = ($this->uri->segment(3) != '')?$this->uri->segment(3):0; 
		
		$total_rows = $this->model_category->getShopCategoryTotalRows($category_id);
		$this->load->library('pagination');
		$config['base_url'] = base_url('shop/');
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page = 2;
		
		
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
		
		
		$this->PAGE['shop'] = $shop = $this->model_category->getShopCategoryList($page_number,$per_page,$category_id);
		$pages = ceil($total_rows/$per_page);
		$min_page = ($page_number+1);
		$max_page = count($shop);
		$max_page = $min_page+($max_page-1);
		$this->PAGE['page_showing'] = 'แสดง '.$min_page.' ถึง '.$max_page.' จาก '.$total_rows.' รายการ ( '.$pages.' หน้า )';
		$this->PAGE['pagination'] = $this->pagination->create_links();*/
		
		$category_id = ($this->uri->segment(3) != '')?$this->uri->segment(3):0; 
		$this->PAGE['category_id'] = $category_id;
		$this->PAGE['category'] = $this->model_shop->getCategory();
		$this->PAGE['shop_recommend'] = $this->model_shop->getShopRecommendList($category_id,10);
		$this->load->view("category_view",$this->PAGE);	
	}
}