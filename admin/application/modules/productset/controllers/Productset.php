<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productset extends MX_Controller { 
	
	public $PAGE;	
	public function __construct() {
        parent::__construct();
        $this->PAGE['title'] = 'สินค้า | '.$this->load->get_var("default_title");
		$this->load->model('productset/model_productset');
		// $this->load->model('product/model_shop');
		// $this->load->model('product/model_setting');
		// $this->load->model('product/model_productmanager');
		$this->load->library('productset/productset_libs');

		$this->load->helper(array('form', 'url'));

		$config['upload_path'] = 'uploads';
		$config['allowed_types'] = 'svg|gif|jpg|png'; 
		$config['encrypt_name'] = TRUE;
		$this->utils->checkLogin();
		$this->load->library('upload', $config);
	}
	public function index($store_id = 0){

		$this->PAGE['store_id'] = (isset($store_id))?$store_id:0;
		$this->load->view('productset_view',$this->PAGE);

	}

	public function productDescription($product_id)
	{
		$this->PAGE['title'] = 'รายละเอียดสินค้า | marketplace ';
		$product_discription = $this->model_productset->getproductDescriptByID($product_id);
		
		$this->PAGE['product_discription'] = $product_discription;

		$this->load->view("productset_description_view",$this->PAGE);
	
	}

	public function verify($product_id,$store_id = 0){
		$this->db->set("product_status",3);
		$this->db->where("product_id",$product_id);
		$this->db->update("product");
		redirect("productset");
	}
	public function blocks($product_id,$store_id = 0){
		$this->db->set("product_status",4);
		$this->db->where("product_id",$product_id);
		$this->db->update("product");
		redirect("productset");
	}
	public function notblocks($product_id,$store_id = 0){
		$this->db->set("product_status",2);
		$this->db->where("product_id",$product_id);
		$this->db->update("product");
		redirect("productset");
	}
	// public function myModalSetFeature(){
	// 	$product_id_list = $this->input->post("product_id_list");
	// 	$this->PAGE['product_id_list'] = $product_id_list;
	// 	$this->load->view('productset/modals/set_feature_productset_view',$this->PAGE);
	// }

	// public function updateSetFeature(){
	// 	$product_id_list = $this->input->post("product_id_list");
	// 	$product_featured = $this->input->post("product_featured");

	// 	 for($i=0; $i < count($product_id_list); $i++) { 
	// 	 	$product_id = $product_id_list[$i];
	// 		$data = array(
 //            	'product_featured'  => $product_featured,
	//         );
	// 	 	 $this->db->where('product_id',$product_id);
	// 	 	 $this->db->update('product', $data);
	// 	}
	// 	redirect("productset","refresh");
	// }

	public function myModalSetFeature2($product_id,$product_featured){
		$this->PAGE['product_id'] = $product_id;
		$this->PAGE['product_featured'] = $product_featured;
		$this->load->view('productset/modals/set_feature_productset2_view',$this->PAGE);
	}
	public function updateSetFeature2(){
		$product_id = $this->input->post("product_id");
		$product_featured = $this->input->post("product_featured");

		$this->db->set('product_featured',$product_featured);
		$this->db->where('product_id',$product_id);
		$this->db->update('product');
		redirect("productset","refresh");
	}

	
	
}
