var view_container = $("#view_container");
var filter = new Object();
filter.view_page_number = 0;
function onFilteringOption(_this){
	filter.view_type = $("#view_type").val();
	filter.view_per_page = $("#view_per_page").val();
	filter.view_store_url = $("#view_store_url").val();
	filter.view_category_id = $("#view_category_id").val();
	filter.view_subcategory_id = $("#view_subcategory_id").val();
	if(_this){
		filter.view_page_number = parseInt($(_this).attr("data-ci-pagination-page"));
		if(!filter.view_page_number)filter.view_page_number = parseInt($(_this).text());	
		filter.view_page_number = filter.view_page_number-1;
		
	}
	
	
	loadShop();
}
function loadShop(){
	console.log(config.base_url+'shop/api/shop_api/getProduct/'+filter.view_page_number);
	
	$.ajax({
        type: 'POST',
        url: config.base_url+'shop/api/shop_api/getProduct/'+filter.view_page_number,
        data: filter,
        success: function (json) {
			view_container.empty();
			view_container.append(json);
			paginationJS();
			$(window).trigger('resize');
        }
    });
}
function paginationJS(){
	
	$(".pagination li a").each(function(){
		$(this).parent().removeClass("active");
		$(this).removeAttr("href");
		$(this).attr("onclick","onFilteringOption(this)");
		var page_number = parseInt($(this).attr("data-ci-pagination-page"));
		if(!page_number)page_number = parseInt($(this).text());	
		
	
		var prev = $(this).attr("rel");
		var next = $(this).attr("rel");
		
		
		if(page_number == (filter.view_page_number+1) && prev != "prev" && next != "next"){
			console.log(page_number+" : "+(filter.view_page_number+1));
			$(this).parent().addClass("active");
		}
	});
}
function initailize(){
	onFilteringOption();
}
$(document).ready(function(){
	initailize();
});

