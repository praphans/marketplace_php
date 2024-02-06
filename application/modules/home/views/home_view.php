<?php $this->load->view("templates/header"); ?>


<!-- - - - - - - - - - - - - - Layer slider - - - - - - - - - - - - - - - - -->
	
<div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:1300px;height:500px;overflow:hidden;visibility:hidden;">
        <!-- Loading Screen -->
        <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
            <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="img/spin.svg" />
        </div>
        <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:1300px;height:500px;overflow:hidden;">
        	<?php
				$index = 0;
				foreach($banners as $row){
					$banner_name = $row->banner_name;
					$banner_url = $row->banner_url;
					$banner_hyperlink = $row->banner_hyperlink;
			?>
            <div>
                <img id="image_<?php echo $index; ?>" data-link = "<?php echo $banner_hyperlink; ?>" data-u="image" src="<?php echo base_url($banner_url); ?>" alt="<?php echo $banner_name; ?>" />
            </div>
            <?php $index++; } ?>
            
        </div>
    <!-- Bullet Navigator -->
    <div data-u="navigator" class="jssorb051" style="position:absolute;bottom:12px;right:12px;" data-autocenter="1"
    data-scale="0.5" data-scale-bottom="0.75">
       <div data-u="prototype" class="i" style="width:16px;height:16px;">
           <svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
               <circle class="b" cx="8000" cy="8000" r="5800"></circle>
           </svg>
       </div>
   </div>
        
    </div>



<!--/ #layerslider-->

<!-- - - - - - - - - - - - - - End of layer slider - - - - - - - - - - - - - - - - -->

<!-- - - - - - - - - - - - - - Page Wrapper - - - - - - - - - - - - - - - - -->

