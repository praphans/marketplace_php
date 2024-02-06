<?php $this->load->view("templates/header"); ?>

<style type="text/css">

	.desktop-only{
		display:none; 
	}
	@media only screen and (max-width: 600px) {

		.dasktop-only{
			display:none !important;
		}
	}
</style>

<div class="secondary_page_wrapper">

				<div class="container">

					<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

					<ul class="breadcrumbs">

						<li><a href="<?php echo base_url(); ?>" class="notcursor">หน้าหลัก</a></li>
						<li><a href="<?php echo base_url("store/itemstores/order/all"); ?>" class="notcursor">บัญชีร้านค้า</a></li>
						<li><a href="<?php echo base_url("store/itemstores/order/all"); ?>" class="notcursor">รายการระหว่างร้านค้า</a></li>
						<li>รายการทางบัญชี</li>

						

					</ul>

					<!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->

					<div class="row">

						<?php $this->load->view("store/templates/left_tab"); ?>
						
                        <?php
						$amount_total = 0;
						foreach($orders as $row){
							$amount_total = $row->amount_total;
						}
						?>
                        
                        
                        <main class="col-md-9 col-sm-8">
							<div class="theme_box pb-0">
								    <div class="row">
											<div class="col-md-12 col-sm-12 col-xs-12 clearfix search bg-white">
													<a href="<?php echo base_url("store/itemstores/order/all"); ?>" class="button_blue alignleft">
														<i class="icon-left-open pt-5"></i>
													</a>
													<div class="open_categories-remake font-icon "> 
													<label class="pt-l-20"><h4><?php echo $store_name; ?> </h4></label>	</div>
											</div><!--/ #search-->
											<div class="col-md-3 col-sm-3 col-xs-2 pull-right ">
												<a href="<?php echo base_url("message/create/3/0/0/".$depositor_store_id); ?>" class="button_blue btn-block mini_btn btn-message-mini"><span class="icon-comment"></span><span class="dasktop-only">ส่งข้อความ</span></a>
											</div>
											<div class="col-md-12 col-sm-12 col-xs-12">
												<div class="">
														<div class="row padding_all_15">
																<div class="col-md-4">ยอดคงเหลือสุทธิ</div>
																<div class="col-md-4 col-md-offset-4 main-nav"><?php echo number_format($amount_total,2); ?> บาท</div>
														</div>
                                                        <div class="row padding_all_15">
																<form action="<?php echo base_url("store/itemstores/accountpayment"); ?>" method="post">
                                                                <div class="col-md-9 col-sm-6 col-xs-12">
                                                                   <input type="number" min="1" name="amount" class="form-control h-15" placeholder="ระบุจำนวนเงินแจ้งชำระบัญชี" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                                                   <input type="hidden" name="seller_store_id" value="<?php echo $depositor_store_id; ?>">
                                                                   <input type="hidden" name="depositor_store_id" value="<?php echo $seller_store_id; ?>">
                                            					</div>
																<div class="col-md-3 col-sm-6 col-xs-12">
                                                                  <button class="button_blue " type="submit">แจ้งชำระบัญชี</button>
                                                               </div>
                                                               </form>
														</div>
												</div>
										  
											</div>
								
												  
										</div>
							</div>
                            
               
							<div class="theme_box ">
									<section class="section_offset">
										<div class="row">
												<section class="col-md-12 col-sm-12 col-xs-12">
									
														<h4>รายการทางบัญชี</h4>
						
														<!-- - - - - - - - - - - - - - Tabs v2 - - - - - - - - - - - - - - - - -->
						
                                                 
                                                        <div class="table_wrap">
                                                            <table class="table_type_1 shopping_cart_table">
                                                                <thead>
                                                                    <tr>
                                                                        
                                                                        <th class="text-md-center-left">วันที่ เวลา</th>
                                                                        <th class="text-md-center-left">รหัสคำสั่งซื้อ</th>
                                                                        <th class="text-md-center-left">รายการ</th>
                                                                        <th class="text-md-center-left">จำนวนเงิน</th>
                                                                        <th class="text-md-center-left">ตัวเลือก</th>
                                                                    </tr>
                                
                                                                </thead>
                                
                                                                <tbody>
                                                                
                                                                	
                                                                    <?php
																		foreach($orders as $row){
																			$tran_id = $row->tran_id;
																			$tran_type = $row->tran_type;
																			$order_code = $row->order_code;
																			$request_place_id = $row->request_place_id;
																			$seller_store_id = $row->seller_store_id;
																			$depositor_store_id = $row->depositor_store_id;
																			$amount = $row->amount;
																			$amount_total = $row->amount_total;
																			$tran_status = $row->tran_status;
																			$tran_type = $row->tran_type;
																			$timestamp = $row->timestamp;
																			
																			$type_name = '-';
																			$trans = $this->model_itemstores->getTranType($tran_type);
																			if(count($trans)>0)$type_name = $trans[0]->type_name;
																			
																			$place_name = "-";
																			$places = $this->model_itemstores->getPlaceByID($request_place_id);
																			if(count($places)) $place_name = $places[0]->place_name;
																			if($amount <= 0){
																				$is_creditor = "";
																				$btn_text_type = "รายละเอียด";
																				$btn_text_class = "btn-success";
																			}else{
																				$is_creditor = "+";
																				$btn_text_type = "รายละเอียด";
																				$btn_text_class = "btn-success";
																			}
																			
																			$color = "#777";
																			if($tran_status == 0 && $tran_type == 4){
																				$color = "#d72c17";
																				$type_name = 'รอยืนยันชำระบัญชี';
																			}else if($tran_status == 1 && $tran_type == 4){
																				$color = "#2d82c1";
																			}
																			
																			$display_store_id = $depositor_store_id;
																				
																			$store_in_order = $this->model_itemstores->getStoreByID($display_store_id);
																			
																			$name = "-";
																			$store_name = "";
																			foreach($store_in_order as $s){
																				$first_name = $s->first_name;
																				$last_name = $s->last_name;
																				$store_url = $s->store_url;
																				$store_avatar = $s->store_avatar;
																				$store_name = $s->store_name;
																				$store_code = $s->store_code;
																				$name = $first_name." ".$last_name;
																			}
																			
																			
																	?>
                                                                            
                                                                    <tr>
                                                                        <td  data-title="วันที่ เวลา" valign="middle">
                                                                            <div class="row">
                                                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                                                    <?php echo $this->utils->getThaiDate($timestamp); ?>
                                                                                </div>
                                                                            </div>  
                                                                        </td>
                                                                       
                                                                        <td class="" data-title="รหัสคำสั่งซื้อ" valign="middle">
                                                                            <div class="row">
                                                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                                                        <label><a href="<?php echo base_url("store/saleitem/orderinfo/".$order_code); ?>" target="_blank"><?php echo $order_code; ?></a></label>
                                                                                </div>
                                                                            </div>      
                                                                        </td>
                                                                        <td class="รายการ" data-title="รายการ" valign="middle">
                                                                            <div class="row">
                                                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                                                    <label class="pt-5 padd-t-0"><span style="color:<?php echo $color; ?>"><?php echo $type_name; ?></span></label>
                                                                                </div>
                                                                            </div>
                                                                        </td>  
                                                                        <td class="text-right" class="main-nav " data-title="ยอดชำระ" valign="middle" >
                                                                                <label class="pt-5 padd-t-0 "><span style="color:<?php echo $color; ?>"><?php echo $is_creditor."".number_format($amount,2); ?></span></label>
                                                                        </td> 
                                                                        <td class="รายการ" data-title="รายการ" valign="middle">
                                                                          
                                                                          <?php if($tran_type == 4 && $tran_status == 0 && $amount < 0){ ?>
                                                                           <a href="<?php echo base_url("store/itemstores/confirmPayment/".$tran_id); ?>" class="btn-sm button_blue middle_btn" type="submit">ยืนยัน</a>
                                                                           <?php } ?>
                                                                        </td>  
                                                                    </tr>
                                                                    
                                                                    <?php } ?>
                                                                    
                                                                    
                                                                </tbody>
                                                            </table>
                                                            
                                                        </div><!--/ .table_wrap -->
                                                        <footer class="bottom_box on_the_sides">
										
																			<div class="left_side">
                                                                                <p><?php //echo $page_showing; ?></p>
                                                                            </div>
                                                                        
                                                                            <div class="right_side">
                                                                                <?php echo $pagination ?>  
                                                                            </div>
										
																	</footer>
						
													</section>
										
										
										</div>
									</section><!--/ .section_offset -->
							</div>

						</main><!--/ [col]-->
                       

					</div><!--/ .row-->

				</div><!--/ .container-->

			</div><!--/ .page_wrapper-->

<?php $this->load->view("templates/footer"); ?>
<?php $this->load->assets_by_name("left_tab"); ?> 
<?php //$this->load->assets_by_name('Itemstores'); ?>
<script>

var depositor_store_id = "<?php if(isset($depositor_store_id)) echo $depositor_store_id; ?>";
$(document).ready(function(){
	console.log($(".pagination a").length);
	$(".pagination a").each(function(){
		var page_number = $(this).attr('data-ci-pagination-page');
		var url = config.base_url+"store/itemstores/info/"+depositor_store_id+"/"+page_number;
		$(this).attr("href",url);
	});
});
</script>