<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Statistics extends MX_Controller { 
	
	public $PAGE;
	public function __construct() {
        parent::__construct();
		$this->PAGE['title'] = 'ผลรวมสถิติ | '.$this->load->get_var("default_title");
		$this->load->model('statistics/model_statistics');
		$this->utils->checkLogin();
	}
	

	public function index()
	{
		// จำนวนร้านค้า
		$store_count_result = $this->model_statistics->getStoreCount();
		$product_count_result = $this->model_statistics->getProductCount();
		$order_count_result = $this->model_statistics->getOrderCount();
		$member_count_result = $this->model_statistics->getMemberCount();
		// จำนวนใบสั่งซื้อ
		$order_status_result_1 = $this->model_statistics->getOrderCountS1();
		$order_status_result_2 = $this->model_statistics->getOrderCountS2();
		$order_status_result_3 = $this->model_statistics->getOrderCountS3();
		$order_status_result_4 = $this->model_statistics->getOrderCountS4();

		// จำนวนการลงทะเบียน 
		$year1 = date("Y"); // ปีปัจจุบัน
        $year2 = date("Y")-1;
        $year3 = date("Y")-2;
        $year4 = date("Y")-3;
        $year5 = date("Y")-4;
        $year6 = date("Y")-5;
        $year7 = date("Y")-6;
		$store_year_result_1 = $this->model_statistics->getStoreCountByYear1($year1);
		$store_year_result_2 = $this->model_statistics->getStoreCountByYear2($year2);
		$store_year_result_3 = $this->model_statistics->getStoreCountByYear3($year3);
		$store_year_result_4 = $this->model_statistics->getStoreCountByYear4($year4);
		$store_year_result_5 = $this->model_statistics->getStoreCountByYear5($year5);
		$store_year_result_6 = $this->model_statistics->getStoreCountByYear6($year6);
		$store_year_result_7 = $this->model_statistics->getStoreCountByYear7($year7);

		$member_year_result_1 = $this->model_statistics->getMemberCountByYear1($year1);
		$member_year_result_2 = $this->model_statistics->getMemberCountByYear2($year2);
		$member_year_result_3 = $this->model_statistics->getMemberCountByYear3($year3);
		$member_year_result_4 = $this->model_statistics->getMemberCountByYear4($year4);
		$member_year_result_5 = $this->model_statistics->getMemberCountByYear5($year5);
		$member_year_result_6 = $this->model_statistics->getMemberCountByYear6($year6);
		$member_year_result_7 = $this->model_statistics->getMemberCountByYear7($year7);
		// จำนวนรีวิว
		$review_store_result = $this->model_statistics->getReviewStore();
		$review_ship_result = $this->model_statistics->getReviewShipper();
		$review_product_result = $this->model_statistics->getReviewProduct();

		$this->PAGE['store_count_result'] = $store_count_result;
		$this->PAGE['product_count_result'] = $product_count_result;
		$this->PAGE['order_count_result'] = $order_count_result;
		$this->PAGE['member_count_result'] = $member_count_result;

		$this->PAGE['order_status_result_1'] = $order_status_result_1;
		$this->PAGE['order_status_result_2'] = $order_status_result_2;
		$this->PAGE['order_status_result_3'] = $order_status_result_3;
		$this->PAGE['order_status_result_4'] = $order_status_result_4;

		$this->PAGE['year1'] = $year1;
		$this->PAGE['year2'] = $year2;
		$this->PAGE['year3'] = $year3;
		$this->PAGE['year4'] = $year4;
		$this->PAGE['year5'] = $year5;
		$this->PAGE['year6'] = $year6;
		$this->PAGE['year7'] = $year7;
		$this->PAGE['store_year_result_1'] = $store_year_result_1;
		$this->PAGE['store_year_result_2'] = $store_year_result_2;
		$this->PAGE['store_year_result_3'] = $store_year_result_3;
		$this->PAGE['store_year_result_4'] = $store_year_result_4;
		$this->PAGE['store_year_result_5'] = $store_year_result_5;
		$this->PAGE['store_year_result_6'] = $store_year_result_6;
		$this->PAGE['store_year_result_7'] = $store_year_result_7;

		$this->PAGE['member_year_result_1'] = $member_year_result_1;
		$this->PAGE['member_year_result_2'] = $member_year_result_2;
		$this->PAGE['member_year_result_3'] = $member_year_result_3;
		$this->PAGE['member_year_result_4'] = $member_year_result_4;
		$this->PAGE['member_year_result_5'] = $member_year_result_5;
		$this->PAGE['member_year_result_6'] = $member_year_result_6;
		$this->PAGE['member_year_result_7'] = $member_year_result_7;

		$this->PAGE['review_store_result'] = $review_store_result;
		$this->PAGE['review_ship_result'] = $review_ship_result;
		$this->PAGE['review_product_result'] = $review_product_result;

		$this->load->view("statistics_view",$this->PAGE);
	}
	
	

	
}
