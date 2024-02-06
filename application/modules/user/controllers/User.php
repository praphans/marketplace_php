<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'third_party/omise/lib/Omise.php';

class User extends MX_Controller {

	public $PAGE;
	public function __construct() {
        parent::__construct();
		
		define('OMISE_PUBLIC_KEY', 'pkey_test_5f77edc0mdv5ycqkx9b');
		define('OMISE_SECRET_KEY', 'skey_test_5f77edc0lrl7bv4j3wt');
		define('OMISE_API_VERSION', '2017-11-02');

		$this->load->model("store/model_delivery");
		$this->load->model("store/model_saleitem");
		$this->load->model('model_user');
		$this->load->model('model_review');
		$this->load->model('model_coin');
		$this->load->model('store/model_coupon');
		$this->PAGE['title'] = 'ข้อมูลส่วนตัว | '.$this->load->get_var("default_title");
		$this->membermanager->checkLogin();
	}
	public function index()
	{
		redirect("user/order/all");
	}
	public function order($filter = "all")
	{
		$member_id = $this->membermanager->member_id();
		
		$post = $this->input->post();
		
		
		
		$page_number = ($this->uri->segment(4) != '')?$this->uri->segment(4):0; 
		
		$total_rows = $this->model_user->getOrderTotalRows($member_id,$filter,$post);
		$this->load->library('pagination');
		$config['base_url'] = base_url('user/order/'.$filter.'/');
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page = 2;
		
		
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = false;
		$config['last_link'] = false;
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['prev_link'] = '&laquo';
		$config['prev_tag_open'] = '<li class="prev">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '&raquo';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		
		$this->pagination->initialize($config);
		
		if($filter == "all"){
			$orders = $this->model_user->getOrderByMemberID($member_id,$page_number,$per_page,$post);
		}else if($filter == "myplace"){ // ส่งที่อยู่ผู้ซื้อ
			$orders = $this->model_user->getOrderMyPlaceByMemberID($member_id,$page_number,$per_page,$post);
		}else if($filter == "otherplace"){ // รับของเอง
			$orders = $this->model_user->getOrderOtherPlaceByMemberID($member_id,$page_number,$per_page,$post);
		}
		
		$this->PAGE['orders'] = $orders;
		
		$pages = ceil($total_rows/$per_page);
		$min_page = ($page_number+1);
		$max_page = count($orders);
		$max_page = $min_page+($max_page-1);
		$this->PAGE['page_showing'] = 'แสดง '.$min_page.' ถึง '.$max_page.' จาก '.$total_rows.' รายการ ( '.$pages.' หน้า )';
		$this->PAGE['pagination'] = $this->pagination->create_links();
		
		$this->PAGE['post'] = $post;
		$this->PAGE['filter'] = $filter;
		$this->load->view("user/user_view",$this->PAGE);
	}
	
	public function coupon($filter = "all")
	{
		$member_id = $this->membermanager->member_id();
		
		$post = $this->input->post();
		
		
		
		if($filter == "all"){
			$coupon_status = 1;
		}else if($filter == "expire"){ 
			$coupon_status = 3;
		}else if($filter == "success"){ 
			$coupon_status = 2;
		}
		$page_number = ($this->uri->segment(4) != '')?$this->uri->segment(4):0; 
		
		$total_rows = $this->model_user->getCouponTotalRows($member_id,$post,$coupon_status);
		
		
		
		$this->load->library('pagination');
		$config['base_url'] = base_url('user/coupon/'.$filter.'/');
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page = 5;
		
		
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = false;
		$config['last_link'] = false;
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['prev_link'] = '&laquo';
		$config['prev_tag_open'] = '<li class="prev">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '&raquo';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		
		$this->pagination->initialize($config);
		
		if($filter == "all"){
			$orders = $this->model_user->getCouponByMemberID($member_id,$page_number,$per_page,$post);
		}else if($filter == "expire"){ // ส่งที่อยู่ผู้ซื้อ
			$orders = $this->model_user->getCouponExpireByMemberID($member_id,$page_number,$per_page,$post);
		}else if($filter == "success"){ // รับของเอง
			$orders = $this->model_user->getCouponSuccessByMemberID($member_id,$page_number,$per_page,$post);
		}
		
		
		
		
		$this->PAGE['orders'] = $orders;
		
		$pages = ceil($total_rows/$per_page);
		$min_page = ($page_number+1);
		$max_page = count($orders);
		$max_page = $min_page+($max_page-1);
		$this->PAGE['page_showing'] = 'แสดง '.$min_page.' ถึง '.$max_page.' จาก '.$total_rows.' รายการ ( '.$pages.' หน้า )';
		$this->PAGE['pagination'] = $this->pagination->create_links();
		
		$this->PAGE['filter'] = $filter;
		$this->PAGE['post'] = $post;
		$this->load->view("user/coupon_view",$this->PAGE);
	}
	
