<?php $this->load->view("templates/header"); ?>

	<?php
		foreach($store_byid as $row){
			$store_id = $row->store_id;
			$store_name = $row->store_name;
			$member_id = $row->member_id;
			$store_avatar = '../'.$row->store_avatar;
			$store_cover = '../'.$row->store_cover;
			$first_name = $row->first_name;
			$last_name = $row->last_name;
			$tel = $row->tel;
			$address = $row->address;
			$store_description = $row->store_description;
			$store_code = $row->store_code;
			$identity_number = $row->identity_number;
			$zipcode = $row->zipcode;
			$store_rating = $row->store_rating;
			$store_follower = $row->store_follower;
			$store_shipping_charge = $row->store_shipping_charge;
			$store_is_vat = $row->store_is_vat;
			$store_status = $row->store_status;
			$store_url = $row->store_url;
			$account_name = $row->account_name;
			$account_number = $row->account_number;
			$bank_name = $row->bank_name;
			$store_type = $row->store_type;
			$timestamp = $row->timestamp;
		
		} 

		$verify_url = base_url("store/verify/".$store_id);
		$edit_verify_url = base_url("store/editVerify/".$store_id);
		$canceled_url = base_url("store/canceled/".$store_id);
		$not_allowed_url = base_url("store/not_allowed/".$store_id);
		if($store_status == 1){
			$btn_confirm = "<div class='col-lg pb-md-1 pb-sm-1'><a href='".$verify_url."' class='btn btn-info btn-block'>อนุมัติ</a></div>";
			$btn_notconfirm = "<div class='col-lg '><a href='".$not_allowed_url."' class='btn btn-danger btn-block'>ไม่อนุมัติ</a></div>";
		}else if($store_status == 2){
			$btn_confirm = "<div class='col-lg'><a href='".$canceled_url."' class='btn btn-warning btn-block'>ยกเลิกการอนุมัติ</a></div>";
			$btn_notconfirm = "";
		}else if($store_status == 3){
			$btn_confirm = "<div class='col-lg'><a href='".$canceled_url."' class='btn btn-danger btn-block'>ยกเลิกการไม่อนุมัติ</a></div>";
			$btn_notconfirm = "";
		}else if($store_status == 4){
			$btn_confirm = "";
			$btn_notconfirm = "";
		}else if($store_status == 5){
			$btn_confirm = "<div class='col-lg'><a href='".$canceled_url."' class='btn btn-warning btn-block'>ยกเลิกการอนุมัติ</a></div>";
			$btn_notconfirm = "";
		}else if($store_status == 6){
			$btn_confirm = "<div class='col-lg pb-md-1 pb-sm-1'><a href='".$edit_verify_url."' class='btn btn-info btn-block'>อนุมัติ</a></div>";
			$btn_notconfirm = "<div class='col-lg '><a href='".$not_allowed_url."' class='btn btn-danger btn-block'>ไม่อนุมัติ</a></div>";
		}else{
			$btn_confirm = "";
			$btn_notconfirm = "";
		}

		$b = base_url();
		$str = stristr($b,"admin/",true);
		$store = $str.$store_url;

		$title = "คุณ";
		if(empty($first_name) || empty($last_name)){
			$title = "-";
		}
		$province_name = " -";
		foreach($provinces as $row){
			$province_name = $row->province_name;
		}
		$amphur_name = " -";
		foreach($amphures as $row){
			$amphur_name = $row->amphur_name;
		}

		$work_day = " -";
		$work_starttime = " -";
		$work_endtime = " -";
		foreach($store_working as $row){
			$work_day = $row->work_day;
			$work_starttime = $row->work_starttime;
			$work_endtime = $row->work_endtime;
		}
		$place_name = " -";
		$place_code = " -";
		foreach($place as $row){
			$place_code = $row->place_code;
			$place_name = $row->place_name;
		} 
		$province_name_place = " -";
		foreach($provinces_place as $row){
			$province_name_place = $row->province_name;
		}
		$type_name = " -";
		foreach($store_type_byid as $row){
			$type_name = $row->type_name;
		}
		$category_name = " -";
		foreach($store_category as $row){
			$category_name = $row->category_name;
		}
		$status_name = " -";
		foreach($store_status_m as $row){
			$status_name = $row->status_name;
		}

		
		
		// $store_doc = $this->model_store->getDocumentByID($store_id);
		// foreach($store_doc as $rowd){
		// 	$company_doc = $rowd->company_doc;
		// 	$identity_doc = $rowd->identity_doc;
		// 	$identity_multi_doc = $rowd->identity_multi_doc;
		// 	$book_twenty_doc = $rowd->book_twenty_doc;
		// 	$book_bank_doc = $rowd->book_bank_doc;
		// 	$book_other_doc = $rowd->book_other_doc;
		// }
		$company_doc = array();
		$identity_doc = array();
		$identity_multi_doc = array();
		$book_twenty_doc = array();
		$book_bank_doc = array();
		$book_other_doc = array();
		$house_particular_doc = array();
		$document = $this->model_store->getMyDocument($store_id);
		foreach($document as $doc){
			$company_doc = ($doc->company_doc)?explode(",",$doc->company_doc):array();
			$identity_doc = ($doc->identity_doc)?explode(",",$doc->identity_doc):array();
			$identity_multi_doc = ($doc->identity_multi_doc)?explode(",",$doc->identity_multi_doc):array();
			$book_twenty_doc = ($doc->book_twenty_doc)?explode(",",$doc->book_twenty_doc):array();
			$book_bank_doc = ($doc->book_bank_doc)?explode(",",$doc->book_bank_doc):array();
			$book_other_doc = ($doc->book_other_doc)?explode(",",$doc->book_other_doc):array();
			$house_particular_doc = ($doc->house_particular_doc)?explode(",",$doc->house_particular_doc):array();
		}

		$doc_url = base_url("store/api/store_api/fake_doc/".$member_id);
		$doc_btn = "<a href='".$doc_url."' target='_blank' class='btn btn-info w-100 text-center'>ข้อมูลทะเบียนร้านค้า</a>";

		$partner_url = base_url("store/api/store_api/partner_doc/".$member_id);
		$partner_btn = "<a href='".$partner_url."' target='_blank' class='btn btn-info w-100 text-center'>คู่ค้าของร้านค้า</a>";

		$store_label_status = '';
		if($store_status == 1){
			$store_label_status = '<span class="badge badge-warning text-white">'.$status_name.'</span>';
		}else if($store_status == 2){
			$store_label_status = '<span class="badge badge-success text-white">'.$status_name.'</span>';
		}else if($store_status == 3){
			$store_label_status = '<span class="badge badge-danger text-white">'.$status_name.'</span>';
		}else if($store_status == 4){
			$store_label_status = '<span class="badge badge-danger text-white">'.$status_name.'</span>';
		}else if($store_status == 5){
			$store_label_status = '<span class="badge badge-warning text-white">'.$status_name.'</span>';
		}else if($store_status == 6){
			$store_label_status = '<span class="badge badge-warning text-white">'.$status_name.'</span>';
		}else{
			$store_label_status = '<span class="badge badge-warning text-white">'.$status_name.'</span>';
		}


		$bank = $account_name." ".$bank_name." ".$account_number;

		$address = $address." อ.".$amphur_name." จ.".$province_name." รหัสไปรษณีย์ ".$zipcode;

		$store_member = $this->model_store->getMemberByID($member_id);
		foreach($store_member as $row){
			$email = $row->email;
			$mobile = $row->mobile;
		}

		if($store_is_vat == 0 || $store_is_vat == ""){
	  		$chx_vat = "ไม่จดทะเบียนภาษีมูลค่าเพิ่ม";
	  	}else{
	  		$chx_vat = "จดทะเบียนภาษีมูลค่าเพิ่ม";
	  	} 

		$store_edit_result = $this->model_store->getStoryEditByID($store_id);
			foreach($store_edit_result as $row){
				$edit_store_id = $row->store_id;
				$edit_store_name = $row->store_name;
				$edit_member_id = $row->member_id;
				$edit_store_avatar = '../'.$row->store_avatar;
				$edit_store_cover = '../'.$row->store_cover;
				$edit_first_name = $row->first_name;
				$edit_last_name = $row->last_name;
				$edit_tel = $row->tel;
				$edit_address = $row->address;
				$edit_province = $row->province;
				$edit_amphur = $row->amphur;
				$edit_store_description = $row->store_description;
				$edit_store_code = $row->store_code;
				$edit_identity_number = $row->identity_number;
				$edit_zipcode = $row->zipcode;
				$edit_store_rating = $row->store_rating;
				$edit_store_follower = $row->store_follower;
				$edit_store_shipping_charge = $row->store_shipping_charge;
				$edit_store_is_vat = $row->store_is_vat;
				$edit_store_status = $row->store_status;
				$edit_store_url = $row->store_url;
				$edit_account_name = $row->account_name;
				$edit_account_number = $row->account_number;
				$edit_bank_name = $row->bank_name;
				$edit_store_type = $row->store_type;
				$edit_store_category = $row->store_category;
			}
			if(!empty($edit_amphur)){
				$edit_amphur = $edit_amphur;
			}else{
				$edit_amphur = 0;
			}
			if(!empty($edit_province)){
				$edit_province = $edit_province;
			}else{
				$edit_province = 0;
			}

			if(!empty($edit_store_type)){
				$edit_store_type = $edit_store_type;
			}else{
				$edit_store_type = 0;
			}
			if(!empty($edit_store_category)){
				$edit_store_category = $edit_store_category;
			}else{
				$edit_store_category = 0;
			}
			$edit_amphures = $this->model_store->getAmphuresEditByID($edit_amphur);
			$edit_provinces = $this->model_store->getProvincesEditByID($edit_province);

			$edit_store_type_byid = $this->model_store->getStoreTypeEditByID($edit_store_type);
			$edit_store_category_result = $this->model_store->geStoreCategoryEditByID($edit_store_category);

			$edit_province_name = "";
			foreach($edit_provinces as $row){
				$edit_province_name = $row->province_name;
			}
			$edit_amphur_name = "";
			foreach($edit_amphures as $row){
				$edit_amphur_name = $row->amphur_name;
			}

			foreach($edit_store_type_byid as $row){
				$edit_type_name = $row->type_name;
			}
			$edit_category_name = "";
			foreach($edit_store_category_result as $row){
				$edit_category_name = $row->category_name;
				$edit_category_name = "(แก้ไขเป็น : ".$edit_category_name.")";
			}

			if(!empty($edit_zipcode)){
				$edit_zipcode = $edit_zipcode;
			}else{
				$edit_zipcode = "";
			}

			if(isset($edit_store_is_vat)) {
				if($edit_store_is_vat == 0){
			  		$edit_chx_vat = "(แก้ไขเป็น : ไม่จดทำเบียนภาษีมูลค่าเพิ่ม)";
			  	}else{
			  		$edit_chx_vat = "(แก้ไขเป็น : จดทะเบียนภาษีมูลค่าเพิ่ม)";
			  	} 
			}
			

			
			if(!empty($edit_account_name) && !empty($edit_bank_name) && !empty($edit_account_number)){
				$edit_bank = "(แก้ไขเป็น : ".$edit_account_name." ".$edit_bank_name." ".$edit_account_number.")";
			}else{
				$edit_bank = "";
			}

			if(!empty($edit_type_name)){
				$edit_type_name = "(แก้ไขเป็น : ".$edit_type_name.")";
			}else{
				$edit_type_name = "";
			}
			
			if(!empty($edit_address) && !empty($edit_amphur_name) && !empty($edit_province_name)){
				$edit_address = $edit_address." อ.".$edit_amphur_name." จ.".$edit_province_name." รหัสไปรษณีย์ ".$edit_zipcode;
			}else{
				$edit_address = "";
			}

			$edit_company_doc = array();
			$edit_identity_doc = array();
			$edit_identity_multi_doc = array();
			$edit_book_twenty_doc = array();
			$edit_book_bank_doc = array();
			$edit_book_other_doc = array();
			$edit_house_particular_doc = array();
			// $edit_store_doc = $this->model_store->getEditDocumentByID($store_id);

			$edit_document = $this->model_store->getMyDocumentEdit($store_id);
			foreach($edit_document as $edoc){
				$edit_company_doc = ($edoc->company_doc)?explode(",",$edoc->company_doc):array();
				$edit_identity_doc = ($edoc->identity_doc)?explode(",",$edoc->identity_doc):array();
				$edit_identity_multi_doc = ($edoc->identity_multi_doc)?explode(",",$edoc->identity_multi_doc):array();
				$edit_book_twenty_doc = ($edoc->book_twenty_doc)?explode(",",$edoc->book_twenty_doc):array();
				$edit_book_bank_doc = ($edoc->book_bank_doc)?explode(",",$edoc->book_bank_doc):array();
				$edit_book_other_doc = ($edoc->book_other_doc)?explode(",",$edoc->book_other_doc):array();
				$edit_house_particular_doc = ($edoc->house_particular_doc)?explode(",",$edoc->house_particular_doc):array();
			}
			$store_place_result = $this->model_place->getStorePlaceByID($store_id);


	?>
	
 <div class="page-wrapper mt-main-wrapper-70">
		<!-- ============================================================== -->
		<!-- Bread crumb and right sidebar toggle -->
		<!-- ============================================================== -->
		<div class="row page-titles">
			<div class="col-md-5 align-self-center">
				<h3 class="text-themecolor">รายละเอียดร้านค้า <?php if(isset($store_code))echo $store_code; ?> <?php if($store_status ==1 || $store_status == 6){echo $store_label_status;} ?></h3>
			</div>
			<div class="col-md-7 align-self-center">
				<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href='<?php echo base_url("store/firstStore"); ?>'>ร้านค้า</a></li>
				<li class="breadcrumb-item"><a href='<?php echo base_url("store/firstStore"); ?>'> รายการร้านค้า</a>  </li>
				<li class="breadcrumb-item"> รายละเอียดร้านค้า </li>
				</ol>
			</div>
		</div>

	



		<div class="container-fluid">
			<!-- ============================================================== -->
			<!-- Start Page Content -->
			<!-- ============================================================== -->
			<!-- Row -->
			<div class="row pl-3 pr-3">
				<div class="col-lg-12 col-xlg-12 col-md-12">
					<div class="row">
						<div class="col-lg-4 col-xlg-3 col-md-5">
							<div class="card">
								<div class="card-body">
									<center class="mt-3"> 
										<div class="row">
											<div class="col-lg-12 col-md-12 col-sm-12">
												<img src="<?php  if(isset($store_avatar)) echo base_url($store_avatar); ?>"  width="150">
												<h4 class="card-title m-t-10"><?php if(isset($store_name)) echo $store_name; ?></h4>
											</div>
										</div>
									
									</center>
									<div class="row text-center ">
										<!-- <div class="col-lg-4 col-md-4 col-sm-4">
											<small class="text-muted">วันทำการ</small>
											
											<h6><?php //if(isset($work_day)) echo $work_day;  ?></h6>
										</div> -->
										<!-- <div class="col-lg-4 col-md-4 col-sm-4">
											<small class="text-muted">เวลาเปิด </small>
											<h6><?php// if(isset($work_starttime)) echo $work_starttime; ?></h6>
										</div> -->
										<!-- <div class="col-lg-4 col-md-4 col-sm-4">
											<small class="text-muted">เวลาปิด </small>
											<h6><?php //if(isset($work_endtime)) echo $work_endtime; ?></h6>
										</div> -->
										<div class="col-lg-12 col-md-12 col-sm-12">
											<small class="text-muted">เปิดร้านเมื่อ </small>
											<h6><?php if(isset($timestamp)) echo $timestamp; ?></h6>
										</div>
										<div class="col-lg-4 col-md-4 col-sm-4">
											<small class="text-muted">คะแนนร้านค้า </small>
											<h6><?php if(isset($store_rating)) echo $store_rating; ?></h6>
										</div>
										<div class="col-lg-4 col-md-4 col-sm-4">
											<small class="text-muted">ติดตามร้านค้า </small>
											<h6><?php if(isset($store_follower)) echo $store_follower; ?></h6>
										</div>
										<div class="col-lg-4 col-md-4 col-sm-4">
											<small class="text-muted">ประเภทร้านค้า </small>
											<h6><?php if(isset($type_name)) echo $type_name; ?></h6>
										</div>
										
										<!-- <div class="col-lg-12 col-md-12 col-sm-12 pt-1">
											<?php//  echo $doc_btn; ?>
										</div> -->
										<div class="col-lg-12 pt-1">
											<div class="row pb-1">
												<?php echo $btn_confirm; ?>
												<?php echo $btn_notconfirm; ?>
											</div>
										</div>
										<div class="col-lg-12 col-md-12 col-sm-12 pt-1">
											<button type="button" onClick="loadModalPartner('<?php echo $store_id; ?>');" id="edit" class="btn btn-success text-light btn-block"> คู่ค้าของร้านค้า </button>
											<!-- <a href="<?php echo base_url("store/itemStores/".$store_id)?>" class="btn btn-primary text-light btn-block"> รายการทางบัญชี </a> -->
										</div>
									
									</div>
								
								</div>
							</div>
						</div>
						<div class="col-lg-8 col-xlg-9 col-md-7">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col-lg-12">
											<!-- ปก -->
											<img src="<?php if(isset($store_cover)) echo base_url($store_cover); ?>"  width="100%">
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-12 col-xlg-12 col-md-12">
							<!-- <div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col-lg-12">
											<h4>รายละเอียดร้านค้า</h4>
											<small class="text-muted">รายละเอียดร้านค้า</small>
											<h6><?php// if(isset($store_description)) echo $store_description ?></h6>
										</div>
									</div>
								</div>
							</div> -->

							<div class="card">
								<div class="card-body"> 
									
									<div class="row">
										<div class="col-lg-12">
											<h4>ข้อมูลทะเบียนร้านค้า</h4>
										</div>
										<div class="col-lg-4">
											<small class="text-muted">สถานะ </small>
											<h6><?php if(isset($store_label_status)) echo $store_label_status ?></h6> 
											<h6 class="text-white">.</h6> 
										</div>
										<div class="col-lg-4">
											<small class="text-muted">ชื่อผู้จดทะเบียน </small>
											<h6><?php 
											if($store_type == 1){
												if(isset($first_name) and isset($last_name)) echo $first_name." ".$last_name; 
											}else{
												if(isset($first_name)) echo $first_name; 
											}
											
											?></h6>
											<h6 class="text-danger"><?php if(isset($edit_first_name) and isset($edit_last_name))  echo "(แก้ไขเป็น : ".$edit_first_name." ".$edit_last_name.")"; ?></h6>
										</div>
										<div class="col-lg-4">
											<small class="text-muted">สถานภาพผู้ประกอบการจดทะเบียนภาษีมูลค่าเพิ่ม </small>
											<h6><?php echo $chx_vat;?></h6> 
											<h6 class="text-danger"><?php if(isset($edit_chx_vat)) echo $edit_chx_vat;?></h6>
										</div>
										<div class="col-lg-4">
											<small class="text-muted ">ชื่อร้าน</small>
											<h6><?php if(isset($store_name)) echo $store_name; ?></h6> 
											<h6 class="text-white">.</h6> 
										</div>
										<div class="col-lg-4">
											<small class="text-muted">เลขประจำตัวประชาชน </small>
											<h6><?php if(isset($identity_number)) echo $identity_number; ?></h6>
											<h6 class="text-danger"><?php if(isset($edit_identity_number))  echo "(แก้ไขเป็น : ".$edit_identity_number.")"; ?></h6>
										</div>
										<div class="col-lg-4">
											<small class="text-muted">เบอร์โทร</small>
											<h6><?php if(isset($tel)) echo $tel; ?></h6> 
											<h6 class="text-danger"><?php if(isset($edit_tel))  echo "(แก้ไขเป็น : ".$edit_tel.")"; ?></h6>
										</div>
										<div class="col-lg-4">
											<small class="text-muted">อีเมล์</small>
											<h6><?php if(isset($email)) echo $email; ?></h6> 
											<h6 class="text-white">.</h6> 
										</div>
										<div class="col-lg-4">
											<small class="text-muted ">หมวดหมู่ร้านค้า  </small>
											<h6><?php if(isset($category_name))  echo $category_name; ?></h6> 
											<h6 class="text-danger"><?php if(isset($edit_category_name))  echo $edit_category_name; ?></h6>
										</div>
										<div class="col-lg-4">
											<small class="text-muted">บัญชีธนาคาร </small>
											<h6><?php if(isset($bank)) echo $bank; ?></h6> 
											<h6 class="text-danger"><?php if(isset($edit_bank)) echo $edit_bank; ?></h6>
										</div>
										<div class="col-lg-4">
											<small class="text-muted">ชื่อ URL </small>
											<h6><a href="<?php echo $store; ?>"><?php if(isset($store))  echo $store; ?></a></h6>
										</div>
										<div class="col-lg-4">
											<small class="text-muted">ประเภทร้านค้า  </small>
											<h6><?php if(isset($type_name))  echo $type_name; ?> </h6> 
											<h6 class="text-danger"><?php echo $edit_type_name; ?></h6> 
										</div>
										<div class="col-lg-4">
											<small class="text-muted">ที่ตั้ง </small>
											<h6><?php if(isset($address)) echo $address; ?></h6> 
											<h6 class="text-danger"><?php echo $edit_address; ?></h6>
										</div>
										
										
									</div>
									
									
								</div>
							</div>
							

							<!-- <div class="card">
								<div class="card-body"> 
									
									<div class="row">
										<div class="col-lg-12">
											<h4>ข้อมูลเจ้าของร้าน</h4>
										</div>
										<div class="col-lg-4">
											<small class="text-muted">ชื่อเจ้าของร้าน</small>
											<h6><?php //if(isset($title) && isset($first_name)&& isset($last_name)) echo $title.' '.$first_name.' '. $last_name ?></h6> 
											<small class="text-muted">ที่อยู่ </small>
											<h6><?php// if(isset($address))  echo $address; ?></h6> 
										</div>
										<div class="col-lg-4">
											<small class="text-muted">อีเมล์</small>
											<h6><?php //if(isset($email)) echo $email; ?></h6> 
											<small class="text-muted">เลขประจำตัวประชาชน</small>
											<h6><?php //if(isset($identity_number)) echo $identity_number; ?></h6> 
											
											
										</div>
										<div class="col-lg-4">
											<small class="text-muted">เบอร์โทร</small>
											<h6><?php // if(isset($mobile)) echo $mobile; ?></h6> 
										</div>
									</div>
									
									
								</div>
							</div> -->


							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col-lg-12">
											<h4>การจัดส่ง</h4>
										</div>
										<div class="col-lg-4">
											<small class="text-muted">การจัดส่ง </small>
											<?php 
												foreach($shipping_type as $row){
													$shipping_type_name = $row->type_name;
											?>
											<h6><?php echo $shipping_type_name; ?></h6>
											<?php } ?>
										</div>
										<div class="col-lg-4">
											<small class="text-muted">ค่าจัดส่ง</small>
											<h6><?php  if(isset($store_shipping_charge)) echo $store_shipping_charge; ?></h6> 
										</div>
									</div>
								
								</div>
							</div>

							<div class="card">
								<div class="card-body"> 
									<div class="row">
										<div class="col-lg-12">
			                                <h4>เอเย่นต์ที่ใช้บริการส่งสินค้า</h4>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12 pt-2">
											<table class="table">
												<thead>
													<tr width="100%">
														<th class="font-weight-bold" width="20%">รหัสร้านค้า</th>
														<th class="font-weight-bold" width="30%">ร้านค้า</th>
														<th class="font-weight-bold" width="20%">รหัสสถานที่</th>
														<th class="font-weight-bold" width="30%">สถานที่</th>
													</tr>
												</thead>
												<tbody>
													<?php
														$agent_place_id			= 0;
														$agent_store_id 		= 0;
														$agent_place_code 		= "";
														$agent_place_name 		= "";
														$agent_store_name 		= "";
														$agent_store_code 		= 0;
														$request_store_id 		= 0;
														foreach($store_place_result as $p){
															$agent_request_place_id	= $p->request_place_id;
															$agent_place_id			= $p->place_id;
															$agent_store_id 		= $p->store_id;
															$agent_place_code 		= $p->place_code;
															$agent_place_name 		= $p->place_name;

															if(strlen($agent_place_name) > 60){
																$agent_place_name = iconv_substr($agent_place_name,0,30,"UTF-8")."...";
															}else{
																$agent_place_name =  iconv_substr($agent_place_name,0,30,"UTF-8");
															}

															$request_place_result = $this->model_place->getRequestPlaceByID($agent_request_place_id);
															if(count($request_place_result)>0){
																$request_store_id = $request_place_result[0]->store_id;
																$req_place_id = $request_place_result[0]->place_id;
															}

															$agent_place_result = $this->model_place->getStoreByID($request_store_id);
															if(count($agent_place_result)>0){
																$agent_store_name = $agent_place_result[0]->store_name;
																$agent_store_code = $agent_place_result[0]->store_code;
															}
															if(strlen($agent_store_name) > 60){
																$agent_store_name = iconv_substr($agent_store_name,0,30,"UTF-8")."...";
															}else{
																$agent_store_name =  iconv_substr($agent_store_name,0,30,"UTF-8");
															}

															$url_store_id = base_url("store/storeDescription/".$request_store_id);
															$link_store_code = '<a class="text-secondary" href="'.$url_store_id.'">'.$agent_store_code.'</a>';
															$link_store_name = '<a class="text-secondary" href="'.$url_store_id.'">'.$agent_store_name.'</a>';

															$url_place_id = base_url("place/placeDescription/".$req_place_id);
															$link_place_code = '<a class="text-secondary" href="'.$url_place_id.'">'.$agent_place_code.'</a>';
															$link_place_name = '<a class="text-secondary" href="'.$url_place_id.'">'.$agent_place_name.'</a>';
													?>
												
													<tr>
														<td><?php echo $link_store_code; ?></td>
														<td><?php echo $link_store_name; ?></td>
														<td><?php echo $link_place_code; ?></td>
														<td><?php echo $link_place_name; ?></td>
													</tr>
													<?php } ?>
													
												</tbody>
											</table>  
										</div>
										
									</div>
								</div>
							</div>

							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col-lg-12">
											<h4>เอกสาร</h4>
										</div>
										<?php if(isset($company_doc) && count($company_doc)>0){ ?>
	                                    <div class="col-lg-12 pt-5 legal_entity" id="">
											<strong>หนังสือจดทะเบียนนิติบุคคล</strong>
											<div class="row">
												<?php 
													$company_doc_url ="";
													for($i = 0;$i<count($company_doc);$i++){ 
														$company_doc_url = $company_doc[$i];
													?>
													<div class="col-md-6 col-lg-6 pt-4">
														<img src="<?php echo base_url("../".$company_doc_url); ?>" width="100%">
													</div>
				                                <?php } ?>
											</div>
										</div>
										<?php } ?>


										<?php if(isset($identity_doc) && count($identity_doc)>0){ ?>
										<div class="col-lg-12 pt-5 natural_person">
											<strong>สำเนาบัตรประชาชนในนามบุคคล</strong>
											<div class="row">
												<?php
													$identity_doc_url ="";
													for($i = 0;$i<count($identity_doc);$i++){ 
														$identity_doc_url = $identity_doc[$i];
													?>
													<div class="col-md-6 col-lg-6 pt-4">
														<img src="<?php echo base_url("../".$identity_doc_url); ?>" width="100%">
													</div>
				                                <?php } ?>
											</div>
										</div>
										<?php } ?>

										<?php if(isset($house_particular_doc) && count($house_particular_doc)>0){ ?>
										<div class="col-lg-12 pt-5 natural_person">
											<strong>สำเนาทะเบียนบ้าน</strong>
											<div class="row">
												<?php
													$house_particular_doc_url ="";
													for($i = 0;$i<count($house_particular_doc);$i++){ 
														$house_particular_doc_url = $house_particular_doc[$i];
													?>
													<div class="col-md-6 col-lg-6 pt-4">
														<img src="<?php echo base_url("../".$house_particular_doc_url); ?>" width="100%">
													</div>
				                                <?php } ?>
											</div>
										</div>
										<?php } ?>

										<?php if(isset($identity_multi_doc) && count($identity_multi_doc)>0){ ?>
										<div class="col-lg-12 pt-5 legal_entity" id="">
											<strong>สำเนาบัตรประชาชนของคณะกรรมการผู้มีอำนาจลงนามทั้งหมดที่มีรายชื่อในหนังสือจดทะเบียนนิติบุคคล</strong>
											<div class="row">
												<?php 
													$identity_multi_doc_url ="";
													for($i = 0;$i<count($identity_multi_doc);$i++){ 
														$identity_multi_doc_url = $identity_multi_doc[$i];
													?>
													<div class="col-md-6 col-lg-6 pt-4">
														<img src="<?php echo base_url("../".$identity_multi_doc_url); ?>" width="100%">
													</div>
				                                <?php } ?>
											</div>
										</div>
										<?php } ?>

										<?php if(isset($book_twenty_doc) && count($book_twenty_doc)>0){ ?>
										<div class="col-lg-12 pt-5" id="">
											<strong>หนังสือจดทะเบียน ภพ.20</strong>
											<div class="row">
												<?php
													$book_twenty_doc_url ="";
													for($i = 0;$i<count($book_twenty_doc);$i++){ 
														$book_twenty_doc_url = $book_twenty_doc[$i];
													?>
													<div class="col-md-6 col-lg-6 pt-4">
														<img src="<?php echo base_url("../".$book_twenty_doc_url); ?>" width="100%">
													</div>
				                                <?php } ?>
											</div>
										</div>
										<?php } ?>

										<?php if(isset($book_bank_doc) && count($book_bank_doc)>0){ ?>
										<div class="col-lg-12 pt-5">
											<strong>สำเนาหน้าสมุดบัญชีธนาคารที่มีชื่อตรงกับผู้ลงทะเบียน</strong>
											<div class="row">
												<?php
													$book_bank_doc_url ="";
													for($i = 0;$i<count($book_bank_doc);$i++){ 
														$book_bank_doc_url = $book_bank_doc[$i];
													?>
													<div class="col-md-6 col-lg-6 pt-4">
														<img src="<?php echo base_url("../".$book_bank_doc_url); ?>" width="100%">
													</div>
				                                <?php } ?>
											</div>
										</div>
										<?php } ?>

										<?php if(isset($book_other_doc) && count($book_other_doc)>0){ ?>
										<div class="col-lg-12 pt-5">
											<strong>อื่นๆ</strong>
											<div class="row">
												<?php
													$book_other_doc_url ="";
													for($i = 0;$i<count($book_other_doc);$i++){ 
														$book_other_doc_url = $book_other_doc[$i];
													?>
													<div class="col-md-6 col-lg-6 pt-4">
														<img src="<?php echo base_url("../".$book_other_doc_url); ?>" width="100%">
													</div>
				                                <?php } ?>
											</div>
										</div>
										<?php } ?>

									</div>
								</div>
							</div>
							<?php  if(count($edit_document)>0){ ?>
								<div class="card">
									<div class="card-body">
										<div class="row">
											<div class="col-lg-12">
												<h4>เอกสารขอแก้ไข</h4>
											</div>

											<?php if(isset($edit_company_doc) && count($edit_company_doc)>0){ ?>
											<div class="col-lg-12 pt-5 legal_entity" id="">
												<strong class="text-danger">หนังสือจดทะเบียนนิติบุคคล(แก้ไขเป็น)</strong>
												<div class="row">
													<?php
														for($i = 0;$i<count($edit_company_doc);$i++){ 
															$edit_url = $edit_company_doc[$i];
														?>
														<div class="col-md-6 col-lg-6 pt-4">
															<img src="<?php echo base_url("../".$edit_url); ?>" width="100%">
														</div>
					                                <?php } ?>
												</div>
											</div>
											<?php } ?>

											<?php if(isset($edit_identity_doc) && count($edit_identity_doc)>0){ ?>
											<div class="col-lg-12 pt-5">
												<strong class="text-danger">สำเนาบัตรประชาชนในนามบุคคล(แก้ไขเป็น)</strong>
												<div class="row">
													<?php
														for($i = 0;$i<count($edit_identity_doc);$i++){ 
															$edit_url = $edit_identity_doc[$i];
														?>
														<div class="col-md-6 col-lg-6 pt-4">
															<img src="<?php echo base_url("../".$edit_url); ?>" width="100%">
														</div>
					                                <?php } ?>
												</div>
											</div>
											<?php } ?>

											<?php if(isset($edit_house_particular_doc) && count($edit_house_particular_doc)>0){ ?>
											<div class="col-lg-12 pt-5">
												<strong class="text-danger">สำเนาทะเบียนบ้าน(แก้ไขเป็น)</strong>
												<div class="row">
													<?php
														$edit_house_particular_doc_url ="";
														for($i = 0;$i<count($edit_house_particular_doc);$i++){ 
															$edit_house_particular_doc_url = $edit_house_particular_doc[$i];
														?>
														<div class="col-md-6 col-lg-6 pt-4">
															<img src="<?php echo base_url("../".$edit_house_particular_doc_url); ?>" width="100%">
														</div>
					                                <?php } ?>
												</div>
											</div>
											<?php } ?>

											<?php if(isset($edit_identity_multi_doc) && count($edit_identity_multi_doc)>0){ ?>
											<div class="col-lg-12 pt-5 legal_entity" id="">
												<strong class="text-danger">สำเนาบัตรประชาชนของคณะกรรมการผู้มีอำนาจลงนามทั้งหมดที่มีรายชื่อในหนังสือจดทะเบียนนิติบุคคล(แก้ไขเป็น)</strong>
												<div class="row">
													<?php
														for($i = 0;$i<count($edit_identity_multi_doc);$i++){ 
															$edit_url = $edit_identity_multi_doc[$i];
														?>
														<div class="col-md-6 col-lg-6 pt-4">
															<img src="<?php echo base_url("../".$edit_url); ?>" width="100%">
														</div>
					                                <?php } ?>
												</div>
											</div>
											<?php } ?>

											<?php if(isset($edit_book_twenty_doc) && count($edit_book_twenty_doc)>0){ ?>
											<div class="col-lg-12 pt-5 pp20" id="">
												<strong class="text-danger">หนังสือจดทะเบียน ภพ.20(แก้ไขเป็น)</strong>
												<div class="row">
													<?php
														for($i = 0;$i<count($edit_book_twenty_doc);$i++){ 
															$edit_url = $edit_book_twenty_doc[$i];
														?>
														<div class="col-md-6 col-lg-6 pt-4">
															<img src="<?php echo base_url("../".$edit_url); ?>" width="100%">
														</div>
					                                <?php } ?>
												</div>
											</div>
											<?php } ?>

											<?php if(isset($edit_book_bank_doc) && count($edit_book_bank_doc)>0){ ?>
											<div class="col-lg-12 pt-5">
												<strong class="text-danger">สำเนาหน้าสมุดบัญชีธนาคารที่มีชื่อตรงกับผู้ลงทะเบียน(แก้ไขเป็น)</strong>
												<div class="row">
													<?php
														for($i = 0;$i<count($edit_book_bank_doc);$i++){ 
															$edit_url = $edit_book_bank_doc[$i];
														?>
														<div class="col-md-6 col-lg-6 pt-4">
															<img src="<?php echo base_url("../".$edit_url); ?>" width="100%">
														</div>
					                                <?php } ?>
												</div>
											</div>
											<?php } ?>

											<?php if(isset($edit_book_other_doc) && count($edit_book_other_doc)>0){ ?>
											<div class="col-lg-12 pt-5">
												<strong class="text-danger">อื่นๆ(แก้ไขเป็น)</strong>
												<div class="row">
													<?php
														for($i = 0;$i<count($edit_book_other_doc);$i++){ 
															$edit_url = $edit_book_other_doc[$i];
														?>
														<div class="col-md-6 col-lg-6 pt-4">
															<img src="<?php echo base_url("../".$edit_url); ?>" width="100%">
														</div>
					                                <?php } ?>
												</div>
											</div>
											<?php } ?>
										</div>
									</div>
								</div>
							<?php } ?>
							
					</div>
                    <!-- Column -->
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
<div id="settings_partner"></div>

<?php $this->load->view("templates/footer"); ?>
<script src="<?php echo base_url("assets/system/plugins/datatables/jquery.dataTables.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/system/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/custom/js/locales/bootstrap-datepicker.th.js"); ?>"></script>
<script src="<?php echo base_url('assets/system/plugins/clockpicker/dist/jquery-clockpicker.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/system/plugins/clockpicker/dist/bootstrap-clockpicker-custom.js'); ?>"></script>
<script>

function hideStoreType(){
	var store_type = "<?php echo $store_type; ?>";
	console.log("store_type || "+store_type);
	if(store_type == 1){
		$(".identity_multi_required").hide();//
		$(".book_twenty_required").hide();//
		$(".company_required").hide();//
	}else{
		$(".identity_multi_required").show();//
		$(".book_twenty_required").show();//
		$(".company_required").show();//
	}
}
hideStoreType();




</script>
<?php $this->load->assets_by_name('store'); ?>   

