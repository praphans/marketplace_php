<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Popular extends MX_Controller { 
	
	public $PAGE;	
	public function __construct() {
        parent::__construct();
        $this->PAGE['title'] = 'สินค้า | '.$this->load->get_var("default_title");
		$this->load->model('popular/model_popular');

		$this->load->helper(array('form', 'url'));

		$config['upload_path'] = 'uploads';
		$config['allowed_types'] = 'svg|gif|jpg|png'; 
		$config['encrypt_name'] = TRUE;
		$this->utils->checkLogin();
		$this->load->library('upload', $config);
	}
	public function index(){
		$this->load->view('popular_view',$this->PAGE);

	}
	public function update_popular(){
		$product_id = $this->input->post("product_id");
		$product_point = $this->input->post("product_point");

		for($i=0;$i<count($product_point);$i++){

			$product_point_val = $product_point[$i];
			$product_id_val = $product_id[$i];
			$data = array(
				"product_point"		=>$product_point_val,
			);
			$this->db->where("product_id",$product_id_val);
			$this->db->update("product",$data);
		}
		
		redirect("popular","refresh");
	}

	


	
}
