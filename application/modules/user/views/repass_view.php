<?php $this->load->view("templates/header"); ?>


<div class="secondary_page_wrapper">

        <div class="container">

            <!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

            <ul class="breadcrumbs">

               	<li><a href="<?php echo base_url(); ?>" class="notcursor">หน้าหลัก</a></li>
                <li><a href="<?php echo base_url("user/setting"); ?>" class="notcursor">ตั้งค่าการใช้งาน</a></li>		
                <li>เปลี่ยนแปลงรหัสผ่าน</li>

            </ul>

            <!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->

            <div class="row">

                <aside class="col-md-3 col-sm-4">

                    <!-- - - - - - - - - - - - - - Information - - - - - - - - - - - - - - - - -->

                    <section class="section_offset">

                        <ul class="theme_menu">
							<?php if(!$this->storemanager->store_id()){ ?>
                            <li><a href="<?php echo base_url("user/setting/info"); ?>">ข้อมูลบัญชีผู้ใช้งาน</a></li>
                            <?php } ?>
                            <li class="active"><a href="<?php echo base_url("user/setting/repass"); ?>">เปลี่ยนแปลงรหัสผ่าน</a></li>
                        

                        </ul>

                    </section><!--/ .section_offset -->

                    <!-- - - - - - - - - - - - - - End of information - - - - - - - - - - - - - - - - -->

                </aside><!--/ [col]-->
                
                <?php
				$disabled = "";
				$message = "";
				foreach($members as $row){
					$member_id = $row->member_id;
					$login_with_facebook = $row->login_with_facebook;
				}
				if($login_with_facebook == 1){
					$message = "<small>เข้าสู่ระบบด้วยเฟสบุ้คไม่สามารถเปลี่ยนรหัสผ่านได้</small>";
					$disabled = "disabled";
				}
				?>
                        
				<form action="<?php echo base_url("user/setting/changePassword"); ?>" method="post" id="update_pass">
                 <input type="hidden" name="login_with_facebook" value="<?php echo $login_with_facebook; ?>">
                <main class="col-md-9 col-sm-8 padding-l_0">

                    <!-- เปลี่ยนแปลงรหัสผ่าน -->

                    <div class="theme_box">
                            <div class="row pt-5">
                                <div class="col-md-12 col-xs-12 col-sm-12 ">
                                    <h4>เปลี่ยนแปลงรหัสผ่าน </h4>
                                    <?php echo $message; ?>
                                </div>
                            </div>
                          <!-- ---------------------------------รหัสผ่านเดิม--------------------------------------  -->    
                          <?php if(!$login_with_facebook){ ?> 
                            <div class="row pt-5">
                                <div class="col-md-12 col-xs-12 col-sm-12 pt-5">
                                    <label class="bold_font" for="first_name">รหัสผ่านเดิม:</label>
                                </div>
                                <div class="col-md-12 col-xs-12 col-sm-12 ">
                                    <input type="password" name="password" placeholder="กรุณาระบุรหัสผ่านเดิม"  id="password" <?php echo $disabled; ?>>
                                </div>
                            </div>
                          <?php }else{ ?>
                          
                           <input type="hidden" name="password" id="password">
                          
                          <?php } ?>
                          <!-- ---------------------------------รหัสผ่านใหม่--------------------------------------  --> 	
                            <div class="row pt-5">
                                <div class="col-md-12 col-xs-12 col-sm-12 pt-5">
                                    <label class="bold_font" for="first_name">รหัสผ่านใหม่:</label>
                                </div>
                                <div class="col-md-12 col-xs-12 col-sm-12">
                                    <input type="password" name="newpassword" placeholder="กรุณาระบุรหัสผ่านใหม่" id="newpassword" <?php echo $disabled; ?>>
                                </div>
                            </div>
                            
                         <!-- ---------------------------------รหัสผ่านใหม่อีกครั้ง--------------------------------------  -->      
                            <div class="row pt-5">
                                <div class="col-md-12 col-xs-12 col-sm-12 pt-5">
                                    <label class="bold_font" for="first_name">รหัสผ่านใหม่อีกครั้ง:</label>
                                </div>
                                <div class="col-md-12 col-xs-12 col-sm-12">
                                    <input type="password" name="confirm_newpassword" placeholder="กรุณาระบุรหัสผ่านใหม่อีกครั้ง"  id="confirm_newpassword" <?php echo $disabled; ?>>
                                </div>
                            </div>
                            
                            
                                 
                            <div class="row pt-5">
                                
                                <div class="col-md-4 col-md-offset-4 col-xs-12 col-sm-12 pt-15  ">
                                    <button type="submit" class="btn-block button_blue middle_btn" <?php echo $disabled; ?>>บันทึก</button>
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
 $("#update_pass").validate({
	 rules: {
		password: {
			required: true
		},
		newpassword: {
			required: true,
			minlength: 6
		},
		confirm_newpassword: {
			required: true,
			minlength: 6,
			equalTo: "#newpassword"
		}
	 }
 });
</script>