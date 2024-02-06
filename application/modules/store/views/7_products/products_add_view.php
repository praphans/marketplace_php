<?php $this->load->view("templates/header"); ?>
<link href="<?php echo base_url("assets/css/summernote.css"); ?>" rel="stylesheet">
<style>
.modal-content input[type="file"] {
	display:block !important;
}
</style>

<div class="secondary_page_wrapper">

				<div class="container">

					<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

					<ul class="breadcrumbs">

						<li><a href="<?php echo base_url(); ?>" class="notcursor">หน้าหลัก</a></li>
						<li><a href="#" class="notcursor">บัญชีร้านค้า</a></li>
						<li><a href="#" class="notcursor">จัดการสินค้า</a></li>
						<li>เพิ่มสินค้าใหม่</li>

					</ul>

					<!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->

					<div class="row">

						<?php $this->load->view("store/templates/left_tab"); ?> 
                       
                        <form id="form_product_add" class="type_2" action="<?php echo base_url('store/products/createProduct'); ?>" method="post" enctype="multipart/form-data">
						<main class="col-md-9 col-sm-8 padding-l-0">

							<h2>เพิ่มสินค้าใหม่</h2>

							<div class="theme_box">
								<div class="row">
									<div class="col-xs-12">
										<h4><i class="icon-picture-4"></i>เพิ่มรูปสินค้า</h4>
									</div>
									<div class="col-md-3 col-sm-6 pd_add_img_box">
										<label for="product_image" class="btn-block button_grey middle_btn text-center custom-file-upload">
                                                <i class="icon-plus"></i> เพิ่มรูปสินค้า
                                        </label>
                                         <input id="product_image" type="file" name="product_image[]" multiple accept="image/png,image/gif,image/jpeg"/>
                                         
									</div>
                                    
                                    <div id="product_image_container">
                                        
									</div>
                                    
                                    
                                    
								</div>
								<div class="col-md-3 col-sm-6 ">
                                    	<small>ขนาดรูปภาพ 800x800 px</small>
                                    </div>
							</div>

							<!-- ข้อมูลสินค้า -->

							<div class="theme_box">
								<div class="row">
									<div class="col-xs-12">
										<h4><i class="icon-doc-new"></i>เพิ่มข้อมูลทั่วไปของสินค้า</h4>
									</div>
									<div class="col-xs-12">
										
											<ul>

												<li class="row pt-20">
													<div class="col-xs-12">
														<label for="product_name" class="required">ชื่อสินค้า</label>
														<input type="text" name="product_name" id="product_name" class="form-control" placeholder="กรุณาระบุชื่อสินค้า" required>
													</div>
												</li>

												<li class="row pt-20">
													<div class="col-xs-12">
														<label for="product_brand">แบรนด์</label>
														<input type="text" name="product_brand" id="product_brand" class="form-control"  placeholder="กรุณาระบุยี่ห้อหรือแบรนด์สินค้า">
													</div>
												</li>

												<li class="row pt-20">
													<div class="col-xs-12">
														<label for="product_version">รุ่น</label>
														<input type="text" name="product_version" id="product_version" class="form-control" placeholder="กรุณาระบุรุ่นหรือเวอร์ชั่นของสินค้า">
													</div>
												</li>

												<li class="row pt-20">
													<div class="col-xs-12">
														<label class="required">ประเภทสินค้า</label>
														<div class="form_el">
                                                        	<?php
																	$product_type = $this->productmanager->getProductType();
																	$n = 0;
																	foreach($product_type as $row){
																		$checked = "";
																		$id = $row->id;
																		$type_name = $row->type_name;
																		if($n == 0){
																			$n++;
																			$checked = "checked";
																		}
																?>
															<input <?php echo $checked; ?> type="radio" name="product_type" id="product_type<?php echo $id; ?>" value="<?php echo $id; ?>" required>
															<label for="product_type<?php echo $id; ?>"><?php echo $type_name; ?></label>
															
                                                            <?php } ?>
                                                            
														</div>
													</div>
												</li>

												<li class="row pt-20">
													<div class="col-xs-12">
														<label class="required">หมวดหมู่หลัก</label>
														<div class="">
															<select  name="product_category" id="product_category" onchange="loadSubCategory();" class="form-control" required>
																<?php
																	$product_category = $this->productmanager->getProductCategory();
																	foreach($product_category as $row){
																		$id = $row->id;
																		$category_name = $row->category_name;
																	
																?>
																<option value="<?php echo $id; ?>"><?php echo $category_name; ?></option>
																<?php } ?>
															</select>
														</div>
													</div>
												</li>

												<li class="row pt-20" id="product_subcategory_row">
													<div class="col-xs-12">
														<label class="required">หมวดหมู่ย่อย</label>
														<div class="">
															<select name="product_subcategory" id="product_subcategory" class="form-control">
																<?php
																	$product_subcategory = $this->productmanager->getProductSubcategory();
																	foreach($product_subcategory as $row){
																		$id = $row->id;
																		$category_id = $row->category_id;
																		$category_name = $row->category_name;
																	
																?>
																<option value="<?php echo $id; ?>"><?php echo $category_name; ?></option>
																<?php } ?>
															</select>
														</div>
													</div>
												</li>

												<li class="row pt-20">
													
													<div class="col-xs-12">
														
														<label for="product_description" class="required">รายละเอียดสินค้า</label>
														<textarea name="product_description" id="product_description" class="form-control" required></textarea>

													</div><!--/ [col] -->

												</li><!--/ .row -->

											</ul>

									</div>
								</div>
								
							</div>

							<footer class="bottom_box on_the_sides">

								<div class="col-md-4 col-xs-12">

									<a href="<?php echo base_url("store/products"); ?>" class="btn-block button_dark_grey  middle_btn"><i class="icon-cancel-2"></i> ยกเลิก</a>

								</div>

								<div class="col-md-4 col-xs-12">

									<button type="submit" name="product_status" value="1" class="btn-block button_blue middle_btn"><i class="icon-layers"></i> บันทึกเป็นฉบับร่าง</button>

								</div>

								<div class="col-md-4 col-xs-12">

									<button type="submit" name="product_status" value="2" class="btn-block button_blue middle_btn"><i class="icon-check-1"></i> ขออนุมัติ</button>

							</footer>

						</main><!--/ [col]-->
                        </form>

					</div><!--/ .row-->

				</div><!--/ .container-->

			</div><!--/ .page_wrapper-->
        


<?php $this->load->view("templates/footer"); ?>
<?php $this->load->assets_by_name("left_tab"); ?> 
<?php $this->load->assets_by_name("Products"); ?>

<script type="text/javascript" src="<?php echo base_url("assets/js/summernote.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/summernote-th-TH.js"); ?>"></script>
<script>
$('#product_description').summernote({
        placeholder: 'ระบุรายละเอียดสินค้าหรือการบริการ',
		lang: "th-TH",
	 	toolbar: [
			["font", ["bold", "underline", "clear"]],
			["color", ["color"]],
			["para", ["ul", "ol", "paragraph"]],
			["insert", ["link", "picture", "video"]]
		],
});
</script>
