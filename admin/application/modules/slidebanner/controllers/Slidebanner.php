<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slidebanner extends MX_Controller { 
	
	public $PAGE;
	public function __construct() {
        parent::__construct();
		$this->PAGE['title'] = 'ข่าวสาร |'.$this->load->get_var("default_title");
		$this->load->model('slidebanner/model_slidebanner');
		$this->utils->checkLogin();
	}
	public function index()
	{
		$this->load->view("slidebanner_view",$this->PAGE);
	}
	public function myModalAddSlidebanner(){
		$this->load->view('slidebanner/modals/add_slidebanner_view',$this->PAGE);	
	}
	public function myModalEditSlidebanner($banner_id){
	
		$slidebanner_result = $this->model_slidebanner->getSlidebannerByID($banner_id);
		$this->PAGE['slidebanner_result'] = $slidebanner_result;
		$this->load->view("slidebanner/modals/edit_slidebanner_view",$this->PAGE);
	}
	public function add_slidebanner(){
		
		$banner_name = $this->input->post("banner_name");
		$banner_hyperlink = $this->input->post("banner_hyperlink");
		$banner_url = $this->utils->upload_multiple_file("../uploads/banner","banner_url",$_FILES['banner_url'],1140,385,TRUE);

		$data = array(
			"banner_name"=>$banner_name,
			"banner_hyperlink"=>$banner_hyperlink,
		);

		$this->db->insert("banner",$data);
		$banner_id = $this->db->insert_id();
		if(!empty($banner_url))
		{
			for($i=0;$i<count($banner_url);$i++)
			{
				$banner_image = $banner_url[$i];
				$banner_image = str_replace("../","",$banner_image);
				$this->db->set("banner_url",$banner_image);
				$this->db->where("banner_id",$banner_id);
				$this->db->update("banner");
			}
		}
		redirect("slidebanner","refresh");
	}

	public function edit_slidebanner(){
		
		$banner_id = $this->input->post("banner_id");
		$banner_name = $this->input->post("banner_name");
		$banner_hyperlink = $this->input->post("banner_hyperlink");
		$banner_url = $this->utils->upload_multiple_file("../uploads/banner","banner_url",$_FILES['banner_url'],1140,385,TRUE);

		$data = array(
			"banner_name"=>$banner_name,
			"banner_hyperlink"=>$banner_hyperlink,
		);

		$this->db->where('banner_id',$banner_id);
		$this->db->update("banner",$data);
		if(!empty($banner_url))
		{
			for($i=0;$i<count($banner_url);$i++)
			{
				$banner_image = $banner_url[$i];
				$banner_image = str_replace("../","",$banner_image);
				$this->db->set("banner_url",$banner_image);
				$this->db->where("banner_id",$banner_id);
				$this->db->update("banner");
			}
		}
		redirect("slidebanner","refresh");
	}
	
	
}
