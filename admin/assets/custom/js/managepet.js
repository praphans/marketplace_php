

if($('#petbirthday').length>0){
     $('#petbirthday').datepicker({
        format: 'dd/mm/yyyy',
        language:"th-th",
        todayHighlight:true,
        ignoreReadonly: true,
        autoclose: true
    });

    //$('#petbirthday').bootstrapMaterialDatePicker({ format : 'MM/DD/YYYY',weekStart : 0, time: false });
}
$('#pettype').change(function () {
    var pet_type_id = $(this).find(':selected')[0].id;
    
    $.ajax({
        type: 'POST',
        url: Config.base_url+'api/regmanage/petBreeds',
        data: {
            'pet_type_id': pet_type_id
        },
        success: function (data) {
            // the next thing you want to do 
            var data = JSON.parse(data);
             var $petbreeds = $('#petbreeds');
            $petbreeds.empty();

            for (var i = 0; i < data.length; i++) {
                $petbreeds.append('<option id=' + data[i].id + ' value=' + data[i].breed_th + '>' + data[i].breed_th + '</option>');
            }

            if(pet_type_id == '-1'){
                $petbreeds.append('<option value="ไม่ระบุ">ไม่ระบุ</option>');
            }
        }
    });
});

// START เพิ่มสัตว์เลี้ยง 
function InputImage(){   
    $("#my_file").click();
}

var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"];    
var myFile = document.getElementById('my_file');

if(myFile){
    //binds to onchange event of the input field
    myFile.addEventListener('change', function(event) {
        if (myFile.type == "file") {
            var sFileName = myFile.value;
            if (sFileName.length > 0) {
            
                if(myFile.files[0].size > Config.limitMb){
                    bootbox.alert('ไฟล์มีขนาดเกิน '+Config.maxMb+'Mb ');
                    input.value = "";
                    return false; 
                }
        
                var blnValid = false;
                for (var j = 0; j < _validFileExtensions.length; j++) {
                    var sCurExtension = _validFileExtensions[j];
                    if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                        blnValid = true;
                        break;
                    }
                }
                 
                if (!blnValid) {
                    bootbox.alert("กรุณาอัพโหลดไฟล์ .gif, .png, .jpg");
                    document.getElementById("my_file").value = "";
                    return false;
                }
            }
        }
            
        var imagepet1 = document.getElementById('imagepet1');
        var url = URL.createObjectURL(event.target.files[0]);
        var idimage = $('#imagepet1');
        fixExifOrientation(idimage,event.target.files[0]);
        imagepet1.src = url;
        $('#clonimg').val(url);

    });
}

function fixExifOrientation(idimage,$img) {
    console.log(idimage);
    EXIF.getData($img, function() {
        console.log('Exif=', EXIF.getTag(this, "Orientation"));
        switch(parseInt(EXIF.getTag(this, "Orientation"))) {
            case 2:
                idimage.addClass('flip'); break;
            case 3:
                idimage.addClass('rotate-180'); break;
            case 4:
                idimage.addClass('flip-and-rotate-180'); break;
            case 5:
                idimage.addClass('flip-and-rotate-270'); break;
            case 6:
                idimage.addClass('rotate-90'); break;
            case 7:
                idimage.addClass('flip-and-rotate-90'); break;
            case 8:
                idimage.addClass('rotate-270'); break;
        }
    });
}

/* PET วันเกิด MODAL ADD */

$('#petbirthday').change(function () {
    var petbirthday = $(this).val();
    ageString = getAge(petbirthday);

    $('#age').val(ageString);
});

