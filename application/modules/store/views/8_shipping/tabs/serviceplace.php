
<!-- Start สถานที่ -->
<div class="theme_box">
	<div class="row" style="float:right;">
        <div class="col-md-12">
          <button data-toggle="modal" data-target ="#modal_shop_add_service_address" class="btn-block button_blue middle_btn text-center"><i class="icon-plus"></i>เพิ่มเขตพื้นที่บริการ</button>
        </div>
	</div>
    
    <?php
	$n = 0;
	
	foreach($service_place as $row){
		$n++;
		$place_id = $row->place_id;
		$place_code = $row->place_code;
		$store_id = $row->store_id;
		$shipping_type_id = $row->shipping_type_id;
		$place_name = $row->place_name;
		$place_province = $row->place_province;
		$place_amphur = $row->place_amphur;
		$place_district = $row->place_district;
		$place_address = $row->place_address;
		$place_postcode = $row->place_postcode;
		$place_mobile = $row->place_mobile;
		$working_time_id = $row->working_time_id;
		$place_lat = $row->place_lat;
		$place_long = $row->place_long;
		$place_condition = $row->place_condition;
		
		$working = $this->storemanager->working_time($place_id);
	?>
    <div class="row">
    	<div class="col-xs-12">
            <h5><?php echo $place_name." ที่ ".$n; ?> </h5>
        </div>
        <div class="col-md-2 form_group">
            <label>จังหวัด :</label>
        </div>
        <div class="col-md-10 form_group">
            <?php echo $this->storemanager->getProvinceName($place_province); ?>
        </div>
        <div class="col-md-2 form_group">
            <label>อำเภอ :</label>
        </div>
        <div class="col-md-10 form_group">
            <?php echo $this->storemanager->getAmphurName($place_amphur); ?>
        </div>
        <div class="col-md-2 form_group">
            <label>คำอธิบาย :</label>
        </div>
        <div class="col-md-10 form_group">
            <?php echo $place_condition; ?>
        </div>
    
    <div class="col-md-12 pt-10">
            <button type="button" onclick="onCancelPlace(<?php echo $place_id; ?>);" class="button_dark_grey">ยกเลิกสถานที่</button>
        </div>
    </div>
    <br />
    <hr />
    <br />
    <?php } ?>
    
</div>
<!-- End สถานที่ -->

