<?php $this->load->view("templates/header"); ?>


<div class="secondary_page_wrapper">

				<div class="container">

					<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

					<ul class="breadcrumbs">

						<li><a href="<?php echo base_url(); ?>" class="notcursor">หน้าหลัก</a></li>
						<li><a href="<?php echo base_url("user/setting"); ?>" class="notcursor">ตั้งค่าการใช้งาน</a></li>				
						<li >ข้อมูลบัญชีผู้ใช้งาน</li>

					</ul>

					<!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->

					<div class="row">

						<aside class="col-md-3 col-sm-4">

							<!-- - - - - - - - - - - - - - Information - - - - - - - - - - - - - - - - -->

							<section class="section_offset">
								
								<ul class="theme_menu">
									<?php if(!$this->storemanager->store_id()){ ?>
									<li class="active"><a href="<?php echo base_url("user/setting/info"); ?>">ข้อมูลบัญชีผู้ใช้งาน </a></li>
                                    <?php } ?>
                            		<li><a href="<?php echo base_url("user/setting/repass"); ?>">เปลี่ยนแปลงรหัสผ่าน</a></li>
								</ul>

							</section><!--/ .section_offset -->

							<!-- - - - - - - - - - - - - - End of information - - - - - - - - - - - - - - - - -->

						</aside><!--/ [col]-->
						<?php
						foreach($members as $row){
							$member_id = $row->member_id;	
							$first_name = $row->first_name;	
							$last_name = $row->last_name;
							$login_with_facebook = $row->login_with_facebook;
							$email = $row->email;
							$mobile = $row->mobile;
							$gender = $row->gender;
							$birthday = $row->birthday;
						}
						?>
                        <form action="<?php echo base_url("user/setting/saveAccount"); ?>" method="post" id="setting_frm">
                        <input type="hidden" name="member_id" value="<?php echo $member_id; ?>">
						<main class="col-md-9 col-sm-8 padding-l-0">

							

							<!-- ข้อมูลสินค้า -->

							<div class="theme_box">
                                    <div class="row pt-5">
                                        <div class=" col-md-12 col-xs-12 col-sm-12 ">
                                            <h4>ข้อมูลบัญชีผู้ใช้งาน</h4>
                                        </div>
                                    </div>
                                    <div class="row pt-5">
                                        <div class="col-md-12 col-sm-12 col-xs-12 pt-5">
                                            <label class="bold_font" for="first_name">ชื่อที่ใช้ :</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12 ">
											<input type="text" name="first_name" value="<?php echo $first_name; ?>">
										</div>
									</div>
									<!--<div class="row pt-5">
                                        <div class="col-md-12 col-sm-12 col-xs-12 pt-5">
                                            <label class="bold_font" for="last_name">นามสกุล :</label>
										</div>
										<div class="col-md-12 col-sm-12 col-xs-12 ">
											<input type="text" name="last_name" value="<?php echo $last_name; ?>">
										</div>
									</div>-->
                                    <div class="row pt-5">
                                        <div class="col-md-12 col-sm-12  col-xs-12 pt-5">
                                            <label class="bold_font" for="first_name">อีเมล์:</label>
										</div>
                                        <?php if($login_with_facebook){ ?>
										<div class="col-md-12 col-sm-12  col-xs-12">
											<input type="text" name="email" value="<?php echo $email; ?>" disabled="disabled">
                                            <input type="hidden" name="email" value="<?php echo $email; ?>">
										</div>
                                        <?php }else{ ?>
                                        <div class="col-md-12 col-sm-12  col-xs-12">
											<input type="text" name="email" value="<?php echo $email; ?>">
										</div>
                                        <?php } ?>
									</div>
									
                                        
                                    <div class="row pt-5">
                                        <div class="col-md-12 col-sm-12  col-xs-12 pt-5">
                                            <label class="bold_font" for="first_name">หมายเลขโทรศัพท์:</label>
										</div>
										<div class="col-md-12 col-sm-12  col-xs-12">
											<input type="text" name="mobile" value="<?php echo $mobile; ?>">
										</div>
									</div>
									
									     
                                    <div class="row pt-5">
                                        <div class="col-md-12 col-sm-12  col-xs-12">
                                            <label class="bold_font" for="gender">เพศ:</label>
										</div>
										<div class="col-md-4  col-sm-12 col-xs-12">
											<div class="custom_select">
												<select name="gender" id="gender" class="form-control">
													<option value="ไม่ระบุ">ไม่ระบุ</option>
													<option value="ชาย">ชาย</option>
													<option value="หญิง">หญิง</option>
												</select>
											</div>
										</div>
									</div>
								
									     
                                    <div class="row pt-5">
                                        <div class="col-md-12 col-sm-12  col-xs-12">
                                            <label class="bold_font" for="birthday">วันเกิด:</label>
										</div>
										<div class="col-md-4 col-sm-12  col-xs-12  pt-5">
											<div class="custom_select">
												<select name="birthday_date" id="birthday_date" class="form-control">
                                                	<?php 
													for($i = 1;$i<=31;$i++){
													?>
													<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                    <?php } ?>
													
												</select>
											</div>
										</div>
										<div class="col-md-4 col-sm-12  col-xs-12  pt-5">
											<div class="custom_select">
												<select name="birthday_month" id="birthday_month" class="form-control">
													<option value="1">มกราคม</option>
													<option value="2 ">กุมภาพันธ์ </option>
													<option value="3">มีนาคม</option>
													<option value="4">เมษายน</option>
													<option value="5 ">พฤษภาคม </option>
													<option value="6">มิถุนายน</option>
													<option value="7">กรกฎาคม</option>
													<option value="8 ">สิงหาคม </option>
													<option value="9">กันยายน</option>
													<option value="10">ตุลาคม</option>
													<option value="11 ">พฤศจิกายน </option>
													<option value="12">ธันวาคม</option>
												</select>
											</div>
										</div>
										<div class="col-md-4 col-sm-12  col-xs-12  pt-5">
											<div class="custom_select">
												<select name="birthday_year" id="birthday_year" class="form-control">
                                                	<?php 
													$year = date("Y")+543;
													
													for($i = 1;$i<60;$i++){
														
													?>
													<option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                                    <?php $year--; } ?>
												</select>
											</div>
										</div>
										<div class="col-md-4 col-md-offset-4 col-sm-12 col-xs-12 pt-15 ">
											<button type="submit" class="btn-block button_blue middle_btn"><i class="icon-layers"></i> บันทึกข้อมูล</button>
										</div>
									</div>
									
                                    
                            </div>

						

						</main><!--/ [col]-->
                        </form>

					</div><!--/ .row-->

				</div><!--/ .container-->

			</div><!--/ .page_wrapper-->
            
<?php $this->load->view("templates/footer"); ?>
<script>
var gender = "<?php if(isset($gender) && $gender != "") echo $gender; ?>";
var birthday = "<?php if(isset($birthday) && $birthday != "") echo $birthday; ?>";
if(gender){
	$("#gender").val(gender);
}
if(birthday){
	birthday = birthday.split("-");
	$("#birthday_date").val(birthday[0]);
	$("#birthday_month").val(birthday[1]);
	$("#birthday_year").val(birthday[2]);
}

 $("#setting_frm").validate({
	 rules: {
		first_name: {
			required: true,
			minlength: 5
		},
		email: {
			required: true,
			email: true
		},
	
		
	 }
 });

</script>