/* คำนวณวันเกิด */
function getAge(dateString) {
    
    var now = new Date();
    var today = new Date(now.getYear(),now.getMonth(),now.getDate());

    var yearNow = now.getYear();
    var monthNow = now.getMonth();
    var dateNow = now.getDate();

    var dob = new Date(dateString.substring(6,10),
                     dateString.substring(3,5)-1,
                     dateString.substring(0,2));

    var yearDob = dob.getYear();
    var monthDob = dob.getMonth();
    var dateDob = dob.getDate();
    var age = {};
    var ageString = "";
    var yearString = "";
    var monthString = "";
    var dayString = "";

    yearAge = yearNow - yearDob;

    if (monthNow >= monthDob)
        var monthAge = monthNow - monthDob;
    else {
        yearAge--;
        var monthAge = 12 + monthNow -monthDob;
    }

    if (dateNow >= dateDob)
        var dateAge = dateNow - dateDob;
    else {
        monthAge--;
        var dateAge = 31 + dateNow - dateDob;

        if (monthAge < 0) {
          monthAge = 11;
          yearAge--;
        }
    }

    age = {
          years: yearAge,
          months: monthAge,
          days: dateAge
        };

    if ( age.years > 1 ) yearString = " ปี";
    else yearString = " ปี";
    if ( age.months> 1 ) monthString = " เดือน";
    else monthString = " เดือน";
    if ( age.days > 1 ) dayString = " วัน";
    else dayString = " วัน";

    if ( (age.years > 0) && (age.months > 0) && (age.days > 0) )
        ageString = age.years + yearString + " " + age.months + monthString + " " + age.days + dayString;
    else if ( (age.years == 0) && (age.months == 0) && (age.days > 0) )
        ageString = " " + age.days + dayString;
    else if ( (age.years > 0) && (age.months == 0) && (age.days == 0) )
        ageString = age.years + yearString + " ";
    else if ( (age.years > 0) && (age.months > 0) && (age.days == 0) )
        ageString = age.years + yearString + " " + age.months + monthString + " ";
    else if ( (age.years == 0) && (age.months > 0) && (age.days > 0) )
        ageString = age.months + monthString + " " + age.days + dayString + " ";
    else if ( (age.years > 0) && (age.months == 0) && (age.days > 0) )
        ageString = age.years + yearString + " " + age.days + dayString + " ";
    else if ( (age.years == 0) && (age.months > 0) && (age.days == 0) )
        ageString = age.months + monthString + " ";
    else ageString = "เกิดวันนี้";

    return ageString;
}
/* saveAllPets */
var saveAllPets = [];
var npet = 0; 

