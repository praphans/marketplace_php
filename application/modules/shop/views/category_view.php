<?php $this->load->view("templates/header"); ?>

			<!-- - - - - - - - - - - - - - Page Wrapper - - - - - - - - - - - - - - - - -->
<div class="secondary_page_wrapper">

				<div class="container">

					<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->
					<input type="hidden" name="category_id" id="category_id" value="<?php echo $category_id; ?>" />
					<ul class="breadcrumbs">

						<li><a href="<?php echo base_url(); ?>">หน้าหลัก</a></li>
						<li>ร้านค้า</li>

					</ul>

					<!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->

					<div class="row">

						<aside class="col-md-3 col-sm-4">

							<!-- - - - - - - - - - - - - - Information - - - - - - - - - - - - - - - - -->

							<button class="mobile_only_show btn-block button_grey_outline text-left" type="button" data-toggle="collapse" data-target="#shop_category" aria-expanded="false" aria-controls="shop_category">
                            ค้นหาจากหมวดหมู่ร้านค้า <span class="caret"></span>
                          </button>
                           
                           
                           <section class="section_offset mobile_only_hide">

								<ul class="theme_menu theme_category_shop">
									<li><a href="<?php echo base_url("shop"); ?>">รวมทุกหมวดหมู่</a></li>
                                    <?php
									foreach($category as $row){
										$id = $row->id;
										$category_name = $row->category_name;
										$category_link = base_url("shop/category/".$id."/".$category_name);
										$category_link = str_replace(" ","-",$category_link);
									?>
                                    <li><a href="<?php echo $category_link; ?>"><?php echo $category_name; ?></a></li>
									
                                    <?php } ?>

								</ul>

							</section><!--/ .section_offset -->
							<section class="section_offset collapse" id="shop_category">

								<ul class="theme_menu theme_category_shop">
									<li><a href="<?php echo base_url("shop"); ?>">รวมทุกหมวดหมู่</a></li>
                                    <?php
									foreach($category as $row){
										$id = $row->id;
										$category_name = $row->category_name;
										$category_link = base_url("shop/category/".$id."/".$category_name);
										$category_link = str_replace(" ","-",$category_link);
									?>
                                    <li><a href="<?php echo $category_link; ?>"><?php echo $category_name; ?></a></li>
									
                                    <?php } ?>

								</ul>

							</section><!--/ .section_offset -->
							
							

							<!-- - - - - - - - - - - - - - Filter - - - - - - - - - - - - - - - - -->

							<section class="section_offset">

								<h3>กรองร้านค้า</h3>

								<form class="type_2">

									<div class="table_layout list_view">

										<div class="table_row">

											<!-- - - - - - - - - - - - - - Manufacturer - - - - - - - - - - - - - - - - -->

											<div class="table_cell">

												<fieldset>

													<legend>ประเภท</legend>

													<ul class="checkboxes_list">

														<li>
															
															<input type="checkbox" name="view_follower" id="view_follower" onchange="onFilteringOption();" value="0">
															<label for="view_follower">ร้านค้าที่ติดตาม</label>

														</li>

														<li>
															
															<input type="checkbox" name="view_vat" id="view_vat" onchange="onFilteringOption();" value="0">
															<label for="view_vat">ผู้ประกอบการจดทะเบียนภาษีมูลค่าเพิ่ม</label>

														</li>

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


							<!-- - - - - - - - - - - - - - Featured products - - - - - - - - - - - - - - - - -->

							<section class="section_offset " >

								<h3 class="offset_title">ร้านค้าแนะนำ</h3>

								<!-- - - - - - - - - - - - - - Carousel of featured products - - - - - - - - - - - - - - - - -->

								<div class="owl_carousel carousel_in_tabs">

									<!-- - - - - - - - - - - - - - Shop - - - - - - - - - - - - - - - - -->
                                    <?php
									
                                    foreach($shop_recommend as $row){
											$store_id = $row->store_id;
											$member_id = $row->member_id;
											$store_name = $row->store_name;
											$store_avatar = $row->store_avatar;
											$store_cover = $row->store_cover;
											$store_description = $row->store_description;
											$store_url = $row->store_url;
											$store_rating = $row->store_rating;
											$store_follower = $row->store_follower;
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
											
										?>
                                        <a class="feature_list_shop" href="<?php echo $store_url; ?>">
                                            <div class="product_item ">
                                                <div class="image_wrap">
                                                    <img src="<?php echo base_url($store_avatar); ?>" alt="">
                                                </div>
                                                <div class="full_description">
                                                    <span class="shop_title"><?php echo $store_name." ".$category_id; ?></span>
                                                    <span class="shop_title"><?php echo $store_category; ?></span>
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
                                        </a>    
									 <?php } ?>
									<!-- - - - - - - - - - - - - - End Shop - - - - - - - - - - - - - - - - -->

									
									<!-- - - - - - - - - - - - - - End Shop - - - - - - - - - - - - - - - - -->

								</div><!--/ .owl_carousel.five_items-->

								<!-- - - - - - - - - - - - - - End of featured products - - - - - - - - - - - - - - - - -->

							</section><!--/ .section_offset.animated.transparent-->

							<!-- - - - - - - - - - - - - - End of featured products - - - - - - - - - - - - - - - - -->

							<!-- - - - - - - - - - - - - - Products - - - - - - - - - - - - - - - - -->

							<div class="section_offset">

								<header class="top_box on_the_sides">

									<div class="left_side clearfix v_centered">

										<!-- - - - - - - - - - - - - - Sort by - - - - - - - - - - - - - - - - -->

										<div class="v_centered">

											<span>จัดเรียงตาม :</span>

											<div class="custom_select sort_select">
												
												<select name="view_type" id="view_type" onchange="onFilteringOption();">
													<option value="popular" selected="selected">ยอดนิยม</option>
													<option value="follow">ผู้ติดตาม</option>
													<option value="rating">รีวิวเรตติ้ง</option>
													<option value="new">ร้านใหม่</option>
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

												<select name="view_per_page" id="view_per_page" onchange="onFilteringOption();">

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

								<div id="view_container"></div>

							</div>

							<!-- - - - - - - - - - - - - - End of products - - - - - - - - - - - - - - - - -->

						</main><!--/ [col]-->

					</div><!--/ .row-->

				</div><!--/ .container-->

			</div><!--/ .page_wrapper-->
			
			<!-- - - - - - - - - - - - - - End Page Wrapper - - - - - - - - - - - - - - - - -->
<?php $this->load->view("templates/footer"); ?>
<?php $this->load->assets_by_name('Shop'); ?>
