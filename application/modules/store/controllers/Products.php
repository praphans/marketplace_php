<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends MX_Controller {    

	public $PAGE;
	public function __construct() { 
        parent::__construct();
		
		$this->PAGE['title'] = 'จัดการสินค้า | '.$this->load->get_var("default_title");
		$this->membermanager->checkLogin();
		$this->load->helper(array('form', 'url'));
		$config['upload_path'] = 'uploads';
		$config['allowed_types'] = 'svg|gif|jpg|png|doc|doc'; 
		$config['encrypt_name'] = TRUE;
		
		$this->load->model("model_product");
		$this->load->library('upload', $config);
		$this->storemanager->hasStore();
	}
	public function index($page_number = 0)
	{
		
		$page_number = ($this->uri->segment(3) != '')?$this->uri->segment(3):0; 
		$total_rows = $this->model_product->getProductTotalRows();
		
		
		$this->load->library('pagination');
		$config['base_url'] = base_url('store/products/');
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
		
		$this->PAGE['products'] = $products = $this->model_product->getProductList($page_number,$per_page);
		$pages = ceil($total_rows/$per_page);
		
		$min_page = ($page_number+1);
		$max_page = count($products);
		$max_page = $min_page+($max_page-1);
		$this->PAGE['page_showing'] = 'แสดง '.$min_page.' ถึง '.$max_page.' จาก '.$total_rows.' รายการ ( '.$pages.' หน้า )';
		
		$this->PAGE['pagination'] = $this->pagination->create_links();
		$this->load->view("store/7_".$this->router->fetch_class()."/products_view",$this->PAGE);
	}
	public function add()
	{
		$this->load->view("store/7_".$this->router->fetch_class()."/products_add_view",$this->PAGE);
	}
	public function edit($product_id)
	{
		$products = $this->model_productmanager->getProductByID($product_id);
		
		
		if($products[0]->store_id != $this->storemanager->store_id()){
			redirect("home");
			exit();
		}
		$this->PAGE['products'] = $products;
		$this->load->view("store/7_".$this->router->fetch_class()."/products_edit_view",$this->PAGE);
	}
	public function editRelate($product_id)
	{
		$products = $this->model_productmanager->getProductByID($product_id);
		
		
		if($products[0]->store_id != $this->storemanager->store_id()){
			redirect("home");
			exit();
		}
		$this->PAGE['products'] = $products;
		$this->load->view("store/7_".$this->router->fetch_class()."/products_edit_relate_view",$this->PAGE);
	}
	public function setting($product_id)
	{
		$store_id = $this->storemanager->store_id();
		$products = $this->model_productmanager->getProductByID($product_id);
		if($products[0]->store_id != $this->storemanager->store_id()){
			redirect("home");
			exit();
		}
		$promotions_normal = $this->model_productmanager->getPromoByProductID($product_id,1); // โปรโมชั่นปกติ
		$promotions_special = $this->model_productmanager->getPromoByProductID($product_id,2); // โปรโมชั่นร่วม
		$promotions_join = $this->model_productmanager->getPromoJoin($store_id);
		
		// ไม่มีโปรโมชั่นอยู่ให้ใส่โปรโมชั่นว่าง ๆ ไว้ 1 อัน
		
									
		if(!count($promotions_normal)){
			$promo = new stdClass();
			$promo->promo_id = 0;
			$promo->relate_id = 0;
			$promo->promo_name = "";
			$promo->promo_price = 0;
			$promo->promo_startdate = "";
			$promo->promo_starttime = "00:00";
			$promo->promo_enddate = "";
			$promo->promo_endtime = "00:00";
			array_push($promotions_normal,$promo);
		}
		$this->PAGE['products'] = $products;
		$this->PAGE['promotions_normal'] = $promotions_normal;
		$this->PAGE['promotions_special'] = $promotions_special;
		$this->PAGE['promotions_join'] = $promotions_join;
		$this->load->view("store/7_".$this->router->fetch_class()."/products_setting_view",$this->PAGE);
	}
	public function settingRelate($product_id)
	{
		

		$store_id = $this->storemanager->store_id();
		$products = $this->model_productmanager->getProductByID($product_id);
		if($products[0]->store_id != $this->storemanager->store_id()){
			redirect("home");
			exit();
		}
		$promotions_normal = $this->model_productmanager->getPromoByProductID($product_id,1); // โปรโมชั่นปกติ
		$promotions_special = $this->model_productmanager->getPromoByProductID($product_id,2); // โปรโมชั่นร่วม
		$promotions_join = $this->model_productmanager->getPromoJoin($store_id);
		
		// ไม่มีโปรโมชั่นอยู่ให้ใส่โปรโมชั่นว่าง ๆ ไว้ 1 อัน
		
									
		if(!count($promotions_normal)){
			$promo = new stdClass();
			$promo->promo_id = 0;
			$promo->relate_id = 0;
			$promo->promo_name = "";
			$promo->promo_price = 0;
			$promo->promo_startdate = "";
			$promo->promo_starttime = "00:00";
			$promo->promo_enddate = "";
			$promo->promo_endtime = "00:00";
			array_push($promotions_normal,$promo);
		}
		$this->PAGE['products'] = $products;
		$this->PAGE['promotions_normal'] = $promotions_normal;
		$this->PAGE['promotions_special'] = $promotions_special;
		$this->PAGE['promotions_join'] = $promotions_join;
		$this->load->view("store/7_".$this->router->fetch_class()."/products_relate_setting_view",$this->PAGE);
	}
	public function createProduct(){
		$product_data = $this->input->post();
		$product_data['store_id'] = $this->storemanager->store_id();
		$product_data['product_show'] = 1;
		$product_image = $this->utils->upload_multiple_file("uploads/products","product_image",$_FILES['product_image'],800,800,FALSE);
		
		$this->db->insert("product",$product_data);
		$product_id = $this->db->insert_id();
		
		$product_code = $this->utils->getSKUCode($product_id);
		$this->db->set("product_code",$product_code);
		$this->db->where("product_id",$product_id);
		$this->db->update("product");
		
		for($i=0;$i<count($product_image);$i++){
			$image_url = $product_image[$i];
			$this->db->set("product_id",$product_id);
			$this->db->set("image_url",$image_url);
			$this->db->insert("product_image");
		}
		redirect("store/products");
	}
	
	public function updateProduct(){
		$product_data = $this->input->post();
		$product_data['store_id'] = $this->storemanager->store_id();
		$product_id = $product_data['product_id'];
		unset($product_data['product_id']);
		$product_image = $this->utils->upload_multiple_file("uploads/products","product_image",$_FILES['product_image'],800,800,FALSE);
		
		if($product_data['relate_id'] != 0){
			$product_data['product_status'] = 3;
		}
		$this->db->where("product_id",$product_id);
		$this->db->update("product",$product_data);
		
		
		for($i=0;$i<count($product_image);$i++){
			$image_url = $product_image[$i];
			if(isset($image_url)){
				$this->db->set("product_id",$product_id);
				$this->db->set("image_url",$image_url);
				$this->db->insert("product_image");
			}
		}
		
		$product_name = $product_data['product_name'];
		if(count($product_image) && $product_image[0]){
			$product_image = $product_image[0];
			$this->db->set("product_image",$product_image);
		}
		$this->db->set("product_name",$product_name);
		$this->db->where("product_id",$product_id);
		$query2 = $this->db->update("cart");
		
		redirect("store/products");
	}
	
	/*สร้างตัวเลือกสินค้า*/
	
	
	public function relate($product_id)
	{
		$main_products = $this->model_productmanager->getProductByID($product_id);
		if($main_products[0]->store_id != $this->storemanager->store_id()){
			redirect("home");
			exit();
		}
		$page_number = ($this->uri->segment(5) != '')?$this->uri->segment(5):0; 
		$total_rows = $this->model_productmanager->getRelateProductTotalRowsByProductID($product_id);
		
		$this->load->library('pagination');
		$config['base_url'] = base_url('store/products/relate/');
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
		
		$this->PAGE['products'] = $products = $this->model_productmanager->getRelateProductList($product_id,$page_number,$per_page);
		$pages = ceil($total_rows/$per_page);
		$this->PAGE['page_showing'] = 'แสดง '.($page_number+1).' ถึง '.count($products).' จาก '.$total_rows.' รายการ ( '.$pages.' หน้า )';
		
		$this->PAGE['main_products'] = $main_products;
		$this->PAGE['main_product_id'] = $product_id;
		$this->PAGE['pagination'] = $this->pagination->create_links();
		$this->load->view("store/7_".$this->router->fetch_class()."/products_relate_view",$this->PAGE);
	}
	public function addrelate($main_product_id)
	{
		$main_products = $this->model_productmanager->getProductByID_as_array($main_product_id);
		
		if($main_products[0]['store_id'] != $this->storemanager->store_id()){
			redirect("home");
			exit();
		}
		// ก๊อปปี้สินค้าต้นแบบเพื่อทำ relate
		$main_products[0]['relate_id'] = $main_product_id;
		unset($main_products[0]['product_id']);
		//$this->db->insert("product",$main_products[0]);
		//$product_id = $this->db->insert_id();
		$relate_products = $this->model_productmanager->getProductByID($main_product_id);
		
		$this->PAGE['products'] = $relate_products;
		$this->load->view("store/7_".$this->router->fetch_class()."/products_addrelate_view",$this->PAGE);
	}
	
	public function insertrelateProduct(){
		$post = $this->input->post();
		$post['relate_id'] = $relate_id = $post['product_id'];
		$post['product_status'] = 3;
		unset($post['product_id']);
		$this->db->insert("product",$post);
		$product_id = $this->db->insert_id();
		
		$this->db->select("*");
		$this->db->from("product_image");
		$this->db->where("product_id",$relate_id);
		$images_list = $this->db->get();
		$images_list = $images_list->result();
		
		foreach($images_list as $row){
			$image_url = $row->image_url;
			$this->db->set("product_id",$product_id);
			$this->db->set("image_url",$image_url);
			$this->db->insert("product_image");
		}
		
		$product_image = $this->utils->upload_multiple_file("uploads/products","product_image",$_FILES['product_image'],800,800,FALSE);
		
		for($i=0;$i<count($product_image);$i++){
			$image_url = $product_image[$i];
			if(!empty($image_url)){
			$this->db->set("product_id",$product_id);
			$this->db->set("image_url",$image_url);
			$this->db->insert("product_image");
			}
		}
		
		redirect("store/products/relate/".$relate_id);
		
	}
	public function updaterelateProduct(){
		$product_id = $this->input->post('product_id');
		$relate_id = $this->input->post('relate_id');
		$product_name = $this->input->post('product_name');

		$this->db->set("product_name",$product_name);
		$this->db->where("product_id",$product_id);
		$this->db->update("product");

		redirect("store/products/relate/".$relate_id);
		
	}
	public function createSetting(){
		$indent = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		$setting_data = $this->input->post();
		$setting_data['store_id'] = $this->storemanager->store_id();
		
		foreach($setting_data as $key=>$value){
				
				if(is_array($value)){
					echo $key."<br>";
					foreach($value as $key2 => $value2){
						echo $indent."index ที่ ".$key2." = ".$value2."</span><br>";
					}
				}else{
					echo $key." = ".$value."<br>";
				}
		}
		//redirect("store/products");
	}
	
}