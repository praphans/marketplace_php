<?php $this->load->view("templates/header"); ?>


<?php
							
foreach($myStore as $row){
	$vat_checked = "";
	$store_id = $row->store_id;
	$member_id = $row->member_id;
	$store_name = $row->store_name;
	$store_avatar = $row->store_avatar;
	$store_cover = $row->store_cover;
	$store_description = $row->store_description;
	$store_url = $row->store_url;
	$store_type = $row->store_type;
	$store_category = $row->store_category;
	$store_status = $row->store_status;
	$first_name = $row->first_name;
	$last_name = $row->last_name;
	$identity_number = $row->identity_number;
	$tel = $row->tel;
	$store_status = $row->store_status;
	$current_province =$province = $row->province;
	$current_amphur = $amphur = $row->amphur;
	$current_district = $district = $row->district;
	$current_address = $address = $row->address;
	$store_is_vat = $row->store_is_vat;
	$zipcode = $row->zipcode;
	$account_name = $row->account_name;
	$account_number = $row->account_number;
	$current_bank_name = $bank_name = $row->bank_name;
	$timestamp = $row->timestamp;
	
	$province = $this->storemanager->getDistrictName($province);
	$amphur = $this->storemanager->getAmphurName($amphur);
	$district = $this->storemanager->getProvinceName($district);
	
	$document = $this->storemanager->getMyDocument();
	foreach($document as $doc){
		$company_doc = ($doc->company_doc)?explode(",",$doc->company_doc):array();
		$identity_doc = ($doc->identity_doc)?explode(",",$doc->identity_doc):array();
		$identity_multi_doc = ($doc->identity_multi_doc)?explode(",",$doc->identity_multi_doc):array();
		$book_twenty_doc = ($doc->book_twenty_doc)?explode(",",$doc->book_twenty_doc):array();
		$book_bank_doc = ($doc->book_bank_doc)?explode(",",$doc->book_bank_doc):array();
		$book_other_doc = ($doc->book_other_doc)?explode(",",$doc->book_other_doc):array();
		$house_particular_doc = ($doc->house_particular_doc)?explode(",",$doc->house_particular_doc):array();
	}
	
	/*$company_doc = (count($company_doc)>0)?$company_doc[0]:"";
	$identity_doc = (count($identity_doc)>0)?$identity_doc[0]:"";
	$identity_multi_doc = (count($identity_multi_doc)>0)?$identity_multi_doc[0]:"";
	$book_twenty_doc = (count($book_twenty_doc)>0)?$book_twenty_doc[0]:"";
	$book_bank_doc = (count($book_bank_doc)>0)?$book_bank_doc[0]:"";
	$book_other_doc = (count($book_other_doc)>0)?$book_other_doc[0]:"";*/
		
	if($store_is_vat){
		$vat_checked = "checked";
	}
	$address = $address." ".$district." ".$amphur." ".$province." ".$zipcode;
	$bank = $account_name." ".$bank_name." ".$account_number;
	$store_categorys = $this->storemanager->getStoreCategory();
	$store_category_name = $store_categorys[0]->category_name;

	$url = base_url("store/registration/edit");


}

?>
                            

