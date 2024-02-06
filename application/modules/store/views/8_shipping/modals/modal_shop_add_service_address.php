<form class="type_2" action="<?php echo site_url("store/shipping/saveService"); ?>" method="post">
<div id="modal_shop_add_service_address" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">เพิ่มเขตพื้นที่บริการ</h4>
      </div>
      <div class="modal-body">

        
                <div class="row">
                    <div class="col-sm-12">
                        <label class="required">เขตพื้นที่จังหวัด</label>
                        <div class="custom_select">
                            <select name="service_province" id="service_province" class="form-control">
    
                            </select>
                        </div>
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col-sm-12">
                        <label class="required">เขตพื้นที่อำเภอ</label>
                        <div class="custom_select">
                            <select name="service_amphur" id="service_amphur" class="form-control">
    
                            </select>
                        </div>
                    </div>
                </div>
                <br />
                
                <div class="row">
                     <div class="col-md-12">
    
                        <label for="service_condition">เงื่อนไขและรายละเอียด</label>
                        <textarea type="text" name="service_condition" id="service_condition"></textarea>
                        <small>ระบุข้อกำหนด เงื่อนไข และรายละเอียดเพิ่มเติม เช่น ข้อจำกัดเขตพื้นที่บริการ และค่าฝากส่ง</small>
    
                    </div>
               	</div>
    
        
		</div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">เพิ่ม</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
      </div>
    </div>
  </div>
</div>
</form>

<script src="<?php echo base_url('assets/js/jquery-2.1.1.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/config.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/AutoProvince.js"); ?>"></script> 


<script type="text/javascript">
$('body').AutoProvince({
	PROVINCE:		'#service_province',
	AMPHUR:		'#service_amphur',
	arrangeByName:	false
});

</script>