	public function review($filter = "list"){
		
		$member_id = $this->membermanager->member_id();
		
		$post = $this->input->post();
		
		if(isset($post['review_type'])){
			$current_review_type = $post['review_type'];
		}else{
			$current_review_type = 0;
		}
		
		
		$page_number = ($this->uri->segment(4) != '')?$this->uri->segment(4):0; 
		
		
		if($filter == "list"){
			$total_rows = $this->model_review->getReviewTotalRows($member_id,$post);
		}else if($filter == "history"){
			$total_rows = $this->model_review->getReviewHistoryTotalRows($member_id,$post);
		}
		
		$this->load->library('pagination');
		$config['base_url'] = base_url('user/review/'.$filter.'/');
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page = 5;
		
		
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = false;
		$config['last_link'] = false;
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['prev_link'] = '&laquo';
		$config['prev_tag_open'] = '<li class="prev">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '&raquo';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		
		$this->pagination->initialize($config);
		
		if($filter == "list"){
			$orders = $this->model_review->getReviewOrder($member_id,$page_number,$per_page,$post);
		}else if($filter == "history"){
			$orders = $this->model_review->getReviewHistoryOrder($member_id,$page_number,$per_page,$post);
		}
		
		$this->PAGE['filter'] = $filter;
		$this->PAGE['orders'] = $orders;
		
		$pages = ceil($total_rows/$per_page);
		$min_page = ($page_number+1);
		$max_page = count($orders);
		$max_page = $min_page+($max_page-1);
		$this->PAGE['page_showing'] = 'แสดง '.$min_page.' ถึง '.$max_page.' จาก '.$total_rows.' รายการ ( '.$pages.' หน้า )';
		$this->PAGE['pagination'] = $this->pagination->create_links();
		
		$this->PAGE['post'] = $post;
		$this->PAGE['current_review_type'] = $current_review_type;
		
		//$this->PAGE['review_history'] = $this->model_review->getReviewByMemberID($member_id);
		if($filter == "list"){
			$this->load->view("user/review_view",$this->PAGE);
		}else if($filter == "history"){
			$this->load->view("user/review_history_view",$this->PAGE);
		}
	}
	public function addReview(){
		$post = $this->input->post();
		
		$review_images = $this->utils->upload_multiple_file("uploads/review","product_image",$_FILES['review_images'],800,600,FALSE);
		
		$image_list = array();
		if(isset($review_images) && !empty($review_images)){
			for($i=0;$i<count($review_images);$i++){
				$image_url = $review_images[$i];
				$this->db->set("image_url",$image_url);
				$this->db->insert("product_image");
				$image_id = $this->db->insert_id();
				array_push($image_list,$image_id);
			}
		}
		
		$review_images = implode(",",$image_list);
		$post['member_id'] = $this->membermanager->member_id();
		$post['review_images'] = $review_images;
		$this->db->insert("review",$post);
		
		$product_id = $post['product_id'];
		$review_type = $post['review_type'];
		$this->calculateProductReview($product_id,$review_type);
		
		if(isset($post['order_id'])){
			$this->db->set("order_status",11);
			$this->db->where("order_id",$post['order_id']); // รีวิวเรียบร้อยแล้ว
			$this->db->update("order");	
		}
		
		redirect("user/review");
		
	}
	private function calculateProductReview($product_id,$review_type){
		
		$reviews = $this->model_review->getReview($product_id,$review_type);
		$review_rating_total = 0;
		$num_of_review = count($reviews)*5;
		foreach($reviews as $row){
			$review_rating = $row->review_rating;
			$review_rating_total += $review_rating;
		}
		
		/*echo "product_id = ".$product_id."<br>";
		echo "review_rating_total = ".$review_rating_total."<br>";
		echo "num_of_review = ".$num_of_review."<br>";*/
		$products = $this->model_user->getProductByID($product_id);
		foreach($products as $row){
			$relate_id = $row->relate_id;
		}
		$product_rating = ($review_rating_total/$num_of_review)*100;
		if($product_rating){
			$this->db->where("product_id",$product_id);
			$this->db->or_where("product_id",$relate_id);
			$this->db->set("product_rating",$product_rating);
			$this->db->update("product");	
		}
	}
	public function coin(){
		$member_id = $this->membermanager->member_id();
		
		$page_number = ($this->uri->segment(3) != '')?$this->uri->segment(3):0; 
		
		
		$total_rows = $this->model_coin->getTopupTotalRows($member_id);
		
		$this->load->library('pagination');
		$config['base_url'] = base_url('user/coin/');
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page = 5;
		
		
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = false;
		$config['last_link'] = false;
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['prev_link'] = '&laquo';
		$config['prev_tag_open'] = '<li class="prev">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '&raquo';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		
		$this->pagination->initialize($config);
		
		$this->PAGE['coins'] = $coins = $this->model_coin->getTopupByMemeberID($member_id,$per_page,$page_number);
		
		$pages = ceil($total_rows/$per_page);
		$min_page = ($page_number+1);
		$max_page = count($coins);
		$max_page = $min_page+($max_page-1);
		$this->PAGE['page_showing'] = 'แสดง '.$min_page.' ถึง '.$max_page.' จาก '.$total_rows.' รายการ ( '.$pages.' หน้า )';
		$this->PAGE['pagination'] = $this->pagination->create_links();
		
		$this->PAGE['member_coin'] = $this->model_coin->getCoinByMemberID($member_id);
		$this->load->view("user/coin_history_view",$this->PAGE);
	}
	public function coin_top_up(){
		//$this->load->view("user/pay_view",$this->PAGE);
		$this->load->view("user/coin_view",$this->PAGE);
	}
	public function topup(){
		
		
		//$account = OmiseAccount::retrieve();
		//echo $account['email'];
		$omiseToken = $this->input->post('omiseToken');
		$amount = $this->input->post('money_top_up');
		
		$charge = OmiseCharge::create(array(
		  'amount' => $amount,
		  'currency' => 'thb',
		  'card' => $omiseToken
		));
		
		/*if ($charge['status'] == 'successful') {
		  echo 'Success';
		} else {
		  echo 'Fail';
		}
		
		print('<pre>');
		print_r($charge);
		print('</pre>');*/
		
		if ($charge['status'] == 'successful') {
			$money_top_up = $this->input->post('money_top_up');
			$coin_top_up = $this->input->post('coin_top_up');
			$order_code = $this->input->post('order_code');
			$member_id = $this->membermanager->member_id();
			
			$coin_value = $this->load->get_var('coin_value');
			$money_top_up = $coin_top_up*$coin_value;
			$data = array(
				"money_top_up"=>$money_top_up,	
				"coin_top_up"=>$coin_top_up,
				"order_code"=>$this->utils->getTopupOrderCode(),
				"member_id"=>$member_id,
			);
			
		
			$this->db->insert("topup",$data);
			
			
			$this->db->set('coin','coin + '.(int) $money_top_up, FALSE);
			$this->db->where("member_id",$member_id);
			$this->db->update("member");
		}
		redirect("user/coin");
	}
	public function shipping()
	{
		$user_place = $this->model_storemanager->getUserPlace();
		$this->PAGE['user_place'] = $user_place;
		$this->load->view("user/shipping_view",$this->PAGE);
	}
	public function editShipping($place_id){
		$user_place = $this->model_storemanager->getPlaceByID($place_id);
		$this->PAGE['user_place'] = $user_place;
		$this->load->view("user/shipping_edit_place_view",$this->PAGE);
	}
	public function savePlace(){
		$place = $this->input->post();
		$place['place_code'] = "P".time();
		$place['member_id'] = $this->membermanager->member_id();
		$place['place_status'] = 2;
		$working_time = $place['working_time'];
		$open_time = $place['open_time'];
		$close_time = $place['close_time'];
		$open_all_day = (isset($place['open_all_day']))?$place['open_all_day']:array();
		
		unset($place['working_time']);
		unset($place['open_time']);
		unset($place['close_time']);
		unset($place['open_all_day']);
		
		
		$this->db->insert("store_place",$place);
		$place_id = $this->db->insert_id();
		
		for($i = 0;$i<count($working_time);$i++){
			$work_day = $working_time[$i];
			$work_starttime = $open_time[$i];
			$work_endtime = $close_time[$i];
			$all_day = (isset($open_all_day[$i]))?$open_all_day[$i]:0;
			$working = array(
				"place_id"=>$place_id,
				"work_day"=>$work_day,
				"work_starttime"=>$work_starttime,
				"work_endtime"=>$work_endtime,
				"open_all_day"=>$all_day
			);
			
			$this->db->insert("store_working_time",$working);
		}
		redirect("user/shipping","refresh");
	}
	public function updatePlace(){
		$place = $this->input->post();
		$place_id = $this->input->post('place_id');
		$place['member_id'] = $this->membermanager->member_id();
		
		$open_all_day = explode(',',$this->input->post('open_all_day'));
		
		//$place['place_code'] = "P".time();
		
		$working_time = $place['working_time'];
		$open_time = $place['open_time'];
		$close_time = $place['close_time'];
		//$open_all_day = $place['open_all_day'];
		
		unset($place['place_id']);
		unset($place['working_time']);
		unset($place['open_time']);
		unset($place['close_time']);
		unset($place['open_all_day']);
		
		$this->db->where("place_id",$place_id);
		$this->db->update("store_place",$place);
		
		
		if($place_id){
			$this->db->where("place_id",$place_id);
			$this->db->delete("store_working_time");
			
			for($i = 0;$i<count($working_time);$i++){
				$work_day = $working_time[$i];
				$work_starttime = $open_time[$i];
				$work_endtime = $close_time[$i];
				$all_day = $open_all_day[$i];
				
				$working = array(
					"place_id"=>$place_id,
					"work_day"=>$work_day,
					"work_starttime"=>$work_starttime,
					"work_endtime"=>$work_endtime,
					"open_all_day"=>$all_day
				);
				
				$this->db->insert("store_working_time",$working);
			}
		}
		redirect("user/shipping","refresh");
	}
	public function cancelPlace($place_id) {
		$this->membermanager->checkLogin();
		if(isset($place_id)){
			$this->db->where("place_id",$place_id);
			$this->db->set("place_status",0);
			$this->db->update("store_place");
		}
		
		redirect("user/shipping","refresh");
	}
	public function delete($order_id) {
		$this->membermanager->checkLogin();
		if(isset($order_id)){
			$this->db->where("order_id",$order_id);
			$this->db->set("order_status",4);
			$this->db->update("order");
		}
		
		redirect("user/order","refresh");
	}
	
