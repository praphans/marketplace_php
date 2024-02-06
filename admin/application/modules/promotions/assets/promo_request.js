
var defaultData = new Array();
var filtering = new Object();
var promo_request_table;

var dataList = new Array();

var promoRequestConfig = {
	promo_request_url:config.base_url+"promotions/api/promo_request_api/getPromoRequest",
	category_delete_url:config.base_url+"promotions/api/promo_wabsite_api/deletegetPromoRequest",
	searchTable:"#search_table",
	datatable:"#promo_request_datatable",

	
};


function startDatatable(){
	promo_request_table = $(promoRequestConfig.datatable).DataTable({
		"sPaginationType": "full_numbers",
		"dom": ' tpi', //lrtip
		"order": [[ 0, "desc" ]],
		"columns": [
				// {"width": "10%" },
				{"width": "20%" },
				{"width": "20%" },
				{"width": "10%" },
				{"width": "10%" },
				// {"width": "15%" },
				// {"width": "15%" },
				{"width": "10%" },
				{"width": "10%" },
				{"width": "10%" },

		 ],
	});
}

// search data
$(promoRequestConfig.searchTable).on('keyup change', function () {
	promo_request_table.search(this.value).draw();
});


function loadPromoRequest(){
/* 	var data = {'settings_uid':settings_uid}; */
	$.ajax({
		type: 'POST',
	/* 	data:data, */
		url: promoRequestConfig.promo_request_url,
		success: function(json){
		
			var json = JSON.parse(json);
			console.log("json : "+json);
			promo_request_table.clear();
			for(var i = 0;i<json.data.length;i++){
				promo_request_table.row.add(json.data[i]);
			}
			promo_request_table.draw();
		}
	});
}
loadPromoRequest();
startDatatable();



