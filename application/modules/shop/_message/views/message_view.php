<?php $this->load->view("templates/header"); ?>

			<div class="secondary_page_wrapper">

			<div class="container">

				<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

				<ul class="breadcrumbs">

					<li><a href="<?php echo base_url(); ?>">หน้าหลัก</a></li>
					<li><a href="<?php echo base_url("message"); ?>">Inbox</a></li>



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
                            <ul class="theme_menu inbox_theme_menu">
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
						
						<div class="row">
							<div class="col-xs-12 pt-5">
								<section class="col-md-12 col-sm-12 col-xs-12">

									<div class="tabs type_2 initialized">

										<!-- - - - - - - - - - - - - - Navigation of tabs - - - - - - - - - - - - - - - - -->
										<?php if($filter == 'receive'){
											$receive_active = "active";
											$sent_active = "";
										}else if($filter == 'sent'){
											$receive_active = "";
											$sent_active = "active";
										}
										?>
										<ul class="tabs_nav inbox_tabs_nav clearfix">
			
											<li class="<?php echo $receive_active; ?>"><a href="<?php echo base_url("message/inbox/receive/".$message_type_session); ?>">กล่องข้อความ</a></li>
											<li class="<?php echo $sent_active; ?>"><a href="<?php echo base_url("message/inbox/sent/".$message_type_session); ?>">ส่งแล้ว</a></li>


										</ul>

										<!-- - - - - - - - - - - - - - End navigation of tabs - - - - - - - - - - - - - - - - -->

										<!-- - - - - - - - - - - - - - Tabs container - - - - - - - - - - - - - - - - -->

										<div class="tab_containers_wrap" style="height: 343px;">

											<!-- - - - - - - - - - - - - - Tab - - - - - - - - - - - - - - - - -->

											<div id="tab-7" class="tab_container">
												<div class="row">
													<div class="col-md-12">
														<ul class="list-group">
                                                        
                                                        	<?php 
															
															
															function numMessage($message_id){
																$CI =& get_instance();
																$messages = $CI->model_message->getMessageANDReplyMessageByID($message_id);
																foreach($messages as $row){
																	$message_id = $row->message_id;
																	$message_reply_id = $row->message_reply_id;
																}
																if($message_reply_id > 0){
																	$messages = $CI->model_message->getMessageANDReplyMessageByID($message_reply_id);
																
																	$member_id = $CI->membermanager->member_id();
																	
																	$result = $CI->model_message->getMyReceiveMessage($member_id,$message_reply_id);
																	
																	foreach($result as $row){
																		$message_code = $row->message_code;
																	}
																	
																	
																}
																
																return count($messages);
															}
		
															if(count($messages) > 0){
															
															
															foreach($messages as $row){
																$message_id = $row->message_id;
																$receiver_id = $row->receiver_id;
																$message_reply_id = $row->message_reply_id;
																$message_topic = $row->message_topic;
																$topic_code = $row->topic_code;
																$sender_id = $row->sender_id;
																$message = $row->message;
																$message_type = $row->message_type;
																$is_read = $row->is_read;
																$is_pin = $row->is_pin;
																$timestamp = $row->timestamp;
																
																//echo $timestamp."<br>";
																//echo 'message_id : '.$message_id."<br>";
																//echo 'message_reply_id : '.$message_reply_id."<br>";
																if($filter == "receive"){
																	//$messages_num = $this->model_message->getMessageANDReplyMessageByID($message_reply_id);
																	$messages_num = numMessage($message_id);
																	$last_sent = $this->model_message->getLastSenderMember($message_id);
																	$last_sender_id = $last_sent[0]->sender_id;
																	$last_time_send = $last_sent[0]->timestamp;
																	//$last_message_id = $last_sent[0]->message_id;
																	
																}else if($filter == "sent"){
																	//$messages_num = $this->model_message->getMessageANDReplyMessageByID($message_id);
																	$messages_num = numMessage($message_id);
																	$last_sent = $this->model_message->getMyLastSenderMember($message_id);
																	$last_sender_id = $last_sent[0]->sender_id;
																	$last_time_send = $last_sent[0]->timestamp;
																	//$last_message_id = $last_sent[0]->message_id;
																}
																
																
																
																//echo $message_id." | ".$last_sender_id." | ".$this->membermanager->member_id()."<br>";
																if($last_sender_id != $this->membermanager->member_id() || $filter != "receive"){
																
																
																
																if($filter == "receive"){
																	$member_id = $messages[count($messages)-1]->sender_id;
																	//$member_id = $sender_id;
																}else{
																	$member_id = $messages[count($messages)-1]->receiver_id;
																	//$member_id = $receiver_id;
																}
																
																if($is_read == 0 && $filter == "receive"){
																	$active = "active"; //active
																}else{
																	$active = "";
																}
																if($is_pin == 1){
																	$active_pin = "active";
																	$url_pin_unpin = base_url("message/unpin/".$message_id."/".$filter);
																}else{
																	$active_pin = "";
																	$url_pin_unpin = base_url("message/pin/".$message_id."/".$filter);
																}
																
																$member = $this->model_message->getMemberByID($last_sender_id);
																$member_name = "เจ้าหน้าที่";
																if(count($member)){
																	$member_name = $member[0]->first_name." ".$member[0]->last_name;
																}else{
																	
																	if($message_type == 2 && $filter == "sent" && $message_reply_id == 0){
																		$member_name = "ผู้ติดตาม";
																	}
																}
																if($message_topic == ""){
																	$message_topic = $message;
																}
																
															?>
															<li class="list-group-item pt-10"><a class="<?php echo $active_pin; ?>" href="<?php echo $url_pin_unpin; ?>"><span class="icon-flag msg_icon pr-5 flag-inbox"></span></a> <a href="<?php echo base_url("message/info/".$filter."/".$message_type."/".$message_id); ?>" class="saveHome <?php echo $active; ?>"><?php echo $this->utils->string_shorten(strip_tags($message_topic),100,200); ?></a><p><?php echo $member_name." - ".$this->utils->time_ago($last_time_send); ?> <span class="icon-comment-alt"></span><?php echo $messages_num; ?></p></li>
															
                                                            <?php  }}} 
															
															
															?>
                                                            
														</ul>
											
													</div>
												</div>
											</div>
											<!--/ #tab-7-->

											<!-- - - - - - - - - - - - - - End tab - - - - - - - - - - - - - - - - -->

											


										</div>
										<!--/ .tab_containers_wrap -->

										<!-- - - - - - - - - - - - - - End of tabs containers - - - - - - - - - - - - - - - - -->

									</div>
									<!--/ .tabs-->

									<!-- - - - - - - - - - - - - - End of tabs v2 - - - - - - - - - - - - - - - - -->

								</section>
							</div>
						</div>
						
                        <?php if($pagination != ""){ ?>
						<footer class="bottom_box on_the_sides">

                            <div class="left_side">
                                <p><?php //echo $page_showing; ?></p>
                            </div>
                        
                            <div class="right_side">
                                <?php echo $pagination ?>  
                            </div>
    
                        </footer>
						<?php } ?>
						<!-- ข้อมูลสินค้า -->



					</main>
					<!--/ [col]-->

				</div>
				<!--/ .row-->

			</div>
			<!--/ .container-->

		</div>
		<!--/ .page_wrapper-->

	
<?php $this->load->view("templates/footer"); ?>
<?php $this->load->assets('js'); ?>


