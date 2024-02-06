<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MX_Controller {

	public $PAGE;
	public function __construct() {
        parent::__construct();
		$this->PAGE['title'] = 'หน้าแรก | '.$this->load->get_var("default_title");
		$this->load->model("news/model_news");
		$this->load->model("shop/model_shop");
		$this->load->model("model_home");
	}
	public function index()
	{
		$news = $this->model_news->getLatestNew(4);
		$featured = $this->model_home->getFeatured();
		$banners = $this->model_home->getBanner();
		
		$this->PAGE['banners'] = $banners;
		$this->PAGE['featured'] = $featured;
		$this->PAGE['news'] = $news;
		$this->load->view("home_view",$this->PAGE);	
	}
}