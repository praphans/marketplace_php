<?php $this->load->view("templates/header"); ?>


<div class="secondary_page_wrapper">

    <div class="container">

        <!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

        <ul class="breadcrumbs">

            <li><a href="<?php echo base_url(); ?>" class="notcursor">หน้าหลัก</a></li>
            <li><a href="<?php echo base_url("user"); ?>" class="notcursor">บัญชีผู้ซื้อ</a></li>
            <li>รีวิวของฉัน</li>

        </ul>

        <!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->

        <div class="row">

            <aside class="col-md-3 col-sm-4">

                <!-- - - - - - - - - - - - - - Information - - - - - - - - - - - - - - - - -->

                <?php $this->load->view("user/templates/left_tab"); ?>

                <!-- - - - - - - - - - - - - - End of information - - - - - - - - - - - - - - - - -->

            </aside><!--/ [col]-->

            <main class="col-md-9 col-sm-8 padding-l-0">

                <div class="section_offset">

                    <div class="row">

                        <section class="col-sm-12">
                                
                            <h3>รีวิวของฉัน</h3>

                            <!-- - - - - - - - - - - - - - Tabs v2 - - - - - - - - - - - - - - - - -->

                            <div class="tabs type_2">
                                <div class="mobile_only_show">
                                    <button class="button_grey_outline btn-block text-left" type="button" data-toggle="collapse" 
                                    data-target="#review_his_tab" aria-expanded="false" aria-controls="review_his_tab">
                                            รีวิวของฉัน<span class="caret"></span>
                                    </button>
                                </div>
                                <aside class="col-md-3 col-sm-4 collapse pl-0 pr-0" id="review_his_tab">
                                    <section class="section_offset">
                                        <ul class="theme_menu tabs_nav clearfix pb-5">
                                            <li><a href="<?php echo base_url("user/review/list"); ?>">รอการรีวิว</a></li>
                                            <li><a href="<?php echo base_url("user/review/history"); ?>">ประวัติการรีวิว</a></li> 
                                        </ul>
                                    </section>
                                </aside>
                                <ul class="tabs_nav clearfix mobile_only_hide">
									
                                    <?php 
										$list_active = "";
										$history_active = "";
										if($filter == "list"){
											$list_active = "active";
										}else{
											$history_active = "active";
										}
									?>
                                    <li class="<?php echo $list_active; ?>"><a href="<?php echo base_url("user/review/list"); ?>">รอการรีวิว</a></li>
                                    <li class="<?php echo $history_active; ?>"><a href="<?php echo base_url("user/review/history"); ?>">ประวัติการรีวิว</a></li> 

                                </ul>
                                
                                <div class="tab_containers_wrap">

                                    

                                    <div id="history_Review" class="tab_container_not_use">
										<form id="review_history_type" class="type_2" action="<?php echo site_url("user/review/history"); ?>" method="post">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12 pt-10">
                                                <div class="custom_select">
                                                    <select class="form-control" name="review_type" id="review_type" onchange="onChangeReviewType()">
                                                        <option value="0">ทั้งหมด</option>
                                                        <option value="1">รีวิวร้านค้า</option>
                                                        <option value="2">รีวิวผู้ส่ง</option>
                                                        <option value="3">รีวิวสินค้า</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        </form>
                                        <section class="section_offset pt-20">

                                            <ul class="reviews">

												<?php 
												//$current_review_type = 1;
												foreach($orders as $row){
													$review_id = $row->review_id;
													$order_id = $row->order_id;
													$order_member_id = $row->order_member_id;
													$store_id = $row->store_id;
													$product_id = $row->product_id;
													$review_rating = $row->review_rating;
													$review_content = $row->review_content;
													$review_images = $row->review_images;
													$review_type = $row->review_type;
													$timestamp = $row->timestamp;
													//$order_shipping_type_id = $row->order_shipping_type_id;
													
													
													$store_name = "-";
													$store_avatar = $this->storemanager->default_avatar_image();
													$store = $this->model_review->getStoreByID($store_id);
													foreach($store as $s){
														$store_name = $s->store_name;	
														$store_avatar = $s->store_avatar;
														$store_url = $s->store_url;
													}

                                                    $product_result = $this->model_review->getProductByID($product_id);
                                                    $product_name = "";
                                                    foreach($product_result as $row){
                                                        $product_name = $row->product_name;   
                                                   
                                                    }
                                                    
                                                    $product_images_result = $this->model_review->getProductImage($product_id);
                                                    if(count($product_images_result)>0){
                                                        $product_image = $product_images_result[0]->image_url;
                                                    }

													$s_name ="";
                                                    $url_store = base_url($store_url);
                                                    $url_product = $this->utils->getProductLink($product_id);
                                                    if($review_type == 1){ //รีวิวผู้ขาย
                                                        $owner = "ผู้ขาย";
                                                        $s_name = $store_name;
                                                        $s_image = $store_avatar;
                                                        $link = $url_store;
                                                    }else if($review_type == 2){ //รีวิวผู้ส่ง
                                                        $owner = "ผู้ส่ง";
                                                        $s_name = $store_name;
                                                        $s_image = $store_avatar;
                                                        $link = $url_store;
                                                    }else if($review_type == 3){ //รีวิวสินค้า
                                                        $owner = "สินค้า";
                                                        $s_name = $product_name;
                                                        $s_image = $product_image;
                                                        $link = $url_product;
                                                    }

                                                    
													
													
												?>
                                                <li class="row">

                                                    <!-- - - - - - - - - - - - - - Review - - - - - - - - - - - - - - - - -->
                                                    
                                                    <article class="review">

                                                        <!-- - - - - - - - - - - - - - Rates - - - - - - - - - - - - - - - - -->
                                                        <div class="col-xs-12 col-sm-2 col-md-1 imgreview">
                                                        <ul>

                                                            <li class="v_centered">

                                                                    <a href="<?php echo $link; ?>"><img src="<?php echo base_url($s_image); ?>" alt="<?php echo $s_name; ?>" class="account-md-photo"></a>

                                                            </li>

                                                        </ul>
                                                        </div>
                                                        <!-- - - - - - - - - - - - - - End of rates - - - - - - - - - - - - - - - - -->

                                                        <!-- - - - - - - - - - - - - - Review body - - - - - - - - - - - - - - - - -->
                                                        <div class="col-xs-12 col-sm-2 col-md-8 text-xs-center-account">
                                                        <div class="review-body">

                                                            <div class="review-meta">

                                                                <?php echo $owner; ?> : <b><?php echo $s_name; ?></b>

                                                            </div>

                                                            <div class=" v_centered">
                                                            
                                                                <ul class="rating">
																	
                                                                    <?php
																	for($i = 0;$i<5;$i++){
																		if($i<$review_rating){
																			echo '<li class="active"></li>';	
																		}else{
																			echo '<li></li>';
																		}
																	?>
																	<?php } ?>

                                                                </ul>

                                                                <ul class="topbar">

                                                                    <li></li>
                                                                    <li class="padding-l-10"><?php echo $this->utils->getThaiDate($timestamp); ?></li>

                                                                </ul>

                                                            </div>

                                                            <p class="pt-10"> <?php echo $review_content; ?> </p>

                                                        </div>
                                                        
                                                        <!-- - - - - - - - - - - - - - End of review body - - - - - - - - - - - - - - - - -->
                                                        </div>
                                                        <!--<div class="col-xs-12 col-sm-4 col-md-3 text-xs-center-account addreview">
                                                            <button disabled data-modal-url="modals/shopping_add_review.html" class="w-100 button_blue "><i class="icon-paper-plane" ></i> รีวิวเพิ่มเติม</button>
                                                        </div>-->
                                                    </article>

                                                    <!-- - - - - - - - - - - - - - End of review - - - - - - - - - - - - - - - - -->

                                                </li>

                                                <?php } ?>

                                            </ul>

                                            <div class="review_pagenum on_the_sides">
                                                
                                                    <div class="left_side">
                                                        <p><?php //echo $page_showing; ?></p>
                                                    </div>
                                                
                                                    <div class="right_side">
                                                        <?php echo $pagination ?>  
                                                    </div>
                            
                                               
                                            </div>

                                        </section><!--/ .section_offset -->

                                    </div><!--/ #wait_Review-->

                                </div><!--/ .tab_containers_wrap -->

                            </div><!--/ .tabs-->
                            
                            <!-- - - - - - - - - - - - - - End of tabs v2 - - - - - - - - - - - - - - - - -->

                        </section><!--/ [col]-->
                    </div><!--/ .row -->
                    
                </div><!--/ .section_offset -->
                
            </main><!--/ [col]-->

        </div><!--/ .row-->

    </div><!--/ .container-->

</div><!--/ .page_wrapper-->
            
            
<?php $this->load->view("templates/footer"); ?>
<?php $this->load->assets_by_name("User"); ?>
<?php $this->load->assets_by_name('Left_tab'); ?>
<script>
var review_type = "<?php if(isset($current_review_type))echo $current_review_type; ?>";
function onChangeReviewType(){
	$("#review_history_type").submit();
}
$(document).ready(function(){
	$("#review_type").val(review_type);					   
});
</script>