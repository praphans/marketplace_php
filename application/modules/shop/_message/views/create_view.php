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

			<form id="create_message" class="type_2" action="<?php echo base_url('message/send'); ?>" method="post" enctype="multipart/form-data">
			<div class="secondary_page_wrapper">

				<div class="container">

					<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

					<ul class="breadcrumbs">

						<li><a href="<?php echo base_url(); ?>">หน้าหลัก</a></li>
						<li>ส่งข้อความ</li>

					</ul>

					<!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->

					<div class="row"> 

						<main class="col-md-12 col-sm-12 padding-l-0">
							
                            <div class="clearfix search bg-white">
                            	<?php
								// 0 = ทุกคน
								// 1 = ติดต่อผู้ขาย
								// 2 = ติดต่อผู้ซื้อ
								// 3 = ติดต่อผู้ส่ง
	
								if($send_to == 1){
									$topic = "ติดต่อผู้ขาย";
								}else if($send_to == 2){
									$topic = "ติดต่อผู้ซื้อ";
								}else if($send_to == 3){
									$topic = "ติดต่อผู้ส่ง";
								}else if($send_to == 4){
									$topic = "ร้องเรียน";
								}else if($send_to == 5){
									$topic = "ส่งข่าวสารถึงผู้ติดตาม";
								}else if($send_to == 6){
									$topic = "ส่งข่าวสารถึงคู่ค้า";
								}else{
									$topic = "ส่งข่าวสาร";
								}
								?>
								<div class="open_categories font-icon text-center"><?php echo $topic; ?></div>
							</div><!--/ #search-->
							<!-- ข้อมูลสินค้า -->

							<div class="theme_box"> 
								<div class="row">
									<div class="col-xs-12">
										<form class="type_2">
											<ul>
                                            	<?php 
												if(isset($order_id) && $order_id != 0){
													
													$order = $this->model_message->getOrderByID($order_id);
													foreach($order as $row){
														$order_code = $row->order_code;	
														$store_id = $row->store_id;	
														$depositor_store_id = $row->depositor_store_id;	
													}
													
												?>
                                                
												<li class="row">
													<div class="col-xs-12">
														<label for="first_name" class="">อ้างถึงเลขที่คำสั่งซื้อ :</label>
														<b class=""><?php echo $order_code; ?></b>
													</div>
												</li>
												<?php } ?>
                                                
                                               <?php 
												if(isset($to_store_id) && $to_store_id != 0){
													
													$store_name = "-";
													$store = $this->model_message->getStoreByID($to_store_id);
													foreach($store as $row){
														$store_name = $row->store_name;	
													}
													
												?>
                                                
												<li class="row">
													<div class="col-xs-12">
														<label for="first_name" class="">ข้อความถึง :</label>
														<b class=""><?php echo $store_name; ?></b>
													</div>
												</li>
												<?php } ?>
													
													
                                                <input type="hidden" name="store_id" value="<?php echo $to_store_id; ?>" />
                                                <input type="hidden" name="order_id" value="<?php echo $order_id; ?>" />
                                                <input type="hidden" name="send_to" value="<?php echo $send_to; ?>" />
												<li class="row">
													<div class="col-xs-12">
														<label for="message_type" class="">ประเภท :</label>
														<div class="">
															<select  name="message_type" id="message_type" class="form-control"  disabled="disabled">
																<?php
																foreach($message_type as $row){
																	$id = $row->id;
																	$msg = $row->message;
																?>
																<option value="<?php echo $id; ?>"><?php echo $msg; ?></option>
																<?php } ?>
															</select>
                                                            <input type="hidden" name="message_type" value="<?php echo $message_type_id; ?>" />
														</div>
													</div>
												</li>
                                                <li class="row pt-20">
													<div class="col-xs-12">
														<label for="message_type" class="">เรื่อง :</label>
														<input type="text" name="message_topic" placeholder="ระบุหัวข้อเรื่อง" required>
													</div>
												</li>
												<li class="row pt-20">
													<div class="col-xs-12">
														<label for="message" class="">รายละเอียด :</label>
														<textarea name="message" id="message" rows="6" required></textarea>
													</div>
												</li>
												<!--<li class="row">
													<div class="col-xs-12">
														<div class="row"> 
															<div class="col-xs-12 col-sm-3 col-md-3">
                                                            <label for="message_image" class=" big_btn btn-block custom-file-upload">
                                                                    <i class="icon-upload-cloud"></i> อัพโหลดไฟล์<span class="filename"></span>
                                                                </label>
                                                                <input id="message_image" type="file" name="message_image[]" accept="image/png,image/gif,image/jpeg" >
															</div>
																
														</div>
													</div>
												</li>-->
												<li class="row">
													
												</li>
											</ul>
										</form>
									</div> 
								</div> 
							</div> 

							<footer class="bottom_box ">
								<div class="row">
									<div class="col-xs-12 col-sm-3 col-md-5 pt-0 pb-0">
										<!-- contant -->
									</div>
									<div class="col-xs-12 col-sm-6 col-md-2">
										<button type="submit" class="btn-block button_blue middle_btn icon-megaphone">
											ส่งข้อความ
										</button>
									</div>
								</div>
							</footer>

						</main><!--/ [col]-->

					</div><!--/ .row-->

				</div><!--/ .container-->

			</div><!--/ .page_wrapper-->
			</form>
			<!-- - - - - - - - - - - - - - End Page Wrapper - - - - - - - - - - - - - - - - -->

	
<?php $this->load->view("templates/footer"); ?>
<script type="text/javascript" src="<?php echo base_url("assets/js/summernote.js"); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/summernote-th-TH.js"); ?>"></script>
<script>
var message_type_id = "<?php if(isset($message_type_id)) echo $message_type_id; ?>";
if(message_type_id && message_type_id != 0){
	$("#message_type").val(message_type_id);	
}


$(function() {
	setTimeout(resize,500);
});

function resize(){
	$(window).trigger('resize');
}

$('#message').summernote({
        placeholder: 'ระบุรายละเอียด <?php echo $topic; ?>',
		lang: "th-TH",
	 	toolbar: [
			
			["font", ["bold", "underline", "clear"]],
			["color", ["color"]],
			["para", ["ul", "ol", "paragraph"]],
			["insert", ["link", "picture", "video"]]
		],
});
</script>

