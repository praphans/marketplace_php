
var defaultData = new Array();
var filtering = new Object();
var bank_table;

var dataList = new Array();

var bankConfig = {
	bank_url:config.base_url+"settings/api/bank_api/getBank",
	bank_delete_url:config.base_url+"settings/api/bank_api/deleteBank",
	searchTable:"#search_table",
	datatable:"#bank_datatable",
	bank_container:"#bank_container",
	
};

function loadModal(_method){
	$(bankConfig.bank_container).empty();
	$(bankConfig.bank_container).load(config.base_url+"settings/"+_method,function() {
		$("#"+_method).modal("show");
	});
}
function loadModalEdit(bank_id){
	console.log(bank_id);
	$(bankConfig.bank_container).empty();
	$(bankConfig.bank_container).load(config.base_url+"settings/myModalEditBank/"+bank_id,function() {
		$("#myModalEditBank").modal("show");
	});
}


function startDatatable(){
	
	bank_table = $(bankConfig.datatable).DataTable({
		"sPaginationType": "full_numbers",
		"dom": ' tpi', //lrtip
		"columns": [
				{"width": "5%" },
				{"width": "70%" },
				{"width": "15%" },
				{"width": "10%" },
		 ],
		"ajax": {
		"url": bankConfig.bank_url,
		"data": function ( d ) {
		}
	  }
	});

}


// search data
$(bankConfig.searchTable).on('keyup change', function () {
	bank_table.search(this.value).draw();
});



// Delete ข้อมูล
$("#del_bank").click(function(){
	var hasItemSelected = false;
	$(".chx_bank").each(function(index){
		if($(this).prop('checked')){
			hasItemSelected = true;
		}
	});
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
		}, function(){   
			$(".chx_bank").each(function(index){
				if($(this).prop('checked')){
					$(this).parent().parent().addClass("selected");
					bank_table.rows(".selected").remove().draw();
					// var bank_id = $(this).attr("bank_id");
					var bank_id = $(this).val();
					$.ajax({
						type: 'POST',
						data:{"bank_id":bank_id},
						url: bankConfig.bank_delete_url,
						success: function(json){
							console.log("json : "+json);
						}
					});
					// console.log("bank_id | "+bank_id);
				}
			});
		});
	}else{
		swal("มีบางอย่างผิดพลาด","กรุณาเลือกอย่างน้อย 1 รายการ","info");
	}
});


startDatatable();



