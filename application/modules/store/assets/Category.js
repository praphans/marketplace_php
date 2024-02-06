$("input[type='checkbox']").change(function(){
	var category_id = $(this).val();
	var category_status = $(this).prop("checked");
	if(category_status){
		category_status = 1; // เปิดใช้งาน
	}else{
		category_status = 2; // ปิดใช้งาน
	}
	$.ajax({
        type: 'POST',
        url: config.base_url+'store/api/category_api/updateCategory',
        data: {
            'category_id': category_id,
			'category_status': category_status
        },
        success: function (json) {
			console.log(json);
			var json = JSON.parse(json);
			
        }
    });
	
});
function delCategory(category_id){
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
		$.ajax({
			type: 'POST',
			url: config.base_url+'store/api/category_api/updateCategory',
			data: {
				'category_id': category_id,
				'category_status': 3
			},
			success: function (data) {
				console.log(data);
				window.location = config.base_url+'store/category';
			}	
		});
	
		
	});
}