<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Warehouse_api extends MX_Controller {
	
	public $PAGE;
	public function __construct() {
        parent::__construct();
		$this->load->model('warehouse/model_warehouse');
	}
	public function getEditByID()
	{
		$this->utils->checkLogin();
		$id = $this->input->post("id");
		$warehouse_list = $this->model_warehouse->getWarehouseByID($id);
		echo json_encode($warehouse_list);
	}
	
}
