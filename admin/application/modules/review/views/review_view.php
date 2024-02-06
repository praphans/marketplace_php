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
				<h3 class="text-themecolor">รีวิว</h3>
			</div>
			<div class="col-md-7 align-self-center">
				<ol class="breadcrumb">
				<li class="breadcrumb-item"> รีวิว </li>
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
											<select class="form-control custom-select" name="review_type_id" id="review_type_id" onchange="filteringOption();">
												<option value="0">รีวิวทั้งหมด</option>
												<?php
													$review_type_list = $this->model_review->getReviewType();
													foreach($review_type_list as $row){
														$id = $row->id;
														$type_name = $row->type_name;

														if($current_review_type_id == $id){

														}
												
												?>
												<option value="<?php echo $id;?>" <?php if($current_review_type_id == $id){echo 'selected';} ?> ><?php echo $type_name; ?></option>
												<?php } ?>
											</select>
										</div>
									</div><!-- row -->

									<div class="table-responsive pr-3 pl-3">
										<div id="myTable_wrapper" class="dataTables_wrapper no-footer">
											<table id="review_datatable" class="table table-bordered table-striped">
		                                        <thead>
		                                            <tr>
		                                            	<!-- <th>#</th> -->
		                                                <th>วันที่</th>
		                                                <th>รหัสสินค้า</th>
		                                                <th>ร้านค้า/ผู้ส่ง</th>
		                                                <th>รีวิวโดย</th>
		                                                <th>ประเภท</th>
		                                                <th>ความคิดเห็น</th>
		                                                <th>คะแนน</th>
		                                         	
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


<?php $this->load->assets_by_name('review_admin'); ?>  

<script type="text/javascript">
	var current_store_id = "<?php if(isset($current_store_id)) echo $current_store_id; ?>";
	var current_review_type_id = "<?php if(isset($current_review_type_id)) echo $current_review_type_id; ?>";
	$(document).ready(function(){
		initialize(current_review_type_id,current_store_id);
	})
</script>


