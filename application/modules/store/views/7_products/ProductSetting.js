var main_container = "#relate_container_two ";
var icon_save = "<i class='icon-check-1'></i>";
/*เริ่มสินค้าไม่มีตัวเลือก*/
function saveNewCategoryCustomer(_this){
	var product_category_customer = new Array();
	$("select[name='product_category_customer[]']").each(function(){
			product_category_customer.push($(this).val());
	});
	product_category_customer = removeDuplicateArrayIndex(product_category_customer);
	console.log(product_category_customer);
	$.ajax({
        type: 'POST',
        url: config.base_url+'store/api/productsetting_api/updateCategoryCustomer',
        data: {
            'product_id': product_id,
			'product_category_customer': product_category_customer.toString()
        },
        success: function (json) {
			console.log(json);
			var json = JSON.parse(json);
			if($(_this).find(".icon-check-1").length <= 0)$(_this).prepend(icon_save);
			swal({title:"หมวดหมู่ภายในร้าน",html:true,text:"บันทึกหมวดหมู่ของสินค้าเรียบร้อยแล้ว",type:"success"});
        }
    });
}

function saveProductQty(_this){
	
	var product_qty = $("input[name='product_qty']").val();
	$.ajax({
        type: 'POST',
        url: config.base_url+'store/api/productsetting_api/updateQty',
        data: {
            'product_id': product_id,
			'product_qty': product_qty
        },
        success: function (json) {
			var json = JSON.parse(json);
			if($(_this).find(".icon-check-1").length <= 0)$(_this).prepend(icon_save);
			swal({title:"สินค้าในคลัง",html:true,text:"บันทึกข้อมูลเรียบร้อยแล้ว",type:"success"});
        }
    });
}

var promotion_container = $("#promotion_container");
var promotion_html = promotion_container.children(":first").parent().html();
function savePromotion(_this){
	
	var child = $(_this).parent().parent().parent();
	var promo_id = $(child).find("#promo_id").val();
	var promo_name = $(child).find("#promo_name").val();
	var promo_startdate = $(child).find("#promo_startdate").val();
	var promo_starttime = $(child).find("#promo_starttime").val();
	var promo_enddate = $(child).find("#promo_enddate").val();
	var promo_endtime = $(child).find("#promo_endtime").val();
	var promo_price = $(child).find("#promo_price").val();
	
	if(!promo_name || promo_name == ""){
		swal({title:"โปรโมชั่น",html:true,text:"กรุณาระบุชื่อโปรโมชั่น",type:"warning"});
		return false;
	}
	if(!promo_price || promo_price <= 0){
		swal({title:"โปรโมชั่น",html:true,text:"กรุณากำหนดราคาโปรโมชั่น",type:"warning"});
		return false;
	}
	$.ajax({
        type: 'POST',
        url: config.base_url+'store/api/productsetting_api/updatePromo',
        data: {
            'product_id': product_id,
			'promo_id': promo_id,
			'promo_name': promo_name,
			'promo_startdate': promo_startdate,
			'promo_starttime': promo_starttime,
			'promo_enddate': promo_enddate,
			'promo_endtime': promo_endtime,
			'promo_price': promo_price,
			'promo_status': 2
        },
        success: function (json) {
			var json = JSON.parse(json);
			console.log(json);
			if(json && json.promo_id)$(child).find("#promo_id").val(json.promo_id);
			if($(_this).find(".icon-check-1").length <= 0)$(_this).prepend(icon_save);
			swal({title:"โปรโมชั่น",html:true,text:"สร้างโปรโมชั่น <b>"+promo_name+"</b> เรียบร้อยแล้ว",type:"success"});
        }
    });
}
function delPromotion(_this){
	var child = $(_this).parent().parent().parent();
	var promo_id = $(child).find("#promo_id").val();
	if(promotion_container.children().length > 1){
		$.ajax({
			type: 'POST',
			url: config.base_url+'store/api/productsetting_api/delPromo',
			data: {
				'product_id': product_id,
				'promo_id': promo_id
			},
			success: function (json) {
				var json = JSON.parse(json);
				if(json && json.promo_id)$(child).find("#promo_id").val(0);
				child.remove();
			}
		});
	}else{
		swal({title:"โปรโมชั่น",html:true,text:"ไม่สามารถลบโปรโมชั่นเริ่มต้นได้ กรุณาเพิ่มโปรโมชั่น",type:"warning"});
	}
}
function addPromotion(_this){
	console.log(promotion_html);
	promotion_container.append(promotion_html);
}

