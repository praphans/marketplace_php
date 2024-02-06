
;(function( $ ){
	$.fn.AutoProvince = function( options ) {
		var Setting = $.extend( {
			PROVINCE:		'#province', // select div สำหรับรายชื่อจังหวัด
			AMPHUR:			'#amphur', // select div สำหรับรายชื่ออำเภอ
			DISTRICT:		'#district', // select div สำหรับรายชื่อตำบล
			POSTCODE:		'#postcode', // input field สำหรับรายชื่อรหัสไปรษณีย์
			CURRENT_PROVINCE:		null, // select div สำหรับรายชื่อจังหวัด
			CURRENT_AMPHUR:			null, // select div สำหรับรายชื่ออำเภอ
			CURRENT_DISTRICT:		null, // select div สำหรับรายชื่อตำบล
			arrangeByName:		false // กำหนดให้เรียงตามตัวอักษร
		}, options);
		
		return this.each(function() {
			var _province,_amphure,_district,_zipcode,_geography;
			var provinceUrl = config.base_url+"assets/js/json/provinces.json";
			var amphureUrl = config.base_url+"assets/js/json/amphures.json";
			var districtUrl = config.base_url+"assets/js/json/districts.json";
			var zipcodeUrl = config.base_url+"assets/js/json/zipcodes.json";
			var geographyUrl = config.base_url+"assets/js/json/geography.json";
			
			$(function() {
				initialize();
			});
			function initialize(){
				$.when(
					$.getJSON(provinceUrl),
					$.getJSON(amphureUrl),
					$.getJSON(districtUrl),
					$.getJSON(zipcodeUrl),
					$.getJSON(geographyUrl)
				).done(function(province,amphure,district,zipcode,geography) {
					_province = province[0];
					_amphure = amphure[0];
					_district = district[0];
					_zipcode = zipcode[0];
					_geography = geography[0];
					_loadProvince();
					addEventList();
				});
			}
			
			function _loadProvince()
			{
				var list = [];
				var geo_id;
				_province.forEach(function(element) {
				  list.push({id:element.province_id,name:element.province_name,geo_id:element.geo_id});
				  geo_id = element.geo_id;
				});
				
				if(Setting.arrangeByName){
					AddToView(list.sort(SortByName),Setting.PROVINCE);
				}else{
					AddToView(list,Setting.PROVINCE);
				}
				if(Setting.CURRENT_PROVINCE)$(Setting.PROVINCE).val(Setting.CURRENT_PROVINCE);
				if(Setting.CURRENT_AMPHUR != null){
					_loadAmphur(Setting.CURRENT_PROVINCE);
				}else{
					_loadAmphur(1);
				}
			}
			
			function _loadAmphur(PROVINCE_ID_SELECTED)
			{
				var list = [];
				var isFirst = true;
				$(Setting.AMPHUR).empty();
				var amphure = $.grep(_amphure, function(e){ return e.province_id == PROVINCE_ID_SELECTED; });
				amphure.forEach(function(element) {
					
					if(element.amphur_name.indexOf("*") == -1){
				  		list.push({id:element.amphur_id,name:element.amphur_name,postcode:element.amphur_code,geo_id:element.geo_id});
					}
				
				  	
				});
				
				if(Setting.arrangeByName){
					AddToView(list.sort(SortByName),Setting.AMPHUR);
				}else{
					AddToView(list,Setting.AMPHUR);
				}
				var AMPHUR_ID = $(Setting.AMPHUR).val();
				if(Setting.CURRENT_AMPHUR)$(Setting.AMPHUR).val(Setting.CURRENT_AMPHUR);
				if(Setting.CURRENT_DISTRICT != null){
					_loadDistrict(Setting.CURRENT_AMPHUR);
				}else{
					if(isFirst){
						_loadDistrict(AMPHUR_ID);
						isFirst = false;
					}
				}
			}
			
			function _loadDistrict(AMPHUR_ID_SELECTED)
			{
				var list = [];
				$(Setting.DISTRICT).empty();
				var district = $.grep(_district, function(e){ return e.amphur_id == AMPHUR_ID_SELECTED; });
				district.forEach(function(element) {
					if(element.district_name.indexOf("*") == -1){
				  		list.push({id:element.district_id,name:element.district_name,geo_id:element.geo_id});
					}		
				  	_loadPostcode(element.district_code);
				});
				
				if(Setting.arrangeByName){
					AddToView(list.sort(SortByName),Setting.DISTRICT);
				}else{
					AddToView(list,Setting.DISTRICT);
				}
				if(Setting.CURRENT_DISTRICT)$(Setting.DISTRICT).val(Setting.CURRENT_DISTRICT);
			}
			function _loadPostcode(district_code)
			{
				var list = [];
				$(Setting.DISTRICT).empty();
				var postcode = $.grep(_zipcode, function(e){ return e.district_code == district_code; });
				postcode.forEach(function(element) {
					//console.log(element);
					$(Setting.POSTCODE).val(element.zipcode_name);
				  	//list.push({id:element.district_id,name:element.district_name,geo_id:element.geo_id});
				});
				
				if(Setting.arrangeByName){
					AddToView(list.sort(SortByName),Setting.DISTRICT);
				}else{
					AddToView(list,Setting.DISTRICT);
				}
			}
			function _loadGeo(GEO_ID)
			{
				var geo = $.grep(_geography, function(e){ return e.geo_id == GEO_ID; });
				var geo_name = geo[0].geo_name;
				$(Setting.GEOGRAPHY).val(geo_name);	
			}
			function addEventList(){
				$(Setting.PROVINCE).change(function(e) {
					var PROVINCE_ID = $(this).val();
					var GEO_ID = $(this).find('option:selected').attr("GEO");
					Setting.CURRENT_AMPHUR = null;
					Setting.CURRENT_DISTRICT = null;
					_loadAmphur(PROVINCE_ID);
					_loadGeo(GEO_ID);
				});
				$(Setting.AMPHUR).change(function(e) {
					var AMPHUR_ID = $(this).val();
					$(Setting.POSTCODE).val($(this).find('option:selected').attr("POSTCODE"));
					_loadDistrict(AMPHUR_ID);
				});	
			}
			function AddToView(list,key){
				for (var i = 0;i<list.length;i++) {
					if(key != Setting.AMPHUR){
						$(key).append("<option value='"+list[i].id+"' GEO='"+list[i].geo_id+"'>"+list[i].name+"</option>");	
					}else{
						$(key).append("<option value='"+list[i].id+"' POSTCODE='"+list[i].postcode+"'>"+list[i].name+"</option>");	
					}
				}
			}
			function SortByName(a, b){
			  var aName = a.name.toLowerCase();
			  var bName = b.name.toLowerCase(); 
			  return ((aName < bName) ? -1 : ((aName > bName) ? 1 : 0));
			}
		});
	};
})( jQuery );
