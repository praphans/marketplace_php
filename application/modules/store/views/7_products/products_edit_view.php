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
					<?php
						
						foreach($products as $row){
								$product_id = $row->product_id;
								$relate_id = $row->relate_id;
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
								$default_image = (count($images))?base_url($images[0]->image_url):$this->productmanager->default_image();
						}
					?>

					<ul class="breadcrumbs">

						<li><a href="<?php echo base_url(); ?>" class="notcursor">หน้าหลัก</a></li>
						<li><a href="<?php echo base_url('store'); ?>" class="notcursor">บัญชีร้านค้า</a></li>
						<li><a href="<?php echo base_url('store/products'); ?>" class="notcursor">จัดการสินค้า</a></li>
						<li>แก้ไขสินค้า</li>

					</ul>

					<!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->

					<div class="row">

						<?php $this->load->view("store/templates/left_tab"); ?> 
                       
                        <form id="form_product_edit" class="type_2" action="<?php echo base_url('store/products/updateProduct'); ?>" method="post" enctype="multipart/form-data">
						<main class="col-md-9 col-sm-8 padding-l-0">

							<h2>แก้ไขสินค้า</h2>

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
                                         <input type="hidden" name="product_id" value="<?php echo $product_id; ?>"/>
                                         <input type="hidden" name="relate_id" value="<?php echo $relate_id; ?>"/>
									</div>
                                    
                                    <div id="product_image_container">
                                    	<?php
											foreach($images as $row){
												$image_id = $row->id;
												$image_url = base_url($row->image_url);
											
										?>
                                        <div class="col-md-3 col-sm-6 pd_add_img_box" id="image_box<?php echo $image_id; ?>">
                                            <div class="image_wrap">
                                            	<button type="button" onClick="delImage(<?php echo $image_id; ?>);" class="btn-block button_grey middle_btn text-center"><i class="icon-trash"></i> ลบรูปนี้</button>
                                                <img src="<?php echo $image_url; ?>">
                                            </div>
                                        </div>
                                        
                                        <?php } ?>
                                        
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

												<li class="row">
													<div class="col-xs-12">
														<label for="product_name" class="required">ชื่อสินค้า</label>
														<input type="text" name="product_name" id="product_name" value="<?php echo $product_name; ?>" required>
													</div>
												</li>

												<li class="row pt-20">
													<div class="col-xs-12">
														<label for="product_brand">แบรนด์</label>
														<input type="text" name="product_brand" id="product_brand" value="<?php echo $product_brand; ?>" >
													</div>
												</li>

												<li class="row pt-20">
													<div class="col-xs-12">
														<label for="product_version">รุ่น</label>
														<input type="text" name="product_version" id="product_version" value="<?php echo $product_version; ?>" >
													</div>
												</li>

												<li class="row pt-20">
													<div class="col-xs-12">
														<label class="required">ประเภทสินค้า</label>
														<div class="form_el">
                                                        	<?php
																	$product_types = $this->productmanager->getProductType();
																	
																	foreach($product_types as $row){
																		$checked = "";
																		$id = $row->id;
																		$type_name = $row->type_name;
																		
																		if($id == $product_type){
																			$checked = "checked";
																		}
																?>
															<input <?php echo $checked; ?> type="radio" name="product_type" id="product_type<?php echo $id; ?>" value="<?php echo $id; ?>" required>
															<label for="product_type<?php echo $id; ?>"><?php echo $type_name; ?></label>
															
                                                            <?php } ?>
                                                            
														</div>
													</div>
												</li>

												<li class="row pt-20" >
													<div class="col-xs-12">
														<label class="required">หมวดหมู่หลัก</label>
														<div class="">
															<select  name="product_category" id="product_category" onchange="loadSubCategory();" required>
																<?php
																	$product_categorys = $this->productmanager->getProductCategory();
																	foreach($product_categorys as $row){
																		$checked = "";
																		$id = $row->id;
																		$category_name = $row->category_name;
																		if($id == $product_category){
																			$checked = "selected";
																		}
																	
																?>
																<option value="<?php echo $id; ?>" <?php echo $checked; ?>><?php echo $category_name; ?></option>
																<?php } ?>
															</select>
														</div>
													</div>
												</li>

												<li class="row pt-20" id="product_subcategory_row">
													<div class="col-xs-12">
														<label class="required">หมวดหมู่ย่อย</label>
														<div class="">
															<select name="product_subcategory" id="product_subcategory" >
																
															</select>
														</div>
													</div>
												</li>

												<li class="row pt-20">
													
													<div class="col-xs-12">
														
														<label for="product_description" class="required">รายละเอียดสินค้า</label>
														<textarea name="product_description" id="product_description" required> <?php echo $product_description; ?></textarea>

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

								</div>

							</footer>

						</main><!--/ [col]-->
                        </form>

					</div><!--/ .row-->

				</div><!--/ .container-->

			</div><!--/ .page_wrapper-->
        


<?php $this->load->view("templates/footer"); ?>
<?php $this->load->assets_by_name("left_tab"); ?> 

<script>
var product_subcategory = "<?php if(isset($product_subcategory)) echo $product_subcategory; ?>";
</script>
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