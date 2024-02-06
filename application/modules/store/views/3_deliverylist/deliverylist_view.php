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


<div class="secondary_page_wrapper">

            <div class="container">

                <!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

                <ul class="breadcrumbs">

                    <li><a href="<?php echo base_url(); ?>" class="notcursor">หน้าหลัก</a></li>
					<li><a href="<?php echo base_url('store'); ?>" class="notcursor">บัญชีร้านค้า</a></li>
                    <li>รายการจัดส่งสินค้า</li>
           


                </ul>

                <!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->

                <div class="row">
					<?php $this->load->view("store/templates/left_tab"); ?>
                    <main class="col-md-9 col-sm-8 padding-l-0">

                        <div class="section_offset"> 

                            <div class="row">

                                <section class="col-sm-12">

                                    <h3>รายการจัดส่งสินค้า</h3>

                                    <!-- - - - - - - - - - - - - - Tabs v2 - - - - - - - - - - - - - - - - -->
									
                                    <div class="tabs type_2"> 

                                        <ul class="tabs_nav clearfix">

                                            <li><a href="#tab-1">ทั้งหมด</a></li>
                                        </ul>
										<?php
											$start_date = (isset($post['start_date']))?$post['start_date']:"";
											$end_date = (isset($post['end_date']))?$post['end_date']:"";
											$post_order_place = (isset($post['order_place_id']))?$post['order_place_id']:"";
											$post_order_status = (isset($post['order_status']))?$post['order_status']:"";
										?>
                                        <div class="tab_containers_wrap"> 

                                            <div id="tab-1" class="tab_container_not_use">
                                                <form class="type_2" action="<?php echo base_url("store/deliverylist/order/".$filter); ?>" method="post" id="delivery_frm">
                                                <div class="row ">
                                                    <div class="col-md-6">
                                                        <input type="text" name="keyword_code" placeholder="พิมพ์ชื่อร้าน รหัสร้าน หรือ รหัสคำสั่งซื้อ">
                                                    </div>
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
                                                     
                                                    
                                                </div>
        
                                                
                                                <div class="row">
                                                    <div class="col-md-5">
														<?php
																$myplace = $this->model_delivery->getPlaceByStoreID($current_store_id);
																//print_r($myplace);
														?>
                                                        <div class="custom_select">
                                                            <select name="order_place_id" id="order_place_id" class="form-control" onchange="submitFilter()">
                                                            	<option value="0">สถานที่ทั้งหมด</option>
                                                            	<?php
																
																foreach($myplace as $row){
																	$place_id = $row->place_id;
																	$place_name = $row->place_name;
																?>
                                                                
                                                                <option value="<?php echo $place_id; ?>"><?php echo $place_name; ?></option>
                                                                
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">

                                                        <div class="custom_select">
                                                            <select name="order_status" id="order_status" class="form-control" onchange="submitFilter()">
                                                                <option value="0">สถานะทั้งหมด</option>
                                                                <?php
																foreach($allstatus as $row){ 
																	$id = $row->id;
																	$status_name = $row->status_name;
																?>
                                                                <option value="<?php echo $id; ?>"><?php echo $status_name; ?></option>
                                                                
                                                                <?php } ?>
                                                            </select>
                                                        </div>

                                                    </div>
                                                   <div class="col-md-2 pt-0">
                                                        <button type="submit" class="w-100 button_blue middle_btn icon-search"> ค้นหา</button>
                                                    </div>
                                                </div>
                                                </form>
                                                <!-- --------------------------------รูปสินค้า 1----------------------- -->
                                                
                                                
                                                
                                                <!--start order list-->
                                        
                                        <?php
											foreach($orders as $row){
												$order_id = $row->order_id;
												$order_shipping_type_id = $row->order_shipping_type_id;
												$order_store_shipping_charge = $row->order_store_shipping_charge;
												$order_code = $row->order_code;
												$current_order_place_id = $row->order_place_id;
												$order_buyer_place_is_hidden = $row->order_buyer_place_is_hidden;
												$cart_id = $row->cart_id;
												$order_member_id = $row->order_member_id;
												$depositor_cost = $row->depositor_cost;
												$depositor_cost_approve = $row->depositor_cost_approve;
												$depositor_store_id = $row->depositor_store_id;
												$seller_store_id = $row->seller_store_id;
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
												
												
												$place_delivery = "";
												$place = $this->model_saleitem->getPlaceByID($current_order_place_id);
												if(count($place)){
													$place_delivery .= " คุณ ";
													$place_delivery .= $place[0]->place_name." ";
													$place_delivery .= " ที่อยู่ : ";
													$place_delivery .= $place[0]->place_address." ";
													$place_delivery .= " ต.";
													$place_delivery .= $this->storemanager->getDistrictName($place[0]->place_district)." ";
													$place_delivery .= " อ.";
													$place_delivery .= $this->storemanager->getAmphurName($place[0]->place_amphur)." ";
													$place_delivery .= " จ.";
													$place_delivery .= $this->storemanager->getProvinceName($place[0]->place_province)." ";
													$place_delivery .= $place[0]->place_postcode;
													$place_delivery .= " โทรศัพท์ ";
													$place_delivery .= $place[0]->place_mobile;
													$place_lat = $place[0]->place_lat;
													$place_long = $place[0]->place_long;
													
												}
												$link = 'https://www.google.com/maps/search/?api=1&query='.$place_lat.','.$place_long;
												//$place_delivery = "<a href='".$link."' target='blank'>".$place_delivery."</a>";
												
												/*$status_name = "รอจัดส่ง";
												if($order_status == 1){
													$status_name = "รอจัดส่ง";
												}else{
													$status_name = "จัดส่งแล้ว";
												}*/
												//$status = $this->model_delivery->getOrderStatus($order_status);
												//if(count($status))$status_name = $status[0]->status_name;
												
												$is_waiting_for_review = $this->productmanager->updateOrderStatusToWaitingForReview($order_id);					
												if($is_waiting_for_review){
													$order_status = 10;
												}
												
												if($order_status == 3 || $order_status == 6 || $order_status == 7 || $order_status == 8 || $order_status == 9 || $order_status == 11 || $order_status == 10){
													$disabled_change_status = "disabled";	
												}else{
													$disabled_change_status = "";	
												}
												
												$status = $this->model_saleitem->getOrderStatus($order_status);
												if(count($status))$status_name = $status[0]->status_name;
												
												$product_in_order = $this->model_delivery->getOrderByOrderCode($order_code);
												//print_r($product_in_order);
												$member = $this->model_delivery->getMemberByID($order_member_id);
												$buyer_name = "-";
												foreach($member as $s){
													$first_name = $s->first_name;
													$last_name = $s->last_name;
													$buyer_name = $first_name;//$last_name;
												}
												
												$member = $this->model_delivery->getStoreByID($seller_store_id);
												$seller_name = "-";
												$seller_url = "";
												foreach($member as $s){
													$seller_url = base_url($s->store_url);
													$seller_name = $s->store_name;
												}
												
												$total_price_order = $product_price_balance+$product_price_payment+$order_store_shipping_charge;
												
												$badge = "badge-info";
												if($order_status == 3 || $order_status == 10 || $order_status == 11){
													$badge = "badge-warning";
												}
										?>
                                        <div class="row">
                                            <div class="col-md-4 pt-10">
                                                <label class="font-weight-bold">รหัสคำสั่งซื้อ : </label>
                                                <a href="<?php echo base_url("store/deliverylist/orderinfo/".$order_code); ?>" class="text-primary"><?php echo $order_code; ?></a>
                                            </div>
                                            <div class="col-md-4 pt-10">
                                                <label class="font-weight-bold">วันที่สั่งซื้อ : </label>
                                                <?php echo $this->utils->getThaiDate($timestamp,false); ?>
                                            </div>
                                            <div class="col-md-4 pt-10">
                                                <label class="font-weight-bold">ชื่อผู้ซื้อ : </label>
                                                <?php echo $buyer_name; ?>
                                            </div>
                                             <div class="col-md-4 pt-10">
                                                <label class="font-weight-bold">ชื่อผู้ขาย : </label>
                                                <?php echo "<a href='".$seller_url."' target='_blank'>".$seller_name."</a>"; ?>
                                            </div>
                                            <div class="col-md-4 pt-10">
                                                <label class="font-weight-bold">ค่าสินค้า : </label>
                                                <?php echo number_format($product_price_payment+$product_price_balance,2); ?> บาท
                                            </div>
                                            <div class="col-md-4 pt-10">
                                                <label class="font-weight-bold">ชำระด้วยเหรียญ : </label>
                                                <?php echo number_format($order_use_coin,2); ?> บาท
                                            </div>
                                             <div class="col-md-4 pt-10">
                                                <label class="font-weight-bold">ชำระแล้ว : </label>
                                                <?php echo number_format($product_price_payment,2); ?> บาท
                                            </div>
                                           <!--  <div class="col-md-4 pt-10">
                                                <label class="font-weight-bold">ราคาสุทธิ : </label>
                                               <?php echo number_format($total_price_order,2); ?> บาท
                                            </div>-->
                                           
                                            <div class="col-md-4 pt-10 ">
                                                <label class="font-weight-bold">คงเหลือ : </label>
                                                <?php echo number_format($product_price_balance,2); ?> บาท
                                            </div>
                                             <div class="col-md-4 pt-10">
                                                <label class="font-weight-bold">ค่าฝากส่งผ่านเอเย่นต์ : </label>
                                               <?php echo number_format($depositor_cost,2); ?> บาท
                                            </div>
                                            <div class="col-md-12 pt-10 pb-10">
                                                <label class="font-weight-bold">สถานที่ส่งสินค้า : </label>
                                                <?php echo $place_delivery; ?>
                                                <a href="<?php echo $link; ?>" class="  " target="_blank"><i class="icon-location"></i> ดูแผนที่</a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 pb-xs-2">
                                                <a href="<?php echo base_url("message/create/3/".$order_id."/2"); ?>" class="w-100 button_blue"><i class="icon-users"></i>ติดต่อผู้ซื้อ</a>
                                            </div>
                                            <div class="col-md-3 pb-xs-2">
                                                <a href="<?php echo base_url("message/create/3/".$order_id."/1"); ?>" class="w-100 button_blue"><i class="icon-users"></i>ติดต่อผู้ขาย</a>
                                            </div>
                                            <?php if($order_status != 3 && $depositor_cost_approve != 1){ ?>
                                          
                                            <div class="col-md-3 pb-xs-2">
                                                <button onClick="addDelivery(this,<?php echo $order_id; ?>);" class="w-100 button_dark_grey"><i class="icon-cog-outline"></i>แจ้งค่าบริการฝากส่ง</button>
                                            </div>
                                            <?php } ?>
                                            
                                            <!--<div class="col-md-3 pb-xs-2">
                                            	<div class="dropdown dropdown_custom">
                                                  <button class="button_blue dropdown-toggle" type="button" data-toggle="dropdown" <?php echo $disabled_change_status; ?>>
                                                  สถานะคำสั่งซื้อ
                                                  
                                                  <span class="caret"></span></button>
                                                  <ul class="dropdown-menu">
                                                  	 
                                                  
                                                     <li><a href="<?php echo base_url("store/deliverylist/delivered/".$order_id."/6"); ?>">ตีกลับผู้ขาย</a></li>
                                                     <li><a href="<?php echo base_url("store/deliverylist/delivered/".$order_id."/9"); ?>">ผู้ซื้อปฏิเสธรับของ</a></li>
                                                    
                                                  </ul>
                                                </div>
                                                
											</div>-->
                                            
                                            
                                        </div>

                                        <div class="row pt-10">

                                            <div class="col-md-12 pb-xs-20">
                                                <div class="table_wrap">
                                                    <table class="table_type_1 shopping_cart_table">
                                                        <thead>
                                                            <tr>
                                                                <th width="70px;" class="text-md-center-left">รูปสินค้า</th>
                                                                <th width="100px;" class="text-md-center-left">ชื่อสินค้า</th>
                                                                <!-- <th width="60px;" class="text-md-center-left">ค่าฝากส่งผ่านเอเย่นต์</th> -->
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
																$product_images = $this->model_delivery->getProductImage($c_product_id);
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
                                                               <!--  <td class=" text-md-center-left" data-title="ราคา" valign="middle">
                                                                    <span class="badge badge-success deposit_cost">฿<?php //echo number_format($depositor_cost,2); ?></span>
                                                                </td> -->
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
                                            <!--/ .tab_containers_wrap -->

                                        </div>
                                        <!--/ .tabs-->

                                        <!-- - - - - - - - - - - - - - End of tabs v2 - - - - - - - - - - - - - - - - -->

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

<?php $this->load->view("store/3_deliverylist/modals/modal_delivery"); ?>
<?php $this->load->assets_by_name("left_tab","js"); ?>
<?php $this->load->assets_by_name('Deliverylist'); ?>
<script src="<?php echo base_url("assets/js/bootstrap-datepicker.min.js"); ?>" type="text/javascript"></script>
<script src="<?php echo base_url("assets/js/locales/bootstrap-datepicker.th.js"); ?>"></script>
<script>
var order_place_id = "<?php if(isset($post_order_place) && !empty($post_order_place))echo $post_order_place; ?>";
var order_status = "<?php if(isset($post_order_status) && !empty($post_order_status))echo $post_order_status; ?>";
var start_date = "<?php if(isset($start_date) && !empty($start_date))echo $start_date; ?>";
var end_date = "<?php if(isset($end_date) && !empty($end_date))echo $end_date; ?>";

$(function() {
	
	if(order_place_id){
		$("#order_place_id").val(order_place_id);
	}
	if(order_status){
		$("#order_status").val(order_status);
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

var deposit_cost_div;
var order_id = 0;
function addDelivery(_this,id){
	order_id = id;
	$("#modal_delivery").modal("show");
	$('#modal_delivery').on('shown.bs.modal', function (e) {
		deposit_cost_div = $(_this).parent().parent().next().find('.deposit_cost');
	})
}
function saveDepositCost(){
	var depositor_cost = parseInt($("#depositor_cost").val());
	if(depositor_cost >= 0){
		$(deposit_cost_div).text('฿'+numberWithCommas(depositor_cost));
		$.ajax({
			type: 'POST',
			url: config.base_url+'store/api/deliverylist_api/saveDepositCost',
			data: {
				'order_id': order_id,
				'depositor_cost': depositor_cost
			},
			success: function (json) {
				console.log(json);
				$("#modal_delivery").modal("hide");
				var json = JSON.parse(json);
			}
		});
	}
	
}

function submitFilter(){
	//$("#delivery_frm").submit();
}
</script>