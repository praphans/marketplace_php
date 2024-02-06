<form class="type_2" action="<?php echo site_url("store/shipping/savePlace"); ?>" method="post">
<div id="modal_shop_agent_address" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">เพิ่มสถานที่ส่งสินค้า</h4>
      </div>
      <div class="modal-body">
     	<div class="row">
                <div class="col-md-8">
                    <input type="text" name="agent_place_code" id="agent_place_code" placeholder="พิมพ์ รหัสสถานที่ส่งมอบสินค้า">
                    <input type="hidden" name="place_status" id="place_status" value="1">
                </div>
                <div class="col-md-4 "> 
                    <button type="button" onclick="findAgentPlaceByID();" class="btn-block button_blue middle_btn text-center mt-0">ตรวจสอบสถานที่</button>
                </div>
            </div>
            <br />
            <div id="place_container" class="theme_box">
            	<div class="row">
                    <div class="col-md-3 col-xs-6 b-r">
                        <strong>ชื่อสถานที่</strong>
                        <br>
                        <p class="text-muted" id="place_name_view">ชื่อร้าน</p>
                    </div>
                    <div class="col-md-3 col-xs-6 b-r">
                        <strong>รหัสสถานที่</strong>
                        <br>
                        <p class="text-muted" id="place_code_view"></p>
                    </div>
                    <div class="col-md-3 col-xs-6 b-r">
                        <strong>ที่อยู่</strong>
                        <br>
                        <p class="text-muted" id="place_address_view"></p>
                    </div>
                    <div class="col-md-3 col-xs-6 b-r">
                        <strong>เบอร์โทรศัพท์</strong>
                        <br>
                        <p class="text-muted" id="place_mobile_view"></p>
                    </div>
               </div>
               <br />
               <div class="row">
                    <div class="col-md-3 col-xs-6 b-r">
                        <strong>อธิบายเส้นทาง</strong>
                        <br>
                        <p class="text-muted" id="place_condition_view"></p>
                    </div>
                    
                    <div class="col-md-3 col-xs-6 b-r">
                        <strong>ดูตำแหน่งในแผนที่</strong>
                        <br>
                        <p class="text-muted"><a target="_blank" id="place_google_map" href="#">ดูใน Google Map</a></p>
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col-md-12 b-r">
                        <strong>วันที่ทำการ</strong>
                        <br>
                        <p class="text-muted" id="place_working"></p>
                    </div>
                </div>
            </div>
           
    
	  </div>
      <div class="modal-footer">
        <button type="button" onclick="requestAgentPlace();" class="btn btn-success">ส่งคำขอใช้สถานที่</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
      </div>
    </div>
  </div>
</div>
</form>

<script src="<?php echo base_url('assets/js/jquery-2.1.1.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/config.js'); ?>"></script>


<script type="text/javascript">
/*function myMap() {
	var mapProp= {
		center:new google.maps.LatLng(13.756331,100.501762),
		zoom:15,
	};
	var map = new google.maps.Map(document.getElementById("googleMap_agent"),mapProp);
	
	google.maps.event.addListener(map, 'click', function(event) {
		//$("#agent_latitude").val(event.latLng.lat());
		//$("#agent_longitude").val(event.latLng.lng());
	});

} 
*/

$("#place_container").hide();
var place_id = 0;
function findAgentPlaceByID(){
	var place_code = $("#agent_place_code").val();
	$("#place_container").hide();
	if(place_code != ""){
		$.ajax({
			type: 'POST',
			url: config.base_url+'store/api/shipping_api/findAgentPlaceByID',
			data: {
				'place_code': place_code
			},
			success: function (json) {
				var json = JSON.parse(json);
				console.log(json[0]);
				if(!json.success){
					swal({title:"ผิดพลาด",html:true,text:"ไม่พบสถานที่นี้ หรือร้านยังไม่ได้รับการอนุมัติ",type:"info"});
					return false;
				}
				if(json.success){
					var address = json[0].place_address+" "+json[0].place_province+" "+json[0].place_amphur+" " +json[0].place_district+" "+json[0].place_postcode;
				
					place_id = json[0].place_id;
					$("#place_address_view").text(address);
					$("#place_name_view").text(json[0].place_name);
					$("#place_mobile_view").text(json[0].place_mobile);
					$("#place_condition_view").text(json[0].place_condition);
					$("#place_code_view").text(json[0].place_code);
					$("#place_google_map").attr('href',json[0].google_map);
					$("#place_working").html(json[0].place_working);
					$("#place_container").show("slow");
				}else{
					swal({title:"ข้อความจากระบบ",html:true,text:"ไม่พบข้อมูลสถานที่",type:"info"});
				}
			}
		});
	}else{
		swal({title:"ผิดพลาด",html:true,text:"จำเป็นต้องระบุรหัสสถานที่",type:"info"});
	}
}

function requestAgentPlace(){
	if(!place_id){
		swal({title:"ผิดพลาด",html:true,text:"จำเป็นต้องระบุรหัสสถานที่",type:"info"});
		return false;
	}
	$.ajax({
		type: 'POST',
		url: config.base_url+'store/api/shipping_api/requestAgentPlace',
		data: {
			'place_id': place_id
		},
		success: function (json) {
			var json = JSON.parse(json);
			if(json.success){
				//swal({title:"สำเร็จ",html:true,text:"ส่งคำขอใช้สถานที่เรียบร้อยแล้ว จำเป็นจะต้องได้รับการอนุญาติจากเจ้าของสถานที่",type:"info"});
				swal({
				  title: "สำเร็จ",
				  text: "ส่งคำขอใช้สถานที่เรียบร้อยแล้ว <br>จำเป็นจะต้องได้รับการอนุญาติจากเจ้าของสถานที่.",
				  html:true,
				  type: "info",
				  showCancelButton: false,
				  confirmButtonColor: "#DD6B55",
				  confirmButtonText: "ตกลง",
				  cancelButtonText:"ยกเลิก",
				  closeOnConfirm: true
				},function(result){
					if (result) {
						window.location = config.base_url+"/store/shipping";
					}
				});	
			}else{
				swal({title:"ผิดพลาด",html:true,text:"มีคำขอใช้สถานที่นี้อยู่แล้ว",type:"info"});
			}
		}
	});
}
</script>