function addPet() {
    error_title = 'ข้อความจากระบบ';
    NewcodePet = parseInt(codePet)+npet;

    var pet_image = '';
    var petname = $('#petname').val();
    var pettype = $('#pettype').val();
    var age = $('#age').val();
    var petsex = $('#petsex').val();
    var petbreeds = $('#petbreeds').val();
    var sprayedorneutereded = $("#sprayedorneutereded:checked").val();
    var petcolor = $('#petcolor').val();
    var petdefect = $('#petdefect').val();
    var petbirthday = $('#petbirthday').val();
    var microship = $('#microship').val();
    var clonimg = $('#clonimg').val();

    if(petname == ''){ 
        error_message = 'กรุณาระบุชื่อสัตว์เลี้ยง';
        Message(error_title,error_message);
        return false;
    }

    if(pettype == ''){ 
        error_message = 'กรุณาระบุประเภทสัตว์เลี้ยง';
        Message(error_title,error_message);
        return false;
    }

    if(clonimg == ''){
        clonimg = Config.base_url+'assets/custom/images/cat.jpg';
    }

    if(petcolor == ''){
        petcolor = 'ไม่ระบุ';
    }

    if(microship == ''){
        microship = 'ไม่ระบุ';
    }

    if(age == ''){
        age = 'ไม่ระบุ';
    }

    if(petdefect == ''){
        petdefect = 'ไม่ระบุ';
    }

    if(petbirthday == ''){
        petbirthday = 'ไม่ระบุ';
    }

    if(sprayedorneutereded == 1){
        var neutered = 'ทำหมันแล้ว';
    }else{
        var neutered = 'ยังไม่เคยทำหมัน';
    }

    var file_data = $('#my_file').prop('files')[0]; 
    var form_data = new FormData();
    form_data.append("file", file_data);

    $.ajax({
        url: Config.base_url+'api/regmanage/uploadimage',
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'POST',

        success: function (data) {
            var data = JSON.parse(data);
            pet_image = data.full_path;

            if(pet_image == ''){
                pet_image = Config.base_url+'assets/custom/images/cat.jpg';
            }

            var savePets = {
                pet_image : pet_image,
                clonimg: clonimg,
                petname : petname,
                pettype: pettype,
                age: age,
                petsex: petsex,
                petbreeds: petbreeds,
                sprayedorneutereded: sprayedorneutereded,
                petcolor: petcolor,
                petdefect: petdefect,
                petbirthday: petbirthday,
                microship: microship
            };

            saveAllPets.push(savePets);
            
            var pets = $('#pets');
            pets.before('<div id="rowspet'+npet+'" class="col-lg-6 rowspet">'+
                            '<div class="card card-outline-gray">'+
                                '<div class="card-header">'+
                                    '<div class="row">'+
                                        '<div class="col-md-6 text-left">'+
                                            '<h4 class="tpetname">'+petname+'</h4>'+
                                        '</div>'+
                                        '<div class="col-md-6 text-right">'+
                                            '<button type="button" onclick="editPet('+npet+');" class="btn btn-secondary mr-1"><i class="fa fa-edit"></i> แก้ไข</button>'+
                                            '<button type="button" onclick="removePet('+npet+');" class="btn btn-secondary"><i class="fa fa-close"></i> ลบ</button>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="card-body">'+
                                    '<div class="row">'+
                                        '<div class="col-md-3 petimg">'+
                                            '<img id="imagepetAdd'+npet+'" class="img-rounded timagepet" src="'+clonimg+'" alt="">'+
                                        '</div>'+
                                        
                                        '<div class="media-body">'+
                                            '<div class="row">'+
                                                '<div class="col-md-3 col-xs-6 b-r"> <strong>Pet ID</strong>'+
                                                    '<br>'+
                                                    '<p class="text-muted tNewcodePet">P'+NewcodePet+'</p>'+
                                                '</div>'+
                                                '<div class="col-md-3 col-xs-6 b-r"> <strong>เลข Microship</strong>'+
                                                    '<br>'+
                                                    '<p class="text-muted tmicroship">'+microship+'</p>'+
                                                '</div>'+
                                                '<div class="col-md-3 col-xs-6 b-r"> <strong>เพศ</strong>'+
                                                    '<br>'+
                                                    '<p class="text-muted tpetsex">'+petsex+'</p>'+
                                                '</div>'+
                                                '<div class="col-md-3 col-xs-6 b-r"> <strong>สี</strong>'+
                                                    '<br>'+
                                                    '<p class="text-muted tpetcolor">'+petcolor+'</p>'+
                                                '</div>'+
                                                '<div class="col-md-3 col-xs-6 b-r"> <strong>ตำหนิ</strong>'+
                                                    '<br>'+
                                                    '<p class="text-muted tpetdefect">'+petdefect+'</p>'+
                                                '</div>'+
                                                '<div class="col-md-3 col-xs-6 b-r"> <strong>อายุ</strong>'+
                                                    '<br>'+
                                                    '<p class="text-muted tage">'+age+'</p>'+
                                                '</div>'+
                                                '<div class="col-md-3 col-xs-6 b-r"> <strong>วันเดือนปีเกิด</strong>'+
                                                    '<br>'+
                                                    '<p class="text-muted tpetbirthday">'+petbirthday+'</p>'+
                                                '</div>'+
                                                '<div class="col-md-3 col-xs-6 b-r"> <strong>ข้อมูลอื่น ๆ </strong>'+
                                                    '<br>'+
                                                    '<p class="text-muted tneutered">'+neutered+'</p>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>');

            $('#my_file').val('');
            $('#petname').val(''); 
            $('#pettype').prop('selectedIndex', 0);
            $('#petsex').prop('selectedIndex', 0);
            $('#petbreeds').empty();
            $('#petbreeds').append('<option value="ไม่ระบุ">ไม่ระบุ</option>');
            document.getElementById("sprayedorneutereded").checked = false;
            $('#petcolor').val('');
            $('#petdefect').val('');
            $('#petbirthday').val('');
            $('#age').val('');
            $('#microship').val('');

            $('#modalAddpet').modal('hide');
            npet++;
        }
    });
}
// IsCuid เป็นลูกค้าเดิม

