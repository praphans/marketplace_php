
var defaultData = new Array();
var filtering = new Object();
var news_tags_table;

var dataList = new Array();

var newsConfig = {
	news_url:config.base_url+"news/api/newsTags_api/getNewsTags",
	news_delete_url:config.base_url+"news/api/newstags_api/deleteNewsTags",
	searchTable:"#search_table",
	datatable:"#news_tags_table",
	news_container:"#news_tags_container",
	
};

function loadModal(_method){
	$(newsConfig.news_container).empty();
	$(newsConfig.news_container).load(config.base_url+"news/"+_method,function() {
		$("#"+_method).modal("show");
	});
}
function loadModalEdit(id){
	console.log(id);
	$(newsConfig.news_container).empty();
	$(newsConfig.news_container).load(config.base_url+"news/myModalEditNewsTags/"+id,function() {
		$("#myModalEditNewsTags").modal("show");
	});
}
function startDatatable(){
	news_tags_table = $(newsConfig.datatable).DataTable({
		"sPaginationType": "full_numbers",
		"dom": ' tpi', //lrtip
		"columns": [
				{"width": "5%" },
				{"width": "100%" },
				{"width": "5%" }
		 ],
	});
}

// search data
$(newsConfig.searchTable).on('keyup change', function () {
	news_tags_table.search(this.value).draw();
});

// Delete ข้อมูล
$("#del_news").click(function(){

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
		$(".del_news").each(function(index){
			if($(this).prop('checked')){
				$(this).parent().parent().addClass("selected");
				news_tags_table.rows(".selected").remove().draw();
				var id = $(this).val();
				$.ajax({
					type: 'POST',
					data:{"id":id},
					url: newsConfig.news_delete_url,
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

function loadnews(){
/* 	var data = {'settings_uid':settings_uid}; */
	$.ajax({
		type: 'POST',
	/* 	data:data, */
		url: newsConfig.news_url,
		success: function(json){
		
			var json = JSON.parse(json);
			console.log("json : "+json);
			news_tags_table.clear();
			for(var i = 0;i<json.data.length;i++){
				news_tags_table.row.add(json.data[i]);
			}
			news_tags_table.draw();
		}
	});
}
loadnews();
startDatatable();



