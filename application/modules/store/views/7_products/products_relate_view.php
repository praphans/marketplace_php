<?php $this->load->view("templates/header"); ?>



<div class="secondary_page_wrapper">

				<div class="container">

					<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

					<ul class="breadcrumbs">

						<li><a href="<?php echo base_url(); ?>" class="notcursor">หน้าหลัก</a></li>
						<li><a href="<?php echo base_url("store"); ?>" class="notcursor">บัญชีร้านค้า</a></li>
						<li><a href="<?php echo base_url("store/products"); ?>" class="notcursor">จัดการสินค้า</a></li>
						<li>ตัวเลือกสินค้า</li>
						

					</ul>

					<!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->

					<div class="row">

						<?php $this->load->view("store/templates/left_tab"); ?>

						<main class="col-md-9 col-sm-8 padding-l-0">
							<div class="section_offset">

	                            <div class="row">

	                                <section class="col-sm-12">
	                                    <div class="theme_box">
		                                    <h3>จัดการตัวเลือกสินค้า</h3>
		                                    
		                                    <!-- - - - - - - - - - - - - - Tabs v2 - - - - - - - - - - - - - - - - -->
		                                    <div class="row">
		                                        <div class=" col-md-4 pull-left ">
													<?php
														//if(count($main_products)) echo $main_products[0]->product_name; 
													?>
												</div>
												<div class="right_side col-md-4 pull-right ">
													<a href="<?php echo site_url("store/products/addrelate/".$main_product_id); ?>" class="btn-block button_blue middle_btn text-center"><i class="icon-plus"></i>เพิ่มตัวเลือกสินค้าใหม่</a>
												</div>
		                                    </div>
			                                <?php 
		                                   
		                                    if(count($products)>0){
			                                    $origi_product_id = 0;
												$origi_product_name ="";
												$origi_product_code = "";
												$origi_images = "";
												$origi_default_image = "";
												$products_origi = $this->model_product->getProductByID($main_product_id);
												foreach($products_origi as $row){
													$origi_product_id = $row->product_id;
													$origi_product_name = $row->product_name;
													$origi_product_code = $row->product_code;
											

													$origi_images = $this->model_productmanager->getProductImageList($origi_product_id);
													$origi_default_image = (count($origi_images))?base_url($origi_images[0]->image_url):base_url($this->productmanager->default_image());
												}
	                                                
	                                        ?>
		                                        <div class="row">
		                                        	<div class="col-md-4 pt-10">
		                                        		<div class="row">
		                                        			<div class="col-md-12">
		                                        				<img src="<?php echo $origi_default_image; ?>" width="200">
		                                        			</div>
		                                        		</div>
		                                        	</div>
		                                        	<div class="col-md-8 pt-10">
		                                        		<div class="row">
		                                        			<div class="col-md-12 pt-10">
				                                                <label class="font-weight-bold"></label><?php echo $origi_product_name; ?>
				                                            </div>
				                                            <div class="col-md-12 pt-10">
				                                                <label class="font-weight-bold">รหัส SKU :</label> <?php echo $origi_product_code; ?>
				                                            </div>
		                                        		</div>
		                                        	</div>

		                                        	
		                                        	
		                                            
		                                        </div>
		                                        <div class="row pt-10">
		                                            <div class="col-md-12 pb-xs-20">
		                                                <div class="table_wrap">
		                                                    <table class="table_type_1 shopping_cart_table">
		                                                        <thead>
		                                                            <tr>
		                                                                <th width="70px;" class="text-md-center-left">ชื่อสินค้า</th>
		                                                                <th width="100px;" class="text-md-center-left">ราคา</th>
		                                                                <th width="50px;" class="text-md-center-left">ตั้งค่าการขาย</th>
		                                                                <th width="60px;" class="text-md-center-left">แก้ไขชื่อ</th>
		                                                                <th width="50px;" class="text-md-center-left">ลบ</th>
		                                                            </tr>
		    
		                                                        </thead>
		    
		                                                        <tbody>
																	<?php 
																	foreach($products as $row){
																		$product_id = $row->product_id;
																		$store_id = $row->store_id;
																		$relate_id = $row->relate_id;
																		$product_name = $row->product_name;
																		$product_brand = $row->product_brand;
																		$product_version = $row->product_version;
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
																		$timestamp = $row->timestamp;
																		
																		$product_recommend_checked = ($product_recommend)?"checked":"";
																		$product_show_checked = ($product_show)?"checked":"";
																		
																		$images = $this->model_productmanager->getProductImageList($product_id);
																		$default_image = (count($images))?base_url($images[0]->image_url):base_url($this->productmanager->default_image());
																		
																		$promo = $this->utils->promotion_in_time($product_id);
																		if($promo->promo_price > 0)$product_price_discount = $promo->promo_price;
																		
																		if($product_status == 1){
																			$status_text = "ฉนับร่าง";
																			$status_label = "label-info";
																		}else if($product_status == 2){
																			$status_text = "รออนุมัติ";
																			$status_label = "label-warning";
																		}else if($product_status == 3){
																			$status_text = "อนุมัติแล้ว";
																			$status_label = "label-success";
																		}else{
																			$status_text = "ไม่อนุมัติ";
																			$status_label = "label-danger";
																		}
		                                                                
		                                                            ?>
		                                                            <tr>
		                                                                <td> <?php echo $product_name; ?> </td>
		                                                                <td> <p class="product_price alignleft"><s>฿<?php echo number_format($product_price,2); ?></s> <b>฿<?php echo number_format($product_price_discount,2); ?></b></p> </td>
		                                                                <td> <a href="<?php echo base_url("store/products/settingRelate/".$product_id); ?>" class="btn-block button_blue text-center"><i class="icon-cog-1"></i>ตั้งค่าการขาย</a>
		                                                                </td>
		                                                                <td> <a href="<?php echo site_url("store/products/editRelate/".$product_id); ?>" class="btn-block button_grey text-center">แก้ไขชื่อ</a>
		                                                                </td>
		                                                                <td> 
		                                                                	<button onClick="delProductRelate(<?php echo $product_id;?>,<?php echo $relate_id;?>);" class="btn-block button_dark_grey text-center">ลบ</button>
		                                                                </td>
		                                                            </tr>
		                                                            
		                                                            <?php } ?>
		                                                        </tbody>
		                                                    </table>
		                                                </div>
		                                            </div>
		                                        </div>
		                                        <hr>    
		                                    <?php } ?>         
		                                </div>
	                                </section>
	                                <!--/ [col]-->
	                            </div>
	                            <!--/ .row -->
	                            <footer class="bottom_box on_the_sides">

									<div class="left_side">

										<p><?php echo $page_showing; ?></p>

									</div>

									<div class="right_side">
										<?php echo $pagination ?>  
									</div>

								</footer>

	                        </div>
	                        <!--/ .section_offset -->



							

							<!-- - - - - - - - - - - - - - End of products - - - - - - - - - - - - - - - - -->

						</main><!--/ [col]-->

					</div><!--/ .row-->

				</div><!--/ .container-->

			</div><!--/ .page_wrapper-->
        


<?php $this->load->view("templates/footer"); ?>
<?php $this->load->assets_by_name("left_tab","js"); ?>
<?php $this->load->assets_by_name("Products"); ?>
