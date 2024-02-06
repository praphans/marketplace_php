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
										
													<h2>เข้าสู่ระบบ </h2>
										
												</div>
										
												<div class="right_side">
										
												
										
												</div>
												
											</header><!--/ .on_the_sides-->
										
											<form id="form_login" action="<?php echo base_url('member/loginMember'); ?>" method="post">
										
												<ul>
										
													<li>
														<label for="login_email">อีเมล</label>
														<input type="text" name="email" id="login_email" placeholder="ระบุที่อยู่อีเมล">
													</li>
										
													<li>
														<label for="login_password">รหัสผ่าน</label>
														<input type="password" name="password" id="login_password" placeholder="ระบุรหัสผ่าน">
													</li>
										
													<li class="">
														<button type="submit" class="btn-block button_blue middle_btn pt-l-r-15">เข้าสู่ระบบ</button>
														<button type="button" class="btn-block button_blue_facebook middle_btn pt-l-r-15"  onclick="FBlogin();"><i class="icon-facebook-1"></i> เข้าสู่ระบบด้วยเฟสบุ้ค</button>
											
													</li>
										
												</ul>
										
											</form>
										
											<hr>
										
											<div class="streamlined">
													<button data-toggle="modal" data-target ="#modal_forgot_password"><i class="icon-key-1"></i> <small>ไม่สามารถเข้าสู่ระบบได้ ลืมรหัสผ่าน !</small></button>
											</div>
										
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


 $("#form_login").validate({
	 rules: {
		email: {
			required: true,
			email: true
		},
		password: {
			required: true,
			minlength: 5
		},
	 }
 });
</script>