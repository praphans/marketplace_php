<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MX_Controller {

	public $PAGE;
	
	public function __construct() {
        parent::__construct();
		$this->PAGE['title'] = 'รายการ Modules';
	}
	public function index()
	{
		
		$modulesList = array();
		$directory    = APPPATH.'modules/*';
		foreach(glob($directory, GLOB_ONLYDIR) as $dir) {
    		$dir = str_replace($directory, '', $dir);
    		$dir = explode("/",$dir);
			array_push($modulesList,$dir[count($dir)-1]);
		}
		$this->PAGE['modulesList'] = $modulesList;
		$this->load->view("main_view",$this->PAGE);
	}
}
