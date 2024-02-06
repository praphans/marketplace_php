<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wishlist extends MX_Controller {

	public $PAGE;
	public function __construct() {
        parent::__construct();
		$this->PAGE['title'] = 'รายการโปรด | '.$this->load->get_var("default_title");
		$this->load->model("shop/model_shop");
		$this->load->model("model_wishlist");
	}
	public function index()
	{
		redirect("wishlist/me");
	}
	public function me($main_category_id = 0,$sub_category_id = 0){
		
		$page_number = ($this->uri->segment(5) != '')?$this->uri->segment(5):0; 
		$post = array();
		$total_rows = $this->model_wishlist->getWishlistTotalRows($post);
		$this->load->library('pagination');
		$config['base_url'] = base_url('wishlist/me/'.$main_category_id.'/'.$sub_category_id.'/');
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page = 10;
		
		
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
		
		$this->PAGE['products'] = $products = $this->model_wishlist->getProductWishlist($post,$main_category_id,$sub_category_id,$per_page,$page_number);
		
		$pages = ceil($total_rows/$per_page);
		$min_page = ($page_number+1);
		$max_page = count($products);
		$max_page = $min_page+($max_page-1);
		$this->PAGE['page_showing'] = 'แสดง '.$min_page.' ถึง '.$max_page.' จาก '.$total_rows.' รายการ ( '.$pages.' หน้า )';
		$this->PAGE['pagination'] = $this->pagination->create_links();
		$this->PAGE['current_main_category_id'] = $main_category_id;
		$this->PAGE['current_sub_category_id'] = $sub_category_id;
		$this->load->view("wishlist/wishlist_view",$this->PAGE);
	}
	public function remove($wishlist_id){
		if($this->membermanager->isLoggedIn()){
			$member_id = $this->membermanager->member_id();
			$this->db->where("member_id",$member_id);
		}else{
			$sess_id = $this->session->userdata("sess_id");
			$this->db->where("sess_id",$sess_id);
		}
		$this->db->where("wishlist_id",$wishlist_id);
		$this->db->delete("wishlist");
		redirect("wishlist");
	}
	
}