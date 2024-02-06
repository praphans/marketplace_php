<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends MX_Controller {

	public $PAGE;
	public function __construct() { 
        parent::__construct();
		$this->PAGE['title'] = 'ร้านค้า | '.$this->load->get_var("default_title");
		$this->load->model("model_shop");
		$this->load->model("model_review");
		$this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
		$this->load->library('user_agent');
	}
	public function index()
	{
		
		$page_number = ($this->uri->segment(2) != '')?$this->uri->segment(2):0; 
		
		
		$total_rows = $this->model_shop->getShopTotalRows();
		$this->load->library('pagination');
		$config['base_url'] = base_url('shop/');
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
		$this->PAGE['category'] = $this->model_shop->getCategory();
		$this->PAGE['shop_recommend'] = $this->model_shop->getShopRecommendList(0,10);
		
		
		$this->PAGE['shop'] = $shop = $this->model_shop->getShopList($page_number,$per_page);
		$pages = ceil($total_rows/$per_page);
		$min_page = ($page_number+1);
		$max_page = count($shop);
		$max_page = $min_page+($max_page-1);
		$this->PAGE['page_showing'] = 'แสดง '.$min_page.' ถึง '.$max_page.' จาก '.$total_rows.' รายการ ( '.$pages.' หน้า )';
		$this->PAGE['pagination'] = $this->pagination->create_links();
		
		$this->load->view("shop_view",$this->PAGE);	
	}
	
	public function market_product(){
		
		$store_url = ($this->uri->segment(1) != '')?$this->uri->segment(1):0; 
		$category_id = ($this->uri->segment(2) != '')?$this->uri->segment(2):0; 
		$subcategory_id = ($this->uri->segment(3) != '')?$this->uri->segment(3):0; 
		
		$mystore = $this->model_shop->getShopByStoreURL($store_url);
		$store_id = (count($mystore)>0)?$mystore[0]->store_id:0;
		
		
		//$this->db->set("store_view",store_view);
		//$view_token = $this->cache->get('view_token');
		//echo 'view_token : '.$view_token;
		/*if (!$view_token = $this->cache->get('view_store_token') &&){
			$this->cache->save('view_store_token', $store_id, 80);
			$this->db->set('store_view','store_view + '.(int) 1, FALSE);
			$this->db->where("store_id",$store_id);
			$this->db->update("store");
		}*/
		
		
		
		if(!isset($store_id) || $store_id == 0){
			redirect('home');	
		}
		$this->viewLog($store_id);
		$page_number = ($this->uri->segment(4) != '')?$this->uri->segment(4):0; 
		$total_rows = $this->model_shop->getProductTotalRows($category_id,$subcategory_id,$store_id);
		
		
		
		$this->load->library('pagination');
		$config['base_url'] = base_url();
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
		
		$this->PAGE['product_recommend'] = $this->model_shop->getRecommendProductList($store_id,10);
		$this->PAGE['product'] = $product = $this->model_shop->getProductList($category_id,$subcategory_id,$store_id,$page_number,$per_page);
		
		$pages = ceil($total_rows/$per_page);
		$min_page = ($page_number+1);
		$max_page = count($product);
		$max_page = $min_page+($max_page-1);
		$this->PAGE['page_showing'] = 'แสดง '.$min_page.' ถึง '.$max_page.' จาก '.$total_rows.' รายการ ( '.$pages.' หน้า )';
		$this->PAGE['pagination'] = $this->pagination->create_links();
		
		$this->PAGE['store_id'] = $store_id;
		$this->PAGE['category_id'] = $category_id;
		$this->PAGE['subcategory_id'] = $subcategory_id;
		
		$mystore = $this->model_shop->getShopByStoreURL($store_url);
		$this->PAGE['mystore'] = $mystore;
		$this->load->view("shop/shopview/shop_product",$this->PAGE);	
	}
	public function market_place(){
		$store_url = ($this->uri->segment(1) != '')?$this->uri->segment(1):0; 
		$mystore = $this->model_shop->getShopByStoreURL($store_url);
		
		
		
		$this->PAGE['mystore'] = $mystore;
		$this->load->view("shop/shopview/shop_place",$this->PAGE);	
	}
	public function market_review(){
		$store_url = ($this->uri->segment(1) != '')?$this->uri->segment(1):0; 
		$mystore = $this->model_shop->getShopByStoreURL($store_url);
		$this->PAGE['mystore'] = $mystore;
		$this->load->view("shop/shopview/shop_review",$this->PAGE);	
	}
	public function market_about(){
		$store_url = ($this->uri->segment(1) != '')?$this->uri->segment(1):0; 
		$mystore = $this->model_shop->getShopByStoreURL($store_url);
		$this->PAGE['mystore'] = $mystore;
		$this->load->view("shop/shopview/shop_about",$this->PAGE);	
	}
	
	public function addFollow($store_id){
		$this->membermanager->checkLogin();
		$member_id = $this->membermanager->member_id();
		
		if(isset($member_id) && isset($store_id) && !$this->membermanager->isMyFollowStore($store_id)){
			$this->db->set("store_id",$store_id);
			$this->db->set("member_id",$member_id);
			$this->db->insert("store_follow");
			
			
			
			$mystore = $this->model_shop->getShopByStoreID($store_id);
			if(count($mystore)){
				$store_url = $mystore[0]->store_url;
			}else{
				$store_url = "";
			}
		}else{
			$store_url = "";
		}
		$this->updateFollower($store_id);
		redirect($store_url);
	}
	
	public function unFollow($store_id){
		$this->membermanager->checkLogin();
		$member_id = $this->membermanager->member_id();
		
		if(isset($member_id) && isset($store_id) && $this->membermanager->isMyFollowStore($store_id)){
			$this->db->where("store_id",$store_id);
			$this->db->where("member_id",$member_id);
			$this->db->delete("store_follow");
			
			$mystore = $this->model_shop->getShopByStoreID($store_id);
			
			if(count($mystore)){
				$store_url = $mystore[0]->store_url;
			}else{
				$store_url = "";
			}
		}else{
			$store_url = "";
		}
		$this->updateFollower($store_id);
		redirect($store_url);
	}
	
	public function updateFollower($store_id){
		$this->db->select("store_id");
		$this->db->from("store_follow");
		$this->db->where("store_id",$store_id);
		$query = $this->db->get();
		$store_follower = $query->num_rows();
		
		$this->db->set("store_follower",$store_follower);
		$this->db->where("store_id",$store_id);
		$this->db->update("store");
	}
	public function productDetail($store_url,$category_name,$product_id,$product_name)
	{
		//$store_url = ($this->uri->segment(1) != '')?$this->uri->segment(1):0; 
		//$product_id = ($this->uri->segment(2) != '')?$this->uri->segment(2):0; 
		
		$mystore = $this->model_shop->getShopByStoreURL($store_url);
		$product = $this->model_shop->getProductByID($product_id);
		if(count($product) <= 0 || count($mystore) <= 0){
			redirect("home");
			exit();
		}
		$this->PAGE['category_name'] = $category_name;
		$this->PAGE['mystore'] = $mystore;
		$this->PAGE['product'] = $product;
		$this->load->view("product_detail_view",$this->PAGE);	
	}
	private function viewLog($store_id){
		if ($this->agent->is_browser()){
				$browser = $this->agent->browser().' '.$this->agent->version();
		}else if ($this->agent->is_robot()){
				$browser = $this->agent->robot();
		}else if ($this->agent->is_mobile()){
				$browser = $this->agent->mobile();
		}else{
				$browser = 'Unidentified User Agent';
		}
		$ip = $this->input->ip_address();
		$platform = $this->agent->platform();
		
		//echo $store_id."<br>";
		
		$query = $this->db->query("SELECT * FROM  store_view WHERE store_id = ".$store_id." AND DATE(timestamp) = CURDATE()");
		/*$this->db->select("store_id");
		$this->db->from("store_view");
		$this->db->where("store_id",$store_id);
		$this->db->where("DATE(timestamp)","CURDATE()");*/
		//$this->db->where('date_format(timestamp,"%Y-%m-%d")', 'CURDATE()', FALSE);
		//print_r($query->result());
		//$query = $this->db->get();
		//echo $this->db->last_query();
		//echo $query->num_rows();
		if($query->num_rows() <= 0){
			$this->db->set('ip',$ip);
			$this->db->set('browser',$browser);
			$this->db->set('platform',$platform);
			$this->db->set('store_id',$store_id);
			$this->db->insert("store_view");
			
			
			$this->db->select("store_id");
			$this->db->from("store_view");
			$this->db->where("store_id",$store_id);
			$query = $this->db->get();
			$store_view = $query->num_rows();
			$this->db->set('store_view',$store_view);
			$this->db->where('store_id',$store_id);
			$this->db->update("store");
		}
		//exit();
	}
	
}