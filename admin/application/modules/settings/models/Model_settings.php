<?php
class Model_settings extends CI_Model {
    
    public function getAdmin(){
        
        $query = $this->db->query('SELECT * FROM admin WHERE allow_to_login = 1 ORDER BY user_type DESC  ');

        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getAdminByID($admin_id)
    {
            $query = $this->db->query('SELECT * FROM admin WHERE admin_id = '.$admin_id);
         if($query->num_rows() > 0 ) {
             return $query->result();
         } else {
             return array();
         }
    }
    public function getMemberType()
       {
           	$query = $this->db->query('SELECT * FROM member_type');
			if($query->num_rows() > 0 ) {
				return $query->result();
			} else {
				return array();
			}
       }
    public function getMemberTypeByID($type_id)
    {
        $query = $this->db->query('SELECT * FROM member_type WHERE type_id = '.$type_id);
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function getContactInfo()
    {
        $query = $this->db->query('SELECT * FROM contact_info');
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }
    public function getUserType()
    {
        $query = $this->db->query('SELECT * FROM  user_type');
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function getUserTypeByID($user_type)
    {
        $query = $this->db->query('SELECT * FROM  user_type WHERE user_type_id ='.$user_type);
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
            return $query->result();
        } else {
            return array();
        }
    }  

    public function getPermissionByID($module)
    {
        $query = $this->db->select('*');
        $this->db->from('permission');
        $this->db->where_in('per_id', $module);
        $query = $this->db->get();
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    } 

    public function getTypeArr()
    {
        $query = $this->db->query('SELECT * FROM admin WHERE allow_to_login = 1');
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
    }

    

}

?>
