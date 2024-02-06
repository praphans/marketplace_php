<?php $this->load->view("templates/header"); ?>



<div class="secondary_page_wrapper">

				<div class="container">

					<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

					<ul class="breadcrumbs">
                        <li><a href="<?php echo base_url(); ?>" class="notcursor">หน้าหลัก</a></li>
                        <li><a href="<?php echo base_url("user"); ?>" class="notcursor">บัญชีผู้ซื้อ</a></li>
                        <li><a href="<?php echo base_url("user/shipping"); ?>" class="notcursor">ตั้งค่าที่อยู่</a></li>
                        <li>แก้ไขสถานที่</li>
					</ul>

					<!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->

					<div class="row">

						<aside class="col-md-3 col-sm-4">

                            <!-- - - - - - - - - - - - - - Information - - - - - - - - - - - - - - - - -->
            
                            <?php $this->load->view("user/templates/left_tab"); ?>
            
                            <!-- - - - - - - - - - - - - - End of information - - - - - - - - - - - - - - - - -->
            
                        </aside><!--/ [col]-->

						<?php
						foreach($user_place as $row){
                            $place_id = $row->place_id;
                            $place_code = $row->place_code;
                            $store_id = $row->store_id;
							$name = $row->name;
							$identity_number = $row->identity_number;
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
						}
                        ?>

						<main class="col-md-9 col-sm-8 padding-l-0">

							<form class="type_2" action="<?php echo site_url("user/updatePlace"); ?>" method="post" id="edit_place">
                            
                                <input type="hidden" name="place_id" value="<?php echo $place_id; ?>"/>
                                <input type="hidden" name="open_all_day"/>
                                <div class="theme_box">
                                  
                                      
                                    <h4>แก้ไขสถานที่ในบัญชีผู้ซื้อ</h4>
                                     
                                      <div class="pt-10">
                                
                                        		
                                                
                                                <div class="row">
                                                
                                                  <div class="col-md-6 p-t-10">
                                                        <label>ตั้งชื่อสถานที่ <span class="red">*</span> </label>
                                                        <input type="text" name="place_name" value="<?php echo $place_name; ?>"  class="form-control" placeholder="กรุณาระบุชื่อสถานที่ เช่น ร้านสาขาที่ 1 " required>
                                                        <input type="hidden" name="shipping_type_id" value="<?php echo $shipping_type_id; ?>">
                                                        <input type="hidden" name="place_lat" value="<?php echo $place_lat; ?>" id="place_latitude">
                                                        <input type="hidden" name="place_long" value="<?php echo $place_long; ?>" id="place_longitude">
                                                       <input type="hidden" name="place_district" id="place_district" value="-">
                                                    </div>
                                                    
                                                   
                                                </div>
                
                                                <div class="row pt-10">
                                                    
                                                    <div class="col-md-6 p-t-10">
                                                        <label class="required">ชื่อที่ใช้ในการออกใบเสร็จ :</label>
                                                        <input type="text" name="name" class="form-control" placeholder="กรุณาระบุชื่อ" value="<?php echo $name; ?>" required>
                                                    </div>
                                                    <div class="col-md-6 p-t-10">
                                                        <label>เลขบัตรประชาชน / นิติบุคคล :</label>
                                                        <input type="text" name="identity_number" class="form-control" placeholder="หมายเลขบัตรประชาชน / นิติบุคคล" value="<?php echo $identity_number; ?>">
                                                    </div>
                                                </div>
                                                
                                                <div class="row pt-10">
                                                	<div class="col-md-6 p-t-10">
                                                        <label class="required">จังหวัด :</label>
                                                        <div class="custom_select">
                                                            <select name="place_province" id="place_province" class="form-control" required>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 p-t-10">
                                                        <label class="required">อำเภอ / เขต :</label>
                                                        <div class="custom_select">
                                                            <select name="place_amphur" id="place_amphur" class="form-control" required>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!--<div class="col-md-6 p-t-10">
                                                        <label class="required">ตำบล / แขวง :</label>
                                                        <div class="custom_select">
                                                            <select name="place_district" id="place_district" class="form-control" required>
                                                            </select>
                                                        </div>
                                                    </div>-->
                                                </div>
                                                <br />
                                                <div class="row pt-10">	
                                                    <div class="col-xs-12 p-t-20">
                                                        <label for="address" class="required">ที่อยู่ :</label>
                                                        <textarea type="text" class="form-control" name="place_address" id="place_address" required><?php echo $place_address; ?></textarea>
                                                        <small>ระบุอาคาร เลขที่บ้าน หมู่บ้าน ถนน ตำบล/แขวง รายละเอียดสถานที่</small>
                                                    </div>
                                                </div>
                                    
                                                <div class="row pt-10">
                                                    <div class="col-md-6 p-t-10 col-sm-6">
                                                        <label for="postcode" class="required">รหัสไปรษณีย์ :</label>
                                                        <input type="text" class="form-control" value="<?php echo $place_postcode; ?>" name="place_postcode" id="place_postcode" required>
                                                    </div><!--/ [col] -->
                                                    <div class="col-md-6 p-t-10">
                                                        <label for="telephone">เบอร์โทรศัพท์ :</label>
                                                        <input type="text" class="form-control" value="<?php echo $place_mobile; ?>" name="place_mobile" id="" required>
                                                    </div>
                                                </div>
                                                
                                                <input type="hidden" name="working_time[]" id="working_time">
                                                <input type="hidden" name="open_time[]" id="open_time">
                                                <input type="hidden" name="close_time[]" id="open_time">
                                                
                                                <!--<div class="row">
                                                    <div class="col-md-12 p-t-10">
                                                        <label>วัน เวลา ทำการ :</label>
                                                    </div>
                                                </div>
                                                 
                                                <div id="working_time_container">
                                                	<?php
														foreach($working as $w){
															$work_id = $w->work_id;
															//$place_id = $w->place_id;
															$work_day = $w->work_day;
															$work_starttime = $w->work_starttime;
															$work_endtime = $w->work_endtime;
															$open_all_day = $w->open_all_day;
															if($open_all_day){
																$open_all_day = "checked";
															}else{
																$open_all_day = "";
															}
													?>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <div class="custom_select">
                                                                <select name="working_time[]" id="working_time" class="form-control" required>
                                                                	<option value="<?php echo $work_day; ?>"><?php echo $work_day; ?></option>
                                                                    <option value="อาทิตย์">อาทิตย์</option>
                                                                    <option value="จันทร์">จันทร์</option>
                                                                    <option value="อังคาร">อังคาร</option>
                                                                    <option value="พุธ">พุธ</option>
                                                                    <option value="พฤหัสบดี">พฤหัสบดี</option>
                                                                    <option value="ศุกร์">ศุกร์</option>
                                                                    <option value="เสาร์">เสาร์</option>
                                                                    <option value="จันทร์">จันทร์</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-5 time_input">
                                                            <div class="row">
                                                                <div class="col-xs-5">
                                                                    <input type="text" name="open_time[]" id="open_time" class="form-control" placeholder="เวลาเปิด" value="<?php echo $work_starttime; ?>" required>
                                                                </div>
                                                                <div class="col-xs-2">
                                                                    <h1>-</h1>
                                                                </div>
                                                                <div class="col-xs-5">
                                                                    <input type="text" name="close_time[]" id="close_time" class="form-control" placeholder="เวลาปิด" value="<?php echo $work_endtime; ?>" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3 check_24">
                                                            <input class="open_all_day" type="checkbox" id="open_all_day<?php echo $work_id; ?>" value="0" <?php echo $open_all_day; ?>>
                                                            <label for="open_all_day<?php echo $work_id; ?>">เปิด 24 ชั่วโมง</label>
                                                        </div>
                                                    </div>
                                                    <?php } ?>
                                                    
                                                    
                                                </div>
                                                
                                    
                                                <div class="v_centered col-sm-4 pt-10">
                                                    <button type="button" class="button_grey middle_btn p-t-10" onclick="addWorkingTime();">เพิ่มวันทำการ</button>
                                                </div>-->
                                                <br />
                                                <div class="row pt-10">	
                                                    <div class="col-xs-12 p-t-10">
                                                        <label>อธิบายเส้นทางและพิกัดที่อยู่ :</label>
                                                        <textarea type="text" name="place_condition" id="place_condition" class="form-control" ><?php echo $place_condition; ?></textarea>
                                                    </div>
                                                </div>
                                                <br />
                                                <div class="row pt-10">	
                                                    <div class="col-xs-12 p-t-10">
                                                        <label>ระบุพิกัดในแผนที่ :</label>
                                                        <div class="clear"></div>
                                                        <div id="googleMap" style="width:100%;height:400px;"></div>
                                                    </div>
                                                </div>
                                    			<div class="row  pt-10">	
                                                    <div class="col-xs-12 p-t-10">
                                                        <button type="submit" class="btn button_blue"><i class="icon-ok-circle"></i> แก้ไขข้อมูลสถานที่</button>
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
<?php $this->load->assets_by_name("Shipping","js"); ?>
<?php $this->load->assets_by_name('Left_tab'); ?>

