<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

require dirname(__FILE__).'/Base.php';

class MX_Controller 
{
	private $datahtml;
	private $CI;

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

		$this->datahtml = array('default_title' => 'Marketplace');
        $this->load->vars($this->datahtml);
	}
	
	public function __get($class) 
	{
		return CI::$APP->$class;
	}
	
}