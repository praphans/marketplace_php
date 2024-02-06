var view_container = $("#view_container");
var filter = new Object();
filter.view_page_number = 0;
function onFilteringOption(_this){
	filter.view_type = $("#view_type").val();
	filter.view_per_page = $("#view_per_page").val();
	filter.view_follower = ($("#view_follower").prop("checked"))?$("#view_follower").prop("checked"):0;
	filter.view_vat = $("#view_vat").prop("checked");
	filter.category_id = $("#category_id").val();
	
	if(_this){
		filter.view_page_number = parseInt($(_this).attr("data-ci-pagination-page"));
		if(!filter.view_page_number)filter.view_page_number = parseInt($(_this).text());	
		filter.view_page_number = filter.view_page_number-1;
		//filter.view_page_number = filter.view_page_number-1;
	}
	
	
	loadShop();
}
function loadShop(){
	console.log(config.base_url+'shop/api/shop_api/getShop/'+filter.view_page_number);
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
        url: config.base_url+'shop/api/shop_api/getShop/'+filter.view_page_number,
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
    $('.theme_category_shop li a').each(function(){
        var $this = $(this);
		
        if(!isActive && $this.attr('href').indexOf(current) !== -1){
			console.log($this.attr('href')+" : "+current);
			console.log($this.parent());
            $this.parent().addClass('active');
			isActive = true;
        }
    })
})