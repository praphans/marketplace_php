
var defaultData = new Array();
var filtering = new Object();
var itemstores_table;

var dataList = new Array();

var itemstoresConfig = {
	itemstores_url:config.base_url+"store/api/store_api/getItemstores",
	itemstores_info_url:config.base_url+"store/api/store_api/getItemstoresInfo",

	searchTable:"#search_table",
	itemstores_datatable:"#itemstores_datatable",
	itemstores_info_datatable:"#itemstores_info_datatable",
	itemstores_type_id:"#itemstores_type_id",
	itemstores_container:"#itemstores_container",

	
};

function startDatatable(){
	itemstores_table = $(itemstoresConfig.itemstores_datatable).DataTable({
		"sPaginationType": "full_numbers",
		"dom": ' tpi', //lrtip
		// "order": [[ 3, "desc" ]],
		"columns": [

				{"width": "70%" },
				{"width": "15%" },
				{"width": "15%" },
				// {"width": "15%" },
		 ],
	});
}

function startDatatableInfo(){
	itemstores_info_table = $(itemstoresConfig.itemstores_info_datatable).DataTable({
		"sPaginationType": "full_numbers",
		"dom": ' tpi', //lrtip
		"order": [[ 0, "desc" ]],
		"columns": [

				{"width": "20%" },
				{"width": "20%" },
				{"width": "20%" },
				{"width": "20%" },
		 ],
	});
}


// search data
$(itemstoresConfig.searchTable).on('keyup change', function () {
	itemstores_table.search(this.value).draw();
});


function loadItemstores(filtering){
	$.ajax({
		type: 'POST',
		data:filtering,
		url: itemstoresConfig.itemstores_url,
		success: function(json){
		
			var json = JSON.parse(json);
			console.log("json : "+json);
			itemstores_table.clear();
			for(var i = 0;i<json.data.length;i++){
				itemstores_table.row.add(json.data[i]);
			}
			itemstores_table.draw();
		}
	});
}


function filteringOption(){
	
	var itemstores_type_id = $(itemstoresConfig.itemstores_type_id).val();
	filtering.itemstores_type_id = parseInt(itemstores_type_id);
	filtering.store_id = parseInt(store_id);
	loadItemstores(filtering);
	console.log(filtering);	
	// console.log(store_id);	
}

// loadItemstores(filtering);
startDatatable();

function loadModalView(seller_store_id,depositor_store_id){
	
	$(itemstoresConfig.itemstores_container).empty();
	$(itemstoresConfig.itemstores_container).load(config.base_url+"store/itemStoresInfo/"+depositor_store_id+"/"+seller_store_id,function() {
		loadItemstoresInfo(seller_store_id,depositor_store_id);
		$("#myModalItemStoresInfo").modal("show");
		// console.log(depositor_store_id);
		// console.log(seller_store_id);
	});
}


function loadItemstoresInfo(seller_store_id,depositor_store_id){
	// console.log("seller_store_id |"+seller_store_id);
	// console.log("depositor_store_id |"+depositor_store_id);
	
	var data = {'seller_store_id':seller_store_id,'depositor_store_id':depositor_store_id};
	// console.log("data : "+data);
	$.ajax({
		type: 'POST',
		data:data,
		url: itemstoresConfig.itemstores_info_url,
		success: function(json){
		
			var json = JSON.parse(json);
			console.log("json : "+json);
			itemstores_info_table.clear();
			for(var i = 0;i<json.data.length;i++){
				itemstores_info_table.row.add(json.data[i]);
			}
			// console.log("data | "+data);
			itemstores_info_table.draw();
		}
	});
}


function setttingAccount(){
    var val_setting_account = $(".val_setting_account").val();
    console.log(val_setting_account);
}