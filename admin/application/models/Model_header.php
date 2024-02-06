<?php
class Model_header extends CI_Model {

	function __construct()
    {
        parent::__construct();
    }
    public function get_img() 
   	{
        $query = $this->db->query('SELECT default_logo FROM contact_info ORDER BY id DESC LIMIT 1');

		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}	
    }
    
  
     
}

?>
