
var defaultData = new Array();
var filtering = new Object();
var contactmassage_table;

var dataList = new Array();

var contactmassageConfig = {
	contactmassage_url:config.base_url+"contactmassage/api/contactmassage_api/getContactmassage",
	searchTable:"#search_table",
	datatable:"#contactmassage_datatable",
};


function startDatatable(){
	contactmassage_table = $(contactmassageConfig.datatable).DataTable({
		"sPaginationType": "full_numbers",
		"dom": ' tpi', //lrtip
		"columns": [
			{"width": "20%" },
			{"width": "20%" },
			{"width": "20%" },
			{"width": "20%" },
			{"width": "20%" },


		],
		"ajax": {
			"url": contactmassageConfig.contactmassage_url,
				"data": function ( d ) {
			}
		}
	});
}

// search data
$(contactmassageConfig.searchTable).on('keyup change', function () {
	contactmassage_table.search(this.value).draw();
});


startDatatable();


