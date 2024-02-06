<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slidebanner_api extends MX_Controller {
	
	public $PAGE;
	public function __construct() {
        parent::__construct();
		$this->load->model('slidebanner/model_slidebanner');
		$this->utils->checkLogin();
	}

	public function getSlidebanner()
	{
		$slidebanner_arr = array();
        $slidebanner_arr['data'] = array();
		$slidebanner = $this->model_slidebanner->getSlidebanner();
        if(!empty($slidebanner)):
			foreach($slidebanner as $row):
				$banner_id = $row->banner_id;
				$banner_name = $row->banner_name;
				$banner_url = $row->banner_url;
				$banner_hyperlink = $row->banner_hyperlink;

				$link = '<a href="'.$banner_hyperlink.'">'.$banner_hyperlink.'</a>';

				$checkbox = '<input type="checkbox" id="banner_'.$banner_id.'" value="'.$banner_id.'" class="filled-in chk-col-light-green del_banner"><label for="banner_'.$banner_id.'" class="chk-mps "></label>';
				// $images =  '<img src="'.base_url('../'.$banner_url).'" width="100" />';
				$images = ' <a data-title="ชื่อรูปภาพ : '.$banner_name.'" class="example-image-link zoom-in" href="'.base_url('../'.$banner_url).'" data-lightbox="example-1"><img class="example-image" src="'.base_url('../'.$banner_url).'" width="100"  /></a>';

				$edit_btn = '<button type="button" onClick="loadModalEdit('.$banner_id.');" id="edit" class="btn btn-warning text-light btn-block mdi mdi-pencil"> แก้ไข</button>';
				$slidebanner_arr['data'][] = array(
					$checkbox,
					$banner_name,
					$link,
					$images,
					$edit_btn,
				);
               
            endforeach;
        endif;
        $json = json_encode($slidebanner_arr);
		echo $json;
	}

	// delete data
	public function deleteBanner(){
		
		$banner_id  = $this->input->post("banner_id");
		$this->db->where('banner_id', $banner_id);
		$this->db->delete('banner');
	}
	
	
}
