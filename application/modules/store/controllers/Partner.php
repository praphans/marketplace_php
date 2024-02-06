<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Partner extends MX_Controller {   

	public $PAGE;
	public function __construct() {
        parent::__construct();
		
		$this->PAGE['title'] = 'คู่ค้าของฉัน | '.$this->load->get_var("default_title");
		$this->membermanager->checkLogin();
		$this->load->model("model_partner");
		$this->load->model("shop/model_shop");
		$this->load->helper(array('form', 'url'));
		$config['upload_path'] = 'uploads';
		$config['allowed_types'] = 'svg|gif|jpg|png|doc|doc'; 
		$config['encrypt_name'] = TRUE;
		$this->load->library('upload', $config);
		$this->storemanager->hasStore();
	}
	public function index()
	{
		$store_id_list = array();
		$store_id = $this->storemanager->store_id();
		$myplace = $this->model_partner->getMyPlace($store_id);
		foreach($myplace as $partner){	
			$place_id = $partner->place_id;
			$request_place_id = $partner->request_place_id;
			$shipping_type_id = $partner->shipping_type_id;
			if($shipping_type_id == 1){ // เป็นสถานที่ ของเราเอง เอา place_id ไปเทียบกับ request_place_id ว่ามีใครขอใช้ร้านเราส่งของหรือเปล่า
				$store_give = $this->model_partner->getStorePlaceGive($place_id);
				foreach($store_give as $g){	
					$store_id = $g->store_id;
					array_push($store_id_list,$store_id);
				}
			}else if($shipping_type_id == 2){ // เป็นสถานที่ ที่เราไปขอใช้ส่งของ เอา request_place_id ไปเทียบ place_id ว่าร้านไหนขอใช้
				$store_request = $this->model_partner->getStorePlaceRequest($request_place_id);
				foreach($store_request as $r){	
					$store_id = $r->store_id;
					array_push($store_id_list,$store_id);
				}
			}
			
		}
		
		$store_id_list = array_unique($store_id_list);
		
		/*$page_number = ($this->uri->segment(3) != '')?$this->uri->segment(3):0; 
		$total_rows = $this->model_partner->getPartnerPlaceTotalRow($store_id);
		
		$this->load->library('pagination');
		$config['base_url'] = base_url('store/partner/');
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
		
		$partner_store_place = $this->model_partner->getPartnerPlaceByStoreID($store_id,$page_number,$per_page);
		
		$pages = ceil($total_rows/$per_page);
		$min_page = ($page_number+1);
		$max_page = count($partner_store_place);
		$max_page = $min_page+($max_page-1);
		$this->PAGE['page_showing'] = 'แสดง '.$min_page.' ถึง '.$max_page.' จาก '.$total_rows.' รายการ ( '.$pages.' หน้า )';
		$this->PAGE['pagination'] = $this->pagination->create_links();*/
		
		$this->PAGE['store_id_list'] = $store_id_list;
		$this->load->view("store/9_".$this->router->fetch_class()."/partner_view",$this->PAGE);
	}
}