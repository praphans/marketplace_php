
var defaultData = new Array();
var filtering = new Object();
var productset_table;

var productsetConfig = {
	productset_url:config.base_url+"productset/api/productset_api/getProduct",
	productset_recommended_url:config.base_url+"productset/api/productset_api/setRecommended",

	searchTable:"#search_table",
	productset_datatable:"#productset_datatable",
	setfeature_container:"#setfeature_container",

};

function startDatatable(){
	productset_table = $(productsetConfig.productset_datatable).DataTable({
		"sPaginationType": "full_numbers",
		"dom": ' tpi', //lrtip
		"order": [[ 4, "desc" ]],
		"columns": [
				{"width": "5%" },
				{"width": "10%" },
				{"width": "25%" },
				// {"width": "10%" },
				// {"width": "5%" },
				// {"width": "10%" },
				{"width": "20%" },
				{"width": "30%" },
				{"width": "10%" },
				// {"width": "10%" },

		 ],
		"ajax": {
		"url": productsetConfig.productset_url+'/'+productsetConfig.store_id,
		"data": function ( d ) {
		}
	  }
	});
}

// search data
$(productsetConfig.searchTable).on('keyup change', function () {
	productset_table.search(this.value).draw();
});

function initialize(store_id){
	
	productsetConfig.store_id = store_id;
	startDatatable();
}

// add Fearture ข้อมูล
// $("#add_fearture").click(function(){
// 	var hasItemSelected = false;
// 	$(".chx_add_feature").each(function(index){
// 		if($(this).prop('checked')){
// 			hasItemSelected = true;
// 		}
// 	});
// 	if(hasItemSelected){
// 		loadModalSetFeatureInproduct();
// 	}else{
// 		swal("มีบางอย่างผิดพลาด","กรุณาเลือกอย่างน้อย 1 รายการ","info");
// 	}
// });

// เปิด modals add Fearture 
// function loadModalSetFeatureInproduct(){

// 	var product_id_list = new Array();
// 	$(".chx_add_feature").each(function(index){
// 		if($(this).prop('checked')){
// 			$(this).parent().parent().addClass("selected");
// 			var product_id = $(this).val();
// 			product_id_list.push(product_id);

// 		}
	
// 	});
// 	var post_data = new Object();
// 	post_data['product_id_list'] = product_id_list;

// 	$(productsetConfig.setfeature_container).empty();
// 	$(productsetConfig.setfeature_container).load(config.base_url+"productset/myModalSetFeature/",post_data,function() {
// 		$("#myModalSetFeature").modal("show");
// 	});
// }


// เปิด modals add Fearture 
function loadModalSetFeature(product_id,product_featured){

	// alert("product_featured"+product_featured);
	$(productsetConfig.setfeature_container).empty();
	$(productsetConfig.setfeature_container).load(config.base_url+"productset/myModalSetFeature2/"+product_id+"/"+product_featured,function() {
		$("#myModalSetFeature").modal("show");
		// console.log("product_id | "+product_id);
	});
}

// add_recommended ข้อมูล
$("#add_recommended").click(function(){
	
	swal({   
		title: "แน่ใจหรือ ?",   
		text: "ท่านแน่ใจหรือว่าต้องเพิ่มรายการนี้เป็นสินค้าแนะนำ !",   
		type: "warning",   
		showCancelButton: true, 
		cancelButtonText: "ยกเลิก",
		confirmButtonColor: "#1976d2",   
		confirmButtonText: "ใช่, บันทึก !",   
		closeOnConfirm: true 
	}
	, function(){   
		var product_mode = "";
		$(".chx_add_feature").each(function(index){
			if($(this).prop('checked')){
				product_mode = 2;
				$(this).parent().parent().addClass("selected");
				var product_id = $(this).val();
				// alert(product_id);
				$.ajax({
					type: 'POST',
					data:{"product_id":product_id,"product_mode":product_mode},
					url: productsetConfig.productset_recommended_url,
					success: function(json){
						console.log("json : " + json);
						location.reload();
					}
				});
			}else{
				product_mode = 1;
				$(this).parent().parent().addClass("selected");
				var product_id = $(this).val();
				// alert(product_id);
				$.ajax({
					type: 'POST',
					data:{"product_id":product_id,"product_mode":product_mode},
					url: productsetConfig.productset_recommended_url,
					success: function(json){
						console.log("json : " + json);
						location.reload();
					}
				});
			}
		
		});
		
	});
	
});