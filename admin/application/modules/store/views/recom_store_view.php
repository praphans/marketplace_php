<?php $this->load->view("templates/header"); ?>
  
 <div class="page-wrapper mt-main-wrapper-70">
		<!-- ============================================================== -->
		<!-- Bread crumb and right sidebar toggle -->
		<!-- ============================================================== -->
		<div class="row page-titles">
			<div class="col-md-5 align-self-center">
				<h3 class="text-themecolor">รายการร้านค้าแนะนำ</h3>
			</div>
			<div class="col-md-7 align-self-center">
				<ol class="breadcrumb">
				<li class="breadcrumb-item">ร้านค้า</a></li>
				<li class="breadcrumb-item"> รายการร้านค้าแนะนำ</li>
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
											<select class="form-control custom-select" name="category_id" id="category_id" onchange="filteringOption();">
												<option value="0">ทั้งหมด</option>
												<?php
													$category_list = $this->model_store->getStoreCatList();
													foreach($category_list as $row){
														$category_id = $row->id;
														$category_name = $row->category_name;

												?>
												<option value="<?php echo $category_id; ?>" ><?php echo $category_name; ?></option>
												<?php } ?>
											</select>
										</div>

									</div> 

									<div class="table-responsive pr-3 pl-3">
										<div id="myTable_wrapper" class="dataTables_wrapper no-footer">
											<table id="recom_datatable" class="table table-bordered table-striped nowrap">
		                                        <thead>
		                                            <tr>
		                                            	<th>#</th>
		                                            	<!-- <th>วันที่</th> -->
		                                            	<th>รหัสร้านค้า</th>
		                                                <th>ชื่อร้านค้า</th>
		                                                <th>รายการสินค้า</th>
		                                                <th>หมวดหมู่</th>
														<!-- <th>เจ้าของร้าน</th> -->
														<!-- <th>เบอร์โทร</th> -->
														<th>สถานะ</th>
													
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
												<button type="button" id="add_recommended_store" name="add_recommended_store" class="btn btn-info text-light btn-block mdi mdi-star-circle"> บันทึกร้านค้าแนะนำ</button>
											</div>
											<div class="col-sm-12 col-md col-lg-4">
												
											</div>
											<div class="col-sm-12 col-md col-lg-4">
											
											</div>
										</div>
									</div>								

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
<div id="store_container"></div>

<?php $this->load->view("templates/footer"); ?>
<script src="<?php echo base_url("assets/system/plugins/datatables/jquery.dataTables.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/system/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/custom/js/locales/bootstrap-datepicker.th.js"); ?>"></script>
<script src="<?php echo base_url('assets/system/plugins/clockpicker/dist/jquery-clockpicker.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/system/plugins/clockpicker/dist/bootstrap-clockpicker-custom.js'); ?>"></script>

<?php $this->load->assets_by_name('store'); ?>   

