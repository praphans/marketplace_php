<?php $this->load->view("templates/header"); ?>

	<?php 
	 foreach ($member as $row) {
		$member_id = $row->member_id;
	}
	?>
		<!-- - - - - - - - - - - - - - Page Wrapper - - - - - - - - - - - - - - - - -->

	<div class="secondary_page_wrapper">
		<div class="container">

			<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

			<ul class="breadcrumbs">

				<li><a href="index.html" class="notcursor">หน้าหลัก</a></li>
				<li>ลงทะเบียนเปิดร้านค้า</li>

			</ul>

			<!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->

			<!-- - - - - - - - - - - - - - ข้อมูลร้านค้า - - - - - - - - - - - - - - - - -->

			<section class="section_offset">

				<h3>บัญชีร้านค้า</h3>

				<div class="theme_box">

					<form id="form_register_step1" action="<?php echo base_url('store/saveCompany'); ?>" method="post">
					<input type="hidden" name="member_id" value="<?php echo $member_id; ?>">
						<ul>
							
							<li class="row">
								
								<div class="col-xs-12">

									<label for="company_name">ตั้งชื่อร้าน</label>
									<input type="text" name="company_name" id="company_name" placeholder="กรุณารับุชื่อร้านของคุณ">
								
								</div><!--/ [col] -->

							</li><!--/ .row -->

							<li class="row">
								
								<div class="col-xs-12">
									
									<label for="url_name">ตั้งURL</label>
									<input type="url" name="url_name" id="url_name" placeholder="กรุณาตั้งชื่อ URL ร้านของคุณ">

								</div><!--/ [col] -->

							</li><!--/ .row -->

							<li class="row">
								
								<div class="col-xs-12">
									
									<label for="password" >ยืนยันรหัสผ่าน</label>
									<input type="password" name="password" id="password" placeholder="กรุณาระบุรหัสผ่านของคุณ">

								</div><!--/ [col] -->

							</li><!--/ .row -->

						</ul>

				

				</div>

				<footer class="bottom_box on_the_sides">

					<div class="col-md-3 col-md-offset-3 col-xs-12">
						<button  class="btn-block button_dark_grey  middle_btn ">ยกเลิก</button>
					</div>

					<div class="col-md-3 col-xs-12">
						<button type="submit" id="submit" class="btn-block button_blue middle_btn ">ตรวจสอบบัญชีร้านค้า</button>
					

					</div>

				</footer>
				</form>
			</section><!--/ .section_offset -->

			<!-- - - - - - - - - - - - - - End of ข้อมูลร้านค้า - - - - - - - - - - - - - - - - -->

		</div><!--/ .container-->
	</div><!--/ .page_wrapper-->
			
		<!-- - - - - - - - - - - - - - End Page Wrapper - - - - - - - - - - - - - - - - -->
<?php $this->load->view("templates/footer"); ?>
<?php $this->load->assets('js'); ?>

<script>
$("#form_register_step1").validate({
	 rules: {
		company_name: {
			required: true
		},
		url_name: {
			required: true
		},
		password: {
			required: true,
			minlength: 5
		},
		
	 }
 });
</script>