var promotion_join_container = $("#promotion_join_container");
var promotion_join_html = promotion_join_container.children(":first").parent().html();
function savePromotionJoin(_this){
	
	var join_id = 0;
	var child = $(_this).parent().parent().parent();
	$(child).find("input[type='radio']").each(function(index){
		if($(this).prop("checked")){
			join_id	= $(this).val();
		}			   
	});
	var promo_price = $(child).find("#promo_price").val();
	if(!promo_price || promo_price <= 0){
		swal({title:"โปรโมชั่น",html:true,text:"กรุณากำหนดราคาที่จะร่วมโปรโมชั่น",type:"warning"});
		return false;
	}
	if(!join_id || join_id <= 0){
		swal({title:"โปรโมชั่น",html:true,text:"กรุณาเลือกโปรโมชั่นร่วม",type:"warning"});
		return false;
	}
	$.ajax({
        type: 'POST',
        url: config.base_url+'store/api/productsetting_api/updatePromoJoin',
        data: {
            'product_id': product_id,
			'join_id': join_id,
			'promo_price': promo_price,
			'promo_status': 1,
			'promo_type': 2
        },
        success: function (json) {
			var json = JSON.parse(json);
			if(json.num_rows){
				swal({title:"โปรโมชั่น",html:true,text:"คุณมีคำขอเข้าร่วมโปรโมชั่นนี้อยู่แล้ว",type:"warning"});
			}else{
				if($(_this).find(".icon-check-1").length <= 0)$(_this).prepend(icon_save);
				swal({title:"โปรโมชั่น",html:true,text:"สร้างโปรโมชั่นร่วมเรียบร้อยแล้ว",type:"success"});
			}
        }
    });
}
function addPromotionJoin(_this){
	if($(_this).find(".icon-check-1").length <= 0)$(_this).prepend(icon_save);
	promotion_join_container.append(promotion_join_html);
	var child = $(promotion_join_container).children().length-1;
	var html_last_add = promotion_join_container.children(child);
	var count = 0;
	var start = 0;
	var max_join_item = 2;
	$(html_last_add).find("input[type='radio']").each(function(index){
		start++;
		var checked = $(this).prop("checked");
		var name = "join_id"+count;
		var id = "join_id"+index;
		$(this).attr("name",name);
		$(this).attr("id",id);
		$(this).next().attr("for",id);
		if(checked)$(this).prop("checked",true);
		if(start >= max_join_item){
			count++;	
			start = 0;
		}
		
	});
	
}
function delPromotionJoin(_this){
	
	var child = $(_this).parent().parent().parent();
	var join_id = $(child).find("#join_id").val();
	var promo_join_id = $("#promo_join"+join_id);
	
	
	
	$.ajax({
		type: 'POST',
		url: config.base_url+'store/api/productsetting_api/delPromoJoin',
		data: {
			'product_id': product_id,
			'join_id': join_id
		},
		success: function (json) {
			var json = JSON.parse(json);
			if(json.success)promo_join_id.remove();
		}
	});
}


