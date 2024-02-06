var product_image_container = $("#product_image_container");

$("input:file").change(function (){
 	var input = this;
	if (input.files) {
		var filesAmount = input.files.length;
		for (i = 0; i < filesAmount; i++) {
			var reader = new FileReader();
			reader.onload = function(event) {
				var thumb = '<div class="col-md-3 col-sm-6 pd_add_img_box">'+
					'<div class="image_wrap">'+
						'<img src="'+event.target.result+'">'+
					'</div>'+
				'</div>';
				product_image_container.append(thumb);
			}
			reader.readAsDataURL(input.files[i]);
		}
	}
	$(this).parent().find(".custom-file-upload").addClass("active");
 });


$("#form_product_add").submit(function(){
	var is_uploaded = true;
	if(!$("#product_image").val()){
		is_uploaded = false;
	}
	if(!is_uploaded){
		swal("ข้อความจากระบบ","กรุณาอัพโหลดรูปสินค้าอย่างน้อย 1 รูป","info");
		return false;
	}
});
$("#form_product_edit").submit(function(){
	
});
function delProduct(product_id){
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
			url: config.base_url+'store/api/product_api/delProduct',
			data: {
				'product_id': product_id
			},
			success: function (data) {
				console.log(data);
				window.location = config.base_url+'store/products';
			}	
		});
	
		
	});
}


function delProductRelate(product_id,relate_id){
	// alert(relate_id);
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
			url: config.base_url+'store/api/product_api/delProduct',
			data: {
				'product_id': product_id,
			},
			success: function (data) {
				console.log(data);
				window.location = config.base_url+'store/products/relate/'+relate_id;
			}	
		});
	
		
	});
}
function delImage(image_id){
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
			url: config.base_url+'store/api/product_api/delImage',
			data: {
				'image_id': image_id
			},
			success: function (data) {
				console.log(data);
				$("#image_box"+image_id).remove();
			}	
		});
	
		
	});
}

function updateProductRecommend(product_id){
	var product_recommend = $("#product_recommend"+product_id).prop("checked");
	if(product_recommend){
		product_recommend = 1;
	}else{
		product_recommend = 0;
	}
	$.ajax({
        type: 'POST',
        url: config.base_url+'store/api/product_api/saveProductRecommend',
        data: {
            'product_id': product_id,
			'product_recommend': product_recommend
        },
        success: function (data) {
            //var data = JSON.parse(data);
			console.log(data);
        }	
    });
}

function updateProductShow(product_id){
	var product_show = $("#product_show"+product_id).prop("checked");
	if(product_show){
		product_show = 1;
	}else{
		product_show = 0;
	}
	$.ajax({
        type: 'POST',
        url: config.base_url+'store/api/product_api/saveProductShow',
        data: {
            'product_id': product_id,
			'product_show': product_show
        },
        success: function (data) {
            //var data = JSON.parse(data);
			console.log(data);
        }
    });
}

function loadSubCategory(){
	var product_category = $("#product_category").val();
	$.ajax({
        type: 'POST',
        url: config.base_url+'store/api/product_api/loadProductSubCategory',
        data: {
            'product_category': product_category
        },
        success: function (data) {
           var data = JSON.parse(data);
		   $("#product_subcategory").empty();
		   if(data.length<=0){
				$("#product_subcategory_row").hide();   
		   }else{
			   $("#product_subcategory_row").show();   
		   }
		   for(var i = 0;i<data.length;i++){
			   var id = data[i].id;
			   var category_name = data[i].category_name;  
			   var option = '<option value="'+id+'">'+category_name+'</option>';
			   if(id == product_subcategory){
				   option = '<option value="'+id+'" selected>'+category_name+'</option>';
			   }
			   $("#product_subcategory").append(option);
		   }
        }	
    });
}
$(document).ready(function(){
	$("#product_category").trigger("change");					   
});

