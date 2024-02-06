<?php
class Model_user extends CI_Model {

	function __construct()
    {
        parent::__construct();
    }
    public function getUserById($admin_id) // หมอ
   	{
        $query = $this->db->query('SELECT * FROM admin WHERE admin_id = '.$admin_id);

		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}	
    }
 

    public function getPermission()
    {
        $query = $this->db->select('*');
        $this->db->from('permission');
        $query = $this->db->get();
        if($query->num_rows() > 0 ) {
            return $query->result_array();
        } else {
            return array();
        }
    }  

    public function getPermissionByModuls($modules_name)
    {
        $query = $this->db->select('*');
        $this->db->from('permission');
        $this->db->where('per_name_en',$modules_name);
        $query = $this->db->get();
        if($query->num_rows() > 0 ) {
            return $query->result_array();
        } else {
            return array();
        }
    }  
  
     
}

?>
