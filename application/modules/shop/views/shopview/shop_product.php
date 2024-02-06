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

					<input type="hidden" name="view_store_url" id="view_store_url" value="<?php echo $store_url; ?>"/>
                    <input type="hidden" name="view_category_id" id="view_category_id" value="<?php if(isset($category_id))echo $category_id; ?>"/>
                    <input type="hidden" name="view_subcategory_id" id="view_subcategory_id" value="<?php if(isset($subcategory_id)) echo $subcategory_id; ?>"/>

					<!-- - - - - - - - - - - - - - Seller Information - - - - - - - - - - - - - - - - -->

					<?php echo $this->load->view("shop/templates/shop_detail",$mystore); ?>

					<!-- - - - - - - - - - - - - - End of seller information - - - - - - - - - - - - - - - - -->

					
					<!-- - - - - - - - - - - - - - Tabs - - - - - - - - - - - - - - - - -->

					<div class="section_offset">

						<div class="tabs type_2">

							
                            <button class="mobile_only_show btn-block button_grey_outline text-left" type="button" data-toggle="collapse" data-target="#shop_category" aria-expanded="false" aria-controls="shop_category">
            รายการสินค้า <span class="caret"></span>
          </button>
           
                            <section class="section_offset collapse" id="shop_category">

                                <ul class="theme_menu theme_category">
									<li class="active"><a href="<?php echo site_url($store_url); ?>">รายการสินค้า</a></li>
									<?php if($number_of_place > 0){ ?>
                                    <li><a href="<?php echo site_url($store_url."/สถานที่ส่งสินค้า"); ?>">สถานที่ส่งสินค้า</a></li>
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

								<li class="active"><a href="<?php echo site_url($store_url); ?>">รายการสินค้า</a></li>
								<?php if($number_of_place > 0){ ?>
								<li><a href="<?php echo site_url($store_url."/สถานที่ส่งสินค้า"); ?>">สถานที่ส่งสินค้า</a></li>
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

							<div class="tab_containers_wrap">

								<div id="tab-1" class="tab_container">

									<div class="row">

										<aside class="col-md-3 col-sm-4">

											
                                            
                                            
											<section class="section_offset mobile_only_hide">

												<div class="theme_menu">
													<?php
														$collapse_active = "";
														if($category_id == 0){
															$collapse_active = "active";
															
														}
													?>
													<!-- - - - - - - - - - - - - - Accordion - - - - - - - - - - - - - - - - -->
                                                    <ul class="theme_menu">
                                                    <li class="<?php echo $collapse_active; ?>">
                                                        <a href="<?php echo base_url($store_url); ?>">รวมทุกหมวดหมู่</a>
                                                    </li>
                                                    <?php
													$categorys = $this->model_shop->getCategoryProductHasProductInStore($store_id);
													foreach($categorys as $row){
														$main_category_id = $row->id;
														$main_category_name = $row->category_name;
														$number_in_this_category = $this->model_shop->getProductNumberInStoreCategory($main_category_id,$store_id);
														$subcategorys = $this->model_shop->getSubCategoryProductByCategoryID($main_category_id);
														$collapse = "";
														$collapse_active = "";
														if($main_category_id == $category_id){
															$collapse = "in";
															
														}
														
														
														?>
                                                        
                                                   
                                                    
                                                    <?php if(count($subcategorys) > 0){	 ?>
                                                    <li class="<?php echo $collapse_active; ?>"><a data-toggle="collapse" href="#collapseExample<?php echo $main_category_id; ?>"><?php echo $main_category_name; ?> <span class="caret"></span></a></li>
                                                    <div class="collapse <?php echo $collapse; ?>" id="collapseExample<?php echo $main_category_id; ?>">
                                                      <div class="card card-body">
                                                        <ul class="theme_menu" style="text-indent:30px;">
                                                            	<?php 
																foreach($subcategorys as $sub){
																	$sub_id = $sub->id;
																	$sub_category_id = $sub->category_id;
																	$sub_category_name = $sub->category_name;
																	
																	$number_in_this_subcategory = $this->model_shop->getProductNumberInStoreSubCategory($main_category_id,$store_id);
																	
																	if($subcategory_id == $sub_id){
																		$collapse_active = "active";
																	}else{
																		$collapse_active = "";
																	}
																?>
																<li class="<?php echo $collapse_active; ?>">
																	<a href="<?php echo base_url($store_url."/".$main_category_id."/".$sub_id); ?>"><?php echo $sub_category_name; ?> </a>
																</li>
																
																<?php } ?>
															
                                                        </ul>
                                                      </div>
                                                    </div>

													<?php }else{  ?>
                                                     <li><a href="<?php echo base_url($store_url."/".$main_category_id); ?>"><?php echo $main_category_name; ?></a></li>
                                                     
                                                     <?php }} ?>
                                                    </ul>
                                                    
													
												</div>

											</section><!--/ .section_offset -->

											<!-- - - - - - - - - - - - - - End of information - - - - - - - - - - - - - - - - -->

											<!-- - - - - - - - - - - - - - Filter - - - - - - - - - - - - - - - - -->

											<?php $this->load->view("shop/templates/shop_relate",$mystore); ?>

											<!-- - - - - - - - - - - - - - End of filter - - - - - - - - - - - - - - - - -->


										</aside>
									
										<main class="col-md-9 col-sm-8 padding-l-0">
                                        	<?php if(count($product_recommend)>0 && ($category_id == 0 || $category_id == "")){ ?>
											<section class="section_offset " >

												<h3 class="offset_title">สินค้าแนะนำ</h3>
												<div class="owl_carousel four_items home_flash_pd">
                                                
                                                	<?php
													foreach($product_recommend as $row){
															$product_id = $row->product_id;
															$store_id = $row->store_id;
															$product_name = $row->product_name;
															$product_brand = $row->product_brand;
															$product_version = $row->product_version;
															$product_rating = $row->product_rating;
															$product_category = $row->product_category;
															$product_subcategory = $row->product_subcategory;
															$product_description = $row->product_description;
															$product_price = $row->product_price;
															$product_price_discount = $row->product_price_discount;
															$product_recommend = $row->product_recommend;
															$product_show = $row->product_show;
															$product_type = $row->product_type;
															$product_mode = $row->product_mode;
															$product_status = $row->product_status;
															$product_qty = $row->product_qty;
															$timestamp = $row->timestamp;
															
															$product_name_url = $this->utils->urlClean($product_name);
															
															$number_relate = $this->model_productmanager->getNumberRelate($product_id);
															
															$relate_product = $this->model_productmanager->getRelateByID($product_id);
															if(count($relate_product) > 0){
																foreach($relate_product as $re){
																	$product_price = $re->product_price;
																	$product_price_discount = $re->product_price_discount;
																	$product_qty = $re->product_qty;
																}
															}
						
															$images = $this->model_productmanager->getProductImageList($product_id);
															$default_image = (count($images))?($images[0]->image_url):$this->productmanager->default_image();
															$store_url = "";
															$mystore = $this->model_shop->getShopByStoreID($store_id);
															if(count($mystore))$store_url = $mystore[0]->store_url;
															
															$product_category_name = "";
															$product_category = $this->model_shop->getCategoryProductByID($product_category);
															if(count($product_category))$product_category_name = $product_category[0]->category_name;
															
															$product_category_name = $this->utils->urlClean($product_category_name);
															
															$promo = $this->utils->promotion_in_time($product_id);
															if($promo->promo_price > 0)$product_price_discount = $promo->promo_price;
			
													?>
													<div class="shop_pd_list_wrap">
															<div class="product_item type_3">
																<div class="image_wrap">
                                                                	<?php if($promo->promo_type == 2){ ?>
                                                                    <div class="label_hot">สินค้าร่วมโปรโมชั่น</div>
                                                                    <?php } ?>
                                                                	<a href="<?php echo base_url($store_url."/products/".$product_category_name.'/'.$product_id."/".$product_name_url); ?>">
																	<img src="<?php echo base_url($default_image); ?>" alt="<?php echo $product_name; ?>">
                                                                    </a>
																	<!--<div class="actions_wrap">

																		<button onclick="addToCart(this,2);" product_id="<?php echo $product_id; ?>" product_name="<?php echo $product_name; ?>" product_image="<?php echo $default_image; ?>" store_id="<?php echo $store_id; ?>" product_price_discount="<?php echo $product_price_discount; ?>" product_qty="1" class="button_dark_grey def_icon_btn middle_btn add_to_wishlist tooltip_container alignleft"><span class="tooltip right">รายการโปรด</span></button>

																		<button onclick="addToCart(this,1);" product_id="<?php echo $product_id; ?>" product_name="<?php echo $product_name; ?>" product_image="<?php echo $default_image; ?>" store_id="<?php echo $store_id; ?>" product_price_discount="<?php echo $product_price_discount; ?>" product_qty="1" class="button_blue def_icon_btn middle_btn add_to_cart tooltip_container alignright"><span class="tooltip left">เพิ่มลงตะกร้าสินค้า</span></button>

																	</div>-->
																</div>
																<div class="description shop_pd_list_title">
																<a href="<?php echo base_url($store_url."/products/".$product_category_name.'/'.$product_id."/".$product_name_url); ?>"><?php echo $this->utils->string_shorten($product_name,35,50); ?></a>

																	<div class="clearfix product_info">
																		<p class="product_price alignleft">
                                                                        <?php if($product_price != $product_price_discount){ ?>
                                                                        <s>฿<?php echo number_format($product_price,2); ?></s> 
                                                                        <?php } ?>
                                                                        <b>฿<?php echo number_format($product_price_discount,2); ?></b>
                                                                        </p>
                                                                        
                                                                        
                                                                       


																		
                                                                        
                                                                        
																	</div>
                                                                    
                                                                    <div class="rating ">
																			<div class="star-ratings">
                                                                              <div class="fill-ratings" style="width: <?php echo $product_rating; ?>%;">
                                                                                <span>★★★★★</span>
                                                                              </div>
                                                                              <div class="empty-ratings">
                                                                                <span>★★★★★</span>
                                                                              </div>
                                                                            </div>
																		</div>
                                                                        
																</div>
																<div class="clearfix"></div>
															</div>
														</div>
														
                                                        <?php } ?>
													
													<!-- - - - - - - - - - - - - - End product - - - - - - - - - - - - - - - - -->

													

												</div><!--/ .owl_carousel.five_items-->

												<!-- - - - - - - - - - - - - - End of featured products - - - - - - - - - - - - - - - - -->

											</section>
                                            
                                            <?php } ?>



											
											<!-- - - - - - - - - - - - - - End of featured products - - - - - - - - - - - - - - - - -->

											<!-- - - - - - - - - - - - - - Products - - - - - - - - - - - - - - - - -->

											<div class="section_offset container-fluid ">

												<header class=" on_the_sides mobile_only_hide">

													<div class="left_side clearfix v_centered">

														<!-- - - - - - - - - - - - - - Sort by - - - - - - - - - - - - - - - - -->

														<div class="v_centered">

															<span>จัดเรียงตาม :</span>

															<div class="custom_select sort_select">
																
																<select name="view_type" id="view_type" onchange="onFilteringOption();">
                                                                    <option value="news" selected="selected">มาใหม่</option>
                                                                    <option value="popular">ยอดนิยม</option>
                                                                    <option value="rating">รีวิวเรตติ้ง</option>
                                                                    <option value="price">ราคา</option>
                                                                </select>

															</div>

														</div>

														<!-- - - - - - - - - - - - - - End of sort by - - - - - - - - - - - - - - - - -->

													</div>

													<div class="right_side ">

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
												
                                                
                                                
                                                
                                                
												

											</div>
												<div id="view_container">
												
                                                </div>
											<!-- - - - - - - - - - - - - - End of products - - - - - - - - - - - - - - - - -->

										</main><!--/ [col]-->

									</div><!--/ .row-->

								</div><!--/ #tab-1-->
                                

							</div><!--/ .tab_containers_wrap -->

							<!-- - - - - - - - - - - - - - End of tabs containers - - - - - - - - - - - - - - - - -->

						</div><!--/ .tabs-->

					</div><!--/ .section_offset -->

					<!-- - - - - - - - - - - - - - End of tabs - - - - - - - - - - - - - - - - -->

				</div><!--/ .container-->

			</div><!--/ .page_wrapper-->
            
<?php $this->load->view("templates/footer"); ?>
<?php $this->load->assets_by_name('Product'); ?>
<script type="text/javascript" src="<?php echo base_url("assets/js/addthis.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/AddToCart.js"); ?>"></script>
<script>
$(function(){
	var isActive = false;
    var current = decodeURIComponent(location.pathname);
    $('.theme_menu dt a').each(function(){
        var $this = $(this);
		console.log($this.attr('href')+" : "+current);
        if(!isActive && $this.attr('href').indexOf(current) !== -1){
			//$this.addClass('active');
            $this.parent().addClass('active');
			$this.parent().next().css("display","block");
			isActive = true;
        }else{
			$this.parent().removeClass('active');
		}
    })
	$('.theme_menu dd a').each(function(){
        var $this = $(this);
		console.log($this.attr('href')+" : "+current);
        if(!isActive && $this.attr('href').indexOf(current) !== -1){
            //$this.addClass('active');
			$this.parent().parent().parent().prev().addClass('active');
			$this.parent().parent().parent().css("display","block");
			isActive = true;
        }else{
			//$this.parent().removeClass('active');
		}
    })
})



</script>