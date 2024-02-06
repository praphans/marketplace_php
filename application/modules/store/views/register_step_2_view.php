<?php $this->load->view("templates/header"); ?>


	<!-- - - - - - - - - - - - - - Page Wrapper - - - - - - - - - - - - - - - - -->
<form id="form_register" class="type_2" action="<?php echo base_url('store/createStoreInfo'); ?>" method="post" enctype="multipart/form-data">
	<div class="secondary_page_wrapper">

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

				<ul class="breadcrumbs">

					<li><a href="<?php echo base_url(); ?>" class="notcursor">หน้าหลัก</a></li>
					<li>ลงทะเบียนเปิดร้านค้า</li>

				</ul>

				<!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->

				<!-- - - - - - - - - - - - - - ข้อมูลร้านค้า - - - - - - - - - - - - - - - - -->
				
					<section class="section_offset">

						<h3>ข้อมูลร้านค้า</h3>

						<div class="theme_box">

							
								
								<ul>

									<li class="row">

										<div class="col-sm-6">
											<input type="hidden" name="district" value="0" />
											<label class="required">ประเภทร้านค้า</label>
                                            <select id="store_type" name="store_type">
                                                <?php
													$store_type = $this->storemanager->getStoreType();
													foreach($store_type as $row){
														$id = $row->id;
														$type_name = $row->type_name;
													
												?>
                                                <option value="<?php echo $id; ?>"><?php echo $type_name; ?></option>
                                                <?php } ?>
                                            </select>
										</div>

									</li><!--/ .row -->

									<li class="row pt-10">

										<div class="col-sm-6">

											<label class="required">หมวดหมู่ร้านค้า</label>
											<select id="store_category" name="store_category">
                                                <?php
													$store_category = $this->storemanager->getStoreCategory();
													foreach($store_category as $row){
														$id = $row->id;
														$category_name = $row->category_name;
													
												?>
                                                <option value="<?php echo $id; ?>"><?php echo $category_name; ?></option>
                                                <?php } ?>
                                            </select>

										</div><!--/ [col] -->

									</li><!--/ .row -->
									<li class="row pt-20 pb-10">

										<div class="col-sm-6">
											<input type="checkbox" name="store_is_vat" id="store_is_vat" onclick="hideCk()">
											<label for="store_is_vat">สถานภาพผู้ประกอบการจดทะเบียนภาษีมูลค่าเพิ่ม</label>
										</div><!--/ [col] -->

									</li><!--/ .row -->

									<li class="row pt-10">
										
										<div class="col-sm-6">
											
											<label for="first_name" class="required" id="is_company_first_name">ชื่อ</label>
											<input type="text" name="first_name" id="first_name" value="<?php echo $this->membermanager->first_name(); ?>">

										</div><!--/ [col] -->

										<div class="col-sm-6">
											<label for="last_name" class="required" id="is_company_last_name">นามสกุล</label>
											<input type="text" name="last_name" id="last_name" value="<?php echo $this->membermanager->last_name(); ?>">
										</div>
									</li>

									<li class="row pt-5">
										
										<div class="col-sm-6" >
											<label for="identity_number" class="required" id="is_company">เลขประจำตัวประชาชน</label>
											<input type="text" onkeypress='return isNumberKey(event)' name="identity_number" id="identity_number" placeholder="000-000-000-0000" maxlength="13" required>
										</div><!--/ [col] -->

									</li><!--/ .row -->
									
									<li class="row pt-5">
										
										<div class="col-sm-6">
											<label for="Tel" class="required">โทรศัพท์</label>
											<input type="text" name="tel" id="tel" placeholder="ระบุหมายเลขโทรศัพท์มือถือ" value="" required>
										</div><!--/ [col] -->

									</li><!--/ .row -->

									<li class="row pt-5">

										<div class="col-sm-6">

											<label class="required">จังหวัด</label>
                                            <select id="province" name="province">
                                            </select>


										</div><!--/ [col] -->

									</li><!--/ .row -->

									<li class="row pt-5">

										<div class="col-sm-6">

											<label class="required">อำเภอ / เขต</label>
                                            <select id="amphur" name="amphur">
											<option value="0">ระบุอำเภอ</option>
                                            </select>

										</div><!--/ [col] -->

									</li><!--/ .row -->

									<!--<li class="row pt-5">

										<div class="col-sm-6">

											<label class="required">ตำบล / แขวง</label>
                                            <select id="district" name="district">
											<option value="0">ระบุตำบล</option>
                                            </select>

										</div>

									</li>-->

									<li class="row pt-5">	

										<div class="col-xs-12">

											<label class="required">ที่อยู่</label>
											<textarea type="text" name="address" id="address" placehoder="ที่อยู่ที่สามารถติดต่อได้"></textarea>
											<small>ระบุอาคาร เลขที่บ้าน หมู่บ้าน ถนน ตำบล/แขวง รายละเอียดสถานที่</small>

										</div><!--/ [col] -->

									</li><!-- / .row -->

									<li class="row pt-5">
										
										<div class="col-sm-6">
											
											<label for="zipcode" class="required">รหัสไปรษณีย์</label>
											<input type="text" name="zipcode" id="zipcode" value="11120">

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
											<input type="text" name="account_name" id="account_name" placeholder="ชื่อ - นามสกุล เจ้าของบัญชี">

										</div><!--/ [col] -->

									</li><!--/ .row -->

									<li class="row pt-5">
										
										<div class="col-xs-12">
											
											<label  class="required">เลขบัญชี</label>
											<input type="text" name="account_number" id="account_number" placeholder="ระบุเลขที่บัญชี">

										</div><!--/ [col] -->

									</li><!--/ .row -->

									<li class="row pt-5">

										<div class="col-sm-6">

											<label class="required">ชื่อธนาคาร</label>
                                            <select id="bank_name" name="bank_name">
                                            <?php
											$store_bank = $this->storemanager->getStoreBank();
											foreach($store_bank as $row){
												$id = $row->id;
												$bank_name = $row->bank_name;
											?>
											<option value="<?php echo $bank_name; ?>"><?php echo $bank_name; ?></option>
											<?php } ?>
                                           </select>
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

									<li class="row" id="company_required">
										
										<div class="col-xs-12">
											
											<label  class="required">สำเนาหนังสือรับรองนิติบุคคล พร้อมลงนามรับรองสำเนาถูกต้องโดยกรรมการผู้มีอำนาจ และประทับตราบริษัท</label>

										</div><!--/ [col] -->
										<div class="col-md-3">
                                            <label for="company" class="button_grey big_btn btn-block form-control custom-file-upload">
                                                <i class="icon-upload-cloud"></i> อัพโหลดไฟล์<span class="filename"></span>
                                            </label>
                                            <input id="company" type="file" name="company_doc[]" accept="image/png,image/gif,image/jpeg" required multiple>
										</div>

									</li><!--/ .row -->

									<li class="row" id="identity_single_required">
										
										<div class="col-xs-12">
										
											<label  class="required">สำเนาบัตรประชาชนในนามบุคคล พร้อมลงนามรับรองสำเนาถูกต้อง</label>

										</div><!--/ [col] -->
										<div class="col-md-3">
											<label for="identity" class="button_grey big_btn btn-block form-control custom-file-upload">
                                                <i class="icon-upload-cloud"></i> อัพโหลดไฟล์ <span></span>
                                            </label>
                                            <input id="identity" type="file" name="identity_doc[]" accept="image/png,image/gif,image/jpeg" required multiple>
										</div>

									</li><!--/ .row -->
									<li class="row" id="house_particular_required">
										
										<div class="col-xs-12">
										
											<label  class="required">สำเนาทะเบียนบ้าน พร้อมลงนามรับรองสำเนาถูกต้อง</label>

										</div><!--/ [col] -->
										<div class="col-md-3">
											<label for="house_particular" class="button_grey big_btn btn-block form-control custom-file-upload">
                                                <i class="icon-upload-cloud"></i> อัพโหลดไฟล์ <span></span>
                                            </label>
                                            <input id="house_particular" type="file" name="house_particular_doc[]" accept="image/png,image/gif,image/jpeg" required multiple>
										</div>

									</li><!--/ .row -->

									<li class="row" id="identity_multi_required">
										
										<div class="col-xs-12">
											
											<label  class="required">สำเนาบัตรประชาชนของกรรมการผู้มีอำนาจลงนามทั้งหมดที่มีรายชื่อในหนังสือจดทะเบียนนิติบุคคล พร้อมลงนามรับรองสำเนาถูกต้อง</label>

										</div><!--/ [col] -->
										<div class="col-md-3">
											<label for="identity_multi" class="button_grey big_btn btn-block form-control custom-file-upload">
                                                <i class="icon-upload-cloud"></i> อัพโหลดไฟล์
                                            </label>
                                            <input id="identity_multi" type="file" name="identity_multi_doc[]" accept="image/png,image/gif,image/jpeg" required multiple>
										</div>

									</li><!--/ .row -->

									<li class="row" id="book_twenty_required">
										
										<div class="col-xs-12">
											
											<label  class="required">หนังสือจดทะเบียน ภพ.20 พร้อมลงนามรับรองสำเนาถูกต้อง</label>

										</div><!--/ [col] -->
										<div class="col-md-3">
											<label for="book_twenty" class="button_grey big_btn btn-block form-control custom-file-upload">
                                                <i class="icon-upload-cloud"></i> อัพโหลดไฟล์
                                            </label>
                                            <input id="book_twenty" type="file" name="book_twenty_doc[]" accept="image/png,image/gif,image/jpeg" required multiple>
										</div>

									</li><!--/ .row -->

									<li class="row">
										
										<div class="col-xs-12">
											
											<label  class="required">สำเนาหน้าสมุดบัญชีธนาคารที่มีชื่อตรงกับผู้ลงทะเบียน</label>

										</div><!--/ [col] -->
										<div class="col-md-3">
											<label for="book_bank" class="button_grey big_btn btn-block form-control custom-file-upload">
                                                <i class="icon-upload-cloud"></i> อัพโหลดไฟล์
                                            </label>
                                            <input id="book_bank" type="file" name="book_bank_doc[]" accept="image/png,image/gif,image/jpeg" required multiple>
										</div>

									</li><!--/ .row -->

									<li class="row">
										
										<div class="col-xs-12">
											
											<label  >อื่นๆ</label>

										</div><!--/ [col] -->
										<div class="col-md-3">
											<label for="book_other" class="button_grey big_btn btn-block form-control custom-file-upload">
                                                <i class="icon-upload-cloud"></i> อัพโหลดไฟล์
                                            </label>
                                            <input id="book_other" type="file" name="book_other_doc[]" accept="image/png,image/gif,image/jpeg" multiple>
										</div>

									</li><!--/ .row -->

								</ul>

						

						</div>

					</section><!--/ .section_offset -->

					<!-- - - - - - - - - - - - - - End of อัพโหลดเอกสาร - - - - - - - - - - - - - - - - -->
					<div class="row">
						<div class="col-md-3 col-md-offset-3 col-xs-12">
							<a href="<?php echo base_url("store/register"); ?>" class="btn-block button_blue  middle_btn">ย้อนกลับ</a>
						</div>
						<div class="col-md-3 col-xs-12">
							<button type="submit" id="submit" class="btn-block button_blue middle_btn">ลงทะเบียนเปิดร้าน</button>
						</div>
					</div>
					
				
			</div>
		</div>
	</div><!--/ .container-->

