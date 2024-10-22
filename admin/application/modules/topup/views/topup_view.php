<?php $this->load->view("templates/header"); ?>
  
 <div class="page-wrapper mt-main-wrapper-70">
		<!-- ============================================================== -->
		<!-- Bread crumb and right sidebar toggle -->
		<!-- ============================================================== -->
		<div class="row page-titles">
			<div class="col-md-5 align-self-center">
				<h3 class="text-themecolor">เหรียญ</h3>
			</div>
			<div class="col-md-7 align-self-center">
				<ol class="breadcrumb">
				<li class="breadcrumb-item"> เหรียญ</a></li>
				<li class="breadcrumb-item"> เติมเงิน</a></li>
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
										<div class="col-sm-12 col-md-8 col-lg-9 pr-md-0 pr-lg-0">
											<div class="input-group mt-2">
												<input type="text" class="form-control h-15" id="search_table" placeholder="พิมพ์ข้อความสำหรับการค้นหา ">
												<div class="input-group-append">
													<button class="btn btn-info h-38" type="button">ค้นหา</button>
												</div>
											</div>
										</div>
										<div class="col-sm-12 col-md-4 col-lg-3 mt-2">
                                        	<button onClick="loadModal('myModalSetCoin')" class="btn btn-success btn-block" type="button"><i class="mdi mdi-coin f-16"></i>ตั้งค่ามูลค่าเหรียญ</button>
										</div>
									</div><!-- row -->

									<div class="table-responsive pr-3 pl-3">
										<div id="myTable_wrapper" class="dataTables_wrapper no-footer">
											<table id="topup_datatable" class="table table-bordered table-striped nowrap">
		                                        <thead>
		                                            <tr>
		                                            	<th>วันที่</th>
		                                            	<th>สมาชิก</th>
		                                                <th>รหัสเติมเงิน</th>
		                                                <th>จำนวนเหรียญ</th>
		                                                <th>จำนวนเงิน / บาท</th>
		                                         
		                                            </tr>
		                                        </thead>
		                                        <tbody>
                                                	
                                                    <!--โหลดข้อมูล-->
		                                            
		                                        </tbody>
		                                    </table>
										</div><!-- myTable_wrapper -->
									</div><!-- table-responsive -->
									

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
<div id="topup_container"></div>

<?php $this->load->view("templates/footer"); ?>
<script src="<?php echo base_url("assets/system/plugins/datatables/jquery.dataTables.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/system/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/custom/js/locales/bootstrap-datepicker.th.js"); ?>"></script>

<?php $this->load->assets_by_name('topup'); ?>   

