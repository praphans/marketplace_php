<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feature_api extends MX_Controller {
	
	public $PAGE;
	public function __construct() {
        parent::__construct();
		$this->load->model('feature/model_feature');
		$this->utils->checkLogin();
	}

	public function getFeature()
	{
		$feature_arr = array();
        $feature_arr['data'] = array();
		$feature = $this->model_feature->getFeature();
        if(!empty($feature)):
			foreach($feature as $row):
				$featured_id 	= $row->id;
				$featured_name  = $row->featured_name;
				$featured_type  = $row->featured_type;
				$featured_image  = $row->featured_image;
				$starttime 		= $row->starttime;
				$endtime 		= $row->endtime;

				

				if(!empty($featured_image)){
					$images =  '<img src="'.base_url('../'.$featured_image).'" width="100" />';
				}else{
					$images =  '<img src="https://www.bormel-grice.com/sites/all/themes/riley_sub/img/nopicture.png" class="d-block"  width="100"/>';
				}

				$feature_type_result = $this->model_feature->getFeaturedTypeByID($featured_type);
				if(count($feature_type_result)>0){
					$type_name = $feature_type_result[0]->type_name;
				}else{
				 	$type_name = 0;
				}
				$checkbox = '<input type="checkbox" id="feature_'.$featured_id.'" value="'.$featured_id.'" class="filled-in chk-col-light-green chx_del_feature"><label for="feature_'.$featured_id.'" class="chk-mps "></label>';
				$edit_btn = '<button type="button" onClick="loadModalEdit('.$featured_id.');" id="edit" class="btn btn-warning text-light btn-block mdi mdi-pencil"> แก้ไข</button>'; 

				if($featured_type == 3){
					$newdate_str = "";
					$newdate_stp = "";
				}else{
					$newdate_str = date("d-m-Y H:i:s", strtotime($starttime));
					$newdate_stp = date("d-m-Y H:i:s", strtotime($endtime));
				}
				

				$feature_arr['data'][] = array(
					$checkbox,
					$featured_name,
					$type_name,
					$images,
					$newdate_str,
					$newdate_stp,
					$edit_btn,
				);
               
            endforeach;
        endif;
        $json = json_encode($feature_arr);
		echo $json;
	}
	
	// delete data
	public function deleteFeature(){
		
		$featured_id  = $this->input->post("featured_id");
		$this->db->where('id', $featured_id);
		$this->db->delete('product_featured');
	}
	
}
