
var defaultData = new Array();
var filtering = new Object();
var news_table;

var dataList = new Array();

var newsConfig = {
	news_url:config.base_url+"news/api/news_api/getnews",
	news_delete_url:config.base_url+"news/api/news_api/deletenews",
	news_member_url:config.base_url+"news/api/news_api/getMember",

	searchTable:"#search_table",
	datatable:"#news_datatable",
	news_container:"#news_container",
	
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
	$(newsConfig.news_container).load(config.base_url+"news/myModalEditNews/"+id,function() {
		$("#myModalEditNews").modal("show");
	});
}
function startDatatable(){
	news_table = $(newsConfig.datatable).DataTable({
		"sPaginationType": "full_numbers",
		"dom": ' tpi', 
		
		"columns": [
				{"width": "5%" },
				{"width": "28%" },
				{"width": "20%" },
				{"width": "15%" },
				{"width": "12%" },
				{"width": "15%" },
				{"width": "5%" }
		 ],
	});
}


$(newsConfig.searchTable).on('keyup change', function () {
	news_table.search(this.value).draw();
});


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
				news_table.rows(".selected").remove().draw();
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

	$.ajax({
		type: 'POST',
	
		url: newsConfig.news_url,
		success: function(json){
		
			var json = JSON.parse(json);
			console.log("json : "+json);
			news_table.clear();
			for(var i = 0;i<json.data.length;i++){
				news_table.row.add(json.data[i]);
			}
			news_table.draw();
		}
	});
}


function initAutocomplete(){
	if($("#tags").length > 0 ){
		$("#tags").autocomplete({
			source: newsConfig.news_member_url,
			select: function (event, ui) {
				var member_id = ui.item.member_id;
				var first_name = ui.item.first_name;
				var last_name = ui.item.last_name;
				var email = ui.item.email;
				
				addValue(member_id,first_name,last_name);
			}
		}).data("ui-autocomplete")._renderItem = function (ul,item) {
			return $('<li></li>')
			.data("item.autocomplete", item)
			.append('<div href="javascript:void(0)"><div class="row d-flex justify-content-between"><div class="col-md-3"><div class="pl-3">'
				+item.first_name +' '+item.last_name +'</div></div><div class="col-md-7">'+item.email+
				'</div><div class="col-md-2"><div class="mdi mdi-plus-circle text-success text-right"></div></div></div></div>')
			.appendTo(ul);
		};
	}
}

function addValue(member_id,first_name,last_name){
	
	var member_name = 'เรียนคุณ : '+first_name+' '+last_name;
	$(".member_id").val(member_id);
	$(".member_name").text(member_name);

	console.log("member_id || "+member_id);
	console.log("member_name || "+member_name);

}




loadnews();
startDatatable();
initAutocomplete();


