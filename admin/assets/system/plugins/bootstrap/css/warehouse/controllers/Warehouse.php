<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Warehouse extends MX_Controller {
	
	public $PAGE;
	public function __construct() {
        parent::__construct();
		$this->PAGE['title'] = 'คลังเก็บสินค้า | '.$this->load->get_var("default_title");
		
		$this->load->model('warehouse/model_warehouse');
	}
	public function index()
	{
		$this->utils->checkLogin();
		$warehouse_list = $this->model_warehouse->getWarehouse();
		$this->PAGE['warehouse_list'] = $warehouse_list;
		$this->load->view("warehouse_view",$this->PAGE);
	}
	public function add()
	{
		$this->utils->checkLogin();
		$warehouse = $this->input->post("warehouse");
		$warehouse_detail = $this->input->post("warehouse_detail");
		$warehouse_type_id = $this->input->post("warehouse_type_id");
		$warehouse_location = $this->input->post("warehouse_location");
		$default_warehouse = $this->input->post("default_warehouse");
		if(isset($default_warehouse))
			$default_warehouse = 1;
		else
			$default_warehouse = 0;
			
		$warehouse_status = 1;
		$data = array(
			"warehouse"=>$warehouse,
			"warehouse_detail"=>$warehouse_detail,
			"warehouse_type_id"=>$warehouse_type_id,
			"warehouse_location"=>$warehouse_location,
			"default_warehouse"=>$default_warehouse,
			"warehouse_status"=>$warehouse_status
		);
		$this->db->insert("warehouse",$data);
		redirect("warehouse");
	}
	public function edit()
	{
		$this->utils->checkLogin();
		$id = $this->input->post("id");
		$warehouse = $this->input->post("warehouse");
		$warehouse_detail = $this->input->post("warehouse_detail");
		$warehouse_type_id = $this->input->post("warehouse_type_id");
		$warehouse_location = $this->input->post("warehouse_location");
		$default_warehouse = $this->input->post("default_warehouse");
		if(isset($default_warehouse))
			$default_warehouse = 1;
		else
			$default_warehouse = 0;
			
		$warehouse_status = 1;
		$data = array(
			"warehouse"=>$warehouse,
			"warehouse_detail"=>$warehouse_detail,
			"warehouse_type_id"=>$warehouse_type_id,
			"warehouse_location"=>$warehouse_location,
			"default_warehouse"=>$default_warehouse,
			"warehouse_status"=>$warehouse_status
		);
		$this->db->where("id",$id);
		$this->db->update("warehouse",$data);
		redirect("warehouse");
	}
	public function del($id)
	{
		$this->utils->checkLogin();
		$this->db->set("warehouse_status",0);
		$this->db->where("id",$id);
		$this->db->update("warehouse");
		redirect("warehouse");
	}
}
