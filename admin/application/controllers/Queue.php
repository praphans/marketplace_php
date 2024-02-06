<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Queue extends MX_Controller {

	public $PAGE;
	
	public function __construct() {
        parent::__construct();
	}
	public function index()
	{
		
	}
	public function importQueue($room_id,$pet_id){

		$this->utils->checkLogin();

		$data = array(
			'queue_id' => $this->utils->codeQueue(),
			'room_id' => $room_id,
			'main_room_id' => $room_id,
			'pet_uid' => $pet_id,
			'queue_mode_id' => $this->utils->getQueueModeByRoom($room_id),
			'queue_add_timestamp' => date('Y-m-d H:i:s'),
			'queue_modify_timestamp' => date('Y-m-d H:i:s'),
			'queue_history_status' => 2,
			'queue_priority_id' => 5, //table priority_list
		);

		$this->db->insert('queue_history',$data);
		redirect("home","refresh");

	}
	public function changeRoom($room_id,$queue_uid){

		$this->utils->checkLogin();

		$queue_mode_id = $this->utils->getQueueModeByRoom($room_id);
		if($queue_mode_id != ''){
			$this->db->set('queue_mode_id',$queue_mode_id);
		}
		$this->db->set('room_id',$room_id);
		$this->db->set('queue_modify_timestamp',date('Y-m-d H:i:s'));
		$this->db->where('queue_uid',$queue_uid);
		$this->db->update('queue_history');
		redirect("home","refresh");

	}
	public function cancelQueue($queue_uid)
	{
		$this->utils->checkLogin();

		$this->db->set('queue_history_status',6);
		$this->db->set('queue_modify_timestamp',date('Y-m-d H:i:s'));
		$this->db->where('queue_uid',$queue_uid);
		$this->db->update('queue_history');
		redirect("home","refresh");
	}

	public function returnRoomByQueue($queue_uid)
	{
		$this->load->model('model_queues');
		$queue = $this->model_queues->getMainRoomByQueue($queue_uid);
		if(!empty($queue)){
			$room_id = $queue[0]->room_id;
			$main_room_id = $queue[0]->main_room_id;
			if($room_id == $main_room_id){
				$this->cancelqueue($queue_uid);
			}
			$this->changeRoom($main_room_id,$queue_uid);
		}
	}
}
