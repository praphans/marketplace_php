<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->
<?php

foreach($mystore as $row){
	$store_id = $row->store_id;
	$member_id = $row->member_id;
	$store_code = $row->store_code;
	$store_name = $row->store_name;
	$store_avatar = $row->store_avatar;
	$store_cover = $row->store_cover;
	$store_description = $row->store_description;
	$store_url = $row->store_url;
	$store_rating = $row->store_rating;
	$store_follower = $row->store_follower;
	$store_code = $row->store_code;
	$store_type = $row->store_type;
	$store_category = $this->model_shop->getCategoryName($row->store_category);
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
	$store_avatar = base_url($store_avatar);
	$store_cover = base_url($store_cover);
	
	$province = $this->storemanager->getDistrictName($province);
	$amphur = $this->storemanager->getAmphurName($amphur);
	$district = $this->storemanager->getProvinceName($district);
	
	
}

$total_product = $this->model_shop->getStoreTotalProduct($store_id);
?>
<style>
a.disabled {
   pointer-events: none;
   cursor: default;
}
</style>




					<!-- - - - - - - - - - - - - - End of product images & description - - - - - - - - - - - - - - - - -->
<section class="section_offset">

    <div class="theme_box">
        <div class="row">

            <div class="col-md-3 col-sm-12 seller_info seller_info_box_first clearfix">

                <a href="#" class="alignleft photo">

                    <img class="shop_pf_img" src="<?php echo $store_avatar; ?>" alt="<?php echo $store_name; ?>">

                </a>

                <div class="wrapper">

                    <div><b><a href="<?php echo $store_url; ?>"><?php echo $store_name; ?></a></b></div>
                    <div><b><?php echo $store_code; ?></b></div>

                    <!-- - - - - - - - - - - - - - Product rating - - - - - - - - - - - - - - - - -->
                
                    <div class="star-ratings">
                      <div class="fill-ratings" style="width: <?php echo $store_rating; ?>%;">
                        <span>★★★★★</span>
                      </div>
                      <div class="empty-ratings">
                        <span>★★★★★</span>
                      </div>
                    </div>
                        
                    <!-- - - - - - - - - - - - - - End of product rating - - - - - - - - - - - - - - - - -->

                </div>

            </div><!--/ .seller_info-->

            <div class="col-md-1 col-sm-1 col-xs-6 seller_info seller_info_box clearfix text-center">

                <span class="shop_pf_h_txt theme_color"><?php echo $total_product; ?></span>
                <br>
                สินค้า

            </div>

            <div class="col-md-3 col-sm-3 col-xs-6 seller_info seller_info_box clearfix text-center">

                <span class="shop_pf_h_txt theme_color"><?php echo $this->utils->time_elapsed_string($timestamp,true); ?></span>
                <br>
                เข้าร่วม

            </div>

            <div class="col-md-2 col-sm-3 col-xs-6 seller_info seller_info_box clearfix text-center">

                <span class="shop_pf_h_txt theme_color"><?php echo $this->storemanager->responseTime($member_id); ?></span>
                <br>
                ระยะเวลาตอบกลับ

            </div>

            <div class="col-md-1 col-sm-2 col-xs-6 seller_info seller_info_box clearfix text-center">

                <span class="shop_pf_h_txt theme_color"><?php echo $store_follower; ?></span>
                <br>
                ผู้ติดตาม

            </div>

            <div class="col-md-2 col-sm-3 col-xs-12 seller_info clearfix text-center">
				<?php 
					$can_follow = "";
					$msg_follow = "ติดตามร้านค้า";
					$follow_url = base_url("shop/addFollow/".$store_id);;
					if($this->membermanager->isLoggedIn()){
						if($this->membermanager->isMyFollowStore($store_id)){
							//$can_follow = "disabled";
							$msg_follow = "ยกเลิกติดตาม";
							$follow_url = base_url("shop/unFollow/".$store_id);;
						}
					}else{
						$can_follow = "ยกเลิกติดตาม";
						$follow_url = base_url("shop/unFollow/".$store_id);;
					}
				?>
                <a href="<?php echo $follow_url; ?>" class="button_blue btn-block mini_btn <?php echo $can_follow; ?>"></i><?php echo $msg_follow; ?></a>

                <a href="<?php echo base_url("message/create/3/0/1/".$store_id); ?>" class="button_dark_grey btn-block mini_btn"></i>ส่งข้อความ</a>

            </div>

        </div>
        
    </div><!--/ .theme_box -->

</section>
