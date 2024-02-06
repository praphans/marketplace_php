
var defaultData = new Array();
var filtering = new Object();
var review_table;

var reviewConfig = {
	review_url:config.base_url+"review/api/review_api/getReview",

	searchTable:"#search_table",
	review_datatable:"#review_datatable",
	review_type_id:"#review_type_id",

};

function startDatatable(){
	review_table = $(reviewConfig.review_datatable).DataTable({
		"sPaginationType": "full_numbers",
		"dom": ' tpi', 
		"order": [[ 0, "desc" ]],
		"columns": [
				{"width": "15%" },
				{"width": "10%" },
				{"width": "15%" },
				{"width": "15%" },
				{"width": "10%" },
				{"width": "25%" },
				{"width": "10%" },

		 ],
		"ajax": {
		"url": reviewConfig.review_url+'/'+reviewConfig.current_review_type_id+'/'+reviewConfig.current_store_id,
		"data": function ( d ) {
		}
	  }
	});
}


$(reviewConfig.searchTable).on('keyup change', function () {
	review_table.search(this.value).draw();
});

function filteringOption(){
	
	var review_type_id = $(reviewConfig.review_type_id).val();
	filtering.review_type_id = parseInt(review_type_id);
	filtering.store_id = parseInt(reviewConfig.current_store_id);
	loadReview(filtering);
	console.log(filtering);	
}

function loadReview(filtering){
	$.ajax({
		type: 'POST',
		data:filtering,
		url: reviewConfig.review_url,
		success: function(json){
			
			var json = JSON.parse(json);
			review_table.clear();
			for(var i = 0;i<json.data.length;i++){
				review_table.row.add(json.data[i]);
			}
			review_table.draw();
		}
	});
	
}

function initialize(current_review_type_id,current_store_id){
	
	reviewConfig.current_store_id = current_store_id;
	reviewConfig.current_review_type_id = current_review_type_id;
	
	startDatatable();
}


