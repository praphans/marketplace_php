
var defaultData = new Array();
var filtering = new Object();
var slidebanner_table;

var dataList = new Array();

var slidebannerConfig = {
	slidebanner_url:config.base_url+"slidebanner/api/slidebanner_api/getSlidebanner",
	slidebanner_delete_url:config.base_url+"slidebanner/api/slidebanner_api/deleteBanner",
	searchTable:"#search_table",
	datatable:"#slidebanner_datatable",
	slidebanner_container:"#slidebanner_container",
	
};

function loadModal(_method){
	$(slidebannerConfig.slidebanner_container).empty();
	$(slidebannerConfig.slidebanner_container).load(config.base_url+"slidebanner/"+_method,function() {
		// alert("55");
		$("#"+_method).modal("show");
	});
}

function loadModalEdit(banner_id){
	console.log(banner_id);
	$(slidebannerConfig.slidebanner_container).empty();
	$(slidebannerConfig.slidebanner_container).load(config.base_url+"slidebanner/myModalEditSlidebanner/"+banner_id,function() {
		$("#myModalEditSlidebanner").modal("show");
	});
}

function startDatatable(){
	slidebanner_table = $(slidebannerConfig.datatable).DataTable({
		"sPaginationType": "full_numbers",
		"dom": ' tpi', //lrtip
		"order":[[0,"DESC"]],
		"columns": [
				{"width": "5%" },
				{"width": "40%" },
				{"width": "30%" },
				{"width": "10%" },
				{"width": "15%" },

		 ],
	});
}

// search data
$(slidebannerConfig.searchTable).on('keyup change', function () {
	slidebanner_table.search(this.value).draw();
});

function loadSlidebanner(){
/* 	var data = {'settings_uid':settings_uid}; */
	$.ajax({
		type: 'POST',
	/* 	data:data, */
		url: slidebannerConfig.slidebanner_url,
		success: function(json){
		
			var json = JSON.parse(json);
			console.log("json : "+json);
			slidebanner_table.clear();
			for(var i = 0;i<json.data.length;i++){
				slidebanner_table.row.add(json.data[i]);
			}
			slidebanner_table.draw();
		}
	});
}


// Delete ข้อมูล

$("#del_slidebanner").click(function(){
	var hasItemSelected = false;
	$(".del_banner").each(function(index){
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
		}, function(){   
			$(".del_banner").each(function(index){
				if($(this).prop('checked')){
					$(this).parent().parent().addClass("selected");
					slidebanner_table.rows(".selected").remove().draw();
					// var banner_id = $(this).attr("banner_id");
					var banner_id = $(this).val();
					// console.log("banner_id | "+banner_id);
					$.ajax({
						type: 'POST',
						data:{"banner_id":banner_id},
						url: slidebannerConfig.slidebanner_delete_url,
						success: function(json){
							console.log("json : "+json);
						}
					});
				
				}
			});
		});
	}else{
		swal("มีบางอย่างผิดพลาด","กรุณาเลือกอย่างน้อย 1 รายการ","info");
	}
});



loadSlidebanner();
startDatatable();



