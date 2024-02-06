<form class="type_2" action="<?php echo site_url("store/shipping/savePlace"); ?>" method="post" onsubmit="enabledInput()" id="place_frm">
<div id="modal_shop_add_address" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">เพิ่มสถานที่ส่งสินค้า</h4>
      </div>
      <div class="modal-body col-md-12">

        
                <div class="row">
                    <div class="col-md-12 p-t-10">
                        <label>ตั้งชื่อสถานที่ <span class="red">*</span> </label>
                        <input type="text" name="place_name" class="form-control" placeholder="กรุณาระบุชื่อสถานที่ เช่น ร้านสาขาที่ 1 " required>
                        <input type="hidden" name="shipping_type_id" value="1">
                        <input type="hidden" name="place_lat" id="place_latitude" value="13.756331">
                        <input type="hidden" name="place_long" id="place_longitude" value="100.501762">
                        <input type="hidden" name="place_status" id="place_status" value="2">
                        <input type="hidden" name="place_district" id="place_district" value="-">
                    </div>
    			</div>
                
                <div class="row">
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
                    
                    <!--<div class="col-md-4 p-t-10">
                        <label class="required">ตำบล / แขวง :</label>
                        <div class="custom_select">
                            <select name="place_district" id="place_district" class="form-control" required>
                            </select>
                        </div>
                    </div>-->
                    
    			</div>
                <br />
                <div class="row">	
                    <div class="col-xs-12 p-t-20">
                        <label for="address" class="required">ที่อยู่ :</label>
                        <textarea type="text" class="form-control" name="place_address" id="place_address" required></textarea>
                        <small>ระบุอาคาร เลขที่บ้าน หมู่บ้าน ถนน ตำบล/แขวง รายละเอียดสถานที่</small>
                    </div>
                </div>
    
                <div class="row">
                    <div class="col-md-6 p-t-10 col-sm-6">
                        <label for="postcode" class="required">รหัสไปรษณีย์ :</label>
                        <input type="text" class="form-control" name="place_postcode" id="place_postcode" required>
                    </div><!--/ [col] -->
                    <div class="col-md-6 p-t-10">
                    	<label for="telephone" class="required">เบอร์โทรศัพท์ :</label>
                    	<input type="text" class="form-control"  name="place_mobile" id="place_mobile" required>
                	</div>
                </div><!--/ .row -->
                <div class="row">
                	<div class="col-md-12 p-t-10">
                    	<label>วัน เวลา ทำการ :</label>
                    </div>
                </div>
                
                <div id="working_time_container" class="working_time_container">
                    
    			</div>
                
    
               <!-- <div class="v_centered col-sm-4">
                    <button type="button" class="button_grey middle_btn p-t-10" onclick="addWorkingTime();">เพิ่มวันทำการ</button>
                </div>-->
    			<br />
                <div class="row">	
                    <div class="col-xs-12 p-t-10">
                        <label>อธิบายเส้นทางและพิกัดที่อยู่ :</label>
                        <textarea type="text" name="place_condition" id="place_condition" class="form-control"></textarea>
                    </div>
                </div>
    			<br />
                <div class="row ">	
                    <div class="col-xs-12 p-t-10">
                        <label>ระบุพิกัดในแผนที่ :</label>
                        <div class="clear"></div>
                        <div id="googleMap" style="width:100%;height:400px;"></div>
                    </div>
                </div>
    
              
    
        
		</div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">เพิ่ม</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
      </div>
    </div>
  </div>
</div>
</form>

<script src="<?php echo base_url('assets/js/jquery-2.1.1.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/config.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/AutoProvince.js"); ?>"></script> 

<script src="https://maps.googleapis.com/maps/api/js?sensor=false&v=3.5&key=AIzaSyBQQ7B-myYelxU8X5SjSCITydZidvcKrc8&language=th&region=TH&callback=myMap" async defer></script>

<script type="text/javascript">
function myMap() {
	var mapProp= {
		center:new google.maps.LatLng(13.756331,100.501762),
		zoom:15,
	};
	var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
	
	google.maps.event.addListener(map, 'click', function(event) {
		$("#place_latitude").val(event.latLng.lat());
		$("#place_longitude").val(event.latLng.lng());
	});

} 

$('body').AutoProvince({
	PROVINCE:		'#place_province', 
	AMPHUR:			'#place_amphur', 
	DISTRICT:		'#place_district',
	POSTCODE:		'#place_postcode',
	GEOGRAPHY:		'#geography',
	arrangeByName:	false
});
function enabledInput(){
	for(var i = 0;i<currentWorkingTime.length;i++){
		$('#open_time'+i).attr("disabled",false);
		$('#close_time'+i).attr("disabled",false);
	}	
	$("#place_frm").submit();
}

$(document).ready(function(){
	initCheckboxAllday();
});

function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
</script>