
var defaultData = new Array();
var filtering = new Object();
var place_table;

var placeConfig = {
	place_url:config.base_url+"place/api/place_api/getPlace",

	searchTable:"#search_table",
	place_datatable:"#place_datatable",
	shipping_type_id:"#shipping_type_id",

};

function startDatatable(){
	place_table = $(placeConfig.place_datatable).DataTable({
		"sPaginationType": "full_numbers",
		"dom": ' tpi', //lrtip
		"columns": [
				{"width": "20%" },
				{"width": "40%" },
				{"width": "40%" },
				{"width": "10%" },
				// {"width": "15%" },


		 ],
		"ajax": {
		"url": placeConfig.place_url+'/'+placeConfig.current_shipping_type_id,
		"data": function ( d ) {
		}
	  }
	});
}

// search data
$(placeConfig.searchTable).on('keyup change', function () {
	place_table.search(this.value).draw();
});

function filteringOption(){
	
	var shipping_type_id = $(placeConfig.shipping_type_id).val();
	filtering.shipping_type_id = parseInt(shipping_type_id);
	loadPlace(filtering);


	console.log(filtering);	
}

function loadPlace(filtering){
	$.ajax({
		type: 'POST',
		data:filtering,
		url: placeConfig.place_url,
		success: function(json){
			// console.log("json : "+json);
			var json = JSON.parse(json);
			place_table.clear();
			for(var i = 0;i<json.data.length;i++){
				place_table.row.add(json.data[i]);
			}
			place_table.draw();
		}
	});
	// console.log('filtering || '+filtering);
}

function initialize(current_shipping_type_id){

	placeConfig.current_shipping_type_id = current_shipping_type_id;
	startDatatable();

	// var shipping_type_id = $(placeConfig.shipping_type_id).val();
	// if(current_shipping_type_id == shipping_type_id){
	// 	$("selected_type").addClass("selected");
	// }

}

// startDatatable();
