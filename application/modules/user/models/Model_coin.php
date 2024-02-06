<?php
class Model_coin extends CI_Model {
  
  	public function getTopupByMemeberID($member_id,$per_page,$page_number)
	{
		$query = $this->db->query('SELECT "use" as main, order_use_coin as coin,order_code as code,timestamp FROM  order WHERE order_member_id='.$member_id.' AND order_use_coin_type != 1  UNION ALL SELECT "buy" as main, coin_top_up as coin,order_code as code ,timestamp FROM  topup WHERE member_id ='.$member_id);
        if($query->num_rows() > 0 ) {
            return $query->result();
        } else {
            return array();
        }
	}
	public function getTopupTotalRows($member_id)
	{
		$query = $this->db->query('SELECT * FROM  topup WHERE member_id = '.$member_id);
		return $query->num_rows();
	}
	public function getCoinByMemberID($member_id)
	{
		$query = $this->db->query('SELECT * FROM member WHERE member_id = '.$member_id);
		if($query->num_rows() > 0 ) {
			$res = $query->result();
			foreach($res as $row){
				$coin = $row->coin;	
			}
			return $coin;
		} else {
			return 0;
		}
	}
	public function getOrderTotalRows($member_id)
	{
		$query = $this->db->query('SELECT * FROM  order WHERE order_member_id = '.$member_id);
		return $query->num_rows();
	}
	public function getOrderByMemeberID($member_id,$per_page,$page_number)
	{
		$this->db->select("*");
		$this->db->from('order');
		$this->db->where("order_member_id",$member_id);
		$this->db->limit($per_page,$page_number);
		$this->db->order_by("timestamp","DESC");
		$query = $this->db->get();
		if($query->num_rows() > 0 ) {
			return $query->result();
		} else {
			return array();
		}
	}
}

?>
