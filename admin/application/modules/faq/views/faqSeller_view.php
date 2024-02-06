<?php 
	$this->load->view("templates/header");
	$this->load->assets("css");
?>
  
 <div class="page-wrapper mt-main-wrapper-70">
		<!-- ============================================================== -->
		<!-- Bread crumb and right sidebar toggle -->
		<!-- ============================================================== -->
		<div class="row page-titles">
			<div class="col-md-5 align-self-center">
				<h3 class="text-themecolor">บัญชีร้านค้า</h3>
			</div>
			<div class="col-md-7 align-self-center">
				<ol class="breadcrumb">
				<li class="breadcrumb-item">ช่วยเหลือ</a></li>
				<li class="breadcrumb-item"> บัญชีร้านค้า</li>
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
										<div class="col-md-6 col-lg-6 pr-md-0 pr-lg-0">
											<div class="input-group mt-2">
												<input type="text" class="form-control h-15" id="search_table" placeholder="พิมพ์ข้อความสำหรับการค้นหา ">
												<div class="input-group-append">
													<button class="btn btn-info h-38" type="button">ค้นหา</button>
												</div>
											</div>
										</div>
										<div class="col-md-2 col-lg-3 mt-2">
											<select class="form-control custom-select" name="faq_cat_id" id="faq_cat_id" onchange="filteringOptionSeller();">
												<option value="0">ทั้งหมด</option>
												<?php
													$faq_cat_list = $this->model_faq->getFaqCategory();
													foreach($faq_cat_list as $row){
														$faq_cat_id = $row->id;
														$category_name = $row->category_name;
												
												?>
												<option value="<?php echo $faq_cat_id;?>"><?php echo $category_name; ?></option>
												<?php } ?>
											</select>
										</div>
										<div class="col-md-4 col-lg-3 mt-2">
											<button type="button" href="javascript:void(0)" data-toggle="modal" data-target="#myModalAddFaqSeller" class="btn btn-success waves-effect waves-light btn-block d-flex justify-content-between" ><span class="btn-label"><i class="fa fa-plus"></i></span>เพิ่มคำถามที่พบบ่อย<a></a></button>
										</div>

									</div> 

									<div class="table-responsive pr-3 pl-3">
										<div id="myTable_wrapper" class="dataTables_wrapper no-footer">
											<table id="faqSell_datatable" class="table table-bordered table-striped">
		                                        <thead>
		                                            <tr>
		                                            	<th>#</th>
		                                            	<th>วันที่</th>
		                                                <th>คำถาม</th>
		                                                <th>คำตอบ</th>
														<th>ประเภท</th>
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
											<div class="col-sm-12 col-md-4 col-lg-2">
												<button type="button" id="del_faq_seller" name="del_faq_seller" class="btn btn-danger text-light btn-block mdi mdi-delete-empty"> ลบคำถามที่พบบ่อย</button>
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

<?php $this->load->assets_by_name('faq_admin'); ?>   
<?php $this->load->view("modals/add_seller_view"); ?>
<div id="seller_container"></div>