
var defaultData = new Array();
var filtering = new Object();
var product_table;

var dataList = new Array();

var categoryConfig = {
	category_url:config.base_url+"category/api/category_product_subcategory_api/getProductSubcategory",
	category_delete_url:config.base_url+"category/api/category_product_subcategory_api/DeleteProductSubcategory",
	searchTable:"#search_table",
	datatable:"#sub_datatable",
	category_container:"#product_subcategory_container"
};


function startDatatable(){
	product_table = $(categoryConfig.datatable).DataTable({
		"sPaginationType": "full_numbers",
		"dom": ' tpi', //lrtip
		"order": [[ 4, "desc" ]],
		"columns": [
				// {"width": "5%" },
				{"width": "30%" },
				{"width": "35%" },
				{"width": "15%" },
				{"width": "10%" },
				{"width": "10%" },
		 ],
	});
}

// search data
$(categoryConfig.searchTable).on('keyup change', function () {
	product_table.search(this.value).draw();
});

// Delete ข้อมูล
$("#del_product").click(function(){

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
		$(".del_product").each(function(index){
			if($(this).prop('checked')){
				$(this).parent().parent().addClass("selected");
				product_table.rows(".selected").remove().draw();
				var id = $(this).val();
				$.ajax({
					type: 'POST',
					data:{"id":id},
					url: categoryConfig.category_delete_url,
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

function loadProdcut(){
/* 	var data = {'settings_uid':settings_uid}; */
	$.ajax({
		type: 'POST',
	/* 	data:data, */
		url: categoryConfig.category_url,
		success: function(json){
		
			var json = JSON.parse(json);
			console.log("json : "+json);
			product_table.clear();
			for(var i = 0;i<json.data.length;i++){
				product_table.row.add(json.data[i]);
			}
			product_table.draw();
		}
	});
}

function loadModal(_method){
	$(categoryConfig.category_container).empty();
	$(categoryConfig.category_container).load(config.base_url+"category/"+_method,function() {
		$("#"+_method).modal("show");
	});
}
function loadModalEdit(id){
	console.log(id);
	$(categoryConfig.category_container).empty();
	$(categoryConfig.category_container).load(config.base_url+"category/myModalEditproductSubcategory/"+id,function() {
		$("#myModalEditProductSubcategory").modal("show");
	});
}

loadProdcut();
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
			window.location = config.base_url+"category/delSubCatagory/"+id;
		});

		
	}else if(hasItemSelected_del){
		swal("มีบางอย่างผิดพลาด","หมวดหมู่นี้ไม่สามารถลบได้เนื่องจากมีรายการใช้งานอยู่ !","info");
	}else{
		swal("มีบางอย่างผิดพลาด","ไม่สามารถลบรายการได้","info");
	}
}
