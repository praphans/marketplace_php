<?php $this->load->view("templates/header"); ?>
<style type="text/css">
	.panel-heading{
	    background-color: #FFFFFF;
	} 
</style>
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
                                                    <i class="">กล่องข้อความ</i>
                                                </span>  -->
                                                <!-- <span class="hidden-xs-down">กล่องข้อความ</span> -->
                                                <span class="">กล่องข้อความ</span>
                                            </a> 
                                        </li>
                                        <li class="nav-item"> 
                                            <a class="nav-link <?php echo $sent_active; ?>" href="<?php echo base_url("inboxs/inbox/sent/".$message_type_session); ?>">
                                                <!-- <span class="hidden-sm-up">
                                                    <i class="">ส่งแล้ว</i>
                                                </span> 
                                                <span class="hidden-xs-down">ส่งแล้ว</span> -->
                                                <span class="">ส่งแล้ว</span>
                                            </a> 
                                        </li>



                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content tabcontent-border">
                                        <div class="tab-pane active" id="home" role="tabpanel">
                                            <div class="p-20">
                                        	<?php 
												if(count($messages)>0){
													$main_message_id = $messages[0]->message_id;
													$sender_id = $messages[0]->sender_id;
													$message = $messages[0]->message;
													$timestamp = $messages[0]->timestamp;
													$message_topic = $messages[0]->message_topic;
												
													$create = $this->model_inboxs->getMemberByID($sender_id);
													$create_name = "เจ้าหน้าที่";
													if(count($create)) $create_name = $create[0]->first_name." ".$create[0]->last_name;
											?>
                                           	<?php
													$start = 0;
													foreach($messages as $row){
													
														$message_id = $row->message_id;
														$message_reply_id = $row->message_reply_id;
														$receiver_id = $row->receiver_id;
														$sender_id = $row->sender_id;

														$receiver_chx = $row->receiver_id;
														$sender_chx = $row->sender_id;

														$message = $row->message;
														$message_type = $row->message_type;
														$timestamp = $row->timestamp;
													
														if($filter == "receive"){
															$receiver_id = $sender_id;
														}else{
															$receiver_id = $receiver_id;
														}
													
														// print_r($receiver_id."<br>");
														// print_r($sender_id);
														$type = $this->model_inboxs->getMessageTypeByID($message_type);
														$type_name = "-";
														if(count($type)) $type_name = $type[0]->message;
														//$images = $this->model_inboxs->getMessageImageByID($message_id);
														if($filter == "receive"){
															$last_sent = $this->model_inboxs->getLastSenderMember($message_reply_id);
															$last_sender_id = $last_sent[0]->sender_id;
															$last_time_send = $last_sent[0]->timestamp;
															$last_message_id = $last_sent[0]->message_id;
														}else if($filter == "sent"){
															$last_sent = $this->model_inboxs->getLastSenderMember($message_id);
															$last_sender_id = $last_sent[0]->sender_id;
															$last_time_send = $last_sent[0]->timestamp;
															$last_message_id = $last_sent[0]->message_id;
														}
													
														$last_reply_message_id = 0;
														$last_message = $this->model_inboxs->getMessageByID($last_message_id);
														foreach($last_message as $r){
															$last_reply_message_id = $r->message_reply_id;
														}
														if($last_reply_message_id == 0){
															$last_reply_message_id = $message_id;
														}
														$member = $this->model_inboxs->getMemberByID($sender_id);
													
														$member_name = "เจ้าหน้าที่";
														if(count($member)) $member_name = $member[0]->first_name." ".$member[0]->last_name;
												
														if($start == 0){
														$start++;
												?>
	                                                    <div class="row pt-20 pr-20 pl-20">
	                                                        <div class="col-md-12 theme_box">
	                                                            <h4>เรื่อง : <span class="font-weight-bold"><?php echo $message_topic; ?><span></h4>
	                                                            <i class="pre_date text-info">เริ่มส่งโดย : <?php echo $create_name; ?> เมื่อ <?php echo $this->utils->getThaiDate($timestamp); ?> เวลา <?php echo date('H:i',strtotime($timestamp));?> น.</i>
	                                                            <p><?php echo $message; ?></p>
	                                                        </div>
	                                                    </div>
                                                
                                                <?php 	}else{ ?>

														<div class="row pt-20 pr-20 pl-20">
	                                                        <div class="col-md-12 theme_box">
	                                                            <i class="pre_date text-info">
	                                                            	ตอบกลับโดย : <?php echo $member_name; ?> 
	                                                            	เมื่อ <?php echo $this->utils->getThaiDate($timestamp); ?> 
	                                                            	เวลา <?php echo date('H:i',strtotime($timestamp));?> น.
	                                                            </i>
	                                                            <p><?php echo $message; ?></p>
	                                                        </div>
	                                                    </div>

                                                <?php 	} ?>
                                            <?php 	} ?>
                                               
                                        	<?php } ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-4 "><!-- hideSummer -->
	                                    <div class="col-md-12 ">
		                                   	<form id="create_message" class="type_2" action="<?php echo base_url('inboxs/reply'); ?>" method="post" enctype="multipart/form-data">
		                                    	<input type="hidden" name="message_reply_id" value="<?php echo $last_reply_message_id; ?>"/>
		                                        <input type="hidden" name="receiver_id" value="<?php echo $receiver_id; ?>"/>
		                                       	<input type="hidden" name="sender_id" value="0"/>
												
												<div class="">
													<textarea name="message" id="message"  class="summernote" required></textarea>
			                                        <button type="submit" class="btn btn-info mt-3">
													<span class="fa fa-paper-plane-o"></span> ส่งข้อความ 
													</button>
												</div>
		                        			</form>
										</div>
                                    </div>

                                    
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

<script>
	
  // satrt summernote **********
jQuery(document).ready(function() {

    $('.summernote').summernote({
        height: 100, // set editor height
        minHeight: null, // set minimum height of editor
        maxHeight: null, // set maximum height of editor
        focus: false // set focus to editable area after initializing summernote
    });

    $('.inline-editor').summernote({
        airMode: true
    });

});

window.edit = function() {
    $(".click2edit").summernote()
},
window.save = function() {
    $(".click2edit").summernote('destroy');
}

function hideSummernote(){

	var  receiver = parseInt("<?php echo $receiver_chx; ?>");
	var  sender = parseInt("<?php echo $sender_chx; ?>");
	var hideSummer = $(".hideSummer");
	if(sender == 0 || receiver == 0){
		hideSummer.show();
	}else{
		hideSummer.hide();
	}
	console.log("receiver |"+receiver);
	console.log("sender |"+sender);

}
hideSummernote();

</script>