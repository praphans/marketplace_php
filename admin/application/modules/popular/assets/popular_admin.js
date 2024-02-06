
var defaultData = new Array();
var filtering = new Object();
var popular_table;

var popularConfig = {
	popular_url:config.base_url+"popular/api/popular_api/getPopular",

	searchTable:"#search_table",
	popular_datatable:"#popular_datatable",

};

function startDatatable(){
	popular_table = $(popularConfig.popular_datatable).DataTable({
		"sPaginationType": "full_numbers",
		"dom": ' tpi', //lrtip
		"order": [[ 0, "desc" ]],
		"columns": [
				{"width": "10%" },
				{"width": "15%" },
				{"width": "10%" },
				{"width": "10%" },
				{"width": "15%" },
				{"width": "10%" },
				{"width": "10%" },

		 ],
		"ajax": {
		"url": popularConfig.popular_url,
		"data": function ( d ) {
		}
	  }
	});
}

// search data
$(popularConfig.searchTable).on('keyup change', function () {
	popular_table.search(this.value).draw();
});

startDatatable();