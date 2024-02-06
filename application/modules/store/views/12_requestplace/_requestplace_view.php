<?php $this->load->view("templates/header"); ?>



<div class="secondary_page_wrapper">

				<div class="container">

					<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

					<ul class="breadcrumbs">

						<li><a href="<?php echo base_url(); ?>">หน้าหลัก</a></li>
						<li><a href="#">บัญชีร้านค้า</a></li>
						<li>รายการขอใช้สถานที่</li>

					</ul>

					<!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->

					<div class="row">

						<?php $this->load->view("store/templates/left_tab"); ?>

						

						<main class="col-md-9 col-sm-8 padding-l-0">

							<div class="tabs type_2 ">

								
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="">รายการขอใช้สถานที่</h4>
                                    </div>
                                    
                                </div>
								<div class="tab_containers_wrap">
                                    
									
									
                                    
                                        <!-- Start สถานที่ -->
                                        <div class="theme_box">
                                           
                                            <?php
                                            if(count($requestplace)<=0){
												echo "ไม่มีรายการคำขอใช้สถานที่";	
											}
                                            foreach($requestplace as $row){
                                                $place_id = $row->place_id;
                                                $place_code = $row->place_code;
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
                                                
												$store_request = $this->model_requestplace->getStoreByID($store_id);
												
												foreach($store_request as $row){
													$store_name = $row->store_name;	
												}
                                                $working = $this->storemanager->working_time($place_id);
                                            ?>
                                            <div class="row">
                                            	<div class="col-xs-12">
                                                   <h4>ร้าน<?php echo $store_name; ?> ขอใช้สถานที่รหัส <span class="label label-success"><?php echo $place_code; ?></span></h4>
                                                </div>
                                                <div class="col-md-2 form_group">
                                                    <label>ชื่อสถานที่ :</label>
                                                </div>
                                                <div class="col-md-10 form_group">
                                                    <b><?php echo $place_name; ?></b>
                                                </div>
                                                
                                               <!-- <div class="col-md-2 form_group">
                                                    <label>รหัสสถานที่ :</label>
                                                </div>
                                                <div class="col-md-10 form_group">
                                                    <b><?php echo $place_code; ?></b>
                                                </div>-->
                                                <div class="col-md-2 form_group">
                                                    <label>ที่อยู่ :</label>
                                                </div>
                                                <div class="col-md-10 form_group">
                                                
                                                    <?php echo $place_address; ?> 
                                                    <?php echo $this->storemanager->getDistrictName($place_district); ?>
                                                    <?php echo $this->storemanager->getAmphurName($place_amphur); ?>
                                                    <?php echo $this->storemanager->getProvinceName($place_province); ?>
                                                    <?php echo $place_postcode; ?>
                                               </div>
                                               
                                                <!--<div class="col-md-2 form_group">
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
                                                          <th scope="col">เปิด 24 ชั่วโมง</th>
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
                                                                if($open_all_day){
                                                                    $open_all_day = "เปิด 24 ชั่วโมง";
                                                                }else{
                                                                    $open_all_day = "เปิดตามเวลา";
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
                                                
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3 ">
                                                    <a target="_blank" href="<?php echo base_url("store/requestplace/approve/".$place_id); ?>" class="btn-block button_blue"><i class="icon-check-1"></i> อนุมัติ</a>
                                                </div>
                                               
                                            </div>
                                            <br />
                                            <hr />
                                            <br />
                                            <?php } ?>
                                            
                                        </div>
                                        <!-- End สถานที่ -->




								</div><!--/ .tab_containers_wrap -->

								<!-- - - - - - - - - - - - - - End of tabs containers - - - - - - - - - - - - - - - - -->

							</div><!--/ .tabs-->
								
						</main><!--/ [col]-->

					</div><!--/ .row-->

				</div><!--/ .container-->

			</div><!--/ .page_wrapper-->
        

<?php $this->load->view("templates/footer"); ?>
<?php $this->load->assets_by_name("left_tab","js"); ?>