<div class="page_wrapper">

    <div class="container">

        <?php
		$n = 0;
		foreach($featured as $feature){
			$featured_id = $feature->id;
			$featured_name = $feature->featured_name;
			$featured_type = $feature->featured_type;
			$starttime = $feature->starttime;
			$endtime = $feature->endtime;
			$product_featured = $this->model_home->getProductByFeatured($featured_id);
			
			if($featured_type == 1){
				$endtime = explode("-",$endtime);
				$day = $endtime[2];
				$month = $endtime[1];
				$year = $endtime[0];
				
				$years = explode(" ",$day);
				
				$day = $years[0];
				$times = $years[1];
				
				$times = explode(":",$times);
				$hours = $times[0];
				$minute = $times[1];
				
			}
			
			
			
		?>
		<?php if(count($product_featured) > 0){ ?>
        <section class="section_offset" data-animation="">
            <h3 class="section_title offset_title"><a href="<?php echo base_url("product")."?featured=".$featured_id; ?>"><?php echo $featured_name; ?></a></h3>
            <?php if($featured_type == 1){ ?>
            
            <div class="flashsale_count countdown countdown<?php echo $n; ?>" data-year="<?php echo $year; ?>" data-month="<?php echo $month; ?>" data-day="<?php echo $day; ?>" data-hours="<?php echo $hours; ?>" data-minutes="<?php echo $minute; ?>"
					 data-seconds="0" ></div>
           
            <?php $n++; } ?>
            
            <div class="allflashsale_btn">
                <a href="<?php echo base_url("product")."?featured=".$featured_id; ?>" class="button_grey small_btn mobile_only_hide">ดูทั้งหมด</a>
            </div>
            <div class="owl_carousel six_items ">
                
                
                <?php
				
				shuffle($product_featured);
				foreach($product_featured as $row){
						$product_id = $row->product_id;
						$relate_id = $row->relate_id;
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
						$product_qty = $row->product_qty;
						$product_status = $row->product_status;
						$product_percentage_discount = $row->product_percentage_discount;
						$timestamp = $row->timestamp;
						
						$product_name_url = $this->utils->urlClean($product_name);
						
						//$number_relate = $this->model_productmanager->getNumberRelate($product_id);
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
                                                    
               
                <div class="product_item type_3" style="display:none;">
                    
                    <div class="image_wrap">
                    	<?php if($promo->promo_type == 2){ ?>
                        <div class="label_hot">สินค้าร่วมโปรโมชั่น</div>
                        <?php } ?>
                        
                        <?php if($product_percentage_discount > 0){ ?>
                        <!--<div class="label_new"><?php echo $product_percentage_discount; ?>%</div>-->
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
                    <a href="<?php echo base_url($store_url."/products/".$product_category_name.'/'.$product_id."/".$product_name_url); ?>"><?php echo $product_name; ?></a>

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
                    <!--<button onclick="addToCart(this,2);" product_id="<?php echo $product_id; ?>" product_name="<?php echo $product_name; ?>" product_image="<?php echo $default_image; ?>" store_id="<?php echo $store_id; ?>" product_price_discount="<?php echo $product_price_discount; ?>" product_qty="1" class="button_dark_grey def_icon_btn middle_btn add_to_wishlist tooltip_container alignleft"><span class="tooltip right">รายการโปรด</span></button>
                            
                           
                            <button onclick="addToCart(this,1);" product_id="<?php echo $product_id; ?>" product_name="<?php echo $product_name; ?>" product_image="<?php echo $default_image; ?>" store_id="<?php echo $store_id; ?>" product_price_discount="<?php echo $product_price_discount; ?>" product_qty="1" class="button_blue def_icon_btn middle_btn add_to_cart tooltip_container alignright"><span class="tooltip left">เพิ่มลงตะกร้าสินค้า</span></button>-->
                    
                    <div class="clearfix"></div>
                    
                     
                </div>
                                             
                <?php } ?>
                

            </div>
            <!--/ .owl_carousel-->

            <!-- - - - - - - - - - - - - - End of carousel of today's deals - - - - - - - - - - - - - - - - -->

        </section>
        
        <?php }} ?>
        
        
        <!--/ .section_offset.animated.transparent-->

        <!-- - - - - - - - - - - - - - End of today's deals - - - - - - - - - - - - - - - - -->

        

        <!-- - - - - - - - - - - - - - Latest news - - - - - - - - - - - - - - - - -->

        <section class="section_offset">

            <h3 class="offset_title"><a href="<?php echo base_url("news"); ?>">บทความ</a></h3>

            <div class="allblog_btn">
                <a href="<?php echo base_url("news"); ?>" class="button_grey small_btn">ดูทั้งหมด</a>
            </div>

            <div class="table_layout">

                <div class="table_row">

					<?php 
					foreach($news as $row){
						$new_id = $row->new_id;
						$new_cate_id = $row->new_cate_id;
						$new_header = $row->new_header;
						$new_content = $row->new_content;
						$new_image = $row->new_image;
						$timestamp = $row->timestamp;
						
						$new_header_url = $this->utils->urlClean($new_header);
						
						$new_content = strip_tags($new_content);
						$new_content = $this->utils->string_shorten($new_content,100,100);
						
					?>
                    <!-- - - - - - - - - - - - - - Entry - - - - - - - - - - - - - - - - -->

                    <div class="table_cell">

                        <article class="entry">

                            <a href="<?php echo base_url("news/info/".$new_id."/".$new_header_url); ?>" class="thumbnail entry_image">

                                <img src="<?php echo base_url($new_image); ?>" alt="<?php echo $new_header; ?>">

                            </a>

                            <h5 class="entry_title"><a href="<?php echo base_url("news/info/".$new_id."/".$new_header_url); ?>"><b><?php echo $new_header; ?></b></a></h5>

                            <div class="entry_meta">

                                <span><i class="icon-calendar"></i> <?php echo $this->utils->getThaiDate($timestamp); ?></span>

                            </div>
                            <!--/ .entry_meta-->

                            <!--<p><?php echo $new_content; ?></p>-->

                        </article>
                        <!--/ .entry-->

                    </div>

                    <!-- - - - - - - - - - - - - - End of entry - - - - - - - - - - - - - - - - -->



                    <?php } ?>

                   

                </div>

            </div>

        </section>
        <!--/ .section_offset.animated.transparent-->

        <!-- - - - - - - - - - - - - - End of latest news - - - - - - - - - - - - - - - - -->

    </div>
    <!--/ .container-->

</div>
<!--/ .page_wrapper-->
        
			
			<!-- - - - - - - - - - - - - - End Page Wrapper - - - - - - - - - - - - - - - - -->
<?php $this->load->view("templates/footer"); ?>
<?php $this->load->assets_by_name('Home'); ?>

<script>


/*var year = "<?php echo $year; ?>";
var month = "<?php echo $month; ?>";
var date = "<?php echo $day; ?>";
var hour = "<?php echo $hours; ?>";
var minute = "<?php echo $minute; ?>";
var second = 0
$('.countdown').countdown({
	until: new Date(year, month, date, hour, minute, second),
	labels: ['ปี', 'เดือน', 'สัปดาห์', 'วัน', 'ชั่วโมง', 'นาที', 'วินาที']});
*/

var n = 0;
$(".countdown").each(function(){
	var year = $(this).attr("data-year");
	var month = parseInt($(this).attr("data-month"))-1;
	var day = $(this).attr("data-day");
	
	var hour = $(this).attr("data-hours");
	var minute = $(this).attr("data-minutes");
	var second = 0	
	console.log(year+" | "+month+" | "+day+" | "+hour);
	$('.countdown'+n).countdown({
		until: new Date(year, month, day, hour, minute, second),
		labels: ['ปี', 'เดือน', 'สัปดาห์', 'วัน', 'ชั่วโมง', 'นาที', 'วินาที'],
		alwaysExpire: true,
		onExpiry: function(){
			$(this).parent().hide();
		}
	});
	n++;

});


	
</script>