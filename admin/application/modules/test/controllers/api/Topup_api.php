<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Topup_api extends MX_Controller {
	
	public $PAGE;
	public function __construct() {
        parent::__construct();
		$this->load->model('topup/model_topup');
		$this->load->model('topup/model_account');
		$this->utils->checkLogin();
	}

	public function getTopup()
	{
		$topup_arr = array();
        $topup_arr['data'] = array();
		$topup = $this->model_topup->getTopup();
        if(!empty($topup)):
			foreach($topup as $row):
				$topup_id = $row->id;
				$member_id = $row->member_id;
				$order_code = $row->order_code;
				$coin_top_up = $row->coin_top_up;
				$money_top_up = $row->money_top_up;
				$timestamp = $row->timestamp;

				$thaidate = $this->utils->getThaiDate($timestamp);

				$member_result = $this->model_topup->getMemberById($member_id);
				if(count($member_result)>0){
					$first_name = $member_result[0]->first_name;
					$last_name = $member_result[0]->last_name;
					$member_name = "คุณ ".$first_name." ".$last_name;
				}else{
					$member_name = "";
				}
				$coin_top_up = "<span class='d-flex justify-content-end'>".number_format($coin_top_up)."</span>";
				$money_top_up = "<span class='d-flex justify-content-end'>".number_format($money_top_up,2)."</span>";

				$topup_arr['data'][] = array(
					$timestamp,
					$member_name,
					$order_code,
					$coin_top_up,
					$money_top_up,
				);
               
            endforeach;
        endif;
        $json = json_encode($topup_arr);
		echo $json;
	}

	public function getAccount()
	{
		$account_arr = array();
        $account_arr['data'] = array();
		$account = $this->model_account->getTopup();
        if(!empty($account)):
			foreach($account as $row):
				$topup_id = $row->id;
				$member_id = $row->member_id;
				$coin_top_up = $row->coin_top_up;
				$money_top_up = $row->money_top_up;
				$timestamp = $row->timestamp;


				$member_result = $this->model_account->getMemberById($member_id);
				if(count($member_result)>0){
					$first_name = $member_result[0]->first_name;
					$last_name = $member_result[0]->last_name;
					$coin = $member_result[0]->coin;
					$member_name = "คุณ ".$first_name." ".$last_name;
				}else{
					$member_name = "";
					$coin = 0;
				}

				$count_buy_result = $this->model_account->getCountBuyTopupByID($member_id);
				if(count($count_buy_result)>0){
					$count_buy = $count_buy_result[0]->count_buy;
				}else{
					$count_buy = 0;
				}
				$count_use_result = $this->model_account->getCountUseTopupByID($member_id);
				if(count($count_use_result)>0){
					$count_use = $count_use_result[0]->count_use;
				}else{
					$count_use = 0;
				}

				$coin_top_up = "<span class='d-flex justify-content-end'>".number_format($coin)."</span>";
				$count_label = '<span class="badge badge-success w-100 text-center ">รายการซื้อเหรียญ '.$count_buy.'</span><br><span class="badge badge-warning w-100 text-center text-light">รายการใช้เหรียญ '.$count_use.'</span>';
				$btn_account = '<button type="button" onClick="loadModalView('.$member_id.');" class="btn btn-info text-light btn-block mdi mdi-eye"> ประวัติเหรียญ</button>';

				$account_arr['data'][] = array(
					$member_name,
					$count_label,
					$coin_top_up,
					$btn_account,
				);
               
            endforeach;
        endif;
        $json = json_encode($account_arr);
		echo $json;
	}

	public function getUsecoin()
	{
		$use_coin_arr = array();
        $use_coin_arr['data'] = array();
        $member_id = $this->input->post("member_id");

		$use_coin = $this->model_account->getCoinInOrderByID($member_id);

        if(!empty($use_coin)):
			foreach($use_coin as $row):

				$timestamp = $row->timestamp;
				$code = $row->code;
				$coin = $row->coin;

				$main = $row->main;
                if($main  == 'buy'){
                	$order_coin = "<span class='d-flex justify-content-end text-info'>+".number_format($coin,0)."</span>";
                }else{
                	$order_coin = "<span class='d-flex justify-content-end text-danger'>-".number_format($coin,0)."</span>";
                }

				$use_coin_arr['data'][] = array(
					$timestamp,
					$code,
					$order_coin,
				);
               
            endforeach;
        endif;
        $json = json_encode($use_coin_arr);
		echo $json;
	}
	

	
}
