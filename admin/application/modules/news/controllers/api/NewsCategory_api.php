<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NewsCategory_api extends MX_Controller {
	
	public $PAGE;
	public function __construct() {
        parent::__construct();
		$this->load->model('news/model_news_category');
		$this->utils->checkLogin();
	}

	public function getNewsCategory()
	{
		$news_category_arr = array();
        $news_category_arr['data'] = array();
		$news_category = $this->model_news_category->getNewsCategory();
        if(!empty($news_category)):
			foreach($news_category as $row):
				$id = $row->id;
				$category_name = $row->category_name;

				$not_del = 1;
				$category_arr = array();
				$category_result = $this->model_news_category->getCatArr();
				foreach($category_result as $row){
					$new_cate_id = $row->new_cate_id; 
					array_push($category_arr,$new_cate_id);
				}
				$category_id = implode(",", $category_arr);

				$join_category_arr = explode(",",$category_id);
				if(in_array($id, $join_category_arr)){
					$not_del = 0;
					
				}


				$checkbox = '<input type="checkbox" id="news_'.$id.'" value="'.$id.'" class="filled-in chk-col-light-green del_news"><label for="news_'.$id.'" class="chk-mps "></label>';
				$edit_btn = '<button type="button" onClick="loadModalEdit('.$id.');" id="edit" class="btn btn-warning text-light btn-block mdi mdi-pencil"> แก้ไข</button>'; 
				$edit_del = '<button type="button" name="del_faq_cat" value="'.$id.'" class="btn btn-danger text-light btn-block mdi mdi-delete-empty" onClick="delCat('.$id.','.$not_del.');"> ลบหมวดหมู่</button>';

				$news_category_arr['data'][] = array(
					// $checkbox,
					$category_name,
					$edit_btn,
					$edit_del,
				);
               
            endforeach;
        endif;
        $json = json_encode($news_category_arr);
		echo $json;
	}
	
	// delete data
	public function deleteNewsCategory(){
		
		$id  = $this->input->post("id");
		$this->db->where('id', $id);
		$this->db->delete('news_category');
	}
	
}
