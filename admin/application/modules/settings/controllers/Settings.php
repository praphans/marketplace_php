<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends MX_Controller { 
	
	public $PAGE;
	public function __construct() {
        parent::__construct();
		$this->PAGE['title'] = 'ตั้งค่า | '.$this->load->get_var("default_title");
	
		$this->load->model('settings/model_settings');
		$this->load->model('settings/model_bank');
		$this->utils->checkLogin();
	}
	
	public function myModalAddSettings(){
		$member_type = $this->model_settings->getMemberType();
		$this->PAGE['member_type'] = $member_type;
		$this->load->view('settings/modals/add_settings_view',$this->PAGE);	
	}
	public function myModalEditSettings($admin_id){
		$admin = $this->model_settings->getAdminByID($admin_id);
		$this->PAGE['admin'] = $admin;
		$member_type = $this->model_settings->getMemberType();
		$this->PAGE['member_type'] = $member_type;
		$this->load->view('settings/modals/edit_settings_view',$this->PAGE);
	}
	public function firstSettings()
	{
		$this->load->view("settings_view",$this->PAGE);
	}
	
	public function add_member(){

		$name = $this->input->post("name");
		$username = $this->input->post("username");
		$password = $this->input->post("password");
		$user_type = $this->input->post("user_type");
		$data = array(
			"name"=>$name,
			"username"=>$username,
			"password"=>md5($password),
			"user_type"=>$user_type,
			"allow_to_login"=>1
		);
		$this->db->insert("admin",$data);
		redirect("settings/firstSettings","refresh");
	}
	public function update_member(){
		$admin_id = $this->input->post("admin_id");
		$name = $this->input->post("name");
		$username = $this->input->post("username");
		$password = $this->input->post("password");
		
		if($admin_id == 1){
			$user_type = 1;
		}else{
			$user_type = $this->input->post("user_type");
		}	

		$data = array(
			"name"=>$name,
			"username"=>$username,
			//"password"=>md5($password),
			"user_type"=>$user_type,
			"allow_to_login"=>1
		);

		$this->db->where("admin_id",$admin_id);
		$this->db->update("admin",$data);

		if(!empty($password)){
			$this->db->set("password",md5($password));
			$this->db->where("admin_id",$admin_id);
			$this->db->update("admin",$data);
		}
		redirect("settings/firstSettings","refresh");
	}
	public function settingsGeneralWeb()
	{
		$contact_info = $this->model_settings->getContactInfo();
		$this->PAGE['contact_info'] = $contact_info;
		$this->load->view("settings_general_view",$this->PAGE);
	}
	public function updateGeneralWeb(){

		$id = $this->input->post("contact_info_id");
		$default_title = $this->input->post("default_title");
		$contact_description = $this->input->post("contact_description");
		$footer_description = $this->input->post("footer_description");
		$copyright = $this->input->post("copyright");
		$facebook_url = $this->input->post("facebook_url");
		$twitter_url = $this->input->post("twitter_url");
		$youtube_url = $this->input->post("youtube_url");
		$instagram_url = $this->input->post("instagram_url");
		$store_url_description = $this->input->post("store_url_description");
		$store_review_description = $this->input->post("store_review_description");
		$term = $this->input->post("term");

		$default_logo_url = $this->utils->upload_multiple_file("../uploads/logo","default_logo",$_FILES['default_logo'],800,222,TRUE);
		// print_r($default_logo_url);
		// exit();

		$data = array(
			"default_title"=>$default_title,
			"contact_description"=>$contact_description,
			"footer_description"=>$footer_description,
			"copyright"=>$copyright,
			"facebook_url"=>$facebook_url,
			"twitter_url"=>$twitter_url,
			"youtube_url"=>$youtube_url,
			"instagram_url"=>$instagram_url,
			"store_url_description"=>$store_url_description,
			"store_review_description"=>$store_review_description,
			"term"=>$term,
		);

		$this->db->where("id",$id);
		$this->db->update("contact_info",$data);

		if(!empty($default_logo_url))
		{
			for($i=0;$i<count($default_logo_url);$i++)
			{
				$default_logo_image = $default_logo_url[$i];
				$default_logo = str_replace("../","",$default_logo_image);
				$this->db->set("default_logo",$default_logo);
				$this->db->where("id",$id);
				$this->db->update("contact_info");
			}
		}
		redirect("settings/settingsGeneralWeb","refresh");
	}

	public function bank()
	{
		$this->load->view("bank_view",$this->PAGE);
	}
	public function myModalAddBank(){

		$this->load->view('settings/modals/add_bank_view',$this->PAGE);	
	}
	public function add_bank(){
		$bank_name = $this->input->post("bank_name");
		$data = array(
			"bank_name"=>$bank_name,
		);
		$this->db->insert("store_bank",$data);
		redirect("settings/bank","refresh");
	}
	public function myModalEditBank($bank_id){
		$bank_result = $this->model_bank->getBankById($bank_id);
		$this->PAGE['bank_result'] = $bank_result;
		$this->load->view('settings/modals/edit_bank_view',$this->PAGE);	
	}
	public function updateBank(){

		$bank_id = $this->input->post("bank_id");
		$bank_name = $this->input->post("bank_name");

		$data = array(
			"bank_name"=>$bank_name,
		);

		$this->db->where("id",$bank_id);
		$this->db->update("store_bank",$data);
		redirect("settings/bank","refresh");
	}
	public function permissionUser()
	{
		$this->load->view("permission_view",$this->PAGE);
	}
	public function myModalPermission(){

		$this->load->view('settings/modals/add_permission_view',$this->PAGE);	
	}
	public function add_permission(){
		$user_type_name = $this->input->post("user_type_name");
		$module = $this->input->post("module");
		$current_user_type = '';

	
		$data = array(
			"user_type_name"=>$user_type_name,
		);
		$this->db->insert("user_type",$data);

		$user_type_id = $this->db->insert_id();

		$user_type_result = $this->model_settings->getPermissionByID($module);
		foreach($user_type_result as $row){
			$per_id = $row->per_id;
			$current_user_type = array($row->per_user_type);
			array_push($current_user_type,$user_type_id);

			$per_user_type = implode(",", $current_user_type);

			$this->db->set("per_user_type",$per_user_type);
			$this->db->where("per_id", $per_id);
			$this->db->update("permission");
		}
		

		redirect("settings/permissionUser","refresh");
	}
	public function myModalEditPermission($user_type_id){
		$user_type_result = $this->model_settings->getUserTypeByID($user_type_id);
		$this->PAGE['user_type_result'] = $user_type_result;
		$this->load->view('settings/modals/edit_permission_view',$this->PAGE);	
	}
	public function edit_permission(){

		$user_type_id = $this->input->post("user_type_id");
		$user_type_name = $this->input->post("user_type_name");
		$module = $this->input->post("module");

		$module2 = $this->input->post("module2");
		$current_user_type = '';
		$per_exp_arr = '';

		$data = array(
			"user_type_name"=>$user_type_name,
		);

		$this->db->where("user_type_id",$user_type_id);
		$this->db->update("user_type",$data);

		$user_type_result_ref = $this->model_settings->getPermissionByID($module2);
		foreach($user_type_result_ref as $row){
			$per_id_ref = $row->per_id;
			$current_user_type_ref = array($row->per_user_type);

			$a_ref = implode(",", $current_user_type_ref);
			$b_ref = explode($user_type_id,$a_ref);
			$c_ref = implode(",", $b_ref);

			$d_ref = str_replace(',,', ',', $c_ref);
			$e_ref = trim($d_ref, ',');
			
			$this->db->set("per_user_type",$e_ref);
			$this->db->where("per_id", $per_id_ref);
			$this->db->update("permission");

		}

		$user_type_result = $this->model_settings->getPermissionByID($module);
		foreach($user_type_result as $row){
			$per_id = $row->per_id;
			$current_user_type = array($row->per_user_type);

			$a = implode(",", $current_user_type);

			$per_exp_arr = explode(",",$a);
			// if(!in_array($user_type_id, $per_exp_arr)){
			// 	array_push($current_user_type,$user_type_id);
			// }
			array_push($current_user_type,$user_type_id);
			$per_user_type = implode(",", $current_user_type);

			$this->db->set("per_user_type",$per_user_type);
			$this->db->where("per_id", $per_id);
			$this->db->update("permission");

		}
		
		redirect("settings/permissionUser","refresh");
	}

	public function delPermis($user_type_id){
		// print_r($id);
		// exit();
		$this->db->where('user_type_id', $user_type_id);
		$this->db->delete('user_type');
		redirect("settings/permissionUser");
	}


	
}
