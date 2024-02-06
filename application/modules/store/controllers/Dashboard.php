<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MX_Controller {   

	public $PAGE;
	public function __construct() {
        parent::__construct();
		
		$this->PAGE['title'] = 'ผลการดำเนินงาน | '.$this->load->get_var("default_title");
		$this->membermanager->checkLogin();
		$this->load->model("model_dashboard");
		$this->load->helper(array('form', 'url'));
		$config['upload_path'] = 'uploads';
		$config['allowed_types'] = 'svg|gif|jpg|png|doc|doc'; 
		$config['encrypt_name'] = TRUE;
		$this->load->library('upload', $config);
		$this->storemanager->hasStore();
	}
	public function index()
	{
		
		//$this->ckStore();
		
		$store_id = $this->storemanager->store_id();
		$mystore = $this->model_dashboard->getStoreByID($store_id);
		$follow_result = $this->model_dashboard->getFollowByID($store_id);

		$star_all_result = $this->model_dashboard->getStarAll($store_id);
		$rating_all_result = $this->model_dashboard->getRatingAll($store_id);
		$rating_five_result = $this->model_dashboard->getRatingFive($store_id);
		$rating_four_result = $this->model_dashboard->getRatingFour($store_id);
		$rating_three_result = $this->model_dashboard->getRatingThree($store_id);
		$rating_two_result = $this->model_dashboard->getRatingTwo($store_id);
		$rating_one_result = $this->model_dashboard->getRatingOne($store_id);

		$product_all_result = $this->model_dashboard->getProductOrderByID($store_id);
		$product_year_result = $this->model_dashboard->getProductOrderYear($store_id);
		$product_year_dontdelete_result = $this->model_dashboard->getProductOrderYearDontDelete($store_id);
		// $product_new_result = $this->model_dashboard->getProductNewYear($store_id);
		$product_new_dontdelete_result = $this->model_dashboard->getProductNewYearDontDelete($store_id);
		$product_pending_result = $this->model_dashboard->getProductPending($store_id);
		$product_suspend_result = $this->model_dashboard->getProductSuspend($store_id);

		$product_order_all_result = $this->model_dashboard->getOrderAllByID($store_id);
		$product_order_today_result = $this->model_dashboard->getOrderToday($store_id);
		$product_order_week_result = $this->model_dashboard->getOrderWeek($store_id);
		$product_order_month_result = $this->model_dashboard->getOrderMonth($store_id);
		$product_order_year_result = $this->model_dashboard->getOrderYear($store_id);

		$product_sell_all_result = $this->model_dashboard->getSellAll($store_id);
		$product_sell_today_result = $this->model_dashboard->getSellToDay($store_id);
		$product_sell_week_result = $this->model_dashboard->getSellWeek($store_id);
		$product_sell_month_result = $this->model_dashboard->getSellMonth($store_id);
		$product_sell_year_result = $this->model_dashboard->getSellYear($store_id);

		$product_delivery_all_result = $this->model_dashboard->getDeliveryAll($store_id);
		$product_delivery_today_result = $this->model_dashboard->getDeliveryToday($store_id);
		$product_delivery_week_result = $this->model_dashboard->getDeliveryWeek($store_id);
		$product_delivery_month_result = $this->model_dashboard->getDeliveryMonth($store_id);
		$product_delivery_year_result = $this->model_dashboard->getDeliveryYear($store_id);

		$depositor_cost_all_result = $this->model_dashboard->getDepositorCostAll($store_id);
		$depositor_cost_today_result = $this->model_dashboard->getDepositorCostToday($store_id);
		$depositor_cost_week_result = $this->model_dashboard->getDepositorCostWeek($store_id);
		$depositor_cost_month_result = $this->model_dashboard->getDepositorCostMonth($store_id);
		$depositor_cost_year_result = $this->model_dashboard->getDepositorCostYear($store_id);

		$this->PAGE['mystore'] = $mystore;
		$this->PAGE['follow_result'] = $follow_result;

		$this->PAGE['star_all_result'] = $star_all_result;
		$this->PAGE['rating_all_result'] = $rating_all_result;
		$this->PAGE['rating_five_result'] = $rating_five_result;
		$this->PAGE['rating_four_result'] = $rating_four_result;
		$this->PAGE['rating_three_result'] = $rating_three_result;
		$this->PAGE['rating_two_result'] = $rating_two_result;
		$this->PAGE['rating_one_result'] = $rating_one_result;

		$this->PAGE['product_all_result'] = $product_all_result;
		$this->PAGE['product_year_result'] = $product_year_result;
		$this->PAGE['product_year_dontdelete_result'] = $product_year_dontdelete_result;
		// $this->PAGE['product_new_result'] = $product_new_result;
		$this->PAGE['product_new_dontdelete_result'] = $product_new_dontdelete_result;
		$this->PAGE['product_pending_result'] = $product_pending_result;
		$this->PAGE['product_suspend_result'] = $product_suspend_result;

		$this->PAGE['product_order_all_result'] = $product_order_all_result;
		$this->PAGE['product_order_today_result'] = $product_order_today_result;
		$this->PAGE['product_order_week_result'] = $product_order_week_result;
		$this->PAGE['product_order_month_result'] = $product_order_month_result;
		$this->PAGE['product_order_year_result'] = $product_order_year_result;

		$this->PAGE['product_sell_all_result'] = $product_sell_all_result;
		$this->PAGE['product_sell_today_result'] = $product_sell_today_result;
		$this->PAGE['product_sell_week_result'] = $product_sell_week_result;
		$this->PAGE['product_sell_month_result'] = $product_sell_month_result;
		$this->PAGE['product_sell_year_result'] = $product_sell_year_result;

		$this->PAGE['product_delivery_all_result'] = $product_delivery_all_result;
		$this->PAGE['product_delivery_today_result'] = $product_delivery_today_result;
		$this->PAGE['product_delivery_week_result'] = $product_delivery_week_result;
		$this->PAGE['product_delivery_month_result'] = $product_delivery_month_result;
		$this->PAGE['product_delivery_year_result'] = $product_delivery_year_result;

		$this->PAGE['depositor_cost_all_result'] = $depositor_cost_all_result;
		$this->PAGE['depositor_cost_today_result'] = $depositor_cost_today_result;
		$this->PAGE['depositor_cost_week_result'] = $depositor_cost_week_result;
		$this->PAGE['depositor_cost_month_result'] = $depositor_cost_month_result;
		$this->PAGE['depositor_cost_year_result'] = $depositor_cost_year_result;

		$this->load->view("store/1_".$this->router->fetch_class()."/dashboard_view",$this->PAGE);
	}
}