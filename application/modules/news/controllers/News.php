<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends MX_Controller {

	public $PAGE;
	public function __construct() {
        parent::__construct();
		$this->PAGE['title'] = 'ข่าวสาร | '.$this->load->get_var("default_title");
		$this->load->model("model_news");
	}
	public function index()
	{
		
		
		
		$page_number = ($this->uri->segment(4) != '')?$this->uri->segment(4):0; 
		
		$new_cate_id = $this->uri->segment(2);
		
		if(!isset($page_number))$page_number = 0;
		if(!isset($new_cate_id))$new_cate_id = 0;
		
		$category_name = "รวมทุกหมวดหมู่";
		$category_current = $this->model_news->getCategoryByID($new_cate_id);
		
		if(count($category_current))$category_name = $category_current[0]->category_name;
		
		$total_rows = $this->model_news->getNewsTotalRows($new_cate_id);
		
		
		$this->load->library('pagination');
		$config['base_url'] = base_url('news/'.$new_cate_id.'/'.$category_name);
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page = 10;
		
		
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = false;
		$config['last_link'] = false;
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['prev_link'] = '&laquo';
		$config['prev_tag_open'] = '<li class="prev">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '&raquo';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		
		
		$this->pagination->initialize($config);
		$this->PAGE['category'] = $this->model_news->getCategory();
		$this->PAGE['tags'] = $this->model_news->getTags();
		
		$this->PAGE['news'] = $news = $this->model_news->getNewsList($new_cate_id,$page_number,$per_page);
		
		
		$pages = ceil($total_rows/$per_page);
		$min_page = ($page_number+1);
		$max_page = count($news);
		$max_page = $min_page+($max_page-1);
		$this->PAGE['page_showing'] = 'แสดง '.$min_page.' ถึง '.$max_page.' จาก '.$total_rows.' รายการ ( '.$pages.' หน้า )';
		$this->PAGE['pagination'] = $this->pagination->create_links();
		
		$tag_name_directory = "ทั้งหมด";
		$this->PAGE['tag_name_directory'] = $tag_name_directory;
		$this->load->view("news_view",$this->PAGE);	
	}
	public function tags()
	{
		
		$tag_id = ($this->uri->segment(3) != '')?$this->uri->segment(3):0; 
		$page_number = ($this->uri->segment(4) != '')?$this->uri->segment(4):0; 
		
		if(!isset($page_number))$page_number = 0;
		if(!isset($tag_id))$tag_id = 1;
		
		if(!is_numeric($page_number))$page_number = 0;
		$tag_name = "";
		$tags_current = $this->model_news->getTagsByID($tag_id);
		if(count($tags_current))$tag_name = $tags_current[0]->tag_name;
		
		$total_rows = $this->model_news->getTagsTotalRows($tag_id);
		
		
		$this->load->library('pagination');
		$config['base_url'] = base_url('news/tags/'.$tag_id.'/'.$tag_name);
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page = 20;
		
		
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = false;
		$config['last_link'] = false;
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['prev_link'] = '&laquo';
		$config['prev_tag_open'] = '<li class="prev">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '&raquo';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		
		
		$this->pagination->initialize($config);
		$this->PAGE['category'] = $this->model_news->getCategory();
		$this->PAGE['tags'] = $this->model_news->getTags();
		
		$this->PAGE['news'] = $news = $this->model_news->getTagsList($page_number,$per_page,$tag_id);
		
		$pages = ceil($total_rows/$per_page);
		$min_page = ($page_number+1);
		$max_page = count($news);
		$max_page = $min_page+($max_page-1);
		$this->PAGE['page_showing'] = 'แสดง '.$min_page.' ถึง '.$max_page.' จาก '.$total_rows.' รายการ ( '.$pages.' หน้า )';
		$this->PAGE['pagination'] = $this->pagination->create_links();
		
		$tag_name_directory = "ทั้งหมด";
		if(!empty($tag_name)){
			$tag_name_directory = $tag_name;
		}
		$this->PAGE['tag_name_directory'] = $tag_name_directory;
		$this->load->view("news_view",$this->PAGE);	
	}
	public function info($new_id){
		
		$this->PAGE['news'] = $this->model_news->getNewsByID($new_id);
		$this->load->view("news_detail_view",$this->PAGE);	
	}
}