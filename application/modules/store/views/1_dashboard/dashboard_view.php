<?php $this->load->view("templates/header"); ?>
<?php

foreach($mystore as $row){
	$store_id = $row->store_id;
	$member_id = $row->member_id;
	$store_name = $row->store_name;
	$store_avatar = $row->store_avatar;
	$store_cover = $row->store_cover;
	$store_description = $row->store_description;
	
	$store_rating = $row->store_rating;
	$store_follower = $row->store_follower;
	$store_code = $row->store_code;
	
	$store_url = $row->store_url;
	$store_type = $row->store_type;
	$store_category = $this->model_dashboard->getCategoryName($row->store_category);
	$store_status = $row->store_status;
	$first_name = $row->first_name;
	$last_name = $row->last_name;
	$identity_number = $row->identity_number;
	$tel = $row->tel;
	$province = $row->province;
	$amphur = $row->amphur;
	$district = $row->district;
	$address = $row->address;
	$store_is_vat = $row->store_is_vat;
	$zipcode = $row->zipcode;
	$account_name = $row->account_name;
	$account_number = $row->account_number;
	$bank_name = $row->bank_name;
	$timestamp = $row->timestamp;
	
	$store_url = base_url($store_url);
	
	$province = $this->storemanager->getDistrictName($province);
	$amphur = $this->storemanager->getAmphurName($amphur);
	$district = $this->storemanager->getProvinceName($district);
}


foreach($follow_result as $row){
    $member_follow = $row->member_follow;
}
$review_star_all = 0;
foreach($star_all_result as $row){
    $review_star_all = $row->review_star_all;
}
if(!isset($review_star_all))$review_star_all = 0;
$rating_all = 0;
foreach($rating_all_result as $row){
    $review_rating_all = $row->review_rating_all;
	if($review_star_all == 0 && $review_rating_all == 0){
		$rating_all = 0;
	}else{
    	$rating_all = $review_star_all / $review_rating_all;
	}
}



if($rating_all >= 5){
     $rating_star_all = '<li class="active"></li><li class="active"></li><li class="active"></li><li class="active"></li><li class="active"></li>';
}else if($rating_all >= 4){
    $rating_star_all = '<li class="active"></li><li class="active"></li><li class="active"></li><li class="active"></li><li class=""></li>';
}else if($rating_all >= 3){
    $rating_star_all = '<li class="active"></li><li class="active"></li><li class="active"></li><li class=""></li><li class=""></li>';
}else if($rating_all >= 2){
    $rating_star_all = '<li class="active"></li><li class="active"></li><li class=""></li><li class=""></li><li class=""></li>';
}else if($rating_all >= 1){
    $rating_star_all = '<li class="active"></li><li class=""></li><li class=""></li><li class=""></li><li class=""></li>';
}else{
    $rating_star_all = '<li class=""></li><li class=""></li><li class=""></li><li class=""></li><li class=""></li>';
}
foreach($rating_five_result as $row){
    $review_rating_five = $row->review_rating_five;
    if(!empty($review_rating_five)){
        $review_rating_five = $review_rating_five;
    }else{
        $review_rating_five = 0;
    }
}
foreach($rating_four_result as $row){
    $review_rating_four = $row->review_rating_four;
    if(!empty($review_rating_four)){
        $review_rating_four = $review_rating_four;
    }else{
        $review_rating_four = 0;
    }
}
foreach($rating_three_result as $row){
    $review_rating_three = $row->review_rating_three;
    if(!empty($review_rating_three)){
        $review_rating_three = $review_rating_three;
    }else{
        $review_rating_three = 0;
    }
}
foreach($rating_two_result as $row){
    $review_rating_two = $row->review_rating_two;
    if(!empty($review_rating_two)){
        $review_rating_two = $review_rating_two;
    }else{
        $review_rating_two = 0;
    }
}
foreach($rating_one_result as $row){
    $review_rating_one = $row->review_rating_one;
    if(!empty($review_rating_one)){
        $review_rating_one = $review_rating_one;
    }else{
        $review_rating_one = 0;
    }
}
foreach($product_all_result as $row){
    $product_order_all = $row->product_order_all;
    if(!empty($product_order_all)){
        $product_order_all = $product_order_all;
    }else{
        $product_order_all = 0;
    }
}
foreach($product_year_result as $row){
    $product_order_year = $row->product_order_year; //สินค้าที่ขายได้
    if(!empty($product_order_year)){
        $product_order_year = $product_order_year;
    }else{
        $product_order_year = 0;
    }
}

