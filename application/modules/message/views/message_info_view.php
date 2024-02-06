<?php $this->load->view("templates/header"); ?>
<link rel="stylesheet" href="<?php echo base_url('assets/css/summernote.css'); ?>">
<style>
	
	input[type="file"] {
		display: block !important;
	}
	.pre_date{
		color:#494949;
	}
</style>
<div class="secondary_page_wrapper">

			<div class="container">

				<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

				<ul class="breadcrumbs">

					<li><a href="<?php echo base_url(); ?>" class="notcursor">หน้าหลัก</a></li>
					<li><a href="<?php echo base_url("message"); ?>" class="notcursor">Inbox</a></li>
					<li><a href="javascript:void(0);" class="notcursor">ข้อความ</a></li>


				</ul>

				<!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->

				<div class="row">

					<aside class="col-md-3 col-sm-4">

						<!-- - - - - - - - - - - - - - Information - - - - - - - - - - - - - - - - -->

						<section class="section_offset">

							<?php
								$message_type_session = $this->session->userdata("message_type_session");
								$active = "";
								if(!$message_type_session || $message_type_session == 0){
									$active = "active";	
								}
								
							?>
							<ul class="theme_menu">
								<li class="<?php echo $active; ?>"><a href="<?php echo base_url("message/inbox/".$filter."/0"); ?>">ทั้งหมด</a></li>
                                <?php
								
								foreach($message_type_list as $row){
									$active = "";
									$id = $row->id;
									$msg = $row->message;
									if($message_type_session == $id){
										$active = "active";
									}
								?>
								
								<li class="<?php echo $active; ?>"><a href="<?php echo base_url("message/inbox/".$filter."/".$id); ?>"><?php echo $msg; ?></a></li>
								
                                <?php } ?>
							</ul>

						</section>
						<!--/ .section_offset -->

						<!-- - - - - - - - - - - - - - End of information - - - - - - - - - - - - - - - - -->

					</aside>
					<!--/ [col]-->

					<main class="col-md-9 col-sm-8 padding-l-0">
						
						<div class="row ">
							<div class="col-xs-12 pt-5">
								<section class="col-md-12 col-sm-12 col-xs-12">

									<div class="tabs type_2 initialized">

										<!-- - - - - - - - - - - - - - Navigation of tabs - - - - - - - - - - - - - - - - -->
										<?php 
										$receive_active = "";
										$sent_active = "";
										
										if($filter == "receive"){
											$header = "ข้อความจาก";
											$receive_active = "active";
										}else{
											$header = "ข้อความถึง";
											$sent_active = "active";
										}
										?>
										<ul class="tabs_nav clearfix">

											<li class="<?php echo $receive_active; ?>"><a href="<?php echo base_url("message/inbox/receive/".$message_type_session); ?>">กล่องข้อความ</a></li>
											<li class="<?php echo $sent_active; ?>"><a href="<?php echo base_url("message/inbox/sent/".$message_type_session); ?>">ส่งแล้ว</a></li>


										</ul>

										<!-- - - - - - - - - - - - - - End navigation of tabs - - - - - - - - - - - - - - - - -->

										<!-- - - - - - - - - - - - - - Tabs container - - - - - - - - - - - - - - - - -->

										<div class="tab_containers_wrap" style="height: 343px;">

											<!-- - - - - - - - - - - - - - Tab - - - - - - - - - - - - - - - - -->

											<div id="tab-7" class="tab_container ">
												
                                                
                                                
                                                	<?php 
													if(count($messages)>0){
													$main_message_id = $messages[0]->message_id;
													$sender_id = $messages[0]->sender_id;
													$message = $messages[0]->message;
													$timestamp = $messages[0]->timestamp;
													$message_topic = $messages[0]->message_topic;
													
													$create = $this->model_message->getMemberByID($sender_id);
													$create_name = "เจ้าหน้าที่";
													if(count($create)) $create_name = $create[0]->first_name;
														
													?>
                                                    
                                                    <?php
													$start = 0;
													foreach($messages as $r){
														
													}
													foreach($messages as $row){
														
														$message_id = $row->message_id;
														$message_reply_id = $row->message_reply_id;
														$receiver_id = $row->receiver_id;
														$sender_id = $row->sender_id;
														$message = $row->message;
														$message_type = $row->message_type;
														$timestamp = $row->timestamp;
														
														if($filter == "receive"){
															$receiver_id = $sender_id;
														}else{
															$receiver_id = $receiver_id;
														}
														
														$type = $this->model_message->getMessageTypeByID($message_type);
														$type_name = "-";
														if(count($type)) $type_name = $type[0]->message;
														
										
														//$images = $this->model_message->getMessageImageByID($message_id);
														if($filter == "receive"){
															$last_sent = $this->model_message->getLastSenderMember($message_reply_id);
															$last_sender_id = $last_sent[0]->sender_id;
															$last_time_send = $last_sent[0]->timestamp;
															$last_message_id = $last_sent[0]->message_id;
														}else if($filter == "sent"){
															$last_sent = $this->model_message->getLastSenderMember($message_id);
															$last_sender_id = $last_sent[0]->sender_id;
															$last_time_send = $last_sent[0]->timestamp;
															$last_message_id = $last_sent[0]->message_id;
														}
														
														$last_reply_message_id = 0;
														$last_message = $this->model_message->getMessageByID($last_message_id);
														foreach($last_message as $r){
															$last_reply_message_id = $r->message_reply_id;
														}
														if($last_reply_message_id == 0){
															$last_reply_message_id = $message_id;
														}
														
														$member = $this->model_message->getMemberByID($sender_id);
														
														$member_name = "เจ้าหน้าที่";
														if(count($member)) $member_name = $member[0]->first_name;
														
														
														/*if($message_type == 1 || $message_type == 2){
															$receiver_id = 0;	
														}*/
														
														/*if($message_type == 2 && $filter == "sent"){
															$member_name = "ผู้ติดตาม";
														}*/
														
														//echo $r->message."<br>";	
														
														
													
													if($start == 0){
														$start++;
													?>
                                                    
                                                    <div class="row pt-20 pr-20 pl-20">
                                                        <div class="col-md-12 theme_box">
                                                            <h4 class="text-primary"><?php echo $message_topic; ?></h4>
                                                            <p class="pre_date"><a class="text-muted">เริ่มส่งโดย</a> <?php echo $create_name; ?><a class="text-muted"> เมื่อ </a><?php echo $this->utils->getThaiDate($timestamp); ?></p>
                                                            <p><?php echo '<h4>'.$message.'</h4>'; ?></p>
                                                        </div>
                                                    </div>
                                                    
                                                    <?php }else{ ?>
                                                    
													<div class="row pt-20 pr-20 pl-20">
                                                        <div class="col-md-12 theme_box">
                                                            <p class="pre_date"><a class="text-muted">ตอบกลับโดย</a> <?php echo $member_name; ?> <a class="text-muted">เมื่อ</a> <?php echo $this->utils->getThaiDate($timestamp); ?></p>
                                                            <p><?php echo '<h4>'.$message.'</h4>'; ?></p>
                                                        </div>
                                                    </div>
                                                     <?php }  } ?>
                                                    
                                                   
                                                    <?php  } ?>
                                                    
												
											</div>
											

										</div>
									
									</div>
								
                                
                                
                                
                                
                                <div class="row pt-20">
                                                    <div class="col-md-12 ">
                                                   	<form id="create_message" class="type_2" action="<?php echo base_url('message/reply'); ?>" method="post" enctype="multipart/form-data">
                                                    	<input type="hidden" name="message_reply_id" value="<?php echo $last_reply_message_id; ?>"/>
                                                        <input type="hidden" name="receiver_id" value="<?php echo $receiver_id; ?>"/>
                                                        <input type="hidden" name="sender_id" value="<?php echo $this->membermanager->member_id(); ?>"/>
														
														<textarea name="message" id="message" rows="6" required></textarea>
                                                        <button type="submit" class="button_blue middle_btn icon-megaphone">
														ส่งข้อความ
														</button>
                                        			</form>
													</div>
                                                    </div>
                                                    
                                                    
                                                    
								</section>
							</div>
						</div>
						
                       



					</main>
					<!--/ [col]-->

				</div>
				<!--/ .row-->

			</div>
			<!--/ .container-->

		</div>
		<!--/ .page_wrapper-->

	
<?php $this->load->view("templates/footer"); ?>
<?php $this->load->assets_by_name('message'); ?>

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
        placeholder: 'ระบุรายละเอียด ',
		lang: "th-TH",
	 	toolbar: [
			
			["font", ["bold", "underline", "clear"]],
			["color", ["color"]],
			["para", ["ul", "ol", "paragraph"]],
			["insert", ["link", "picture", "video"]]
		],
});

</script>
