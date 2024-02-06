<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News_api extends MX_Controller {
	
	public $PAGE;
	public function __construct() {
        parent::__construct();
		$this->load->model('news/model_news');
		$this->utils->checkLogin();
	}

	public function getNews()
	{
		$news_arr = array();
        $news_arr['data'] = array();
		$news = $this->model_news->getNews();
        if(!empty($news)):
			foreach($news as $row):
				$new_id = $row->new_id;
				$new_header = $row->new_header;
				$new_content = $row->new_content;
				$new_cate_id = $row->new_cate_id;
				$new_image = $row->new_image;
				$new_tags = $row->new_tags;

				$new_tags_arr = explode(",",$new_tags);

				$checkbox = '<input type="checkbox" id="news_'.$new_id.'" value="'.$new_id.'" class="filled-in chk-col-light-green del_news"><label for="news_'.$new_id.'" class="chk-mps "></label>';
				$edit_btn = '<button type="button" onClick="loadModalEdit('.$new_id.');" id="edit" class="btn btn-warning text-light btn-block mdi mdi-pencil"> แก้ไข</button>'; 

				$tag_name_arr = array();
				
				$news_result = $this->model_news->getNewsTageByID($new_tags_arr);
				foreach($news_result as $rown){

					$tag_name = $rown->tag_name; 
					array_push($tag_name_arr,$tag_name);
				}

				$tag_name = implode(",", $tag_name_arr);
		
				$new_cate_result = $this->model_news->getCategoryByID($new_cate_id);
				foreach($new_cate_result as $row){
					$category_name = $row->category_name; 
				}



				$new_content_str = iconv_substr($new_content, 0,30, "UTF-8")."...";

				$images =  '<img src="'.base_url('../'.$new_image).'" width="80" />';
				$news_arr['data'][] = array(
					$checkbox,
					$new_header,
					strip_tags($new_content_str),
					$category_name,
					$images,
					$tag_name,
					$edit_btn
				);
               
            endforeach;
        endif;
        $json = json_encode($news_arr);
		echo $json;
	}
	
	// delete data
	public function deletenews(){
		
		$id  = $this->input->post("id");
		$this->db->where('new_id', $id);
		$this->db->delete('news');
	}

	public function getMember()
	{
		$tags = $_GET['term'];
		if(isset($tags)) {
			$member = $this->model_news->getMember($tags);
			foreach ($member as $row){
				$arr_result[] = array(
					'member_id'     => $row->member_id,
                    'first_name'    => $row->first_name,
                    'last_name'     => $row->last_name,
                    'email'   		=> $row->email,
				);
			}
			echo json_encode($arr_result);
		}
	}
	
}
