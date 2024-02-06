<?php $this->load->view("templates/header"); ?>
  
 <div class="page-wrapper mt-main-wrapper-70">
		<!-- ============================================================== -->
		<!-- Bread crumb and right sidebar toggle -->
		<!-- ============================================================== -->
		<div class="row page-titles ">
			<div class="col-md-5 align-self-center">
				<h3 class="text-themecolor">สินค้า</h3>
			</div>
			<div class="col-md-7 align-self-center">
				<ol class="breadcrumb">
				<li class="breadcrumb-item"> สินค้า</li>
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
						
						<div class="col-lg-12 col-xlg-12 col-md-12 ">
							<div class="card">
								<div class="card-body">
									<div class="row padding-mps_product">
										<div class="col-md-6 col-lg-9 mt-2">
											<div class="input-group">
												<input type="text" class="form-control h-15" id="search_table" placeholder="พิมพ์ข้อความสำหรับการค้นหา ">
												<div class="input-group-append">
													<button class="btn btn-info h-38" type="button">ค้นหา</button>
												</div>
											</div>
										</div>
										<div class="col-md-6 col-lg-3 mt-2">
											<select class="form-control custom-select" name="product_status_id" id="product_status_id" onchange="filteringOption();">
												<option value="0">ทั้งหมด</option>
												<?php
													$product_list = $this->model_product->getProductStatus();
													foreach($product_list as $row){
														$product_status_id = $row->id;
														$product_status_name = $row->status_name;

														if($product_status_id != 5){

													
											
												?>
												<option value="<?php echo $product_status_id;?>"><?php echo $product_status_name; ?></option>
												<?php } }?>
											</select>
										</div>
									</div><!-- row -->

									<div class="table-responsive pr-3 pl-3">
										<div id="myTable_wrapper" class="dataTables_wrapper no-footer">
											<table id="product_datatable" class="table table-bordered table-striped nowrap">
		                                        <thead>
		                                            <tr>
		                                            	<!-- <th>#</th> -->
		                                                <th>รหัสสินค้า</th>
		                                                <th>ชื่อสินค้า</th>
		                                                <th>ราคา</th>
		                                                <th>สต็อก</th>
		                                                <th>ตัวเลือก</th>
		                                                <th>ชื่อร้านค้า</th>
		                                                <!-- <th>Feature</th> -->
		                                         		<th>สถานะ</th>
		                                         		<th>ตัวเลือก</th>
		                                            </tr>
		                                        </thead>
		                                        <tbody>
                                                	
                                                    <!--โหลดข้อมูล-->
		                                            
		                                        </tbody>
		                                    </table>
										</div><!-- myTable_wrapper -->
									</div><!-- table-responsive -->		
									<!-- <div class="col-md-12 col-lg-12 p-t-10">
										<div class="row">
											<div class="col-sm-12 col-md-4 col-lg-3 pb-2">
												<button type="button" id="add_fearture" name="add_fearture" class="btn btn-info text-light btn-block mdi mdi-cards" > เพิ่ม Fearture</button>
											</div>
											<div class="col-sm-12 col-md-4 col-lg-3 pb-2">
												<button type="button" id="add_recommended" name="add_recommended" class="btn btn-warning text-light btn-block mdi mdi-star-circle" > เพิ่มเป็นสินค้าแนะนำ</button>
											</div>
											<div class="col-sm-12 col-md col-lg-6">

											</div>
										</div>
									</div>		 -->	

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

<?php $this->load->assets_by_name('product_admin'); ?>  

<script type="text/javascript">
	var store_id = "<?php if(isset($store_id)) echo $store_id; ?>";
	$(document).ready(function(){
		initialize(store_id);
	})
</script>

<div id="setfeature_container"></div>