function savePrice(_this){
	
	var product_price = $("input[name='product_price']").val();
	var product_percentage_discount = $("input[name='product_percentage_discount']").val();
	var product_price_discount = $("input[name='product_price_discount']").val();
	
	$.ajax({
        type: 'POST',
        url: config.base_url+'store/api/productsetting_api/updatePriceAndDiscount',
        data: {
            'product_id': product_id,
			'product_price': product_price,
			'product_percentage_discount': product_percentage_discount,
			'product_price_discount': product_price_discount
        },
        success: function (json) {
			savePayment();
			var json = JSON.parse(json);
			swal({title:"ราคาสินค้า",html:true,text:"บันทึกข้อมูลเรียบร้อยแล้ว",type:"success"});
			if($(_this).find(".icon-check-1").length <= 0)$(_this).prepend(icon_save);
        }
    });
}

function savePayment(_this){
	
	var gateway_type_id = $("input[name='gateway_type_id']:checked").val();
	var option1 = parseFloat($("input[name='option1']").val());
	var option2 = parseFloat($("input[name='option2']").val());
	
	if(gateway_type_id != 2 || !_this){
		option1 = 0;
		option2 = 0;
		$("input[name='option1']").val(option1);
		$("input[name='option2']").val(option2);
	}else{
		if(option1 <= 0 || option2 <=0){
			swal({title:"วิธีการชำระเงิน",html:true,text:"กรุณาระบุจำนวนเงินที่ต้องชำระล่วงหน้า",type:"warning"});
			return false;
		}
	}
	
	$.ajax({
        type: 'POST',
        url: config.base_url+'store/api/productsetting_api/savePayment',
        data: {
            'product_id': product_id,
			'gateway_type_id': gateway_type_id,
			'option1': option1,
			'option2': option2
        },
        success: function (json) {
			if(_this){
			var json = JSON.parse(json);
			swal({title:"วิธีการชำระเงิน",html:true,text:"บันทึกข้อมูลเรียบร้อยแล้ว",type:"success"});
			if($(_this).find(".icon-check-1").length <= 0)$(_this).prepend(icon_save);
			}
        }
    });
}

function calculatePercentPrice(){
	var product_price = $("input[name='product_price']").val();
	var product_percentage_discount = $("input[name='product_percentage_discount']").val();
	var product_price_discount = $("input[name='product_price_discount']").val();
	var product_price_discount_disable = $("#product_price_discount_disable");
	var product_price_discount_label = $("#product_price_discount_label");
	if(product_percentage_discount>100){
		$("input[name='product_percentage_discount']").val(100);
		swal({title:"โปรโมชั่น",html:true,text:"ระบุจำนวนเปอร์เซ็นต์สูงสุดได้ไม่เกิน 100 เปอร์เซ็นต์",type:"warning"});
		return false;
	}
	if(!product_price) product_price = 0;
	if(!product_percentage_discount) $product_percentage_discount = 0;
	if(!product_price_discount) $product_price_discount = 0;
	
	var discount = (product_price*product_percentage_discount)/100;
	product_price_discount_disable.val(discount);
	
	product_price_discount = product_price-discount;
	product_price_discount_label.text(numberWithCommas(product_price_discount));
	$("input[name='product_price_discount']").val(product_price_discount);
	calPayBefore();
}

function addNewCategoryCustomer(){
	var category_customer_container = $("#category_customer_container");
	var content = '<div class="col-md-12">'+category_customer_container.children(":first").html()+'</div>';
	category_customer_container.append(content);
}
function removeNewCategoryCustomer(_this){
	var category_customer_container = $("#category_customer_container");
	if(category_customer_container.children().length > 1){
		var content = $(_this).parent().parent().parent().parent();
		content.remove();
	}
}

/*จบสินค้าไม่มีตัวเลือก*/



$("input[name='product_is_relate']").change(function(){
	var product_is_relate = $(this).val();
	
	if(product_is_relate){
		
	}else{
		
	}
	$.ajax({
        type: 'POST',
        url: config.base_url+'store/api/productsetting_api/updateIsRelate',
        data: {
            'product_id': product_id,
			'product_is_relate': product_is_relate
        },
        success: function (json) {
			console.log(json);
			var json = JSON.parse(json);
			
        }
    });
	
});

