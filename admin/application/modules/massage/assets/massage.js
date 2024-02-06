
var massageConfig = {
	massage_url:config.base_url+"massage/api/massage_api/getMassage",
	searchTable:"#search_table",
	datatable:"#massage_datatable",
};


function startDatatable(){
	massage_table = $(massageConfig.datatable).DataTable({
		"sPaginationType": "full_numbers",
		"dom": ' tpi', //lrtip
		"order": [[ 0, "desc" ]],
		"columns": [
			{"width": "20%" },
			{"width": "20%" },
			{"width": "20%" },
			{"width": "20%" },
			{"width": "20%" },
			// {"width": "20%" },


		],
		"ajax": {
			"url": massageConfig.massage_url,
				"data": function ( d ) {
			}
		}
	});
}

// search data
$(massageConfig.searchTable).on('keyup change', function () {
	massage_table.search(this.value).draw();
});


startDatatable();


