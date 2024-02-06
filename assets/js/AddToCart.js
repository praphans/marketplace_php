var cart_container = $(".cart_container");
var cart_item_default = $(".cart_item_default");
var cart_buy_item = $(".cart_buy_item");
var cart_total_item = $(".cart_total_item");
var cart_total_price = $(".cart_total_price");
var wishlist_number = $(".wishlist_number");
var inbox_number = $(".inbox_number");

function addEventRemoveFromCart(){
	$(".shopping_cart .close").each(function(index){
		$(this).click(function(){
			$(this).parent().parent().remove();		
			var product_id = $(this).attr('product_id');
			removeFromCart(product_id);
		});
	});
}
function removeFromCart(product_id){
	$.ajax({
        type: 'POST',
        url: config.base_url+'shop/api/shop_api/removeFromCart',
        data: {"product_id":product_id},
        success: function (json) {
			var json = JSON.parse(json);
			getCart();
        }
    });
}
function addToCart(_this,is_add_to_cart){
	cart_item = $(_this);
	setDefault();
	
	var product_id = cart_item.attr('product_id');
	var store_id = cart_item.attr('store_id');
	var product_name = cart_item.attr('product_name');
	var relate_product_name = cart_item.attr('relate_product_name');
	var product_image = cart_item.attr('product_image');
	var product_qty = cart_item.attr('product_qty');
	var product_price_discount = cart_item.attr('product_price_discount');
	var key_add_to_cart = cart_item.attr('key_add_to_cart');
	
	
	if(product_qty <= 0 && is_add_to_cart == 1){
		swal({title:"ตะกร้าสินค้า",html:true,text:"กรุณาระบุจำนวนสินค้า",type:"info"});
		return false;
	}
	
    if(relate_product_name != "" && relate_product_name != undefined && relate_product_name != "undefined"){
		product_name = product_name+" "+relate_product_name;	
	}
	var items = {
		"product_id":product_id,
		"store_id":store_id,
		"product_name":product_name,
		"product_image":product_image,
		"product_qty":product_qty,
		"product_price_discount":product_price_discount,
		"key_add_to_cart":key_add_to_cart
	}
	
	$.ajax({
        type: 'POST',
        url: config.base_url+'shop/api/shop_api/addToCart/'+is_add_to_cart+"/?t="+Math.random()*99999,
        data: items,
        success: function (json) {
			
			var json = JSON.parse(json);
			if(!json.success){
				$.toast({
						text: json.description,
						icon: 'success',
						showHideTransition: 'fade',
						allowToastClose: false,
						hideAfter: 2000,
						stack: 5, 
						position: 'top-right',
						textAlign: 'left',
						loader: false,
						loaderBg: '#ee4d2d',
						textColor: 'white',
						bgColor:'#ee4d2d'
					});
				if(json.cart_item){
					cart_container.empty();
					cart_container.append(json.cart_item);
					cart_total_price.text(json.cart_total_price);
				}
				cart_total_item.attr("data-amount",json.cart_total_item);
				wishlist_number.attr("data-amount",json.wishlist_number);
				
				return false;
			}
			
			if(json.cart_item){
				cart_container.empty();
				cart_container.append(json.cart_item);
				cart_total_price.text(json.cart_total_price);
			}
			cart_total_item.attr("data-amount",json.cart_total_item);
			wishlist_number.attr("data-amount",json.wishlist_number);
			
			
			/*var total_price = json.cart_total_price.replace(",","");
			total_price = total_price.replace("฿","");
			console.log(total_price);
			cart_total_price.animateNumber({ number: parseInt(total_price),numberStep: function(now, tween) {
        				var formatted = now.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
        				$(tween.elem).text('฿'+formatted);
			  		}
				},
				400
			  );*/
			
			var wishlist_has_already = json.wishlist_has_already;
			if(key_add_to_cart != 1){
				if(is_add_to_cart == 2 && !wishlist_has_already){
					//swal({title:"สินค้าน่าสนใจ",html:true,text:"เพิ่มเข้าไปในรายการที่น่าสนใจแล้ว",type:"success"});
					
						$.toast({
							text: "เพิ่ม '<b>"+product_name+"</b>' ในรายการโปรด",
							icon: 'success',
							showHideTransition: 'fade',
							allowToastClose: false,
							hideAfter: 2000,
							stack: 5, 
							position: 'top-right',
							textAlign: 'left',
							loader: false,
							loaderBg: '#ee4d2d',
							textColor: 'white',
							bgColor:'#ee4d2d'
						});
					
				}else if(is_add_to_cart == 2 && wishlist_has_already){
					//swal({title:"สินค้าน่าสนใจ",html:true,text:"สินค้านี้ อยู่ในรายการที่น่าสนใจของคุณอยู่แล้ว",type:"info"});
					
						$.toast({
							text: "'<b>"+product_name+"</b>' มีอยู่แล้วในรายการโปรด",
							icon: 'error',
							showHideTransition: 'fade',
							allowToastClose: false,
							hideAfter: 2000,
							stack: 5, 
							position: 'top-right',
							textAlign: 'left',
							loader: false,
							loaderBg: '#ee4d2d',
							textColor: 'white',
							bgColor:'#ee4d2d'
						});
					
				}else{
					if(is_add_to_cart == 1){
						$.toast({
							text: "เพิ่ม '<b>"+product_name+"</b>' ลงตะกร้า",
							icon: 'success',
							showHideTransition: 'fade',
							allowToastClose: false,
							hideAfter: 2000,
							stack: 5, 
							position: 'top-right',
							textAlign: 'left',
							loader: false,
							loaderBg: '#ee4d2d',
							textColor: 'white',
							bgColor:'#ee4d2d'
						});
					}	
				}
			}
			checkCart();
			//var json = JSON.parse(json);
			//swal({title:"โปรโมชั่น",html:true,text:"บันทึกหมวดหมู่ของสินค้าเรียบร้อยแล้ว",type:"success"});
        }
    });
}
function getCart(){
	setDefault();
	$.ajax({
        type: 'GET',
        url: config.base_url+'shop/api/shop_api/addToCart/0/?t='+Math.random()*99999,
        success: function (json) {
			var json = JSON.parse(json);
			cart_container.empty();
			cart_container.append(json.cart_item);
			cart_total_price.text(json.cart_total_price);
			cart_total_item.attr("data-amount",json.cart_total_item);
			wishlist_number.attr("data-amount",json.wishlist_number);
			inbox_number.attr("data-amount",json.inbox_number);
			/*var total_price = json.cart_total_price.replace(",","");
			total_price = total_price.replace("฿","");
			console.log(total_price);
			cart_total_price.animateNumber({ number: parseInt(total_price),numberStep: function(now, tween) {
        				var formatted = now.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, '$1,');
        				$(tween.elem).text('฿'+formatted);
			  		}
				},
				400
			  );*/
			
			checkCart();
        }
    });
}
function setDefault(){
	var product_qty = $(".product_qty").val();
	if(cart_item_default)cart_item_default.attr("product_qty",product_qty);
}
function checkCart(){
	addEventRemoveFromCart();
	setTimeout(function(){
		if(cart_container.children().length > 0){
			cart_buy_item.show();
		}else{
			cart_buy_item.hide();
		}
	},300);
}