<script type="text/javascript" src="<?php echo base_url("assets/js/AutoProvince.js"); ?>"></script> 

<script src="https://maps.googleapis.com/maps/api/js?sensor=false&v=3.5&key=AIzaSyBQQ7B-myYelxU8X5SjSCITydZidvcKrc8&language=th&region=TH&callback=myMap" async defer></script>

<script type="text/javascript">
var lat = parseFloat("<?php if(isset($place_lat)){ echo $place_lat; }else{ echo '13.756331'; } ?>");
var long = parseFloat("<?php if(isset($place_long)){ echo $place_long; }else{ echo '100.501762'; } ?>");

var place_province = "<?php if(isset($place_province)){ echo $place_province; } ?>";
var place_amphur = "<?php if(isset($place_amphur)){ echo $place_amphur; } ?>";
var place_district = "<?php if(isset($place_district)){ echo $place_district; } ?>";

var myLatLng = {lat: lat, lng: long};

function myMap() {
	var mapProp= {
		center:new google.maps.LatLng(lat,long),
		zoom:15,
	};
	var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
	
	google.maps.event.addListener(map, 'click', function(event) {
		$("#place_latitude").val(event.latLng.lat());
		$("#place_longitude").val(event.latLng.lng());
	});
	var marker = new google.maps.Marker({
	  position: myLatLng,
	  map: map,
	  title: '<?php echo $place_name; ?>'
	});

} 

$('body').AutoProvince({
	PROVINCE:		'#place_province', 
	AMPHUR:			'#place_amphur', 
	DISTRICT:		'#place_district',
	POSTCODE:		'#place_postcode',
	GEOGRAPHY:		'#geography',
	CURRENT_PROVINCE:place_province,
	CURRENT_AMPHUR:place_amphur,
	CURRENT_DISTRICT:place_district,
	arrangeByName:	false
});
 $("#edit_place").validate({
	 rules: {
		name: {
			required: true,
			minlength: 5
		},
		place_postcode: {
			required: true,
			number:true
		},
		
		
	 }
 });
</script>
