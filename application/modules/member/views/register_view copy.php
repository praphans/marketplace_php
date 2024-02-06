<?php $this->load->view("templates/header"); ?>

			<!-- - - - - - - - - - - - - - Page Wrapper - - - - - - - - - - - - - - - - -->

			<div class="secondary_page_wrapper">

				<div class="container">
					<div class="row">
						<div class="col-md-12 col-xs-12 col-sm-12">
							
							<div class="col-md-5 col col-md-offset-4 col-sm-5 col-sm-offset-3 ">
									<div id="login_mw" class="modal_window top_box" style="border-bottom: 1px solid #eaeaea;"> 

									
											<header class="on_the_sides">
										
												<div class="left_side">
													<h2>สมัครใช้งาน</h2>
                                                   
													<p class="pt-10">Marketplace ดอทคอม สมัครฟรี ไม่มีค่าใช้จ่าย</p>
												</div>
												
											</header><!--/ .on_the_sides-->
											 <hr />
											<form id="form_register" action="<?php echo base_url('member/saveUser'); ?>" method="post">
												
												<ul>
													<li>
														<label for="first_name">ชื่อ </label>
														<input type="text" name="first_name" placeholder="กรุณาระบุชื่อจริง" required>
													</li>
													<li>
														<label for="last_name">นามสกุล </label>
														<input type="text" name="last_name" placeholder="กรุณาระบุนามสกุล" required>
													</li>
													<li>
														<label >อีเมล</label>
														<input type="text" name="email" placeholder="กรุณาระบุที่อยู่อีเมล" required>
													</li>
													<li>
														<label for="password">รหัสผ่าน  </label>
														<input type="password" maxlength="10" placeholder="กรุณาระบุรหัสผ่าน" name="password" id="password" required>
													
													</li>
										
													<li>
														<label for="confirm_password">ยืนยันรหัสผ่าน </label>
														<input type="password" placeholder="กรุณายืนยันรหัสผ่านอีกครั้ง" name="confirm_password" required>
													</li>
										
													<li>
														<label for="mobile">เบอร์โทรศัพท์</label>
														<input type="text" name="mobile"placeholder="กรุณาระบุหมายเลขโทรศัพท์" id="mobile"  >
													</li>
										
													<li class="">
															<button type="submit" id="submit" class="btn-block button_blue middle_btn pt-l-r-15 ">สมัครสมาชิก</button>
															<a href="<?php echo site_url("member/login"); ?>" class="btn-block button_blue middle_btn pt-l-r-15 ">เข้าสู่ระบบ</a>
													</li>
										
												</ul>
										
											</form>
										
								
										</div>
							</div>
						</div>
					</div>
					
				</div><!--/ .container-->

			</div><!--/ .page_wrapper-->
			
			<!-- - - - - - - - - - - - - - End Page Wrapper - - - - - - - - - - - - - - - - -->
<?php $this->load->view("templates/footer"); ?>
<?php $this->load->assets('js'); ?>

<script type="text/javascript">
 /* swal("Hello world!"); */
 $("#form_register").validate({
	 rules: {
		first_name: "required",
		last_name: "required",
		email: {
			required: true,
			email: true
		},
		password: {
			required: true,
			minlength: 5
		},
		confirm_password: {
			required: true,
			minlength: 5,
			equalTo: "#password"
		},
		mobile: {
			required: true,
			number:true,
			minlength: 9
		},
	 }
 });
</script>

