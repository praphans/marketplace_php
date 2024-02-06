<?php $this->load->view("templates/header"); ?>


<div class="secondary_page_wrapper">

				<div class="container">

					<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

					<ul class="breadcrumbs">

						<li><a href="<?php echo base_url(); ?>" class="notcursor">หน้าหลัก</a></li>
						<li><a href="<?php echo base_url('store'); ?>" class="notcursor">บัญชีร้านค้า</a></li>
						<li>ข้อมูลทะเบียนร้านค้า</li>
					
					</ul>

					<!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->

					<div class="row">

						<?php $this->load->view("store/templates/left_tab"); ?>
 
						<main class="col-md-9 col-sm-8 padding-l-0">      
							<?php
							
							foreach($myStore as $row){
								$vat_checked = "";
								$vat_checked_val = "ไม่จดทะเบียนภาษีมูลค่าเพิ่ม";
								$store_id = $row->store_id;
								$member_id = $row->member_id;
								$store_name = $row->store_name;
								$store_avatar = $row->store_avatar;
								$store_cover = $row->store_cover;
								$store_description = $row->store_description;
								$store_url = $row->store_url;
								$store_type = $row->store_type;
								$store_category = $row->store_category;
								$store_status = $row->store_status;
								$first_name = $row->first_name;
								$last_name = $row->last_name;
								$identity_number = $row->identity_number;
								$tel = $row->tel;
								$province = $row->province;
								$amphur = $row->amphur;
								$district = $row->district;
								$address = $row->address;
								$store_is_vat = $row->store_is_vat;
								$zipcode = $row->zipcode;
								$account_name = $row->account_name;
								$account_number = $row->account_number;
								$bank_name = $row->bank_name;
								$timestamp = $row->timestamp;
								$store_status = $row->store_status;
								
								$store_type = intval($store_type);
								$store_type_result = $this->model_registration->getStoreTypeByID($store_type);
								if(count($store_type_result)>0){
									$store_type_name = $store_type_result[0]->type_name;
								}else{
									$store_type_name = "";
								}
								$member_result = $this->model_registration->getMemberByID($member_id);
								if(count($member_result)>0){
									$email = $member_result[0]->email;
								}else{
									$email = "";
								}

								$province = $this->storemanager->getProvinceName($province);
								$amphur = $this->storemanager->getAmphurName($amphur);
                                $district = $this->storemanager->getDistrictName($district);
								
								$document = $this->storemanager->getMyDocument();
								foreach($document as $doc){
									$company_doc = ($doc->company_doc)?explode(",",$doc->company_doc):array();
									$identity_doc = ($doc->identity_doc)?explode(",",$doc->identity_doc):array();
									$identity_multi_doc = ($doc->identity_multi_doc)?explode(",",$doc->identity_multi_doc):array();
									$book_twenty_doc = ($doc->book_twenty_doc)?explode(",",$doc->book_twenty_doc):array();
									$book_bank_doc = ($doc->book_bank_doc)?explode(",",$doc->book_bank_doc):array();
									$book_other_doc = ($doc->book_other_doc)?explode(",",$doc->book_other_doc):array();
									$house_particular_doc = ($doc->house_particular_doc)?explode(",",$doc->house_particular_doc):array();
								}
								
								/*$company_doc = (count($company_doc)>0)?$company_doc[0]:"";
								$identity_doc = (count($identity_doc)>0)?$identity_doc[0]:"";
								$identity_multi_doc = (count($identity_multi_doc)>0)?$identity_multi_doc[0]:"";
								$book_twenty_doc = (count($book_twenty_doc)>0)?$book_twenty_doc[0]:"";
								$book_bank_doc = (count($book_bank_doc)>0)?$book_bank_doc[0]:"";
								$book_other_doc = (count($book_other_doc)>0)?$book_other_doc[0]:"";*/
									
								if($store_is_vat){
									$vat_checked = "checked";
									$vat_checked_val = "จดทะเบียนภาษีมูลค่าเพิ่ม";
								}
								$address = $address." อ.".$amphur." จ.".$province." รหัสไปรษณีย์ ".$zipcode;
								$bank = $account_name." ".$bank_name." ".$account_number;
								$store_categorys = $this->storemanager->getStoreCategory();
								$store_category_name = $store_categorys[0]->category_name;
								
								if($store_status == 1){
									$store_label_status = "รออนุมัติเปิดร้าน";
								}else if($store_status == 6){
									$store_label_status = "ขอแก้ไขข้อมูลร้านค้า";
								}else{
									$store_label_status = "อนุมัติเปิดร้านแล้ว";
								}
							}
							
							?>

							<!-- ข้อมูลสินค้า -->
							<div class="theme_box">
								<div class="row">
									<div class="col-xs-12">
										<h4></i>ข้อมูลทะเบียนร้านค้า </h4>
	                                    <p>สถานะ
	                                    <span class="label label-success"><?php echo $store_label_status; ?></span></p>
	                                    
									</div>
								</div>
								<div class="row">
									<div class="col-md-4 col-xs-6 pt-10">
										<strong>ชื่อร้าน</strong>
										<p class="text-muted word-break"><?php echo $store_name; ?></p>
									</div>
									<div class="col-md-8 col-xs-6 pt-10">
										<strong>ชื่อ URL</strong>
										<p class="text-muted word-break"><a href="<?php echo base_url($store_url); ?>"><?php echo base_url($store_url); ?></a></p>
									</div>
									<div class="col-md-4 col-xs-6 pt-10">
										<strong>หมวดหมู่ร้านค้า</strong>
										<p class="text-muted word-break"><?php echo $store_category_name; ?></p>
									</div>
									<div class="col-md-4 col-xs-6 pt-10">
										<strong>ชื่อผู้จดทะเบียน</strong>
										<p class="text-muted word-break">
										<?php
										if($store_type == 1){
											echo $first_name." ".$last_name; 
										}else{
											echo $first_name; 
										}
										?>
										</p>
									</div>
									<div class="col-md-4 col-xs-6 pt-10">
										<?php if($store_type == 2){ ?>
											<strong>เลขทะเบียนนิติบุคคล</strong>
										<?php }else{ ?>
											<strong>เลขประจำตัวประชาชน</strong>
										<?php } ?>
										<p class="text-muted word-break"><?php echo $identity_number; ?></p>
									</div>
									<div class="col-md-4 col-xs-6 pt-10">
										<strong>ประเภทร้านค้า</strong>
										<p class="text-muted word-break"><?php echo $store_type_name; ?></p>
									</div>
									<div class="col-md-4 col-xs-6 pt-10">
										<strong>เบอร์โทรศัพท์</strong>
										<p class="text-muted word-break"><?php echo $tel; ?></p>
									</div>
									<div class="col-md-4 col-xs-6 pt-10">
										<strong>อีเมล์</strong>
										<p class="text-muted word-break"><?php echo $email; ?></p>
									</div>
									<div class="col-md-4 col-xs-6 pt-10">
										<strong>สถานภาพผู้ประกอบการจดทะเบียนภาษีมูลค่าเพิ่ม</strong>
										<?php echo $vat_checked_val; ?>
									</div>
									<div class="col-md-4 col-xs-6 pt-10">
										<strong>บัญชีธนาคาร</strong>
										<p class="text-muted word-break"><?php echo $bank; ?></p>
									</div>
									<div class="col-md-4 col-xs-6 pt-10">
										<strong>ที่ตั้ง</strong>
										<p class="text-muted word-break"><?php echo $address; ?></p>
									</div>

								</div>
								<div class="row pt-l-r-15 legal_entity">
									
	                                <?php if(isset($company_doc) && count($company_doc)>0){ ?>
	                                	<strong>หนังสือจดทะเบียนนิติบุคคล</strong>
	                                	<br>
	                                <?php 
										for($i = 0;$i<count($company_doc);$i++){ 
											$url = $company_doc[$i];
										?>
										<div class="col-md-6 col-xs-6 b-r pt-15">
											<div class="image_wrap">
												<img src="<?php echo base_url($url); ?>" alt="">
											</div>
										</div>
	                                <?php } }?>
	                            </div>
	                            <div class="row pt-l-r-15 natural_person">
	                               
	                                <?php if(isset($identity_doc) && count($identity_doc)>0){ ?>
	                                	<strong>สำเนาบัตรประชาชนในนามบุคคล</strong>
	                                	<br>
	                                <?php 
										for($i = 0;$i<count($identity_doc);$i++){ 
											$url = $identity_doc[$i];
										?>
										<div class="col-md-6 col-xs-6 b-r pt-15">
											<div class="image_wrap">
												<img src="<?php echo base_url($url); ?>" alt="">
											</div>
										</div>
	                                <?php } }?>
									
	                            </div>
	                            <div class="row pt-l-r-15 natural_person">
	                               
	                                <?php if(isset($house_particular_doc) && count($house_particular_doc)>0){ ?>
	                                	<strong>สำเนาทะเบียนบ้าน</strong>
	                                	<br>
	                                <?php 
										for($i = 0;$i<count($house_particular_doc);$i++){ 
											$url = $house_particular_doc[$i];
										?>
										<div class="col-md-6 col-xs-6 b-r pt-15">
											<div class="image_wrap">
												<img src="<?php echo base_url($url); ?>" alt="">
											</div>
										</div>
	                                <?php } }?>
									
	                            </div>
	                            <div class="row pt-l-r-15 legal_entity">
	                            	
	                                <?php if(isset($identity_multi_doc) && count($identity_multi_doc)>0){ ?>
	                                	<strong>สำเนาบัตรประชาชนของคณะกรรมการผู้มีอำนาจทั้งหมดที่มีรายชื่อในหนังสือจดทะเบียนนิติบุคคล</strong>
	                                	<br>
	                                <?php 
										for($i = 0;$i<count($identity_multi_doc);$i++){ 
											$url = $identity_multi_doc[$i];
										?>
										<div class="col-md-6 col-xs-6 b-r pt-15">
											<div class="image_wrap">
												<img src="<?php echo base_url($url); ?>" alt="">
											</div>
										</div>
	                                <?php } }?>
	                            </div>
	                            <div class="row pt-l-r-15 pp20">
									
	                                <?php if(isset($book_twenty_doc) && count($book_twenty_doc)>0){ ?>
	                                	<strong>หนังสือจดทะเบียน ภพ 20</strong>
	                                	<br>
	                                <?php 
										for($i = 0;$i<count($book_twenty_doc);$i++){ 
											$url = $book_twenty_doc[$i];
										?>
										<div class="col-md-6 col-xs-6 b-r pt-15">
											<div class="image_wrap">
												<img src="<?php echo base_url($url); ?>" alt="">
											</div>
										</div>
	                                <?php } }?>
									
	                           	</div>
	                            <div class="row pt-l-r-15">
	                            	
	                                <?php if(isset($book_bank_doc) && count($book_bank_doc)>0){ ?>
	                                	<strong>สำเนาหน้าสมุดบัญชีธนาคารที่มีชื่อตรงกับชื่อผู้ลงทะเบียน</strong>
	                                	<br>
	                                <?php 
										for($i = 0;$i<count($book_bank_doc);$i++){ 
											$url = $book_bank_doc[$i];
										?>
										<div class="col-md-6 col-xs-6 b-r pt-15">
											<div class="image_wrap">
												<img src="<?php echo base_url($url); ?>" alt="">
											</div>
										</div>
	                                <?php } }?>
	                            </div>
	                            <div class="row pt-l-r-15">    
	                                
	                                <?php if(isset($book_other_doc) && count($book_other_doc)>0){ ?>
	                                	<strong>อื่นๆ</strong>
	                                	<br>
	                                <?php 
										for($i = 0;$i<count($book_other_doc);$i++){ 
											$url = $book_other_doc[$i];
										?>
										<div class="col-md-6 col-xs-6 b-r pt-15">
											<div class="image_wrap">
												<img src="<?php echo base_url($url); ?>" alt="">
											</div>
										</div>
	                                <?php } }?>
	                            </div>
	                            <div class="row pt-l-r-15">
	                                <div class="col-md-12 pt-20">
	                                  <a href="<?php echo base_url("store/registration/edit"); ?>" class="button_blue middle_btn text-center"><i class="icon-edit"></i> ขอเปลี่ยนแปลงข้อมูลจดทะเบียน</a>
	                                </div>
	                           
	                       		</div>
	                       	</div>

					
						</main><!--/ [col]-->

					</div><!--/ .row-->

				</div><!--/ .container-->

			</div><!--/ .page_wrapper-->

        


<?php $this->load->view("templates/footer"); ?>
<?php $this->load->assets_by_name("left_tab"); ?> 
<?php $this->load->assets_by_name("Registration"); ?>

<script>

function hideStrType(){
	var store_type = "<?php echo $store_type; ?>";	
	var store_is_vat = "<?php echo $store_is_vat; ?>";	
	if(store_type == 2){ 
		// console.log(store_type);
		$(".legal_entity").show(); //นิติบุคคล
		$(".natural_person").hide(); //บุคคลธรรมดา

	}else{ 
		// console.log(store_type);
		$(".legal_entity").hide(); //นิติบุคคล
		$(".natural_person").show(); //บุคคลธรรมดา
		
	}

	if(store_is_vat == 1){
		$(".pp20").show();
	}else{
		$(".pp20").hide();
	}


}
hideStrType();
</script>