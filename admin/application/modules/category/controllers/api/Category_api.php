<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_api extends MX_Controller {
	
	public $PAGE;
	public function __construct() {
        parent::__construct();
		$this->load->model('category/model_store_category');
		$this->utils->checkLogin();
	}

	public function getStore()
	{
	/* 	$this->utils->checkLogin(); */
		$settings_arr = array();
        $settings_arr['data'] = array();
		$store = $this->model_store_category->getStoreCategory();
        if(!empty($store)):
			foreach($store as $row):
				$category_name = $row->category_name;
				$id = $row->id;

				$not_del = 1;
				$store_arr = array();
				$store_result = $this->model_store_category->getCatArr();
				foreach($store_result as $row){
					$store_category = $row->store_category; 
					array_push($store_arr,$store_category);
				}
				$store_id = implode(",", $store_arr);

				$join_store_arr = explode(",",$store_id);
				if(in_array($id, $join_store_arr)){
					$not_del = 0;
					
				}

				$checkbox = '<input type="checkbox" id="category_'.$id.'" value="'.$id.'" class="filled-in chk-col-light-green del_store"><label for="category_'.$id.'" class="chk-mps "></label>';
				$edit_btn = '<button type="button" onClick="loadModalEdit('.$id.');" id="edit" class="btn btn-warning text-light btn-block mdi mdi-pencil"> แก้ไข</button>';
				$edit_del = '<button type="button" name="del_faq_cat" value="'.$id.'" class="btn btn-danger text-light btn-block mdi mdi-delete-empty" onClick="delCat('.$id.','.$not_del.');"> ลบหมวดหมู่</button>';

				$settings_arr['data'][] = array(
					// $checkbox,
					$category_name,
					$edit_btn,
					$edit_del,
				);
               
            endforeach;
        endif;
        $json = json_encode($settings_arr);
		echo $json;
	}
	
	// delete data
	public function deletestore(){
		$id  = $this->input->post("id");
		$this->db->where('id', $id);
		$this->db->set('category_status', 2);
		$result = $this->db->update('store_category');
		if($result){
			$success = 1;
		}else{
			$success = 0;
		}
		$respond = array('success' => $success);
	}
	
}
