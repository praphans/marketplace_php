<?php $this->load->view("templates/header"); ?>

			<!-- - - - - - - - - - - - - - Page Wrapper - - - - - - - - - - - - - - - - -->

			<div class="secondary_page_wrapper">

				<div class="container">
					<div class="row">
						<div class="col-md-12 col-xs-12 col-sm-12">
							<div class="col-md-5 col col-md-offset-4 col-sm-5 col-sm-offset-3">
									<div id="login_mw" class="modal_window top_box" style="border-bottom: 1px solid #eaeaea;"> 

											<header class="on_the_sides">
										
												<div class="left_side">
										
													<h2>เปลี่ยนรหัสผ่าน </h2>
										
												</div>
										
												<div class="right_side">
										
												
										
												</div>
										
											</header><!--/ .on_the_sides-->
										
											<form id="form_forgot" action="<?php echo base_url('member/resetpassword'); ?>" method="post">
										
												<ul>
										
													<li>
														<label for="login_email">อีเมล</label>
														<input type="text" name="email" id="login_email" placeholder="ระบุที่อยู่อีเมล" >
													</li>
										
													<li>
														<label for="new_password">รหัสผ่านใหม่</label>
														<input type="password" name="new_password" id="new_password" placeholder="ระบุรหัสผ่านใหม่">
													</li>
													<li>
														<label for="re_new_password">ยืนยันรหัสผ่านใหม่</label>
														<input type="password" name="re_new_password" id="re_new_password" placeholder="ระบุรหัสผ่านใหม่อีกครั้ง">
													</li>
													<li class="">
														<button type="submit" class="btn-block button_blue middle_btn pt-l-r-15">เปลี่ยนรหัสผ่านใหม่</button>
														
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
<?php $this->load->view("member/modals/modal_forgot_password"); ?>
<?php $this->load->view("templates/footer"); ?>
<?php $this->load->assets('js'); ?>
<script type="text/javascript">


 $("#form_forgot").validate({
	 rules: {
		email: {
			required: true,
			email: true
		},
		new_password: {
			required: true,
			minlength: 5
		},
		re_new_password: {
			required: true,
			minlength: 5,
			equalTo: "#new_password"
		}
	 }
 });
</script>