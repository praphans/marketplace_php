<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends MX_Controller {

	public $PAGE;
	public function __construct() {
        parent::__construct();
		$this->PAGE['title'] = ' คำถามที่พบบ่อย | '.$this->load->get_var("default_title");
		$this->load->model("model_faq");
	}
	public function index()
	{
		redirect("faq/user");
	}
	
	public function user($faq_category_id = 1)
	{
		$faq_category = $this->model_faq->getFaqCategoryByFaqType(1);
		$faqs = $this->model_faq->getFaq(1,$faq_category_id);
		$this->PAGE['faqs'] = $faqs;
		$this->PAGE['current_faq_category_id'] = $faq_category_id;
		$this->PAGE['faq_category'] = $faq_category;
		$this->load->view("faq_user_view",$this->PAGE);	
	}
	public function store($faq_category_id = 1)
	{
		$faq_category = $this->model_faq->getFaqCategoryByFaqType(2);
		$faqs = $this->model_faq->getFaq(2,$faq_category_id);
		$this->PAGE['faqs'] = $faqs;
		$this->PAGE['current_faq_category_id'] = $faq_category_id;
		$this->PAGE['faq_category'] = $faq_category;
		$this->load->view("faq_store_view",$this->PAGE);	
	}
}