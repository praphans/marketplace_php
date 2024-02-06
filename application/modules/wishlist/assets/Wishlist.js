var view_container = $("#view_container");
var filter = new Object();
filter.view_page_number = 0;
function onFilteringOption(_this){
	
	filter.view_type = $("#view_type").val();
	filter.view_per_page = $("#view_per_page").val();
	//filter.view_follower = ($("#view_follower").prop("checked"))?$("#view_follower").prop("checked"):0;
	filter.main_category_id = $("#main_category_id").val();
	filter.sub_category_id = $("#sub_category_id").val();
	
	filter.new_product = ($("#new_product").prop("checked"))?$("#new_product").val():0;
	filter.second_hand_product = ($("#second_hand_product").prop("checked"))?$("#second_hand_product").val():0;
	filter.gateway_type_1 = ($("#gateway_type_1").prop("checked"))?$("#gateway_type_1").val():0;
	filter.gateway_type_2 = ($("#gateway_type_2").prop("checked"))?$("#gateway_type_2").val():0;
	filter.gateway_type_3 = ($("#gateway_type_3").prop("checked"))?$("#gateway_type_3").val():0;
	
	filter.store_id_list = new Array();
	$(".store_id_list").each(function(){
		if($(this).prop("checked")){
			filter.store_id_list.push($(this).val());	
		}
	});
	
	filter.is_delivery = $("#is_delivery").val();
	filter.no_delivery = $("#no_delivery").val();
	
	
	if(_this){
		filter.view_page_number = parseInt($(_this).attr("data-ci-pagination-page"));
		if(!filter.view_page_number)filter.view_page_number = parseInt($(_this).text());	
		filter.view_page_number = filter.view_page_number-1;
		//filter.view_page_number = filter.view_page_number-1;
	}
	
	
	loadWishlist();
}
function loadWishlist(){
	console.log(config.base_url+'wishlist/api/wishlist_api/getWishlist/');
	//console.log(filter);
	if(filter.view_follower){
		filter.view_follower = 1;
	}else{
		filter.view_follower
	}
	if(filter.view_vat){
		filter.view_vat = 1;
	}else{
		filter.view_vat = 0;
	}
	$.ajax({
        type: 'POST',
        url: config.base_url+'wishlist/api/wishlist_api/getWishlist',
        data: filter,
        success: function (json) {
			view_container.empty();
			view_container.append(json);
			paginationJS();
			//var json = JSON.parse(json);
			//swal({title:"โปรโมชั่น",html:true,text:"บันทึกหมวดหมู่ของสินค้าเรียบร้อยแล้ว",type:"success"});
        }
    });
}
function paginationJS(){
	console.log("###########################################");
	console.log(filter);
	$(".pagination li a").each(function(){
		$(this).parent().removeClass("active");
		$(this).removeAttr("href");
		$(this).attr("onclick","onFilteringOption(this)");
		var page_number = parseInt($(this).attr("data-ci-pagination-page"));
		if(!page_number)page_number = parseInt($(this).text());	
		
	
		var prev = $(this).attr("rel");
		var next = $(this).attr("rel");
		
		//console.log(page_number+" : "+(filter.view_page_number+1));
		if(page_number == (filter.view_page_number+1) && prev != "prev" && next != "next"){
			$(this).parent().addClass("active");
		}
	});
}
function initailize(){
	onFilteringOption();
}
$(function(){
	initailize();
});



$(function(){
	var isActive = false;
    var current = decodeURIComponent(location.pathname);
    $('.theme_category_wishlist dt a').each(function(){
        var $this = $(this);
		console.log($this.attr('href')+" : "+current);
        if(!isActive && $this.attr('href').indexOf(current) !== -1){
			//$this.addClass('active');
            $this.parent().addClass('active');
			$this.parent().next().css("display","block");
			isActive = true;
        }else{
			$this.parent().removeClass('active');
		}
    })
	$('.theme_category_wishlist dd a').each(function(){
        var $this = $(this);
		console.log($this.attr('href')+" : "+current);
        if(!isActive && $this.attr('href').indexOf(current) !== -1){
            //$this.addClass('active');
			$this.parent().parent().parent().prev().addClass('active');
			$this.parent().parent().parent().css("display","block");
			isActive = true;
        }else{
			//$this.parent().removeClass('active');
		}
    })
})

