
var defaultData = new Array();
var filtering = new Object();
var promo_website_table;

var dataList = new Array();

var promoWebsiteConfig = {
	promo_website_url:config.base_url+"promotions/api/promo_wabsite_api/getPromoWebsite",
	category_delete_url:config.base_url+"promotions/api/promo_wabsite_api/deletegetPromoWebsite",
	searchTable:"#search_table",
	datatable:"#promo_website_datatable",
	promo_website_container:"#promo_website_container",
	
};


function loadModalPromoWebEdit(promo_id){

	$(promoWebsiteConfig.promo_website_container).empty();
	$(promoWebsiteConfig.promo_website_container).load(config.base_url+"promotions/promo_website/myModalEditPromoWeb/"+promo_id,function() {
		$("#myModalEditPromoWebsite").modal("show");
		
	});
}
function startDatatable(){
	promo_website_table = $(promoWebsiteConfig.datatable).DataTable({
		"sPaginationType": "full_numbers",
		"dom": ' tpi', 
		"columns": [
				{"width": "5%" },
				{"width": "45%" },
				{"width": "25%" },
				{"width": "10%" },
				{"width": "15%" },

		 ],
	});
}


$(promoWebsiteConfig.searchTable).on('keyup change', function () {
	promo_website_table.search(this.value).draw();
});



$("#del_promo_web").click(function(){
	var hasItemSelected = false;
	$(".del_promo_website").each(function(index){
		if($(this).prop('checked')){
			hasItemSelected = true;
		}
	});
	if(hasItemSelected){
		swal({   
			title: "แน่ใจหรือ ?",   
			text: "ท่านแน่ใจหรือว่าต้องการลบข้อมูล !",   
			type: "warning",   
			showCancelButton: true, 
			cancelButtonText: "ยกเลิก",
			confirmButtonColor: "#DD6B55",   
			confirmButtonText: "ใช่, ต้องการลบ !",   
			closeOnConfirm: true 
		}, function(){   
			$(".del_promo_website").each(function(index){
				if($(this).prop('checked')){
					$(this).parent().parent().addClass("selected");
					promo_website_table.rows(".selected").remove().draw();
					var promo_id = $(this).attr("promo_id");
					
					$.ajax({
						type: 'POST',
						data:{"promo_id":promo_id},
						url: promoWebsiteConfig.category_delete_url,
						success: function(json){
							console.log("json : "+json);
						}
					});
				
				}
			});
		});
	}else{
		swal("มีบางอย่างผิดพลาด","กรุณาเลือกอย่างน้อย 1 รายการ","info");
	}
});


function loadPromoWebsite(){

	$.ajax({
		type: 'POST',
	
		url: promoWebsiteConfig.promo_website_url,
		success: function(json){
		
			var json = JSON.parse(json);
			console.log("json : "+json);
			promo_website_table.clear();
			for(var i = 0;i<json.data.length;i++){
				promo_website_table.row.add(json.data[i]);
			}
			promo_website_table.draw();
		}
	});
}
loadPromoWebsite();
startDatatable();



