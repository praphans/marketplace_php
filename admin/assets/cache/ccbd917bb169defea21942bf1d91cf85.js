
var defaultData = new Array();
var filtering = new Object();
var feature_table;

var dataList = new Array();

var featureConfig = {
	feature_url:config.base_url+"feature/api/feature_api/getFeature",
	feature_delete_url:config.base_url+"feature/api/feature_api/deleteFeature",
	searchTable:"#search_table",
	datatable:"#feature_datatable",
	feature_container:"#feature_container",
	
};


function loadModalEdit(featured_id){
	
	
	$(featureConfig.feature_container).empty();
	$(featureConfig.feature_container).load(config.base_url+"feature/myModalEditFeature/"+featured_id,function() {
		$("#myModalEditFeature").modal("show");
	});
}
function startDatatable(){
	feature_table = $(featureConfig.datatable).DataTable({
		"sPaginationType": "full_numbers",
		"dom": ' tpi', 
		
		"columns": [
				{"width": "5%" },
				{"width": "40%" },
				{"width": "15%" },
				{"width": "15%" },
				{"width": "15%" },
				{"width": "15%" },
				{"width": "10%" },

		 ],
	});
}


$(featureConfig.searchTable).on('keyup change', function () {
	feature_table.search(this.value).draw();
});


$("#del_feature").click(function(){
	var hasItemSelected = false;
	$(".chx_del_feature").each(function(index){
		if($(this).prop('checked')){
			hasItemSelected = true;
		}
	});
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
			
		}
		, function(){   
			$(".chx_del_feature").each(function(index){
				if($(this).prop('checked')){
					$(this).parent().parent().addClass("selected");
					feature_table.rows(".selected").remove().draw();
					var featured_id = $(this).val();
					$.ajax({
						type: 'POST',
						data:{"featured_id":featured_id},
						url: featureConfig.feature_delete_url,
						success: function(json){
							console.log("json : " + json);
						}
					});
				}
			
			});
			
		});
	}else{
		swal("มีบางอย่างผิดพลาด","กรุณาเลือกอย่างน้อย 1 รายการ","info");
	}
});


function loadFeature(){
	$.ajax({
		type: 'POST',
		url: featureConfig.feature_url,
		success: function(json){
		
			var json = JSON.parse(json);
			console.log("json : "+json);
			feature_table.clear();
			for(var i = 0;i<json.data.length;i++){
				feature_table.row.add(json.data[i]);
			}
			feature_table.draw();
		}
	});
}
loadFeature();
startDatatable();



