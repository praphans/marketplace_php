<?php $this->load->view("templates/header"); ?>
<link rel="stylesheet" href="<?php echo base_url('assets/css/summernote.css'); ?>">

<div class="secondary_page_wrapper">

				<div class="container">

					<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

					<ul class="breadcrumbs">

						<li><a href="<?php echo base_url(); ?>" class="notcursor">หน้าหลัก</a></li>
						<li><a href="#" class="notcursor">บัญชีร้านค้า</a></li>
						<li>ข้อมูลโปรไฟล์ร้านค้า</li>
					
					</ul>

					<!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->
					
					<div class="row">

						<?php $this->load->view("store/templates/left_tab"); ?>

						<main class="col-md-9 col-sm-8 padding-l-0">

						
						

							<!-- ข้อมูลสินค้า -->
                            <?php
								foreach($store as $row){
									$store_avatar = $row->store_avatar;
									$store_cover = $row->store_cover;
									$store_description = $row->store_description;
								}
								
								if(!$store_avatar){
									$store_avatar = ($this->storemanager->default_avatar_image());
								}
								
								if(!$store_cover){
									$store_cover = ($this->storemanager->default_cover_image());
								}
							?>
							<form action="<?php echo site_url("store/me/saveProfile"); ?>" method="post" enctype="multipart/form-data">
							<div class="theme_box">
								<div class="row">
									<div class="col-xs-12">
										<h4>ข้อมูลโปรไฟล์ร้านค้า</h4>
									</div>
									<div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="row">
                                                
                                                <div class="col-md-3 col-sm-12  col-xs-12 pt-5">
                                                    <div class="image_wrap">
                                                        <img class="store_avatar" width="300" src="<?php echo base_url($store_avatar); ?>" alt="">
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <label  class="pt-15" for="first_name" >รูปโปรไฟล์ ความละเอียด 300 x 300 พิกเซล</label>
                                                    
                                                </div>
                                                <div class="col-md-3 col-sm-12  col-xs-12 pt-5">
                                                	<label for="store_avatar" class="btn-block button_blue middle_btn">เลือกรูปโปรไฟล์</label>
                                                	<input id="store_avatar" type="file" name="store_avatar[]" multiple accept="image/png,image/gif,image/jpeg"/>
                                                    <input type="hidden" name="current_store_avatar" value="<?php echo $store_avatar; ?>"/>
                                                    <input type="hidden" name="current_store_cover" value="<?php echo $store_cover; ?>"/>
                                                        
                                                </div>
                                                <div class="clearfix"></div>
                                        </div>
                                        <div class="row">
                                                
                                                <div class="col-md-12 col-sm-12  col-xs-12 pt-5">
                                                    <div class="image_wrap">
                                                        <img class="store_cover" width="1140" src="<?php echo base_url($store_cover); ?>" alt="">
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <label  class="pt-15" for="first_name" >รูปหน้าปก ความละเอียด 1140 x 385 พิกเซล</label>
                                                    
                                                </div>
                                                <div class="col-md-3 col-sm-12  col-xs-12 pt-5">
                                                   	<label for="store_cover" class="btn-block button_blue middle_btn">เลือกรูปหน้าปก</label>
                                                    
                                                	<input id="store_cover" type="file" name="store_cover[]" multiple accept="image/png,image/gif,image/jpeg"/>
                                                </div>
                                                <div class="clearfix"></div>
                                        </div>
                                        <div class="row">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <label  class="pt-15" for="first_name">เกี่ยวกับเรา</label>
                                                    
                                                </div>
                                                <div class="col-md-12 col-sm-12  col-xs-12 pt-5">
													 <textarea name="store_description" id="store_description" class="form-control" rows="4" required><?php echo $store_description; ?></textarea> 
													
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-md-4 col-md-offset-4 pt-5">
                                                        <button type="submit" class="btn-block button_blue middle_btn">บันทึก</button>
                                                </div>
                                                <div class="clearfix"></div>
                                        </div>
									</div>
								</div>
								
							</div>
                            </form>


						</main><!--/ [col]-->

					</div><!--/ .row-->

				</div><!--/ .container-->

			</div><!--/ .page_wrapper-->

        


<?php $this->load->view("templates/footer"); ?>
<?php $this->load->assets_by_name("left_tab","js"); ?>
<?php $this->load->assets_by_name('Me'); ?>
<script type="text/javascript" src="<?php echo base_url("assets/js/summernote.js"); ?>"></script>
<script>
$('#store_description').summernote({
        placeholder: 'ระบุรายละเอียดร้านค้าและการบริการ',
	 	toolbar: [
			
			["font", ["bold", "underline", "clear"]],
			["color", ["color"]],
			["para", ["ul", "ol", "paragraph"]],
			["insert", ["link", "picture", "video"]]
		],
});
</script>