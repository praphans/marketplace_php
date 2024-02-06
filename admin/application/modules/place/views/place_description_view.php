
<?php 
	$this->load->view("templates/header");
?>

<?php 
	$place_id 						= 0;
	$store_id 						= 0;
	$member_id 						= 0;
	$request_place_id 				= 0;
	$shipping_type_id 				= 0;
	$place_code 					= "";
	$place_name 					= "";
	$place_province 				= 0;
	$place_amphur 					= 0;
	$place_address 					= "";
	$place_postcode 				= "";
	$place_mobile 					= "";
	$working_time_id 				= 0;
	$place_lat 						= "";
	$place_long 					= "";
	$place_condition 				= "";
	$place_is_default 				= "";
	$place_is_default_tax 			= "";

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

	$store_result = $this->model_place->getStoreDiscripByID($store_id);
	if(count($store_result)>0){
		$store_code						= $store_result[0]->store_code;
		$store_name						= $store_result[0]->store_name;
		$tel							= $store_result[0]->tel;
	}else{
		$store_code 			= "";
		$store_name 			= "";
		$tel 					= "";
	}

	

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

	$place_addr = "";
	$place_addr .= $place_address." ";
	$place_addr .= " อ.";
	$place_addr .= $this->model_place->getAmphurByID($place_amphur)." ";
	$place_addr .= " จ.";
	$place_addr .= $this->model_place->getProvinceByID($place_province)." ";
	$place_addr .= $place_postcode;

	$working = $this->model_place->getWorkingByID($place_id);
	$store_place_result = $this->model_place->getStorePlaceByID($store_id);
	$store_place2_result = $this->model_place->getStorePlace2ByID($place_id);

	$agent_result = $this->model_place->getCountAgentByID($store_id);
	if(count($agent_result)>0){
		$agent_count = $agent_result[0]->agent_count;
	}else{
		$agent_count = 0;
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
				<li class="breadcrumb-item"> รายละเอียดสถานที่ </li>
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
	                                <h4>ข้อมูลสถานที่</h4>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4 col-lg-3">
									<small class="text-muted p-t-30 db">รหัสสถานที่</small>
									<h6 class="pt-1">
										<?php
										if($shipping_type_id == 3){
											echo "-" ;
										}else{
											if(isset($place_code)) echo $place_code ;
										}
										?>
									</h6>
								</div>
								<div class="col-md-4 col-lg-3">
									<small class="text-muted p-t-30 db">สถานที่</small>
									<h6 class="pt-1"><?php if(isset($place_name)) echo $place_name ?></h6> 
								</div>
								<div class="col-md-4 col-lg-3">
									<small class="text-muted p-t-30 db">ที่อยู่</small>
									<h6 class="pt-1"><?php if(isset($place_addr)) echo $place_addr; ?></h6> 
								</div>

								<!-- <div class="col-md-4 col-lg-3">
									<small class="text-muted p-t-30 db">เบอร์โทร</small>
									<h6 class="pt-1"><?php// if(isset($place_mobile))  echo $place_mobile; ?></h6> 
								</div> -->
								<?php if($shipping_type_id != 4){ ?>
								<div class="col-md-4 col-lg-3">
									<small class="text-muted p-t-30 db">จำนวนร้านค้าเอเย่นต์</small>
									<h6 class="pt-1"><?php if(isset($agent_count))  echo $agent_count; ?></h6> 
								</div>
								<?php } ?>
								
							
					
							</div>
						</div>
					</div>
					<?php if($shipping_type_id != 4){ ?>
					<div class="card">
						<div class="card-body"> 
							<div class="row">
								<div class="col-lg-12">
	                                <h4>วันและเวลาทำการ</h4>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12">
									<table class="table">
										<thead>
											<tr width="100%">
												<th class="font-weight-bold" width="20%">วันทำการ</th>
												<th class="font-weight-bold" width="20%">เวลาเปิด</th>
												<th class="font-weight-bold" width="20%">เวลาปิด</th>
												<th class="font-weight-bold" width="40%">รายละเอียด</th>
											</tr>
										</thead>
										<tbody>
											<?php
												foreach($working as $w){
													$work_id = $w->work_id;
													$work_day = $w->work_day;
													$work_starttime = $w->work_starttime;
													$work_endtime = $w->work_endtime;
													$open_all_day = $w->open_all_day;
													$is_holiday = $w->is_holiday;
													if($open_all_day == 1){
														$open_all_day = "เปิด 24 ชั่วโมง";
														$work_starttime = "-";
														$work_endtime = "-";	
													}else{
														$open_all_day = "เปิดตามเวลา";
													}
													if($is_holiday){
														$open_all_day = "วันหยุด";
														$work_starttime = "-";
														$work_endtime = "-";	
													}else{
														//$open_all_day = "เปิดตามเวลา";
													}
												?>
											<tr>
												<td><?php echo $work_day; ?></td>
												<td><?php echo $work_starttime; ?></td>
												<td><?php echo $work_endtime; ?></td>
												<td><?php echo $open_all_day; ?></td>
											</tr>
											<?php } ?>
											
										</tbody>
									</table>  
								</div>
							</div>
						</div>
					</div>
					<?php } ?>

					<!-- <div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-lg-12">
									<div class="ribbon-wrapper">
	                                	<h4 class="ribbon ribbon-bookmark ribbon-danger">เงื่อนไข</h4>
	                                	<h6 class="pt-3"><?php// if(isset($place_condition)) echo $place_condition; ?></h6>
	                                </div>
								</div>
							</div>
						</div>
					</div> -->
					<div class="card">
						<div class="card-body"> 
							<div class="row">
								<div class="col-lg-12">
	                                <h4>แผนที่</h4>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 col-lg-12 pt-2">
									<small class="text-muted db">อธิบายเส้นทาง</small>
									<h6 class="pt-1"><?php if(isset($place_condition)) echo $place_condition ?></h6>
								</div>
								<div class="col-md-12 col-lg-4 ">
								</div>
								<div class="col-md-12 col-lg-4 pt-3">
									<a href="<?php echo 'https://www.google.co.th/maps/search/'.$place_name.'/@'.$place_lat.','.$place_long; ?>" type="button" class="btn btn-info btn-block"><span class="mdi mdi-google-maps"></span> ดูแผนที่ </a>
								</div>
								
							</div>
						</div>
					</div>	
					<?php if($shipping_type_id != 4){ ?>
					<div class="card">
						<div class="card-body"> 
							<div class="row">
								<div class="col-lg-12">
	                                <h4>เจ้าของ</h4>
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
					
					<div class="card">
						<div class="card-body"> 
							<div class="row">
								<div class="col-lg-12">
	                                <h4>ร้านค้าที่ใช้บริการส่งสินค้า</h4>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12 pt-2">
									<table class="table">
										<thead>
											<tr width="100%">
												<th class="font-weight-bold" width="40%">รหัสร้านค้า</th>
												<th class="font-weight-bold" width="60%">ร้านค้า</th>
										
											</tr>
										</thead>
										<tbody>
											<?php
											
												$place_store_id 		= 0;
												$place_store_code 		= "";
												$place_store_name 		= "";
											
												foreach($store_place2_result as $p){
													$place_store_id 		= $p->store_id;
													
													$place_result = $this->model_place->getStoreByID($place_store_id);
													if(count($place_result)>0){
														$place_store_name = $place_result[0]->store_name;
														$place_store_code = $place_result[0]->store_code;
													}

													$url_place_store_id = base_url("store/storeDescription/".$place_store_id);
													$link_code = '<a class="text-secondary" href="'.$url_place_store_id.'">'.$place_store_code.'</a>';
													$link_name = '<a class="text-secondary" href="'.$url_place_store_id.'">'.$place_store_name.'</a>';

													
											?>
										
											<tr>
												<td><?php echo $link_code; ?></td>
												<td><?php echo $link_name; ?></td>
										
											</tr>
											<?php } ?>
											
										</tbody>
									</table>  
								</div>
								
							</div>
						</div>
					</div>	
					<?php } ?>
					<!-- <div class="card">
						<div class="card-body"> 
							<div class="row">
								<div class="col-lg-12">
	                                <h4>ร้านค้าที่ไปขอใช้บริการส่งสินค้า</h4>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12 pt-2">
									<table class="table">
										<thead>
											<tr width="100%">
												<th class="font-weight-bold" width="40%">รหัสร้านค้า</th>
												<th class="font-weight-bold" width="60%">ร้านค้า</th>
												<th class="font-weight-bold" width="20%">รหัสสถานที่(Test)</th>
												<th class="font-weight-bold" width="30%">สถานที่(Test)</th>
											</tr>
										</thead>
										<tbody>
											<?php
												// $agent_place_id			= 0;
												// $agent_store_id 		= 0;
												// $agent_place_code 		= "";
												// $agent_place_name 		= "";
												// $agent_store_name 		= "";
												// $agent_store_code 		= 0;
												// $request_store_id 		= 0;
												// foreach($store_place_result as $p){
												// 	$agent_request_place_id	= $p->request_place_id;
												// 	$agent_place_id			= $p->place_id;
												// 	$agent_store_id 		= $p->store_id;
												// 	$agent_place_code 		= $p->place_code;
												// 	$agent_place_name 		= $p->place_name;

												// 	$request_place_result = $this->model_place->getRequestPlaceByID($agent_request_place_id);
												// 	if(count($request_place_result)>0){
												// 		$request_store_id = $request_place_result[0]->store_id;
												// 		$req_place_id = $request_place_result[0]->place_id;
												// 	}

												// 	$agent_place_result = $this->model_place->getStoreByID($request_store_id);
												// 	if(count($agent_place_result)>0){
												// 		$agent_store_name = $agent_place_result[0]->store_name;
												// 		$agent_store_code = $agent_place_result[0]->store_code;
												// 	}

												// 	$url_store_id = base_url("store/storeDescription/".$request_store_id);
												// 	$link_store_code = '<a class="text-secondary" href="'.$url_store_id.'">'.$agent_store_code.'</a>';
												// 	$link_store_name = '<a class="text-secondary" href="'.$url_store_id.'">'.$agent_store_name.'</a>';

												// 	$url_place_id = base_url("place/placeDescription/".$req_place_id);
												// 	$link_place_code = '<a class="text-secondary" href="'.$url_place_id.'">'.$agent_place_code.'</a>';
												// 	$link_place_name = '<a class="text-secondary" href="'.$url_place_id.'">'.$agent_place_name.'</a>';
											?>
										
											<tr>
												<td><?php //echo $link_store_code; ?></td>
												<td><?php //echo $link_store_name; ?></td>
												<td><?php// echo $link_place_code; ?></td>
												<td><?php //echo $link_place_name; ?></td>
											</tr>
											<?php// } ?>
											
										</tbody>
									</table>  
								</div>
								
							</div>
						</div>
					</div> -->
					
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



