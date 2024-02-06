<?php $this->load->view("templates/header"); ?>


<div class="secondary_page_wrapper">

				<div class="container">

					<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

					<ul class="breadcrumbs">

						<li><a href="<?php echo base_url(); ?>" class="notcursor">หน้าหลัก</a></li>
						<li><a href="<?php echo base_url('store'); ?>" class="notcursor">บัญชีร้านค้า</a></li>
						<li>คู่ค้าของฉัน</li>
						

					</ul>

					<!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->

					<div class="row">

						<?php $this->load->view("store/templates/left_tab"); ?>

						<main class="col-md-9 col-sm-8 padding-l-0">

							

							<div class="theme_box">
								<div class="row">
									<div class="col-xs-12 pt-5">
										<h4 class="mg_b_0">คู่ค้าของฉัน</h4>
									</div>
								</div>
								
							</div>

							<!-- ข้อมูลสินค้า -->

							<div class="theme_box">
								<div class="row">
										<div class="section_offset">

				
												<div class="table_layout list_view list_view_products" id="products_container">
				
                									<?php 
														foreach($store_id_list as $k=>$v){
															
															$partner_store_id = $v;
															
															if($partner_store_id){
																$store = $this->model_partner->getStoreByID($partner_store_id);
																foreach($store as $row){
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
																	
																	$province = $this->storemanager->getDistrictName($province);
																	$amphur = $this->storemanager->getAmphurName($amphur);
																	$district = $this->storemanager->getProvinceName($district);
																}
															
														
													?>
                                                    
                                                    <a class="shop_list_box" href="<?php echo $store_url; ?>">
                                                        <div class="table_cell col-md-4 col-sm-6 col-xs-6">
                                            
                                                            <div class="product_item">
                                            
                                                                <!-- - - - - - - - - - - - - - Thumbmnail - - - - - - - - - - - - - - - - -->
                                            
                                                                <div class="image_wrap">
                                            
                                                                    <img src="<?php echo base_url($store_avatar); ?>" alt="<?php echo $store_name; ?>">
                                            
                                                                </div><!--/. image_wrap-->
                                            
                                                                <!-- - - - - - - - - - - - - - End thumbmnail - - - - - - - - - - - - - - - - -->
                                            
                                                                <!-- - - - - - - - - - - - - - Full description (only for list view) - - - - - - - - - - - - - - - - -->
                                            
                                                                <div class="full_description">
                                            
                                                                    <span class="shop_title"><?php echo $store_name; ?></span>
                                                                    <span class="shop_title"><?php echo $store_category; ?></span>
                                                                    <span class="shop_title"><?php echo $store_follower; ?> ผู้ติดตาม</span>
                                            
                                                                    <div class="v_centered">
                                            
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
                                            
                                                                </div>
                                            
                                                                
                                                            </div><!--/ .product_item-->
                                            
                                                        </div>
                                                    </a>
                                            
                                                     <?php }} ?>
        
													<!--<div class="table_row shop_list">
														<a class="shop_list_box" href="<?php echo $store_url; ?>">
															<div class="table_cell col-md-4 col-sm-6">
																<div class="product_item">
																	<div class="image_wrap">
																		<img src="<?php echo base_url($store_avatar); ?>" alt="<?php echo $store_name; ?>">
																	</div>
																	<div class="full_description">
				
																		<span class="shop_title"><?php echo $store_name; ?></span>
																		<span class="shop_title"><?php echo $store_code; ?></span>
																		<span class="shop_title"><?php echo $store_follower; ?> ผู้ติดตาม</span>
				
																		<div class="v_centered">
																			<div class="star-ratings">
                                                                              <div class="fill-ratings" style="width: <?php echo $store_rating; ?>%;">
                                                                                <span>★★★★★</span>
                                                                              </div>
                                                                              <div class="empty-ratings">
                                                                                <span>★★★★★</span>
                                                                              </div>
                                                                            </div>
																		</div>
				
																	</div>
																</div>
				
															</div>
														</a>-->
														
                                                        
                                                       
														
				
														<!-- - - - - - - - - - - - - - End of shop - - - - - - - - - - - - - - - - -->
				
													</div>
				
												</div>
				
										
				
											</div>
								</div>
								
							</div>

							

						</main><!--/ [col]-->

					</div><!--/ .row-->
					
				</div><!--/ .container-->

			</div><!--/ .page_wrapper-->

        


<?php $this->load->view("templates/footer"); ?>
<?php $this->load->assets_by_name("left_tab"); ?> 
<?php $this->load->assets_by_name('Partner'); ?>
