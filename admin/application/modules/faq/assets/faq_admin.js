
var defaultData = new Array();
var filtering = new Object();
var buy_table;
var faqCategory_table;

var faqConfig = {
	faq_url:config.base_url+"faq/api/faq_api/getFaqBuy",
	faq_seller_url:config.base_url+"faq/api/faq_api/getFaqSeller",
	faq_delete_url:config.base_url+"faq/api/faq_api/deleteFaq",
	
	faqCategory_url:config.base_url+"faq/api/faq_api/getfaqCategory",
	cat_delete_url:config.base_url+"faq/api/faq_api/deleteCat",

	searchTable:"#search_table",
	datatable:"#faqBuy_datatable",
	faqSell_datatable:"#faqSell_datatable",
	buy_container:"#buy_container",
	seller_container:"#seller_container",
	
	faq_cat_id:"#faq_cat_id",
	faqCategory_datatable:"#faqCategory_datatable",
	faqCategory_container:"#faqCategory_container",
	
};

function loadModalEditBuy(faq_id){
	$(faqConfig.buy_container).empty();
	$(faqConfig.buy_container).load(config.base_url+"faq/myModalEditFaqBuy/"+faq_id,function() {
		$("#myModalEditfaqBuy").modal("show");
		// alert(faq_id);
	});
}

function loadModalEditSeller(faq_id){
	$(faqConfig.seller_container).empty();
	$(faqConfig.seller_container).load(config.base_url+"faq/myModalEditFaqSeller/"+faq_id,function() {
		$("#myModalEditfaqSeller").modal("show");
		// alert(faq_id);
	});
}

function loadModalEditCat(faq_cat_id){
	// alert(faq_cat_id);
	$(faqConfig.faqCategory_container).empty();
	$(faqConfig.faqCategory_container).load(config.base_url+"faq/myModalEditfaqCat/"+faq_cat_id,function() {
		$("#myModalEditfaqCat").modal("show");
		// alert(faq_cat_id);
	});
}

function startDatatable(){
	buy_table = $(faqConfig.datatable).DataTable({
		"sPaginationType": "full_numbers",
		"dom": ' tpi', //lrtip
		"columns": [
				{"width": "5%" },
				{"width": "15%" },
				{"width": "25%" },
				{"width": "30%" },
				{"width": "15%" },
				{"width": "10%" },
		 ],
		"ajax": {
		"url": faqConfig.faq_url,
		"data": function ( d ) {
		}
	  }
	});

	seller_table = $(faqConfig.faqSell_datatable).DataTable({
		"sPaginationType": "full_numbers",
		"dom": ' tpi', //lrtip
		"columns": [
				{"width": "5%" },
				{"width": "15%" },
				{"width": "25%" },
				{"width": "30%" },
				{"width": "15%" },
				{"width": "10%" },
		 ],
		"ajax": {
		"url": faqConfig.faq_seller_url,
		"data": function ( d ) {
		}
	  }
	});

	faqCategory_table = $(faqConfig.faqCategory_datatable).DataTable({
		"sPaginationType": "full_numbers",
		"dom": ' tpi', //lrtip
		"order":[[1,"DESC"]],
		"columns": [
				// {"width": "5%" },
				{"width": "70%" },
				{"width": "15%" },
				{"width": "10%" },
				{"width": "10%" },

		 ],
		"ajax": {
		"url": faqConfig.faqCategory_url,
		"data": function ( d ) {
		}
	  }
	});
}

// search data
$(faqConfig.searchTable).on('keyup change', function () {
	buy_table.search(this.value).draw();
	seller_table.search(this.value).draw();
	faqCategory_table.search(this.value).draw();
});



