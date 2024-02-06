<?php $this->load->view("templates/header"); ?>
<style>

.zoom-in {cursor: zoom-in;}
/*.lb-data{line-height: 1.9em !important}*/
.lb-details{line-height: 1.9em !important;}
</style>
 <div class="page-wrapper mt-main-wrapper-70">
	
		<div class="row page-titles">
			<div class="col-md-5 align-self-center">
				<h3 class="text-themecolor">Slide banner</h3>
			</div>
			<div class="col-md-7 align-self-center">
				<ol class="breadcrumb">
				<li class="breadcrumb-item">ตั้งค่า</a></li>
				<li class="breadcrumb-item"> Slide banner</li>
				</ol>
			</div>
		</div>
		
	
		<div class="container-fluid">
		
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
                                        	<button onClick="loadModal('myModalAddSlidebanner')" class="btn btn-success waves-effect waves-light btn-block d-flex justify-content-between" type="button"><span class="btn-label"><i class="fa fa-plus"></i></span>เพิ่ม Slide banner<a></a></button>
										</div>
									</div><!-- row -->

									<div class="table-responsive pr-3 pl-3">
										<div id="myTable_wrapper" class="dataTables_wrapper no-footer">
											<table id="slidebanner_datatable" class="table table-bordered table-striped">
		                                        <thead>
		                                            <tr>
		                                                <th>#</th>
		                                                <th>ชื่อรูปภาพ</th>
														<th>Hyperlink</th>
														<th>รูปภาพ</th>
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
												<button type="button" id="del_slidebanner" name="del_slidebanner" class="btn btn-danger text-light btn-block mdi mdi-delete-empty"> ลบรูปภาพ</button>
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


<?php $this->load->view("templates/footer"); ?>
<script src="<?php echo base_url("assets/system/plugins/datatables/jquery.dataTables.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/system/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/custom/js/locales/bootstrap-datepicker.th.js"); ?>"></script>
<script src="<?php echo base_url('assets/system/plugins/clockpicker/dist/jquery-clockpicker.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/system/plugins/clockpicker/dist/bootstrap-clockpicker-custom.js'); ?>"></script>

<?php $this->load->assets_by_name('slidebanner'); ?>   

<div id="slidebanner_container"></div>