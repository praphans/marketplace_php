
var total_price = 0;
var product_price_payment = 0;
var product_price_balance = 0;

var product_checked_arr = [];
var product_qty_arr = [];
var product_id_arr = [];
var product_price_discount_arr = [];
var gateway_type_id_arr = [];
var product_price_payment_arr = [];
var product_price_balance_arr = [];
var product_qty_remaining_arr = [];
		
function calculateTotalPrice(){
	var cart;
	$(".store_id").each(function(){
		var checked = $(this).prop("checked");
		if(checked){
			var store_id = $(this).val();
			cart = $(".cart"+store_id);
			cart2 = $(".cart2"+store_id);
		}	
	});
	
	if(cart){
		total_price = 0;
		product_price_payment = 0;
		product_price_balance = 0;
		
		product_checked_arr = [];
		product_qty_arr = [];
		product_id_arr = [];
		product_price_discount_arr = [];
		gateway_type_id_arr = [];
		product_price_payment_arr = [];
		product_price_balance_arr = [];
		product_qty_remaining_arr = [];
		
		cart2.find(".product_checked").each(function(){
			var checked = $(this).prop("checked");
			console.log($(this).prop("checked"));
			if(checked){
				product_checked_arr.push($(this).val());	
			}
		});
		
		//console.log("product_checked_arr = "+product_checked_arr);
		
		cart.find(".product_qty_remaining").each(function(){
			product_qty_remaining_arr.push($(this).val());										
		});
		cart.find(".product_qty").each(function(){
			product_qty_arr.push($(this).val());										
		});
		cart.find(".product_id").each(function(){
											   console.log($(this).val());
			product_id_arr.push($(this).val());										
		});
		cart.find(".product_price_discount").each(function(){
			product_price_discount_arr.push($(this).val());										
		});
		cart.find(".gateway_type_id").each(function(){
			gateway_type_id_arr.push($(this).val());										
		});
		cart.find(".product_price_payment").each(function(){
			product_price_payment_arr.push($(this).val());										
		});
		cart.find(".product_price_balance").each(function(){
			product_price_balance_arr.push($(this).val());										
		});
		
		/*console.log("product_checked_arr : "+product_checked_arr);
		console.log("product_id_arr : "+product_id_arr);
		console.log("product_qty_arr : "+product_qty_arr);
		console.log("product_price_discount : "+product_price_discount_arr);
		console.log("gateway_type_id : "+gateway_type_id);
		console.log("product_price_payment : "+product_price_payment);
		console.log("product_price_balance : "+product_price_balance);
		console.log("product_qty_remaining_arr : "+product_qty_remaining_arr);*/
		
		
		for(var i = 0;i<product_qty_arr.length;i++){
			var product_qty_remaining = parseInt(product_qty_remaining_arr[i]);
			var product_qty = parseInt(product_qty_arr[i]);
			//console.log("product_qty : "+product_qty);
			//console.log("product_qty_remaining : "+product_qty_remaining);
			if(product_qty > product_qty_remaining){
				product_qty_arr[i] = 1;
				console.log("over");
			}
			var index_of = product_checked_arr.indexOf(product_id_arr[i]);
			if(index_of != -1){
				
				total_price += parseFloat(product_qty_arr[i])*parseFloat(product_price_discount_arr[i]);
				var gateway_type_id = gateway_type_id_arr[i];
				console.log("gateway_type_id : "+gateway_type_id);
				if(gateway_type_id == 3){ // ชำระเต็มจำนวน
					product_price_payment += parseFloat(product_qty_arr[i])*parseFloat(product_price_discount_arr[i]);
				}
				if(gateway_type_id == 1){ // ไม่ต้องชำระตอนนี้
					product_price_balance += parseFloat(product_qty_arr[i])*parseFloat(product_price_discount_arr[i]);
					product_price_balance += parseFloat(product_qty_arr[i])*parseFloat(product_price_payment_arr[i]);
				}
					
				product_price_payment += parseFloat(product_qty_arr[i])*parseFloat(product_price_payment_arr[i]);
				product_price_balance += parseFloat(product_qty_arr[i])*parseFloat(product_price_balance_arr[i]);
				
			}
		}
		
		$(".product_price_payment_total").val(product_price_payment);
		$(".product_price_balance_total").val(product_price_balance);
		
		$(".total_price_in_cart").text("฿"+numberWithCommasFloat(total_price));
		$(".total_price_in_payment").text("฿"+numberWithCommasFloat(product_price_payment));
		$(".total_price_in_balance").text("฿"+numberWithCommasFloat(product_price_balance));
	}
}