function addPetIsCuid() {
    error_title = 'ข้อความจากระบบ';

    var pet_image = '';
    var cuid = $('#cuid').val();
    var petname = $('#petname').val();
    var pettype = $('#pettype').val();
    var age = $('#age').val();
    var petsex = $('#petsex').val();
    var petbreeds = $('#petbreeds').val();
    var sprayedorneutereded = $("#sprayedorneutereded:checked").val();
    var petcolor = $('#petcolor').val();
    var petdefect = $('#petdefect').val();
    var petbirthday = $('#petbirthday').val();
    var microship = $('#microship').val();
    var clonimg = $('#clonimg').val();

    if(petname == ''){ 
        error_message = 'กรุณาระบุชื่อสัตว์เลี้ยง';
        Message(error_title,error_message);
        return false;
    }

    if(pettype == ''){ 
        error_message = 'กรุณาระบุประเภทสัตว์เลี้ยง';
        Message(error_title,error_message);
        return false;
    }

    if(clonimg == ''){
        clonimg = Config.base_url+'assets/custom/images/cat.jpg';
    }

    if(petcolor == ''){
        petcolor = 'ไม่ระบุ';
    }

    if(microship == ''){
        microship = 'ไม่ระบุ';
    }

    if(age == ''){
        age = 'ไม่ระบุ';
    }

    if(petdefect == ''){
        petdefect = 'ไม่ระบุ';
    }

    if(petbirthday == ''){
        petbirthday = 'ไม่ระบุ';
    }

    if(sprayedorneutereded == 1){
        var neutered = 'ทำหมันแล้ว';
    }else{
        sprayedorneutereded = 0;
        var neutered = 'ยังไม่เคยทำหมัน';
    }

    var file_data = $('#my_file').prop('files')[0]; 
    var form_data = new FormData();
    form_data.append("file", file_data);
    form_data.append("cuid", cuid);
    form_data.append("petname", petname);
    form_data.append("pettype", pettype);
    form_data.append("petsex", petsex);
    form_data.append("petbreed", petbreeds);
    form_data.append("sprayedorneutereded", sprayedorneutereded);
    form_data.append("petcolor", petcolor);
    form_data.append("petdefect", petdefect);
    form_data.append("petbirthday", petbirthday);
    form_data.append("microship", microship);

    $.ajax({
        url: Config.base_url+'api/regmanage/addpetiscuid',
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'POST',

        success: function (data) {
            var data = JSON.parse(data);
            if(!data.success){
                return false;
            } 
              
            pet_image = data.full_path;
            if(pet_image == ''){
                pet_image = Config.base_url+'assets/custom/images/cat.jpg';
            }
            pet_id = data.pet_id;
            
            var pets = $('#pets');
            pets.before('<div id="petid'+pet_id+'" class="col-lg-6">'+
                            '<div class="card card-outline-gray">'+
                                '<div class="card-header">'+
                                    '<div class="row">'+
                                        '<div class="col-md-6 text-left">'+
                                            '<a href="'+Config.base_url+'medicalrecords/pet/'+pet_id+'"><h4 class="tpetname">'+petname+'</h4></a>'+
                                        '</div>'+
                                        '<div class="col-md-6 text-right">'+
                                            '<button type="button" onclick="editPetIsId('+pet_id+');" class="btn btn-secondary mr-1"><i class="fa fa-edit"></i> แก้ไข</button>'+
                                            '<button type="button" onclick="removePetIsId('+pet_id+');" class="btn btn-secondary"><i class="fa fa-close"></i> ลบ</button>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="card-body">'+
                                    '<div class="row">'+
                                        '<div class="col-md-3 petimg">'+
                                            '<img id="imagepetAdd'+pet_id+'" class="img-rounded timagepet" src="'+clonimg+'" alt="">'+
                                        '</div>'+
                                        
                                        '<div class="media-body">'+
                                            '<div class="row">'+
                                                '<div class="col-md-3 col-xs-6 b-r"> <strong>Pet ID</strong>'+
                                                    '<br>'+
                                                    '<p class="text-muted tNewcodePet">P'+pet_id+'</p>'+
                                                '</div>'+
                                                '<div class="col-md-3 col-xs-6 b-r"> <strong>เลข Microship</strong>'+
                                                    '<br>'+
                                                    '<p class="text-muted tmicroship">'+microship+'</p>'+
                                                '</div>'+
                                                '<div class="col-md-3 col-xs-6 b-r"> <strong>เพศ</strong>'+
                                                    '<br>'+
                                                    '<p class="text-muted tpetsex">'+petsex+'</p>'+
                                                '</div>'+
                                                '<div class="col-md-3 col-xs-6 b-r"> <strong>สี</strong>'+
                                                    '<br>'+
                                                    '<p class="text-muted tpetcolor">'+petcolor+'</p>'+
                                                '</div>'+
                                                '<div class="col-md-3 col-xs-6 b-r"> <strong>ตำหนิ</strong>'+
                                                    '<br>'+
                                                    '<p class="text-muted tpetdefect">'+petdefect+'</p>'+
                                                '</div>'+
                                                '<div class="col-md-3 col-xs-6 b-r"> <strong>อายุ</strong>'+
                                                    '<br>'+
                                                    '<p class="text-muted tage">'+age+'</p>'+
                                                '</div>'+
                                                '<div class="col-md-3 col-xs-6 b-r"> <strong>วันเดือนปีเกิด</strong>'+
                                                    '<br>'+
                                                    '<p class="text-muted tpetbirthday">'+petbirthday+'</p>'+
                                                '</div>'+
                                                '<div class="col-md-3 col-xs-6 b-r"> <strong>ข้อมูลอื่น ๆ </strong>'+
                                                    '<br>'+
                                                    '<p class="text-muted tneutered">'+neutered+'</p>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>');

            $('#my_file').val('');
            $('#petname').val(''); 
            $('#pettype').prop('selectedIndex', 0);
            $('#petsex').prop('selectedIndex', 0);
            $('#petbreeds').empty();
            $('#petbreeds').append('<option value="ไม่ระบุ">ไม่ระบุ</option>');
            document.getElementById("sprayedorneutereded").checked = false;
            $('#petcolor').val('');
            $('#petdefect').val('');
            $('#petbirthday').val('');
            $('#age').val('');
            $('#microship').val('');

            $('#modalAddpet').modal('hide');
        }
    });
}
// END เพิ่มสัตว์เลี้ยง 

