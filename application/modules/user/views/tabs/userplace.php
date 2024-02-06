
<!-- Start สถานที่ -->
<div class="theme_box">
	<div class="row" style="float:right;">
        <div class="col-md-12">
          <button data-toggle="modal" data-target ="#modal_shop_add_address" class="btn-block button_blue middle_btn text-center"><i class="icon-plus"></i>เพิ่มสถานที่</button>
        </div>
	</div>
    
    <?php
	
	foreach($store_place as $row){
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
            <h5><?php echo $place_name; ?></h5>
        </div>
        <div class="col-md-2 form_group">
            <label>รหัสสถานที่ :</label>
        </div>
        <div class="col-md-10 form_group">
           <b> <?php echo $place_code; ?></b>
        </div>
        <div class="col-md-2 form_group">
            <label>ที่อยู่ :</label>
        </div>
        <div class="col-md-10 form_group">
        
            <?php echo $place_address; ?> 
            <?php echo $this->storemanager->getDistrictName($place_district); ?>
            <?php echo $this->storemanager->getAmphurName($place_amphur); ?>
            <?php echo $this->storemanager->getProvinceName($place_province); ?>
            <?php echo $place_postcode; ?>
       </div>
       
        <div class="col-md-2 form_group">
            <label>โทรศัพท์ :</label>
        </div>
        <div class="col-md-10 form_group">
            <?php echo $place_mobile; ?>
        </div>
        <div class="col-md-2 form_group">
            <label>อธิบายเส้นทาง :</label>
        </div>
        <div class="col-md-10 form_group">
            <?php echo $place_condition; ?>
        </div>
        <div class="col-md-2 form_group">
            <label>วันที่ทำการ :</label>
        </div>
        <div class="col-md-10 form_group">
            <table class="table-responsive table table-bordered">
              <thead>
                <tr>
                  <th scope="col">วัน</th>
                  <th scope="col">เวลาเปิด</th>
                  <th scope="col">เวลาปิด</th>
                  <th scope="col">เปิด 24 ชั่วโมง</th>
                </tr>
              </thead>
              <tbody>
              	<?php
					foreach($working as $w){
						$work_id = $w->work_id;
						//$place_id = $w->place_id;
						$work_day = $w->work_day;
						$work_starttime = $w->work_starttime;
						$work_endtime = $w->work_endtime;
						$open_all_day = $w->open_all_day;
						if($open_all_day){
							$open_all_day = "เปิด 24 ชั่วโมง";
						}else{
							$open_all_day = "เปิดตามเวลา";
						}
				?>
                <tr>
                  <td><?php echo $work_day; ?></td>
                  <td><?php echo $work_starttime; ?></td>
                  <td><?php echo $work_endtime; ?></td>
                  <td><?php echo $open_all_day; ?></td>
                </tr>
                <?php } ?>
                
              </tbody>
            </table>
        </div>
        
    </div>
    <div class="row">
        <div class="col-md-4 ">
            <a target="_blank" href="https://www.google.com/maps/search/?api=1&query=<?php echo $place_lat; ?>,<?php echo $place_long; ?>" class="btn-block button_blue">ดูแผนที่</a>
        </div>
        <div class="col-md-4 ">
            <a href="<?php echo site_url("store/shipping/editplace/".$place_id); ?>" class="btn-block button_blue">แก้ไขข้อมูล</a>
        </div>
        <div class="col-md-4 ">
            <button type="button" onclick="onCancelPlace(<?php echo $place_id; ?>);" class="btn-block button_dark_grey">ยกเลิกสถานที่</button>
        </div>
    </div>
    <br />
    <hr />
    <br />
    <?php } ?>
    
</div>
<!-- End สถานที่ -->
