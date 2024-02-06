<?php $this->load->view("templates/header"); ?>
<?php
$attributes = array("add_massage", "enctype"=>"multipart/form-data");
echo form_open(base_url('news/add_massage'), $attributes);
?>
<style type="text/css">
	.panel-heading{
	    background-color: #FFFFFF;
	} 
</style>
 <div class="page-wrapper mt-main-wrapper-70">
	
		<div class="row page-titles">
			<div class="col-md-5 align-self-center">
				<h3 class="text-themecolor">ส่งข่าวสาร</h3>
			</div>
			<div class="col-md-7 align-self-center">
				<ol class="breadcrumb">
				<li class="breadcrumb-item">ข่าวสาร</a></li>
				<li class="breadcrumb-item"> ส่งข่าวสาร</li>
				</ol>
			</div>
		</div>
		
	
		<div class="container-fluid">
		
			<div class="row pl-3 pr-3">
				<div class="col-lg-12 col-xlg-12 col-md-12">
					<div class="row">
						
						<div class="col-lg-12 col-xlg-12 col-md-12 mt-3">
							<div class="card">
								<div class="card-body">
		                            <div class="row">
		                                <div class="col-sm-12 col-md-12 col-lg-12 ">
		                                   
		                                    <select class="form-control custom-select" name="message_type" id="message_type" disabled>
												<?php
													$message_type_list = $this->model_news->getMessageType();
													foreach($message_type_list as $row){
													$message_typy_id = $row->id;
													$message_typy_name = $row->message;

												?>
												<option value="<?php echo $message_typy_id;?>" ><?php echo $message_typy_name; ?></option>
												<?php } ?>
											</select>
		                                </div>
		                            </div>
		                            <div class="row pt-3">
		                            	<div class="col-sm-12 col-md-7 col-lg-8">
		                            		<label >หัวข้อข่าวสาร : <a class="text-danger">*</a></label>
		                                	<input type="text" name="message_topic" class="form-control" placeholder="กรุณากรอกหัวข้อข่าวสาร" required>
		                                </div>
		                                <div class="col-sm-12 col-md-5 col-lg-4">
		                                    <label >ส่งถึง : <a class="text-danger">*</a></label>
		                                    <select class="form-control custom-select" name="message_sent_type" id="message_sent_type" onchange="hideSearch();" required>
		                                    	<option value="">กรุณาเลือกผู้รับ</option>
												<?php
													$message_sent_type_list = $this->model_news->getMessageSentType();
													foreach($message_sent_type_list as $row){
													$message_sent_type_id = $row->id;
													$message_sent_type_name = $row->type_name;

												?>
												<option value="<?php echo $message_sent_type_id;?>"><?php echo $message_sent_type_name; ?></option>
												<?php } ?>
											</select>
		                                </div>
		                            </div>
		                            <div class="row pt-3 hideStatus">
		                                <div class="col-sm-12 col-md-12 col-lg-12 ">
		                                   <div class="input-group">
												<input type="text" id="tags" class="form-control h-15" placeholder="กรอกชื่อ-นามสกุล หรือ email สมาชิก">
												<div class="input-group-append">
													<button class="btn btn-info h-38" type="button">ค้นหา</button>
												</div>
											</div>
		                                </div>
		                            </div>

		                            <div class="row pt-3">
		                                <div class="col-sm-12 col-md-12 col-lg-12 p-t-5">
		                                    <label >เนื้อหาข่าวสาร : <a class="text-danger">*</a></label>
		                                </div>
		                                <div class="col-sm-12 col-md-12 col-lg-12">
		                                    <textarea class="summernote" name="message" required>
		                                    	<span class="member_name"></span>
		                                    </textarea>
		                                    <input type="hidden" name="member_id" class="member_id" value="0">
		                                </div>
		                            </div>
		                            <div class="row pt-2">
		                            	<div class="col-sm-12 col-md-8 col-lg-9 p-t-5">
		                            		
		                            	</div>
		                            	<div class="col-sm-12 col-md-4 col-lg-3 p-t-5">
		                            		<button type="submit" class="btn btn-info waves-effect btn-block">ส่งข่าวสาร <span class="icon-paper-plane"></span></button>
		                            	</div>
		                            	
		                            </div>
							
								</div><!-- card-body -->
							</div><!-- card -->
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
</form>

<?php $this->load->view("templates/footer"); ?>
<script src="<?php echo base_url("assets/system/plugins/datatables/jquery.dataTables.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/system/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/custom/js/locales/bootstrap-datepicker.th.js"); ?>"></script>
<script src="<?php echo base_url('assets/system/plugins/clockpicker/dist/jquery-clockpicker.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/system/plugins/clockpicker/dist/bootstrap-clockpicker-custom.js'); ?>"></script>
<script src="<?php echo base_url("assets/custom/js/jquery-ui.js"); ?>"></script>
<?php $this->load->assets_by_name('news'); ?>   


<script>

  // satrt summernote **********
jQuery(document).ready(function() {

    $('.summernote').summernote({
        height: 350, // set editor height
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

function hideSearch(){
	var sent_type = $('#message_sent_type').val();
	console.log(sent_type);
	if(sent_type != 1){
		$(".hideStatus").hide()
	}else{
		$(".hideStatus").show()
	}
}
hideSearch();


</script>