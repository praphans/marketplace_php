<?php
class Model_category extends CI_Model {
 	
	
	public function getWishlistProductCart()
	{
		if($this->membermanager->isLoggedIn()){
			$member_id  = $this->membermanager->member_id();
			$query = $this->db->query('SELECT * FROM  wishlist WHERE member_id = '.$member_id.' AND wishlist_status = 1'); 
		}else{
			$sess_id = $this->session->userdata("sess_id");
			if(empty($sess_id))$sess_id = 0;
			$query = $this->db->query('SELECT * FROM  wishlist WHERE sess_id = "'.$sess_id.'" AND wishlist_status = 1');
		}
		
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	
	public function getWishlistHasAlready($product_id)
	{
		if($this->membermanager->isLoggedIn()){
			$member_id  = $this->membermanager->member_id();
			$query = $this->db->query('SELECT * FROM  wishlist WHERE member_id = '.$member_id.' AND product_id = '.$product_id.' AND wishlist_status = 1'); 
		}else{
			$sess_id = $this->session->userdata("sess_id");
			if(empty($sess_id))$sess_id = 0;
			$query = $this->db->query('SELECT * FROM  wishlist WHERE sess_id = "'.$sess_id.'" AND product_id = '.$product_id.'  AND wishlist_status = 1');
		}
		return $query->num_rows();
	}
	
	
	public function getGroupProductCart()
	{
		if($this->membermanager->isLoggedIn()){
			$member_id  = $this->membermanager->member_id();
			$query = $this->db->query('SELECT * FROM cart WHERE member_id = '.$member_id.' AND cart_status = 1 GROUP BY product_id'); 
		}else{
			$sess_id = $this->session->userdata("sess_id");
			if(empty($sess_id))$sess_id = 0;
			$query = $this->db->query('SELECT * FROM cart WHERE sess_id = "'.$sess_id.'" AND cart_status = 1 GROUP BY product_id');
		}
		
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	public function getProductCart($product_id)
	{
		if($this->membermanager->isLoggedIn()){
			$member_id  = $this->membermanager->member_id();
			$query = $this->db->query('SELECT * FROM cart WHERE product_id = '.$product_id.' AND member_id = '.$member_id.' AND cart_status = 1 '); 
		}else{
			$sess_id = $this->session->userdata("sess_id");
			if(empty($sess_id))$sess_id = 0;
			$query = $this->db->query('SELECT * FROM cart WHERE product_id = '.$product_id.' AND sess_id = "'.$sess_id.'" AND cart_status = 1 ');
		}
		
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	
	public function getStoreProductCart()
	{
		if($this->membermanager->isLoggedIn()){
			$member_id  = $this->membermanager->member_id();
			$query = $this->db->query('SELECT * FROM cart WHERE member_id = '.$member_id.' AND cart_status = 1 GROUP BY store_id'); 
		}else{
			$sess_id = $this->session->userdata("sess_id");
			if(empty($sess_id))$sess_id = 0;
			$query = $this->db->query('SELECT * FROM cart WHERE sess_id = "'.$sess_id.'" AND cart_status = 1 GROUP BY store_id');
		}
		
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	public function getStoreProductCartByID($store_id)
	{
		if($this->membermanager->isLoggedIn()){
			$member_id  = $this->membermanager->member_id();
			$query = $this->db->query('SELECT * FROM cart WHERE member_id = '.$member_id.' AND cart_status = 1 AND store_id = '.$store_id.' GROUP BY product_id'); 
		}else{
			$sess_id = $this->session->userdata("sess_id");
			if(empty($sess_id))$sess_id = 0;
			$query = $this->db->query('SELECT * FROM cart WHERE sess_id = "'.$sess_id.'" AND cart_status = 1 AND store_id = '.$store_id.' GROUP BY product_id');
		}
		
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	
}

?>
