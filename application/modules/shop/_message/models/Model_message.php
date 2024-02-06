<?php
class Model_message extends CI_Model {
 
 	public $message_type_for_user = array(1,2,3,4);
 	public function getMessageType() 
	{     
		$this->db->select('*');
		$this->db->from('message_type');
		$this->db->where_in("id",$this->message_type_for_user);
		$query = $this->db->get();
		
		if($query->num_rows() > 0 ) {
		  	return $query->result();
		} else {
		  	return array();
		}
	}
	public function getAllMessageType() 
	{     
		$this->db->select('*');
		$this->db->from('message_type');
		$query = $this->db->get();
		
		if($query->num_rows() > 0 ) {
		  	return $query->result();
		} else {
		  	return array();
		}
	}
	
	public function getMessageTotalRows($member_id,$filter,$message_type) 
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
		
		$this->db->group_by("message_code");
		$query = $this->db->get();
		
		$total_rows = 0;
		$result = $query->result();
		foreach($result as $row){
			$message_id = $row->message_id;
			if($filter == "receive"){
				$last_sent = $this->getLastSenderMember($message_id);
				$last_sender_id = $last_sent[0]->sender_id;
				
			}else if($filter == "sent"){
				$last_sent = $this->getMyLastSenderMember($message_id);
				$last_sender_id = $last_sent[0]->sender_id;
			}
			if($last_sender_id != $this->membermanager->member_id() || $filter != "receive"){
				$total_rows++;	
			}else{
				
			}
		
		}
		
																
		return $total_rows;
	}
	public function getReceiveMessage($member_id,$message_type,$page_number,$per_page) 
	{     
		
		$this->db->select('*');
		$this->db->from('message');
		//$this->db->where('message_reply_id',0);
		if(isset($message_type) && $message_type != 0)$this->db->where("message_type",$message_type);
		$this->db->where('receiver_id',$member_id);
		$this->db->where('sender_id != ',$this->membermanager->member_id());
		/*if(isset($message_type) && ( $message_type == 1 || $message_type == 0)){
			$this->db->where('receiver_id',0);
		}else{
			
		}*/
		$this->db->group_by("message_code");
		$this->db->limit($per_page,$page_number);
		$this->db->order_by("is_pin","DESC");
		$this->db->order_by("timestamp","DESC");
		$query = $this->db->get();
		
		if($query->num_rows() > 0 ) {
		  	return $query->result();
		} else {
		  	return array();
		}
	 }
	 public function getSenderMessage($member_id,$message_type,$page_number,$per_page) 
	{     
		$this->db->select('*');
		$this->db->from('message');
		//$this->db->having('max(timestamp)');
		//$this->db->where('message_reply_id',0);
		$this->db->where('sender_id',$member_id);
		if(isset($message_type) && $message_type != 0)$this->db->where("message_type",$message_type);
		
		
		$this->db->group_by("message_code");
		$this->db->limit($per_page,$page_number);
		$this->db->order_by("is_pin","DESC");
		$this->db->order_by("timestamp","DESC");
		
		
		$query = $this->db->get();
		
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	
	
	public function getOrderByID($order_id) 
	{     
		$this->db->select('*');
		$this->db->from('order');
		$this->db->where('order_id',$order_id);
		$query = $this->db->get();
		
		if($query->num_rows() > 0 ) {
		  	return $query->result();
		} else {
		  	return array();
		}
	}
	
	public function getMemberIDByStoreID($store_id) 
	{     
		$this->db->select('member_id');
		$this->db->from('store');
		$this->db->where('store_id',$store_id);
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	public function getMemberByID($member_id) 
	{     
		$this->db->select('*');
		$this->db->from('member');
		$this->db->where('member_id',$member_id);
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	public function getMyFollower($store_id) 
	{     
		$this->db->select('member_id');
		$this->db->from('store_follow');
		$this->db->where('store_id',$store_id);
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	public function getStoreByID($store_id)
	{
		$query = $this->db->query('SELECT * FROM  store WHERE store_id = '.$store_id);
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	public function getMyReceiveMessage($member_id,$message_reply_id)
	{
		$query = $this->db->query('SELECT * FROM message WHERE receiver_id	 = '.$member_id.' AND  message_reply_id = '.$message_reply_id);
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	public function getMessageByID($message_id)
	{
		$query = $this->db->query('SELECT * FROM message WHERE message_id = '.$message_id);
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	public function getMessageANDReplyMessageByID($message_id)
	{
		
		$query = $this->db->query('SELECT * FROM message WHERE message_id = '.$message_id.' OR message_reply_id = '.$message_id.' GROUP BY topic_code ORDER BY timestamp ASC');
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	
	public function getLastSenderMember($message_id)
	{
		
		$query = $this->db->query('SELECT sender_id,message_reply_id,message_id,timestamp FROM message WHERE message_id = '.$message_id.' OR message_reply_id = '.$message_id.' ORDER BY timestamp DESC LIMIT 1');
		$result = $query->result();
		if($query->num_rows() > 0 ) {
			foreach($result as $row){
				$message_reply_id = $row->message_reply_id;
				$query = $this->db->query('SELECT sender_id,message_reply_id,message_id,timestamp FROM message WHERE message_reply_id = '.$message_reply_id.' ORDER BY timestamp DESC LIMIT 1');
			}
			if($query->num_rows() > 0 ) {
				$result = $query->result();
				return $result;
			} else {
				return array();
			}
			
		}else{
			return array();
			/*if($query->num_rows() > 0 ) {
				$result = $query->result();
				return $result;
			} else {
				return array();
			}*/
		}
	}
	public function getMyLastSenderMember($message_id)
	{
		$member_id = $this->membermanager->member_id();
		$query = $this->db->query('SELECT sender_id,message_reply_id,timestamp FROM message WHERE sender_id = '.$member_id.' AND ( message_id = '.$message_id.' OR message_reply_id = '.$message_id.' ) ORDER BY timestamp DESC LIMIT 1');
		if($query->num_rows() > 0 ) {
			$result = $query->result();
			return $result;
			//return $result[0]->sender_id;
		} else {
			return array();
		}
	}
	public function getMessageImageByID($message_id)
	{
		$query = $this->db->query('SELECT * FROM message_image WHERE message_id = '.$message_id);
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
	public function getMessageTypeByID($type_id)
	{
		$query = $this->db->query('SELECT * FROM message_type WHERE id = '.$type_id);
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
}
?>