// START ลบ pet 
function removePet(npet){
    $('#rowspet'+npet).remove();
}


function removePetIsId(npet){
    swal({   
        title: "กรุณาตรวจสอบ ?",   
        text: "ท่านแน่ใจหรือว่าต้องการลบสัตว์เลี้ยง !",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "ไช่, ต้องการลบ",   
		cancelButtonText: "ยกเลิก",   
        closeOnConfirm: false 
    }, function(){

        $('#petid'+npet).remove();

        $.ajax({
            type: 'POST',
            url: Config.base_url+'api/regmanage/removepetisid',
            data: {
                'pet_id': npet
            },
            success: function (data) {
                // the next thing you want to do 
                var data = JSON.parse(data);
                
            }
        });
        swal("Deleted!", "Your imaginary file has been deleted.", "success"); 
    });
}
// END ลบ pet 

// START แก้ไขสัตว์เลี้ยง
$('#editpetbirthday').datepicker({
        format: 'dd/mm/yyyy',
        language:"th-th",
        todayHighlight:true,
        ignoreReadonly: true,
        autoclose: true
    });
//$('#editpetbirthday').bootstrapMaterialDatePicker({ format : 'MM/DD/YYYY',weekStart : 0, time: false });

function editPet(npet){

    $("#modalEditpet").on("show.bs.modal", function () {
        $('#editid').val(npet);
        $('#editpetname').val(saveAllPets[npet]['petname']);

        $('#editpettype option[value="'+saveAllPets[npet]['pettype']+'"]').attr('selected', 'selected');
        $('#editpettype').change();

        $('#editpetsex option[value="'+saveAllPets[npet]['petsex']+'"]').attr('selected', 'selected');

        if(saveAllPets[npet]['sprayedorneutereded'] == 1){
            document.getElementById("editsprayedorneutereded").checked = true;
        }
        $('#editpetcolor').val(saveAllPets[npet]['petcolor']);
        $('#editpetdefect').val(saveAllPets[npet]['petdefect']);
        if(saveAllPets[npet]['petbirthday'] == 'ไม่ระบุ'){
            saveAllPets[npet]['petbirthday'] = '';
        }
        $('#editpetbirthday').val(saveAllPets[npet]['petbirthday']);
        $('#editage').val(saveAllPets[npet]['age']);
        $('#editmicroship').val(saveAllPets[npet]['microship']);

    }).modal('show');

    $("#modalEditpet").on("shown.bs.modal", function () {
        var imagepetedit = document.getElementById('imagepetedit');
        imagepetedit.src = saveAllPets[npet]['clonimg'];
        $('#editpetbreeds option[value="'+saveAllPets[npet]['petbreeds']+'"]').attr('selected', 'selected');
    }).modal('show');
}

