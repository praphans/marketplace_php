<?php $this->load->view("templates/header"); ?>
  
 <div class="page-wrapper mt-main-wrapper-70">
		<!-- ============================================================== -->
		<!-- Bread crumb and right sidebar toggle -->
		<!-- ============================================================== -->
		<div class="row page-titles">
			<div class="col-md-5 align-self-center">
				<h3 class="text-themecolor">Inbox</h3>
			</div>
			<div class="col-md-7 align-self-center">
				<ol class="breadcrumb">
				<li class="breadcrumb-item"> Inbox</a></li>
				</ol>
			</div>
		</div>
		<!-- ============================================================== -->
		<!-- End Bread crumb and right sidebar toggle -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!-- Container fluid  -->
		<!-- ============================================================== -->
		<div class="container-fluid">
			<!-- ============================================================== -->
			<!-- Start Page Content -->
			<!-- ============================================================== -->
			<!-- Row -->
			<div class="row">
				<div class="col-lg-12 col-xlg-12 col-md-12">
					<div class="row">
						
						<div class="col-lg-3 col-md-4 mt-3">
                            <!-- <div class="list-group"> 
                                <a href="javascript:void(0)" class="list-group-item active">Cras justo odio</a> 
                                <a href="javascript:void(0)" class="list-group-item">Dapibus ac facilisis in</a> 
                                <a href="javascript:void(0)" class="list-group-item">Morbi leo risus</a> 
                                <a href="javascript:void(0)" class="list-group-item">Porta ac consectetur ac</a> 
                                <a href="javascript:void(0)" class="list-group-item">Vestibulum at eros</a> 
                            </div> -->
                            <?php
                                $message_type_session = $this->session->userdata("message_type_session");
                                $active = "";
                                $text_white = "text-secondary";
                                if(!$message_type_session || $message_type_session == 0){
                                    $active = "active"; 
                                    $text_white = "text-white"; 
                                }
                                
                            ?>
                            <ul class="list-group">
                                <li class="list-group-item <?php echo $active; ?>"><a class="<?php echo $text_white; ?>" href="<?php echo base_url("inboxs/inbox/".$filter."/0"); ?>">ทั้งหมด</a></li>
                                <?php
                                foreach($message_type_list as $row){
                                    $active = "";
                                    $text_white = "text-secondary";
                                    $id = $row->id;
                                    $msg = $row->message;
                                    if($message_type_session == $id){
                                        $active = "active";
                                        $text_white = "text-white"; 
                                    }


                                ?>
                                <li class="list-group-item <?php echo $active; ?>"><a class="<?php echo $text_white; ?>" href="<?php echo base_url("inboxs/inbox/".$filter."/".$id); ?>"><?php echo $msg; ?></a></li>
                                
                                <?php } ?>
                            </ul>

						</div>
                        <div class="col-lg-9 col-md-8 mt-3">
                            <div class="card">
                                <div class="card-body">
                                    <?php if($filter == 'receive'){
                                            $receive_active = "active";
                                            $sent_active = "";
                                        }else if($filter == 'sent'){
                                            $receive_active = "";
                                            $sent_active = "active";
                                        }
                                    ?>
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item"> 
                                            <a class="nav-link <?php echo $receive_active; ?>" href="<?php echo base_url("inboxs/inbox/receive/".$message_type_session); ?>" >
                                                <!-- <span class="hidden-sm-up">
                                                    <i class="ti-home"></i>
                                                </span>  -->
                                                <span class="">กล่องข้อความ</span>
                                            </a> 
                                        </li>
                                        <li class="nav-item"> 
                                            <a class="nav-link <?php echo $sent_active; ?>" href="<?php echo base_url("inboxs/inbox/sent/".$message_type_session); ?>">
                                                <!-- <span class="hidden-sm-up">
                                                    <i class="ti-user"></i>
                                                </span>  -->
                                                <span class="">ส่งแล้ว</span>
                                            </a> 
                                        </li>



                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content tabcontent-border">
                                        <div class="tab-pane active" id="home" role="tabpanel">
                                            <div class="p-20">
                                                <ul class="list-group">
                                                        
                                                    <?php 
                                                            
                                                            
                                                            function numMessage($message_id){
                                                                $CI =& get_instance();
                                                                $messages = $CI->model_inboxs->getMessageANDReplyMessageByID($message_id);
                                                                foreach($messages as $row){
                                                                    $message_id = $row->message_id;
                                                                    $message_reply_id = $row->message_reply_id;
                                                                }
                                                                if($message_reply_id > 0){
                                                                    $messages = $CI->model_inboxs->getMessageANDReplyMessageByID($message_reply_id);
                                                                
                                                                    $member_id = 0;//$CI->membermanager->member_id();
                                                                    
                                                                    $result = $CI->model_inboxs->getMyReceiveMessage($member_id,$message_reply_id);
                                                                    
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
                                                                    //$messages_num = $this->model_inboxs->getMessageANDReplyMessageByID($message_reply_id);
                                                                    $messages_num = numMessage($message_id);
                                                                    $last_sent = $this->model_inboxs->getLastSenderMember($message_id);
                                                                    $last_sender_id = $last_sent[0]->sender_id;
                                                                    $last_time_send = $last_sent[0]->timestamp;
                                                                    //$last_message_id = $last_sent[0]->message_id;
                                                                    
                                                                }else if($filter == "sent"){
                                                                    //$messages_num = $this->model_inboxs->getMessageANDReplyMessageByID($message_id);
                                                                    $messages_num = numMessage($message_id);
                                                                    $last_sent = $this->model_inboxs->getMyLastSenderMember($message_id);
                                                                    $last_sender_id = $last_sent[0]->sender_id;
                                                                    $last_time_send = $last_sent[0]->timestamp;
                                                                    //$last_message_id = $last_sent[0]->message_id;
                                                                }
                                                                
                                                                
                                                                
                                                                //echo $message_id." | ".$last_sender_id." | ".$this->membermanager->member_id()."<br>";
                                                                if($last_sender_id != 0 || $filter != "receive"){
                                                                
                                                                
                                                                
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
                                                                    $url_pin_unpin = base_url("inboxs/unpin/".$message_id."/".$filter);
                                                                    $flag_icon = " mdi-flag";
                                                                }else{
                                                                    $active_pin = "";
                                                                    $url_pin_unpin = base_url("inboxs/pin/".$message_id."/".$filter);
                                                                    $flag_icon = " mdi-flag-outline";
                                                                }
                                                                
                                                                $member = $this->model_inboxs->getMemberByID($last_sender_id);
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
                                                            <a href="<?php echo base_url("inboxs/info/".$filter."/".$message_type."/".$message_id); ?>" class="saveHome <?php echo $active; ?>">
                                                                <li class="list-group-item pt-10">
                                                                    <a class="<?php echo $active_pin; ?>" href="<?php echo $url_pin_unpin; ?>">
                                                                        <span class="mdi <?php echo $flag_icon; ?>"></span>
                                                                    </a> 
                                                                    <a href="<?php echo base_url("inboxs/info/".$filter."/".$message_type."/".$message_id); ?>" class="saveHome <?php echo $active; ?>"><?php echo $this->utils->string_shorten(strip_tags($message_topic),100,200); ?>
                                                                    </a>
                                                                    <p><?php echo $member_name." - ".$this->utils->time_ago($last_time_send); ?> 
                                                                    <span class="mdi mdi-facebook-messenger"></span>
                                                                    <?php echo $messages_num; ?>
                                                                    </p>
                                                                </li>
                                                            </a>
                                                            
                                                            <?php  }}} 
                                                            
                                                            
                                                            ?>
                                                    
                                                </ul>
                                            </div>
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
                                    
                                </div>
                            </div>
                        </div>
					</div><!-- row -->
				</div><!-- col-lg-9 --> 
			</div><!-- row -->
		</div><!-- container-fluid -->
		<footer class="footer"> </footer>
	</div><!--สิ้นสุด page-wrapper-->
	<!--เริ่มต้น Footer-->
</div><!-- main-wrapper --> 
  <!--เริ่มต้น Footer-->


<?php $this->load->view("templates/footer"); ?>


<?php $this->load->assets_by_name('inboxs'); ?>   

