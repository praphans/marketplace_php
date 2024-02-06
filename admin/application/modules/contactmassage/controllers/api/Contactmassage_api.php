<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contactmassage_api extends MX_Controller {
	
	public $PAGE;
	public function __construct() {
        parent::__construct();
		$this->load->model('contactmassage/model_contactmassage');
		$this->utils->checkLogin();
	}

	public function getContactmassage()
	{
		$contactmassage_arr = array();
        $contactmassage_arr['data'] = array();
		$contactmassage = $this->model_contactmassage->getContactmassage();
        if(!empty($contactmassage)):
			foreach($contactmassage as $row):
				$contact_id = $row->contact_id;
				$name = $row->name;
				$subject = $row->subject;
				$phone = $row->phone;
				$detail = $row->detail;
				$timestamp = $row->timestamp;
		
				$thaidate = $this->utils->getThaiDate($timestamp);
				$new_subject = wordwrap($subject,45, "<br>", true);
				$new_detail = wordwrap($detail,45, "<br>", true);
				$contactmassage_arr['data'][] = array(
					$thaidate,
					$name,
					$phone,
					$new_subject,
					$detail,

				);
               
            endforeach;
        endif;
        $json = json_encode($contactmassage_arr);
		echo $json;
	}
	

}
