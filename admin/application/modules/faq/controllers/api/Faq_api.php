<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq_api extends MX_Controller {
	
	public $PAGE;
	public function __construct() {
        parent::__construct();
		$this->load->model('faq/model_faq');
		$this->utils->checkLogin();
	}

	public function getFaqBuy()
	{

		$faq_cat_id = $this->input->post("faq_cat_id");
		$faq_arr = array();
        $faq_arr['data'] = array();
		$faq = $this->model_faq->getFaqBuy($faq_cat_id);
        if(!empty($faq)):
			foreach($faq as $row):	
				$faq_id = $row->faq_id;
				$faq_ask = $row->faq_ask;
				$faq_ans = $row->faq_ans;
				$faq_type = $row->faq_type;
				$faq_category = $row->faq_category;
				$timestamp = $row->timestamp;
				
				$faq_category_result = $this->model_faq->getFaqCategoryByID($faq_category);
				if(count($faq_category_result)>0){
					$category_name = $faq_category_result[0]->category_name;
				}else{
					$category_name ="ไม่ระบุ";
				}

				$thaiDate = $this->utils->getThaiDate($timestamp);

				$checkbox = '<input type="checkbox" id="category_'.$faq_id.'" value="'.$faq_id.'" faq_id="'.$faq_id.'" class="filled-in chk-col-light-green del_buy"><label for="category_'.$faq_id.'" class="chk-mps"></label>';

				$edit_btn = '<button type="button" onClick="loadModalEditBuy('.$faq_id.');" id="edit" class="btn btn-warning text-light btn-block mdi mdi-pencil"> แก้ไข</button>';

				// รูปแบบ: wordwrap(ข้อความ,ความกว้างสูงสุด, แท็กขึ้นบรรทัดใหม่, การตัดคำ)
				$new_ask = wordwrap($faq_ask,45, "<br>", true);
				$new_ans = wordwrap($faq_ans,45, "<br>", true);

				$faq_arr['data'][] = array(
					$checkbox,
					$thaiDate,
					$faq_ask,
					$faq_ans,
					$category_name,
					$edit_btn,
				);
			
            endforeach;
        endif;
        $json = json_encode($faq_arr);
		echo $json;
	}
	

	// delete data
	public function deleteFaq(){
		$faq_id  = $this->input->post("faq_id");
		$this->db->where('faq_id', $faq_id);
		$result = $this->db->delete('faq');
		if($result){
			$success = 1;
			echo $success ;
		}else{
			$success = 0;
			echo $success ;
		}
		$respond = array('success' => $success);
	}

	public function getFaqSeller()
	{

		$faq_cat_id = $this->input->post("faq_cat_id");
		$faq_arr = array();
        $faq_arr['data'] = array();
		$faq = $this->model_faq->getFaqSeller($faq_cat_id);
        if(!empty($faq)):
			foreach($faq as $row):	
				$faq_id = $row->faq_id;
				$faq_ask = $row->faq_ask;
				$faq_ans = $row->faq_ans;
				$faq_type = $row->faq_type;
				$faq_category = $row->faq_category;
				$timestamp = $row->timestamp;
				
				$faq_category_result = $this->model_faq->getFaqCategoryByID($faq_category);
				if(count($faq_category_result)>0){
					$category_name = $faq_category_result[0]->category_name;
				}else{
					$category_name ="ไม่ระบุ";
				}

				$thaiDate = $this->utils->getThaiDate($timestamp);

				$checkbox = '<input type="checkbox" id="category_'.$faq_id.'" value="'.$faq_id.'" faq_id="'.$faq_id.'" class="filled-in chk-col-light-green del_seller"><label for="category_'.$faq_id.'" class="chk-mps"></label>';

				$edit_btn = '<button type="button" onClick="loadModalEditSeller('.$faq_id.');" id="edit" class="btn btn-warning text-light btn-block mdi mdi-pencil"> แก้ไข</button>';
				// รูปแบบ: wordwrap(ข้อความ,ความกว้างสูงสุด, แท็กขึ้นบรรทัดใหม่, การตัดคำ)
				$new_ask = wordwrap($faq_ask,45, "<br/>n", true);
				$new_ans = wordwrap($faq_ans,45, "<br/>n", true);

				$faq_arr['data'][] = array(
					$checkbox,
					$thaiDate,
					$faq_ask,
					$faq_ans,
					$category_name,
					$edit_btn,
				);
			
            endforeach;
        endif;
        $json = json_encode($faq_arr);
		echo $json;
	}

	public function getfaqCategory()
	{

		$faqCategory_arr = array();
        $faqCategory_arr['data'] = array();
		$faqCategory = $this->model_faq->getfaqCategory();
        if(!empty($faqCategory)):
			foreach($faqCategory as $row):
				$faq_cat_id 	= $row->id;
				$faq_cat_name  = $row->category_name;
				$category_index  = $row->category_index;
				
				$not_del = 1;
				$faq_arr = array();
				$faq_result = $this->model_faq->getCatArr();
				foreach($faq_result as $row){
					$faq_category = $row->faq_category; 
					array_push($faq_arr,$faq_category);
				}
				$faq_id = implode(",", $faq_arr);

				$join_faq_arr = explode(",",$faq_id);
				if(in_array($faq_cat_id, $join_faq_arr)){
					$not_del = 0;
					
				}


				$checkbox = '<input type="checkbox" id="category_'.$faq_cat_id.'" value="'.$faq_cat_id.'" faq_cat_id="'.$faq_cat_id.'" not_del="'.$not_del.'" class="filled-in chk-col-light-green chx_del_cat"><label for="category_'.$faq_cat_id.'" class="chk-mps"></label>';
	
				$edit_btn = '<button type="button" onClick="loadModalEditCat('.$faq_cat_id.');" id="edit" class="btn btn-warning text-light btn-block mdi mdi-pencil"> แก้ไข</button>'; 
				$index = '<input type="text" name="category_index" pattern="[0,1,2,3,4,5,6,7,8,9]" value="'.$category_index.'" class="form-control text-center" readonly>';
				$edit_del = '<button type="button" name="del_faq_cat" value="'.$faq_cat_id.'" class="btn btn-danger text-light btn-block mdi mdi-delete-empty" onClick="delCat('.$faq_cat_id.','.$not_del.');"> ลบหมวดหมู่</button>';

				$faqCategory_arr['data'][] = array(
					// $checkbox,
					$faq_cat_name,
					$index,
					$edit_btn,
					$edit_del,
					
				);
               
            endforeach;
        endif;
        $json = json_encode($faqCategory_arr);
		echo $json;
	}

	// delete data
	public function deleteCat(){
		$faq_cat_id  = $this->input->post("faq_cat_id");
		$this->db->where('id', $faq_cat_id);
		$result = $this->db->delete('faq_category');
		if($result){
			$success = 1;
			echo $success ;
		}else{
			$success = 0;
			echo $success ;
		}
		$respond = array('success' => $success);
	}


	
}
