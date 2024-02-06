<?php $this->load->view("templates/header"); ?>



<div class="secondary_page_wrapper">

				<div class="container">

					<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

					<ul class="breadcrumbs">

						<li><a href="<?php echo base_url(); ?>" class="notcursor">หน้าหลัก</a></li>
						<li><a href="<?php echo base_url('store'); ?>" class="notcursor">บัญชีร้านค้า</a></li>
						<li>สถานที่รับสินค้าหรือส่งมอบสินค้า</li>

					</ul>

					<!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->

					<div class="row">

						<?php $this->load->view("store/templates/left_tab"); ?>

						<main class="col-md-9 col-sm-8 padding-l-0">

							<h4>ช่องทางการจัดส่งสินค้า</h4>

							<div class="theme_box">
								<div class="row">
									<div class="col-xs-12">
										<h4><i class="icon-truck-1"></i>เลือกการจัดส่ง</h4>
									</div>
									<?php
									
									foreach($myStore as $row){
										$store_id = $row->store_id;
										$member_id = $row->member_id;
										$store_name = $row->store_name;
										$store_avatar = $row->store_avatar;
										$store_cover = $row->store_cover;
										$store_description = $row->store_description;
										$store_url = $row->store_url;
										$store_type = $row->store_type;
										$store_category = $row->store_category;
										$store_status = $row->store_status;
										$store_shipping = $row->store_shipping;
										$store_shipping_charge = $row->store_shipping_charge;
										$first_name = $row->first_name;
										$last_name = $row->last_name;
										$identity_number = $row->identity_number;
										$tel = $row->tel;
										$province = $row->province;
										$amphur = $row->amphur;
										$district = $row->district;
										$address = $row->address;
										$zipcode = $row->zipcode;
										$account_name = $row->account_name;
										$account_number = $row->account_number;
										$bank_name = $row->bank_name;
										$timestamp = $row->timestamp;
									}
									
									$store_shipping = explode(",",$store_shipping);
									
									
									$checkbox_1_checked = "";
									$checkbox_2_checked = "";
									$checkbox_3_checked = "";
									foreach($store_shipping as $k=>$v){
										if($v == 1){
											$checkbox_1_checked = "checked";
										}else if($v == 2){
											$checkbox_2_checked = "checked";
										}else if($v == 3){
											$checkbox_3_checked = "checked";
										}
									}
									?>
									<div class="col-xs-12 form_group">
										<input type="checkbox" name="store_type" value="1" id="checkbox_1" <?php echo $checkbox_1_checked; ?>>
										<label for="checkbox_1">รับที่ผู้ขาย</label>
									</div>
									<div class="col-xs-12 form_group">
										<input type="checkbox" name="store_type" value="2" id="checkbox_2" <?php echo $checkbox_2_checked; ?>>
										<label for="checkbox_2">รับที่ตัวแทนผู้ขาย ( เอเย่นต์ )</label>
									</div>
									<div class="col-xs-12 form_group">
										<input type="checkbox" name="store_type" value="3" id="checkbox_3" <?php echo $checkbox_3_checked; ?>>
										<label for="checkbox_3">
											
											ส่งที่อยู่ผู้ซื้อ คิดราคาเพิ่ม 
											
										</label>
                                        <label for="checkbox_22">
											
											<input class="form-control" type="number" name="store_shipping_charge" id="store_shipping_charge" value="<?php echo $store_shipping_charge; ?>">
											
										</label>
                                        
									</div>
								</div>
								
							</div>

						</main><!--/ [col]-->

						<main class="col-md-9 col-sm-8 padding-l-0 margin-t-10">
							<div class="tabs type_2 ">
								<!-- - - - - - - - - - - - - - Navigation of tabs - - - - - - - - - - - - - - - - -->
								<div class="mobile_only_show">
									<button class="button_grey_outline btn-block text-left" type="button" data-toggle="collapse" 
									data-target="#shipping_tab" aria-expanded="false" aria-controls="shipping_tab">
									        สถานที่ส่งสินค้า<span class="caret"></span>
									</button>
								</div>
								<aside class="col-md-3 col-sm-4 collapse pl-0 pr-0" id="shipping_tab">
								    <section class="section_offset">
								        <ul class="theme_menu tabs_nav clearfix pb-5">
								            <li><a href="#tab-1">สถานที่ของฉัน</a></li>
											<li><a href="#tab-2">สถานที่ของเอเย่นต์</a></li>
											<li><a href="#tab-3">เขตพื้นที่บริการจัดส่ง</a></li>
								        </ul>
								    </section>
								</aside>

								<ul class="tabs_nav clearfix mobile_only_hide">
									<li><a href="#tab-1">สถานที่ของฉัน</a></li>
									<li><a href="#tab-2">สถานที่ของเอเย่นต์</a></li>
									<li><a href="#tab-3">เขตพื้นที่บริการจัดส่ง</a></li>
								</ul>

								<!-- - - - - - - - - - - - - - End navigation of tabs - - - - - - - - - - - - - - - - -->

								<!-- - - - - - - - - - - - - - Tabs container - - - - - - - - - - - - - - - - -->
								<br />
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="header_cont_inline"><i class="icon-location-2"></i> สถานที่รับบริการหรือส่งมอบสินค้า</h4>
                                    </div>
                                    
                                </div>
								<div class="tab_containers_wrap">
                                    
									
									<!-- - - - - - - - - - - - - - End tab - - - - - - - - - - - - - - - - -->

								</div><!--/ .tab_containers_wrap -->

								<!-- - - - - - - - - - - - - - End of tabs containers - - - - - - - - - - - - - - - - -->

							</div><!--/ .tabs-->
								
						</main><!--/ [col]-->

					</div><!--/ .row-->

				</div><!--/ .container-->

			</div><!--/ .page_wrapper-->
        


<?php $this->load->view("store/8_shipping/modals/modal_shop_add_service_address"); ?>
<?php $this->load->view("store/8_shipping/modals/modal_shop_add_address"); ?>
<?php $this->load->view("store/8_shipping/modals/modal_shop_agent_address"); ?>
<?php $this->load->view("templates/footer"); ?>
<?php $this->load->assets_by_name("left_tab","js"); ?>
<?php $this->load->assets_by_name("Shipping","js"); ?>
