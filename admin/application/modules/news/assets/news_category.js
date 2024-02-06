
var defaultData = new Array();
var filtering = new Object();
var news_category_table;

var dataList = new Array();

var newsConfig = {
	news_url:config.base_url+"news/api/newsCategory_api/getNewsCategory",
	news_delete_url:config.base_url+"news/api/newsCategory_api/deleteNewsCategory",
	searchTable:"#search_table",
	datatable:"#news_category_table",
	news_container:"#news_category_container",
	
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
	$(newsConfig.news_container).load(config.base_url+"news/myModalEditNewsCategory/"+id,function() {
		$("#myModalEditNewsCategory").modal("show");
	});
}
function startDatatable(){
	news_category_table = $(newsConfig.datatable).DataTable({
		"sPaginationType": "full_numbers",
		"dom": ' tpi', //lrtip
		"columns": [
				// {"width": "5%" },
				{"width": "100%" },
				{"width": "10%" },
				{"width": "10%" },
		 ],
	});
}

// search data
$(newsConfig.searchTable).on('keyup change', function () {
	news_category_table.search(this.value).draw();
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
				news_category_table.rows(".selected").remove().draw();
				var id = $(this).val();
				$.ajax({
					type: 'POST',
					data:{"id":id},
					url: newsConfig.news_delete_url,
					success: function(json){
					
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
			news_category_table.clear();
			for(var i = 0;i<json.data.length;i++){
				news_category_table.row.add(json.data[i]);
			}
			news_category_table.draw();
		}
	});
}
loadnews();
startDatatable();


function delCat(id,not_del){

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
			// alert(id);
			window.location = config.base_url+"news/delNewsCatagory/"+id;
		});

		
	}else if(hasItemSelected_del){
		swal("มีบางอย่างผิดพลาด","หมวดหมู่นี้ไม่สามารถลบได้เนื่องจากมีรายการใช้งานอยู่ !","info");
	}else{
		swal("มีบางอย่างผิดพลาด","ไม่สามารถลบรายการได้","info");
	}
}


