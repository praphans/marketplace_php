<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends MX_Controller { 
	
	public $PAGE;	
	public function __construct() {
        parent::__construct();
		$this->PAGE['title'] = 'หมวดหมู่ | '.$this->load->get_var("default_title");

		$this->load->model('category/model_store_category');
		$this->load->model('category/model_product_category');
		$this->load->model('category/model_product_subcategory');
		$this->load->helper(array('form', 'url'));
		$config['upload_path'] = 'uploads';
		$config['allowed_types'] = 'svg|gif|jpg|png'; 
		$config['encrypt_name'] = TRUE;
		$this->utils->checkLogin();
		$this->load->library('upload', $config);
	}
	
	public function myModalAddstore(){
	
		$this->load->view('category/modals/add_store_category_view');	
	}
	public function myModalEditstore($id){
		$store = $this->model_store_category->getStoreCategoryByID($id);
		$this->PAGE['store'] = $store;
		$this->load->view("category/modals/edit_store_category_view",$this->PAGE);
	}

	public function myModalAddproduct(){
	
		$this->load->view('category/modals/add_product_category_view');	
	}
	
	public function myModalEditproduct($id){
	
		$product = $this->model_product_category->getProductCategoryByID($id);
		$this->PAGE['product'] = $product;
		$this->load->view("category/modals/edit_product_category_view",$this->PAGE);
	}

	public function myModalAddProductSubcategory(){
	
		$sub_product = $this->model_product_subcategory->getProductCategory();
		$this->PAGE['sub_product'] = $sub_product;
		$this->load->view('category/modals/add_product_subcategory_view',$this->PAGE);
	}
	public function myModalEditproductSubcategory($id){
		
		$product_sub = $this->model_product_subcategory->getProductSubcategoryByID($id);
		$this->PAGE['product_sub'] = $product_sub;
		$this->load->view("category/modals/edit_product_subcategory_view",$this->PAGE);
	}
	public function store_category()
	{
		
		$this->load->view("store_category_view",$this->PAGE);
	}
	
	public function add_store(){
		
		$category_name = $this->input->post("category_name");
	
		$data = array(
			"category_name"=>$category_name,
			"category_status"=>1
		);
		$this->db->insert("store_category",$data);
		redirect("category/store_category","refresh");
	}
	public function update_store(){
		
		$id = $this->input->post("id");
		$category_name = $this->input->post("category_name");
		
		
		$data = array(
			"category_name"=>$category_name,
			"category_status"=>1
		);
		$this->db->where("id",$id);
		$this->db->update("store_category",$data);
		redirect("category/store_category","refresh");
	}

	public function product_category(){
		$this->load->view('category/product_category_view',$this->PAGE);
	}
	
	public function add_product(){
	
		$category_name = $this->input->post("category_name");
		$category_image = $this->utils->upload_multiple_file("../uploads/products/","category_image",$_FILES['category_image'],1140,385,TRUE);

		$data = array(
			"category_name"=>$category_name
		);
		$this->db->insert("product_category",$data);
		$category_id = $this->db->insert_id();

		if(!empty($category_image))
		{
			for($i=0;$i<count($category_image);$i++)
			{
				$cate_image = $category_image[$i];
				$cate_image = str_replace("../","",$cate_image);
				$this->db->set("category_image",$cate_image);
				$this->db->where("id",$category_id);
				$this->db->update("product_category");
			}
		}

		redirect("category/product_category","refresh");
	}

	public function update_product(){
	
		$id = $this->input->post("id");

		$category_name = $this->input->post("category_name");
		$category_image = $this->utils->upload_multiple_file("../uploads/products/","category_image",$_FILES['category_image'],1140,385,TRUE);
		$data = array(
			"category_name"=>$category_name
		);
		$this->db->where("id",$id);
		$this->db->update("product_category",$data);

		if(!empty($category_image))
		{
			for($i=0;$i<count($category_image);$i++)
			{
				$cate_image = $category_image[$i];
				$cate_image = str_replace("../","",$cate_image);
				$this->db->set("category_image",$cate_image);
				$this->db->where("id",$id);
				$this->db->update("product_category");
			}
		}
		
		redirect("category/product_category","refresh");
	}
	public function product_subcategory(){
	
		$this->load->view('category/product_subcategory_view',$this->PAGE);
	}
	public function add_product_subcategory(){
	
	 	$category_name = $this->input->post("category_name");
		$category_id = $this->input->post("category_id");
		$category_image = $this->utils->upload_multiple_file("../uploads/products/","category_image",$_FILES['category_image'],1140,385,TRUE);
		$data = array(
			"category_id"=>$category_id,
			"category_name"=>$category_name
		);
		$this->db->insert("product_subcategory",$data); 
		$sub_category_id = $this->db->insert_id();

		if(!empty($category_image))
		{
			for($i=0;$i<count($category_image);$i++)
			{
				$cate_image = $category_image[$i];
				$cate_image = str_replace("../","",$cate_image);
				$this->db->set("category_image",$cate_image);
				$this->db->where("id",$sub_category_id);
				$this->db->update("product_subcategory");
			}
		}
		redirect("category/product_subcategory","refresh");
	}
	public function update_product_subcategory(){
	
		$id = $this->input->post("id");
		$category_name = $this->input->post("category_name");
		$category_id = $this->input->post("category_id");
		$category_image = $this->utils->upload_multiple_file("../uploads/products/","category_image",$_FILES['category_image'],1140,385,TRUE);

		$data = array(
			"category_name"=>$category_name,
			"category_id" => $category_id
		);
		$this->db->where("id",$id);
		$this->db->update("product_subcategory",$data);

		if(!empty($category_image))
		{
			for($i=0;$i<count($category_image);$i++)
			{
				$cate_image = $category_image[$i];
				$cate_image = str_replace("../","",$cate_image);
				$this->db->set("category_image",$cate_image);
				$this->db->where("id",$id);
				$this->db->update("product_subcategory");
			}
		}

		redirect("category/product_subcategory","refresh");
	}
	public function delStoreCatagory($id){
		$this->db->where('id', $id);
		$this->db->delete('store_category');
		redirect("category/store_category");
	}
	public function delProductCatagory($id){
		// print_r($id);
		// exit();
		$this->db->where('id', $id);
		$this->db->delete('product_category');
		redirect("category/product_category");
	}
	public function delSubCatagory($id){
		// print_r($id);
		// exit();
		$this->db->where('id', $id);
		$this->db->delete('product_subcategory');
		redirect("category/product_subcategory");
	}

	
}