</div><!--/ .page_wrapper-->
</form>			
		<!-- - - - - - - - - - - - - - End Page Wrapper - - - - - - - - - - - - - - - - -->
<?php $this->load->view("templates/footer"); ?>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/AutoProvince.js"); ?>"></script> 


<script>
var store_type = $("#store_type");
		
$("#form_register").submit(function(){
	var is_uploaded = true;

	if(store_type == 1){
		if(!$("#identity").val()){
			is_uploaded = false;
		}
		if(!$("#house_particular").val()){
			is_uploaded = false;
		}
		
	}else if(store_type == 2){
		if(!$("#company").val() && store_type.val() == 2){
			is_uploaded = false;
		}
		if(!$("#identity_multi").val() && store_type.val() == 2){
			is_uploaded = false;
		}
	}else{
		if(!$("#book_bank").val()){
			is_uploaded = false;
		}
		if($("#store_is_vat").prop('checked')){
			if(!$("#book_twenty").val() && store_type.val() == 2){
				is_uploaded = false;
			}
		}
		
	}
	
	
	
	
	if(!is_uploaded){
		swal("เอกสารที่จำเป็น","กรุณาอัพโหลดไฟล์เอกสารที่จำเป็นสำหรับการเปิดร้านค้า","info");
		return false;
	}
	
	
	$(this).submit();
});

