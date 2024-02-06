
<?php 
	$this->load->view("templates/header");
?>

<?php 
foreach($place_discription as $row){
			$place_id 						= $row->place_id;
			$store_id 						= $row->store_id;
			$member_id 						= $row->member_id;
			$request_place_id 				= $row->request_place_id;
			$shipping_type_id 				= $row->shipping_type_id;
			$place_code 					= $row->place_code;
			$place_name 					= $row->place_name;
			$place_province 				= $row->place_province;
			$place_amphur 					= $row->place_amphur;
			$place_district 				= $row->place_district;
			$place_address 					= $row->place_address;
			$place_postcode 				= $row->place_postcode;
			$place_mobile 					= $row->place_mobile;
			$working_time_id 				= $row->working_time_id;
			$place_lat 						= $row->place_lat;
			$place_long 					= $row->place_long;
			$place_condition 				= $row->place_condition;
			$place_is_default 				= $row->place_is_default;
			$place_is_default_tax 			= $row->place_is_default_tax;

		} 

		

		$store_result 					= $this->model_place->getStoreDiscripByID($store_id);
		$store_code						= $store_result[0]->store_code;
		$store_name						= $store_result[0]->store_name;
		$tel							= $store_result[0]->tel;

		$url_store_id = base_url("store/storeDescription/".$store_id);
		$link_store_code = '<a href="'.$url_store_id.'">'.$store_code.'</a>';
		$link_store_name = '<a href="'.$url_store_id.'">'.$store_name.'</a>';

		
		$working_time_result 			= $this->model_place->getWorkingTimeByID($working_time_id);
		if(count($working_time_result)>0){
			$work_day					= $working_time_result[0]->work_day;
			$work_starttime				= $working_time_result[0]->work_starttime.' น.';
			$work_endtime				= $working_time_result[0]->work_endtime.' น.';
			$open_all_day				= $working_time_result[0]->open_all_day;
		}else{
			$work_day					= '';
			$work_starttime				= '';
			$work_endtime				= '';
			$open_all_day				= 0;
		}

		
		if($open_all_day == 1){
			$open_time = "เปิดตลอด 24 ชม.";
		}else{
			$open_time = "";
		}
