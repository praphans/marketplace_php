
var defaultData = new Array();
var filtering = new Object();
var setting_table;
var permission_table;

var dataList = new Array();

var settingsConfig = {
	settings_url:config.base_url+"settings/api/settings_api/getSetting",
	permission_url:config.base_url+"settings/api/settings_api/getPermission",
	setting_delete_url:config.base_url+"settings/api/settings_api/deleteSetting",
	searchTable:"#search_table",
	datatable:"#setting_datatable",
	permission_datatable:"#permission_datatable",
	settings_container:"#settings_container",
	permis_container:"#permis_container",
	
};

function loadModal(_method){
	$(settingsConfig.settings_container).empty();
	$(settingsConfig.settings_container).load(config.base_url+"settings/"+_method,function() {
		$("#"+_method).modal("show");
		// alert(_method);
	});
}
function loadModalEdit(id){
	console.log(id);
	$(settingsConfig.settings_container).empty();
	$(settingsConfig.settings_container).load(config.base_url+"settings/myModalEditSettings/"+id,function() {
		$("#myModalEditSettings").modal("show");
	});
}

function loadModalPermis(_method){
	$(settingsConfig.permis_container).empty();
	$(settingsConfig.permis_container).load(config.base_url+"settings/"+_method,function() {
		$("#"+_method).modal("show");
		// alert(_method);
	});
}
function loadModalEditPermis(user_type_id){
	$(settingsConfig.permis_container).empty();
	$(settingsConfig.permis_container).load(config.base_url+"settings/myModalEditPermission/"+user_type_id,function() {
		$("#myModalEditPermission").modal("show");
		// alert(user_type_id);
	});
}
function startDatatable(){
	setting_table = $(settingsConfig.datatable).DataTable({
		"sPaginationType": "full_numbers",
		"dom": ' tpi', //lrtip
		"columns": [
				{"width": "5%" },
				{"width": "35%" },
				{"width": "30%" },
				{"width": "15%" },
				{"width": "15%" }
		 ],
	});
}

function startDatatablePermis(){
	permission_table = $(settingsConfig.permission_datatable).DataTable({
		"sPaginationType": "full_numbers",
		"dom": ' tpi', //lrtip
		"columns": [
				// {"width": "5%" },
				{"width": "70%" },
				{"width": "15%" },
				{"width": "15%" },
		 ],
		"ajax": {
		"url": settingsConfig.permission_url,
		"data": function ( d ) {
		}
	  }
	});
}

// search data
$(settingsConfig.searchTable).on('keyup change', function () {
	setting_table.search(this.value).draw();
	permission_table.search(this.value).draw();
});

// Delete ข้อมูล
$("#del_store").click(function(){

	swal({   
		title: "แน่ใจหรือ ?",   
		text: "ท่านแน่ใจหรือว่าต้องการลบข้อมูล !",   
		type: "warning",   
		showCancelButton: true, 
		cancelButtonText: "ยกเลิก",
		confirmButtonColor: "#DD6B55",   
		confirmButtonText: "ใช่, ต้องการลบ !",   
		closeOnConfirm: true 
		
	}
	, function(){   
		$(".del_store").each(function(index){
			if($(this).prop('checked')){
				$(this).parent().parent().addClass("selected");
				setting_table.rows(".selected").remove().draw();
				var id = $(this).val();
				$.ajax({
					type: 'POST',
					data:{"id":id},
					url: settingsConfig.setting_delete_url,
					success: function(json){
						/* var json = JSON.parse(json);
						alert(json.success); */
						console.log("json : " + json);
					}
				});
			}
		
		});
		
	});
});

function loadSetting(){
/* 	var data = {'settings_uid':settings_uid}; */
	$.ajax({
		type: 'POST',
	/* 	data:data, */
		url: settingsConfig.settings_url,
		success: function(json){
		
			var json = JSON.parse(json);
			console.log("json : "+json);
			setting_table.clear();
			for(var i = 0;i<json.data.length;i++){
				setting_table.row.add(json.data[i]);
			}
			setting_table.draw();
		}
	});
}

loadSetting();
startDatatable();

startDatatablePermis();



function delTypy(user_type_id,not_del){

	var hasItemSelected = false;
	var hasItemSelected_del = false;
	if(not_del==1){
		hasItemSelected = true;
	}else{
		hasItemSelected_del = true;
	}
	if(hasItemSelected){
		swal({   
			title: "แน่ใจหรือ ?",   
			text: "ท่านแน่ใจหรือว่าต้องการลบข้อมูล !",   
			type: "warning",   
			showCancelButton: true, 
			cancelButtonText: "ยกเลิก",
			confirmButtonColor: "#DD6B55",   
			confirmButtonText: "ใช่, ต้องการลบ !",   
			closeOnConfirm: true 
		},function(){
			// alert(user_type_id);
			window.location = config.base_url+"settings/delPermis/"+user_type_id;
		});

		
	}else if(hasItemSelected_del){
		swal("มีบางอย่างผิดพลาด","ไม่สามารถลบได้เนื่องจากมีรายการใช้งานอยู่ !","info");
	}else{
		swal("มีบางอย่างผิดพลาด","ไม่สามารถลบรายการได้","info");
	}
}
