<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends MX_Controller {

	public $PAGE;
	public function __construct() {
        parent::__construct();
		$this->PAGE['title'] = 'ติดต่อเรา | '.$this->load->get_var("default_title");
		//$this->load->model("model_contact");
	}
	public function index()
	{
		
		$this->load->view("contact_view",$this->PAGE);	
	}
	public function send()
	{
		$post = $this->input->post();
		$this->db->insert("contact",$post);
		$this->session->set_flashdata('error_msg', 'ได้รับข้อมูลเรียบร้อยแล้ว ทีมงานจะติดต่อกลับโดยเร็วที่สุด');
		redirect("contact");
	}
}