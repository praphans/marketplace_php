<?php $this->load->view("templates/header"); ?>
  
 <div class="page-wrapper mt-main-wrapper-70">
		<!-- ============================================================== -->
		<!-- Bread crumb and right sidebar toggle -->
		<!-- ============================================================== -->
		<div class="row page-titles">
			<div class="col-md-5 align-self-center">
				<h3 class="text-themecolor">รายการร้านค้าที่อนุญาต</h3>
			</div>
			<div class="col-md-7 align-self-center">
				<ol class="breadcrumb">
				<li class="breadcrumb-item">โปรโมชั่น</a></li>
				<li class="breadcrumb-item"> โปรโมชั่นร่วม</li>
				<li class="breadcrumb-item"> รายการร้านค้าที่อนุญาต</li>
				</ol>
			</div>
		</div>
		
		<!-- ============================================================== -->
		<!-- End Bread crumb and right sidebar toggle -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!-- Container fluid  -->
		<!-- ============================================================== -->
		<div class="container-fluid">
			<!-- ============================================================== -->
			<!-- Start Page Content -->
			<!-- ============================================================== -->
			<!-- Row -->
			<div class="row pl-3 pr-3">
				<div class="col-lg-12 col-xlg-12 col-md-12">
					<div class="row">
						
						<div class="col-lg-12 col-xlg-12 col-md-12 mt-3">
							<div class="card">
								<div class="card-body">

									<div class="row padding-mps_product">

										<div class="col-lg-9 col-md-6">
											<div class="input-group mt-2">
												
												<input type="text" class="form-control h-15" id="search_table" placeholder="พิมพ์ข้อความสำหรับการค้นหา ">
												<div class="input-group-append">
													<button class="btn btn-info h-38" type="button">ค้นหา</button>
												</div>
											</div>
										</div>
										<div class="col-lg-3 col-md-6">
											<div class="input-group mt-2">
												<button type="button" id="add_jion_promo" name="add_jion_promo" class="btn btn-info text-light btn-block mdi mdi-auto-fix"> บันทึกการอนุญาตเข้าร่วม</button>
											</div>
										</div>

									</div> 

									<div class="table-responsive pr-3 pl-3">
										<div id="myTable_wrapper" class="dataTables_wrapper no-footer">
											<table id="permission_store_datatable" class="table table-bordered table-striped nowrap">
		                                        <thead>
		                                            <tr>
		                                            	<th>#</th>
		                                            	<th>วันที่</th>
		                                            	<th>รหัสร้านค้า</th>
		                                                <th>ชื่อร้านค้า</th>
		                                                <th>สถานะ</th>
		                                                <th>จำนวนสินค้า</th>
														<th>เจ้าของร้าน</th>
														<th>เบอร์โทร</th>
												
		                                            </tr>
		                                        </thead>
		                                        <tbody>
                                                	
                                                    <!--โหลดข้อมูล-->
		                                            
		                                        </tbody>
		                                    </table>
										</div><!-- myTable_wrapper -->
									</div><!-- table-responsive -->		
									<div class="col-md-12 col-lg-12 p-t-10">
										<div class="row">
											<div class="col-sm-12 col-md-4 col-lg-3">
												<!-- <button type="button" id="add_jion_promo" name="add_jion_promo" class="btn btn-info text-light btn-block mdi mdi-auto-fix"> บันทึกการอนุญาตเข้าร่วม</button> -->
											</div>
											<div class="col-sm-12 col-md col-lg-5">
												<!-- contant -->
											</div>
											<div class="col-sm-12 col-md col-lg-4">
												<!-- contant -->
											</div>
										</div><!-- row -->
									</div><!-- col-md-12 -->					

								</div><!-- card-body -->
							</div><!-- card -->
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

<?php $this->load->view("templates/footer"); ?>
<script src="<?php echo base_url("assets/system/plugins/datatables/jquery.dataTables.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/system/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/custom/js/locales/bootstrap-datepicker.th.js"); ?>"></script>
<script src="<?php echo base_url('assets/system/plugins/clockpicker/dist/jquery-clockpicker.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/system/plugins/clockpicker/dist/bootstrap-clockpicker-custom.js'); ?>"></script>

<?php $this->load->assets_by_name('permission_store'); ?>   
<script >
var join_id = "<?php echo $join_id; ?>";
console.log("join_id | "+join_id)
loadPermissionStore(join_id);	
</script>
