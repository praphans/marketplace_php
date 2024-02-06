<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setting{
	private $CI;
	
	public function __construct()
	{
		$this->CI =& get_instance();
		
	}
	
	public function get_Image()
	{
		$default_logo = $this->CI->model_main->getMarketplace();
		return $default_logo[0]->default_logo;
	}
}