foreach($product_year_dontdelete_result as $row){
    $product_order_year_dontdelete = $row->product_order_year_dontdelete; //สินค้าที่ขายได้ ไม่เท่่ากับ ลบ status != 5
    if(!empty($product_order_year_dontdelete)){
        $product_order_year_dontdelete = $product_order_year_dontdelete;
    }else{
        $product_order_year_dontdelete = 0;
    }
}
$product_notsell = $product_order_all - $product_order_year_dontdelete; //สินค้าทั้งหมดในรอบปี - สินค้าที่ขายได้ = สินค้าขายไมไ่ได้
if(!empty($product_notsell)){
    $product_notsell = $product_notsell;
}else{
    $product_notsell = 0;
}

// print_r("สินค้าทั้งหมดในรอบปี ==".$product_order_all."<br>");
// print_r("สินค้าที่ขายได้ ==".$product_order_year_dontdelete."<br>");





foreach($product_new_dontdelete_result as $row){
    $product_dontdelete_new = $row->product_order_new; // สินค้าใหม่ในรอบปีไม่เท่ากับ ลบ status != 5
}

foreach($product_pending_result as $row){
    $product_pending = $row->product_pending;
    if(!empty($product_pending)){
        $product_pending = $product_pending;
    }else{
        $product_pending = 0;
    }
}
foreach($product_suspend_result as $row){
    $product_suspend = $row->product_suspend;
    if(!empty($product_suspend)){
        $product_suspend = $product_suspend;
    }else{
        $product_suspend = 0;
    }
}
foreach($product_order_all_result as $row){
    $order_all = $row->order_all;
    if(!empty($order_all)){
        $order_all = $order_all;
    }else{
        $order_all = 0;
    }
}
foreach($product_order_today_result as $row){
    $order_today = $row->order_today;
    if(!empty($order_today)){
        $order_today = $order_today;
    }else{
        $order_today = 0;
    }
}
foreach($product_order_week_result as $row){
    $order_week = $row->order_week;
    if(!empty($order_week)){
        $order_week = $order_week;
    }else{
        $order_week = 0;
    }
}
foreach($product_order_month_result as $row){
    $order_month = $row->order_month;
    if(!empty($order_month)){
        $order_month = $order_month;
    }else{
        $order_month = 0;
    }
}
foreach($product_order_year_result as $row){
    $order_year = $row->order_year;
    if(!empty($order_year)){
        $order_year = $order_year;
    }else{
        $order_year = 0;
    }
}
foreach($product_sell_all_result as $row){
    $product_price_all = $row->product_price_all;
    if(!empty($product_price_all)){
        $product_price_all = $product_price_all;
    }else{
        $product_price_all = 0;
    }
}
foreach($product_sell_today_result as $row){
    $product_price_today = $row->product_price_today;
    if(!empty($product_price_today)){
        $product_price_today = $product_price_today;
    }else{
        $product_price_today = 0;
    }
}
foreach($product_sell_week_result as $row){
    $product_price_week = $row->product_price_week;
    if(!empty($product_price_week)){
        $product_price_week = $product_price_week;
    }else{
        $product_price_week = 0;
    }
}
foreach($product_sell_month_result as $row){
    $product_price_month = $row->product_price_month;
    if(!empty($product_price_month)){
        $product_price_month = $product_price_month;
    }else{
        $product_price_month = 0;
    }
}
foreach($product_sell_year_result as $row){
    $product_price_year = $row->product_price_year;
    if(!empty($product_price_year)){
        $product_price_year = $product_price_year;
    }else{
        $product_price_year = 0;
    }
}
foreach($product_delivery_all_result as $row){
    $product_delivery_all = $row->product_delivery_all;
    if(!empty($product_delivery_all)){
        $product_delivery_all = $product_delivery_all;
    }else{
        $product_delivery_all = 0;
    }
}
foreach($product_delivery_today_result as $row){
    $product_delivery_today = $row->product_delivery_today;
    if(!empty($product_delivery_today)){
        $product_delivery_today = $product_delivery_today;
    }else{
        $product_delivery_today = 0;
    }
}
foreach($product_delivery_week_result as $row){
    $product_delivery_week = $row->product_delivery_week;
    if(!empty($product_delivery_week)){
        $product_delivery_week = $product_delivery_week;
    }else{
        $product_delivery_week = 0;
    }
}
foreach($product_delivery_month_result as $row){
    $product_delivery_month = $row->product_delivery_month;
    if(!empty($product_delivery_month)){
        $product_delivery_month = $product_delivery_month;
    }else{
        $product_delivery_month = 0;
    }
}
foreach($product_delivery_year_result as $row){
    $product_delivery_year = $row->product_delivery_year;
    if(!empty($product_delivery_year)){
        $product_delivery_year = $product_delivery_year;
    }else{
        $product_delivery_year = 0;
    }
}
foreach($depositor_cost_all_result as $row){
    $depositor_cost_all = $row->depositor_cost_all;
    if(!empty($depositor_cost_all)){
        $depositor_cost_all = $depositor_cost_all;
    }else{
        $depositor_cost_all = 0;
    }
}
foreach($depositor_cost_today_result as $row){
    $depositor_cost_today = $row->depositor_cost_today;
    if(!empty($depositor_cost_today)){
        $depositor_cost_today = $depositor_cost_today;
    }else{
        $depositor_cost_today = 0;
    }
}
foreach($depositor_cost_week_result as $row){
    $depositor_cost_week = $row->depositor_cost_week;
    if(!empty($depositor_cost_week)){
        $depositor_cost_week = $depositor_cost_week;
    }else{
        $depositor_cost_week = 0;
    }
}
foreach($depositor_cost_month_result as $row){
    $depositor_cost_month = $row->depositor_cost_month;
    if(!empty($depositor_cost_month)){
        $depositor_cost_month = $depositor_cost_month;
    }else{
        $depositor_cost_month = 0;
    }
}
foreach($depositor_cost_year_result as $row){
    $depositor_cost_year = $row->depositor_cost_year;
    if(!empty($depositor_cost_year)){
        $depositor_cost_year = $depositor_cost_year;
    }else{
        $depositor_cost_year = 0;
    }
}




















