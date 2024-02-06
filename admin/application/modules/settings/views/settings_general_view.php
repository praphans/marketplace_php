<?php $this->load->view("templates/header"); ?>
<?php
$attributes = array("updateGeneralWeb", "enctype"=>"multipart/form-data");
echo form_open(base_url('settings/updateGeneralWeb'), $attributes);


foreach ($contact_info as $row){
	$contact_info_id 		= $row->id;
	$default_title 			= $row->default_title;
	$contact_description 	= $row->contact_description;
	$footer_description 	= $row->footer_description;
	$copyright 				= $row->copyright;
	$facebook_url 			= $row->facebook_url;
	$twitter_url 			= $row->twitter_url;
	$youtube_url 			= $row->youtube_url;
	$instagram_url 			= $row->instagram_url;
	$store_url_description 	= $row->store_url_description;
	$store_review_description= $row->store_review_description;
	$term					= $row->term;
}

?>

<style type="text/css">
	.panel-heading{
	    background-color: #FFFFFF;
	} 
</style>
<input type="hidden" name="contact_info_id" value="<?php echo $contact_info_id; ?>">
 <div class="page-wrapper mt-main-wrapper-70">
	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
			<h3 class="text-themecolor">ตั้งค่าทั่วไป</h3>
		</div>
		<div class="col-md-7 align-self-center">
			<ol class="breadcrumb">
			<li class="breadcrumb-item">ตั้งค่า</a></li>
			<li class="breadcrumb-item"> ตั้งค่าทั่วไป</li>
			</ol>
		</div>
	</div>

	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="card card-outline-info">
					<div class="card-header">
						<h4 class="m-b-0 text-white mdi mdi-settings"> ตั้งค่าทั่วไปเว็บไซต์</h4>
					</div>
					<div class="row pl-3 pr-3 pt-3 pb-3">
						<div class="col-lg-6 pt-4">
							<label class="control-label">Logo เว็บไซต์</label>
							<input type="file"  name="default_logo[]" class="form-control" id="exampleInputFile" aria-describedby="fileHelp">
                            <small  class="pt-15 text-danger" for="first_name" >รูป Logo ความละเอียด 800 x 222 พิกเซล</small>
						</div>
						<div class="col-lg-6 pt-4">
							<label class="control-label">Title เว็บไซต์</label>
							<input type="text" name="default_title" class="form-control" value="<?php echo $default_title; ?>">
						</div>
						<div class="col-lg-6 pt-4">
							<label class="control-label">Copyright</label>
							<input type="text" name="copyright" class="form-control" value="<?php echo $copyright; ?>">
						</div>
						<div class="col-lg-6 pt-4">
							<label class="control-label">Facebook URL</label>
							<input type="text" name="facebook_url" class="form-control" value="<?php echo $facebook_url; ?>">
						</div>
						<div class="col-lg-6 pt-4">
							<label class="control-label">Twitter URL</label>
							<input type="text" name="twitter_url" class="form-control" value="<?php echo $twitter_url; ?>">
						</div>
						<div class="col-lg-6 pt-4">
							<label class="control-label">Youtub URL</label>
							<input type="text" name="youtube_url" class="form-control" value="<?php echo $youtube_url; ?>">
						</div>
						<div class="col-lg-6 pt-4">
							<label class="control-label">Instagram URL</label>
							<input type="text" name="instagram_url" class="form-control" value="<?php echo $instagram_url; ?>">
						</div>
						<div class="col-lg-6 pt-4">
							<label class="control-label">Footer เว็บไซต์</label>
							<input class="form-control" type="text" name="footer_description" value="<?php echo $footer_description; ?>">
						</div>

						
						
						<div class="col-lg-12 pt-4">
							<label class="control-label">คำอธิบาย กฎกติกาการรีวิว</label>
							<textarea class="summernote" name="store_review_description"><?php echo $store_review_description; ?></textarea>
						</div>
						<div class="col-lg-12 pt-4">
							<label class="control-label">คำอธิบาย URL ร้านค้า</label>
							<textarea class="summernote" name="store_url_description"><?php echo $store_url_description; ?></textarea>
						</div>
						<div class="col-lg-12 pt-4">
							<label class="control-label">รายละเอียดการติดต่อ</label>
							<textarea class="summernote" name="contact_description"><?php echo $contact_description; ?></textarea>
						</div>
						<div class="col-lg-12 pt-4">
							<label class="control-label">ข้อกำหนดและเงื่อนไข</label>
							<textarea class="summernote" name="term"><?php echo $term; ?></textarea>
						</div>
						<div class="col-lg-6 pt-4">
							<div class="form-actions">
								<button type="submit" class="btn btn-success"> &nbsp&nbsp<i class="fa fa-check"></i> บันทึกข้อมูล &nbsp&nbsp</button>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</form>

<footer class="footer"> </footer>

<?php $this->load->view("templates/footer"); ?>
<script src="<?php echo base_url("assets/system/plugins/datatables/jquery.dataTables.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/system/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/custom/js/locales/bootstrap-datepicker.th.js"); ?>"></script>
<script src="<?php echo base_url('assets/system/plugins/clockpicker/dist/jquery-clockpicker.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/system/plugins/clockpicker/dist/bootstrap-clockpicker-custom.js'); ?>"></script>

<?php $this->load->assets_by_name('settings'); ?>   


<script>

  // satrt summernote **********
jQuery(document).ready(function() {

    $('.summernote').summernote({
        height: 250, // set editor height
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
</script>