<form id="form_register" class="type_2" action="<?php echo base_url('store/editCreateStoreInfo'); ?>" method="post" enctype="multipart/form-data">
	<input type="hidden" name="store_id" value="<?php echo $store_id; ?>">
    <input type="hidden" name="member_id" value="<?php echo $member_id; ?>">
	<div class="secondary_page_wrapper">

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

				<ul class="breadcrumbs">

					<li><a href="<?php echo base_url(); ?>" class="notcursor">หน้าหลัก</a></li>
					<li><a href="<?php echo base_url('store'); ?>" class="notcursor">บัญชีร้านค้า</a></li>
					<li><a href="<?php echo base_url('store/registration'); ?>" class="notcursor">ข้อมูลทะเบียนร้านค้า</a></li>
                    <li>ขอเปลี่ยนแปลงข้อมูลจดทะเบียน</li>

				</ul>

				<!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->

				<!-- - - - - - - - - - - - - - ข้อมูลร้านค้า - - - - - - - - - - - - - - - - -->
				
					<section class="section_offset">

						<h3>ข้อมูลร้านค้า</h3>

						<div class="theme_box">

							
								
								<ul>

									<li class="row">

										<div class="col-sm-6">

											<label class="required">ประเภทร้านค้า</label>
                                            <select id="store_type" name="store_type" id="store_type">
                                                <?php
													$store_type_list = $this->storemanager->getStoreType();
													foreach($store_type_list as $row){
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
											<select id="store_category" name="store_category" id="store_category">
                                                <?php
													$store_category_list = $this->storemanager->getStoreCategory();
													foreach($store_category_list as $row){
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
											<input type="checkbox" name="store_is_vat" id="store_is_vat" <?php echo $vat_checked; ?> onclick="hideCk()">
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
											<input type="text" onkeypress='return isNumberKey(event)' name="identity_number" id="identity_number" placeholder="000-000-000-0000" maxlength="13" value="<?php echo $identity_number; ?>" required>
										</div><!--/ [col] -->

									</li><!--/ .row -->
									
									<li class="row pt-5">
										
										<div class="col-sm-6">
											<label for="tel" class="required">โทรศัพท์</label>
											<input type="text" name="tel" id="tel"  placeholder="ระบุหมายเลขโทรศัพท์มือถือ" value="<?php echo $tel; ?>" required>
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
											<textarea type="text" name="address" id="address" placehoder="ที่อยู่ที่สามารถติดต่อได้"><?php echo $current_address; ?></textarea>
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
											<input type="text" name="account_name" id="account_name" value="<?php echo $account_name; ?>" placeholder="ชื่อ - นามสกุล เจ้าของบัญชี">

										</div><!--/ [col] -->

									</li><!--/ .row -->

									<li class="row pt-5">
										
										<div class="col-xs-12">
											
											<label  class="required">เลขบัญชี</label>
											<input type="text" name="account_number" id="account_number" value="<?php echo $account_number; ?>" placeholder="ระบุเลขที่บัญชี">

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
											
											<label  class="">สำเนาหนังสือรับรองนิติบุคคล พร้อมลงนามรับรองสำเนาถูกต้องโดยกรรมการผู้มีอำนาจ และประทับตราบริษัท</label>
											<div class="row">
												<?php if(isset($company_doc) && count($company_doc)>0){ ?>
											
				                                    <?php 
													for($i = 0;$i<count($company_doc);$i++){ 
														$url = $company_doc[$i];
													?>
													<div class="col-md-3 col-xs-6 b-r pt-15">
														<div class="image_wrap">
															<img src="<?php echo base_url($url); ?>" alt="">
														</div>
													</div>
				                                    <?php } ?>
											
				                                <?php } ?>
											</div>
										</div><!--/ [col] -->
										<div class="col-md-3">
                                            <label for="company" class="button_grey big_btn btn-block form-control custom-file-upload">
                                                <i class="icon-upload-cloud"></i> อัพโหลดไฟล์<span class="filename"></span>
                                            </label>
                                            <input id="company" type="file" name="company_doc[]" accept="image/png,image/gif,image/jpeg"  multiple>
										</div>

									</li><!--/ .row -->

									<li class="row natural_person" id="">
										
										<div class="col-xs-12">
											<label  class="pt-15">สำเนาบัตรประชาชนในนามบุคคล พร้อมลงนามรับรองสำเนาถูกต้อง</label>
											<div class="row">
												<?php if(isset($identity_doc) && count($identity_doc)>0){ ?>
											
				                                    <?php 
													for($i = 0;$i<count($identity_doc);$i++){ 
														$url = $identity_doc[$i];
													?>
													<div class="col-md-3 col-xs-6 b-r pt-15">
														<div class="image_wrap">
															<img src="<?php echo base_url($url); ?>" alt="">
														</div>
													</div>
				                                    <?php } ?>
											
				                                <?php } ?>
											</div>
										</div><!--/ [col] -->
										<div class="col-md-3">
											<label for="identity" class="button_grey big_btn btn-block form-control custom-file-upload">
                                                <i class="icon-upload-cloud"></i> อัพโหลดไฟล์ <span></span>
                                            </label>
                                            <input id="identity" type="file" name="identity_doc[]" accept="image/png,image/gif,image/jpeg"  multiple>
										</div>

									</li><!--/ .row -->

									<li class="row natural_person" id="">
										
										<div class="col-xs-12">
											<label  class="pt-15">สำเนาทะเบียนบ้าน พร้อมลงนามรับรองสำเนาถูกต้อง</label>
											<div class="row">
												<?php if(isset($house_particular_doc) && count($house_particular_doc)>0){ ?>
											
				                                    <?php 
													for($i = 0;$i<count($house_particular_doc);$i++){ 
														$url = $house_particular_doc[$i];
													?>
													<div class="col-md-3 col-xs-6 b-r pt-15">
														<div class="image_wrap">
															<img src="<?php echo base_url($url); ?>" alt="">
														</div>
													</div>
				                                    <?php } ?>
											
				                                <?php } ?>
											</div>
										</div><!--/ [col] -->
										<div class="col-md-3">
											<label for="house_particular" class="button_grey big_btn btn-block form-control custom-file-upload">
                                                <i class="icon-upload-cloud"></i> อัพโหลดไฟล์ <span></span>
                                            </label>
                                            <input id="house_particular" type="file" name="house_particular_doc[]" accept="image/png,image/gif,image/jpeg"  multiple>
										</div>

									</li><!--/ .row -->

									<li class="row" id="identity_multi_required">
										
										<div class="col-xs-12">
											
											<label  class="pt-15">สำเนาบัตรประชาชนของกรรมการผู้มีอำนาจลงนามทั้งหมดที่มีรายชื่อในหนังสือจดทะเบียนนิติบุคคล พร้อมลงนามรับรองสำเนาถูกต้อง</label>
											<div class="row">
												<?php if(isset($identity_multi_doc) && count($identity_multi_doc)>0){ ?>
											
				                                    <?php 
													for($i = 0;$i<count($identity_multi_doc);$i++){ 
														$url = $identity_multi_doc[$i];
													?>
													<div class="col-md-3 col-xs-6 b-r pt-15">
														<div class="image_wrap">
															<img src="<?php echo base_url($url); ?>" alt="">
														</div>
													</div>
				                                    <?php } ?>
											
				                                <?php } ?>
											</div>

										</div><!--/ [col] -->
										<div class="col-md-3">
											<label for="identity_multi" class="button_grey big_btn btn-block form-control custom-file-upload">
                                                <i class="icon-upload-cloud"></i> อัพโหลดไฟล์
                                            </label>
                                            <input id="identity_multi" type="file" name="identity_multi_doc[]" accept="image/png,image/gif,image/jpeg"  multiple>
										</div>

									</li><!--/ .row -->

									<li class="row" id="book_twenty_required">
										
										<div class="col-xs-12">
											
											<label  class="pt-15">สำเนาหนังสือ ภ.พ.20 พร้อมลงนามรับรองสำเนาถูกต้อง</label>
											<div class="row">
												<?php if(isset($book_twenty_doc) && count($book_twenty_doc)>0){ ?>
										
				                                    <?php 
													for($i = 0;$i<count($book_twenty_doc);$i++){ 
														$url = $book_twenty_doc[$i];
													?>
													<div class="col-md-3 col-xs-6 b-r pt-15">
														<div class="image_wrap">
															<img src="<?php echo base_url($url); ?>" alt="">
														</div>
													</div>
				                                    <?php } ?>
											
				                                <?php } ?>
											</div>
										</div><!--/ [col] -->
										<div class="col-md-3">
											<label for="book_twenty" class="button_grey big_btn btn-block form-control custom-file-upload">
                                                <i class="icon-upload-cloud"></i> อัพโหลดไฟล์
                                            </label>
                                            <input id="book_twenty" type="file" name="book_twenty_doc[]" accept="image/png,image/gif,image/jpeg"  multiple>
										</div>

									</li><!--/ .row -->

									<li class="row">
										
										<div class="col-xs-12">
											
											<label  class="pt-15">สำเนาหน้าสมุดบัญชีธนาคารที่มีชื่อตรงกับผู้ลงทะเบียน</label>
											<div class="row">
												<?php if(isset($book_bank_doc) && count($book_bank_doc)>0){ ?>
											
				                                    <?php 
													for($i = 0;$i<count($book_bank_doc);$i++){ 
														$url = $book_bank_doc[$i];
													?>
													<div class="col-md-3 col-xs-6 b-r pt-15">
														<div class="image_wrap">
															<img src="<?php echo base_url($url); ?>" alt="">
														</div>
													</div>
				                                    <?php } ?>
												
				                                <?php } ?>
											</div>
										</div><!--/ [col] -->
										<div class="col-md-3">
											<label for="book_bank" class="button_grey big_btn btn-block form-control custom-file-upload">
                                                <i class="icon-upload-cloud"></i> อัพโหลดไฟล์
                                            </label>
                                            <input id="book_bank" type="file" name="book_bank_doc[]" accept="image/png,image/gif,image/jpeg"  multiple>
										</div>

									</li><!--/ .row -->

									<li class="row">
										
										<div class="col-xs-12">
											
											<label  class="pt-15">อื่นๆ</label>
											<div class="row">
												<?php if(isset($book_other_doc) && count($book_other_doc)>0){ ?>
												
				                                    <?php 
													for($i = 0;$i<count($book_other_doc);$i++){ 
														$url = $book_other_doc[$i];
													?>
													<div class="col-md-3 col-xs-6 b-r pt-15">
														<div class="image_wrap">
															<img src="<?php echo base_url($url); ?>" alt="">
														</div>
													</div>
				                                    <?php } ?>
												
				                                <?php } ?>
											</div>
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
							<button type="submit" id="submit" class="btn-block button_blue middle_btn">แก้ไขข้อมูล</button>
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
var store_category = $("#store_category");
var bank_name = $("#bank_name");

var current_store_type = "<?php if(isset($store_type)) echo $store_type; ?>";
var current_store_category = "<?php if(isset($store_category)) echo $store_category; ?>";
var current_bank_name = "<?php if(isset($current_bank_name)) echo $current_bank_name; ?>";

	
var current_province = "<?php if(isset($current_province)){ echo $current_province; } ?>";
var current_amphur = "<?php if(isset($current_amphur)){ echo $current_amphur; } ?>";
var current_district = "<?php if(isset($current_district)){ echo $current_district; } ?>";

$(document).ready(function(){
	store_type.val(current_store_type);		
	store_category.val(current_store_category);	
	if(current_bank_name)bank_name.val(current_bank_name);	
	
	store_type.trigger("change");
});

$("#form_register").submit(function(){
	var is_uploaded = true;
	// if(!$("#company").val() && store_type.val() == 2){
	// 	is_uploaded = false;
	// }
	// if(!$("#identity").val()){
	// 	is_uploaded = false;
	// }
	// if(!$("#identity_multi").val() && store_type.val() == 2){
	// 	is_uploaded = false;
	// }
	// if(!$("#book_twenty").val() && store_type.val() == 2){
	// 	is_uploaded = false;
	// }
	// if(!$("#book_bank").val()){
	// 	is_uploaded = false;
	// }
	if(!is_uploaded){
		swal("เอกสารที่จำเป็น","กรุณาอัพโหลดไฟล์เอกสารที่จำเป็นสำหรับการเปิดร้านค้า","info");
		return false;
	}
	$(this).submit();
});
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
		}
		
		
	 }
 });


