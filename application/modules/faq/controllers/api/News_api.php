<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News_api extends MX_Controller {

	public $PAGE;
	public function __construct() {
        parent::__construct();
		$this->load->model('model_news');
	}


	
	
}
