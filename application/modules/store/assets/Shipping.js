

var currentWorkingTime = ['จันทร์','อังคาร','พุธ','พฤหัสบดี','ศุกร์','เสาร์','อาทิตย์','วันหยุดนักขัตฤกษ์'];

var working_time_html = '<div class="row">'+
                        '<div class="col-sm-3">'+
                            '<div class="custom_select">'+
                                '<select name="working_time[]" id="working_time" class="form-control working_time" required>'+
                                    '<option value="จันทร์">จันทร์</option>'+
                                    '<option value="อังคาร">อังคาร</option>'+
                                    '<option value="พุธ">พุธ</option>'+
                                    '<option value="พฤหัสบดี">พฤหัสบดี</option>'+
                                    '<option value="ศุกร์">ศุกร์</option>'+
                                    '<option value="เสาร์">เสาร์</option>'+
                                    '<option value="อาทิตย์">อาทิตย์</option>'+
									'<option value="วันหยุดนักขัตฤกษ์">วันหยุดนักขัตฤกษ์</option>'+
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
						'<div class="col-sm-1">'+
                            '<button onClick="delWorkingTime(this);" class="btn"><i class="icon-trash"></i></button>'+
                        '</div>'+
                    '</div>';
					
var working_time_container = $("#working_time_container");

for(var i = 0;i<currentWorkingTime.length;i++){
	var option = currentWorkingTime[i];
	addWorkingTime(option,i);
}
function addWorkingTime(option,i){
	
	
	working_time_html = '<div class="row">'+
                        '<div class="col-sm-3">'+
                            '<div class="custom_select">'+
          '<select name="working_time[]" id="working_time" class="form-control working_time" required>'+
		  	'<option value="'+option+'">'+option+'</option>'+
		  '</select>'+
                            '</div>'+
                        '</div>'+
                        '<div class="col-sm-4 time_input">'+
                            '<div class="row">'+
                                '<div class="col-xs-5">'+
                                    '<input type="text" name="open_time[]" id="open_time'+i+'" class="form-control" placeholder="เวลาเปิด" value="09:00" required>'+
                                '</div>'+
                                '<div class="col-xs-2">'+
                                    '<h1>-</h1>'+
                                '</div>'+
                                '<div class="col-xs-5">'+
                                    '<input type="text" name="close_time[]" id="close_time'+i+'" class="form-control" placeholder="เวลาปิด" value="18:00" required>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="col-sm-3 check_24">'+
                            '<input class="open_all_day" name="open_all_day['+i+']" type="checkbox" id="open_all_day'+i+'" value="0">'+
                            '<label for="open_all_day'+i+'">เปิด 24 ชั่วโมง</label>'+
                        '</div>'+
						'<div class="col-sm-2 check_24">'+
                             '<input class="open_all_day_stop" name="open_all_day_stop['+i+']" type="checkbox" id="open_all_day_stop'+i+'" value="0">'+
                             '<label for="open_all_day_stop'+i+'">วันหยุด</label>'+
                        '</div>'+
                    '</div>';
					
					
	var count = 0;
	var start = 0;
	working_time_container.append(working_time_html);
	var child = $(working_time_container).children().length-1;
	var html_last_add = working_time_container.children(child);
	$(html_last_add).find("input[type='checkbox']").each(function(index){
		var checked = $(this).prop("checked");
		var name = "open_all_day"+count;
		var id = "open_all_day"+index;
		//$(this).attr("name",name);
		$(this).attr("id",id);
		$(this).next().attr("for",id);
		if(checked)$(this).prop("checked",true);
		
		
	});
	
	
	
	initCheckboxAllday();
}



