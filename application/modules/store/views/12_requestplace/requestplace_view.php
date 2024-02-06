<?php $this->load->view("templates/header"); ?>



<div class="secondary_page_wrapper">

				<div class="container">

					<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

					<ul class="breadcrumbs">

						<li><a href="<?php echo base_url(); ?>" class="notcursor">หน้าหลัก</a></li>
						<li><a href="<?php echo base_url('store'); ?>" class="notcursor">บัญชีร้านค้า</a></li>
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
                                                $place_status = $row->place_status;

												$store_request = $this->model_requestplace->getStoreByID($store_id);
												foreach($store_request as $row){
													$store_name = $row->store_name;	
												}

                                                $status_result = $this->model_requestplace->getStatusByID($place_status);
                                                if(count($status_result)>0){
                                                    $status_name = $status_result[0]->status_name;
                                                }else{
                                                    $status_name = "";
                                                }

                                                $verify_url = base_url("store/requestplace/approve/".$place_id);
                                                $notverify_url = base_url("store/requestplace/notapprove/".$place_id);
                                                $cancel_verify_url = base_url("store/requestplace/cancelUnconfirmed/".$place_id);
                                                $cancel_notverify_url = base_url("store/requestplace/cancelUnconfirmed/".$place_id);

                                                if($place_status == 1){
                                                    $status_label = 'label label-warning';
                                                    $btn_confirm = "<a href='".$verify_url."' class='btn-block button_blue'>อนุมัติ</a>";
                                                    $btn_notconfirm = "<a href='".$notverify_url."' class='btn-block button_blue'>ไม่อนุมัติ</a>";
                                                    $btn_cancel_verify = "";
                                                    $btn_cancel_notverify = "";
                                                }else if($place_status == 2){
                                                    $status_label = 'label label-success';
                                                    $btn_confirm = "";
                                                    $btn_notconfirm = "";
                                                    $btn_cancel_verify = "";
                                                    $btn_cancel_notverify = "<a href='".$cancel_notverify_url."' class='btn-block button_blue'>ยกเลิกการอนุมัติ</a>";
                                                }else if($place_status == 3){
                                                    $status_label = 'label label-danger';
                                                    $btn_confirm = "";
                                                    $btn_notconfirm = "";
                                                    $btn_cancel_verify = "<a href='".$cancel_verify_url."' class='btn-block button_blue'>ยกเลิกการไม่อนุมัติ</a>";
                                                    $btn_cancel_notverify = "";
                                                }else{
                                                    $status_label = 'label label-danger';
                                                    $btn_confirm = "";
                                                    $btn_notconfirm = "";
                                                    $btn_cancel_verify = "";
                                                    $btn_cancel_notverify = "";
                                                }

                                                $working = $this->storemanager->working_time($place_id);
                                            ?>
                                            <div class="row">
                                            	<div class="col-xs-12">
                                                   <h4>ร้าน<?php echo $store_name; ?> ขอใช้สถานที่รหัส <span class="label label-success"><?php echo $place_code; ?></span></h4>
                                                </div>
                                                <div class="col-md-2 form_group">
                                                    <label>สถานะ :</label>
                                                </div>
                                                <div class="col-md-10 form_group">
                                                    <span class="<?php echo $status_label; ?>"><?php echo $status_name; ?></span>
                                                </div>
                                                <div class="col-md-2 form_group">
                                                    <label>ชื่อสถานที่ :</label>
                                                </div>
                                                <div class="col-md-10 form_group">
                                                    <b><?php echo $place_name; ?></b>
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
                                                </div>
                                                
                                               
                                               
                                                
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3 ">
                                                    <?php echo $btn_confirm; ?>
                                                    <?php echo $btn_cancel_verify; ?>
                                                    <?php echo $btn_cancel_notverify; ?>
                                                </div>
                                                <div class="col-md-3 ">
                                                    <?php echo $btn_notconfirm; ?>
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
