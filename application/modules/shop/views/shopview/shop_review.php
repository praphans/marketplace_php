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
            รีวิวร้านค้า <span class="caret"></span>
          </button>
           
                            <section class="section_offset collapse" id="shop_category">

                                <ul class="theme_menu theme_category">
									<li><a href="<?php echo site_url($store_url); ?>">รายการสินค้า</a></li>
									<?php if($number_of_place > 0){ ?>
                                    <li><a href="<?php echo site_url($store_url."/สถานที่ส่งสินค้า"); ?>">สถานที่ส่งสินค้า</a></li>
                                    <?php } ?>
                                    <?php if($review_number > 0){ ?>
                                    <li  class="active"><a href="<?php echo site_url($store_url."/รีวิวร้านค้า"); ?>">รีวิวร้านค้า (<?php echo $review_number; ?>)</a></li>
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
								<li><a href="<?php echo site_url($store_url."/สถานที่ส่งสินค้า"); ?>">สถานที่ส่งสินค้า</a></li>
                                <?php } ?>
                                <?php if($review_number > 0){ ?>
								<li class="active"><a href="<?php echo site_url($store_url."/รีวิวร้านค้า"); ?>">รีวิวร้านค้า (<?php echo $review_number; ?>)</a></li>
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
								<div id="tab-3">

									<section class="section_offset">

										<ul class="reviews">

											<?php 
											foreach($review as $row){
												$review_id = $row->review_id;
												$order_id = $row->order_id;
												$member_id = $row->member_id;
												$store_id = $row->store_id;
												$product_id = $row->product_id;
												$review_rating = $row->review_rating;
												$review_content = $row->review_content;
												$review_images = $row->review_images;
												$review_type = $row->review_type;
												$review_status = $row->review_status;
												$timestamp = $row->timestamp;
												
												$member = $this->model_review->getReviewMemberByID($member_id);
												$name = "-";
												if(count($member))$name = $member[0]->first_name." ".$member[0]->last_name;
											?>
											<li>

												<!-- - - - - - - - - - - - - - Review - - - - - - - - - - - - - - - - -->
												
												<article class="review">

													<!-- - - - - - - - - - - - - - Rates - - - - - - - - - - - - - - - - -->

													<ul class="review-rates">

														<!-- - - - - - - - - - - - - - Price - - - - - - - - - - - - - - - - -->
														<?php $review_rating = ($review_rating/5)*100; ?>
														<div class="rating ">
																			<div class="star-ratings">
                                                                              <div class="fill-ratings" style="width: <?php echo $review_rating; ?>%;">
                                                                                <span>★★★★★</span>
                                                                              </div>
                                                                              <div class="empty-ratings">
                                                                                <span>★★★★★</span>
                                                                              </div>
                                                                            </div>
																		</div>
														</li>
													</ul>
													<div class="review-body">

														<div class="review-meta">

															รีวิวโดย <b><?php echo $name; ?></b> เมื่อ <?php echo $this->utils->getThaiDate($timestamp); ?>

														</div>

														<p> <?php echo $review_content; ?> </p>

													</div>

												</article>

											</li>

                                            
                                            <?php } ?>
                                            

										</ul>

										<div class="review_pagenum v_centered">
											
										</div>

									</section><!--/ .section_offset -->

								</div><!--/ #tab-3-->

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