function getCurrentWorkingTime(){
	currentWorkingTime = [];
	$(".working_time").each(function(){
		currentWorkingTime.push($(this).val());							 
	});
	
	/*for(var i = 0;i<currentWorkingTime.length;i++){
		var index = currentWorkingTime[i];
		$(".working_time option[value='"+index+"']").each(function() {
			var selected = $(this).attr("selected");
			console.log('selected = '+selected);
			if(!selected){
				$(this).remove();
			}
		});
	}*/
	
}
function delWorkingTime(_this){
	$(_this).parent().parent().remove();
}
$(".open_all_day").change(function(index){
	initCheckboxAllday();					   
});
$(".open_all_day_stop").change(function(index){
	initCheckboxAllday();					   
});
function initCheckboxAllday(){
	var time_list = [];
	
	$(".open_all_day").each(function(index){
		var checked = $(this).prop("checked");
		if(checked){
			time_list.push(index);
			//$(this).parent().parent().find('#open_time').attr("disabled",true);
			//$(this).parent().parent().find('#close_time').attr("disabled",true);
		}else{
			//$(this).parent().parent().find('#open_time').attr("disabled",false);
			//$(this).parent().parent().find('#close_time').attr("disabled",false);
		}
	});
	
	
	$(".open_all_day_stop").each(function(index){
		var checked = $(this).prop("checked");
		if(checked){
			time_list.push(index);
			//$(this).parent().parent().find('#open_time').attr("disabled",true);
			//$(this).parent().parent().find('#close_time').attr("disabled",true);
		}else{
			//$(this).parent().parent().find('#open_time').attr("disabled",false);
			//$(this).parent().parent().find('#close_time').attr("disabled",false);
		}
	});
	
	for(var i = 0;i<currentWorkingTime.length;i++){
			
			if(time_list.indexOf(i) > -1){
				$('#open_time'+i).attr("disabled",true);
				$('#close_time'+i).attr("disabled",true);
			}else{
				$('#open_time'+i).attr("disabled",false);
				$('#close_time'+i).attr("disabled",false);
			}
	}
	
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
      	window.location = config.base_url+"store/shipping/cancelplace/"+place_id;
    });
}
$("input[type='checkbox'], input[type='text']").change(function (){
	var store_shipping = new Array();
	$("input[type='checkbox']").each(function(){
		var shipping_type = $(this).val();
		if($(this).prop("checked")){
			store_shipping.push(shipping_type);	
		}
	});
	console.log("store_shipping : "+store_shipping.toString());
	var store_shipping_charge = $("#store_shipping_charge").val();
	$.ajax({
        type: 'POST',
        url: config.base_url+'store/api/shipping_api/saveShipping',
        data: {
			'store_shipping': store_shipping.toString(),
			'store_shipping_charge': store_shipping_charge
        },
        success: function (json) {
			var json = JSON.parse(json);
			//swal({title:"โปรโมชั่น",html:true,text:"บันทึกข้อมูลเรียบร้อยแล้ว",type:"success"});
        }
    });
 });

$("#store_shipping_charge").change(function(){
	var store_shipping = new Array();
	$("input[type='checkbox']").each(function(){
		var shipping_type = $(this).val();
		if($(this).prop("checked")){
			store_shipping.push(shipping_type);	
		}
	});
	var store_shipping_charge = $("#store_shipping_charge").val();
	$.ajax({
        type: 'POST',
        url: config.base_url+'store/api/shipping_api/saveShipping',
        data: {
			'store_shipping': store_shipping.toString(),
			'store_shipping_charge': store_shipping_charge
        },
        success: function (json) {
			console.log(json);
			var json = JSON.parse(json);
			//swal({title:"โปรโมชั่น",html:true,text:"บันทึกข้อมูลเรียบร้อยแล้ว",type:"success"});
        }
    });									
});


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

function filterDays(days_added){
	var days_news = days.concat(days_added); 
	var uniqueNames = [];
	$.each(days_news, function(i, el){
		if($.inArray(el, uniqueNames) === -1) uniqueNames.push(el);
	});
	return uniqueNames;
}
loadTabContent(config.base_url+"store/shipping/storePlace");


	