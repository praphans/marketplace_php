<?php $this->load->view("templates/header"); ?>


	<!-- - - - - - - - - - - - - - Page Wrapper - - - - - - - - - - - - - - - - -->

	<div class="secondary_page_wrapper">

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

				<ul class="breadcrumbs">

					<li><a href="index.html" class="notcursor">หน้าหลัก</a></li>
					<li>ลงทะเบียนเปิดร้านค้า</li>

				</ul>

				<!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->

				<!-- - - - - - - - - - - - - - ข้อมูลร้านค้า - - - - - - - - - - - - - - - - -->
				<form id="form_register_step2" class="type_2" action="<?php echo base_url('store/saveShopRegister2'); ?>" method="post">
					<section class="section_offset">

						<h3>ข้อมูลร้านค้า</h3>

						<div class="theme_box">

							
								
								<ul>

									<li class="row">

										<div class="col-sm-6">

											<label class="required">ประเภทร้านค้า</label>

											<!--  <div class="custom_select">  -->
												<select id="shop_type" name="shop_type">
													<option value="">ทั้งหมด</option>
													<option value="บุคคลธรรมดา">บุคคลธรรมดา</option>
													<option value="นิติบุคคล">นิติบุคคล</option>
												</select>
											<!-- </div>  -->

										</div><!--/ [col] -->

									</li><!--/ .row -->

									<li class="row pt-10">

										<div class="col-sm-6">

											<label class="required">หมวดหมู่ร้านค้า</label>

											<!-- <div class="custom_select"> -->

												<select id="shop_category" name="shop_category">

													<option value="หมวดหมู่ที่ 1">หมวดหมู่ที่ 1</option>
													<option value="หมวดหมู่ที่ 2">หมวดหมู่ที่ 2</option>
													<option value="หมวดหมู่ที่ 3">หมวดหมู่ที่ 3</option>
													<option value="หมวดหมู่ที่ 4">หมวดหมู่ที่ 4</option>
													<option value="หมวดหมู่ที่ 5">หมวดหมู่ที่ 5</option>
													<option value="หมวดหมู่ที่ 6">หมวดหมู่ที่ 6</option>

												</select>

										<!-- 	</div> -->

										</div><!--/ [col] -->

									</li><!--/ .row -->

									<li class="row pt-10">
										
										<div class="col-sm-6">
											
											<label for="first_name" class="required">ชื่อ</label>
											<input type="text" name="first_name" id="first_name">

										</div><!--/ [col] -->

										<div class="col-sm-6">
											
											<label for="last_name" class="required">นามสกุล</label>
											<input type="text" name="last_name" id="last_name">

										</div><!--/ [col] -->

									</li><!--/ .row -->

									<li class="row pt-5">
										
										<div class="col-sm-6">
											
											<label for="company_name" class="required">เลขประจำตัวประชาชน</label>
											<input type="number" name="identification_number" id="">

										</div><!--/ [col] -->

									</li><!--/ .row -->
									
									<li class="row pt-5">
										
										<div class="col-sm-6">
											
											<label for="Tel" class="required">โทรศัพท์</label>
											<input type="number" name="tel" id="tel">

										</div><!--/ [col] -->

									</li><!--/ .row -->

									<li class="row pt-5">

										<div class="col-sm-6">

											<label class="required">จังหวัด</label>

											<!-- <div class="custom_select"> -->

												<select id="province" name="province">

													<option value="กรุณาระบุจังหวัด">กรุณาระบุจังหวัด</option>
													<option value="กรุงเทพมหานคร">กรุงเทพมหานคร</option>
													<option value="กาญจนบุรี">กาญจนบุรี</option>
													<option value="กำแพงเพชร">กำแพงเพชร</option>
													<option value="ขอนแก่น">ขอนแก่น</option>
													<option value="จันทรบุรี">จันทรบุรี</option>

												</select>

											<!-- </div> -->

										</div><!--/ [col] -->

									</li><!--/ .row -->

									<li class="row pt-5">

										<div class="col-sm-6">

											<label class="required">อำเภอ / เขต</label>

											<!-- <div class="custom_select"> -->

												<select id="district" name="district">

													<option value="กรุณาระบุเขต / อำเภอ">กรุณาระบุอำเภอ / เขต</option>
													<option value="เมือง">เมือง</option>
													<option value="ปากเกร็ด">ปากเกร็ด</option>
													<option value="บางใหญ่">บางใหญ่</option>
													<option value="บางนา">บางนา</option>

												</select>

											<!-- </div> -->

										</div><!--/ [col] -->

									</li><!--/ .row -->

									<!--<li class="row pt-5">

										<div class="col-sm-6">

											<label class="required">ตำบล / แขวง</label>

											

												<select id="subdistrict" name="subdistrict">

													<option value="กรุณาระบุตำบล / แขวง">กรุณาระบุตำบล / แขวง</option>
													<option value="เมือง">เมือง</option>
													<option value="ปากเกร็ด">ปากเกร็ด</option>
													<option value="บางใหญ่">บางใหญ่</option>
													<option value="บางนา">บางนา</option>

												</select>

											

										</div>

									</li>-->

									<li class="row pt-5">	

										<div class="col-xs-12">

											<label class="required">ที่อยู่</label>
											<textarea type="text" name="address" id=""></textarea>
											<small>ระบุอาคาร เลขที่บ้าน หมู่บ้าน ถนน ตำบล/แขวง รายละเอียดสถานที่</small>

										</div><!--/ [col] -->

									</li><!-- / .row -->

									<li class="row pt-5">
										
										<div class="col-sm-6">
											
											<label for="zipcode" class="required">รหัสไปรษณีย์</label>
											<input type="number" name="zipcode" id="">

										</div><!--/ [col] -->

									</li><!--/ .row -->

								</ul>

						

						</div>

					</section><!--/ .section_offset -->

					<!-- - - - - - - - - - - - - - End of ข้อมูลร้านค้า - - - - - - - - - - - - - - - - -->

					<!-- - - - - - - - - - - - - - ข้อมูลบัญชีธนาคาร - - - - - - - - - - - - - - - - -->

					<section class="section_offset">

						<h3>ข้อมูลบัญชีธนาคาร</h3>

						<div class="theme_box">

						
								
								<ul>

									<li class="row">

										<div class="col-xs-12">

											<h5 class="red">* เงินจะถูกโอนไปยังบัญชีนี้ ชื่อบัญชีต้องตรงกับชื่อบุคคล หรือนิติบุคคลที่ลงทะเบียน</h5>

										</div><!--/ [col] -->

									</li><!--/ .row -->

									<li class="row pt-5">
										
										<div class="col-xs-12">
											
											<label  class="required">ชื่อบัญชี</label>
											<input type="text" name="account_name" id="account_name">

										</div><!--/ [col] -->

									</li><!--/ .row -->

									<li class="row pt-5">
										
										<div class="col-xs-12">
											
											<label  class="required">เลขบัญชี</label>
											<input type="text" name="account_number" id="account_number">

										</div><!--/ [col] -->

									</li><!--/ .row -->

									<li class="row pt-5">

										<div class="col-sm-6">

											<label class="required">ชื่อธนาคาร</label>

										<!-- 	<div class="custom_select"> -->

												<select id="bank_name" name="bank_name">

													<option value="กสิกรไทย">ธนาคารกสิกรไทย</option>
													<option value="ธนาคารกรุงไทย">ธนาคารกรุงไทย</option>
													<option value="ธนาคารกรุงเทพ">ธนาคารกรุงเทพ</option>
													<option value="ธนาคารยูโอบี">ธนาคารยูโอบี</option>

												</select>

											<!-- </div> -->

										</div><!--/ [col] -->

									</li><!--/ .row -->

								</ul>

						

						</div>

					</section><!--/ .section_offset -->

					<!-- - - - - - - - - - - - - - End of ข้อมูลบัญชีธนาคาร - - - - - - - - - - - - - - - - -->

					<!-- - - - - - - - - - - - - - อัพโหลดเอกสาร - - - - - - - - - - - - - - - - -->

					<section class="section_offset">

						<h3>อัพโหลดเอกสาร</h3>

						<div class="theme_box">

						
								
								<ul>

									<li class="row">
										
										<div class="col-xs-12">
											
											<label  class="required">หนังสือจดทะเบียนนิติบุคคล</label>

										</div><!--/ [col] -->
										<div class="col-md-3">
										<!-- <input type="file" class=""> -->
										<a href="#" class="button_grey big_btn btn-block"><i class="icon-upload-cloud"></i>อัพโหลด</a>
										</div>

									</li><!--/ .row -->

									<li class="row">
										
										<div class="col-xs-12">
										
											<label  class="required">สำเนาบัตรประชาชนในนามบุคคล</label>

										</div><!--/ [col] -->
										<div class="col-md-3">
											<!-- <input type="file" id="imgupload" style="display:none"/> 
											<button id="OpenImgUpload" class="button_grey big_btn btn-block"><i class="icon-upload-cloud"></i> Image Upload</button> -->
											<a href="#" class="button_grey big_btn btn-block"><i class="icon-upload-cloud"></i>อัพโหลด</a>
										</div>

									</li><!--/ .row -->

									<li class="row">
										
										<div class="col-xs-12">
											
											<label  class="required">สำเนาบัตรประชาชนของคณะกรรมการผู้มีอำนาจลงนามทั้งหมดที่มีรายชื่อในหนังสือจดทะเบียนนิติบุคคล</label>

										</div><!--/ [col] -->
										<div class="col-md-3">
										<a href="" class="button_grey big_btn btn-block"><i class="icon-upload-cloud"></i>อัพโหลด</a>  
										</div>

									</li><!--/ .row -->

									<li class="row">
										
										<div class="col-xs-12">
											
											<label  class="required">หนังสือจดทะเบียน ภพ.20</label>

										</div><!--/ [col] -->
										<div class="col-md-3">
											<a href="#" class="button_grey big_btn btn-block"><i class="icon-upload-cloud"></i>อัพโหลด</a>
										</div>

									</li><!--/ .row -->

									<li class="row">
										
										<div class="col-xs-12">
											
											<label  class="required">สำเนาหน้าสมุดบัญชีธนาคารที่มีชื่อตรงกับผู้ลงทะเบียน</label>

										</div><!--/ [col] -->
										<div class="col-md-3">
											<a href="#" class="button_grey big_btn btn-block"><i class="icon-upload-cloud"></i>อัพโหลด</a>
										</div>

									</li><!--/ .row -->

									<li class="row">
										
										<div class="col-xs-12">
											
											<label  >อื่นๆ</label>

										</div><!--/ [col] -->
										<div class="col-md-3">
											<a href="#" class="button_grey big_btn btn-block"><i class="icon-upload-cloud"></i>อัพโหลด</a>
										</div>

									</li><!--/ .row -->

								</ul>

						

						</div>

					</section><!--/ .section_offset -->

					<!-- - - - - - - - - - - - - - End of อัพโหลดเอกสาร - - - - - - - - - - - - - - - - -->
					<div class="row">
						<div class="col-md-3 col-md-offset-3 col-xs-12">
							<a href="" class="btn-block button_dark_grey  middle_btn">ยกเลิก</a>
						</div>
						<div class="col-md-3 col-xs-12">
							<button type="submit" id="submit" class="btn-block button_blue middle_btn">ลงทะเบียนเปิดร้าน</button>
						</div>
					</div>
					
				</form>
			</div>
		</div>
	</div><!--/ .container-->

</div><!--/ .page_wrapper-->
			
		<!-- - - - - - - - - - - - - - End Page Wrapper - - - - - - - - - - - - - - - - -->
<?php $this->load->view("templates/footer"); ?>
<?php $this->load->assets('js'); ?>

<script>
$("#form_register_step2").validate({
	 rules: {

		first_name: "required",
		last_name: "required",
		shop_type: "required",
		shop_category: "required",
		identification_number: {
			required: true,
			maxlength: 13
		},
		tel: {
			required: true,
			maxlength: 10
		},
		province: "required",
		district: "required",
		address: "required",
		zipcode: "required",
		account_name: "required",
		account_number: "required",
		bank_name: "required"
	 }
 });
</script>
