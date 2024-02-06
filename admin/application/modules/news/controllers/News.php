<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends MX_Controller { 
	
	public $PAGE;
	public function __construct() {
        parent::__construct();
		$this->PAGE['title'] = 'ข่าวสาร |'.$this->load->get_var("default_title");
		$this->load->model('news/model_news');
		$this->load->model('news/model_news_category');
		$this->load->model('news/model_news_tags');
		$this->utils->checkLogin();
	}
	public function myModalAddNews(){
		$news_category = $this->model_news->getNewsCategory();
		$this->PAGE['news_category'] = $news_category;
		$this->load->view('news/modals/add_news_view',$this->PAGE);	
	}
	public function myModalEditNews($id){
		$news = $this->model_news->getNewsCategoryByID($id);
		$this->PAGE['news'] = $news;
		$this->load->view('news/modals/edit_news_view',$this->PAGE);
	}
	public function myModalAddNewsCategory(){
		$this->load->view('news/modals/add_news_category_view',$this->PAGE);	
	}
	public function myModalEditNewsCategory($id){
		$news_category = $this->model_news_category->getNewsCategoryByID($id);
		$this->PAGE['news_category'] = $news_category;
		$this->load->view('news/modals/edit_news_category_view',$this->PAGE);
	}
	public function myModalAddNewsTags(){
		$news_tags = $this->model_news_tags->getNewsTags();
		$this->PAGE['news_tags'] = $news_tags;
		$this->load->view('news/modals/add_news_tags_view',$this->PAGE);	
	}
	public function myModalEditNewsTags($tag_id){
		$news_tags = $this->model_news_tags->getNewsTagsByID($tag_id);
		$this->PAGE['news_tags'] = $news_tags;
		$this->load->view('news/modals/edit_news_tags_view',$this->PAGE); //**** */
	}
	public function firstNews()
	{
		$this->load->view("news_view",$this->PAGE);
	}
	public function firstNewsCategory()
	{
		$this->load->view("news_category_view",$this->PAGE);
	}
	public function firstNewsTags()
	{
		$this->load->view("news_tags_view",$this->PAGE);
	}
	public function add_news(){
		
		$new_header = $this->input->post("new_header");
		$new_content = $this->input->post("new_content");
		$new_tags = $this->input->post("new_tags");
		$new_cate_id = $this->input->post("category_id");
		
		$new_tags_arr = explode(",",$new_tags);
		$tag_id_arr = array();
		$tags_name_result = $this->model_news->getTagsIdByName($new_tags_arr);
		foreach($tags_name_result as $rown){
			$tag_id = $rown->tag_id; 
			array_push($tag_id_arr,$tag_id);
		}
		$tag_id = implode(",", $tag_id_arr);

		$news_image = $this->utils->upload_multiple_file("../uploads/news","news_image",$_FILES['new_image'],1200,600,TRUE);

		$data = array(
			"new_header"=>$new_header,
			"new_content"=>$new_content,
			"new_tags"=>$tag_id,
			"new_cate_id"=>$new_cate_id
		);

		// print_r("new_tags || ".$new_tags."<br>");
		// print_r("tag_id || ".$tag_id."<br>");
		// exit();

		$this->db->insert("news",$data);
		$new_id = $this->db->insert_id();
		if(!empty($news_image))
		{
			for($i=0;$i<count($news_image);$i++)
			{
				$new_image = $news_image[$i];
				$new_image = str_replace("../","",$new_image);
				$this->db->set("new_image",$new_image);
				$this->db->where("new_id",$new_id);
				$this->db->update("news");
			}
		}
		redirect("news/firstNews","refresh");
	}
	public function update_news(){
		
		$new_id = $this->input->post("new_id");
		$new_header = $this->input->post("new_header");
		$new_content = $this->input->post("new_content");
		$new_image = $this->input->post("new_image");
		$new_tags = $this->input->post("new_tags");
		$category_id = $this->input->post("category_id");
		$today = date("Y-m-d H:i:s");

		$new_tags_arr = explode(",",$new_tags);
		$tag_id_arr = array();
		$tags_name_result = $this->model_news->getTagsIdByName($new_tags_arr);
		foreach($tags_name_result as $rown){
			$tag_id = $rown->tag_id; 
			array_push($tag_id_arr,$tag_id);
		}
		$tag_id = implode(",", $tag_id_arr);
	
		$news_image = $this->utils->upload_multiple_file("../uploads/news","news_image",$_FILES['new_image'],1200,600,TRUE);

		$data = array(
			"new_header"=>$new_header,
			"new_content"=>$new_content,
			"new_cate_id"=>$category_id,
			"new_tags"=>$tag_id,
			"timestamp"=>$today,
		);
	
		$this->db->where("new_id",$new_id);
		$this->db->update("news",$data);
		if(!empty($news_image)){
			for($i=0;$i<count($news_image);$i++)
			{
				$new_image = $news_image[$i];
				$new_image = str_replace("../","",$new_image);
				$this->db->set("new_image",$new_image);
				$this->db->where("new_id",$new_id);
				$this->db->update("news");
			}
		}

		redirect("news/firstNews","refresh");
	}
	public function add_news_category(){
		$category_name = $this->input->post("category_name");

		$data = array(
			"category_name"=>$category_name
		);
		$this->db->insert("news_category",$data);
	
		redirect("news/firstNewsCategory","refresh");
	}
	public function update_news_category(){
		$category_name = $this->input->post("category_name");
		$id = $this->input->post("id");
		$today = date("Y-m-d H:i:s");

		$data = array(
			"category_name"=>$category_name,
			"timestamp"=>$today,
		);
		$this->db->where("id",$id);
		$this->db->update("news_category",$data);

		redirect("news/firstNewsCategory","refresh");
	}
	public function add_news_tags(){
		$tag_name = $this->input->post("tag_name");

		$data = array(
			"tag_name"=>$tag_name
		);
		$this->db->insert("news_tags",$data);
	
		redirect("news/firstNewsTags","refresh");
	}
	public function update_news_tags(){
		$tag_name = $this->input->post("tag_name");
		$tag_id = $this->input->post("tag_id");
		$today = date("Y-m-d H:i:s");

		$data = array(
			"tag_name"=>$tag_name,
			"timestamp"=>$today,
		);
		$this->db->where("tag_id",$tag_id);
		$this->db->update("news_tags",$data);

		redirect("news/firstNewsTags","refresh");
	}
	public function massage()
	{
		$this->load->view("massage_view",$this->PAGE);
	}
	public function add_massage(){
		
		$message = $this->input->post("message");
		$message_sent_type = $this->input->post("message_sent_type");
		$message_type = $this->input->post("message_type");
		$member_id = $this->input->post("member_id");
		$message_topic = $this->input->post("message_topic");

		$message_code = $this->utils->getCode(20);
		$topic_code = $this->utils->getCode(20);

		if($message_sent_type == 3){  //ส่งถึงร้านค้า
			
			$data = array(
				"message"			=>$message,
				"message_reply_id"	=>0,
				"sender_id"			=>0,
				"receiver_id"		=>0,
				"order_id"			=>0,
				"message_code"		=>$message_code,
				"topic_code"		=>$topic_code,
				"message_sent_type"	=>$message_sent_type,
				"message_topic"		=>$message_topic,
				"message_type"		=>1,//$message_type,
			);
			$this->db->insert("message",$data);
			$message_reply_id = $this->db->insert_id();

			$store_member_list = $this->model_news->getStoreMember();
			foreach($store_member_list as $row){
				$store_member = $row->member_id;

				$data2 = array(
					"message"			=>$message,
					"message_reply_id"	=>$message_reply_id,
					"sender_id"			=>0,
					"receiver_id"		=>$store_member,
					"order_id"			=>0,
					"message_code"		=>$message_code,
					"topic_code"		=>$topic_code,
					"message_sent_type"	=>$message_sent_type,
					"message_topic"		=>$message_topic,
					"message_type"		=>1,//$message_type,
				);
				$this->db->insert("message",$data2);

			}
			
		}else if($message_sent_type == 2){ // ส่งถึงสมาชิก

			$data = array(
				"message"			=>$message,
				"message_reply_id"	=>0,
				"sender_id"			=>0,
				"receiver_id"		=>0,
				"order_id"			=>0,
				"message_code"		=>$message_code,
				"topic_code"		=>$topic_code,
				"message_sent_type"	=>$message_sent_type,
				"message_topic"		=>$message_topic,
				"message_type"		=>1,//$message_type,
			);
			$this->db->insert("message",$data);
			$message_reply_id = $this->db->insert_id();

			$member_list = $this->model_news->getAllMember();
			foreach($member_list as $row){
				$member_all = $row->member_id;

				$data2 = array(
					"message"			=>$message,
					"message_reply_id"	=>$message_reply_id,
					"sender_id"			=>0,
					"receiver_id"		=>$member_all,
					"order_id"			=>0,
					"message_code"		=>$message_code,
					"topic_code"		=>$topic_code,
					"message_sent_type"	=>$message_sent_type,
					"message_topic"		=>$message_topic,
					"message_type"		=>1,//$message_type,
				);
				$this->db->insert("message",$data2);

			}

		}else{ //ส่งถึงบุคคล

			$data = array(
				"message"			=>$message,
				"message_reply_id"	=>0,
				"sender_id"			=>0,
				"receiver_id"		=>0,
				"order_id"			=>0,
				"message_code"		=>$message_code,
				"topic_code"		=>$topic_code,
				"message_sent_type"	=>$message_sent_type,
				"message_topic"		=>$message_topic,
				"message_type"		=>1,//$message_type,
			);
			$this->db->insert("message",$data);
			$message_reply_id = $this->db->insert_id();

			$data2 = array(
				"message"			=>$message,
				"message_reply_id"	=>$message_reply_id,
				"sender_id"			=>0,
				"receiver_id"		=>$member_id,
				"order_id"			=>0,
				"message_code"		=>$message_code,
				"topic_code"		=>$topic_code,
				"message_sent_type"	=>$message_sent_type,
				"message_topic"		=>$message_topic,
				"message_type"		=>1,//$message_type,
			);
			$this->db->insert("message",$data2);

		}

		redirect("news/massage","refresh");
	}
	public function delNewsCatagory($id){
		// print_r($id);
		// exit();
		$this->db->where('id', $id);
		$this->db->delete('news_category');
		redirect("news/firstNewsCategory");
	}



	
}
