
var defaultData = new Array();
var filtering = new Object();
var member_table;

var memberConfig = {
	member_url:config.base_url+"member/api/member_api/getMember",

	searchTable:"#search_table",
	member_datatable:"#member_datatable",
	member_type_id:"#member_type_id",

};

function startDatatable(){
	member_table = $(memberConfig.member_datatable).DataTable({
		"sPaginationType": "full_numbers",
		"dom": ' tpi', 
		"order": [[ 0, "desc" ]],
		"columns": [
				{"width": "15%" },
				{"width": "25%" },
				{"width": "25%" },
				{"width": "10%" },
				{"width": "10%" },
				{"width": "15%" },
		 ],
		
	});
}


$(memberConfig.searchTable).on('keyup change', function () {
	member_table.search(this.value).draw();
});

function filteringOption(){
	
	var member_type_id = $(memberConfig.member_type_id).val();
	filtering.member_type_id = parseInt(member_type_id);
	loadMember(filtering);
	console.log(filtering);	
}

function loadMember(filtering){
	$.ajax({
		type: 'POST',
		data:filtering,
		url: memberConfig.member_url,
		success: function(json){
			
			var json = JSON.parse(json);
			member_table.clear();
			for(var i = 0;i<json.data.length;i++){
				member_table.row.add(json.data[i]);
			}
			member_table.draw();
		}
	});
	
}


loadMember();
startDatatable();