function removeDuplicateArrayIndex(names){
	var uniqueNames = [];
	$.each(names, function(i, el){
    	if($.inArray(el, uniqueNames) === -1) uniqueNames.push(el);
	});
	return uniqueNames;
}
function numberWithCommas(x) {
	x = x.toFixed(2);
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+" บาท";
}

function countdown(eventTime,container){
	var $clock = container,
        eventTime = moment(eventTime, 'DD-MM-YYYY HH:mm').unix(),
        currentTime = moment().unix(),
        diffTime = eventTime - currentTime,
        duration = moment.duration(diffTime * 1000, 'milliseconds'),
        interval = 1000;
	
    if(diffTime > 0) {
        var $d = $('<div class="col-md-6 col-sm-3 col-xs-3 color_countdown_bg bd_countdown mg-t-10">'+
					'<a class="font_color_countdown"></a>'+
					'</div>').appendTo($clock),
            $h = $('<div class="col-md-6 col-sm-3 col-xs-3 color_countdown_bg bd_countdown mg-t-10">'+
					'<a class="font_color_countdown"></a>'+
					'</div>').appendTo($clock),
            $m = $('<div class="col-md-6 col-sm-3 col-xs-3 color_countdown_bg bd_countdown mg-t-10">'+
					'<a class="font_color_countdown"></a>'+
					'</div>').appendTo($clock),
            $s = $('<div class="col-md-6 col-sm-3 col-xs-3 color_countdown_bg bd_countdown mg-t-10">'+
					'<a class="font_color_countdown"></a>'+
					'</div>').appendTo($clock);
			
        setInterval(function(){

            duration = moment.duration(duration.asMilliseconds() - interval, 'milliseconds');
            var d = moment.duration(duration).asDays(),
                h = moment.duration(duration).hours(),
                m = moment.duration(duration).minutes(),
                s = moment.duration(duration).seconds();

            d = $.trim(d).length === 1 ? '0' + d : d;
            h = $.trim(h).length === 1 ? '0' + h : h;
            m = $.trim(m).length === 1 ? '0' + m : m;
            s = $.trim(s).length === 1 ? '0' + s : s;

            $d.text(Math.round(d)+' วัน');
            $h.text(h+' ชั่วโมง');
            $m.text(m+' นาที');
            $s.text(s+' วินาที');

        }, interval);

    }

}

function initailize(){
	
	$(".countdown_container").each(function(){
		var timestamp = $(this).attr("timestamp");
		if(timestamp)countdown(timestamp,$(this));
		console.log(timestamp);
	});
	
	
	$('.promo_starttime').clockpicker();	
	$('.promo_endtime').clockpicker();
	calPayAfter();
}

function calPayBefore(){
	var option1 = parseFloat($("#option1").val());	
	//var product_price = parseInt($("#product_price").val());
	var product_price_discount = $("input[name='product_price_discount']").val();
	if(promo_price > 0){
		product_price_discount = promo_price;
	}
	if(option1 > product_price_discount){
		$("#option1").val(0);
		$("#option2").val(0);
		swal({title:"วิธีการชำระเงิน",html:true,text:"จำนวนเงินเกินกว่าราคาสินค้า",type:"info"});
		return false;
	}
	var total = product_price_discount-option1;
	if(total < 0)total = 0;
	$("#option2").val(total);
	
}
function calPayAfter(){
	var gateway_type_id = $("input[name='gateway_type_id']:checked").val();
	if(gateway_type_id == 2){
		var option2 = parseFloat($("#option2").val());	
		var product_price_discount = $("input[name='product_price_discount']").val();
		if(promo_price > 0){
			product_price_discount = promo_price;
		}
		var total = product_price_discount-option2;
		if(total < 0)total = 0;
		$("#option1").val(total);
	}
}
$(document).ready(function(){
	initailize();
});

