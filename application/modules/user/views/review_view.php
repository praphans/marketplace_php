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
                                    data-target="#review_tab" aria-expanded="false" aria-controls="review_tab">
                                            รีวิวของฉัน<span class="caret"></span>
                                    </button>
                                </div>
                                <aside class="col-md-3 col-sm-4 collapse pl-0 pr-0" id="review_tab">
                                    <section class="section_offset">
                                        <ul class="theme_menu tabs_nav clearfix pb-5">
                                            <li><a href="<?php echo base_url("user/review/list"); ?>">รอการรีวิว</a></li>
                                            <li><a href="<?php echo base_url("user/review/history"); ?>">ประวัติการรีวิว</a></li> 
                                        </ul>
                                    </section>
                                </aside>

                                <ul class="tabs_nav clearfix mobile_only_hide">

                                    <li><a href="<?php echo base_url("user/review/list"); ?>">รอการรีวิว</a></li>
                                    <li><a href="<?php echo base_url("user/review/history"); ?>">ประวัติการรีวิว</a></li> 

                                </ul>
                                
                                <div class="tab_containers_wrap">

                                    <div id="wait_Review" class="tab_container_not_use">
                                    
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
												$store_id = $sell_store_id = $row->store_id;
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
												$timestamp = $row->timestamp;
												
												$status_name = "";
												$status = $this->model_user->getOrderStatus($order_status);
												if(count($status))$status_name = $status[0]->status_name;
												
												$product_in_order = $this->model_user->getOrderByOrderCode($order_code);
												$store_in_order = $this->model_user->getStoreByID($store_id); // ผู้ขาย
												$store_place_in_order = $this->model_review->getOrderStorePlaceID($order_place_id); // ผู้ส่ง
												
												
												$sell_store = $this->model_user->getStoreByID($store_id); 
												foreach($sell_store as $ss){
													$first_name = $ss->first_name;
													$last_name = $ss->last_name;
													$sell_store_url = $ss->store_url;
													$sell_store_avatar = $ss->store_avatar;
													$sell_name = $first_name;//$last_name;
												}

                                                $depositor = $this->model_delivery->getStoreByID($depositor_store_id);
                                                $depositor_name = "-";
                                                $depositor_url = "";
                                                foreach($depositor as $s){
                                                    $depositor_url = base_url($s->store_url);
                                                    $depositor_name = $s->store_name;
                                                }
													
													
												$name = "-";
												foreach($store_in_order as $s){
													$first_name = $s->first_name;
													$last_name = $s->last_name;
													$name = $first_name;//$last_name;

                                                    $store_url = base_url($s->store_url);
                                                    $store_name = $s->store_name;
												}
												
												$agent_name = "-";
												$agent_store = $this->model_user->getStoreByID($depositor_store_id); 
												foreach($agent_store as $ss){
													$agent_store_id = $ss->store_id;
													$first_name = $ss->first_name;
													$last_name = $ss->last_name;
													$agent_store_url = $ss->store_url;
													$agent_store_avatar = $ss->store_avatar;
													$agent_name = $first_name;//$last_name;
												}
												
												
												$sell_already_reviewed = $this->model_review->getNumSellReview($order_id,$sell_store_id);
												$agent_already_reviewed = $this->model_review->getNumAgentReview($order_id,$depositor_store_id);
												
												$sell_message = "ส่งรีวิว";
												$agent_message = "ส่งรีวิว";
												$sell_already_reviewed = ($sell_already_reviewed)?"disabled":"";
												$agent_already_reviewed = ($agent_already_reviewed)?"disabled":"";
												if($sell_already_reviewed){
													$sell_message = "รีวิวเรียบร้อยแล้ว";
												}
												if($agent_already_reviewed){
													$agent_message = "รีวิวเรียบร้อยแล้ว";
												}
												
										?>
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-6 col-md-4 pt-10">
                                                <label class="font-weight-bold">รหัสคำสั่งซื้อ : </label>
                                                <a href="<?php echo base_url("user/orderinfo/".$order_code); ?>" class="text-primary"><?php echo $order_code; ?></a>
                                            </div>
                                            <div class="col-xs-12 col-sm-6 col-md-4 pt-10">
                                                <label class="font-weight-bold">วันที่สั่งซื้อ : </label>
                                                 <?php echo $this->utils->getThaiDate($timestamp); ?>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-1 pt-10">
                                                <!-- contant -->
                                            </div>
                                            <!--<div class="col-xs-12 col-sm-12 col-md-3">
                                                <button class="w-100 button_dark_grey"><i class="icon-trash"></i> ลบรายการ</button>
                                            </div>-->
                                            
                                        </div>
                                        
                                        <div class="row pt-20">
                                            <div class="col-md-12 pt-5">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-2 col-md-2 text-xs-center-account">
                                                        ผู้ขาย
                                                    </div>
                                                    <div class="col-xs-12 col-sm-2 col-md-2 text-xs-center-account">
                                                        <a href="<?php echo base_url($sell_store_url); ?>"><img src="<?php echo base_url($sell_store_avatar); ?>" alt="" class="account-md-photo"></a>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-4 col-md-5 text-xs-center-account">
                                                       <?php echo "<a href='".$store_url."' target='_blank'>".$store_name."</a>"; ?>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-4 col-md-3 text-xs-center-account">
                                                        <button data-toggle="modal" data-order_id="<?php echo $order_id; ?>" data-review_type="1" data-store_id="<?php echo $sell_store_id; ?>" data-product_id="<?php echo $product_id; ?>" data-target ="#modal_review" class="w-100 button_blue" <?php echo $sell_already_reviewed; ?>><i class="icon-paper-plane"></i> <?php echo $sell_message; ?></button>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <?php if($order_shipping_type_id == 2 && count($agent_store) > 0){ // ถ้าส่งที่ตัวแทนจะต้องมีชื่อผู้ส่ง ?>
                                            <div class="col-md-12 pt-5">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-2 col-md-2 text-xs-center-account">
                                                        ผู้ส่ง
                                                    </div>
                                                    <div class="col-xs-12 col-sm-2 col-md-2 text-xs-center-account">
                                                        <a href="<?php echo base_url($agent_store_url); ?>"><img src="<?php echo base_url($agent_store_avatar); ?>" alt="" class="account-md-photo"></a>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-4 col-md-5 text-xs-center-account">
                                                        <?php echo "<a href='".$depositor_url."' target='_blank'>".$depositor_name."</a>"; ?>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-4 col-md-3 text-xs-center-account">
                                                        <button data-toggle="modal" data-order_id="<?php echo $order_id; ?>" data-review_type="2" data-store_id="<?php echo $agent_store_id; ?>" data-product_id="<?php echo $product_id; ?>" data-target ="#modal_review" class="w-100 button_blue" <?php echo $agent_already_reviewed; ?>><i class="icon-paper-plane"></i> <?php echo $agent_message; ?></button>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>
                                            
                                            
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
												
												$porduct_already_reviewed = $this->model_review->getNumProductReview($order_id,$c_product_id);
												
												
												$message = "ส่งรีวิว";
												$porduct_already_reviewed = ($porduct_already_reviewed)?"disabled":"";
												if($porduct_already_reviewed){
													$message = "รีวิวเรียบร้อยแล้ว";
												}
												
											?>
                                                            
                                            <div class="col-md-12 pt-5">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-2 col-md-2 text-xs-center-account">
                                                        สินค้า
                                                    </div>
                                                    <div class="col-xs-12 col-sm-2 col-md-2 text-xs-center-account">
                                                        <a href="<?php echo $link; ?>"><img src="<?php echo base_url($product_image); ?>" alt="" class="account-md-photo"></a>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-4 col-md-5 text-xs-center-account">
                                                       <?php 
                                                        if(strlen($product_name) > 60){
                                                            echo iconv_substr($product_name,0,40,"UTF-8")."...";
                                                        }else{
                                                            echo iconv_substr($product_name,0,40,"UTF-8");
                                                        }
                                                       ?>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-4 col-md-3 text-xs-center-account">
                                                        <button data-toggle="modal" data-order_id="<?php echo $order_id; ?>" data-review_type="3" data-product_id="<?php echo $c_product_id; ?>" data-store_id="<?php echo $sell_store_id; ?>" data-target ="#modal_review" class="w-100 button_blue" <?php echo $porduct_already_reviewed; ?>><i class="icon-paper-plane"></i> <?php echo $message; ?></button>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <?php } ?>
                                            
                                            
                                        </div><hr class="pb-20">

                                        <?php } ?>
                                        

                                    </div><!--/ #wait_Review-->

                                    

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
            
<?php $this->load->view("user/modals/modal_review"); ?>           
<?php $this->load->view("templates/footer"); ?>
<?php $this->load->assets_by_name("User"); ?>
<?php $this->load->assets_by_name('Left_tab'); ?>
<script>
$('#modal_review').on('show.bs.modal', function(e) {
    var order_id = $(e.relatedTarget).data('order_id');
	var store_id = $(e.relatedTarget).data('store_id');
	var product_id = $(e.relatedTarget).data('product_id');
	var review_type = $(e.relatedTarget).data('review_type');
	
	console.log("order_id : "+order_id);
	console.log("review_type : "+review_type);
	console.log("store_id : "+store_id);
	console.log("product_id : "+product_id);
	console.log("-----------------------------------");
	
   $("#order_id").val(order_id);
   $("#store_id").val(store_id);
   $("#product_id").val(product_id);
   $("#review_type").val(review_type);
});
</script>