<?php $this->load->view("templates/header"); ?>



<div class="secondary_page_wrapper">

				<div class="container">

					<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

					<ul class="breadcrumbs">

						<li><a href="<?php echo base_url(); ?>">หน้าหลัก</a></li>
						<li><a href="<?php echo base_url("store"); ?>">บัญชีร้านค้า</a></li>
						<li><a href="<?php echo base_url("store/products"); ?>">จัดการสินค้า</a></li>
						<li>ตัวเลือกสินค้า</li>
						

					</ul>

					<!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->

					<div class="row">

						<?php $this->load->view("store/templates/left_tab"); ?>

						<main class="col-md-9 col-sm-8 padding-l-0">

							<h2>จัดการตัวเลือกสินค้า</h2>

							<!-- - - - - - - - - - - - - - Products - - - - - - - - - - - - - - - - -->

							<div class="section_offset">

								<header class="top_box on_the_sides">
									<div class=" col-md-4 pull-left ">
										<?php
											//if(count($main_products)) echo $main_products[0]->product_name; 
										?>
									</div>
									<div class="right_side col-md-4 pull-right ">
										<a href="<?php echo site_url("store/products/addrelate/".$main_product_id); ?>" class="btn-block button_blue middle_btn text-center"><i class="icon-plus"></i>เพิ่มตัวเลือกสินค้าใหม่</a>

									</div>

								</header>

								<div class="table_layout" id="products_container">
									<div class="table_row">

									<?php
										
										//$mode_list = $this->model_productmanager->getProductMode();
										foreach($products as $row){
											$product_id = $row->product_id;
											$store_id = $row->store_id;
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
									
										<div class="col-md-3 col-sm-4 table_cell shop_pd_list_wrap">
											<div class="product_item">
												<div class="image_wrap">
                                                	<?php if($promo->promo_type == 2){ ?>
                                                    <div class="label_hot">สินค้าร่วมโปรโมชั่น</div>
                                                    <?php } ?>
													<img src="<?php echo $default_image; ?>" alt="<?php echo $product_name; ?>">
													<div class="status_approve_product">
														<?php echo $product_name; ?>
													</div>

												</div>
												<div class="clearfix product_info">

													<p class="product_price alignleft"><s>฿<?php echo number_format($product_price,2); ?></s> <b>฿<?php echo number_format($product_price_discount,2); ?></b></p>

												</div>
												<div class="description shop_pd_list_title">

													
                                                    <div class="clearfix product_info">
														<p class="">SKU <?php echo $product_version; ?></p>
													</div>
                                                     <div class="clearfix product_info">
														<p class="label <?php echo $status_label; ?>"><?php echo $status_text; ?></p>
													</div>
													

												</div>
												<div class="clearfix"></div>

												<div class="row">
													<div class="col-xs-12">
														<a href="<?php echo base_url("store/products/settingRelate/".$product_id); ?>" class="btn-block button_blue text-center"><i class="icon-cog-1"></i>ตั้งค่าการขาย</a>
													</div>
                                                    
													<div class="clearfix"></div>
													<div class="col-md-6">
														<a href="<?php echo site_url("store/products/edit/".$product_id); ?>" class="btn-block button_grey text-center">แก้ไขชื่อ</a>
													</div>
													<div class="col-md-6">
														<button onClick="delProduct(<?php echo $product_id; ?>);" class="btn-block button_dark_grey text-center">ลบ</button>
													</div>
													
												</div>
											</div>
										</div>
                                        
                                        
										<!-- - - - - - - - - - - - - - End of product - - - - - - - - - - - - - - - - -->


									

									<?php } ?>

									</div><!--/ .table_row -->

								</div><!--/ .table_layout -->

								<footer class="bottom_box on_the_sides">

									<div class="left_side">

										<p><?php echo $page_showing; ?></p>

									</div>

									<div class="right_side">
										<?php echo $pagination ?>  
										<!--<ul class="pags">
											
											<li><a href="#"></a></li>
											<li class="active"><a href="#">1</a></li>
											<li><a href="#">2</a></li>
											<li><a href="#">3</a></li>
											<li><a href="#"></a></li>

										</ul>-->

									</div>

								</footer>

							</div>

							<!-- - - - - - - - - - - - - - End of products - - - - - - - - - - - - - - - - -->

						</main><!--/ [col]-->

					</div><!--/ .row-->

				</div><!--/ .container-->

			</div><!--/ .page_wrapper-->
        


<?php $this->load->view("templates/footer"); ?>
<?php $this->load->assets_by_name("left_tab","js"); ?>
<?php $this->load->assets_by_name("Products"); ?>
