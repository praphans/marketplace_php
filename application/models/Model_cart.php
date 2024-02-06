<?php
class Model_cart extends CI_Model {
 	
	
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
	public function getInboxUnread($member_id,$filter,$message_type)
	{
		
		$this->db->select('message_id');
		$this->db->from('message');
		//$this->db->where('message_reply_id',0);
		if(isset($message_type) && $message_type != 0)$this->db->where("message_type",$message_type);
		
		
		if($filter == "receive"){
			//$this->db->where('sender_id != ',$member_id);
			$this->db->where('receiver_id',$member_id);
		}else{
			$this->db->where('sender_id',$member_id);
			//$this->db->where('receiver_id != ',$member_id);
		}
		$this->db->where('is_read',0);
		$this->db->group_by("message_code");
		$query = $this->db->get();
		
		$total_rows = 0;
		$result = $query->result();
		foreach($result as $row){
			$message_id = $row->message_id;
			if($filter == "receive"){
				$last_sent = $this->model_message->getLastSenderMember($message_id);
				$last_sender_id = $last_sent[0]->sender_id;
				
			}else if($filter == "sent"){
				$last_sent = $this->model_message->getMyLastSenderMember($message_id);
				$last_sender_id = $last_sent[0]->sender_id;
			}
			if($last_sender_id != $this->membermanager->member_id() || $filter != "receive"){
				$total_rows++;	
			}else{
				
			}
		
		}
		
																
		return $total_rows;
		
		
		/*if($this->membermanager->isLoggedIn()){
			$member_id  = $this->membermanager->member_id();
			$query = $this->db->query('SELECT message_id FROM message WHERE receiver_id = '.$member_id.' AND sender_id != '.$member_id.' AND is_read = 0 GROUP BY receiver_id'); 
			if($query->num_rows() > 0 ) {
				return $query->result();
			} else {
				return array();
			}
		}else{
			return array();
		}*/
		
		
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
	
	public function getProductByID($product_id)
	{
		$query = $this->db->query('SELECT * FROM  product WHERE product_id = '.$product_id); 
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	
}

?>
