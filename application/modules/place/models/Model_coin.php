<?php
class Model_coin extends CI_Model {
  
  	public function getTopupByMemeberID($member_id,$per_page,$page_number)
	{
		$this->db->select("*");
		$this->db->from('topup');
		$this->db->where("member_id",$member_id);
		$this->db->limit($per_page,$page_number);
		$this->db->order_by("timestamp","DESC");
		$query = $this->db->get();
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
}

?>