function editPetIsId(pet_id){
        $.ajax({
            type: 'POST',
            url: Config.base_url+'api/regmanage/getpetbyid',
            data: {
                'pet_id': pet_id
            },
            success: function (data) { 
                var data = JSON.parse(data);
                data = data[0];
				console.log(data);
                $("#modalEditpet").on("show.bs.modal", function () {
               
                    $('#editid').val(pet_id);
                    $('#editpetname').val(data.petname);
                   
                    $('#editpettype').val(data.pettype);
                   // $('#editpettype').change();
					
                    $('#editpetsex').val(data.petsex);

                    if(data.sprayedorneutereded == 1){
                        document.getElementById("editsprayedorneutereded").checked = true;
                    }
                    $('#editpetcolor').val(data.petcolor);
                    $('#editpetdefect').val(data.petdefect);
                    if(data.petbirthday == 'ไม่ระบุ'){
                        data.petbirthday = '';
                    }
                    $('#editpetbirthday').val(data.petbirthday);
                    $('#editpetbirthday').change();
                    $('#editmicroship').val(data.microship);
                    $('#oldimagepet').val(data.petpicture);

                    var imagepetedit = document.getElementById('imagepetedit');
                    imagepetedit.src = data.petpicture;
                    petbreed = data.petbreed;
        			if(petbreed == "" || !petbreed || petbreed == "null"){
						petbreed = "ไม่ระบุ";
					}
					
					$('#editpetbreeds').val(petbreed);
                }).modal('show');

               
            }   
        });
    
}

$('#editpettype').change(function () {
    var pet_type_id = $(this).find(':selected')[0].id;
    
    $.ajax({
        type: 'POST',
        url: Config.base_url+'api/regmanage/petBreeds',
        data: {
            'pet_type_id': pet_type_id
        },
        success: function (data) {
            // the next thing you want to do 
            var data = JSON.parse(data);
             var $editpetbreeds = $('#editpetbreeds');
            $editpetbreeds.empty();

            for (var i = 0; i < data.length; i++) {
                $editpetbreeds.append('<option id=' + data[i].id + ' value=' + data[i].breed_th + '>' + data[i].breed_th + '</option>');
            }

            if(pet_type_id == '-1'){
                $editpetbreeds.append('<option value="ไม่ระบุ">ไม่ระบุ</option>');
            }
        }
    });
});

function EditImage(){   
    $("#editimagepet").click();
}

var editimagepet = document.getElementById('editimagepet');
editimagepet.addEventListener('change', function(event) {
    if (editimagepet.type == "file") {
        var sFileName = editimagepet.value;
        if (sFileName.length > 0) {
            
            if(editimagepet.files[0].size > Config.limitMb){
                bootbox.alert('ไฟล์มีขนาดเกิน '+Config.maxMb+'Mb ');
                input.value = "";
                return false; 
            }
    
            var blnValid = false;
            for (var j = 0; j < _validFileExtensions.length; j++) {
                var sCurExtension = _validFileExtensions[j];
                if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                    blnValid = true;
                    break;
                }
            }
             
            if (!blnValid) {
                bootbox.alert("กรุณาอัพโหลดไฟล์ .gif, .png, .jpg");
                document.getElementById("editimagepet").value = "";
                return false;
            }
        }
    }        
    var imagepetedit = document.getElementById('imagepetedit');
    var url = URL.createObjectURL(event.target.files[0]);
    var idimage = $('#imagepetedit');
    fixExifOrientation(idimage,event.target.files[0]);
    imagepetedit.src = url;
    $('#editclonimg').val(url);
});


$('#editpetbirthday').change(function () {
    var editpetbirthday = $(this).val();

    if(editpetbirthday == '' || editpetbirthday == 0){
        ageString = '0 ปี 0 เดือน 0 วัน';
    }else{
        ageString = getAge(editpetbirthday);
    }
   

    $('#editage').val(ageString);
});