function hideCk(){
	if($("#store_is_vat").prop('checked')){
		$("#book_twenty_required").show();
		// console.log("true");
	}else{
		// console.log("222");
		$("#book_twenty_required").hide();
	}
	
}
hideCk();
$("#form_register").validate({
	 rules: {
		store_type: {
			required: true
		},
		store_category: {
			required: true
		},
		first_name: {
			required: true
		},
		last_name: {
			required: true
		},
		identity_number: {
			required: true,
			number:true,
			minlength: 13,
			maxlength: 13
		},
		tel: {
			required: true,


		},
		province: {
			required: true
		},
		amphur: {
			required: true
		},
		district: {
			required: true
		},
		zipcode: {
			required: true
		},
		address: {
			required: true
		},
		account_name: {
			required: true
		},
		account_number: {
			required: true,
			number:true
		},
		bank_name: {
			required: true
		},
		company_doc: {
			required: true,
			extension: "doc|png|jpg"
		},
		identity_doc: {
			required: true,
			extension: "doc|png|jpg"
		},
		identity_multi_doc: {
			required: true,
			extension: "doc|png|jpg"
		},
		book_twenty_doc: {
			required: true,
			extension: "doc|png|jpg"
		},
		book_bank_doc: {
			required: true,
			extension: "doc|png|jpg"
		},
		house_particular_doc: {
			required: true,
			extension: "doc|png|jpg"
		}
		
		
	 }
 });


