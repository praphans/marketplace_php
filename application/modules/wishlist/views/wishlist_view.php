<?php $this->load->view("templates/header"); ?>

<div class="secondary_page_wrapper">

				<div class="container">

					<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

					<ul class="breadcrumbs">

						<li><a href="<?php echo base_url(); ?>">หน้าหลัก</a></li>
						<li>รายการโปรด</li>

					</ul>

					<!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->

					<div class="row">

						<aside class="col-md-3 col-sm-4">

							
							<!--<button class="mobile_only_show btn-block button_grey text-left" type="button" data-toggle="collapse" data-target="#product_category" aria-expanded="false" aria-controls="product_category">
                                    ค้นหาจากหมวดหมู่สินค้า <span class="caret"></span>
                            </button>
							<section class="section_offset collapse" id="product_category">

								<div class="theme_menu theme_category_wishlist">

									<dl class="accordion">
                                        <dt><a href="<?php echo base_url("wishlist/me/0"); ?>">รวมทุกหมวดหมู่</a></dt>
                                        <?php
                                        $categorys = $this->model_shop->getCategoryProduct();
                                        foreach($categorys as $row){
                                            $main_category_id = $row->id;
                                            $main_category_name = $row->category_name;
                                            
                                            $subcategorys = $this->model_shop->getSubCategoryProductByCategoryID($main_category_id);
                                            
                                                    
                                            ?>
                                            <dt><a href="<?php echo base_url("wishlist/me/".$main_category_id); ?>"><?php echo $main_category_name; ?></a></dt>
                                            <dd>
                                                <ul>
                                                    <?php 
                                                    foreach($subcategorys as $sub){
                                                        $sub_id = $sub->id;
                                                        $sub_category_id = $sub->category_id;
                                                        $sub_category_name = $sub->category_name;
                                                    ?>
                                                    <li>
                                                        <a href="<?php echo base_url("wishlist/me/".$main_category_id."/".$sub_id); ?>"><?php echo $sub_category_name; ?></a>
                                                    </li>
                                                    
                                                    <?php } ?>
                                                </ul>
                                            </dd>
                                            <?php } ?>
                                            
                                        </dl>

								</div>

							</section>
                            
                            
                            <section class="section_offset mobile_only_hide">

								<div class="theme_menu theme_category_wishlist">

									
									<dl class="accordion">
                                        <dt><a href="<?php echo base_url("wishlist/me/0"); ?>">รวมทุกหมวดหมู่</a></dt>
                                        <?php
                                        $categorys = $this->model_shop->getCategoryProduct();
                                        foreach($categorys as $row){
                                            $main_category_id = $row->id;
                                            $main_category_name = $row->category_name;
                                            
                                            $subcategorys = $this->model_shop->getSubCategoryProductByCategoryID($main_category_id);
                                            
                                                    
                                            ?>
                                            <dt><a href="<?php echo base_url("wishlist/me/".$main_category_id); ?>"><?php echo $main_category_name; ?></a></dt>
                                            <dd>
                                                <ul>
                                                    <?php 
                                                    foreach($subcategorys as $sub){
                                                        $sub_id = $sub->id;
                                                        $sub_category_id = $sub->category_id;
                                                        $sub_category_name = $sub->category_name;
                                                    ?>
                                                    <li>
                                                        <a href="<?php echo base_url("wishlist/me/".$main_category_id."/".$sub_id); ?>"><?php echo $sub_category_name; ?></a>
                                                    </li>
                                                    
                                                    <?php } ?>
                                                </ul>
                                            </dd>
                                            <?php } ?>
                                            
                                        </dl>

								</div>

							</section>-->
                            
							<input type="hidden" name="main_category_id" id="main_category_id" value="<?php echo $current_main_category_id; ?>" />
                            <input type="hidden" name="sub_category_id" id="sub_category_id" value="<?php echo $current_sub_category_id; ?>" />
							<!-- - - - - - - - - - - - - - End of information - - - - - - - - - - - - - - - - -->

							<!-- - - - - - - - - - - - - - Filter - - - - - - - - - - - - - - - - -->

							<section class="section_offset">

								<h3>กรองสินค้า</h3>

								<form class="type_2">

									<div class="table_layout list_view">

										<div class="table_row">

											<!-- - - - - - - - - - - - - - Manufacturer - - - - - - - - - - - - - - - - -->

											<div class="table_cell">

												<fieldset>

													<legend>ประเภท</legend>

													<ul class="checkboxes_list">

														<li>
															
															<input type="checkbox" name="new_product" id="new_product" value="1" onchange="onFilteringOption(null,1);">
															<label for="new_product">สินค้าใหม่</label>

														</li>

														<li>
															
															<input type="checkbox" name="second_hand_product" id="second_hand_product" value="2" onchange="onFilteringOption(null,1);">
															<label for="second_hand_product">สินค้ามือสอง</label>

														</li>

													</ul>

												</fieldset>

											</div><!--/ .table_cell -->

											<!-- - - - - - - - - - - - - - End manufacturer - - - - - - - - - - - - - - - - -->

											<!-- - - - - - - - - - - - - - Manufacturer - - - - - - - - - - - - - - - - -->

											<!--<div class="table_cell">

												<fieldset>

													<legend>ส่งของ</legend>

													<ul class="checkboxes_list">

														<li>
															
															<input type="checkbox" name="is_delivery" id="is_delivery" onchange="onFilteringOption();">
															<label for="is_delivery">มีบริการจัดส่ง</label>

														</li>

														<li>
															
															<input type="checkbox" name="no_delivery" id="no_delivery" onchange="onFilteringOption();">
															<label for="no_delivery">รับสินค้าเอง</label>

														</li>
														
													</ul>

												</fieldset>

											</div>-->

											<!-- - - - - - - - - - - - - - End manufacturer - - - - - - - - - - - - - - - - -->

											<!-- - - - - - - - - - - - - - Manufacturer - - - - - - - - - - - - - - - - -->

											<div class="table_cell">

												<fieldset>

													<legend>ชำระเงิน</legend>

													<ul class="checkboxes_list">

														<li>
															
															<input type="checkbox" name="gateway_type_1" id="gateway_type_1" value="1" onchange="onFilteringOption(null,1);">
															<label for="gateway_type_1">ชำระเมื่อรับของ</label>

														</li>

														<li>
															
															<input type="checkbox" name="gateway_type_2" id="gateway_type_2" value="2" onchange="onFilteringOption(null,1);">
															<label for="gateway_type_2">ชำระบางส่วน</label>

														</li>

														<li>
															
															<input type="checkbox" name="gateway_type_3" id="gateway_type_3" value="3" onchange="onFilteringOption(null,1);">
															<label for="gateway_type_3">ชำระเต็มจำนวน</label>

														</li>
														
													</ul>

												</fieldset>

											</div><!--/ .table_cell -->

											<!-- - - - - - - - - - - - - - End manufacturer - - - - - - - - - - - - - - - - -->


											<div class="table_cell mobile_only_hide">
                                            
                                            

												<fieldset>

													<legend>ร้านค้าแนะนำ</legend>

													<ul class="checkboxes_list">
													<?php
                                                        $shop_recommend = $this->model_shop->getShopRecommendList(0,5);
											
                                                        foreach($shop_recommend as $row){
                                                                $store_id = $row->store_id;
                                                                $member_id = $row->member_id;
                                                                $store_name = $row->store_name;
                                                                $store_avatar = $row->store_avatar;
                                                                $store_cover = $row->store_cover;
                                                                $store_description = $row->store_description;
                                                                $store_follower = $row->store_follower;
                                                                $store_rating = $row->store_rating;
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
                                                                
																$store_name = $this->utils->string_shorten($store_name,20,40);
                                                            ?>
                                                
														<li>
															<input type="checkbox" name="store_id_list[]" class="store_id_list" id="store_id_list<?php echo $store_id; ?>" value="<?php echo $store_id; ?>" onchange="onFilteringOption(this,1);">
															<label class="shop_fe_mini_lb" for="store_id_list<?php echo $store_id; ?>"> </label>
															<!-- - - - - - - - - - - - - - Shop - - - - - - - - - - - - - - - - -->
															<div class="shop_fe_mini">
																<a class="feature_list_shop_mini " href="<?php echo $store_url; ?>">
																	<div class="product_item ">
																		<div class="image_wrap">
																			<img src="<?php echo base_url($store_avatar); ?>" alt="<?php echo $store_name; ?>">
																		</div><!--/. image_wrap-->
																		<div class="full_description">
																			<span class="shop_title"><?php echo $store_name; ?></span>
																			<div class="v_centered">
																				
                                                                             <div class="rating ">
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
																</a>
															</div>
															<!-- - - - - - - - - - - - - - End Shop - - - - - - - - - - - - - - - - -->
														</li>
                                                        
                                                        <?php } ?>

														
													</ul>

												</fieldset>
                                                

											</div><!--/ .table_cell -->

											<!-- - - - - - - - - - - - - - End manufacturer - - - - - - - - - - - - - - - - -->

										</div><!--/ .table_row -->

									</div><!--/ .table_layout -->

								</form>

							</section>

							<!-- - - - - - - - - - - - - - End of filter - - - - - - - - - - - - - - - - -->


						</aside><!--/ [col]-->

						<main class="col-md-9 col-sm-8 padding-l-0">

							<h2>รายการโปรด</h2>

							<!-- - - - - - - - - - - - - - Products - - - - - - - - - - - - - - - - -->

							<div class="section_offset">

								<header class="top_box on_the_sides">

									<div class="left_side clearfix v_centered">

										<!-- - - - - - - - - - - - - - Sort by - - - - - - - - - - - - - - - - -->

										<div class="v_centered">

											<span>จัดเรียงตาม :</span>

											<div class="custom_select sort_select">
												
												<select name="view_type" id="view_type" onchange="onFilteringOption(null,1);">
                                                    <option value="popular" selected="selected">ยอดนิยม</option>
                                                    <option value="news" >มาใหม่</option>
                                                    <option value="rating">รีวิวเรตติ้ง</option>
                                                    <option value="price_hight">ราคาสูงสุด</option>
                                                    <option value="price_low">ราคาต่ำสุด</option>
                                                </select>

											</div>

										</div>

										<!-- - - - - - - - - - - - - - End of sort by - - - - - - - - - - - - - - - - -->

									</div>

									<div class="right_side">

										<!-- - - - - - - - - - - - - - Number of products shown - - - - - - - - - - - - - - - - -->

										<div class="v_centered">

											<span>แสดงจำนวน :</span>

											<div class="custom_select">

												<select name="view_per_page" id="view_per_page" onchange="onFilteringOption(null,1);">

                                                    <option value="10" selected>10</option>
                                                    <option value="20">20</option>
                                                    <option value="30">30</option>
                                                    <option value="40">40</option>
                                                    <option value="50">50</option>

                                                </select>

											</div>

										</div>

										<!-- - - - - - - - - - - - - - End of number of products shown - - - - - - - - - - - - - - - - -->

									</div>

								</header>

								<div class="top_box" style="border-bottom: 1px solid #eaeaea;" id="view_container">

									

								</div><!--/ .table_layout -->

								
							</div>

							<!-- - - - - - - - - - - - - - End of products - - - - - - - - - - - - - - - - -->

						</main><!--/ [col]-->

					</div><!--/ .row-->

				</div><!--/ .container-->

			</div><!--/ .page_wrapper-->

	
<?php $this->load->view("templates/footer"); ?>
<?php $this->load->assets_by_name('Wishlist'); ?>

