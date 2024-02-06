<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

require dirname(__FILE__).'/Base.php';

class MX_Controller 
{
	private $datahtml;
	private $CI;
	//public $test = "test asdfsafsafsa";
	public $autoload = array();
	//public $method = array();
	public function __construct() 
	{
		
		
						
							
		$class = str_replace(CI::$APP->config->item('controller_suffix'), '', get_class($this));
		log_message('debug', $class." MX_Controller Initialized");
		Modules::$registry[strtolower($class)] = $this;	
		
		/* copy a loader instance and initialize */
		$this->load = clone load_class('Loader');
		$this->load->initialize($this);	
		
		/* autoload module items */
		$this->load->_autoloader($this->autoload);
		/*$this->method = get_class_methods($this->router->fetch_class());
		for($i = 0;$i<count($this->method);$i++){
			$strpos = $this->method[$i];
			if(strrpos($strpos,"_")){
				array_splice($this->method, $i, 1);
			}
		}*/
		$contact_info = $this->model_contact->getContactInfo();
		foreach($contact_info as $row){
			$default_title = $row->default_title;
			$footer_description = $row->footer_description;
			$contact_description = $row->contact_description;
			$copyright = $row->copyright;
			$twitter_url = $row->twitter_url;
			$facebook_url = $row->facebook_url;
			$youtube_url = $row->youtube_url;
			$instagram_url = $row->instagram_url;
			$store_url_description = $row->store_url_description;
			$store_review_description = $row->store_review_description;
			$coin_value = $row->coin_value;
			$default_logo = $row->default_logo;
			$term = $row->term;
		} 
		$this->datahtml = array(
			'default_title' => $default_title,
			'contact_description' => $contact_description,
			'footer_description' => $footer_description,
			'copyright' => $copyright,
			'twitter_url' => $twitter_url,
			'facebook_url' => $facebook_url,
			'youtube_url' => $youtube_url,
			'instagram_url' => $instagram_url,
			'store_url_description' => $store_url_description,
			'store_review_description' => $store_review_description,
			'coin_value' => $coin_value,
			'default_logo' => $default_logo,
			'term' => $term
		);
		
		$this->storemanager->statusUpdate();
        $this->load->vars($this->datahtml);
	}
	
	public function __get($class) 
	{
		return CI::$APP->$class;
	}
	
	public function ckStore(){
		$store_status = $this->session->userdata('store_status');
		if($store_status == 1 || $store_status == 3 || $store_status == 4 || $store_status == 6){
			redirect("home");
		}	
	}
	
}