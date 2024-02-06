
var defaultData = new Array();
var filtering = new Object();
var permission_store_table;

var permission_storeConfig = {
	permission_store_url:config.base_url+"promotions/api/permission_store_api/getPermission_store",
	add_permis_store_url:config.base_url+"promotions/api/permission_store_api/addPermisStore",
	searchTable:"#search_table",
	datatable:"#permission_store_datatable",
	
};

function startDatatable(){
	
	permission_store_table = $(permission_storeConfig.datatable).DataTable({
		"sPaginationType": "full_numbers",
		"pageLength": 25,
		"dom": ' tpi', //lrtip
		"order": [[ 1, "desc" ]],
		"columns": [
				{"width": "5%" },
				{"width": "10%" },
				{"width": "10%" },
				{"width": "20%" },
				{"width": "10%" },
				{"width": "10%" },
				{"width": "15%" },
				{"width": "15%" },
		 ],
		"drawCallback": function(data) {
			initCheckedEvent();
	    }

	});
}

// search data
$(permission_storeConfig.searchTable).on('keyup change', function () {
	permission_store_table.search(this.value).draw();
});

function loadPermissionStore(join_id){
	var data = {'join_id':join_id};
	$.ajax({
		type: 'POST',
		data:data,
		url: permission_storeConfig.permission_store_url,
		success: function(json){
			var json = JSON.parse(json);
			permission_store_table.clear();
			for(var i = 0;i<json.data.length;i++){
				permission_store_table.row.add(json.data[i]);
			}
			permission_store_table.draw();
			initCheckedEvent();
		}
	});
}

startDatatable();
//loadPermissionStore();

// // add_jion_promo ข้อมูล

var hasChange = false;
function initCheckedEvent(){
	$(".chx_jion_promo").each(function(index){
		$(this).click(function(){
			if($(this).prop('checked')){
				$(this).parent().parent().addClass("selected");
				saveIt(this,1);
			}else{
				$(this).parent().parent().removeClass("selected");
				saveIt(this,0);
			}	
			hasChange = true;
			
		})
	});	
}


$("#add_jion_promo").click(function(){
	
	swal({   
		title: "แน่ใจหรือ ?",   
		text: "ท่านแน่ใจหรือว่าต้องการอนุญาตการเข้าร่วม !",   
		type: "warning",   
		showCancelButton: true, 
		cancelButtonText: "ยกเลิก",
		confirmButtonColor: "#1976d2",   
		confirmButtonText: "ใช่, บันทึก !",   
		closeOnConfirm: true 
	}, function(){
		location.reload();
		//saveIt();
	});
	
});

function saveIt(_this,isAdd = 1){

	var store_id = $(_this).val();
	var join_id = $(_this).attr("join_id");

	$.ajax({
		type: 'POST',
		data:{'isAdd':isAdd,'join_id':join_id,"store_id":store_id},
		url: permission_storeConfig.add_permis_store_url,
		success: function(json){
			var json = JSON.parse(json);
			console.log(json);
			// location.reload();

		}
	});
}
