<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_api extends MX_Controller {
	
	public $PAGE;
	public function __construct() {
        parent::__construct();
		$this->load->model('settings/model_settings');
		$this->utils->checkLogin();
	}

	public function getSetting()
	{


		$setting_arr = array();
        $setting_arr['data'] = array();
		$settings = $this->model_settings->getAdmin();
        if(!empty($settings)):
			foreach($settings as $row):
				$admin_id = $row->admin_id;
				$name = $row->name;
				$username = $row->username;
				$user_type = $row->user_type;

				$user_type_result = $this->model_settings->getUserTypeByID($user_type);
				$label_type = " -";
				if(count($user_type_result)>0){
					$type_name = $user_type_result[0]->user_type_name;
				}else{
					$type_name = "";
				}
				if($admin_id == 1){
					$disabled = "disabled";
				}else{
					$disabled = "";
				}

				/* $images =  '<img src="'.base_url($join_image).'" width="50" />'; */
				$checkbox = '<input type="checkbox" id="setting_'.$admin_id.'" value="'.$admin_id.'" class="filled-in chk-col-light-green del_store" '.$disabled.'><label for="setting_'.$admin_id.'" class="chk-mps "></label>';
				$edit_btn = '<button type="button" onClick="loadModalEdit('.$admin_id.');" id="edit" class="btn btn-warning text-light btn-block mdi mdi-pencil"> แก้ไข</button>';
				$label_type = '<label class="label label-success w-100 text-center">'.$type_name.'</label>';
				$setting_arr['data'][] = array(
					$checkbox,
					$name,
					$username,
					$label_type,
					$edit_btn
				);
            endforeach;
        endif;
        $json = json_encode($setting_arr);
		echo $json;
	}
	
	// delete data
	public function deleteSetting(){
		$id  = $this->input->post("id");
		$this->db->where('admin_id', $id);
		$this->db->set('allow_to_login', 0);
		$result = $this->db->update('admin');
		if($result){
			$success = 1;
		}else{
			$success = 0;
		}
		$respond = array('success' => $success);
	}

	public function getPermission()
	{


		$permission_arr = array();
        $permission_arr['data'] = array();
		$permission = $this->model_settings->getUserType();
        if(!empty($permission)):
			foreach($permission as $row):
				$user_type_id = $row->user_type_id;
				$user_type_name = $row->user_type_name;
				$timestamp = $row->timestamp;

				if($user_type_id == 1){
					$disabled = "disabled";
				}else{
					$disabled = "";
				}

				$not_del = 1;
				$user_type_arr = array();
				$user_type_result = $this->model_settings->getTypeArr();
				foreach($user_type_result as $row){
					$user_type = $row->user_type; 
					array_push($user_type_arr,$user_type);
				}
				$type_id = implode(",", $user_type_arr);

				$join_type_arr = explode(",",$type_id);
				if(in_array($user_type_id, $join_type_arr)){
					$not_del = 0;
					
				}

				$edit_btn = '<button type="button" onClick="loadModalEditPermis('.$user_type_id.');" id="edit" class="btn btn-warning text-light btn-block mdi mdi-pencil" '.$disabled.'> แก้ไข</button>';
				$del_btn = '<button type="button" name="del_faq_cat" value="'.$user_type_id.'" class="btn btn-danger text-light btn-block mdi mdi-delete-empty" onClick="delTypy('.$user_type_id.','.$not_del.');" '.$disabled.'> ลบประเภท</button>';
				$permission_arr['data'][] = array(
					// $timestamp,
					$user_type_name,
					$edit_btn,
					$del_btn,

				);
            endforeach;
        endif;
        $json = json_encode($permission_arr);
		echo $json;
	}
	
}
