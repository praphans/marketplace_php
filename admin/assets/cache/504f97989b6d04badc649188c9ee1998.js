
var defaultData = new Array();
var filtering = new Object();
var promotion_table;

var dataList = new Array();

var promotionsConfig = {
	promotions_url:config.base_url+"promotions/api/promotions_api/getPromotions",
	category_delete_url:config.base_url+"promotions/api/promotions_api/deletePromotions",
	searchTable:"#search_table",
	datatable:"#promotion_datatable",
	promotions_container:"#promotions_container",
	
};

function loadModal(_method){
	$(promotionsConfig.promotions_container).empty();
	$(promotionsConfig.promotions_container).load(config.base_url+"promotions/"+_method,function() {
		$("#"+_method).modal("show");
	});
}
function loadModalEdit(id){
	console.log(id);
	$(promotionsConfig.promotions_container).empty();
	$(promotionsConfig.promotions_container).load(config.base_url+"promotions/myModalEditPromotions/"+id,function() {
		$("#myModalEditPromotions").modal("show");
	});
}
function startDatatable(){
	promotion_table = $(promotionsConfig.datatable).DataTable({
		"sPaginationType": "full_numbers",
		"dom": ' tpi', 
		"columns": [
				{"width": "5%" },
				{"width": "20%" },
				
				{"width": "10%" },
				{"width": "10%" },
				{"width": "15%" },
				{"width": "15%" },
				{"width": "10%" },
				{"width": "5%" },
		 ],
	});
}


$(promotionsConfig.searchTable).on('keyup change', function () {
	promotion_table.search(this.value).draw();
});


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
				promotion_table.rows(".selected").remove().draw();
				var join_id = $(this).val();
				$.ajax({
					type: 'POST',
					data:{"join_id":join_id},
					url: promotionsConfig.category_delete_url,
					success: function(json){
						
						console.log("json : " + json);
					}
				});
			}
		
		});
		
	});
});

function loadPromotions(){

	$.ajax({
		type: 'POST',
	
		url: promotionsConfig.promotions_url,
		success: function(json){
		
			var json = JSON.parse(json);
			console.log("json : "+json);
			promotion_table.clear();
			for(var i = 0;i<json.data.length;i++){
				promotion_table.row.add(json.data[i]);
			}
			promotion_table.draw();
		}
	});
}
loadPromotions();
startDatatable();



