
var defaultData = new Array();
var filtering = new Object();
var topup_table;
var account_table;
var use_coin_table;

var dataList = new Array();

var topupConfig = {
	topup_url:config.base_url+"topup/api/topup_api/getTopup",
	account_url:config.base_url+"topup/api/topup_api/getAccount",
	use_coin_url:config.base_url+"topup/api/topup_api/getUsecoin",

	searchTable:"#search_table",
	datatable:"#topup_datatable",
	topup_container:"#topup_container",
	account_datatable:"#account_datatable",
	account_container:"#account_container",
	use_coin_datatable:"#use_coin_datatable",
};


function startDatatable(){
	topup_table = $(topupConfig.datatable).DataTable({
		"sPaginationType": "full_numbers",
		"dom": ' tpi', 
		"order": [[ 0, "desc" ]],
		"columns": [
				{"width": "15%" },
				{"width": "20%" },
				{"width": "35%" },
				{"width": "15%" },
				{"width": "15%" },
		 ],
	});
}

function startDatatableAccount(){
	account_table = $(topupConfig.account_datatable).DataTable({
		"sPaginationType": "full_numbers",
		"dom": ' tpi', 
		
		"columns": [
				{"width": "55%" },
				{"width": "15%" },
				{"width": "15%" },
				{"width": "15%" },
		 ],
	});
}

function startDatatableUsecoin(){
	use_coin_table = $(topupConfig.use_coin_datatable).DataTable({
		"sPaginationType": "full_numbers",
		"dom": ' tpi', 
		"order": [[ 0, "desc" ]],
		"columns": [
				{"width": "55%" },
				{"width": "15%" },
				{"width": "15%" },
		 ],
	});
}


$(topupConfig.searchTable).on('keyup change', function () {
	topup_table.search(this.value).draw();
	account_table.search(this.value).draw();
});

function loadTopup(){
	$.ajax({
		type: 'POST',
		url: topupConfig.topup_url,
		success: function(json){
		
			var json = JSON.parse(json);
			console.log("json : "+json);
			topup_table.clear();
			for(var i = 0;i<json.data.length;i++){
				topup_table.row.add(json.data[i]);
			}
			topup_table.draw();
		}
	});
}

function loadAccount(){
	$.ajax({
		type: 'POST',
		url: topupConfig.account_url,
		success: function(json){
		
			var json = JSON.parse(json);
			console.log("json : "+json);
			account_table.clear();
			for(var i = 0;i<json.data.length;i++){
				account_table.row.add(json.data[i]);
			}
			account_table.draw();
		}
	});
}

function loadModal(_method){
	$(topupConfig.topup_container).empty();
	$(topupConfig.topup_container).load(config.base_url+"topup/"+_method,function() {
		$("#"+_method).modal("show");
	});
}


loadTopup();
loadAccount();
startDatatable();
startDatatableAccount();


function loadModalView(member_id){

	$(topupConfig.account_container).empty();
	$(topupConfig.account_container).load(config.base_url+"topup/myModalViewAccount/"+member_id,function() {
		$("#myModalViewAccount").modal("show");
		
		startDatatableUsecoin();
		loadUsecoin(member_id);
	});
}


function loadUsecoin(member_id){
	var data = {'member_id':member_id};
	
	$.ajax({
		type: 'POST',
		data:data,
		url: topupConfig.use_coin_url,
		success: function(json){
		
			var json = JSON.parse(json);
			console.log("json : "+json);
			use_coin_table.clear();
			for(var i = 0;i<json.data.length;i++){
				use_coin_table.row.add(json.data[i]);
			}
			use_coin_table.draw();
		}
	});
}

