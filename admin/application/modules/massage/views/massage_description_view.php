
<?php 
	$this->load->view("templates/header");
	$this->load->assets('css');
?>

<?php 
foreach($massage as $row){
			$message_id = $row->message_id;
			$sender_id = $row->sender_id;
			$receiver_id = $row->receiver_id;
			$order_id = $row->order_id;
			$message = $row->message;
			$message_type = $row->message_type;
			$timestamp = $row->timestamp;			
		} 

		$sender_result = $this->model_massage->getMemberByID($sender_id);
		if(count($sender_result)>0){
			$first_name = $sender_result[0]->first_name;
			$last_name = $sender_result[0]->last_name;
			$member = $first_name." ".$last_name;
		}else{
			$member = " -";
		}

		// $sender_result = $this->model_massage->getMemberByID($sender_id);
		// if(count($sender_result)>0){
		// 	$first_name = $sender_result[0]->first_name;
		// 	$last_name = $sender_result[0]->last_name;
		// 	$mobile = $sender_result[0]->mobile;
		// 	$email = $sender_result[0]->email;

		// 	$member = $first_name." ".$last_name;
		// }else{
		// 	$member = " -";
		// 	$mobile = " -";
		// 	$email = " -";
		// }

		// $store_result = $this->model_massage->getStoreByID($receiver_id);
		// if(count($store_result)>0){

		// 	$store_name = $store_result[0]->store_name;
		// 	$store_code = $store_result[0]->store_code;
		// 	$tel = $store_result[0]->tel;
		// 	$first_name = $store_result[0]->first_name;
		// 	$last_name = $store_result[0]->last_name;
		// 	$store_member = "คุณ ".$first_name." ".$last_name;

		// }else{
		// 	$store_name = " -";
		// 	$store_code = " -";
		// 	$tel = " -";
		// 	$store_member = " -";
		// }





?>



 <div class="page-wrapper mt-main-wrapper-70">
		<!-- ============================================================== -->
		<!-- Bread crumb and right sidebar toggle -->
		<!-- ============================================================== -->
		<div class="row page-titles">
			<div class="col-md-5 align-self-center">
				<h3 class="text-themecolor">รายละเอียดการร้องเรียน </h3>
			</div>
			<div class="col-md-7 align-self-center">
				<ol class="breadcrumb">
				<li class="breadcrumb-item">ตั่งค่า</li>
				<li class="breadcrumb-item"> ร้องเรียน  </li>
				<li class="breadcrumb-item"> รายละเอียดการร้องเรียน  </li>
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
						<div class="col-lg-12 col-xlg-12 col-md-12">
							<div class="card">
								<div class="card-body"> 
									<div class="row">
										<div class="col-lg-12">
											<div class="ribbon-wrapper">
			                                	<h4 class="ribbon ribbon-bookmark ribbon-danger">สมาชิก</h4>
			                                </div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12">
											
										</div>
										<div class="col-lg-4">
											<small class="text-muted p-t-20 db">ชื่อสกุล</small>
											<h6 class="pt-1"><?php if(isset($member)) echo $member ?></h6>
										</div>
										<!-- <div class="col-lg-4">
											<small class="text-muted p-t-20 db">เบอร์โทรศัพท์</small>
											<h6 class="pt-1"><?php //if(isset($mobile)) echo $mobile ?></h6> 
										</div> -->
										<div class="col-lg-4">
											<small class="text-muted p-t-20 db">อีเมล</small>
											<h6 class="pt-1"><?php if(isset($email)) echo $email ?></h6> 
										</div>
										
									</div>
								</div>
							</div>
							<!-- <div class="card">
								<div class="card-body"> 
									<div class="row">
										<div class="col-lg-12">
											<div class="ribbon-wrapper">
			                                	<h4 class="ribbon ribbon-bookmark ribbon-danger">ร้านค้า</h4>
			                                </div>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-3">
											<small class="text-muted p-t-20 db">รหัสร้านค้า</small>
											<h6 class="pt-1"><?php //if(isset($store_code)) echo $store_code ?></h6>
										</div>
										<div class="col-lg-3">
											<small class="text-muted p-t-20 db">ร้านค้า</small>
											<h6 class="pt-1"><?php //if(isset($store_name)) echo $store_name ?></h6> 
										</div>
										<div class="col-lg-3">
											<small class="text-muted p-t-20 db">ผู้ขาย</small>
											<h6 class="pt-1"><?php// if(isset($store_member)) echo $store_member ?></h6> 
										</div>
										<div class="col-lg-3">
											<small class="text-muted p-t-20 db">เบอร์โทรศัพท์</small>
											<h6 class="pt-1"><?php// if(isset($tel)) echo $tel ?></h6> 
										</div>
										
									</div>
								</div>
							</div> -->
						</div>
						<div class="col-lg-12 pl-1 pr-1">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col-lg-12">
											<div class="ribbon-wrapper">
			                                	<h4 class="ribbon ribbon-bookmark ribbon-danger">รูปภาพ</h4>
			                                	<h6 class="pt-3">
			                                		<?php
			                                		$img_result = $this->model_massage->getImgByID($message_id);
													foreach($img_result as $row){
														$image_url = $row->image_url;
														$images = ' <a class="example-image-link zoom-in" href="'.base_url('../'.$image_url).'" data-lightbox="example-1"><img class="example-image" src="'.base_url('../'.$image_url).'" width="100"  /></a>';
														echo $images;
													} 

			                                		?>
			                                			
			                                	</h6>
			                                </div>
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
			                                	<h4 class="ribbon ribbon-bookmark ribbon-danger">รายละเอียด</h4>
			                                	<h6 class="pt-3"><?php echo $message; ?></h6>
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

