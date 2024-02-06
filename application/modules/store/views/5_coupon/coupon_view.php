<?php $this->load->view("templates/header"); ?>



<div class="secondary_page_wrapper">

            <div class="container">

                <!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

                <ul class="breadcrumbs">

                    <li><a href="<?php echo base_url(); ?>" class="notcursor">หน้าหลัก</a></li>
					<li><a href="<?php echo base_url('store'); ?>" class="notcursor">บัญชีร้านค้า</a></li>
                    <li>จัดการคูปอง</li>
           


                </ul>

                <!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->

                <div class="row">

                    <?php $this->load->view("store/templates/left_tab"); ?>

                    <main class="col-md-9 col-sm-8 padding-l-0">

                        <div class="section_offset">

                            <div class="row">

                                <section class="col-sm-12">
                                    <div class="theme_box">
                                    <h3>จัดการคูปอง</h3>
                                    
                                    <!-- - - - - - - - - - - - - - Tabs v2 - - - - - - - - - - - - - - - - -->
                            		<form class="type_2" id="verify_coupon" method="post">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <input class="col-md-3" type="text" id="coupon_code" name="coupon_code" placeholder="พิมพ์ รหัสคูปองที่ต้องการใช้งาน" required>
                                        </div>
                                        <div class="col-md-3">
                                            <button type="button" onClick="verify_coupon();" class="button_blue middle_btn"><i class="icon-qrcode"></i> ตรวจสอบคูปอง</button>
                                        </div>
                                    </div>
                                    </form>
                                    
                                    <form class="type_2" action="<?php echo base_url("store/coupon/order"); ?>" method="post">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <input class="col-md-3" type="text" name="keyword" placeholder="พิมพ์รหัสคำสั่งซื้อ" required>
                                        </div>
                                        <div class="col-md-3">
                                            <button type="submit" class="button_blue middle_btn"><i class="icon-search"></i> ค้นหาคำสั่งซื้อ</button>
                                        </div>
                                    </div>
                                    </form>
                                    
									<?php
											foreach($orders as $row){
												$order_id = $row->order_id;
												$order_shipping_type_id = $row->order_shipping_type_id;
												$order_store_shipping_charge = $row->order_store_shipping_charge;
												$order_code = $row->order_code;
												$order_place_id = $row->order_place_id;
												$order_buyer_place_is_hidden = $row->order_buyer_place_is_hidden;
												$cart_id = $row->cart_id;
												$coupon_id = $row->coupon_id;
												$order_member_id = $row->order_member_id;
												$store_id = $row->store_id;
												$product_id = $row->product_id;
												$product_qty = $row->product_qty;
												$product_price_discount = $row->product_price_discount;
												$product_price_payment = $row->product_price_payment;
												$product_price_balance = $row->product_price_balance;
												$product_name = $row->product_name;
												
												$order_name = $row->order_name;
												$order_tax = $row->order_tax;
												$order_branch = $row->order_branch;
												$order_address = $row->order_address;
												$order_use_coin_type = $row->order_use_coin_type;
												$order_use_coin = $row->order_use_coin;
												$order_payment = $row->order_payment;
												$order_status = $row->order_status;
												$timestamp = $row->timestamp;
												
												
												
												
												$status_name = "";
												$status = $this->model_user->getOrderStatus($order_status);
												if(count($status))$status_name = $status[0]->status_name;
												$product_in_order = $this->model_user->getOrderByOrderCode($order_code);
												$store_in_order = $this->model_user->getStoreByID($store_id);
												
												$name = "-";
												foreach($store_in_order as $s){
													$store_name = $s->store_name;
													$first_name = $s->first_name;
													$last_name = $s->last_name;
													$name = $store_name;
												}
												
												
												$coupon_status = 0;
												$coupon_status_name = "-";
												$coupon = $this->model_coupon->getCouponByID($coupon_id);
												if(count($coupon)){
													foreach($coupon as $c){
														$coupon_status =  $c->coupon_status;
                                                        $coupon_use_date =  $c->coupon_use_date;
													}
													
													$coupon_status_result = $this->model_coupon->getCouponStatus($coupon_status);
													if(count($coupon_status_result))$coupon_status_name = $coupon_status_result[0]->status_name;	
												}
												
												if($coupon_status == 1){
													$badge = "badge-info";
                                                    $hidden = " hidden";
												}else if($coupon_status == 2){
													$badge = "badge-warning";
                                                    $hidden = "";
												}else if($coupon_status == 3){
													$badge = "badge-danger";
                                                    $hidden = " hidden";
												}else{
													$badge = "badge-warning";
                                                    $hidden = " hidden";
												}
												
												
										?>
                                    <div> 
                                            <div class="row">
                                                <div class="col-md-12 pt-10 <?php echo $hidden; ?>">
                                                    <label class="font-weight-bold badge badge-success p-lable pt-5 pl-5 pr-5"><i class="icon-ok"/></i> ถูกใช้แล้ว </label>
                                                    <?php echo "วันที่ ".$this->utils->getThaiDate($coupon_use_date); ?>
                                                </div>
                                                <div class="col-md-4 pt-10">
                                                    <label class="font-weight-bold">รหัสคำสั่งซื้อ : </label>
                                                    <a href="<?php echo base_url("store/coupon/orderinfo/".$order_code); ?>" class="text-primary"><?php echo $order_code; ?></a>
                                                </div>
                                                <div class="col-md-8 pt-10">
                                                    <label class="font-weight-bold">วันที่สั่งซื้อ : </label>
                                                    <?php echo $this->utils->getThaiDate($timestamp); ?>
                                                </div>
                                                <div class="col-md-4 pt-10">
                                                    <label class="font-weight-bold">ชื่อผู้ขาย : </label>
                                                    <?php echo $name; ?>
                                                </div>
                                                <div class="col-md-4 pt-10">
                                                    <label class="font-weight-bold">ชำระแล้ว : </label>
                                                    <?php echo number_format($product_price_payment); ?> บาท
                                                </div>
                                                <div class="col-md-4 pt-10 pb-10">
                                                    <label class="font-weight-bold">คงเหลือ : </label>
                                                    <?php echo number_format($product_price_balance); ?> บาท
                                                </div>
                                            </div>
                                            <!--<div class="row">
                                            
                                                <div class="col-md-3 pb-xs-2">
                                                    <button class="w-100 button_dark_grey"><i class="icon-trash"></i>
                                                        ลบรายการสั่งซื้อ</button>
                                                </div>
                                                <div class="col-md-3 pb-xs-2">
                                                <button type="button" class="w-100 button_blue "><i class="icon-qrcode"></i> ใช้งานคูปอง</button>
                                            	</div>
                                            </div>-->
                                        
                                            <div class="row pt-10">
        
                                                <div class="col-md-12 pb-xs-20">
                                                    <div class="table_wrap">
                                                        <table class="table_type_1 shopping_cart_table">
                                                            <thead>
                                                                <tr>
                                                                    <th width="70px;" class="text-md-center-left">รูปสินค้า</th>
                                                                    <th width="100px;" class="text-md-center-left">ชื่อสินค้า</th>
                                                                    <th width="50px;" class="text-md-center-left">ราคา</th>
                                                                    <th width="60px;" class="text-md-center-left">จำนวน</th>
                                                                    <th width="50px;" class="text-md-center-left">ราคารวม</th>
                                                                    <th width="60px;" class="text-md-center-left">สถานะ</th>
                                                                </tr>
        
                                                            </thead>
        
                                                            <tbody>
																<?php 
                                                                foreach($product_in_order as $p){
                                                                    $c_product_id = $p->product_id;
                                                                    $product_qty = $p->product_qty;
                                                                    $product_name = $p->product_name;
                                                                    $product_price_discount = $p->product_price_discount;
                                                                    $product_details = $this->model_productmanager->getProductByID($c_product_id);
                                                                    
                                                                    $link = $this->utils->getProductLink($c_product_id);
                                                                    
                                                                    $product_version = "";
                                                                    foreach($product_details as $d){
                                                                        $product_version = $d->product_version;
                                                                    }
                                                                    $product_images = $this->model_user->getProductImage($c_product_id);
                                                                    if(count($product_images))$product_image = $product_images[0]->image_url;
                                                            
                                                                ?>
                                                                <tr>
                                                                    <td class="product_image_col" data-title="รูปสินค้า" valign="middle">
    
                                                                        <a href="<?php echo $link; ?>"><img src="<?php echo base_url($product_image); ?>" alt="<?php echo $product_name; ?>"></a>
                                                                    </td>
                                                                    <td data-title="ชื่อสินค้า" valign="middle">
                                                                        <a href="<?php echo $link; ?>" class="product_title">
                                                                            <?php 
                                                                            if(strlen($product_name) > 60){
                                                                                echo iconv_substr($product_name,0,40,"UTF-8")."...";
                                                                            }else{
                                                                                echo iconv_substr($product_name,0,40,"UTF-8");
                                                                            } 
                                                                            ?></a>
                                                                        <ul class="sc_product_info">
                                                                            <!-- <li>Size: Big</li> -->
                                                                            <li><?php echo $product_version; ?></li>
                                                                        </ul>
                                                                    </td>
                                                                    <td class=" text-md-center-left" data-title="ราคา" valign="middle">
                                                                        ฿<?php echo number_format($product_price_discount,2); ?>
                                                                    </td>
                                                                    <td class="text-md-center-left" data-title="จำนวน" valign="middle">
                                                                        <?php echo $product_qty; ?>
                                                                    </td>
                                                                    <td class="total text-md-center-left" data-title="ราคารวม" valign="middle">
                                                                        ฿<?php echo number_format($product_price_discount*$product_qty,2); ?>
                                                                    </td>
                                                                    <td class="text-md-center-left" data-title="สถานะ" valign="middle">
                                                                        <a href="#"><span class="badge <?php echo $badge; ?>"><?php echo $coupon_status_name; ?></span></a>
                                                                    </td>
                                                                </tr>
                                                                
                                                                <?php } ?>
                                                                
                                                                
                                                            </tbody>
                                                            
                                                        </table>
                                                    </div>
                                                    <!--/ .table_wrap -->
                                                </div>
                                                
                                            </div>
                                            <hr>
                                    </div>
                                    
                                   	<?php } ?>
                                    
                                    
                                </div>
                                   

                                
                                </section>
                                <!--/ [col]-->
                            </div>
                            <!--/ .row -->
                            <footer class="bottom_box on_the_sides">

                                <div class="left_side">
                                <p><?php //echo $page_showing; ?></p>
                                </div>
                            
                                <div class="right_side">
                                    <?php echo $pagination ?>  
                                </div>

                            </footer>

                        </div>
                        <!--/ .section_offset -->

                    </main>
                    <!--/ [col]-->

                </div>
                <!--/ .row-->

            </div>
            <!--/ .container-->

        </div>
        <!--/ .page_wrapper-->
        


