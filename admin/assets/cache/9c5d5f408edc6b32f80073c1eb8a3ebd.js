
var defaultData = new Array();
var filtering = new Object();
var review_table;
var history_table;

var orderConfig = {
	order_url:config.base_url+"order/api/order_api/getOrder",
	history_url:config.base_url+"order/api/order_api/getViewHistory",

	searchTable:"#search_table",
	order_datatable:"#order_datatable",
	order_status_id:"#order_status_id",
	history_container:".history_container",
	history_datatable:"#history_datatable",

};

function startDatatable(){
	order_table = $(orderConfig.order_datatable).DataTable({
		"sPaginationType": "full_numbers",
		"dom": ' tpi', 
		"order": [[ 0, "desc" ]],
		"columns": [
			
				{"width": "15%" },
				{"width": "15%" },
				{"width": "20%" },
				{"width": "20%" },
				{"width": "10%" },
				
				{"width": "10%" },
				{"width": "10%" },

		 ],
		"ajax": {
		"url": orderConfig.order_url,
		"data": function ( d ) {
		}
	  }
	});
}


function startDatatableHistory(){
	history_table = $(orderConfig.history_datatable).DataTable({
		"sPaginationType": "full_numbers",
		"dom": ' tpi', 
		"columns": [
				{"width": "60%" },
				{"width": "40%" },

		 ]
	});
}



$(orderConfig.searchTable).on('keyup change', function () {
	order_table.search(this.value).draw();
});

function filteringOption(){
	
	var order_status_id = $(orderConfig.order_status_id).val();
	filtering.order_status_id = parseInt(order_status_id);
	loadOrder(filtering);
	console.log(filtering);	
}

function loadOrder(filtering){
	$.ajax({
		type: 'POST',
		data:filtering,
		url: orderConfig.order_url,
		success: function(json){
			
			var json = JSON.parse(json);
			order_table.clear();
			for(var i = 0;i<json.data.length;i++){
				order_table.row.add(json.data[i]);
			}
			order_table.draw();
		}
	});
	
}


startDatatable();

function myModalView(order_id){
	
	$(orderConfig.history_container).empty();
	$(orderConfig.history_container).load(config.base_url+"order/myModalViewHistory/"+order_id,function() {
		$("#myModalViewHistory").modal("show");
		
	});
}

function loadHistory(order_id){
	var data = {'order_id':order_id};
	$.ajax({
		type: 'POST',
		data:data,
		url: orderConfig.history_url,
		success: function(json){
			
			
			var json = JSON.parse(json);
			history_table.clear();
			for(var i = 0;i<json.data.length;i++){
				history_table.row.add(json.data[i]);
			}
			history_table.draw();
		}
	});
}