?>
        
	<div class="secondary_page_wrapper">

            <div class="container">

                <!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

                <ul class="breadcrumbs">

                    <li><a href="<?php echo base_url(); ?>" class="notcursor">หน้าหลัก</a></li>
					<li><a href="<?php echo base_url("store"); ?>" class="notcursor">บัญชีร้านค้า</a></li>
                    <li>ผลการดำเนินงาน</li>

                </ul>

                <!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->

                <div class="row">
					<?php $this->load->view("store/templates/left_tab"); ?>
                    <main class="col-md-9 col-sm-8">
                        <div class="theme_box">
                            <h4 class="mg_b_0">ผลการดำเนินงาน</h4>
                        </div>
                        <div class="theme_box">
                            <div class="row">

                                <div class="col-md-5 col-sm-12 seller_info seller_info_box_first clearfix">

                                    <a href="<?php echo $store_url; ?>" class="alignleft photo">

                                        <img class="shop_pf_img" src="<?php echo base_url($store_avatar); ?>" alt="<?php echo $store_name; ?>">

                                    </a>

                                    <div class="wrapper">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <label class="clearfix"><a href="<?php echo $store_url; ?>"><?php echo $store_name; ?></a></label>
                                        </div> 
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <label class="clearfix"><?php echo $store_code; ?></label>
                                        </div> 
                                
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <label class="clearfix">เปิดร้านเมื่อ <br /><?php echo $this->utils->getThaiDate($timestamp); ?></label>
                                        </div> 

                                        <!-- - - - - - - - - - - - - - End of product rating - - - - - - - - - - - - - - - - -->
                                    </div>
                                </div>
                                <!--/ .seller_info-->
                                <div class="col-md-3 col-sm-4 col-xs-12 seller_info seller_info_box_noline clearfix text-center">
                                    <span class="shop_pf_h_txt theme_color"><?php echo $this->utils->time_elapsed_string($timestamp,true); ?></span>
                                    <br>
                                    <label class="bold_font">เข้าร่วม</label> <br>
                               
                                </div>
                                <div class="col-md-2 col-sm-4 col-xs-12 seller_info seller_info_box_center clearfix text-center">

                                    <span class="shop_pf_h_txt theme_color"><?php echo $member_follow;?></span>
                                    <br>
                                    <label class="bold_font">ผู้ติดตาม</label> 
                                   
                                    
                                </div>
                                <div class="col-md-2 col-sm-4 col-xs-12 seller_info seller_info_box_center clearfix text-center">
                                    <span class="shop_pf_h_txt theme_color">1 ชั่วโมง</span>
                                    <br>
                                    <label class="bold_font">ระยะเวลาตอบกลับ</label> 
                                </div>
                            </div>

                        </div>
                        <!--/ .theme_box -->
                        <div class="theme_box pt-l-0 pt-r-0 pt-t-0">
                            <div class="col-md-12 col-sm-12 col-xs-12 pt-l-0 pt-r-0">

                                <div class="col-md-4 col-sm-12 col-xs-12 pt-10">
                                    <div class="theme_box padding-b-0">
                                        <h5>ความคิดเห็นของลูกค้า</h5>

                                        <ul class="list_of_links">
                                            <li>
                                                <a>
                                                    <div class="clearfix product_info">
                                                        <ul class="rating alignleft">
                                                            <?php echo $rating_star_all; ?>
                                                        </ul>

                                                        <!-- - - - - - - - - - - - - - End of product rating - - - - - - - - - - - - - - - - -->

                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a>
                                                    <div class="clearfix product_info">
                                                        <ul class="rating alignleft">
                                                            <li class="active"></li>
                                                            <li class="active"></li>
                                                            <li class="active"></li>
                                                            <li class="active"></li>
                                                            <li class="active"></li>
                                                        </ul>
                                                        <!-- - - - - - - - - - - - - - End of product rating - - - - - - - - - - - - - - - - -->
                                                        <p class="product_price alignright"><?php echo $review_rating_five;?></p>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a>
                                                    <div class="clearfix product_info">
                                                        <ul class="rating alignleft">
                                                            <li class="active"></li>
                                                            <li class="active"></li>
                                                            <li class="active"></li>
                                                            <li class="active"></li>
                                                        </ul>
                                                        <!-- - - - - - - - - - - - - - End of product rating - - - - - - - - - - - - - - - - -->
                                                        <p class="product_price alignright"><?php echo $review_rating_four;?></p>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a>
                                                    <div class="clearfix product_info">
                                                        <ul class="rating alignleft">
                                                            <li class="active"></li>
                                                            <li class="active"></li>
                                                            <li class="active"></li>
                                                        </ul>
                                                        <!-- - - - - - - - - - - - - - End of product rating - - - - - - - - - - - - - - - - -->
                                                        <p class="product_price alignright"><?php echo $review_rating_three;?></p>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a>
                                                    <div class="clearfix product_info">
                                                        <ul class="rating alignleft">
                                                            <li class="active"></li>
                                                            <li class="active"></li>
                                                        </ul>
                                                        <!-- - - - - - - - - - - - - - End of product rating - - - - - - - - - - - - - - - - -->
                                                        <p class="product_price alignright"><?php echo $review_rating_two;?></p>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a>
                                                    <div class="clearfix product_info">
                                                        <ul class="rating alignleft">
                                                            <li class="active"></li>
                                                        </ul>
                                                        <!-- - - - - - - - - - - - - - End of product rating - - - - - - - - - - - - - - - - -->
                                                        <p class="product_price alignright"><?php echo $review_rating_one;?></p>
                                                    </div>
                                                </a>
                                            </li>

                                        </ul>


                                    </div>

                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 pt-10">
                                    <div class="theme_box padding-b-0">

                                        <h5>จำนวนรายการสินค้า</h5>

                                        <ul class="list_of_links ">

                                            <li><p class="product_price"><?php echo $product_order_all;?></p></li>
                                            <hr>
                                            <li>
                                                <div class="clearfix product_info pt-10">
                                                    <p class="alignleft">สินค้าที่ขายได้(รอบ1ปี):</p>
                                                    <p class="product_price alignright"><?php echo $product_order_year;?></p>
                                                </div>
                                            
                                            </li>
                                            <hr>
                                            <li>
                                                    <div class="clearfix product_info pt-10">
                                                        <p class="alignleft">สินค้าที่ขายไม่ได้(รอบ1ปี):</p>
                                                        <p class="product_price alignright"><?php echo $product_notsell;?></p>
                                                    </div>
                                                
                                            </li>
                                            <hr>
                                            <li>
                                                <div class="clearfix product_info pt-10">
                                                    <p class="alignleft">สินค้าใหม่(รอบ1ปี):</p>
                                                    <p class="product_price alignright"><?php echo $product_dontdelete_new;?></p>
                                                </div>
                                            </li>
                                            <hr>
                                            <li>
                                                    <div class="clearfix product_info pt-10">
                                                        <p class="alignleft">สินค้าที่รออนุมัติ:</p>
                                                        <p class="product_price alignright"><?php echo $product_pending;?></p>
                                                    </div>
                                                
                                            </li>
                                            <hr>
                                            <li>
                                                <div class="clearfix product_info pt-10">
                                                    <p class="alignleft">สินค้าระงับ:</p>
                                                    <p class="product_price alignright"><?php echo $product_suspend;?></p>
                                                </div>
                                            </li>
                                            <hr>
                                        </ul>


                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 pt-10">
                                    <div class="theme_box padding-b-0">
                                        <h5>จำนวนคำสั่งซื้อ</h5>
                                        <ul class="list_of_links">
                                            <li><p class="product_price"><?php echo $order_all;?></p></li>
                                            <hr>
                                            <li>
                                                <div class="clearfix product_info pt-10">
                                                    <p class="alignleft">วันนี้:</p>
                                                    <p class="product_price alignright"><?php echo $order_today;?></p>
                                                </div>
                                            </li>
                                            <hr>
                                            <li>
                                                <div class="clearfix product_info pt-10">
                                                    <p class="alignleft">สัปดาห์นี้:</p>
                                                    <p class="product_price alignright"><?php echo $order_week;?></p>
                                                </div>  
                                            </li>
                                            <hr>
                                            <li>
                                                <div class="clearfix product_info pt-10">
                                                    <p class="alignleft">เดือนนี้:</p>
                                                    <p class="product_price alignright"><?php echo $order_month;?></p>
                                                </div>
                                            </li>
                                            <hr>
                                            <li>
                                                <div class="clearfix product_info pt-10">
                                                    <p class="alignleft">ปีนี้:</p>
                                                    <p class="product_price alignright"><?php echo $order_year;?></p>
                                                </div>
                                            </li>
                                            <hr>
                                        </ul>


                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12  pt-l-0 pt-r-0 pt-10">

                                <div class="col-md-4 col-sm-12 col-xs-12 pt-10">
                                    <div class="theme_box padding-b-0">

                                        <h5>ยอดขาย (บาท)</h5>

                                        <ul class="list_of_links">

                                            <li><p class="product_price"><?php echo number_format($product_price_all,2);?></p></li>
                                            <hr>
                                            <li>
                                                <div class="clearfix product_info pt-10">
                                                    <p class="alignleft">วันนี้:</p>
                                                    <p class="product_price alignright"><?php echo number_format($product_price_today,2);?></p>
                                                </div>
                                            </li>
                                            <hr>
                                            <li>
                                                <div class="clearfix product_info pt-10">
                                                    <p class="alignleft">สัปดาห์นี้:</p>
                                                    <p class="product_price alignright"><?php echo number_format($product_price_week,2);?></p>
                                                </div>
                                            </li>
                                            <hr>
                                            <li>
                                                <div class="clearfix product_info pt-10">
                                                    <p class="alignleft">เดือนนี้:</p>
                                                    <p class="product_price alignright"><?php echo number_format($product_price_month,2);?></p>
                                                </div>
                                            </li>
                                            <hr>
                                            <li>
                                                <div class="clearfix product_info pt-10">
                                                    <p class="alignleft">ปีนี้:</p>
                                                    <p class="product_price alignright"><?php echo number_format($product_price_year,2);?></p>
                                                </div>
                                            </li>
                                            <hr>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 pt-10">
                                    <div class="theme_box padding-b-0 ">
                                        <h5>จำนวนสินค้าบริการจัดส่ง</h5>

                                        <ul class="list_of_links">

                                            <li><p class="product_price"><?php echo $product_delivery_all;?></p></li>
                                            <hr>
                                            <li>
                                                <div class="clearfix product_info pt-10">
                                                    <p class="alignleft">วันนี้:</p>
                                                    <p class="product_price alignright"><?php echo $product_delivery_today;?></p>
                                                </div>
                                            </li>
                                            <hr>
                                            <li>
                                                <div class="clearfix product_info pt-10">
                                                    <p class="alignleft">สัปดาห์นี้:</p>
                                                    <p class="product_price alignright"><?php echo $product_delivery_week;?></p>
                                                </div>
                                            </li>
                                            <hr>
                                            <li>
                                                <div class="clearfix product_info pt-10">
                                                    <p class="alignleft">เดือนนี้:</p>
                                                    <p class="product_price alignright"><?php echo $product_delivery_month;?></p>
                                                </div>
                                            </li>
                                            <hr>
                                            <li>
                                                <div class="clearfix product_info pt-10">
                                                    <p class="alignleft">ปีนี้:</p>
                                                    <p class="product_price alignright"><?php echo $product_delivery_year;?></p>
                                                </div>
                                            </li>
                                            <hr>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12 col-xs-12 pt-10 ">
                                    <div class="theme_box padding-b-0">
                                        <h5>รายได้ค่าบริการจัดส่ง(บาท)</h5>

                                        <ul class="list_of_links">

                                            <li><p class="product_price"><?php echo number_format($depositor_cost_all,2);?></p></li>
                                            <hr>
                                            <li>
                                                <div class="clearfix product_info pt-10">
                                                    <p class="alignleft">วันนี้:</p>
                                                    <p class="product_price alignright"><?php echo number_format($depositor_cost_all,2);?></p>
                                                </div>
                                            </li>
                                            <hr>
                                            <li>
                                                <div class="clearfix product_info pt-10">
                                                    <p class="alignleft">สัปดาห์นี้:</p>
                                                    <p class="product_price alignright"><?php echo number_format($depositor_cost_all,2);?></p>
                                                </div>
                                            </li>
                                            <hr>
                                            <li>
                                                <div class="clearfix product_info pt-10">
                                                    <p class="alignleft">เดือนนี้:</p>
                                                    <p class="product_price alignright"><?php echo number_format($depositor_cost_all,2);?></p>
                                                </div>
                                            </li>
                                            <hr>
                                            <li>
                                                <div class="clearfix product_info pt-10">
                                                    <p class="alignleft">ปีนี้:</p>
                                                    <p class="product_price alignright"><?php echo number_format($depositor_cost_all,2);?></p>
                                                </div>
                                            </li>
                                            <hr>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- - - - - - - - - - - - - - Contact information - - - - - - - - - - - - - - - - -->



                        <!-- - - - - - - - - - - - - - End of contact information - - - - - - - - - - - - - - - - -->



                    </main>

                </div>
                <!--/ .row-->

            </div>
            <!--/ .container-->

        </div>
        <!--/ .page_wrapper-->
		<!-- - - - - - - - - - - - - - End Page Wrapper - - - - - - - - - - - - - - - - -->
<?php $this->load->view("templates/footer"); ?>
<?php $this->load->assets_by_name("left_tab","js"); ?>
<?php $this->load->assets_by_name('Dashboard'); ?>