<?php $this->load->view("templates/header"); ?>
<style>
.dropdown_custom{
	visibility:visible;
	-webkit-transform-style: unset;
	-ms-transform-style: unset;
	transform-style:unset;
	-webkit-transform: unset;
	transform: unset;
	perspective:unset;

}
</style>

<!-- - - - - - - - - - - - - - Page Wrapper - - - - - - - - - - - - - - - - -->

<div class="secondary_page_wrapper">

    <div class="container">

        <!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

        <ul class="breadcrumbs">

            <li><a href="<?php echo base_url(); ?>" class="notcursor">หน้าหลัก</a></li>
            <li><a href="<?php echo base_url("user"); ?>" class="notcursor">บัญชีผู้ซื้อ</a></li>
            <li>รายการสั่งซื้อของฉัน</li>

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
                                
                            <h3>รายการสั่งซื้อของฉัน</h3>

                            <!-- - - - - - - - - - - - - - Tabs v2 - - - - - - - - - - - - - - - - -->

                            <div class="tabs type_2">

                                <ul class="tabs_nav clearfix">
									<?php 
										$all_active = "";
										$myplace_active = "";
										$other_active = "";
										if($filter == "all"){
											$all_active = "active";
										}else if($filter == "myplace"){
											$myplace_active = "active";
										}else if($filter == "otherplace"){
											$other_active = "active";
										}
									?>
                        
                                    <li class="<?php echo $all_active; ?>"><a href="<?php echo base_url("user/order/all"); ?>">ทั้งหมด</a></li>
                                    <li class="<?php echo $myplace_active; ?>"><a href="<?php echo base_url("user/order/myplace"); ?>">ส่งที่อยู่ผู้ซื้อ</a></li>
                                    <li class="<?php echo $other_active; ?>"><a href="<?php echo base_url("user/order/otherplace"); ?>">รับของเอง</a></li>

                                </ul>
                                <?php
									$start_date = (isset($post['start_date']))?$post['start_date']:"";
									$end_date = (isset($post['end_date']))?$post['end_date']:"";
									$status_id = (isset($post['status_id']))?$post['status_id']:"";
									$gateway_type = (isset($post['gateway_type']))?$post['gateway_type']:"";
								?>
                                <div class="tab_containers_wrap">

									<?php $filter = $this->uri->segment(3); ?> 
                                    <div id="all_Orders" class="tab_container_not_use">
                                    	<form class="type_2" action="<?php echo base_url("user/order/".$filter); ?>" method="post">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row ">
                                                    <div class="col-sm-5 col-md-5 pr-md-0">
                                                        <div class="form-group">
                                                            <div class="input-group date">
                                                                <input type="text" name="start_date" id="start_date" class="form-control" value="<?php if(isset($start_date) && !empty($start_date))echo $start_date; ?>">
                                                                <span class="input-group-addon">
                                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2 col-md-2 text-center pt-b-10">
                                                        ถึง
                                                    </div>
                                                    <div class="col-sm-5 col-md-5 pl-md-0 ">
                                                        <div class="form-group">
                                                            <div class="input-group date">
                                                                <input type="text" name="end_date" id="end_date" class="form-control" value="<?php if(isset($end_date) && !empty($end_date))echo $end_date; ?>">
                                                                <span class="input-group-addon">
                                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-sm-4 col-md-4">
                                                        <div class="custom_select">
                                                            <select name="gateway_type" id="gateway_type" class="form-control">
                                                            	<option value="0">ทั้งหมด</option>
                                                                <?php
																	$all_gateway_type = $this->model_user->getAllOrderGatewayType();
																	foreach($all_gateway_type as $row){
																		$id = $row->id;
																		$type_name = $row->type_name;
																?>
                                                                	<option value="<?php echo $id; ?>"><?php echo $type_name; ?></option>
                                                                    
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4 col-md-4">
                                                        <div class="custom_select">
                                                            <select name="status_id" id="status_id" class="form-control">
                                                            	<option value="0">ทั้งหมด</option>
                                                            	<?php
																	$all_order_status = $this->model_user->getAllOrderStatus();
																	foreach($all_order_status as $row){
																		$id = $row->id;
																		$status_name = $row->status_name;
																?>
                                                                	<option value="<?php echo $id; ?>"><?php echo $status_name; ?></option>
                                                                    
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 pt-0">
                                                        <button type="submit" class="w-100 button_blue middle_btn icon-search"> ค้นหา</button>
                                                    </div>
                                            
                                                </div>
                                            </div>
                                            
                                        </div>

										<form>
										<!--start order list-->
                                        
                                        <?php
											foreach($orders as $row){
												$order_id = $row->order_id;
												$order_shipping_type_id = $row->order_shipping_type_id;
												$order_store_shipping_charge = $row->order_store_shipping_charge;
												$order_code = $row->order_code;
												$order_place_id = $row->order_place_id;
												$order_buyer_place_is_hidden = $row->order_buyer_place_is_hidden;
												$cart_id = $row->cart_id;
												$order_member_id = $row->order_member_id;
												$store_id = $row->store_id;
												$depositor_store_id = $row->depositor_store_id;
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
												$order_time = $row->order_time;
												$timestamp = $row->timestamp;
												
												$is_waiting_for_review = $this->productmanager->updateOrderStatusToWaitingForReview($order_id);					
												if($is_waiting_for_review){
													$order_status = 10;
												}
												if($order_status == 1 || $order_status == 2 || $order_status == 3 || $order_status == 6 || $order_status == 11 || $order_status == 7 || $order_status == 8 || $order_status == 9 || $order_status == 10){
													$disabled_change_status = "disabled";	
												}else{
													$disabled_change_status = "";	
												}
												
												$status_name = "";
												$status = $this->model_user->getOrderStatus($order_status);
												if(count($status))$status_name = $status[0]->status_name;
												$product_in_order = $this->model_user->getOrderByOrderCode($order_code);
												$store_in_order = $this->model_user->getStoreByID($store_id);
												
												$name = "-";
												foreach($store_in_order as $s){
													$first_name = $s->first_name;
													$last_name = $s->last_name;
													$name = $first_name;//$last_name;
												}
												
												$total_price_order = $product_price_balance+$product_price_payment+$order_store_shipping_charge;
												
												
												
												$badge = "badge-info";
												if($order_status == 3 || $order_status == 10 || $order_status == 11){
													$badge = "badge-warning";
												}

                                                $place_delivery = "";
                                                $place = $this->model_user->getPlaceByID($order_place_id);
                                                if(count($place)){
                                                    $place_delivery .= $place[0]->place_name." ";
                                                    $place_delivery .= $place[0]->place_address." ";
                                                    $place_delivery .= $this->storemanager->getDistrictName($place[0]->place_district)." ";
                                                    $place_delivery .= $this->storemanager->getAmphurName($place[0]->place_amphur)." ";
                                                    $place_delivery .= $this->storemanager->getProvinceName($place[0]->place_province)." ";
                                                    $place_delivery .= $place[0]->place_postcode;
                                                    $place_lat = $place[0]->place_lat;
                                                    $place_long = $place[0]->place_long;
                                                    
                                                }
                                                $map_link = 'https://www.google.com/maps/search/?api=1&query='.$place_lat.','.$place_long;

                                                foreach($store_in_order as $sr){
                                                    $store_url = base_url($sr->store_url);
                                                    $store_name = $sr->store_name;
                                                }
										?>
                                        <div class="row">
                                            <div class="col-md-4 pt-10">
                                                <label class="font-weight-bold">รหัสคำสั่งซื้อ :  </label>
                                                <a href="<?php echo base_url("user/orderinfo/".$order_code); ?>" class="text-primary"><?php echo $order_code; ?></a>
                                            </div>
                                            <div class="col-md-4 pt-10">
                                                <label class="font-weight-bold">วันที่สั่งซื้อ : </label>
                                                <?php echo $this->utils->getThaiDate($order_time,false); ?>
                                            </div>
                                            <div class="col-md-4 pt-10">
                                                <label class="font-weight-bold">ชื่อผู้ขาย : </label>
                                                <?php echo "<a href='".$store_url."' target='_blank'>".$store_name."</a>"; ?>
                                            </div>
                                            <div class="col-md-4 pt-10">
                                                <label class="font-weight-bold">ค่าสินค้า : </label>
                                                <?php echo number_format($product_price_payment+$product_price_balance,2); ?> บาท
                                            </div>
                                            <div class="col-md-4 pt-10">
                                                <label class="font-weight-bold">ค่าจัดส่ง : </label>
                                                <?php echo number_format($order_store_shipping_charge,2); ?> บาท
                                            </div>
                                             <div class="col-md-4 pt-10 ">
                                                <label class="font-weight-bold">ราคาสุทธิ : </label>
                                               <?php echo number_format($total_price_order,2); ?> บาท
                                            </div>
                                            <div class="col-md-4 pt-10">
                                                <label class="font-weight-bold">ชำระด้วยเหรียญ : </label>
                                                <?php echo number_format($order_use_coin,2); ?> บาท
                                            </div>
                                            <div class="col-md-4 pt-10">
                                                <label class="font-weight-bold">ชำระแล้ว : </label>
                                                <?php echo number_format(($product_price_payment+$order_store_shipping_charge)-$order_use_coin,2); ?> บาท
                                            </div>
                                            <div class="col-md-4 pt-10">
                                                <label class="font-weight-bold">คงเหลือ : </label>
                                                <?php echo number_format($product_price_balance,2); ?> บาท
                                            </div>
                                           
                                            <div class="col-md-12 pt-10 pb-10">
                                                <label class="font-weight-bold">สถานที่ส่งสินค้า : </label>
                                                <?php echo $place_delivery; ?>
                                                <a href="<?php echo $map_link; ?>" class="  " target="_blank"><i class="icon-location"></i> ดูแผนที่</a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 pb-xs-2">
                                                <a href="<?php echo base_url("message/create/3/".$order_id."/1"); ?>" class="w-100 button_blue"><i class="icon-users"></i>ติดต่อผู้ขาย</a>
                                            </div>
                                            <?php if($depositor_store_id > 0){ ?>
                                             <div class="col-md-3 pb-xs-2">
                                                <a href="<?php echo base_url("message/create/3/".$order_id."/3"); ?>" class="w-100 button_blue"><i class="icon-users"></i>ติดต่อผู้ส่ง</a>
                                            </div>
                                            <?php } ?>
                                            <div class="col-md-3 pb-xs-2">
                                                <a href="<?php echo base_url("message/create/4/".$order_id."/4"); ?>" class="w-100 button_blue icon-megaphone"> ส่งร้องเรียน</a>
                                            </div>
                                            
                                            <div class="col-md-3 pb-xs-2">
                                            	<div class="dropdown dropdown_custom">
                                                  <button class="button_blue dropdown-toggle" type="button" data-toggle="dropdown" <?php echo $disabled_change_status; ?>>
                                                  สถานะคำสั่งซื้อ
                                                  
                                                  <span class="caret"></span></button>
                                                  <ul class="dropdown-menu">
                                                  	 <?php if(($order_status == 5 || $order_status == 4 ) && $order_status != 7 && $order_status != 9){ ?>
                                                  	 <li><a onClick="delivered('<?php echo base_url("user/delivered/".$order_id."/8"); ?>',8);" href="#">ยกเลิกคำสั่งซื้อ</a></li>
                                                     <?php } ?>
                                                  </ul>
                                                </div>
                                                
											</div>
                                        </div>

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
                                                                                echo iconv_substr($product_name,0,30,"UTF-8")."...";
                                                                            }else{
                                                                                echo iconv_substr($product_name,0,30,"UTF-8");
                                                                            }
                                                                        ?>  
                                                                    </a>
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
                                                                    <a href="#"><span class="badge <?php echo $badge; ?>"><?php echo $status_name; ?></span></a>
                                                                </td>
                                                            </tr>
                                                            
                                                            <?php } ?>
                                                            
                                                            
                                                        </tbody>
                                                    </table>
                                                </div><!--/ .table_wrap -->
                                            </div>
                                        </div>
                                        <hr class="pb-0">
                                        
										<?php } ?>
                                        

                                        


                                    </div>
                                </div><!--/ .tab_containers_wrap -->

                            </div><!--/ .tabs-->
                            
                            <!-- - - - - - - - - - - - - - End of tabs v2 - - - - - - - - - - - - - - - - -->

                        </section><!--/ [col]-->
                    </div><!--/ .row -->
                    <footer class="bottom_box on_the_sides">

                        <div class="left_side">
                            <p><?php //echo $page_showing; ?></p>
                        </div>
                    
                        <div class="right_side">
                            <?php echo $pagination ?>  
                        </div>

                    </footer>

                </div><!--/ .section_offset -->
                
            </main><!--/ [col]-->

        </div><!--/ .row-->

    </div><!--/ .container-->

