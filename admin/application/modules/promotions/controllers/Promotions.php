<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Promotions extends MX_Controller { 
	
	public $PAGE;
	public function __construct() { 
        parent::__construct();
		$this->PAGE['title'] = 'โปรโมชั่น | '.$this->load->get_var("default_title");
	
		$this->load->model('promotions/model_promotions');
		$this->utils->checkLogin();
	}
	
	public function myModalAddPromotions(){
		$this->load->view('promotions/modals/add_promotion_view');	
	}
	public function myModalEditPromotions($join_id){
		$product_promo_join = $this->model_promotions->getPromotionsByID($join_id);
		$this->PAGE['product_promo_join'] = $product_promo_join;
		$this->load->view('promotions/modals/edit_promotion_view',$this->PAGE);
	}
	public function firstPromotions()
	{
		$this->load->view("promotions_view",$this->PAGE);
	}
	
	public function add_promotions(){
		
		$join_name = $this->input->post("join_name");
		// $join_price = $this->input->post("join_price");
		$join_startdate = $this->input->post("join_startdate");
		$join_starttime = $this->input->post("join_starttime");
		$join_enddate = $this->input->post("join_enddate");
		$join_endtime = $this->input->post("join_endtime");
		
		$promotions_image = $this->utils->upload_multiple_file("../uploads/promotion/","promotions_image",$_FILES['join_image'],800,800,TRUE);

		$data = array(
			"join_name"=>$join_name,
			// "join_price"=>$join_price,
		
			"join_startdate"=>$join_startdate,
			"join_starttime"=>$join_starttime,
			"join_enddate"=>$join_enddate,
			"join_endtime"=>$join_endtime,
			"join_status"=>1
		);

		$this->db->insert("product_promo_join",$data);
		$join_id = $this->db->insert_id();
		if(!empty($promotions_image))
		{
			for($i=0;$i<count($promotions_image);$i++)
			{
				$join_image = $promotions_image[$i];
				$join_image = str_replace("../","",$join_image);
				$this->db->set("join_image",$join_image);
				$this->db->where("join_id",$join_id);
				$this->db->update("product_promo_join");
			}
		}
		redirect("promotions/firstPromotions","refresh");
	}
	public function update_promotions(){
		
		$join_id = $this->input->post("join_id");
		$join_name = $this->input->post("join_name");
		// $join_price = $this->input->post("join_price");
		$join_startdate = $this->input->post("join_startdate");
		$join_starttime = $this->input->post("join_starttime");
		$join_enddate = $this->input->post("join_enddate");
		$join_endtime = $this->input->post("join_endtime");
	
		$promotions_image = $this->utils->upload_multiple_file("../uploads/promotion/","promotions_image",$_FILES['join_image'],800,600,TRUE);

		$data = array(
			"join_name"=>$join_name,
			// "join_price"=>$join_price,
			"join_startdate"=>$join_startdate,
			"join_starttime"=>$join_starttime,
			"join_enddate"=>$join_enddate,
			"join_endtime"=>$join_endtime,
		);
	
		$this->db->where("join_id",$join_id);
		$this->db->update("product_promo_join",$data);
		if(!empty($promotions_image)){
			for($i=0;$i<count($promotions_image);$i++)
			{
				$join_image = $promotions_image[$i]; 
				$join_image = str_replace("../","",$join_image);
				$this->db->set("join_image",$join_image);
				$this->db->where("join_id",$join_id);
				$this->db->update("product_promo_join");
			}
		}

		redirect("promotions/firstPromotions","refresh");
	}
	public function promotionsStore($join_id)
	{
		$this->PAGE['join_id'] = $join_id;
		$this->load->view("permission_store_view",$this->PAGE);
	}

	
}
