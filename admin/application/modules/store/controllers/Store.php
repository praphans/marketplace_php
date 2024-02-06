<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Store extends MX_Controller { 
	
	public $PAGE;
	public function __construct() {
        parent::__construct();
		$this->PAGE['title'] = 'ร้านค้า | '.$this->load->get_var("default_title");
	
		$this->load->model('settings/model_settings');
		$this->load->model('store/model_partner');
		$this->load->model('store/model_store');
		$this->load->model('store/model_shop');
		$this->load->model('place/model_place');
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
	public function firstStore()
	{
		$this->load->view("store_view",$this->PAGE);
	}
	public function storeDescription($id)
	{
		$store_byid = $this->model_store->getStoreByID($id);
		$amphur = 0;
		$province = 0;
		$district = 0;
		if(count($store_byid)>0){
			$province = $store_byid[0]->province;
			$amphur = $store_byid[0]->amphur;
			$district = $store_byid[0]->district;
			$store_type = $store_byid[0]->store_type;
			$store_shipping = $store_byid[0]->store_shipping;
			$store_category = $store_byid[0]->store_category;
			$store_status = $store_byid[0]->store_status;
		}

		$amphures = $this->model_store->getAmphuresByID($amphur);
		$provinces = $this->model_store->getProvincesByID($province);
		$districts = $this->model_store->getDistrictsByID($district);
		$place = $this->model_store->getStorePlace($id);

		$place_id = 0;
		$place_province = 0;
		if(count($place)>0){
			$place_id = $place[0]->place_id;
			$place_province = $place[0]->place_province;
		}
		$provinces_place = $this->model_store->getProvincesByID($place_province);
		
		$store_working = $this->model_store->getStoreWorking($place_id);
		$store_type_byid = $this->model_store->getStoreTypeByID($store_type);
		$shipping = explode(",", $store_shipping);		
		//$shipping = $this->removeString($shipping);
		$store_status_m = $this->model_store->getStoreStatus($store_status); 
		$shipping_type = $this->model_store->getShippingType($shipping); 
		$store_category = $this->model_store->geStoreCategoryByID($store_category);
		
		
		$this->PAGE['store_status_m'] = $store_status_m;
		$this->PAGE['store_category'] = $store_category;
		$this->PAGE['shipping_type'] = $shipping_type;
		$this->PAGE['store_type_byid'] = $store_type_byid;
		$this->PAGE['provinces_place'] = $provinces_place; 
		$this->PAGE['place'] = $place;
		$this->PAGE['store_working'] = $store_working;
		$this->PAGE['districts'] = $districts;
		$this->PAGE['amphures'] = $amphures;
		$this->PAGE['provinces'] = $provinces;
		$this->PAGE['store_byid'] = $store_byid;
		$this->load->view("store_description_view",$this->PAGE);
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
		$user_type = $this->input->post("user_type");
		$data = array(
			"name"=>$name,
			"username"=>$username,
			//"password"=>md5($password),
			"user_type"=>$user_type,
			"allow_to_login"=>1
		);
		$this->db->where("admin_id",$admin_id);
		$this->db->update("admin",$data);
		redirect("settings/firstSettings","refresh");
	}
	public function verify($store_id){
		$this->db->set("store_status",2);
		$this->db->where("store_id",$store_id);
		$this->db->update("store");
		redirect("store/storeDescription/".$store_id);
	}
	public function editVerify($store_id){

		$store_edit = $this->model_store->getStoreEditByID($store_id);
		foreach($store_edit as $rows){
			$member_id = $rows->member_id;
			$store_type = $rows->store_type;
			$store_category = $rows->store_category;
			$first_name = $rows->first_name;
			$last_name = $rows->last_name;
			$identity_number = $rows->identity_number;
			$tel = $rows->tel;
			$province = $rows->province;
			$amphur = $rows->amphur;
			$district = $rows->district;
			$address = $rows->address;
			$zipcode = $rows->zipcode;
			$account_name = $rows->account_name;
			$account_number = $rows->account_number;
			$bank_name = $rows->bank_name;
			$store_is_vat = $rows->store_is_vat;
		}	

		$storeDoc_edit = $this->model_store->getStoreDocEditByID($store_id);
		foreach($storeDoc_edit as $rowd){
			$company_doc = $rowd->company_doc;
			$identity_doc = $rowd->identity_doc;
			$identity_multi_doc = $rowd->identity_multi_doc;
			$book_twenty_doc = $rowd->book_twenty_doc;
			$book_bank_doc = $rowd->book_bank_doc;
			$book_other_doc = $rowd->book_other_doc;
			$house_particular_doc = $rowd->house_particular_doc;
		}	

		if(count($store_edit)>0){
			$data_store = array(
				"store_type" 	=>$store_type,
				"store_category" =>$store_category,
				"first_name" 	=>$first_name,
				"last_name" 	=>$last_name,
				"identity_number"=>$identity_number,
				"tel" 			=>$tel,
				"province" 		=>$province,
				"amphur" 		=>$amphur,
				"district" 		=>$district,
				"address" 		=>$address,
				"zipcode" 		=>$zipcode,
				"account_name" 	=>$account_name,
				"account_number" =>$account_number,
				"bank_name" 	=>$bank_name,
				"store_is_vat" 	=>$store_is_vat,
				// "store_status"	=>2,
			);

			$this->db->where("store_id",$store_id);
			$this->db->update("store",$data_store);
		}

		$store_get = $this->db->get_where('store_edit', array('store_id' => $store_id));
		$has_store = $store_get->num_rows();

		if($has_store){
			$this->db->where("store_id",$store_id);
			$this->db->delete("store_edit");
		}
		
		$documents = $this->db->get_where('store_document', array('store_id' => $store_id));
		$has_docs = $documents->num_rows();
		if($has_docs){
			if(count($storeDoc_edit)>0){
				$data_doc = array(
					"store_id" =>$store_id,
					"company_doc" =>$company_doc,
					"identity_doc" =>$identity_doc,
					"identity_multi_doc" =>$identity_multi_doc,
					"book_twenty_doc" =>$book_twenty_doc,
					"book_bank_doc" =>$book_bank_doc,
					"book_other_doc" =>$book_other_doc,
					"house_particular_doc" =>$house_particular_doc,
				);
				$this->db->where("store_id",$store_id);
				$this->db->update("store_document",$data_doc);

				$this->db->where("store_id",$store_id);
				$this->db->delete("store_document_edit");
			}
		}else{
			if(count($storeDoc_edit)>0){
				$data_doc = array(
					"store_id" =>$store_id,
					"company_doc" =>$company_doc,
					"identity_doc" =>$identity_doc,
					"identity_multi_doc" =>$identity_multi_doc,
					"book_twenty_doc" =>$book_twenty_doc,
					"book_bank_doc" =>$book_bank_doc,
					"book_other_doc" =>$book_other_doc,
					"house_particular_doc" =>$house_particular_doc,
				);
				$this->db->insert("store_document",$data_doc);

				$this->db->where("store_id",$store_id);
				$this->db->delete("store_document_edit");
			}
		}

		$store_result = $this->model_store->getStoreByID($store_id);
		$store_name = "";
		foreach($store_result as $rows){
			$store_name = $rows->store_name;
		}
		$this->db->set("first_name",$store_name);
		$this->db->where("member_id",$member_id);
		$this->db->update("member");

		$this->db->set("store_status",2);
		$this->db->where("store_id",$store_id);
		$this->db->update("store");

		redirect("store/storeDescription/".$store_id);
	}
	public function canceled($store_id){
		$this->db->set("store_status",1);
		$this->db->where("store_id",$store_id);
		$this->db->update("store");
		redirect("store/storeDescription/".$store_id);
	}
	public function not_allowed($store_id){
		$this->db->set("store_status",3);
		$this->db->where("store_id",$store_id);
		$this->db->update("store");
		redirect("store/storeDescription/".$store_id);
	}
	public function recomStore()
	{
		$this->load->view("recom_store_view",$this->PAGE);
	}

	public function update_popular(){
		$store_id = $this->input->post("store_id");
		$store_popular = $this->input->post("store_popular");

		for($i=0;$i<count($store_popular);$i++){

			$store_popular_val = $store_popular[$i];
			$store_id_val = $store_id[$i];
			$data = array(
				"store_popular"		=>$store_popular_val,
			);
			$this->db->where("store_id",$store_id_val);
			$this->db->update("store",$data);
		}
		
		redirect("store/firstStore","refresh");
	}
	public function myModalPartner($store_id){
		
		$store_id_list = array();
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
		
		
		
		$this->PAGE['store_id_list'] = $store_id_list;
		$this->load->view('store/modals/partners_store_view',$this->PAGE);
	}

	public function itemStores($store_id)
	{	

		$this->PAGE['store_id'] = $store_id;
		$this->load->view("itemstores_view",$this->PAGE);
	}
	public function itemStoresInfo($depositor_store_id,$seller_store_id)
	{	
		$orders = $this->model_store->getInfoOrderByMemberID($seller_store_id,$depositor_store_id);
		$this->PAGE['depositor_store_id'] = $depositor_store_id;
		$this->PAGE['seller_store_id'] = $seller_store_id;
		$this->PAGE['orders'] = $orders;
		$this->load->view('modals/itemstores_info_view',$this->PAGE);	
	}


	
	

	
}
