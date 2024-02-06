<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deliverylist_api extends MX_Controller {
	public function __construct() {
        parent::__construct();
	}
	public function saveDepositCost(){
		$this->membermanager->checkLogin();
		$order_id = $this->input->post("order_id");
		$depositor_cost = $this->input->post("depositor_cost");
		$this->db->set("depositor_cost_approve",2);
		$this->db->set("depositor_cost",$depositor_cost);
		$this->db->where("order_id",$order_id);
		$query = $this->db->update("order");
		echo json_encode($query);
	}
}
