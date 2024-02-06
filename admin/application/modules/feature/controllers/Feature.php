<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feature extends MX_Controller { 
	
	public $PAGE;
	public function __construct() {
        parent::__construct();
		$this->PAGE['title'] = 'Feature สินค้า |'.$this->load->get_var("default_title");
		$this->load->model('feature/model_feature');
		$this->utils->checkLogin();
	}
	public function myModalEditFeature($featured_id){
		$featured = $this->model_feature->getFeaturedByID($featured_id);
		$this->PAGE['featured'] = $featured;
		$this->load->view('feature/modals/edit_feature_view',$this->PAGE);
	}

	public function index()
	{
		$this->load->view("feature_view",$this->PAGE);
	}

	public function add_feature(){
		
		$featured_name = $this->input->post("featured_name");
		$featured_type = $this->input->post("featured_type");

		$startdate = $this->input->post("startdate");
		$starttime = $this->input->post("starttime");

		$enddate = $this->input->post("enddate");
		$endtime = $this->input->post("endtime");

		$startdate_feature = $startdate." ".$starttime;
		$enddate_feature = $enddate." ".$endtime;

		$newdate_str = date("Y-m-d H:i:s", strtotime($startdate_feature));
		$newdate_stp = date("Y-m-d H:i:s", strtotime($enddate_feature));

		$featured_image = $this->utils->upload_multiple_file("../uploads/products/","featured_image",$_FILES['featured_image'],1140,385,TRUE);
		
		$data = array(
			"featured_name"=>$featured_name,
			"featured_type"=>$featured_type,
			"starttime"=>$newdate_str,
			"endtime"=>$newdate_stp,
		);

		$this->db->insert("product_featured",$data);
		$featured_id = $this->db->insert_id();
		if(!empty($featured_image))
		{
			for($i=0;$i<count($featured_image);$i++)
			{
				$feat_image = $featured_image[$i];
				$feat_image = str_replace("../","",$feat_image);
				$this->db->set("featured_image",$feat_image);
				$this->db->where("id",$featured_id);
				$this->db->update("product_featured");
			}
		}
		
		redirect("feature","refresh");
	}
	public function update_feature(){
		
		$featured_id = $this->input->post("featured_id");
		$featured_name = $this->input->post("featured_name");
		$featured_type = $this->input->post("featured_type");
		$startdate = $this->input->post("startdate");
		$starttime = $this->input->post("starttime");
		$enddate = $this->input->post("enddate");
		$endtime = $this->input->post("endtime");

		$enddate_feature = $enddate." ".$endtime;
		$startdate_feature = $startdate." ".$starttime;
		$newdate_str = date("Y-m-d H:i:s", strtotime($startdate_feature));
		$newdate_stp = date("Y-m-d H:i:s", strtotime($enddate_feature));
		
		$featured_image = $this->utils->upload_multiple_file("../uploads/products/","featured_image",$_FILES['featured_image'],1140,385,TRUE);

		$data = array(
			"featured_name"=>$featured_name,
			"featured_type"=>$featured_type,
			// "endtime"=>$enddate_feature,
		);
		$this->db->where("id",$featured_id);
		$this->db->update("product_featured",$data);

		if(!empty($startdate)){
			$date = array(
				"starttime"=>$newdate_str,
			);
			$this->db->where("id",$featured_id);
			$this->db->update("product_featured",$date);
		}
		if(!empty($enddate)){
			$datatime = array(
				"endtime"=>$newdate_stp,
			);
			$this->db->where("id",$featured_id);
			$this->db->update("product_featured",$datatime);
		}

		if(!empty($featured_image))
		{
			for($i=0;$i<count($featured_image);$i++)
			{
				$feat_image = $featured_image[$i];
				$feat_image = str_replace("../","",$feat_image);
				$this->db->set("featured_image",$feat_image);
				$this->db->where("id",$featured_id);
				$this->db->update("product_featured");
			}
		}
		

		// print_r("featured_name || ".$featured_name."<br>");
		// print_r("featured_type || ".$featured_type."<br>");
		// print_r("enddate_feature || ".$enddate_feature."<br>");
		// exit();

		
		
		redirect("feature","refresh");
	}


	
}