// delete ข้อมูล
$("#del_faq_buy").click(function(){
	var hasItemSelected = false;
	$(".del_buy").each(function(index){
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
			$(".del_buy").each(function(index){
				if($(this).prop('checked')){
					$(this).parent().parent().addClass("selected");
					buy_table.rows(".selected").remove().draw();
					var faq_id = $(this).attr("faq_id");
					// var faq_id = $(this).val();
					$.ajax({
						type: 'POST',
						data:{"faq_id":faq_id},
						url: faqConfig.faq_delete_url,
						success: function(json){
							console.log("json : "+json);
						}
					});
				// console.log("faq_id : "+faq_id);
				}
			});
		});
	}else{
		swal("มีบางอย่างผิดพลาด","กรุณาเลือกอย่างน้อย 1 รายการ","info");
	}
});


$("#del_faq_seller").click(function(){
	var hasItemSelected = false;
	$(".del_seller").each(function(index){
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
			$(".del_seller").each(function(index){
				if($(this).prop('checked')){
					$(this).parent().parent().addClass("selected");
					seller_table.rows(".selected").remove().draw();
					var faq_id = $(this).attr("faq_id");
					// var faq_id = $(this).val();
					$.ajax({
						type: 'POST',
						data:{"faq_id":faq_id},
						url: faqConfig.faq_delete_url,
						success: function(json){
							console.log("json : "+json);
						}
					});
				// console.log("faq_id : "+faq_id);
				}
			});
		});
	}else{
		swal("มีบางอย่างผิดพลาด","กรุณาเลือกอย่างน้อย 1 รายการ","info");
	}
});




function filteringOption(){
	
	var faq_cat_id = $(faqConfig.faq_cat_id).val();
	filtering.faq_cat_id = parseInt(faq_cat_id);
	loadFaqBuy(filtering);
	console.log(filtering);	
}
function filteringOptionSeller(){
	
	var faq_cat_id = $(faqConfig.faq_cat_id).val();
	filtering.faq_cat_id = parseInt(faq_cat_id);
	loadFaqSeller(filtering);
	console.log(filtering);	
}

function loadFaqBuy(filtering){
	$.ajax({
		type: 'POST',
		data:filtering,
		url: faqConfig.faq_url,
		success: function(json){
			var json = JSON.parse(json);
			buy_table.clear();
			for(var i = 0;i<json.data.length;i++){
				buy_table.row.add(json.data[i]);
			}
			buy_table.draw();
		}
	});
}

function loadFaqSeller(filtering){
	$.ajax({
		type: 'POST',
		data:filtering,
		url: faqConfig.faq_seller_url,
		success: function(json){
			var json = JSON.parse(json);
			seller_table.clear();
			for(var i = 0;i<json.data.length;i++){
				seller_table.row.add(json.data[i]);
			}
			seller_table.draw();
		}
	});
}

startDatatable();


function delCat(faq_cat_id,not_del){

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
			// alert(faq_cat_id);
			window.location = config.base_url+"faq/delFaqCatagory/"+faq_cat_id;
		});

		
	}else if(hasItemSelected_del){
		swal("มีบางอย่างผิดพลาด","หมวดหมู่นี้ไม่สามารถลบได้เนื่องจากมีรายการใช้งานอยู่ !","info");
	}else{
		swal("มีบางอย่างผิดพลาด","ไม่สามารถลบรายการได้","info");
	}
}

$("#del_faq_cat").click(function(){
	var hasItemSelected = false;
	$(".chx_del_cat").each(function(index){
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
			$(".chx_del_cat").each(function(index){
				if($(this).prop('checked')){
					$(this).parent().parent().addClass("selected");
					faqCategory_table.rows(".selected").remove().draw();
					// var faq_id = $(this).attr("faq_id");
					var faq_cat_id = $(this).val();
					$.ajax({
						type: 'POST',
						data:{"faq_cat_id":faq_cat_id},
						url: faqConfig.cat_delete_url,
						success: function(json){
							console.log("json : "+json);
						}
					});
				// console.log("faq_id : "+faq_id);
				}
			});
		});
	}else{
		swal("มีบางอย่างผิดพลาด","กรุณาเลือกอย่างน้อย 1 รายการ","info");
	}
});

