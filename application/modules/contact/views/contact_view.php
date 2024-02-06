<?php $this->load->view("templates/header"); ?>
<link rel="stylesheet" href="<?php echo base_url('assets/css/summernote.css'); ?>">
<style>
	/*input[type="checkbox"] {
 		display: block !important; 
	}*/
	input[type="file"] {
		display: block !important;
	}
</style>


<div class="secondary_page_wrapper">

<div class="container">
       <div class="col-md-12 col-sm-12 col-xs-12 padding-l_0 pt-15 padding-r-0">
           <div class="col-md-12 col-sm-12 col-xs-12 padding-l_0">
                <ul class="breadcrumbs">
                        <li><a href="<?php echo base_url(); ?>">หน้าหลัก</a></li>
                        <li><a href="#">ติดต่อเรา</a></li>				
                </ul>
                
           </div>
            <div class="col-md-6 col-sm-12 col-xs-12 mobile_padding-l-15 pt-5 padding-l_0">
                <div class="theme_box">
                    <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 padding-l_0">
                               <div class="col-md-12 col-sm-12 col-xs-12">
                                   <h4>ข้อมูลการติดต่อ</h4>
                               </div>
                               <div class="col-md-12 col-sm-12 col-xs-12">
                                   <?php echo $this->load->get_var('contact_description'); ?>

                                </div>
                                <div class="col-md-12 col-sm-12 col-xs-12 pt-15">
                                        <ul class="payments">

                                                <li>
                                                    <a href="<?php echo $this->load->get_var('facebook_url'); ?>" class="icon_btn middle_btn social_facebook tooltip_container"><i class="icon-facebook-1"></i><span class="tooltip top">Facebook</span></a>
                                                </li>
                    
                                                <li>
                                                    <a href="<?php echo $this->load->get_var('twitter_url'); ?>" class="icon_btn middle_btn social_twitter tooltip_container"><i class="icon-twitter"></i><span class="tooltip top">Twitter</span></a>
                                                </li>
                    
                    
                                                <li>
                                                    <a href="<?php echo $this->load->get_var('youtube_url'); ?>" class="icon_btn middle_btn social_youtube tooltip_container"><i class="icon-youtube"></i><span class="tooltip top">Youtube</span></a>
                                                </li>
                    
                    
                                                <li>
                                                    <a href="<?php echo $this->load->get_var('instagram_url'); ?>" class="icon_btn middle_btn social_instagram tooltip_container"><i class="icon-instagram-4"></i><span class="tooltip top">Instagram</span></a>
                                                </li>
                    
                                               
                    
                                            </ul>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12 pt-5 padding-r-0">
                <div class="theme_box">
                       
                       
                       
                       
                       
                       <?php 
					   	$CI =& get_instance();
					   	if($CI->membermanager->isLoggedIn()){
						
					   ?>
                       
                       
                       <form id="create_message" class="type_2" action="<?php echo base_url('message/send'); ?>" method="post" enctype="multipart/form-data">
                       
                       <main class="col-md-12 col-sm-12 padding-l-0">
							
                            <div class="clearfix search bg-white">
                            	
								<div class="open_categories font-icon text-center">ติดต่อเรา</div>
							</div>
							

							<div class=""> 
								<div class="row">
									<div class="col-xs-12">
										
											<ul>
                                            	
                                                
                                              
												<li class="row  pt-10">
													<div class="col-xs-12">
														<label for="first_name" class="">ข้อความถึง :</label>
														<b class="">Marketplace</b>
													</div>
												</li>
											
                                                <input type="hidden" name="store_id" value="0" />
                                                <input type="hidden" name="order_id" value="0" />
                                                <input type="hidden" name="send_to" value="4" />
												<li class="row">
													<div class="col-xs-12">
														<label for="message_type" class="">ประเภท :</label>
														<div class="">
															<select id="message_type" class="form-control" disabled>
																<option value="3">สนทนา</option>
															</select>
                                                            <input type="hidden" name="message_type" value="3" />
														</div>
													</div>
												</li>
                                                <li class="row pt-20">
													<div class="col-xs-12">
														<label for="message_type" class="">เรื่อง :</label>
														<input type="text" id="message_type" name="message_topic" placeholder="ระบุหัวข้อเรื่อง" required>
													</div>
												</li>
												<li class="row pt-20">
													<div class="col-xs-12">
														<label for="message" class="">รายละเอียด :</label>
														<textarea name="message" id="message" rows="4" required></textarea>
													</div>
												</li>
												
											</ul>
										
									</div> 
								</div> 
							</div> 

							<footer class="pt-10">
								<div class="row">
									<div class="col-xs-12 col-sm-3 col-md-6 pt-0 pb-0">
										<!-- contant -->
									</div>
									<div class="col-xs-12 col-sm-6 col-md-6">
										<button type="submit" class="btn-block button_blue middle_btn icon-megaphone">
											ส่งข้อความ
										</button>
									</div>
								</div>
							</footer>

						</main>
                       
                       
                       </form>
                       
                       <?php }else{ ?>
                       
                       
                       <header class="on_the_sides">
										
                            <div class="left_side">
                    
                                <h4>เข้าสู่ระบบเพื่อติดต่อเรา </h4>
                    
                            </div>
                    
                            <div class="right_side">
                    
                            
                    
                            </div>
                    
                        </header>
                       <form class="pt-20" id="form_login" action="<?php echo base_url('member/loginMember'); ?>" method="post">
										
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
                        
                        <hr>
										
                        
                
						</form>
                                            
                            <div class="streamlined">
                                <button data-toggle="modal" data-target ="#modal_forgot_password"><i class="icon-key-1"></i> <small>ไม่สามารถเข้าสู่ระบบได้ ลืมรหัสผ่าน !</small></button>
                        </div>	                
                                            
                        <?php } ?>
                       
                       
                       
                       
                       
                       
                       
                       
                       
                       
                       
                       
                       
                       
                       
                       
                       	  <!--<form action="<?php echo base_url("contact/send"); ?>" method="post" enctype="multipart/form-data" id="form_contact">
                          
                            <div class="row pt-5">
                                <div class="col-md-12 col-xs-12 col-sm-12 pt-5">
                                    <label class="required bold_font" for="name">ชื่อจริง - นามสกุล:</label>
                                </div>
                                <div class="col-md-12 col-xs-12 col-sm-12 ">
                                
                                    <input type="text" name="name" id="name" placeholder="กรุณาระบุชื่อจริง - นามสกุล">
                                </div>
                            </div>
                         
                            <div class="row pt-5">
                                <div class="col-md-12 col-xs-12 col-sm-12 pt-5">
                                    <label class="bold_font" for="phone">โทรศัพท์:</label>
                                </div>
                                <div class="col-md-12 col-xs-12 col-sm-12">
                                    <input type="text" name="phone" id="phone" placeholder="กรุณาระบุหมายเลขโทรศัพท์">
                                </div>
                            </div>
                            
                          
                            <div class="row pt-5">
                                <div class="col-md-12 col-xs-12 col-sm-12 pt-5">
                                    <label class="bold_font required" for="subject">เรื่อง:</label>
                                </div>
                                <div class="col-md-12 col-xs-12 col-sm-12">
                                    <input type="text" name="subject" id="subject" placeholder="กรุณาระบุหัวข้อในการติดต่อ">
                                </div>
                            </div>
                            <div class="row pt-5">
                                    <div class="col-md-12 col-xs-12 col-sm-12 pt-5">
                                        <label class="bold_font required" for="detail">รายละเอียด:</label>
                                    </div>
                                    <div class="col-md-12 col-xs-12 col-sm-12">
                                        <textarea type="text" rows="4" name="detail" id="detail" placeholder="กรุณาระบุรายละเอียดที่ต้องการให้เราทราบ"></textarea>
                                    </div>
                                </div>
                                
                          
                                 
                            <div class="row pt-5">
                                
                                <div class="col-md-4 col-md-offset-8 col-xs-12 col-sm-12 pt-15  ">
                                    <button type="submit" class="btn-block button_grey middle_btn"><i class="icon-chat-empty"></i> ส่งข้อความ</button>
                                </div>
                            </div>
                            </form>-->
                </div>
            </div>
       </div>
</div>

</div><!--/ .page_wrapper-->
			
<?php $this->load->view("member/modals/modal_forgot_password"); ?>
<?php $this->load->view("templates/footer"); ?>

<script type="text/javascript" src="<?php echo base_url("assets/js/summernote.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/summernote-th-TH.js"); ?>"></script>
<script>

$(function() {
	setTimeout(resize,500);
});

function resize(){
	$(window).trigger('resize');
}

$('#message').summernote({
        placeholder: 'ระบุรายละเอียด',
		lang: "th-TH",
	 	toolbar: [
			
			["font", ["bold", "underline", "clear"]],
			["color", ["color"]],
			["para", ["ul", "ol", "paragraph"]],
			["insert", ["link", "picture", "video"]]
		],
});

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
