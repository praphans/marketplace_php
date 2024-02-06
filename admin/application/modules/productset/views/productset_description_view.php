
<?php 
	$this->load->view("templates/header");
	$this->load->assets('css');
?>

<?php 
foreach($product_discription as $row){
			$product_id 						= $row->product_id;
			$product_code 						= $row->product_code;
			$product_name 						= $row->product_name;
			$product_brand 						= $row->product_brand;
			$product_category					= $row->product_category;
			$product_description 				= $row->product_description;
			$product_qty 						= $row->product_qty;
			$product_price 						= $row->product_price;
			$product_price_discount 			= $row->product_price_discount;
			$product_percentage_discount		= $row->product_percentage_discount;
			$product_type 						= $row->product_type;
			$product_version 					= $row->product_version;
			$product_rating 					= $row->product_rating;
			$product_review 					= $row->product_review;
			$product_category 					= $row->product_category;
			$relate_id 							= $row->relate_id;

			$product_type_result 				= $this->model_productset->getproductTypeByID($product_type);
			$product_img_result 				= $this->model_productset->getproductImgByID($product_id);
			$product_category_result 			= $this->model_productset->getCategoryID($product_category);
			$product_review_result 				= $this->model_productset->getReviewByID($product_id);

			$type_name							= $product_type_result[0]->type_name;
			$category_name 						= $product_category_result[0]->category_name;
		} 

		if($relate_id == 0){
			$product_relate_id = $product_id;
		}else{
			$product_relate_id = $relate_id;
		}
		$relate_discription = $this->model_productset->getRelateByID($product_relate_id);

		$product_name_result = $this->model_productset->getProductNameByID($relate_id);
		if(count($product_name_result)>0){
			$product_relate = $product_name_result[0]->product_name;
			$product_name_relate = $product_relate."(".$product_name.")";
		}else{
			$product_name_relate = $product_name;
		}