store_type.change(function(){
	var val = $(this).val();
	if(val == 1){
		$("#identity_single_required").show();
		$("#house_particular_required").show();
		$("#identity_multi_required").hide();
		// $("#book_twenty_required").hide();
		$("#company_required").hide();
		$("#company").attr("required","");
		$("#is_company_first_name").text("ชื่อ");
		$("#is_company_last_name").show();
		$("#last_name").show();
		$("#is_company").text("เลขประจำตัวประชาชน");
	}else{
		$("#identity_single_required").hide();
		$("#house_particular_required").hide();
		$("#identity_multi_required").show();
		// $("#book_twenty_required").show();
		$("#company_required").show();
		$("#company").attr("required","required");
		$("#is_company_first_name").text("ชื่อนิติบุคคล");
		$("#is_company_last_name").hide();
		$("#last_name").hide();
		$("#is_company").text("เลขทะเบียนนิติบุคคล");
	}
});
store_type.trigger("change");
$('body').AutoProvince({
	PROVINCE:		'#province', 
	AMPHUR:			'#amphur', 
	DISTRICT:		'#district',
	POSTCODE:		'#zipcode',
	GEOGRAPHY:		'#geography',
	arrangeByName:	false
});

$("input:file").change(function (){
   var fileName = $(this).val();
  // fileName = fileName.replace("
    $(this).parent().find(".custom-file-upload").addClass("active");
	//$(this).parent().find(".custom-file-upload").find(".filename").text(fileName);
 });
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
</script>
