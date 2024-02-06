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
					<!-- <li><a href="#">บัญชีร้านค้า</a></li> -->
                    <li>รายละเอียดคำสั่งซื้อ</li>
            


                </ul>

                <!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->

                <div class="row">

                   
                    
                    <main class="col-md-12 col-sm-12">

                        <div class="section_offset">

                            <div class="row">

                                <section class="col-sm-12">

                                    

                                    <!-- - - - - - - - - - - - - - Tabs v2 - - - - - - - - - - - - - - - - -->

                                    <div class="tabs type_2">

                                      
										
                                        <div class="tab_containers_wrap">
												
                                            <div id="tab-1" class="tab_container">
                                            	<h3>คำสั่งซื้อ <?php echo $order_code; ?></h3>
                                               
                                                <?php
                                             	if(count($orders) <= 0){
													redirect("home");	
												}
												foreach($orders as $row){
												$total_price_order = 0;
												$order_id = $row->order_id;
												$order_shipping_type_id = $row->order_shipping_type_id;
												$order_store_shipping_charge = $row->order_store_shipping_charge;
												$order_code = $row->order_code;
												$depositor_store_id = $row->depositor_store_id;
												
												$current_order_place_id = $row->order_place_id;
												$order_buyer_place_is_hidden = $row->order_buyer_place_is_hidden;
												$cart_id = $row->cart_id;
												$depositor_cost = $row->depositor_cost;
												$depositor_cost_approve = $row->depositor_cost_approve;
												$order_member_id = $row->order_member_id;
												$store_id = $row->store_id;
												$sender_store_id = $row->sender_store_id;
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
												
												$tax_address = "";
												
												$tax_address .= $row->order_name." ";
												$tax_address .= " เลขประจำตัวผู้เสียภาษี : ".$row->order_tax." ";
												if(!empty($order_branch)){
													$tax_address .= " รหัสสาขา : ".$row->order_branch." ";
												}
												$tax_address .= " ที่อยู่ : ".$row->order_address." ";
												
												$timestamp = $row->timestamp;
												
												
												$place_delivery = "";
												$place = $this->model_saleitem->getPlaceByID($current_order_place_id);
												if(count($place)){
													// $place_delivery .= " คุณ ";
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
												
												$status_name = "กำลังดำเนินการ";
												/*if($order_status == 1){
													$status_name = "รอจัดส่ง";
												}else{
													$status_name = "จัดส่งแล้ว";
												}*/
												
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
												$product_in_order = $this->model_saleitem->getOrderByOrderCode($order_code);
												$member = $this->model_delivery->getMemberByID($order_member_id);
												$buyer_name = "-";
												foreach($member as $s){
													$first_name = $s->first_name;
													$last_name = $s->last_name;
													$buyer_name = $first_name." ".$last_name;
												}
												
												$member = $this->model_delivery->getStoreByID($sender_store_id);
												$sender_name = "-";
												$sender_url = "";
												foreach($member as $s){
													$sender_url = base_url($s->store_url);
													$sender_name = $s->store_name;
												}
												
												
												$depositor = $this->model_delivery->getStoreByID($depositor_store_id);
												$depositor_name = "-";
												$depositor_url = "";
												foreach($depositor as $s){
													$depositor_url = base_url($s->store_url);
													$depositor_name = $s->store_name;
												}
												
												$total_price_order = $product_price_balance+$product_price_payment+$order_store_shipping_charge;
												/*if($order_status == 1){
													$badge = "badge-info";
												}else if($order_status == 2){
													$badge = "badge-success";
												}else if($order_status == 3){
													$badge = "badge-danger";
												}else{
													$badge = "badge-info";
												}*/
												
												$badge = "badge-info";
												if($order_status == 3 || $order_status == 10 || $order_status == 11){
													$badge = "badge-warning";
												}
												$store_result = $this->model_saleitem->getStoreByID($store_id);
												foreach($store_result as $sr){
													$store_url = base_url($sr->store_url);
													$store_name = $sr->store_name;
												}
										?>
                                        <div class="row">
                                            <div class="col-md-4 pt-10">
                                                <label class="font-weight-bold">รหัสคำสั่งซื้อ : </label>
                                                <a href="#" class="text-primary"><?php echo $order_code; ?> </a>
                                            </div>
                                            <div class="col-md-4 pt-10">
                                                <label class="font-weight-bold">วันที่สั่งซื้อ : </label>
                                                <?php echo $this->utils->getThaiDate($timestamp,false); ?>
                                            </div>
                                            <div class="col-md-4 pt-10">
                                                <label class="font-weight-bold">ผู้ซื้อ : </label>
                                                <?php echo $first_name; ?>
                                            </div>
                                            <div class="col-md-4 pt-10">
                                                <label class="font-weight-bold">ผู้ส่ง : </label>
                                                <?php echo "<a href='".$depositor_url."' target='_blank'>".$depositor_name."</a>"; ?>
                                            </div>
                                            <div class="col-md-4 pt-10">
                                                <label class="font-weight-bold">ผู้ขาย : </label>
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
                                            <div class="col-md-4 pt-10">
                                                <label class="font-weight-bold">ราคาสุทธิ : </label>
                                               <?php echo number_format($total_price_order,2); ?> บาท
                                            </div>
                                            <div class="col-md-4 pt-10">
                                                <label class="font-weight-bold">ชำระแล้ว : </label>
                                                <?php echo number_format(($product_price_payment+$order_store_shipping_charge),2); ?> บาท
                                            </div>
                                           <!--  <div class="col-md-4 pt-10">
                                                <label class="font-weight-bold">ชำระด้วยเหรียญ : </label>
                                                <?php //echo number_format($order_use_coin,2); ?> บาท
                                            </div> -->
                                            <div class="col-md-4 pt-10 ">
                                                <label class="font-weight-bold">คงเหลือ : </label>
                                                <?php echo number_format($product_price_balance,2); ?> บาท
                                            </div>
                                            
                                            <div class="col-md-12 pt-10 pb-10">
                                                <label class="font-weight-bold">สถานที่ส่งสินค้า : </label>
                                                <a target="_blank" href="<?php echo base_url()?>place/info/<?php echo $current_order_place_id; ?>"><?php echo $place_delivery; ?></a>
                        
                                                <a href="<?php echo $link; ?>" class="  " target="_blank"><i class="icon-location"></i> ดูแผนที่</a>
                                            </div>
                                            <?php if($order_buyer_place_is_hidden == 1){ ?>
											<div class="col-md-12 pt-10 pb-10">
                                                <label class="font-weight-bold">ข้อมูลออกใบเสร็จ : </label>
                                                <?php echo $tax_address; ?>
                                                
                                            </div>
                                            <?php } ?>
                                        </div>
                                        
                                        <div class="row pt-10">

                                            <div class="col-md-12 pb-xs-20">
                                                <div class="table_wrap">
                                                    <table class="table_type_1 shopping_cart_table">
                                                        <thead>
                                                            <tr>
                                                                <th width="50px;" class="text-md-center-left">รูปสินค้า</th>
                                                                <th width="190px;" class="text-md-center-left">ชื่อสินค้า</th>
                                                                <!-- <th width="50px;" class="text-md-center-left">ค่าฝากส่ง</th> -->
                                                                <th width="50px;" class="text-md-center-left">ราคา</th>
                                                                <th width="60px;" class="text-md-center-left">จำนวน</th>
                                                                <th width="50px;" class="text-md-center-left">ราคารวม</th>
                                                                <th width="40px;" class="text-md-center-left">สถานะ</th>
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
																$product_images = $this->model_saleitem->getProductImage($c_product_id);
																if(count($product_images))$product_image = $product_images[0]->image_url;
															?>
                                                            <tr>
                                                                <td class="product_image_col" data-title="รูปสินค้า" valign="middle">

                                                                    <a href="<?php echo $link; ?>"><img src="<?php echo base_url($product_image); ?>" alt="<?php echo $product_name; ?>" width="300px" ></a>
                                                                </td>

                                                                <td data-title="ชื่อสินค้า" valign="middle">
                                                                    <a href="<?php echo $link; ?>" class="product_title"><?php echo $product_name; ?></a>
                                                                    <ul class="sc_product_info">
                                                                        <!-- <li>Size: Big</li> -->
                                                                        <li><?php echo $product_version; ?></li>
                                                                    </ul>
                                                                </td>

                                                                 <!-- <td class=" text-md-center-left" data-title="ราคา" valign="middle">
                                                                    <?php //if($order_shipping_type_id == 2){ ?>
                                                                    <span class="badge badge-success deposit_cost">฿<?php// echo number_format($depositor_cost,2); ?></span>
                                                                    <?php //}else{ ?>
                                                                    ไม่มี
                                                                    <?php //} ?>
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
                                            



                                            </div>
                                            <!--/ .tab_containers_wrap -->

                                        </div>
                                        <!--/ .tabs-->

                                        <!-- - - - - - - - - - - - - - End of tabs v2 - - - - - - - - - - - - - - - - -->

                                </section>
                                <!--/ [col]-->
                            </div>
                            

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

<script src="<?php echo base_url("assets/js/bootstrap-datepicker.min.js"); ?>" type="text/javascript"></script>
<script src="<?php echo base_url("assets/js/locales/bootstrap-datepicker.th.js"); ?>"></script>
<script>
var order_place_id = "<?php if(isset($post_order_place) && !empty($post_order_place))echo $post_order_place; ?>";
var order_status = "<?php if(isset($post_order_status) && !empty($post_order_status))echo $post_order_status; ?>";
var start_date = "<?php if(isset($start_date) && !empty($start_date))echo $start_date; ?>";
var end_date = "<?php if(isset($end_date) && !empty($end_date))echo $end_date; ?>";
var clear_id;
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
	clear_id = setTimeout(resize,1000);
});
function resize(){
	clearTimeout(clear_id);
	$(window).trigger('resize');
}
</script>