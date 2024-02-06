<?php $this->load->view("templates/header"); ?>



<div class="secondary_page_wrapper">

				<div class="container">

					<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

					<ul class="breadcrumbs">

						<li><a href="<?php echo base_url(); ?>" class="notcursor">หน้าหลัก</a></li>
						<li><a href="<?php echo base_url('store'); ?>" class="notcursor">บัญชีร้านค้า</a></li>
						<li>รายการระหว่างร้านค้า</li>
						

					</ul>

					<!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->

					<div class="row">

						<?php $this->load->view("store/templates/left_tab"); ?>

						<main class="col-md-9 col-sm-8">
							<div class="theme_box">
									<section class="section_offset">
										<div class="row">
												<section class="col-md-12 col-sm-12 ">
									
														<h4>รายการระหว่างร้านค้า</h4>
						
														<!-- - - - - - - - - - - - - - Tabs v2 - - - - - - - - - - - - - - - - -->
						
														<div class="tabs type_2 initialized">
						
															<!-- - - - - - - - - - - - - - Navigation of tabs - - - - - - - - - - - - - - - - -->
															<div class="mobile_only_show">
																<button class="button_grey_outline btn-block text-left" type="button" data-toggle="collapse" 
																data-target="#item_tab" aria-expanded="false" aria-controls="item_tab">
																        รายการระหว่างร้านค้า<span class="caret"></span>
																</button>
															</div>
															<aside class="col-md-3 col-sm-4 collapse pl-0 pr-0" id="item_tab">
															    <section class="section_offset">
															        <ul class="theme_menu tabs_nav clearfix pb-5">
															            <li><a href="<?php echo base_url("store/itemstores/order/all"); ?>">ทั้งหมด</a></li>
																		<li><a href="<?php echo base_url("store/itemstores/order/creditor"); ?>">เจ้าหนี้</a></li>
																		<li><a href="<?php echo base_url("store/itemstores/order/debtor"); ?>">ลูกหนี้</a></li>
															        </ul>
															    </section>
															</aside>

															<ul class="tabs_nav clearfix mobile_only_hide">
																<?php 
																	$all_active = "";
																	$creditor_active = "";
																	$debtor_active = "";
																	if($filter == "all"){
																		$all_active = "active";
																	}else if($filter == "creditor"){
																		$creditor_active = "active";
																	}else if($filter == "debtor"){
																		$debtor_active = "active";
																	}
																?>
													
																<li class="<?php echo $all_active; ?>"><a href="<?php echo base_url("store/itemstores/order/all"); ?>">ทั้งหมด</a></li>
																<li class="<?php echo $creditor_active; ?>"><a href="<?php echo base_url("store/itemstores/order/creditor"); ?>">เจ้าหนี้</a></li>
																<li class="<?php echo $debtor_active; ?>"><a href="<?php echo base_url("store/itemstores/order/debtor"); ?>">ลูกหนี้</a></li>

						
															</ul>
														
															<!-- - - - - - - - - - - - - - End navigation of tabs - - - - - - - - - - - - - - - - -->
						
															<!-- - - - - - - - - - - - - - Tabs container - - - - - - - - - - - - - - - - -->
						
															<div class="tab_containers_wrap">
																
																<!-- - - - - - - - - - - - - - Tab - - - - - - - - - - - - - - - - -->
						
																<div id="tab-7" class="tab_container_not_use">
																	<div class="row pb-10">
                                                                    		<form class="type_2" action="<?php echo base_url("store/itemstores/order/".$filter); ?>" method="post">
																			<div class="col-md-10">
																					<input type="text" name="keyword_code" placeholder="พิมพ์ ชื่อร้านค้า ชื่อสถานที่ " class="alignleft">
																			</div>
																			<div class="col-md-2 col-sm-12 col-xs-12 tp-5">
																					<button type="submit" class="w-100 button_blue middle_btn"> ค้นหา</button>
																			</div>
                                                                            </form>
																	</div>
																	<div class="table_wrap">
																		<table class="table_type_1 shopping_cart_table">
																			<thead>
																				<tr>
																					
																					<th class="text-md-center-left">ชื่อร้านค้า</th>
																					<th class="text-md-center-left">ยอดคงเหลือ (บาท)</th>
																					<th class="text-md-center-left">ตัวเลือก</th>
																				</tr>
											
																			</thead>
											
																			<tbody>
																				<?php
																				foreach($orders as $row){
																					$tran_id = $row->tran_id;
																					$order_code = $row->order_code;
																					$request_place_id = $row->request_place_id;
																					$seller_store_id = $row->seller_store_id;
																					$depositor_store_id = $row->depositor_store_id;
																					$amount = $row->amount;
																					$amount_total = $row->amount_total;
																					$place_name = "-";
																					$places = $this->model_itemstores->getPlaceByID($request_place_id);
																					if(count($places)) $place_name = $places[0]->place_name;
																					if($amount_total <= 0){
																						$is_creditor = "-";
																						$btn_text_type = "รายละเอียด";
																						$btn_text_class = "btn-success";
																					}else{
																						$is_creditor = "+";
																						$btn_text_type = "รายละเอียด";
																						$btn_text_class = "btn-success";
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
																					<td data-title="<?php echo $store_name; ?>" class="pr-10 pl-10 pt-t-0 padding-b-0" valign="middle">
																						<div class="row  pt-10">
																							<div class="col-md-4 col-xs-12">
																								<a href="<?php echo base_url($store_url); ?>" class="alignleft photo">
																									<img class="" src="<?php echo base_url($store_avatar); ?>" alt="<?php echo $store_name; ?>">
																								</a>
																							</div>
																							<div class="col-md-8 col-xs-12 ">
																								<div class="wrapper">
																									<div class="pt-5">
																										<a class="clearfix text-primary" href="<?php echo base_url($store_url); ?>"><b><?php echo $store_name; ?></b></a>
																									</div>
																									<div class="">
																										<!-- <p><?php// echo $place_name; ?></p> -->
																									</div>
																									
																								</div>
																							</div>
																						</div>
																					</td>
																					<td class="product_image_col " data-title="ยอดชำระเงินระหว่างกัน">
																						<p class="text-align pt-10 mobile_only_hide"><?php echo number_format($amount_total,2); ?></p>
																						<p class="text-align pt-10 mobile_only_show">ยอดคงเหลือ <?php echo number_format($amount_total,2); ?> บาท</p>
																					
																					</td>
																					<td data-title="แจ้งชำระเงิน" align="center">
																						<a href="<?php echo base_url("store/itemstores/info/".$depositor_store_id."/1"); ?>" class="btn <?php echo $btn_text_class; ?>"><?php echo $btn_text_type; ?></a>
																					</td>
																				</tr>
                                                                                
                                                                                <?php } ?>
                                                                                
																			</tbody>
                                                                           <!-- <tfoot>
                                                                            <th class="text-md-center-left">ยอดรวม</th>
                                                                            <th class="text-md-center-left">30,00 บาท</th>
                                                                            <th class="text-md-center-left"></th>
                                                                            </tfoot>-->
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
																</div><!--/ #tab-7-->
						
																<!-- - - - - - - - - - - - - - End tab - - - - - - - - - - - - - - - - -->
						
																
						
																<!-- - - - - - - - - - - - - - End tab - - - - - - - - - - - - - - - - -->
						
															</div><!--/ .tab_containers_wrap -->
						
															<!-- - - - - - - - - - - - - - End of tabs containers - - - - - - - - - - - - - - - - -->
						
														</div><!--/ .tabs-->
														
														<!-- - - - - - - - - - - - - - End of tabs v2 - - - - - - - - - - - - - - - - -->
						
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
<?php $this->load->assets_by_name('itemstores'); ?>

