<?php $this->load->view("templates/header"); ?>

			<!-- - - - - - - - - - - - - - Page Wrapper - - - - - - - - - - - - - - - - -->

			<div class="secondary_page_wrapper">

				<div class="container">
					<div class="row">
						<div class="col-md-12 col-xs-12 col-sm-12">
							
							
									<div class=" top_box" style="border-bottom: 1px solid #eaeaea;"> 

									
											<header class="on_the_sides">
										
												<div class="left_side">
													<h2>สมัครใช้งาน</h2>
                                                   
													<p class="pt-10">Marketplace สมัครฟรี ไม่มีค่าใช้จ่าย</p>
												</div>
												
											</header><!--/ .on_the_sides-->
											 <hr />
											<form id="form_register" action="<?php echo base_url('member/saveUser'); ?>" method="post">

												<div class="row">
													<div class="col-md-6 pt-10">
														<label for="first_name">ชื่อที่ใช้ </label>
														<input type="text" name="first_name" placeholder="กรุณาระบชื่อที่ใช้" required>
													</div>
                                                    <div class="col-md-6 pt-10">
														<label for="email">อีเมล</label>
														<input type="text" name="email" placeholder="กรุณาระบุที่อยู่อีเมล" required>
													</div>
													<!--<div class="col-md-6 pt-10">
														<label for="last_name">นามสกุล </label>
														<input type="text" name="last_name" placeholder="กรุณาระบุนามสกุล" required>
													</div>-->
												</div>

												<div class="row">
													
                                                    <div class="col-md-6 pt-10">
														<label for="mobile">เบอร์โทรศัพท์</label>
														<input type="text" name="mobile"placeholder="กรุณาระบุหมายเลขโทรศัพท์" id="mobile"  >
													</div>
                                                    <div class="col-md-6 pt-10">
														<label for="password">รหัสผ่าน  </label>
														<input type="password" maxlength="10" placeholder="กรุณาระบุรหัสผ่าน" name="password" id="password" required>
													
													</div>
												</div>

												<div class="row">
													
													<div class="col-md-6 pt-10">
														<label for="confirm_password">ยืนยันรหัสผ่าน </label>
														<input type="password" placeholder="กรุณายืนยันรหัสผ่านอีกครั้ง" name="confirm_password" required>
													</div>
												</div>
										
												<div class="row">	  
                                                    <div class="col-md-12 pt-20">
                                                    	<input type="checkbox" name="term_accept" id="term_accept" required>
                                						<label for="term_accept">เมื่อคลิก สมัครใช้งาน แสดงว่าคุณยินยอมตามข้อกำหนด <a href="<?php echo base_url("condition"); ?>" target="_blank">นโยบายข้อมูล และนโยบายคุกกี้</a>ของเราแล้ว คุณอาจได้รับการแจ้งเตือนทาง อีเมล จากเราและสามารถเลือกไม่รับได้ทุกเมื่อ</label>	
                                                        <label for="term_accept" class="error"></label>
													</div>
													
													<br />
													<div class="col-md-6 pt-20">
                                                    <div class="row">
                                                    		 <div class="col-md-6 ">
															<button type="submit" id="submit" class="btn-block button_blue middle_btn pt-l-r-15 "><i class="icon-user-add"></i> ลงทะเบียนใช้งานเว็บไซต์</button>
                                                            </div>
                                                            <div class="col-md-6 ">
															<!-- <a href="<?php //echo site_url("member/login"); ?>" class="btn-block  button_blue middle_btn pt-l-r-15 "><i class="icon-login-1"></i> เข้าสู่ระบบ</a> -->
															</div>
                                                    </div>
													</div>
												</div>
												
											</form>
										
								
										</div>
							</div>
						
					</div>
					
				</div><!--/ .container-->

			</div><!--/ .page_wrapper-->
			
			<!-- - - - - - - - - - - - - - End Page Wrapper - - - - - - - - - - - - - - - - -->
<?php $this->load->view("templates/footer"); ?>
<?php $this->load->assets('js'); ?>

<script type="text/javascript">
 
 $("#form_register").validate({
	 rules: {
		first_name: "required",
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

		term_accept:{
			required: true
		}
	 },
	messages:{
		'term_accept': "กรุณายอมรับเงื่อนไขข้อกำหนดการใช้งานเว็บไซต์"
	},
	
 });
</script>

