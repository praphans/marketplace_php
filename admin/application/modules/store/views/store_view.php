<?php $this->load->view("templates/header"); ?>
<?php
$attributes = array("update_popular", "enctype"=>"multipart/form-data");
echo form_open(base_url('store/update_popular'), $attributes);
?>
 <div class="page-wrapper mt-main-wrapper-70">
		<!-- ============================================================== -->
		<!-- Bread crumb and right sidebar toggle -->
		<!-- ============================================================== -->
		<div class="row page-titles">
			<div class="col-md-5 align-self-center">
				<h3 class="text-themecolor">รายการร้านค้า</h3>
			</div>
			<div class="col-md-7 align-self-center">
				<ol class="breadcrumb">
				<li class="breadcrumb-item">ร้านค้า</a></li>
				<li class="breadcrumb-item"> รายการร้านค้า</li>
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
										<div class="col-md-6 col-lg-9">
											<div class="input-group mt-2">
												<input type="text" class="form-control h-15" id="search_table" placeholder="พิมพ์ข้อความสำหรับการค้นหา ">
												<div class="input-group-append">
													<button class="btn btn-info h-38" type="button">ค้นหา</button>
												</div>
											</div>
										</div>
										<div class="col-md-6 col-lg-3 mt-2">
											<select class="form-control custom-select" name="store_status_id" id="store_status_id" onchange="filteringOptionStore();">
												<option value="0">ทั้งหมด</option>
												<?php
													$store_list = $this->model_store->getStoreStatusList();
													foreach($store_list as $row){
														$store_status_id = $row->id;
														$store_status_name = $row->status_name;
											
												?>
												<option value="<?php echo $store_status_id;?>"><?php echo $store_status_name; ?></option>
												<?php }?>
											</select>
										</div>

									</div> 

									<div class="table-responsive pr-3 pl-3">
										<div id="myTable_wrapper" class="dataTables_wrapper no-footer">
											<table id="store_datatable" class="table table-bordered table-striped nowrap">
		                                        <thead>
		                                            <tr>
		                                            	<!-- <th>#</th> -->
		                                            	<th>รหัสร้านค้า</th>
		                                                <th>ชื่อร้านค้า</th>
		                                                <th>รายการสินค้า</th>
														<!-- <th>เจ้าของร้าน</th> -->
														<th>ยอดขาย/บาท</th>
														<th>ผู้เข้าชม</th>
														<th>สถิติการส่งมอบ</th>
														<!-- <th>เบอร์โทร</th> -->
														<th>สถานะ</th>
														<!-- <th>รีวิว</th> -->
														<!-- <th>ตัวเลือก</th> -->
														<!-- <th>ตัวเลือก</th> -->
														<th>คะแนน</th>
													
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
											<div class="col-sm-12 col-md-3 col-lg-2">
												<button type="submit" id="save_popular" name="save_popular" class="btn btn-info text-light btn-block"><span class="fa fa-save"></span> บันทึก</button>
											</div>
											<div class="col-sm-12 col-md col-lg-4">
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

 </form>
<div id="store_container"></div>

<?php $this->load->view("templates/footer"); ?>
<script src="<?php echo base_url("assets/system/plugins/datatables/jquery.dataTables.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/system/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/custom/js/locales/bootstrap-datepicker.th.js"); ?>"></script>
<script src="<?php echo base_url('assets/system/plugins/clockpicker/dist/jquery-clockpicker.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/system/plugins/clockpicker/dist/bootstrap-clockpicker-custom.js'); ?>"></script>

<?php $this->load->assets_by_name('store'); ?>   

