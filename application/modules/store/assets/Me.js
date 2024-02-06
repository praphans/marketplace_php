var product_image_container = $("#product_image_container");

$("input:file").change(function (){
 	var input = this;
	var img = $(input).attr("id");
	
	if (input.files) {
		var filesAmount = input.files.length;
		for (i = 0; i < filesAmount; i++) {
			var reader = new FileReader();
			reader.onload = function(event) {
				$("."+img).attr("src",event.target.result);
			}
			reader.readAsDataURL(input.files[i]);
		}
	}
	$(this).parent().find(".custom-file-upload").addClass("active");
 });

$("#form_me").submit(function(){
	var is_uploaded = true;
	if(!$("#product_image").val()){
		is_uploaded = false;
	}
	if(!is_uploaded){
		swal("ข้อความจากระบบ","กรุณาอัพโหลดรูปสินค้าอย่างน้อย 1 รูป","info");
		return false;
	}
});