function updatePetIsCuid(){
    var editid = $('#editid').val();
    var cuid = $('#cuid').val();

    var editpet_image = '';
    var editpetname = $('#editpetname').val();
    var editpettype = $('#editpettype').val();
    var editage = $('#editage').val();
    var editpetsex = $('#editpetsex').val();
    var editpetbreeds = $('#editpetbreeds').val();
    var editsprayedorneutereded = $("#editsprayedorneutereded:checked").val();
    var editpetcolor = $('#editpetcolor').val();
    var editpetdefect = $('#editpetdefect').val();
    var editpetbirthday = $('#editpetbirthday').val();
    var editmicroship = $('#editmicroship').val();
    var oldimagepet = $('#oldimagepet').val();

    if(editpetname == ''){ 
        error_message = 'กรุณาระบุชื่อสัตว์เลี้ยง';
        Message(error_title,error_message);
        return false;
    }

    if(editpettype == ''){ 
        error_message = 'กรุณาระบุประเภทสัตว์เลี้ยง';
        Message(error_title,error_message);
        return false;
    }

    if(editclonimg == ''){
        editclonimg = saveAllPets[editid]['clonimg'];
    }

    if(editpetcolor == ''){
        editpetcolor = 'ไม่ระบุ';
    }

    if(editmicroship == ''){
        editmicroship = 'ไม่ระบุ';
    }

    if(editage == ''){
        editage = 'ไม่ระบุ';
    }

    if(editpetdefect == ''){
        editpetdefect = 'ไม่ระบุ';
    }

    if(editpetbirthday == ''){
        editpetbirthday = 'ไม่ระบุ';
    }

    if(editsprayedorneutereded == 1){
        var editneutered = 'ทำหมันแล้ว';
    }else{
        var editneutered = 'ยังไม่เคยทำหมัน';
    }

    var file_data = $('#editimagepet').prop('files')[0];
    var form_data = new FormData();
    form_data.append("uid", editid);
    form_data.append("file", file_data);
    form_data.append("cuid", cuid);
    //form_data.append("uid", pet_uid);
    form_data.append("petname", editpetname);
    form_data.append("pettype", editpettype);
    form_data.append("petsex", editpetsex);
    form_data.append("petbreed", editpetbreeds);
    form_data.append("sprayedorneutereded", editneutered);
    form_data.append("petcolor", editpetcolor);
    form_data.append("petdefect", editpetdefect);
    form_data.append("petbirthday", editpetbirthday);
    form_data.append("microship", editmicroship);

    if(!file_data){
        form_data.append("oldimagepet", oldimagepet);
    }
    console.log(form_data);
    $.ajax({
        url: Config.base_url+'api/regmanage/editpetiscuid',
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'POST',

        success: function (data) {
            var data = JSON.parse(data);
            
            if(!data.success){
                return false;
            } 
              
            pet_image = data.full_path;
            if(pet_image == ''){
                pet_image = Config.base_url+'assets/custom/images/cat.jpg';
            }

            $('#petid'+editid+' .tpetname').empty();
            $('#petid'+editid+' .tpettype').empty();
            $('#petid'+editid+' .tage').empty();
            $('#petid'+editid+' .tpetsex').empty();
            $('#petid'+editid+' .tpetbreeds').empty();
            $('#petid'+editid+' .tneutered').empty();
            $('#petid'+editid+' .tpetcolor').empty();
            $('#petid'+editid+' .tpetdefect').empty();
            $('#petid'+editid+' .tpetbirthday').empty();
            $('#petid'+editid+' .tmicroship').empty();

            var imagepetedit = document.getElementById('imagepetAdd'+editid);
            imagepetedit.src = pet_image;

            $('#petid'+editid+' .tpetname').append(editpetname);
            $('#petid'+editid+' .tpettype').append(editpettype);
            $('#petid'+editid+' .tage').append(editage);
            $('#petid'+editid+' .tpetsex').append(editpetsex);
            $('#petid'+editid+' .tpetbreeds').append(editpetbreeds);
            $('#petid'+editid+' .tneutered').append(editneutered);
            $('#petid'+editid+' .tpetcolor').append(editpetcolor);
            $('#petid'+editid+' .tpetdefect').append(editpetdefect);
            $('#petid'+editid+' .tpetbirthday').append(editpetbirthday);
            $('#petid'+editid+' .tmicroship').append(editmicroship);

            $('#modalEditpet').modal('hide');
            swal('ข้อความจากระบบ','บันทึกข้อมูลเรียบร้อยแ้ว');
        }
    });
}

