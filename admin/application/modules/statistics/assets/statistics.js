
var defaultData = new Array();
var filtering = new Object();
var statistics_table;

var dataList = new Array();

var statisticsConfig = {

	stat_sale_url:config.base_url+"statistics/api/statistics_api/getProductSale",
	str_url:config.base_url+"statistics/api/statistics_api/getStorePopular",
	searchTable:"#search_table",
	datatable:"#statistics_datatable",
	stat_sale_datatable:"#stat_sale_datatable",
	str_datatable:"#str_datatable",
	
};


function startDatatable(){

	stat_sale_table = $(statisticsConfig.stat_sale_datatable).DataTable({
		"paging":false,
		"sPaginationType": "full_numbers",
		"pageLength": 5,
		"dom": ' tpl', //lrtip
		"order":[[4,"DESC"]],
		"columns": [
				{"width": "35%" },
				{"width": "15%" },
				{"width": "10%" },
				{"width": "20%" },
				{"width": "25%" },


		 ],
	});


	store_table = $(statisticsConfig.str_datatable).DataTable({
		"paging":false,
		"sPaginationType": "full_numbers",
		"pageLength": 5,
		"dom": ' tpl', //lrtip
		"columns": [
				{"width": "40%" },
				{"width": "15%" },
				{"width": "25%" },
				{"width": "25%" },


		 ],
	});



}

// search data
$(statisticsConfig.searchTable).on('keyup change', function () {
	statistics_table.search(this.value).draw();
});



function loadStatSale(){

	$.ajax({
		type: 'POST',
		url: statisticsConfig.stat_sale_url,
		success: function(json){
		
			var json = JSON.parse(json);
			console.log("json : "+json);
			stat_sale_table.clear();
			for(var i = 0;i<json.data.length;i++){
				stat_sale_table.row.add(json.data[i]);
			}
			stat_sale_table.draw();
		}
	});
}

function loadStrPopular(){

	$.ajax({
		type: 'POST',
		url: statisticsConfig.str_url,
		success: function(json){
		
			var json = JSON.parse(json);
			console.log("json : "+json);
			store_table.clear();
			for(var i = 0;i<json.data.length;i++){
				store_table.row.add(json.data[i]);
			}
			store_table.draw();
		}
	});
}


loadStatSale();
startDatatable();
loadStrPopular();



