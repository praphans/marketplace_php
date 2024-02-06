
var defaultData = new Array();
var filtering = new Object();
var product_table;

var productConfig = {
	product_url:config.base_url+"product/api/product_api/getProduct",
	product_recommended_url:config.base_url+"product/api/product_api/setRecommended",

	searchTable:"#search_table",
	product_datatable:"#product_datatable",
	setfeature_container:"#setfeature_container",
	product_status_id:"#product_status_id",

};

function startDatatable(){
	product_table = $(productConfig.product_datatable).DataTable({
		"sPaginationType": "full_numbers",
		"dom": ' tpi', 
		"order": [[ 3, "desc" ]],
		"columns": [
				
				{"width": "10%" },
				{"width": "15%" },
				{"width": "10%" },
				{"width": "5%" },
				{"width": "10%" },
				{"width": "15%" },
				
				{"width": "10%" },
				{"width": "10%" },

		 ],
	});
}

function loadProduct(filtering){
	$.ajax({
		type: 'POST',
		data:filtering,
		url: productConfig.product_url,
		success: function(json){
			
			var json = JSON.parse(json);
			product_table.clear();
			for(var i = 0;i<json.data.length;i++){
				product_table.row.add(json.data[i]);
			}
			product_table.draw();
		}
	});
	
}

loadProduct(filtering);

function filteringOption(){
	
	var product_status_id = $(productConfig.product_status_id).val();
	filtering.product_status_id = parseInt(product_status_id);
	loadProduct(filtering);
	console.log(product_status_id);	
}


$(productConfig.searchTable).on('keyup change', function () {
	product_table.search(this.value).draw();
});

function initialize(store_id){
	
	productConfig.store_id = store_id;
	startDatatable();
}


$("#add_fearture").click(function(){
	var hasItemSelected = false;
	$(".chx_add_feature").each(function(index){
		if($(this).prop('checked')){
			hasItemSelected = true;
		}
	});
	if(hasItemSelected){
		loadModalSetFeatureInproduct();
	}else{
		swal("มีบางอย่างผิดพลาด","กรุณาเลือกอย่างน้อย 1 รายการ","info");
	}
});

function loadModalSetFeatureInproduct(){

	var product_id_list = new Array();
	$(".chx_add_feature").each(function(index){
		if($(this).prop('checked')){
			$(this).parent().parent().addClass("selected");
			var product_id = $(this).val();
			product_id_list.push(product_id);

		}
		
	});
	
	var post_data = new Object();
	post_data['product_id_list'] = product_id_list;

	$(productConfig.setfeature_container).empty();
	$(productConfig.setfeature_container).load(config.base_url+"product/myModalSetFeature/",post_data,function() {
		$("#myModalSetFeature").modal("show");
		
	});
}


$("#add_recommended").click(function(){
	var hasItemSelected = false;
	$(".chx_add_feature").each(function(index){
		if($(this).prop('checked')){
			hasItemSelected = true;
		}
	});
	if(hasItemSelected){

		swal({   
			title: "แน่ใจหรือ ?",   
			text: "ท่านแน่ใจหรือว่าต้องเพิ่มรายการนี้เป็นสินค้าแนะนำ !",   
			type: "warning",   
			showCancelButton: true, 
			cancelButtonText: "ยกเลิก",
			confirmButtonColor: "#1976d2",   
			confirmButtonText: "ใช่, ต้องการเพิ่ม !",   
			closeOnConfirm: true 
		}
		, function(){   
			$(".chx_add_feature").each(function(index){
				if($(this).prop('checked')){
					$(this).parent().parent().addClass("selected");
					var product_id = $(this).val();
					
					$.ajax({
						type: 'POST',
						data:{"product_id":product_id},
						url: productConfig.product_recommended_url,
						success: function(json){
							console.log("json : " + json);
							location.reload();
						}
					});
				}
			
			});
			
		});
	}else{
		swal("มีบางอย่างผิดพลาด","กรุณาเลือกอย่างน้อย 1 รายการ","info");
	}
});

