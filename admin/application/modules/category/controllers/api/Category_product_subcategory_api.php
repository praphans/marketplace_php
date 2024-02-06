<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_product_subcategory_api extends MX_Controller {
	
	public $PAGE;
	public function __construct() {
        parent::__construct();
		$this->load->model('category/model_product_subcategory');
		$this->utils->checkLogin();
	}

	public function getProductSubcategory()
	{
	/* 	$this->utils->checkLogin(); */
		$settings_arr = array();
        $settings_arr['data'] = array();
		$product_subcategory = $this->model_product_subcategory->getProductSubcategoryCategory();

        if(!empty($product_subcategory)):
			foreach($product_subcategory as $row):
				$id = $row->id;
				$category_name = $row->category_name;
				$category_id = $row->category_id;
				$category_image = $row->category_image;

				$not_del = 1;
				$sub_arr = array();
				$sub_result = $this->model_product_subcategory->getCatArr();
				foreach($sub_result as $row){
					$product_subcategory = $row->product_subcategory; 
					array_push($sub_arr,$product_subcategory);
				}
				$sub_id = implode(",", $sub_arr);

				$join_sub_arr = explode(",",$sub_id);
				if(in_array($id, $join_sub_arr)){
					$not_del = 0;
					
				}

				if(!empty($category_image)){
					$images =  '<img src="'.base_url('../'.$category_image).'" width="100" />';
				}else{
					$images =  '<img src="https://www.bormel-grice.com/sites/all/themes/riley_sub/img/nopicture.png" class="d-block"  width="100"/>';
				}
				
				$product = $this->model_product_subcategory->getProductCategoryByID($category_id);
				$product_name = " -";
				if(count($product)>0){
					$product_name = $product[0]->category_name;
				}
				$checkbox = '<input type="checkbox" id="category_'.$id.'" value="'.$id.'" class="filled-in chk-col-light-green del_product"><label for="category_'.$id.'" class="chk-mps "></label>';
				$edit_btn = '<button type="button" onClick="loadModalEdit('.$id.');" id="edit" class="btn btn-warning text-light btn-block mdi mdi-pencil"> แก้ไข</button>';
				$edit_del = '<button type="button" name="del_faq_cat" value="'.$id.'" class="btn btn-danger text-light btn-block mdi mdi-delete-empty" onClick="delCat('.$id.','.$not_del.');"> ลบหมวดหมู่</button>';


				$settings_arr['data'][] = array(
					// $checkbox,
					$product_name,
					$category_name,
					$images,
					$edit_btn,
					$edit_del,
				);
               
            endforeach;
        endif;
        $json = json_encode($settings_arr);
		echo $json;
	}
	
	// delete data
	public function DeleteProductSubcategory(){
		$id  = $this->input->post("id");

		$this->db->where('id', $id);
		$this->db->delete('product_subcategory');
	}

	
}