<?php $this->load->view("templates/footer"); ?>
<?php $this->load->assets_by_name("left_tab"); ?> 
<?php $this->load->assets_by_name('Coupon'); ?>
<script>
function verify_coupon(){
									
									
	var coupon_code = $("#coupon_code").val();
			
	$.ajax({
		type: 'POST',
		url: config.base_url+'store/api/coupon_api/verifyCoupon',
		data: {
			'coupon_code': coupon_code
		},
		success: function (json) {
			var json = JSON.parse(json);
			
			if(json.success){
				var order_code = json.order_code;
				var url = json.url;
				swal({
				  title: "ตรวจสอบคำสั่งซื้อ",
				  text: "กรุณาตรวจสอบคำสั่งซื้อที่ต้องการใช้คูปอง <a href='"+url+"' target='_blank'>"+order_code+"</a>",
				  html:true,
				  type: "info",
				  showCancelButton: true,
				  confirmButtonColor: "#DD6B55",
				  confirmButtonText: "ใช้คูปอง",
				  cancelButtonText:"ยกเลิก",
				  closeOnConfirm: false
				},function(result){
					if (result) {
						swal({
						  title: "กรุณาตรวจสอบ",
						  text: "ท่านกำลังจะใช้งานคูปองรหัส <b>"+coupon_code+"</b> \nการใช้งานคูปองหมายถึงการที่ทั้งผู้ซื้อ ผู้ส่งหรือผู้ขายสินค้า ได้รับการชำระและหรือได้รับสินค้า อย่างถูกต้องสมบูรณ์ทั้งสองฝ่าย",
						  html:true,
						  type: "warning",
						  showCancelButton: true,
						  confirmButtonColor: "#DD6B55",
						  confirmButtonText: "ใช่, ยอมรับการใช้งานคูปอง",
						  cancelButtonText:"ยกเลิก",
						  closeOnConfirm: false
						},function(result){
							if (result) {
								$.ajax({
									type: 'POST',
									url: config.base_url+'store/api/coupon_api/useCoupon',
									data: {
										'coupon_code': coupon_code
									},
									success: function (json) {
										var json = JSON.parse(json);
										if(json.success){
											swal({
											  title: "สำเร็จ",
											  text: "ใช้งานคูปองเรียบร้อยแล้ว.",
											  html:true,
											  type: "success",
											  showCancelButton: false,
											  confirmButtonColor: "#DD6B55",
											  confirmButtonText: "ตกลง",
											  cancelButtonText:"ยกเลิก",
											  closeOnConfirm: true
											},function(result){
												console.log(result);
												if (result) {
													window.location = config.base_url+"store/coupon";
												}
											});	
										}else{
											swal('มีบางอย่างผิดพลาด !','รหัสคูปองไม่ถูกต้อง คูปองถูกใช้ไปแล้ว หรือรหัสคูปองนี้หมดอายุแล้ว','warning');
										}
									}
								});
							}
							
							
							
						});
			
					}
				});
				
			}else{
				swal('รหัสรับสินค้าไม่ถูกต้อง !','','warning');
			}
		}
	});
	return false;
	
	
	/*swal({
      title: "กรุณาตรวจสอบ",
      text: "ท่านกำลังจะใช้งานคูปองรหัส <b>"+coupon_code+"</b> \nการใช้งานคูปองหมายถึงการที่ทั้งผู้ซื้อ ผู้ส่งหรือผู้ขายสินค้า ได้รับการชำระและหรือได้รับสินค้า อย่างถูกต้องสมบูรณ์ทั้งสองฝ่าย",
	  html:true,
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "ใช่, ยอมรับการใช้งานคูปอง",
	  cancelButtonText:"ยกเลิก",
      closeOnConfirm: true
    },function(result){
		if (result) {
			var coupon_code = $("#coupon_code").val();
			
			$.ajax({
				type: 'POST',
				url: config.base_url+'store/api/coupon_api/useCoupon',
				data: {
					'coupon_code': coupon_code
				},
				success: function (json) {
					var json = JSON.parse(json);
					
					if(json.success){
						swal({
						  title: "สำเร็จ",
						  text: "ใช้งานคูปองเรียบร้อยแล้ว.",
						  html:true,
						  type: "success",
						  showCancelButton: false,
						  confirmButtonColor: "#DD6B55",
						  confirmButtonText: "ตกลง",
						  cancelButtonText:"ยกเลิก",
						  closeOnConfirm: true
						},function(result){
							console.log(result);
							if (result) {
								window.location = config.base_url+"/store/coupon";
							}
						});	
					}else{
						swal('มีบางอย่างผิดพลาด !','รหัสคูปองไม่ถูกต้อง คูปองถูกใช้ไปแล้ว หรือรหัสคูปองนี้หมดอายุแล้ว','warning');
					}
				}
			});
		
		}
    });		
	return false;*/
}



	
</script>