function delivered($method,order_status){
	var message = "แน่ใจหรือว่าท่านต้องการเปลี่ยนสถานะคำสั่งซื้อ ?";
	
	if(order_status == 1){
		message = "โปรดตรวจสอบอีกครั้งว่ามีสินค้าตามคำสั่งซื้อพร้อมจัดส่ง ณ สถานที่ซึ่งผู้ซื้อนัดหมายไว้แล้ว แน่ใจหรือว่าท่านต้องการเปลี่ยนสถานะคำสั่งซื้อ";
	}else if(order_status == 2){
		message = "ท่านกำลังยืนยันว่าสินค้าได้จัดส่งออกจากสถานที่ของผู้ขายแล้ว แน่ใจหรือว่าท่านต้องการเปลี่ยนสถานะคำสั่งซื้อ";
	}else if(order_status == 3){
		message = "ท่านกำลังยืนยันว่าสินค้าได้ส่งถึงมือผู้ซื้อแล้ว โปรดเก็บรักษาหลักฐานการรับสินค้ากรณีอาจมีปัญหาร้องเรียน แน่ใจหรือว่าท่านต้องการเปลี่ยนสถานะคำสั่งซื้อ";
	}else if(order_status == 4){
		message = "โปรดตรวจสอบอีกครั้งว่ามีสินค้าตามคำสั่งซื้อพร้อมสำหรับการส่งมอบ ณ สถานที่ซึ่งตัวแทนนัดหมายไว้แล้ว แน่ใจหรือว่าท่านต้องการเปลี่ยนสถานะคำสั่งซื้อ";
	}else if(order_status == 5){
		message = "โปรดตรวจสอบอีกครั้งว่ามีสินค้าตามคำสั่งซื้อพร้อมสำหรับการส่งมอบ ณ สถานที่ซึ่งผู้ซื้อนัดหมายไว้แล้ว แน่ใจหรือว่าท่านต้องการเปลี่ยนสถานะคำสั่งซื้อ";
	}else if(order_status == 6){
		message = "ท่านกำลังยืนยันว่าสินค้าถูกส่งกลับคืนถึงมือผู้ขายแล้ว แน่ใจหรือว่าท่านต้องการเปลี่ยนสถานะคำสั่งซื้อ";
	}else if(order_status == 7){
		message = "ท่านกำลังยืนยันว่าผู้ซื้อไม่มารับมอบสินค้าจนพ้นกำหนดตามเงื่อนไขที่ตกลงกัน แน่ใจหรือว่าท่านต้องการเปลี่ยนสถานะคำสั่งซื้อ";
	}else if(order_status == 8){
		message = "ท่านกำลังยืนยันว่าได้รับการแก้ปัญหาเป็นที่พึงพอใจแล้ว จึงขอยกเลิกคำสั่งซื้อ และขอสละสิทธิเรียกร้องอื่นใดอีก แน่ใจหรือว่าท่านต้องการเปลี่ยนสถานะคำสั่งซื้อ";
	}else if(order_status == 9){
		message = "เพื่อแสดงความเห็นพ้องกัน ท่านสามารถแนะนำผู้ซื้อดำเนินการยกเลิกคำสั่งซื้อ แทนการเปลี่ยนสถานะที่ไม่พึงประสงค์นี้ได้ แน่ใจหรือว่าท่านต้องการเปลี่ยนสถานะคำสั่งซื้อ";
	}
	
	
	
	swal({
		title: "สถานะคำสั่งซื้อ",
		text: message,
		type: "info",
		showCancelButton: true,
		confirmButtonText:"ตกลง",
		cancelButtonText:"ยกเลิก"
	},
	function(isConfirm){
	  if(isConfirm) {
		window.location = $method;
	  }
	});
	
}
$(document).ready(function(){
	setDefault();		
	checkCart();
	getCart();
});
