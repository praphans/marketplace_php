
var defaultData = new Array();
var filtering = new Object();
var store_table;

var dataList = new Array();

var storeConfig = {
	stores_url:config.base_url+"store/api/store_api/getStore",
	recom_stores_url:config.base_url+"store/api/store_api/getRecomStore",
	store_recom_url:config.base_url+"store/api/store_api/updateStatusStoreRecom",
	store_recom_update_url:config.base_url+"store/api/store_api/updateStoreRecom",
	searchTable:"#search_table",
	datatable:"#store_datatable",
	recom_datatable:"#recom_datatable",
	store_container:"#store_container",
	category_id:"#category_id",
	settings_partner:"#settings_partner",
	store_status_id:"#store_status_id",
	
};

function loadModal(_method){
	$(storeConfig.store_container).empty();
	$(storeConfig.store_container).load(config.base_url+"store/"+_method,function() {
		$("#"+_method).modal("show");
	});
}
function loadModalEdit(id){
	console.log(id);
	$(storeConfig.store_container).empty();
	$(storeConfig.store_container).load(config.base_url+"store/myModalEditstore/"+id,function() {
		$("#myModalEditstore").modal("show");
	});
}
function startDatatable(){
	store_table = $(storeConfig.datatable).DataTable({
		"sPaginationType": "full_numbers",
		"dom": ' tpi', //lrtip
		"order": [[ 3, "desc" ]],
		"columns": [
				// {"width": "5%" },
				{"width": "10%" },
				{"width": "20%" },
				{"width": "10%" },
				// {"width": "15%" },
				{"width": "10%" },
				{"width": "10%" },
				{"width": "15%" },
				// {"width": "15%" },
				{"width": "10%" },
				// {"width": "10%" },
				// {"width": "10%" },
				// {"width": "10%" },
				{"width": "10%" },
		 ],
	});

	recom_store_table = $(storeConfig.recom_datatable).DataTable({
		"sPaginationType": "full_numbers",
		"dom": ' tpi', //lrtip
		"order": [[ 3, "desc" ]],
		"columns": [
				{"width": "5%" },
				// {"width": "10%" },
				{"width": "10%" },
				{"width": "20%" },
				{"width": "10%" },
				{"width": "15%" },
				// {"width": "15%" },
				// {"width": "15%" },
				{"width": "10%" },
		 ],
	});
}


// search data
$(storeConfig.searchTable).on('keyup change', function () {
	store_table.search(this.value).draw();
	recom_store_table.search(this.value).draw();
});


function filteringOptionStore(){
	
	var store_status_id = $(storeConfig.store_status_id).val();
	filtering.store_status_id = parseInt(store_status_id);
	loadStore(filtering);
	console.log(filtering);	
}

function loadStore(filtering){
	$.ajax({
		type: 'POST',
		data:filtering,
		url: storeConfig.stores_url,
		success: function(json){
		
			var json = JSON.parse(json);
			console.log("json : "+json);
			store_table.clear();
			for(var i = 0;i<json.data.length;i++){
				store_table.row.add(json.data[i]);
			}
			store_table.draw();
		}
	});
}


function filteringOption(){
	
	var category_id = $(storeConfig.category_id).val();
	filtering.category_id = parseInt(category_id);
	loadStoreRecom(filtering);
	console.log(filtering);	
}



function loadStoreRecom(filtering){
	$.ajax({
		type: 'POST',
		data:filtering,
		url: storeConfig.recom_stores_url,
		success: function(json){
		
			var json = JSON.parse(json);
			console.log("json : "+json);
			recom_store_table.clear();
			for(var i = 0;i<json.data.length;i++){
				recom_store_table.row.add(json.data[i]);
			}
			recom_store_table.draw();
		}
	});
}


// add ร้านค้าแนะนำ 
$("#add_recommended_store").click(function(){

	swal({   
		title: "แน่ใจหรือ ?",   
		text: "ท่านแน่ใจหรือว่าต้องการบันทึกร้านค้าแนะนำ !",   
		type: "warning",   
		showCancelButton: true, 
		cancelButtonText: "ยกเลิก",
		confirmButtonColor: "#1976d2",   
		confirmButtonText: "ใช่, ต้องการบันทึก !",   
		closeOnConfirm: true 
	}, function(){   

		$(".add_recom_store").each(function(index){
			if(!$(this).prop('checked')){
				$(this).parent().addClass("selected");
				var store_id = $(this).val();
				$.ajax({
					type: 'POST',
					data:{"store_id":store_id},
					url: storeConfig.store_recom_url,
					success: function(json){
						location.reload();
						// console.log(data);
					}
				});
				// console.log("data1 | "+data);
			}
		});
		$(".add_recom_store").each(function(index){
			if($(this).prop('checked')){
				$(this).parent().addClass("selected");
				var store_id = $(this).val();
				$.ajax({
					type: 'POST',
					data:{"store_id":store_id},
					url: storeConfig.store_recom_update_url,
					success: function(json){
						location.reload();
						// console.log(data);
					}
				});
				// console.log("data2 | "+data);
				// console.log("store_id | "+store_id);
			}
		});
	});
	
});

function loadModalPartner(store_id){
	
	$(storeConfig.settings_partner).empty();
	$(storeConfig.settings_partner).load(config.base_url+"store/myModalPartner/"+store_id,function() {
		$("#myModalPartner").modal("show");
		// alert(store_id);
	});
}

loadStore(filtering);
loadStoreRecom();
startDatatable();



