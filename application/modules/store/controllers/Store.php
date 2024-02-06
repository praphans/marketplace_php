<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Store extends MX_Controller {   

	public $PAGE;
	public function __construct() {
        parent::__construct();
		
		$this->PAGE['title'] = 'สร้างร้านค้า | '.$this->load->get_var("default_title");
		$this->membermanager->checkLogin();
		$this->load->helper(array('form', 'url'));
		$config['upload_path'] = 'uploads';
		$config['allowed_types'] = 'svg|gif|jpg|png|doc|doc'; 
		$config['encrypt_name'] = TRUE;
		$this->load->library('upload', $config);
		
		$this->load->model('model_store');
		//$this->storemanager->hasStore();
	}
	public function index()
	{
		
		if(count($this->storemanager->myStore())){

			$store_status = $this->session->userdata('store_status');
            if($store_status == 1 || $store_status == 3 || $store_status == 4 || $store_status == 6){
				redirect("store/registration");
			}else{
				redirect("store/dashboard");
			}
							  
		}else{
			$this->load->view("store/store_view",$this->PAGE);
		}
	}
	public function register(){
		if(count($this->storemanager->myStore())){
			redirect("store/dashboard");					  
		}else{
			$this->load->view("store/register_step_1_view",$this->PAGE);
		}
	}
	public function createStore(){
		$store = $this->input->post();
		
		$this->db->select("store_url");
		$this->db->from("store");
		$this->db->where("store_url",$store['store_url']);
		$query = $this->db->get();
		if($query->num_rows()>0){
			$this->session->set_flashdata('error_msg','URL ร้านค้า มีการใช้งานจากสมาชิกท่านอื่นแล้ว \n กรุณาเลือก URL ร้านค้าใหม่');
			redirect("store/register","refresh");
			exit();
		}
		
		$this->db->select("store_name");
		$this->db->from("store");
		$this->db->where("store_name",$store['store_name']);
		$query = $this->db->get();
		if($query->num_rows()>0){
			$this->session->set_flashdata('error_msg','ชื่อร้านค้า มีการใช้งานจากสมาชิกท่านอื่นแล้ว \n กรุณาตั้งชื่อร้านค้าใหม่');
			redirect("store/register","refresh");
			exit();
		}
		
		$this->membermanager->activeStore($store,TRUE);
		$this->load->view("store/register_step_2_view",$this->PAGE);
	}
	public function createStoreInfo(){
		
		$store = $this->input->post();
		$is_vat = $this->input->post("store_is_vat");
		if(!empty($is_vat) || $is_vat!=0){
			$store['store_is_vat'] = 1;
		}else{
			$store['store_is_vat'] = 0;
		}
		
		$store['member_id'] = $this->membermanager->member_id();
		$store['store_name'] = $this->storemanager->store_name();
		$store['store_url'] = $this->storemanager->store_url();
		$store['store_avatar'] = $this->storemanager->default_avatar_image();
		$store['store_cover'] = $this->storemanager->default_cover_image();
		$store['store_code'] = $this->utils->getStoreCode();
		$store['timestamp'] = date('Y-m-d H:i:s');
		//$store['store_status'] = 2; // สถานะเป็นอนุญาติสำหรับทดสอบ
		
		
		$this->db->insert("store",$store);
		$store_id = $store['store_id'] = $this->db->insert_id();
		
		
		
		//$has_user = $this->model_store->getMemberByID($store['member_id']);
		//$this->membermanager->activeUser($has_user,TRUE);
		 
		$this->db->set("first_name",$store['store_name']);
		$this->db->where("member_id",$store['member_id']);
		$this->db->update("member");
		
		$company_doc = $this->utils->upload_multiple_file("uploads/document","company_doc",$_FILES['company_doc']);
		$identity_doc = $this->utils->upload_multiple_file("uploads/document","identity_doc",$_FILES['identity_doc']);
		$identity_multi_doc = $this->utils->upload_multiple_file("uploads/document","identity_multi_doc",$_FILES['identity_multi_doc']);
		$book_twenty_doc = $this->utils->upload_multiple_file("uploads/document","book_twenty_doc",$_FILES['book_twenty_doc']);
		$book_bank_doc = $this->utils->upload_multiple_file("uploads/document","book_bank_doc",$_FILES['book_bank_doc']);
		$book_other_doc = $this->utils->upload_multiple_file("uploads/document","book_other_doc",$_FILES['book_other_doc']);
		$house_particular_doc = $this->utils->upload_multiple_file("uploads/document","house_particular_doc",$_FILES['house_particular_doc']);
		
		$company_doc = (count($company_doc))?implode(",",$company_doc):"";
		$identity_doc = (count($identity_doc))?implode(",",$identity_doc):"";
		$identity_multi_doc = (count($identity_multi_doc))?implode(",",$identity_multi_doc):"";
		$book_twenty_doc = (count($book_twenty_doc))?implode(",",$book_twenty_doc):"";
		$book_bank_doc = (count($book_bank_doc))?implode(",",$book_bank_doc):"";
		$book_other_doc = (count($book_other_doc))?implode(",",$book_other_doc):"";
		$house_particular_doc = (count($house_particular_doc))?implode(",",$house_particular_doc):"";
		
		$docs = array(
			"store_id"=>$store_id,
			"company_doc"=>$company_doc,
			"identity_doc"=>$identity_doc,
			"identity_multi_doc"=>$identity_multi_doc,
			"book_twenty_doc"=>$book_twenty_doc,
			"book_bank_doc"=>$book_bank_doc,
			"book_other_doc"=>$book_other_doc,
			"house_particular_doc"=>$house_particular_doc,
		);
		
		$documents = $this->db->get_where('store_document', array( 'store_id' => $store_id));
		$has_docs = $documents->num_rows();
		if($has_docs){
			$this->db->update("store_document",$docs);
		}else{
			$this->db->insert("store_document",$docs);
		}
		$this->membermanager->activeStore($store,TRUE);
		
		$this->session->unset_userdata('first_name');
		$this->session->set_userdata('first_name',$store['store_name']);
		redirect("store");
	}
	

	public function editCreateStoreInfo(){
		$this->load->model('store/model_registration');
		$store = $this->input->post();

		$is_vat = $this->input->post("store_is_vat");
		if(!empty($is_vat) || $is_vat!=0){
			$store['store_is_vat'] = 1;
		}else{
			$store['store_is_vat'] = 0;
		}

		// $store['member_id'] = $this->membermanager->member_id();
		// $store['store_name'] = $this->storemanager->store_name();
		// $store['store_url'] = $this->storemanager->store_url();
		// $store['store_code'] = $this->utils->getStoreCode();
		$store['store_status'] = 6; // ขอแก้ไข
		$store['timestamp'] = date('Y-m-d H:i:s');
		$store_id = $store['store_id'];

		$store_edit_result = $this->db->get_where('store_edit', array( 'store_id' => $store_id));
		$has_store_edit = $store_edit_result->num_rows();
		if($has_store_edit){
			$this->db->where("store_id",$store_id);
			$this->db->update("store_edit",$store);
		}else{
			$this->db->insert("store_edit",$store);
		}

		$this->db->set("store_status",6);
		$this->db->where("store_id",$store_id);
		$this->db->update("store");

		$company_doc_val = $this->utils->upload_multiple_file("uploads/document","company_doc",$_FILES['company_doc']);
		$identity_doc_val = $this->utils->upload_multiple_file("uploads/document","identity_doc",$_FILES['identity_doc']);
		$identity_multi_doc_val = $this->utils->upload_multiple_file("uploads/document","identity_multi_doc",$_FILES['identity_multi_doc']);
		$book_twenty_doc_val = $this->utils->upload_multiple_file("uploads/document","book_twenty_doc",$_FILES['book_twenty_doc']);
		$book_bank_doc_val = $this->utils->upload_multiple_file("uploads/document","book_bank_doc",$_FILES['book_bank_doc']);
		$book_other_doc_val = $this->utils->upload_multiple_file("uploads/document","book_other_doc",$_FILES['book_other_doc']);
		$house_particular_doc_val = $this->utils->upload_multiple_file("uploads/document","house_particular_doc",$_FILES['house_particular_doc']);
		
		$company_doc_val = (count($company_doc_val))?implode(",",$company_doc_val):"";
		$identity_doc_val = (count($identity_doc_val))?implode(",",$identity_doc_val):"";
		$identity_multi_doc_val = (count($identity_multi_doc_val))?implode(",",$identity_multi_doc_val):"";
		$book_twenty_doc_val = (count($book_twenty_doc_val))?implode(",",$book_twenty_doc_val):"";
		$book_bank_doc_val = (count($book_bank_doc_val))?implode(",",$book_bank_doc_val):"";
		$book_other_doc_val = (count($book_other_doc_val))?implode(",",$book_other_doc_val):"";
		$house_particular_doc_val = (count($house_particular_doc_val))?implode(",",$house_particular_doc_val):"";
		
		$company_doc_ref = "";
		$identity_doc_ref = "";
		$identity_multi_doc_ref = "";
		$book_twenty_doc_ref = "";
		$book_bank_doc_ref = "";
		$book_other_doc_ref = "";
		$house_particular_doc_ref = "";

		$document_result = $this->model_registration->getStoreDocumentByID($store_id);
		foreach($document_result as $row){
			$company_doc_ref = $row->company_doc;
			$identity_doc_ref = $row->identity_doc;
			$identity_multi_doc_ref = $row->identity_multi_doc;
			$book_twenty_doc_ref = $row->book_twenty_doc;
			$book_bank_doc_ref = $row->book_bank_doc;
			$book_other_doc_ref = $row->book_other_doc;
			$house_particular_doc_ref = $row->house_particular_doc;
		}

		if(!empty($company_doc_val)){
			$company_doc = $company_doc_val;
		}else{
			$company_doc = $company_doc_ref;
		}
		if(!empty($identity_doc_val)){
			$identity_doc = $identity_doc_val;
		}else{
			$identity_doc = $identity_doc_ref;
		}

		if(!empty($identity_multi_doc_val)){
			$identity_multi_doc = $identity_multi_doc_val;
		}else{
			$identity_multi_doc = $identity_multi_doc_ref;
		}

		if(!empty($book_twenty_doc_val)){
			$book_twenty_doc = $book_twenty_doc_val;
		}else{
			$book_twenty_doc = $book_twenty_doc_ref;
		}

		if(!empty($book_bank_doc_val)){
			$book_bank_doc = $book_bank_doc_val;
		}else{
			$book_bank_doc = $book_bank_doc_ref;
		}
		
		if(!empty($book_other_doc_val)){
			$book_other_doc = $book_other_doc_val;
		}else{
			$book_other_doc = $book_other_doc_ref;
		}
		if(!empty($house_particular_doc_val)){
			$house_particular_doc = $house_particular_doc_val;
		}else{
			$house_particular_doc = $house_particular_doc_ref;
		}

		$docs = array(
			"store_id"=>$store_id,
			"company_doc"=>$company_doc,
			"identity_doc"=>$identity_doc,
			"identity_multi_doc"=>$identity_multi_doc,
			"book_twenty_doc"=>$book_twenty_doc,
			"book_bank_doc"=>$book_bank_doc,
			"book_other_doc"=>$book_other_doc,
			"house_particular_doc"=>$house_particular_doc,
		);
		
		$documents = $this->db->get_where('store_document_edit', array('store_id' => $store_id));
		$has_docs = $documents->num_rows();
		if($has_docs){
			$this->db->update("store_document_edit",$docs);
		}else{
			$this->db->insert("store_document_edit",$docs);
		}
		$this->membermanager->activeStore($store,TRUE);
		redirect("store");
	}
}