<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends MX_Controller {   

	public $PAGE;
	public function __construct() {
        parent::__construct();
		
		$this->PAGE['title'] = 'จัดการหมวดหมู่ร้านค้า | '.$this->load->get_var("default_title");
		$this->membermanager->checkLogin();
		$this->load->helper(array('form', 'url'));
		$config['upload_path'] = 'uploads';
		$config['allowed_types'] = 'svg|gif|jpg|png|doc|doc'; 
		$config['encrypt_name'] = TRUE;
		$this->load->library('upload', $config);
		$this->load->model('model_category');
	}
	public function index($page_number = 0)
	{
		
		$page_number = ($this->uri->segment(3) != '')?$this->uri->segment(3):0; 
		$total_rows = $this->model_category->getCategoryTotalRows();
		
		
		$this->load->library('pagination');
		$config['base_url'] = base_url('store/category/');
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page = 20;
		
		
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
		
		$this->PAGE['categorys'] = $products = $this->model_category->getCategoryList($page_number,$per_page);
		$pages = ceil($total_rows/$per_page);
		$this->PAGE['page_showing'] = 'แสดง '.($page_number+1).' ถึง '.count($products).' จาก '.$total_rows.' รายการ ( '.$pages.' หน้า )';
		
		$this->PAGE['pagination'] = $this->pagination->create_links();
		$this->load->view("store/6_".$this->router->fetch_class()."/category_view",$this->PAGE);
	}
	public function addCategory(){
		$store_id = $this->storemanager->store_id();
		$category_name = $this->input->post("category_name");
		
		$this->db->set("category_name",$category_name);
		$this->db->set("category_status",1);
		$this->db->set("store_id",$store_id);
		$this->db->insert("product_category_customer");
		redirect("store/category");
	}
	
	
}