	public function delivered($order_id = 0,$order_status = 1){
		$this->membermanager->checkLogin();
		
		/*$orders = $this->model_saleitem->getOrderByOrderID($order_id);
		foreach($orders as $row){
			$order_shipping_type_id = $row->order_shipping_type_id;  
		}*/
		
		if($order_status != 4 && $order_status != 10 && $order_status != 11){
			$this->db->select("order_status");
			$this->db->from("order");
			$this->db->where("order_id",$order_id);
			$query = $this->db->get();
			$result = $query->result();
			$current_order_status = 0;
			if(count($result) > 0)$current_order_status = $result[0]->order_status;
			
			if($current_order_status != 11){ // ถ้ารีวิวแล้วเปลี่ยนสถานะไม่ได้
				$this->db->set("order_status",$order_status);
				$this->db->where("order_id",$order_id);
				$this->db->update("order");
				$this->productmanager->orderStatusHistoryLog($order_id,$order_status);
			}else{
				$this->session->set_flashdata('error_msg', 'รายการสั่งซื้อที่มีรีวิว ไม่สามารถเปลี่ยนสถานะได้');
			}
		}
		redirect("user/order");
	}
	public function orderinfo($order_code){
		$this->membermanager->checkLogin();
		if(!isset($order_code)){
			redirect("store/".$this->router->fetch_class());
		}
		$orders = $this->model_saleitem->getOrderGroupByOrderCode($order_code);
		$this->PAGE['orders'] = $orders;
		$this->PAGE['order_code'] = $order_code;
		$this->load->view("store/orderinfo_view",$this->PAGE);
	}
	public function coin_use(){

		$member_id = $this->membermanager->member_id();
		$page_number = ($this->uri->segment(3) != '')?$this->uri->segment(3):0; 
	
		$total_rows = $this->model_coin->getOrderTotalRows($member_id);

		$this->load->library('pagination');
		$config['base_url'] = base_url('user/coin_use/');
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page = 10;
		
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = false;
		$config['last_link'] = false;
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['prev_link'] = '&laquo';
		$config['prev_tag_open'] = '<li class="prev">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '&raquo';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		
		$this->pagination->initialize($config);
		
		$this->PAGE['coins'] = $coins = $this->model_coin->getOrderByMemeberID($member_id,$per_page,$page_number);
		
		$pages = ceil($total_rows/$per_page);
		$min_page = ($page_number+1);
		$max_page = count($coins);
		$max_page = $min_page+($max_page-1);
		$this->PAGE['page_showing'] = 'แสดง '.$min_page.' ถึง '.$max_page.' จาก '.$total_rows.' รายการ ( '.$pages.' หน้า )';
		$this->PAGE['pagination'] = $this->pagination->create_links();
		
		$this->load->view("user/coin_use_view",$this->PAGE);
	}

}