?>



 <div class="page-wrapper mt-main-wrapper-70">
		<!-- ============================================================== -->
		<!-- Bread crumb and right sidebar toggle -->
		<!-- ============================================================== -->
		<div class="row page-titles">
			<div class="col-md-5 align-self-center">
				<h3 class="text-themecolor">รายละเอียดสถานที่ </h3>
			</div>
			<div class="col-md-7 align-self-center">
				<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href='<?php echo base_url("place"); ?>'>สถานที่ส่งสินค้า</a></li>
				<li class="breadcrumb-item"> รายละเอียดสถานที่  </li>
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
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-lg-12">
									<div class="ribbon-wrapper">
	                                	<h4 class="ribbon ribbon-bookmark ribbon-danger">เงื่อนไข</h4>
	                                	<h6 class="pt-3"><?php if(isset($place_condition)) echo $place_condition; ?></h6>
	                                </div>
								</div>
							</div>
						</div>
					</div>
					<div class="card">
						<div class="card-body"> 
							<div class="row">
								<div class="col-lg-12">
	                                <h4>วันและเวลาทำการ</h4>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4 col-lg-3">
									<small class="text-muted p-t-30 db">วันทำการ</small>
									<h6 class="pt-1"><?php if(isset($work_day)) echo $work_day ?></h6>
								</div>
								<div class="col-md-4 col-lg-3">
									<small class="text-muted p-t-30 db">เวลาเปิด</small>
									<h6 class="pt-1"><?php if(isset($work_starttime)) echo $work_starttime ?></h6> 
								</div>
								<div class="col-md-4 col-lg-3">
									<small class="text-muted p-t-30 db">เวลาปิด</small>
									<h6 class="pt-1"><?php if(isset($work_endtime)) echo $work_endtime; ?></h6> 
								</div>
								<div class="col-md-4 col-lg-3">
									<small class="text-muted p-t-30 db">เวลาทำการ</small>
									<h6 class="pt-1"><?php if(isset($open_time)) echo $open_time; ?></h6> 
								</div>
								
					
							</div>
						</div>
					</div>
					<div class="card">
						<div class="card-body"> 
							<div class="row">
								<div class="col-lg-12">
	                                <h4>ข้อมูลสถานที่</h4>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4 col-lg-3">
									<small class="text-muted p-t-30 db">รหัสสถานที่</small>
									<h6 class="pt-1"><?php if(isset($place_code)) echo $place_code ?></h6>
								</div>
								<div class="col-md-4 col-lg-3">
									<small class="text-muted p-t-30 db">สถานที่</small>
									<h6 class="pt-1"><?php if(isset($place_name)) echo $place_name ?></h6> 
								</div>
								<div class="col-md-4 col-lg-3">
									<small class="text-muted p-t-30 db">ที่อยู่</small>
									<h6 class="pt-1"><?php if(isset($place_address)) echo $place_address; ?></h6> 
								</div>
								<div class="col-md-4 col-lg-3">
									<small class="text-muted p-t-30 db">ตำบล</small>
									<h6 class="pt-1"><?php if(isset($place_district)) echo $place_district; ?></h6> 
								</div>
								<div class="col-md-4 col-lg-3">
									<small class="text-muted p-t-30 db">อำเภอ</small>
									<h6 class="pt-1"><?php if(isset($place_amphur)) echo $place_amphur; ?></h6>
								</div>
								<div class="col-md-4 col-lg-3">
									<small class="text-muted p-t-30 db">จังหวัด</small>
									<h6 class="pt-1"><?php if(isset($place_province))  echo $place_province; ?></h6> 
								</div>
								<div class="col-md-4 col-lg-3">
									<small class="text-muted p-t-30 db">รหัสไปรษณีย์</small>
									<h6 class="pt-1"><?php if(isset($place_postcode)) echo $place_postcode; ?></h6>
								</div>
								<div class="col-md-4 col-lg-3">
									<small class="text-muted p-t-30 db">เบอร์โทร</small>
									<h6 class="pt-1"><?php if(isset($place_mobile))  echo $place_mobile; ?></h6> 
								</div>
								<div class="col-md-12 col-lg-4 ">
								</div>
								<div class="col-md-12 col-lg-4 pt-3">
									<a href="<?php echo 'https://www.google.co.th/maps/search/'.$place_name.'/@'.$place_lat.','.$place_long; ?>" type="button" class="btn btn-info btn-block"><span class="mdi mdi-google-maps"></span> ดูแผนที่ </a>
								</div>
								<div class="col-md-12 col-lg-4">
								</div>
					
							</div>
						</div>
					</div>
					<div class="card">
						<div class="card-body"> 
							<div class="row">
								<div class="col-lg-12">
	                                <h4>ร้านค้า</h4>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4 col-lg-3">
									<small class="text-muted p-t-30 db">รหัสร้านค้า</small>
									<h6 class="pt-1"><?php if(isset($store_code)) echo $link_store_code ?></h6>
								</div>
								<div class="col-md-4 col-lg-3">
									<small class="text-muted p-t-30 db">ร้านค้า</small>
									<h6 class="pt-1"><?php if(isset($store_name)) echo $link_store_name ?></h6> 
								</div>
								<div class="col-md-4 col-lg-3">
									<small class="text-muted p-t-30 db">เบอร์โทร</small>
									<h6 class="pt-1"><?php if(isset($tel)) echo $tel; ?></h6> 
								</div>
							</div>
						</div>
					</div>	
                </div>
			
			</div><!-- row -->
		</div><!-- container-fluid -->
		<footer class="footer"> </footer>
	</div><!--สิ้นสุด page-wrapper-->
	<!--เริ่มต้น Footer-->
</div><!-- main-wrapper --> 
  <!--เริ่มต้น Footer-->


<?php $this->load->view("templates/footer"); ?>
<script src="<?php echo base_url("assets/system/plugins/datatables/jquery.dataTables.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/system/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/custom/js/locales/bootstrap-datepicker.th.js"); ?>"></script>
<script src="<?php echo base_url('assets/system/plugins/clockpicker/dist/jquery-clockpicker.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/system/plugins/clockpicker/dist/bootstrap-clockpicker-custom.js'); ?>"></script>



