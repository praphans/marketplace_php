var working_time_html = '<div class="row">'+
                        '<div class="col-sm-4">'+
                            '<div class="custom_select">'+
                                '<select name="working_time[]" id="working_time" class="form-control" required>'+
                                    '<option value="อาทิตย์">อาทิตย์</option>'+
                                    '<option value="จันทร์">จันทร์</option>'+
                                    '<option value="อังคาร">อังคาร</option>'+
                                    '<option value="พุธ">พุธ</option>'+
                                    '<option value="พฤหัสบดี">พฤหัสบดี</option>'+
                                    '<option value="ศุกร์">ศุกร์</option>'+
                                    '<option value="เสาร์">เสาร์</option>'+
                                    '<option value="จันทร์">จันทร์</option>'+
                                '</select>'+
                            '</div>'+
                        '</div>'+
                        '<div class="col-sm-5 time_input">'+
                            '<div class="row">'+
                                '<div class="col-xs-5">'+
                                    '<input type="text" name="open_time[]" id="open_time" class="form-control" placeholder="เวลาเปิด" value="09:00" required>'+
                                '</div>'+
                                '<div class="col-xs-2">'+
                                    '<h1>-</h1>'+
                                '</div>'+
                                '<div class="col-xs-5">'+
                                    '<input type="text" name="close_time[]" id="close_time" class="form-control" placeholder="เวลาปิด" value="18:00" required>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="col-sm-3 check_24">'+
                            '<input class="open_all_day" type="checkbox" id="open_all_day" value="0">'+
                            '<label for="open_all_day">เปิด 24 ชั่วโมง</label>'+
                        '</div>'+
                    '</div>';
					
var working_time_container = $("#working_time_container");
if($(working_time_container).children().length <=0){
	working_time_container.append(working_time_html);
}
function addWorkingTime(){
	var count = 0;
	var start = 0;
	working_time_container.append(working_time_html);
	var child = $(working_time_container).children().length-1;
	var html_last_add = working_time_container.children(child);
	$(html_last_add).find("input[type='checkbox']").each(function(index){
		var checked = $(this).prop("checked");
		var name = "open_all_day"+count;
		var id = "open_all_day"+index;
		
		$(this).attr("id",id);
		$(this).next().attr("for",id);
		if(checked)$(this).prop("checked",true);
		
		
	});
	
}

function onCancelPlace(place_id){
    swal({
      title: "แน่ใจหรือ ?",
      text: "คุณแน่ใจหรือว่าต้องการลบข้อมูลนี้",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "ใช่, ต้องการลบ",
	  cancelButtonText:"ยกเลิก",
      closeOnConfirm: true
    },function(){
      	window.location = config.base_url+"user/cancelplace/"+place_id;
    });
}





$("#edit_place").submit(function(){
	var open_all_day = [];
	$(".open_all_day").each(function(){
		var checked = $(this).prop("checked");		
		if(checked){
			open_all_day.push(1);
		}else{
			open_all_day.push(0);
		}
	});
	
	$("input[name='open_all_day']").val(open_all_day.toString());
	
});
$(".tabs_nav a").each(function(index){
	$(this).click(function(){
		if(index == 0){
			loadTabContent(config.base_url+"store/shipping/storePlace");
		}else if(index == 1){
			loadTabContent(config.base_url+"store/shipping/agentPlace");
		}else if(index == 2){
			loadTabContent(config.base_url+"store/shipping/servicePlace");
		}
	});
});
function loadTabContent(url){
	$(".tab_containers_wrap").empty();
	$(".tab_containers_wrap").load(url,function(){
												
	});
}
function updatePlace_is_default(place_id,is_tax){
	
	if(is_tax == 0){
		$(".place_is_default").each(function(){
			if($(this).attr("place_id") != place_id){
				$(this).prop("checked",false);	
			}
		});
	}else{
		$(".place_is_default_tax").each(function(){
			if($(this).attr("place_id") != place_id){
				$(this).prop("checked",false);	
			}
		});
	}
	var place_is_default = 0;
	if($("#place_is_default"+place_id).prop("checked")){
		place_is_default = 1;
	}
	var place_is_default_tax = 0;
	if($("#place_is_default_tax"+place_id).prop("checked")){
		place_is_default_tax = 1;
	}
	
	console.log("place_is_default : "+place_is_default);
	console.log("place_is_default_tax : "+place_is_default_tax);
	console.log("place_id : "+place_id);
	$.ajax({
        type: 'POST',
        url: config.base_url+'user/api/user_api/saveShipping',
        data: {
			'place_id': place_id,
			'place_is_default': place_is_default,
			'place_is_default_tax': place_is_default_tax,
			'is_tax': is_tax,
        },
        success: function (json) {
			console.log(json);
			var json = JSON.parse(json);
			
        }
    });
}
loadTabContent(config.base_url+"store/shipping/storePlace");