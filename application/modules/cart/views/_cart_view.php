<?php $this->load->view("templates/header"); ?>

<form action="<?php echo base_url("cart/createlocation"); ?>" method="post" id="cart_frm">
<div class="secondary_page_wrapper">

    <div class="container">

        <!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

        <ul class="breadcrumbs">

            <li><a href="<?php echo base_url(); ?>">หน้าหลัก</a></li>
            <li>สั่งซื้อสินค้า</li>

        </ul>

        <h2 class="pt-10" >สั่งซื้อสินค้า</h2>
		<?php
		
		$store_num = 0;
		$product_price_payment_total = 0;
		$product_price_balance_total = 0;
		foreach($store_product_list as $row){
			$store_product_price_discount_total = 0;
			
			$store_id = $row->store_id;
			$stores = $this->model_storemanager->getStoreByID($store_id);
			$store_name = "";
			foreach($stores as $s){
				$store_avatar = $s->store_avatar;
				$store_name = $s->store_name;	
				$store_url = $s->store_url;	
			}
			$product_in_cart = $this->model_cart->getStoreProductCartByID($store_id);
		?>
        <!-- - - - - - - - - - - - - - Shopping cart table - - - - - - - - - - - - - - - - -->

        <section class="section_offset">
            
            <div class="table_wrap">
                <table class="table_type_1 shopping_cart_table">
                    <thead>
                        <tr>
                            <th width="60px;" class="text-md-center-left">#</th>
                            <th class="product_image_col text-md-center-left">รูปสินค้า</th>
                            <th class="product_title_col text-md-center-left">ชื่อสินค้า</th>
                            <th class="text-md-center-left">ราคา</th>
                            <th class="product_qty_col text-md-center-left">จำนวน</th>
                            <th class="text-md-center-left">ราคารวม</th>
                            <th width="70px;" class="text-md-center-left">ลบ</th>
                        </tr>

                    </thead>

                    <tbody>
                    
                    	<?php 
							
							$product_price_payment_total = 0;
							$product_price_balance_total = 0;
							
							foreach($product_in_cart as $row2){
								$product_qty_total = 0;
								$product_price_discount_total = 0;
			
								$cart_id = $row2->cart_id;
								$store_id = $row2->store_id;
								$product_id = $row2->product_id;
								$product_name = $row2->product_name;
								$product_image = $row2->product_image;
								$product_qty = $row2->product_qty;
								$product_price_discount = $row2->product_price_discount;
								
								$product_cal = $this->model_cart->getProductCart($product_id);
								$product_details = $this->model_productmanager->getProductByID($product_id);
								foreach($product_cal as $cal){
									$product_qty_total += $cal->product_qty;
									$product_price_discount_total += ($cal->product_price_discount*$cal->product_qty);
									//echo $product_price_discount_total;
									$payment_setting = $this->model_setting->getGatewayTypeByID($product_id);
									$option1 = 0;
									$option2 = 0;
									$gateway_type_id = 0;
									foreach($payment_setting as $setting){
										$gateway_type_id = $setting->gateway_type_id;
										$option1 = $setting->option1;
										$option2 = $setting->option2;
										
									}
									
									if($gateway_type_id == 3){ // ชำระเต็มจำนวน
										$product_price_payment_total += $cal->product_price_discount;
									}
									if($gateway_type_id == 1){ // ไม่ต้องชำระตอนนี้
										$product_price_balance_total += $cal->product_price_discount;
									}
									
									
								
								}
								$product_price_payment_total += $option1;
								$product_price_balance_total += $option2;
								
								foreach($product_details as $d){
									$product_version = $d->product_version;
									$product_qty_remaining = $d->product_qty;
								}
								
								
								$store_product_price_discount_total += $product_price_discount_total;
								
								$product_is_relate = 0;
								$is_relate_or_not = $this->model_location->checkProductRelateByID($product_id);
								foreach($is_relate_or_not as $re){
									$product_is_relate = $re->product_is_relate;
									$relate_id = $re->relate_id;
								}
								$link = $this->utils->getProductLink($product_id);
								if($relate_id > 0){
									$link = $this->utils->getProductLink($relate_id);
								}
								$store_checked = "";
								if($store_num == 0){
									$store_checked = "checked";
								}
								
								
								
						?>
                        
                       
                        <tr>
                            <td class="tb_mobile_none" data-title="#" valign="middle">
                                <div class="text-xs-center-left cart2<?php echo $store_id; ?>">
                                    <input type="checkbox" name="product_checked[]" class="product_checked" value="<?php echo $product_id; ?>" id="product_<?php echo $product_id; ?>" onchange="calculateTotalPrice();" checked>
                                    <label for="product_<?php echo $product_id; ?>"></label>
                                </div>
                            </td>
                            <td class="product_image_col" data-title="รูปสินค้า">

                                <a class="tb_mobile_none" href="<?php echo $link; ?>"><img src="<?php echo base_url($product_image); ?>" alt="<?php echo $product_name; ?>"></a>
                                
                                
                               <!-- แสดงใน mobile-->
                                <div class="row mobile_only_show" id="cart_mobile">
                                    <div class="col-xs-2 mobile_cart_img">
                                         <a href="<?php echo $link; ?>"><img src="<?php echo base_url($product_image); ?>" alt="<?php echo $product_name; ?>"></a>
                                    </div>
                                    <div class="col-xs-10">
                                        <a href="<?php echo $link; ?>" class="product_title"><?php echo $product_name; ?></a>
                                        <ul class="sc_product_info">
                                        <!-- <li>Size: Big</li> -->
                                            <li><?php echo $product_version; ?></li>
                                        </ul>

                                        <div class="mobile_cart_price"> ฿<?php echo number_format($product_price_discount,2); ?>
                                        </div>

                                        <div class="cart<?php echo $store_id; ?>">
                                            
                                            <input type="hidden" name="product_price_payment[]" class="product_price_payment" value="<?php echo $option1; ?>">
                                             <input type="hidden" name="product_price_balance[]" class="product_price_balance" value="<?php echo $option2; ?>">
                                             <input type="hidden" name="gateway_type_id[]" class="gateway_type_id" value="<?php echo $gateway_type_id; ?>">
                                             <input type="hidden" name="product_price_discount[]" class="product_price_discount" value="<?php echo $product_price_discount; ?>">
                                             <input type="hidden" name="product_id[]" class="product_id" value="<?php echo $product_id; ?>">
                                             <input type="hidden" name="cart_id[]" class="cart_id" value="<?php echo $cart_id; ?>">
                                             <input type="hidden" name="product_name[]" class="product_name" value="<?php echo $product_name; ?>">
                                             <input type="hidden" name="product_qty_remaining[]" class="product_qty_remaining" value="<?php echo $product_qty_remaining; ?>">
                                            <div class="qty min clearfix cart<?php echo $store_id; ?>" >
                                                <button type="button" class="theme_button product_qty_btn" onclick="minusCart(this);" data-direction="minus" product_price_discount="<?php echo $product_price_discount; ?>" value="<?php echo $product_qty_total; ?>" product_id="<?php echo $product_id; ?>" product_name="<?php echo $product_name; ?>" product_image="<?php echo $product_image; ?>" store_id="<?php echo $store_id; ?>" product_price_discount="<?php echo $product_price_discount; ?>" product_qty="1" key_add_to_cart="1">&#45;</button> 
                                                <input type="number" min="1" name="product_qty[]" class="product_qty" product_price_discount="<?php echo $product_price_discount; ?>" value="<?php echo $product_qty_total; ?>" product_id="<?php echo $product_id; ?>" product_name="<?php echo $product_name; ?>" product_image="<?php echo $product_image; ?>" store_id="<?php echo $store_id; ?>" product_price_discount="<?php echo $product_price_discount; ?>" product_qty="1" key_add_to_cart="1">
                                                
                                                <button type="button"  class="theme_button product_qty_btn" data-direction="plus" onclick="addToCart(this,1);" product_id="<?php echo $product_id; ?>" product_name="<?php echo $product_name; ?>" product_image="<?php echo $product_image; ?>" store_id="<?php echo $store_id; ?>" product_price_discount="<?php echo $product_price_discount; ?>" product_qty="1">&#43;</button>
                                                
                                            </div>

                                        </div>

                                        <div class="total product_price_discount_total mobile_cart_price">
                                            ฿<?php echo number_format($product_price_discount_total,2); ?>
                                        </div>

                                        <div class="">
                                            <button type="button" onclick="_removeFromCart(<?php echo $product_id; ?>,this);" class="button_dark_grey icon_btn edit_product "><i class="icon-trash"></i></button>
                                        </div>
                               
                                    </div>
                                </div>
								<!-- จบแสดงใน mobile-->
                                
                                
                            </td>
                            <td class="tb_mobile_none" data-title="ชื่อสินค้า" valign="middle">
                                <a href="<?php echo $link; ?>" class="product_title"><?php echo $product_name; ?></a>
                                <ul class="sc_product_info">
                                    <!-- <li>Size: Big</li> -->
                                    <li><?php echo $product_version; ?></li>
                                </ul>
                            </td>
                            <td class="tb_mobile_none text-md-center-left" data-title="ราคา" valign="middle">
                                ฿<?php echo number_format($product_price_discount,2); ?>
                            </td>
                            <td data-title="จำนวน" valign="middle" id="cart_desktop" class="tb_mobile_none cart<?php echo $store_id; ?>">
                            	 <input type="hidden" name="product_price_payment[]" class="product_price_payment" value="<?php echo $option1; ?>">
                                 <input type="hidden" name="product_price_balance[]" class="product_price_balance" value="<?php echo $option2; ?>">
                            	 <input type="hidden" name="gateway_type_id[]" class="gateway_type_id" value="<?php echo $gateway_type_id; ?>">
                            	 <input type="hidden" name="product_price_discount[]" class="product_price_discount" value="<?php echo $product_price_discount; ?>">
                                 <input type="hidden" name="product_id[]" class="product_id" value="<?php echo $product_id; ?>">
                                 <input type="hidden" name="cart_id[]" class="cart_id" value="<?php echo $cart_id; ?>">
                                 <input type="hidden" name="product_name[]" class="product_name" value="<?php echo $product_name; ?>">
                                 
                                 <input type="hidden" name="product_qty_remaining[]" class="product_qty_remaining" value="<?php echo $product_qty_remaining; ?>">
                                <div class="qty min clearfix cart<?php echo $store_id; ?>" >
                                    <button type="button" class="theme_button product_qty_btn" onclick="minusCart(this);" data-direction="minus" product_price_discount="<?php echo $product_price_discount; ?>" value="<?php echo $product_qty_total; ?>" product_id="<?php echo $product_id; ?>" product_name="<?php echo $product_name; ?>" product_image="<?php echo $product_image; ?>" store_id="<?php echo $store_id; ?>" product_price_discount="<?php echo $product_price_discount; ?>" product_qty="1" key_add_to_cart="1">&#45;</button>
                                    <input type="text" name="product_qty[]" class="product_qty" product_price_discount="<?php echo $product_price_discount; ?>" value="<?php echo $product_qty_total; ?>" product_id="<?php echo $product_id; ?>" product_name="<?php echo $product_name; ?>" product_image="<?php echo $product_image; ?>" store_id="<?php echo $store_id; ?>" product_price_discount="<?php echo $product_price_discount; ?>" product_qty="1" key_add_to_cart="1">
                                    
                                    <button type="button"  class="theme_button product_qty_btn" data-direction="plus" onclick="addToCart(this,1);" product_id="<?php echo $product_id; ?>" product_name="<?php echo $product_name; ?>" product_image="<?php echo $product_image; ?>" store_id="<?php echo $store_id; ?>" product_price_discount="<?php echo $product_price_discount; ?>" product_qty="1">&#43;</button>
                                    
                                    
                                </div>
                               
                                   
                            </td>
                            <td class="tb_mobile_none total text-md-center-left product_price_discount_total" data-title="ราคารวม" valign="middle">
                                ฿<?php echo number_format($product_price_discount_total,2); ?>
                            </td>
                            <td class="tb_mobile_none" data-title="ลบสินค้า" valign="middle">
                                <div class="text-xs-center">
                                    <button type="button" onclick="_removeFromCart(<?php echo $product_id; ?>,this);" class="button_dark_grey icon_btn edit_product "><i class="icon-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        
                        <?php 
						
						} 
						?>
                        
                        
                        
                    </tbody>
                </table>
            </div><!--/ .table_wrap -->
            <footer class="bottom_box">
                <div class="row">
                    <div class="col-md-10 col-sm-9 col-xs-12 form_group">
                        <input type="radio" class="store_id" name="store_id" id="radio_button_<?php echo $store_id; ?>" value="<?php echo $store_id; ?>" <?php echo $store_checked; ?>>
                        <label for="radio_button_<?php echo $store_id; ?>">
                            <img src="<?php echo base_url($store_avatar); ?>" alt="<?php echo $store_name; ?>" class="cart-photo inline_address_input mobile_none"> 
                            <?php echo $store_name; ?>
                        </label>
                    </div>
                    <div class="col-md-2 col-sm-3 col-xs-12 tb_mobile_none">
                        <a class="button_blue middle_btn w-100 icon-home" href="<?php echo base_url($store_url); ?>"> ดูร้านค้า</a>
                    </div>
                </div>
            </footer><!--/ .bottom_box -->
        </section><!--/ .section_offset -->
        <!-- - - - - - - - - - - - - - End of shopping cart table - - - - - - - - - - - - - - - - -->
		
        <?php $store_num++; } ?>





        <div class="section_offset">

            <div class="row">

                <section class="col-sm-6 col-md-8">
                    <!-- contant -->
                </section><!--/ [col] -->
				 <?php if(count($store_product_list)>0){ ?>
                <section class="col-sm-6 col-md-4">
                    <!-- <h3>รวมราคา</h3> -->
                    <div class="table_wrap">
                        <table class="zebra">
                            <tfoot>
                                <tr class="">
                                    <td>ราคาสินค้าทั้งหมด</td>
                                    <td class="text-right total_price_in_cart"></td>
                                </tr>
                                <tr class="total">
                                    <td>ยอดชำระตอนนี้</td>
                                    <td class="text-right total_price_in_payment"></td>
                                </tr>
                                <tr class="">
                                    <td>ยอดชำระคงเหลือ</td>
                                    <td class="text-right total_price_in_balance"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    
                    <footer class="bottom_box">
                    	 
                    	<input type="hidden" name="product_price_payment" class="product_price_payment_total" value="<?php echo $product_price_payment_total; ?>">
                        <input type="hidden" name="product_price_balance" class="product_price_balance_total" value="<?php echo $product_price_balance_total; ?>"> 
                       
                       
                        <button type="button" onClick="checktermsubmit();" class="button_blue middle_btn btn-block icon-truck"> เลือกวิธีรับสินค้า</button>
                       
                    </footer>
                     
                </section><!-- / [col] -->
                <?php } ?>
            </div><!--/ .row -->
        </div><!--/ .section_offset -->
    </div><!--/ .container-->

</div><!--/ .page_wrapper-->
</form>        
   
			<!-- - - - - - - - - - - - - - End Page Wrapper - - - - - - - - - - - - - - - - -->
<?php $this->load->view("templates/footer"); ?>
<?php $this->load->assets_by_name('Cart'); ?>

<script>
function checktermsubmit(){
	
	if(product_checked_arr.length <= 0){
		swal("สินค้า","ไม่มีสินค้าในตะกร้าที่เลือก","info");
		return false;	
	}
	$("#cart_frm").submit();
}

</script>