function updatePet(){
    var editid = $('#editid').val();

    var editpet_image = '';
    var editpetname = $('#editpetname').val();
    var editpettype = $('#editpettype').val();
    var editage = $('#editage').val();
    var editpetsex = $('#editpetsex').val();
    var editpetbreeds = $('#editpetbreeds').val();
    var editsprayedorneutereded = $("#editsprayedorneutereded:checked").val();
    var editpetcolor = $('#editpetcolor').val();
    var editpetdefect = $('#editpetdefect').val();
    var editpetbirthday = $('#editpetbirthday').val();
    var editmicroship = $('#editmicroship').val();
    var editclonimg = $('#editclonimg').val();
    var oldimagepet = $('#oldimagepet').val();

    if(editpetname == ''){ 
        error_message = 'กรุณาระบุชื่อสัตว์เลี้ยง';
        Message(error_title,error_message);
        return false;
    }

    if(editpettype == ''){ 
        error_message = 'กรุณาระบุประเภทสัตว์เลี้ยง';
        Message(error_title,error_message);
        return false;
    }

    if(editclonimg == ''){
        editclonimg = saveAllPets[editid]['clonimg'];
    }

    if(editpetcolor == ''){
        editpetcolor = 'ไม่ระบุ';
    }

    if(editmicroship == ''){
        editmicroship = 'ไม่ระบุ';
    }

    if(editage == ''){
        editage = 'ไม่ระบุ';
    }

    if(editpetdefect == ''){
        editpetdefect = 'ไม่ระบุ';
    }

    if(editpetbirthday == ''){
        editpetbirthday = 'ไม่ระบุ';
    }

    if(editsprayedorneutereded == 1){
        var editneutered = 'ทำหมันแล้ว';
    }else{
        var editneutered = 'ยังไม่เคยทำหมัน';
    }

    var file_data = $('#editimagepet').prop('files')[0]; 
    var form_data = new FormData();

    form_data.append("file", file_data);
    $.ajax({
        url: Config.base_url+'api/regmanage/uploadimage',
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'POST',
        success: function (data) {
            var data = JSON.parse(data);
            editpet_image = data.full_path;
       
            if(editpet_image == ''){
                editpet_image = oldimagepet;
            }

            var updatePets = {
                pet_image : editpet_image,
                clonimg: editclonimg,
                petname : editpetname,
                pettype: editpettype,
                age: editage,
                petsex: editpetsex,
                petbreeds: editpetbreeds,
                sprayedorneutereded: editsprayedorneutereded,
                petcolor: editpetcolor,
                petdefect: editpetdefect,
                petbirthday: editpetbirthday,
                microship: editmicroship
            };
            
            saveAllPets[editid] = updatePets;

            $('#rowspet'+editid+' .tpetname').empty();
            $('#rowspet'+editid+' .tpettype').empty();
            $('#rowspet'+editid+' .tage').empty();
            $('#rowspet'+editid+' .tpetsex').empty();
            $('#rowspet'+editid+' .tpetbreeds').empty();
            $('#rowspet'+editid+' .tneutered').empty();
            $('#rowspet'+editid+' .tpetcolor').empty();
            $('#rowspet'+editid+' .tpetdefect').empty();
            $('#rowspet'+editid+' .tpetbirthday').empty();
            $('#rowspet'+editid+' .tmicroship').empty();

            var imagepetedit = document.getElementById('imagepetAdd'+editid);
            imagepetedit.src = editclonimg;

            $('#rowspet'+editid+' .tpetname').append(editpetname);
            $('#rowspet'+editid+' .tpettype').append(editpettype);
            $('#rowspet'+editid+' .tage').append(editage);
            $('#rowspet'+editid+' .tpetsex').append(editpetsex);
            $('#rowspet'+editid+' .tpetbreeds').append(editpetbreeds);
            $('#rowspet'+editid+' .tneutered').append(editneutered);
            $('#rowspet'+editid+' .tpetcolor').append(editpetcolor);
            $('#rowspet'+editid+' .tpetdefect').append(editpetdefect);
            $('#rowspet'+editid+' .tpetbirthday').append(editpetbirthday);
            $('#rowspet'+editid+' .tmicroship').append(editmicroship);

            $('#modalEditpet').modal('hide');
         }
    });
}

// END แก้ไขสัตว์เลี้ยง