store_type.change(function(){
	var val = $(this).val();
	if(val == 1){ 
		$("#identity_multi_required").hide();
		// $("#book_twenty_required").hide();
		$("#company_required").hide();
		$("#company").attr("required","");
		$("#is_company_first_name").text("ชื่อ");
		$("#is_company_last_name").show();
		$("#last_name").show();
		$("#is_company").text("เลขประจำตัวประชาชน");

		$(".natural_person").show(); //บุคคลธรรมดา

	}else{ 
		$("#identity_multi_required").show();
		// $("#book_twenty_required").show();
		$("#company_required").show();
		$("#company").attr("required","required");
		$("#is_company_first_name").text("ชื่อนิติบุคคล");
		$("#is_company_last_name").hide();
		$("#last_name").hide();
		$("#is_company").text("เลขทะเบียนนิติบุคคล");

		$(".natural_person").hide(); //บุคคลธรรมดา
	}


});

function hideCk(){
	// var store_type = $("#store_type");
	// if(store_type == 1){
		if($("#store_is_vat").prop('checked')){
			$("#book_twenty_required").show();
			// console.log("true");
		}else{
			// console.log("222");
			$("#book_twenty_required").hide();
		}
	// }
	
}
hideCk();
//
$('body').AutoProvince({
	PROVINCE:		'#province', 
	AMPHUR:			'#amphur', 
	DISTRICT:		'#district',
	POSTCODE:		'#zipcode',
	GEOGRAPHY:		'#geography',
	CURRENT_PROVINCE:current_province,
	CURRENT_AMPHUR:current_amphur,
	CURRENT_DISTRICT:current_district,
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

function checkTel()
{
	var tel = document.getElementById('tel').value;
	if(!tel.match(/^([0-9])+$/i))
	{
		alert("กรุณากรอกข้อมูลให้ถูกต้อง");
		document.getElementById('tel').value = "";
		location.replace("<?php echo $url; ?>");
	}
}
</script>
