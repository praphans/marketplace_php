
var defaultData = new Array();
var filtering = new Object();
var itemstores_table;


var dataList = new Array();

var itemstoresConfig = {
	itemstores_url:config.base_url+"itemstores/api/itemstores_api/getItemstores",
	itemstores_info_url:config.base_url+"itemstores/api/itemstores_api/getItemstoresInfo",
	confirm_url:config.base_url+"itemstores/api/itemstores_api/confirmPayment",
	setting_account_url:config.base_url+"itemstores/api/itemstores_api/accountpayment",

	searchTable:"#search_table",
	itemstores_datatable:"#itemstores_datatable",
	itemstores_info_datatable:"#itemstores_info_datatable",
	itemstores_container:"#itemstores_container",

	
};

function numberWithCommas(x) {
	x = x.toFixed(2);
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function startDatatable(){
	itemstores_table = $(itemstoresConfig.itemstores_datatable).DataTable({
		"sPaginationType": "full_numbers",
		"dom": ' tpi', //lrtip
		// "order": [[ 3, "desc" ]],
		"columns": [

				{"width": "70%" },
				{"width": "15%" },
				{"width": "15%" },
		 ],
	});
}

function startDatatableInfo(seller_store_id,depositor_store_id){
	itemstores_info_table = $(itemstoresConfig.itemstores_info_datatable).DataTable({
		"sPaginationType": "full_numbers",
		"dom": ' tpi', //lrtip
		"order": [[ 0, "desc" ]],
		"columns": [

				{"width": "25%" },
				{"width": "25%" },
				{"width": "20%" },
				{"width": "25%" },
				{"width": "5%" },
		 ],

		"ajax": {
			"url": itemstoresConfig.itemstores_info_url,
			"type": "POST",
			"data": {'seller_store_id':seller_store_id,'depositor_store_id':depositor_store_id},
		},
		"initComplete": function(settings,json) {
			var sum_amount = json.sum_amount;
		    
		 	$(".sum_amount").empty();
		 	// $(".sum_amount").text("ยอดคงเหลือสุทธิ : "+numberWithCommas(sum_amount)+" บาท");

		},
		 
		 
	});
}


// search data
$(itemstoresConfig.searchTable).on('keyup change', function () {
	itemstores_table.search(this.value).draw();
});


function loadItemstores(){
	$.ajax({
		type: 'POST',
		// data:filtering,
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

startDatatable();
loadItemstores();
startDatatableInfo();


function loadModalView(seller_store_id,depositor_store_id){
	
	$(itemstoresConfig.itemstores_container).empty();
	$(itemstoresConfig.itemstores_container).load(config.base_url+"itemstores/itemStoresInfo/"+depositor_store_id+"/"+seller_store_id,function() {
		startDatatableInfo(seller_store_id,depositor_store_id);
		$("#myModalItemStoresInfo").modal("show");
		
	});
}


function confirm(tran_id,seller_store_id,depositor_store_id){
    $.ajax({
		type: 'POST',
		data:{"tran_id":tran_id},
		url: itemstoresConfig.confirm_url,
		success: function(json){
			 itemstores_info_table.ajax.reload();
		}
	});
}

function setttingAccount(){
	var amount = $(".amount_val").val();
	var seller_store_id = $(".seller_store_id_val").val();
	var depositor_store_id = $(".depositor_store_id_val").val();
	var data = {'amount':amount,'seller_store_id':seller_store_id,'depositor_store_id':depositor_store_id};

	if(amount < 0 || amount != ""){
		$.ajax({
			type: 'POST',
			data:data,
			url: itemstoresConfig.setting_account_url,
			success: function(json){
				 itemstores_info_table.ajax.reload();
				 $('.amount_val').val('');  
			}
		});
	}else{
		swal({title:"กรุณาระบุจำนวนเงิน !",html:true,text:"กรุณาระบุจำนวนเงินเพื่อปรับปรุงรายการทางบัญชี",type:"warning"});
	}

}