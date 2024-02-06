<?php 
	$this->load->view("templates/header");
	$this->load->assets("css");
?>

<?php 

	

?>
  
 <div class="page-wrapper mt-main-wrapper-70">
		<!-- ============================================================== -->
		<!-- Bread crumb and right sidebar toggle -->
		<!-- ============================================================== -->
		<div class="row page-titles ">
			<div class="col-md-5 align-self-center">
				<h3 class="text-themecolor">สถานที่ส่งสินค้า</h3>
			</div>
			<div class="col-md-7 align-self-center">
				<ol class="breadcrumb">
				<li class="breadcrumb-item"> สถานที่ส่งสินค้า </li>
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
											<div class="input-group ">
												<input type="text" class="form-control h-15" id="search_table" placeholder="พิมพ์ข้อความสำหรับการค้นหา ">
												<div class="input-group-append">
													<button class="btn btn-info h-38" type="button">ค้นหา</button>
												</div>
											</div>
										</div>
										<div class="col-md-6 col-lg-3 mt-2">
											<select class="form-control custom-select" name="shipping_type_id" id="shipping_type_id" onchange="filteringOption();">
												<option value="0" class="selected_type">สถานที่ทั้งหมด</option>
												<option value="1" class="selected_type">สถานที่ขายสินค้า</option>
												<option value="2" class="selected_type">สถานที่ฝากส่ง</option>
												<option value="3" class="selected_type">เขตพื้นที่บริการ</option>
												<option value="4" class="selected_type">ที่อยู่ผู้ซื้อ</option>
											</select>
										</div>
									</div><!-- row -->

									<div class="table-responsive pr-3 pl-3">
										<div id="myTable_wrapper" class="dataTables_wrapper no-footer">
											<table id="place_datatable" class="table table-bordered table-striped nowrap">
		                                        <thead>
		                                            <tr>
		                                            	<!-- <th>#</th> -->
		                                                <th>รหัส</th>
		                                                <th>สถานที่</th>
		                                                <th>เจ้าของ</th>
		                                                <th>จำนวนร้านค้า</th>
		                                                <!-- <th>เบอร์โทรศัพท์</th> -->
		                                         	
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


<?php $this->load->view("templates/footer"); ?>
<script src="<?php echo base_url("assets/system/plugins/datatables/jquery.dataTables.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/system/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/custom/js/locales/bootstrap-datepicker.th.js"); ?>"></script>


<?php $this->load->assets_by_name('place_admin'); ?>  

<script type="text/javascript">
	var current_shipping_type_id = "<?php if(isset($current_shipping_type_id)) echo $current_shipping_type_id; ?>";
	$(document).ready(function(){
		initialize(current_shipping_type_id);
	})



</script>


