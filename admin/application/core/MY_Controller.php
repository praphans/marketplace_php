<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller{
		
			function __construct() {
		        parent::__construct();
				
				if($this->session->userdata("lang") == NULL){
					$lang = "th";
					$this->session->set_userdata("lang",$lang);
				}else{
					$lang =  $this->session->userdata("lang");
				}
				if($lang == "en"){
					$lang = "english";	
				}else if($lang == "th"){
					$lang = "thailand";	
				}else if($lang == "jp"){
					$lang = "japanese";	
				}
				
				//$this->lang->load($lang,$lang);
		    }
			
			public function lang($lang){
				//$this->session->sess_destroy();
				$this->session->set_userdata("lang",$lang);
				redirect($this->router->class);
			}
			
			
	}
?>