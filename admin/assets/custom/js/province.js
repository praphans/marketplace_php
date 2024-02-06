$('#province').change(function () {
    var province_id = $(this).find(':selected')[0].id;

    $.ajax({
        type: 'POST',
        url: config.base_url+'api/regmanage/amphures',
        data: {
            'province_id': province_id
        },
        success: function (data) {
            // the next thing you want to do 
            var data = JSON.parse(data);
            var $amphures = $('#amphures');
            $amphures.empty();

            for (var i = 0; i < data.length; i++) {
                if(S_amphures == data[i].amphur_name){
                    var selected = 'selected';
                }else{
                    var selected = '';
                }
                $amphures.append('<option id="' + data[i].amphur_id + '" value="' + data[i].amphur_name + '" >' + data[i].amphur_name + '</option>');
            }

            if(!data){
                $amphures.append('<option value="" selected>ทั้งหมด</option>');
            } 

            $amphures.change();


        }
    });
});

$('#amphures').change(function () {
    var province_id = $('#province').find(':selected')[0].id;
    var amphur_id = $(this).find(':selected')[0].id;
    //console.log(province_id); 
    $.ajax({
        type: 'POST',
        url: config.base_url+'api/regmanage/districts',
        data: {
            'province_id': province_id,
            'amphur_id': amphur_id
        },
        success: function (data) {
            // the next thing you want to do 
            var data = JSON.parse(data);
            //console.log(data);
            var $districts = $('#districts');
            $districts.empty();

            for (var i = 0; i < data.length; i++) {
                if(S_districts == data[i].district_name){
                    var selected = 'selected';
                }else{
                    var selected = '';
                }
                
                $districts.append('<option id=' + data[i].district_code + ' value=' + data[i].district_name + '>' + data[i].district_name + '</option>');
            }

            if(!data){
                $districts.append('<option value="" selected>ทั้งหมด</option>');
            }  
            $districts.change(); 
        }
    });
});

$('#districts').change(function () {
    var district_code = $('#districts').find(':selected')[0].id;
    //console.log(district_code);
    $.ajax({
        type: 'POST',
        url: config.base_url+'api/regmanage/zipcodes',
        data: {
            'district_code': district_code
        },
        success: function (data) {
            // the next thing you want to do 
            var data = JSON.parse(data);
            var $zipcode = $('#zipcode');
            
            if($zipcode.length > 0){
                $zipcode.val('');
                $zipcode.val(data[0].zipcode_name); 
            }
            
        }
    });
});

$('#province').change();