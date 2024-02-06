<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Place extends MX_Controller { 
	
	public $PAGE;	
	public function __construct() {
        parent::__construct();
        $this->PAGE['title'] = 'สถานที่ทั้งหมด | '.$this->load->get_var("default_title");
		$this->load->model('place/model_place');
		$this->load->library('place/place_libs');
		$this->load->helper(array('form', 'url'));
		$config['upload_path'] = 'uploads';
		$config['allowed_types'] = 'svg|gif|jpg|png'; 
		$config['encrypt_name'] = TRUE;
		$this->utils->checkLogin();
		$this->load->library('upload', $config);
	}
	public function index($shipping_type_id = 0){
		$this->PAGE['current_shipping_type_id'] = $shipping_type_id;
		$this->load->view('place_view',$this->PAGE);
	}

	public function placeDescription($place_id)
	{
		$this->PAGE['title'] = 'รายละเอียดสถานที่ | '.$this->load->get_var("default_title");

		$place_discription = $this->model_place->getPlaceByID($place_id);
		$this->PAGE['place_discription'] = $place_discription;
		$this->load->view("place_description_view",$this->PAGE);
	
	}
	
	
}