</div><!--/ .page_wrapper-->
            
            
<?php $this->load->view("templates/footer"); ?>
<?php $this->load->assets_by_name("User"); ?>
<?php $this->load->assets_by_name('Left_tab'); ?>
<script src="<?php echo base_url("assets/js/bootstrap-datepicker.min.js"); ?>" type="text/javascript"></script>
<script src="<?php echo base_url("assets/js/locales/bootstrap-datepicker.th.js"); ?>"></script>
<script>

var gateway_type = "<?php if(isset($gateway_type) && !empty($gateway_type))echo $gateway_type; ?>";
var status_id = "<?php if(isset($status_id) && !empty($status_id))echo $status_id; ?>";
var start_date = "<?php if(isset($start_date) && !empty($start_date))echo $start_date; ?>";
var end_date = "<?php if(isset($end_date) && !empty($end_date))echo $end_date; ?>";
$(function() {
		  
	if(status_id){
		$("#status_id").val(status_id);
	}
	if(gateway_type){
		$("#gateway_type").val(gateway_type);
	}
	if(start_date != "" && end_date != ""){
		$("#end_date, #start_date").datepicker({format: 'yyyy-m-d',
			language:"th-th",
			todayHighlight:true,
			ignoreReadonly: true
		});
	}else{
		$("#end_date, #start_date").datepicker({format: 'yyyy-m-d',
				language:"th-th",
				todayHighlight:true,
				ignoreReadonly: true
		}).datepicker("setDate", new Date());
	}

});
</script>