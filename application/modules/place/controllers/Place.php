<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Place extends MX_Controller {

	public $PAGE;
	public function __construct() {
        parent::__construct();
		
		$this->PAGE['title'] = 'รายละเอียดสถานที่ | '.$this->load->get_var("default_title");
		$this->load->model("model_place");
		$this->load->model("store/model_shipping");
		
		//$this->membermanager->checkLogin();
	}
	public function index()
	{
		redirect("user/order/all");
	}
	public function info($place_id = 0)
	{
		
		$query = $this->db->query("SELECT * FROM  store_place WHERE place_id =  ".$place_id." AND place_status = 2");
		if($query->num_rows() > 0 ) {
			$places = $query->result();
		} else {
			$places = array();
		}
		$this->PAGE['places'] = $places;
		$this->load->view("place/place_view",$this->PAGE);
	}
}