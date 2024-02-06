<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promo_website extends MX_Controller { 
	
	public $PAGE;
	public function __construct() { 
        parent::__construct();
		$this->PAGE['title'] = 'โปรโมชั่น | '.$this->load->get_var("default_title");
	
		$this->load->model('promotions/model_promotions');
		$this->utils->checkLogin();
	}
	
	public function myModalEditPromoWeb($promo_id){
		$product_promo_web = $this->model_promotions->getPromoWebByID($promo_id);
		$this->PAGE['product_promo_web'] = $product_promo_web;
		$this->load->view('promotions/modals/edit_promo_website_view',$this->PAGE);
	}

	public function firstPromoWebsite()
	{
		$this->load->view("promo_website_view",$this->PAGE);
	}
	
	public function add_promo_website(){
		
		$promo_name = $this->input->post("promo_name");
		$promo_url = $this->input->post("promo_url");
		$promotions_image = $this->utils->upload_multiple_file("../uploads/promotion/","promotions_image",$_FILES['promo_image'],800,600,TRUE);

		$data = array(
			"promo_name"=>$promo_name,
			"promo_url"=>$promo_url,
		);

		$this->db->insert("promotion",$data);
		$promo_id = $this->db->insert_id();
		if(!empty($promotions_image))
		{
			for($i=0;$i<count($promotions_image);$i++)
			{
				$promo_image = $promotions_image[$i];
				$promo_image = str_replace("../","",$promo_image);
				$this->db->set("promo_image",$promo_image);
				$this->db->where("promo_id",$promo_id);
				$this->db->update("promotion");
			}
		}
		redirect("promotions/promo_website/firstPromoWebsite","refresh");
	}
	public function update_promo_web(){
		
		$promo_id = $this->input->post("promo_id");
		$promo_name = $this->input->post("promo_name");
		$promo_url = $this->input->post("promo_url");

	
		$promotions_image = $this->utils->upload_multiple_file("../uploads/promotion/","promotions_image",$_FILES['promo_image'],800,600,TRUE);

		$data = array(
			"promo_name"=>$promo_name,
			"promo_url"=>$promo_url,

		);
	
		$this->db->where("promo_id",$promo_id);
		$this->db->update("promotion",$data);
		if(!empty($promotions_image)){
			for($i=0;$i<count($promotions_image);$i++)
			{
				$promo_image = $promotions_image[$i]; 
				$promo_image = str_replace("../","",$promo_image);
				$this->db->set("promo_image",$promo_image);
				$this->db->where("promo_id",$promo_id);
				$this->db->update("promotion");
			}
		}

		redirect("promotions/promo_website/firstPromoWebsite","refresh");
	}

	
}
