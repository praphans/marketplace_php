<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends MX_Controller { 
	
	public $PAGE;
	public function __construct() {
        parent::__construct();
		$this->PAGE['title'] = 'ช่วยเหลือ | '.$this->load->get_var("default_title");
	
		$this->load->model('faq/model_faq');
		$this->utils->checkLogin();
	}
	
	public function myModalEditFaqBuy($faq_id){

		$faq = $this->model_faq->getFaqByID($faq_id);
		$this->PAGE['faq'] = $faq;
		$this->load->view('faq/modals/edit_buy_view',$this->PAGE);
	}
	public function myModalEditFaqSeller($faq_id){

		$faq = $this->model_faq->getFaqByID($faq_id);
		$this->PAGE['faq'] = $faq;
		$this->load->view('faq/modals/edit_seller_view',$this->PAGE);
	}

	public function faqBuyer()
	{
		$this->load->view("faqBuyer_view",$this->PAGE);
	}
	
	public function updateFaq(){

		$faq_id			= $this->input->post("faq_id"); 
		$faq_ask		= $this->input->post("faq_ask"); 
		$faq_ans		= $this->input->post("faq_ans"); 
		$faq_type		= $this->input->post("faq_type"); 
		$faq_category	= $this->input->post("faq_category"); 

		$data = array(
		'faq_ask' 		=>$faq_ask,
		'faq_ans' 		=>$faq_ans,
		'faq_category' 	=>$faq_category,

	    );
		$this->db->where("faq_id",$faq_id);
		$this->db->update("faq",$data);
		if($faq_type == 1){
			redirect("faq/faqBuyer");
		}else{
			redirect("faq/faqSeller");
		}
	}

	public function saveFaq(){

		$faq_ask		= $this->input->post("faq_ask"); 
		$faq_ans		= $this->input->post("faq_ans"); 
		$faq_type		= $this->input->post("faq_type"); 
		$faq_category	= $this->input->post("faq_category"); 

		$data = array(
		'faq_ask' 		=>$faq_ask,
		'faq_ans' 		=>$faq_ans,
		'faq_type' 		=>$faq_type,
		'faq_category' 	=>$faq_category,

	    );

		$this->db->insert('faq', $data);
		if($faq_type == 1){
			redirect("faq/faqBuyer");
		}else{
			redirect("faq/faqSeller");
		}
	}
	
	public function faqSeller()
	{
		$this->load->view("faqSeller_view",$this->PAGE);
	}
	public function faqCategory()
	{
		$this->load->view("faqCategory_view",$this->PAGE);
	}
	public function saveCat(){

		$category_name		= $this->input->post("category_name"); 
		$category_index		= $this->input->post("category_index"); 


		$data = array(
			'category_name' 		=>$category_name,
			'category_index' 		=>$category_index,
	    );

		$this->db->insert('faq_category', $data);
		redirect("faq/faqCategory");
	}

	public function myModalEditfaqCat($faq_cat_id){

		$faqCat = $this->model_faq->getfaqCategoryByID($faq_cat_id);
		$this->PAGE['faqCat'] = $faqCat;
		$this->load->view('faq/modals/edit_cat_view',$this->PAGE);
	}

	public function updateCat(){

		$faq_cat_id		= $this->input->post("faq_cat_id"); 
		$category_name		= $this->input->post("category_name"); 
		$category_index		= $this->input->post("category_index"); 


		$data = array(
			'category_name' 		=>$category_name,
			'category_index' 		=>$category_index,
	    );

		$this->db->where("id",$faq_cat_id);
		$this->db->update("faq_category",$data);
		redirect("faq/faqCategory");
	}

	public function delFaqCatagory($faq_cat_id){
		$this->db->where('id', $faq_cat_id);
		$this->db->delete('faq_category');
		redirect("faq/faqCategory");
	}

	
}
