<?php $this->load->view("templates/header"); ?>

<?php

//print_r($mystore);
foreach($mystore as $row){
	$store_id = $row->store_id;
	$member_id = $row->member_id;
	$store_code = $row->store_code;
	$store_name = $row->store_name;
	$store_avatar = $row->store_avatar;
	$store_cover = $row->store_cover;
	$store_description = $row->store_description;
	$store_url = $row->store_url;
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
	
	//$store_url = base_url('market/'.$store_url);
	$store_avatar = base_url($store_avatar);
	$store_cover = base_url($store_cover);
	
	$province = $this->storemanager->getDistrictName($province);
	$amphur = $this->storemanager->getAmphurName($amphur);
	$district = $this->storemanager->getProvinceName($district);
}

$store_place = $this->model_shop->getPlaceById($store_id,1);
$agent_place = $this->model_shop->getPlaceById($store_id,2);
$service_place = $this->model_shop->getPlaceById($store_id,3);

$number_of_place = count($store_place)+count($agent_place)+count($service_place);

$review = $this->model_review->getReviewByStoreID($store_id);
$review_number = count($review);
?>

<div class="secondary_page_wrapper">

				<div class="container">

					

					<!-- - - - - - - - - - - - - - Seller Information - - - - - - - - - - - - - - - - -->

					<?php echo $this->load->view("shop/templates/shop_detail",$mystore); ?>

					<!-- - - - - - - - - - - - - - End of seller information - - - - - - - - - - - - - - - - -->

					
					<!-- - - - - - - - - - - - - - Tabs - - - - - - - - - - - - - - - - -->

					<div class="section_offset">

						<div class="tabs type_2">

							<!-- - - - - - - - - - - - - - Navigation of tabs - - - - - - - - - - - - - - - - -->
							<button class="mobile_only_show btn-block button_grey_outline text-left" type="button" data-toggle="collapse" data-target="#shop_category" aria-expanded="false" aria-controls="shop_category">
            สถานที่ส่งสินค้า <span class="caret"></span>
          </button>
           
                            <section class="section_offset collapse" id="shop_category">

                                <ul class="theme_menu theme_category">
									<li><a href="<?php echo site_url($store_url); ?>">รายการสินค้า</a></li>
									<?php if($number_of_place > 0){ ?>
                                    <li class="active"><a href="<?php echo site_url($store_url."/สถานที่ส่งสินค้า"); ?>">สถานที่ส่งสินค้า</a></li>
                                    <?php } ?>
                                    <?php if($review_number > 0){ ?>
                                    <li><a href="<?php echo site_url($store_url."/รีวิวร้านค้า"); ?>">รีวิวร้านค้า (<?php echo $review_number; ?>)</a></li>
                                    <?php } ?>
                                    <?php 
                                    $store_description_no_html = strip_tags($store_description);
                                    if(strlen($store_description_no_html) > 1){ ?>
                                    <li><a href="<?php echo site_url($store_url."/เกี่ยวกับเรา"); ?>">เกี่ยวกับเรา</a></li>
                                    <?php } ?>
                                </ul>

                            </section>
                            
							<ul class="tabs_nav clearfix mobile_only_hide">

								<li><a href="<?php echo site_url($store_url); ?>">รายการสินค้า</a></li>
                                <?php if($number_of_place > 0){ ?>
								<li class="active"><a href="<?php echo site_url($store_url."/สถานที่ส่งสินค้า"); ?>">สถานที่ส่งสินค้า</a></li>
                                <?php } ?>
                                <?php if($review_number > 0){ ?>
								<li><a href="<?php echo site_url($store_url."/รีวิวร้านค้า"); ?>">รีวิวร้านค้า (<?php echo $review_number; ?>)</a></li>
                                <?php } ?>
								<?php 
								$store_description_no_html = strip_tags($store_description);
								if(strlen($store_description_no_html) > 1){ ?>
								<li><a href="<?php echo site_url($store_url."/เกี่ยวกับเรา"); ?>">เกี่ยวกับเรา</a></li>
                                <?php } ?>

							</ul>
							
							<!-- - - - - - - - - - - - - - End navigation of tabs - - - - - - - - - - - - - - - - -->

							<!-- - - - - - - - - - - - - - Tabs container - - - - - - - - - - - - - - - - -->

							<div class="tab_containers_wrap theme_box">
								<br />
                               
								<div id="tab-2" >
									<?php if(count($store_place)>0){ ?> <h3>สถานที่ของผู้ขาย</h3> <?php } ?>
                                    
                                    
                                    <?php 
									$place_num = 0;
									
									foreach($store_place as $place){
										$place_id = $place->place_id;
										$place_code = $place->place_code;
										$place_name = $place->place_name;
										$place_province = $place->place_province;
										$place_amphur = $place->place_amphur;
										$place_district = $place->place_district;
										$place_address = $place->place_address;
										$place_postcode = $place->place_postcode;
										$place_mobile = $place->place_mobile;
										$working_time_id = $place->working_time_id;
										$place_lat = $place->place_lat;
										$place_long = $place->place_long;
										$place_condition = $place->place_condition;
										$working = $this->storemanager->working_time($place_id);
										$province = $this->storemanager->getProvinceName($place_province);
										$amphur = $this->storemanager->getAmphurName($place_amphur);
										$district = $this->storemanager->getDistrictName($place_district);
										$map = 'https://www.google.com/maps/search/?api=1&query='.$place_lat.','.$place_long;
										$place_num++;
									?>
                                    
                                    
            
									<div class="single_shop_placebox margin-t-20">
										<div class="row">
											<div class="col-xs-12">
                                                <h5><a target="_blank" href="<?php echo base_url()?>place/info/<?php echo $place_id; ?>"><?php echo $place_name; ?></a></h5>
                                            </div>
                                            <div class="col-md-2 form_group">
                                                <label>รหัสสถานที่ :</label>
                                            </div>
                                            <div class="col-md-10 form_group">
                                                <b> <a target="_blank" href="<?php echo base_url()?>place/info/<?php echo $place_id; ?>"><?php echo $place_code; ?></a></b>
                                            </div>
                                            <div class="col-md-2 form_group">
                                                <label>ที่อยู่ :</label>
                                            </div>
                                            <div class="col-md-10 form_group">
                                            	<a target="_blank" href="<?php echo base_url()?>place/info/<?php echo $place_id; ?>">
                                                <?php echo $place_address; ?> 
                                                <?php echo $this->storemanager->getDistrictName($place_district); ?>
                                                <?php echo $this->storemanager->getAmphurName($place_amphur); ?>
                                                <?php echo $this->storemanager->getProvinceName($place_province); ?>
                                                <?php echo $place_postcode; ?>
                                                </a>
                                                <a href="<?php echo $map; ?>" target="_blank" class=""><i class="icon-location-3"></i> ดูแผนที่</a>
                                           </div>
                                           
                                            <div class="col-md-2 form_group">
                                                <label>โทรศัพท์ :</label>
                                            </div>
                                            <div class="col-md-10 form_group">
                                                <?php echo $place_mobile; ?>
                                            </div>
                                            <div class="col-md-2 form_group">
                                                <label>อธิบายเส้นทาง :</label>
                                            </div>
                                            <div class="col-md-10 form_group">
                                                <?php echo $place_condition; ?>
                                            </div>
                                            <!--<div class="col-md-2 form_group">
                                                <label>วันที่ทำการ :</label>
                                            </div>-->
											
										
										
                                        
                                         <?php if(count($working) > 0){ ?>
                                        <!--<div class="col-md-10 form_group">
                                            <table class="table-responsive table table-bordered">
                                              <thead>
                                                <tr>
                                                  <th scope="col">วัน</th>
                                                  <th scope="col">เวลาเปิด</th>
                                                  <th scope="col">เวลาปิด</th>
                                                  <th scope="col">รายละเอียด</th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                <?php
                                                    foreach($working as $w){
                                                        $work_id = $w->work_id;
                                                        $work_day = $w->work_day;
                                                        $work_starttime = $w->work_starttime;
                                                        $work_endtime = $w->work_endtime;
                                                        $open_all_day = $w->open_all_day;
                                                        $is_holiday = $w->is_holiday;
                                                        
                                                        if($open_all_day == 1){
                                                            $open_all_day = "เปิด 24 ชั่วโมง";
                                                            $work_starttime = "-";
                                                            $work_endtime = "-";	
                                                        }else{
                                                            $open_all_day = "เปิดตามเวลา";
                                                        }
                                                        if($is_holiday){
                                                            $open_all_day = "วันหยุด";
                                                            $work_starttime = "-";
                                                            $work_endtime = "-";	
                                                        }else{
                                                           
                                                        }
                                                ?>
                                                <tr>
                                                  <td><?php echo $work_day; ?></td>
                                                  <td><?php echo $work_starttime; ?></td>
                                                  <td><?php echo $work_endtime; ?></td>
                                                  <td><?php echo $open_all_day; ?></td>
                                                </tr>
                                                <?php } ?>
                                                
                                              </tbody>
                                            </table>
                                            </div>-->
                                            <?php } ?>
                                            
                                        </div>
        
									</div>
                                    
                                    
									<?php } ?>
                                    
                                    
                                    
                                    
									
									<div class="clear margin-t-20"></div>
									<?php if(count($agent_place)>0){ ?><h3>สถานที่ของตัวแทนผู้ขาย</h3> <?php } ?>
                                    
                                    
									<?php 
									$place_num = 0;
									
									foreach($agent_place as $place){
										$place_id = $place->place_id;
										$place_code = $place->place_code;
										$place_name = $place->place_name;
										$place_province = $place->place_province;
										$place_amphur = $place->place_amphur;
										$place_district = $place->place_district;
										$place_address = $place->place_address;
										$place_postcode = $place->place_postcode;
										$place_mobile = $place->place_mobile;
										$working_time_id = $place->working_time_id;
										$place_lat = $place->place_lat;
										$place_long = $place->place_long;
										$place_condition = $place->place_condition;
										$working = $this->storemanager->working_time($place_id);
										$province = $this->storemanager->getProvinceName($place_province);
										$amphur = $this->storemanager->getAmphurName($place_amphur);
										$district = $this->storemanager->getDistrictName($place_district);
										$map = 'https://www.google.com/maps/search/?api=1&query='.$place_lat.','.$place_long;
										$place_num++;
									?>
									<div class="single_shop_placebox margin-t-20">
										<div class="row">
											<div class="col-xs-12">
                                                <h5><a target="_blank" href="<?php echo base_url()?>place/info/<?php echo $place_id; ?>"><?php echo $place_name; ?></a></h5>
                                            </div>
                                            <div class="col-md-2 form_group">
                                                <label>รหัสสถานที่ :</label>
                                            </div>
                                            <div class="col-md-10 form_group">
                                               <b> <a target="_blank" href="<?php echo base_url()?>place/info/<?php echo $place_id; ?>"><?php echo $place_code; ?></a></b>
                                            </div>
                                            <div class="col-md-2 form_group">
                                                <label>ที่อยู่ :</label>
                                            </div>
                                            <div class="col-md-10 form_group">
                                            	<a target="_blank" href="<?php echo base_url()?>place/info/<?php echo $place_id; ?>">
                                                <?php echo $place_address; ?> 
                                                <?php echo $this->storemanager->getDistrictName($place_district); ?>
                                                <?php echo $this->storemanager->getAmphurName($place_amphur); ?>
                                                <?php echo $this->storemanager->getProvinceName($place_province); ?>
                                                <?php echo $place_postcode; ?>
                                                </a>
                                                <a href="<?php echo $map; ?>" target="_blank" class=""><i class="icon-location-3"></i> ดูแผนที่</a>
                                           </div>
                                           
                                            <div class="col-md-2 form_group">
                                                <label>โทรศัพท์ :</label>
                                            </div>
                                            <div class="col-md-10 form_group">
                                                <?php echo $place_mobile; ?>
                                            </div>
                                            <div class="col-md-2 form_group">
                                                <label>อธิบายเส้นทาง :</label>
                                            </div>
                                            <div class="col-md-10 form_group">
                                                <?php echo $place_condition; ?>
                                            </div>
                                            <!--<div class="col-md-2 form_group">
                                                <label>วันที่ทำการ :</label>
                                            </div>-->
											
										
										
                                        
                                        <?php if(count($working) > 0){ ?>
                                        <!--<div class="col-md-10 form_group">
                                            <table class="table-responsive table table-bordered">
                                              <thead>
                                                <tr>
                                                  <th scope="col">วัน</th>
                                                  <th scope="col">เวลาเปิด</th>
                                                  <th scope="col">เวลาปิด</th>
                                                  <th scope="col">รายละเอียด</th>
                                                </tr>
                                              </thead>
                                              <tbody>
                                                <?php
                                                    foreach($working as $w){
                                                        $work_id = $w->work_id;
                                                        $work_day = $w->work_day;
                                                        $work_starttime = $w->work_starttime;
                                                        $work_endtime = $w->work_endtime;
                                                        $open_all_day = $w->open_all_day;
                                                        $is_holiday = $w->is_holiday;
                                                       
                                                        if($open_all_day == 1){
                                                            $open_all_day = "เปิด 24 ชั่วโมง";
                                                            $work_starttime = "-";
                                                            $work_endtime = "-";	
                                                        }else{
                                                            $open_all_day = "เปิดตามเวลา";
                                                        }
                                                        if($is_holiday){
                                                            $open_all_day = "วันหยุด";
                                                            $work_starttime = "-";
                                                            $work_endtime = "-";	
                                                        }else{
                                                           
                                                        }
                                                ?>
                                                <tr>
                                                  <td><?php echo $work_day; ?></td>
                                                  <td><?php echo $work_starttime; ?></td>
                                                  <td><?php echo $work_endtime; ?></td>
                                                  <td><?php echo $open_all_day; ?></td>
                                                </tr>
                                                <?php } ?>
                                                
                                              </tbody>
                                            </table>
                                            </div>-->
                                            <?php } ?>
                                           
										</div>
										
									</div>
									<?php } ?>
                                    
                                    
                                    
                                    
                                    
									<div class="clear margin-t-20"></div>
									<?php if(count($service_place)>0){ ?><h3>เขตพื้นที่บริการจัดส่ง</h3><?php } ?>
									
                                    
                                    <?php 
									$place_num = 0;
									foreach($service_place as $place){
										$place_code = $place->place_code;
										$place_name = $place->place_name;
										$place_province = $place->place_province;
										$place_amphur = $place->place_amphur;
										$place_district = $place->place_district;
										$place_address = $place->place_address;
										$place_postcode = $place->place_postcode;
										$place_mobile = $place->place_mobile;
										$working_time_id = $place->working_time_id;
										$place_lat = $place->place_lat;
										$place_long = $place->place_long;
										$place_condition = $place->place_condition;
										
										$province = $this->storemanager->getProvinceName($place_province);
										$amphur = $this->storemanager->getAmphurName($place_amphur);
										
										$place_num++;
									?>
									<div class="single_shop_placebox margin-t-20">
										<div class="row">
											<div class="col-md-12">
												<div class="title_place"><?php echo $place_num; ?>. <?php echo $amphur.' '.$province; ?></div>
												<p>
													<?php echo $place_condition; ?>
												</p>
											</div>
											
										</div>
										
									</div>
									<?php } ?>
                                    

								</div><!--/ #tab-1-->

								<!-- - - - - - - - - - - - - - End tab - - - - - - - - - - - - - - - - -->

								

								<!-- - - - - - - - - - - - - - End tab - - - - - - - - - - - - - - - - -->

							</div><!--/ .tab_containers_wrap -->

							<!-- - - - - - - - - - - - - - End of tabs containers - - - - - - - - - - - - - - - - -->

						</div><!--/ .tabs-->

					</div><!--/ .section_offset -->

					<!-- - - - - - - - - - - - - - End of tabs - - - - - - - - - - - - - - - - -->

				</div><!--/ .container-->

			</div><!--/ .page_wrapper-->
            
<?php $this->load->view("templates/footer"); ?>
<script type="text/javascript" src="<?php echo base_url("assets/js/addthis.js"); ?>"></script>