function minusCart(_this){
	
	var product_qty = parseInt($(_this).next().val())-1;
	$(_this).attr("product_qty",product_qty);
	addToCart(_this,1);
		
	/*$.ajax({
        type: 'POST',
        url: config.base_url+'shop/api/shop_api/minusCart',
        data: {"product_id":product_id},
        success: function (json) {
			var json = JSON.parse(json);
			getCart();
        }
    });*/
}
function plusCart(product_id){
	$.ajax({
        type: 'POST',
        url: config.base_url+'shop/api/shop_api/minusCart',
        data: {"product_id":product_id},
        success: function (json) {
			var json = JSON.parse(json);
			//console.log(json);
			getCart();
        }
    });
}
function _removeFromCart(product_id,_this){
	
	var shop_container = $(_this).parent().parent().parent().parent().parent().parent().parent();
	var item_in_cart = shop_container.find("tbody").children().length;
	$.ajax({
        type: 'POST',
        url: config.base_url+'shop/api/shop_api/removeFromCart',
        data: {"product_id":product_id},
        success: function (json) {
			var json = JSON.parse(json);
			$(_this).parent().parent().parent().remove();
			getCart();
			calculateTotalPrice();
			
			console.log('item_in_cart : '+item_in_cart);
			
			if(item_in_cart <= 1){
				shop_container.remove();
			}
        }
    });
}


$(".store_id").change(function(){
	calculateTotalPrice();
});

function numberWithCommasFloat(x) {
	x = x.toFixed(2);
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
$(document).ready(function(){
	if(isMobile){
		$(".shopping_cart_table #cart_desktop").empty();
	}else{
		$(".shopping_cart_table #cart_mobile").empty();
	}
	
	$(".qty .product_qty_btn").each(function(){
		$(this).click(function(){
			var _this = $(this);
			var isOver = false;
			setTimeout(function(){
				var product_price_discount = parseFloat($(_this).parent().parent().find(".product_price_discount").val());
				var product_qty = parseInt($(_this).parent().parent().find(".product_qty").val());
				var product_qty_remaining = parseInt($(_this).parent().parent().find(".product_qty_remaining").val());
				if(product_qty > product_qty_remaining){
					isOver = true;
					product_qty = 1;
				}
				var store_product_price_discount_total = product_price_discount*product_qty;
				_this.parent().parent().next().text("฿"+numberWithCommasFloat(store_product_price_discount_total));
				if(isOver){
					$(_this).parent().parent().find(".product_qty").val(product_qty);
					swal("มีบางอย่างผิดพลาด","จำนวนสินค้าที่ระบุ เกินกว่าจำนวนสินค้าที่คงเหลือในคลัง","info");
				}
				calculateTotalPrice();
			},100);
			
			
		});
	});	
	calculateTotalPrice();
});

$(".product_qty").change(function(){
	var val = parseInt($(this).val());
	if(!val || val <= 0){
		$(this).val(1);
	}
	
	
	var _this = $(this);
	var isOver = false;
	
	
	
	setTimeout(function(){
		var product_price_discount = parseFloat($(_this).parent().parent().find(".product_price_discount").val());
		var product_qty = parseInt($(_this).parent().parent().find(".product_qty").val());
		var product_qty_remaining = parseInt($(_this).parent().parent().find(".product_qty_remaining").val());
		if(product_qty > product_qty_remaining){
			isOver = true;
			product_qty = 1;
		}
		var store_product_price_discount_total = product_price_discount*product_qty;
		_this.parent().parent().next().text("฿"+numberWithCommasFloat(store_product_price_discount_total));
		if(isOver){
			$(_this).parent().parent().find(".product_qty").val(product_qty);
			swal("มีบางอย่างผิดพลาด","จำนวนสินค้าที่ระบุ เกินกว่าจำนวนสินค้าที่คงเหลือในคลัง","info"); 
		}
		
		var product_qty = parseInt($(_this).val());
		
		$(_this).attr("product_qty",product_qty);
		addToCart(_this,1);
		calculateTotalPrice();
	},100);
	
	calculateTotalPrice();							   
});