$("#store_is_vat").click(function(){
	var checked = $(this).prop("checked");		
	if(checked){
		store_is_vat = 1;
	}else{
		store_is_vat = 0;
	}
	$.ajax({
		type: 'POST',
		url: config.base_url+'store/api/registration_api/updateVat',
		data: {
			'store_is_vat': store_is_vat
		},
		success: function (json) {
			console.log(json);
			var json = JSON.parse(json);
		}
	});
});