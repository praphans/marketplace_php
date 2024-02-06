<?php $this->load->view("templates/header"); ?>

<style>
.dropdown_custom{
	visibility:visible;
	-webkit-transform-style: unset;
	-ms-transform-style: unset;
	transform-style:unset;
	-webkit-transform: unset;
	transform: unset;
	perspective:unset;

}
</style>

<div class="secondary_page_wrapper">

            <div class="container">

                <!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

                <ul class="breadcrumbs">

                    <li><a href="<?php echo base_url(); ?>">หน้าหลัก</a></li>
					<li><a href="#">สถานที่</a></li>
                    <li><a href="#">รายละเอียดสถานที่</a></li>
                </ul>

                <!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->

                <div class="row">

                   
                    
                    <main class="col-md-12 col-sm-12">

                        <div class="section_offset">

                            <div class="row">

                                <section class="col-sm-12">

                                    

                                    <!-- - - - - - - - - - - - - - Tabs v2 - - - - - - - - - - - - - - - - -->

                                    <div class="tabs type_2">

                                      
										
                                        <div class="tab_containers_wrap">
												
                                            <div id="tab-1" class="tab_container">
                                            	
                                                <?php
	
												foreach($places as $row){
													$place_id = $row->place_id;
													$place_code = $row->place_code;
													$request_place_id = $row->request_place_id;
													$store_id = $row->store_id;
													$shipping_type_id = $row->shipping_type_id;
													$place_name = $row->place_name;
													$place_province = $row->place_province;
													$place_amphur = $row->place_amphur;
													$place_district = $row->place_district;
													$place_address = $row->place_address;
													$place_postcode = $row->place_postcode;
													$place_mobile = $row->place_mobile;
													$working_time_id = $row->working_time_id;
													$place_lat = $row->place_lat;
													$place_long = $row->place_long;
													$place_condition = $row->place_condition;
													
													if($request_place_id != 0){
														$stores_place = $this->model_shipping->getStoreByRequestPlaceID($request_place_id);
														foreach($stores_place as $r){
															$store_id = $r->store_id;
														}
													}
													
													$stores = $this->model_shipping->getStoreByID($store_id);
													foreach($stores as $r2){
														$store_name = $r2->store_name;
														$store_url = $r2->store_url;
													}
		
													$store_url = base_url($store_url);
													
													$working = $this->storemanager->working_time($place_id);
												?>
												<div class="row">
													<div class="col-xs-12">
														<h5><?php echo $place_name; ?></h5>
													</div>
													<div class="col-md-2 form_group">
														<label>รหัสสถานที่ :</label>
													</div>
													<div class="col-md-10 form_group">
													   <b> <?php echo $place_code; ?></b>
													</div>
                                                    <div class="col-md-2 form_group">
														<label>เจ้าของ :</label>
													</div>
													<div class="col-md-10 form_group">
													   <a href="<?php echo $store_url; ?>"><?php echo $store_name; ?></a>
													</div>
													<div class="col-md-2 form_group">
														<label>ที่อยู่ :</label>
													</div>
													<div class="col-md-10 form_group">
													
														<?php echo $place_address; ?> 
														<?php echo $this->storemanager->getDistrictName($place_district); ?>
														<?php echo $this->storemanager->getAmphurName($place_amphur); ?>
														<?php echo $this->storemanager->getProvinceName($place_province); ?>
														<?php echo $place_postcode; ?>
                                                        <a target="_blank" href="https://www.google.com/maps/search/?api=1&query=<?php echo $place_lat; ?>,<?php echo $place_long; ?>" class="icon-location">ดูแผนที่</a>
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
													<div class="col-md-2 form_group">
														<label>วันที่ทำการ :</label>
													</div>
													<div class="col-md-10 form_group">
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
																	//$place_id = $w->place_id;
																	$work_day = $w->work_day;
																	$work_starttime = $w->work_starttime;
																	$work_endtime = $w->work_endtime;
																	$open_all_day = $w->open_all_day;
																	$is_holiday = $w->is_holiday;
																	/*if($work_starttime == 0){
																		$work_starttime = "-";	
																	}
																	if($work_endtime == 0){
																		$work_endtime = "-";	
																	}*/
																	
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
																		//$open_all_day = "เปิดตามเวลา";
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
													</div>
													
												
												</div>
												<br />
												<hr />
												<br />
												<?php } ?>
    
                                                



                                            </div>
                                            



                                            </div>
                                            <!--/ .tab_containers_wrap -->

                                        </div>
                                        <!--/ .tabs-->

                                        <!-- - - - - - - - - - - - - - End of tabs v2 - - - - - - - - - - - - - - - - -->

                                </section>
                                <!--/ [col]-->
                            </div>
                            

                        </div>
                        <!--/ .section_offset -->

                    </main>
                    <!--/ [col]-->

                </div>
                <!--/ .row-->

            </div>
            <!--/ .container-->

        </div>
        <!--/ .page_wrapper-->

<?php $this->load->view("templates/footer"); ?>
