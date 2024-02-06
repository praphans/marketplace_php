<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bank_api extends MX_Controller {
	
	public $PAGE;
	public function __construct() {
        parent::__construct();
		$this->load->model('settings/model_bank');
		$this->utils->checkLogin();
	}

	public function getBank()
	{

		$bank_arr = array();
        $bank_arr['data'] = array();
		$bank = $this->model_bank->getBank();
        if(!empty($bank)):
			foreach($bank as $row):
				$bank_id = $row->id;
				$bank_name = $row->bank_name;
				$timestamp = $row->timestamp;

				$thaidate = $this->utils->getThaiDate($timestamp);
				$checkbox = '<input type="checkbox" id="bank_'.$bank_id.'" value="'.$bank_id.'" class="filled-in chk-col-light-green chx_bank"><label for="bank_'.$bank_id.'" class="chk-mps "></label>';
				$edit_btn = '<button type="button" onClick="loadModalEdit('.$bank_id.');" id="edit" class="btn btn-warning text-light btn-block mdi mdi-pencil"> แก้ไข</button>';
				$bank_arr['data'][] = array(
					$checkbox,
					$bank_name,
					$thaidate,
					$edit_btn,

				);
            endforeach;
        endif;
        $json = json_encode($bank_arr);
		echo $json;
	}
	
	// delete data
	public function deleteBank(){
		$bank_id  = $this->input->post("bank_id");
		$this->db->where('id', $bank_id);
		$result = $this->db->delete('store_bank');
		if($result){
			$success = 1;
		}else{
			$success = 0;
		}
		$respond = array('success' => $success);
	}
	
}
