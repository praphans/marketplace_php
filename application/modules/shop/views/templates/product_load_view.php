<div class="container-fluid">
<div class="row mobile_only_hide">
	
                                                   

        <?php 
        
        foreach($product as $row){
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
        
        
        <div class="margin-t-10"></div>

        <div class="col-md-3 col-xs-6 shop_pd_list_wrap">
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
        <!-- - - - - - - - - - - - - - End of product - - - - - - - - - - - - - - - - -->
        
        
    
        
</div>      
        


   



<footer class=" on_the_sides mobile_only_hide">

    <div class="left_side">

        <p><?php //echo $page_showing; ?></p>

    </div>

    <div class="right_side">
        <?php echo $pagination ?>  
        
    </div>

</footer>
</div>


<div class="mobile_only_show">



	<?php $n = 0;
		$categorys = $this->model_shop->getCategoryProductHasProductInStore($store_id);
		
		foreach($categorys as $row){
			$main_category_id = $row->id;
			$main_category_name = $row->category_name;
			$number_in_this_category = $this->model_shop->getProductNumberInStoreCategory($main_category_id,$store_id);
			$subcategorys = $this->model_shop->getSubCategoryProductByCategoryID($main_category_id);
			
			$product_featured = $this->model_shop->getProductInStoreCategory($main_category_id,$store_id);
	?>
    <h3 class="offset_title"><?php echo $main_category_name; ?></h3>
    <div class="owl_carousel four_items home_flash_pd"  style="margin-bottom:20px;">
    
        <?php
        foreach($product_featured as $row){
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

<?php } ?>

</div>

<script>
$('.carousel_in_tabs.type_2, .owl_carousel.four_items').owlCarousel({
	responsive : {
		0 : {
			items : 2
		},
		490 : {
			items : 2
		},
		684 : {
			items : 3
		},
		992 : {
			items : 4
		}
	},
	nav : true,
	navText : [],
	rtl: window.ISRTL ? true : false
});
</script>