?>



 <div class="page-wrapper mt-main-wrapper-70">
		<!-- ============================================================== -->
		<!-- Bread crumb and right sidebar toggle -->
		<!-- ============================================================== -->
		<div class="row page-titles">
			<div class="col-md-5 align-self-center">
				<h3 class="text-themecolor">รายละเอียดสินค้า </h3>
			</div>
			<div class="col-md-7 align-self-center">
				<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href='<?php echo base_url("productset"); ?>'>สินค้า</a></li>
				<li class="breadcrumb-item"> รายละเอียดสินค้า  </li>
				</ol>
			</div>
		</div>

	



		<div class="container-fluid">
			<!-- ============================================================== -->
			<!-- Start Page Content -->
			<!-- ============================================================== -->
			<!-- Row -->
			<div class="row pl-3 pr-3">
				<div class="col-lg-12 col-xlg-12 col-md-12">
					<div class="row">
						<div class="col-lg-4 col-xlg-3 col-md-5">
							<div class="card">
								<div class="card-body">
									<center> 
										<div class="row">
											<div class="col-lg-12 col-md-12 col-sm-12">
												<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
													<ol class="carousel-indicators">
														<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
														<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
														<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
													</ol>
													<div class="carousel-inner">
														<?php 
															foreach($product_img_result as $row){
																$image_url = $row->image_url;
																if(!empty($image_url)){
																	$images =  '../'.$image_url;
																}else{
																	$images = "";
																}
																
																
														?>
															<div class="carousel-item ">
																<img id="myImg" class="d-block w-100 " src="<?php echo base_url($images); ?>" onclick="imgModals();">
															</div>

															<!-- modals img -->
															<div id="myModal" class="modal">
																<span class="close text-light">&times;</span>
																<img class="modal-content" id="img01">
																<div id="caption"></div>
															</div>
															<!-- END modals img -->
														
														<?php } ?>
														<div class="carousel-item active">
															<?php 
																if(!empty($image_url)){
															?>
																<img id="myImg" class="d-block w-100 " src="<?php if(isset($images)) echo base_url($images); ?>" onclick="imgModals();">
															<?php 
																}else{
																$images2 =  '<img src="https://www.bormel-grice.com/sites/all/themes/riley_sub/img/nopicture.png" class="d-block w-100 "/>';
																echo $images2;
																}
															?>
															
														</div>
														

													</div>
													<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
														<span class="carousel-control-prev-icon" aria-hidden="true"></span>
														<span class="sr-only">Previous</span>
													</a>
													<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
														<span class="carousel-control-next-icon" aria-hidden="true"></span>
														<span class="sr-only">Next</span>
													</a>
													
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-12 col-md-12 col-sm-12 pt-3">
												<?php 
													foreach($relate_discription as $row){
														$product_relate = $row->product_id;
														$product_name = $row->product_name;

														$url_product_id = base_url("productset/productDescription/".$product_relate);
														if($product_relate == $product_id){
															$link_product_id = '<a href="'.$url_product_id.'" class="btn waves-effect waves-light btn-rounded btn-sm btn-success  mt-1">'.$product_name.'</a>';
														}else{
															$link_product_id = '<a href="'.$url_product_id.'" class="btn waves-effect waves-light btn-rounded btn-sm btn-outline-success mt-1">'.$product_name.'</a>';
														}
														

														echo $link_product_id;
													}
												?>
											</div>
										</div>
									</center>
								</div>
							</div>
						</div>
						<div class="col-lg-8 col-xlg-9 col-md-7">
							<div class="card">
								<div class="card-body"> 
									<div class="row">
										<div class="col-lg-12">
											<div class="ribbon-wrapper">
			                                	<h4 class="ribbon ribbon-bookmark ribbon-danger">ข้อมูลสินค้า</h4>
			                                </div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12">
											
										</div>
										<div class="col-lg-4">
											<small class="text-muted p-t-20 db">รหัสสินค้า</small>
											<h6 class="pt-1"><?php if(isset($product_code)) echo $product_code ?></h6>
										</div>
										<div class="col-lg-4">
											<small class="text-muted p-t-20 db">ชื่อสินค้า</small>
											<h6 class="pt-1"><?php if(isset($product_name_relate)) echo $product_name_relate ?></h6> 
										</div>
										<div class="col-lg-4">
											<small class="text-muted p-t-20 db">ยี่ห้อ</small>
											<h6 class="pt-1"><?php if(isset($product_brand)) echo $product_brand; ?></h6> 
										</div>
										<div class="col-lg-4">
											<small class="text-muted p-t-30 db">ชนิด</small>
											<h6 class="pt-1"><?php if(isset($type_name)) echo $type_name; ?></h6>
										</div>
										<div class="col-lg-4">
											<small class="text-muted p-t-30 db">รุ่น</small>
											<h6 class="pt-1"><?php if(isset($product_version))  echo $product_version; ?></h6> 
										</div>
										<div class="col-lg-4">
											<small class="text-muted p-t-30 db">ประเภทสินค้า</small>
											<h6 class="pt-1"><?php if(isset($category_name)) echo $category_name; ?></h6>
										</div>
										<div class="col-lg-4">
											<small class="text-muted p-t-30 db">ราคา (บาท)</small>
											<h6 class="pt-1"><?php if(isset($product_price))  echo $product_price; ?></h6> 
										</div>
										<div class="col-lg-4">
											<small class="text-muted p-t-30 db">ส่วนลด</small>
											<h6 class="pt-1"><?php if(isset($product_percentage_discount)) echo $product_percentage_discount."%"; ?></h6> 
										</div>
										<div class="col-lg-4">
											<small class="text-muted p-t-30 db">จำนวน</small>
											<h6 class="pt-1"><?php if(isset($product_qty)) echo $product_qty; ?></h6>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-12 pl-1 pr-1">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col-lg-12">
											<div class="ribbon-wrapper">
			                                	<h4 class="ribbon ribbon-bookmark ribbon-danger">รายละเอียดสินค้า</h4>
			                                	<h6 class="pt-3"><?php if(isset($product_description)) echo $product_description; ?></h6>
			                                </div>
										</div>
									</div>
								</div>
							</div>
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col-lg-12">
											<div class="ribbon-wrapper">
			                                	<h4 class="ribbon ribbon-bookmark ribbon-danger">รีวิวจากลูกค้า</h4>
			                                </div>
											<div class="comment-widgets m-b-20">
												<?php 
													foreach($product_review_result as $row){
														$review_rating	 = $row->review_rating;
														$review_content  = $row->review_content;
														$review_type 	 = $row->review_type;
														$review_status 	 = $row->review_status;
														$member_id 	 	 = $row->member_id;
														$timestamp 	 	 = $row->timestamp;

														$thaidate 		 = $this->productset_libs->getThaiDate($timestamp);
														$member_result   = $this->model_productset->getMemberByID($member_id);
														$review_type_result = $this->model_productset->getReviewTypeByID($review_type);

														if($review_rating == 1){
															$review_rating	 = '<i class="fa fa-star text-warning"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
														}else if($review_rating == 2){
															$review_rating	 = '<i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
														}else if($review_rating == 3){
															$review_rating	 = '<i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
														}else if($review_rating == 4){
															$review_rating	 = '<i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star"></i>';
														}else if($review_rating == 5){
															$review_rating	 = '<i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i><i class="fa fa-star text-warning"></i>';
														}else{
															$review_rating	 = '<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
														}

														if(count($member_result)>0){
															$first_name = $member_result[0]->first_name;
															$last_name  = $member_result[0]->last_name;
															$member_name = $first_name." ".$last_name;
														}else{
															$member_name = "";
														}
														if(count($review_type_result)>0){
															$type_review_name = $review_type_result[0]->type_name;
															if($review_type == 1){
																$type_review_name = '<span class="label label-warning">'.$type_review_name.'</span>';
															}else if($review_type == 2){
																$type_review_name = '<span class="label label-info">'.$type_review_name.'</span>';
															}else{
																$type_review_name = '<span class="label label-success">'.$type_review_name.'</span>';
															}
														}else{
															$type_review_name = "";
														}
																								
												?>
											    <div class="d-flex flex-row comment-row">
											        <!-- <div class="p-2">
											        	<span class="round"><img src="../assets/images/users/1.jpg" alt="user" width="50"></span>
											        </div> -->
											        <div class="comment-text w-100">
											        	<div class="col-lg-12 pb-2">
											        		<i>รีวิวโดย : </i>
											        	</div>
											        	<div class="col-lg-12">
											        		<h5><b><?php echo $member_name; ?></b></h5>
											        	</div>
												        <div class="col-lg-12">
												        	<div class="comment-footer">
												                <span class="date"><?php echo $thaidate; ?> </span>
												                <?php echo $type_review_name; ?>
												                <?php echo $review_rating; ?>
												            </div>
												        </div>
												        <div class="col-lg-12">
												        	<p class="m-b-5 m-t-10 text-dark"><?php echo $review_content; ?></p>
												        </div>
											        </div>
											    </div>
												<?php } ?>
											</div>
										
										</div>
									</div>
								</div>
							</div>
						</div>	

					</div>
                    <!-- Column -->
                </div>
					</div><!-- row -->
				</div><!-- col-lg-9 --> 
			</div><!-- row -->
		</div><!-- container-fluid -->
		<footer class="footer"> </footer>
	</div><!--สิ้นสุด page-wrapper-->
	<!--เริ่มต้น Footer-->
</div><!-- main-wrapper --> 
  <!--เริ่มต้น Footer-->
<div id="store_container"></div>

<?php $this->load->view("templates/footer"); ?>
<script src="<?php echo base_url("assets/system/plugins/datatables/jquery.dataTables.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/system/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/custom/js/locales/bootstrap-datepicker.th.js"); ?>"></script>
<script src="<?php echo base_url('assets/system/plugins/clockpicker/dist/jquery-clockpicker.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/system/plugins/clockpicker/dist/bootstrap-clockpicker-custom.js'); ?>"></script>

<?php $this->load->assets_by_name('productset_modals_image'); ?>  
