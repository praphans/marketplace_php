<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Productmanager{
	
	private $CI;
	
	public function __construct()
	{
		$this->CI =& get_instance();
	}
	//รูปเริ่มต้นสินค้า
	public function default_image()
	{
		return "assets/default/default_image.jpg";
	}
	//หมวดหมู่สินค้าทั้งหมด
	public function getProductCategory(){
		return $this->CI->model_productmanager->getProductCategory();
	}
	//หมวดหมู่ย่อยสินค้าทั้งหมด
	public function getProductSubcategory(){
		return $this->CI->model_productmanager->getProductSubcategory();
	}
	//ประเภทสินค้าทั้งหมด
	public function getProductType(){
		return $this->CI->model_productmanager->getProductType();
	}
	//สินค้าทั้งหมดของคนที่เข้าระบบอยู่
	public function getProductList($page_number,$per_page){
		return $this->CI->model_productmanager->getProductList($page_number,$per_page);
	}
	//จำนวนสินค้าทั้งหมดที่มีอยู่ของร้านนี้
	public function getProductTotalRows(){
		return $this->CI->model_productmanager->getProductTotalRows();
	}
	//โปรโมชั่นทั้งหมดของสินค้าตัวนี้
	public function getPromotion($product_id){
		return $this->CI->model_productmanager->getPromoByProductID($product_id);
	}
	
	public function updateOrderStatusToWaitingForReview($order_id){
		$this->CI->db->select("*,DATEDIFF(CURDATE(), timestamp) AS diff");
		$this->CI->db->from("order");
		$this->CI->db->where("order_id",$order_id);
		//$this->db->where("DATE(timestamp)","CURDATE() - INTERVAL 5 day");
		//$this->CI->db->where("");
		$query = $this->CI->db->get();
		$is_waiting_for_review = 0;
		if($query->num_rows() > 0){
			$result = $query->result();
			foreach($result as $row){
				$diff = $row->diff;
				$order_status = $row->order_status;
			}
			if($diff >= 5 && $order_status != 11){
				$this->CI->db->set("order_status",10);
				$this->CI->db->where("order_id",$order_id);
				$this->CI->db->update("order");
				$is_waiting_for_review = 1;
				
				$this->orderStatusHistoryLog($order_id,$order_status);
			}
		}
		return $is_waiting_for_review;
	}
	public function orderStatusHistoryLog($order_id,$order_status){
			
			$member_id = $this->CI->membermanager->member_id();
			$member_id = ($member_id)?$member_id:0;
			$history = array(
				"order_id" => $order_id,			 
				"member_id" => $member_id,
				"order_status" => $order_status
			);
			//$this->CI->db->set("order_id",order_id);
			//$this->CI->db->set("order_status",order_status);
			$this->CI->db->insert("order_status_history",$history);
	}
	
}
