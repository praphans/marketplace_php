<?php $this->load->view("templates/header"); ?>
  
 <div class="page-wrapper mt-main-wrapper-70">
		<!-- ============================================================== -->
		<!-- Bread crumb and right sidebar toggle -->
		<!-- ============================================================== -->
		<div class="row page-titles">
			<div class="col-md-5 align-self-center">
				<h3 class="text-themecolor">โปรโมชั่นร่วม</h3>
			</div>
			<div class="col-md-7 align-self-center">
				<ol class="breadcrumb">
				<li class="breadcrumb-item">โปรโมชั่น</a></li>
				<li class="breadcrumb-item"> โปรโมชั่นร่วม</li>
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
										<div class="col-sm col-md-8 col-lg-9 pr-md-0 pr-lg-0">
											<div class="input-group mt-2">
												<input type="text" class="form-control h-15" id="search_table" placeholder="พิมพ์ข้อความสำหรับการค้นหา ">
												<div class="input-group-append">
													<button class="btn btn-info h-38" type="button">ค้นหา</button>
												</div>
											</div>
										</div>
										<div class="col-sm col-md-4 col-lg-3 mt-2">
                                        	<button onClick="loadModal('myModalAddPromotions')" class="btn btn-success waves-effect waves-light btn-block d-flex justify-content-between" type="button"><span class="btn-label"><i class="fa fa-plus"></i></span>เพิ่มโปรโมชั่นร่วม<a></a></button>
											
										</div>
									</div><!-- row -->

									<div class="table-responsive pr-3 pl-3">
										<div id="myTable_wrapper" class="dataTables_wrapper no-footer">
											<table id="promotion_datatable" class="table table-bordered table-striped nowrap">
		                                        <thead>
		                                            <tr>
		                                            	<th>#</th>
		                                                <th>ชื่อโปรโมชั่น</th>
		                                                <!-- <th>ราคา</th> -->
														<th>รูปภาพ</th>
														<th>การเข้าร่วม</th>
														<th>เวลาเริ่มโปรโมชั่น</th>
														<th>เวลาสิ้นสุดโปรโมชั่น</th>
														<th>ร้านค้าที่อนุญาติ</th>
														<th>แก้ไข</th>
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
												<button type="button" id="del_store" name="del_requisition" class="btn btn-danger text-light btn-block mdi mdi-delete-empty"> ลบโปรโมชั่นร่วม</button>
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
<div id="promotions_container"></div>

<?php $this->load->view("templates/footer"); ?>
<script src="<?php echo base_url("assets/system/plugins/datatables/jquery.dataTables.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/system/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/custom/js/locales/bootstrap-datepicker.th.js"); ?>"></script>
<script src="<?php echo base_url('assets/system/plugins/clockpicker/dist/jquery-clockpicker.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/system/plugins/clockpicker/dist/bootstrap-clockpicker-custom.js'); ?>"></script>

<?php $this->load->assets_by_name('promotions'); ?>   

