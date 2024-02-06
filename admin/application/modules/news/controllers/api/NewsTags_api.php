<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NewsTags_api extends MX_Controller {
	
	public $PAGE;
	public function __construct() {
        parent::__construct();
		$this->load->model('news/model_news_tags');
		$this->utils->checkLogin();
	}

	public function getNewsTags()
	{
		$news_tags_arr = array();
        $news_tags_arr['data'] = array();
		$news_tags = $this->model_news_tags->getNewsTags();
        if(!empty($news_tags)):
			foreach($news_tags as $row):
				$tag_id = $row->tag_id;
				$tag_name = $row->tag_name;


				$checkbox = '<input type="checkbox" id="news_'.$tag_id.'" value="'.$tag_id.'" class="filled-in chk-col-light-green del_news"><label for="news_'.$tag_id.'" class="chk-mps "></label>';
				$edit_btn = '<button type="button" onClick="loadModalEdit('.$tag_id.');" id="edit" class="btn btn-warning text-light btn-block mdi mdi-pencil"> แก้ไข</button>'; 

				$news_tags_arr['data'][] = array(
					$checkbox,
					$tag_name,
					$edit_btn
				);
               
            endforeach;
        endif;
        $json = json_encode($news_tags_arr);
		echo $json;
	}
	
	// delete data
	public function deleteNewsTags(){
		
		$id  = $this->input->post("id");
		$this->db->where('tag_id', $id);
		$this->db->delete('news_tags');
	}
	
}
