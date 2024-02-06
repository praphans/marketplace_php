<form class="type_2" action="<?php echo site_url("member/forgotpassword"); ?>" method="post">
<div id="modal_forgot_password" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">ลืมรหัสผ่าน</h4>
      </div>
      <div class="modal-body">
       
        <div class="row">
            <div class="col-md-12 p-t-10">
                 <label for="member_email">อีเมล <span class="red">*</span> </label>
                 <input type="text" name="member_email" id="member_email" placeholder="กรุณาระบุที่อยู่อีเมลที่เป็นสมาชิกกับเว็บไซต์" required>
            </div>
            
            
        </div> 
        <div class="row" style="padding-top:10px;">
            
            <div class="col-md-12 p-t-10">
                <label>* หมายเหตุ : หากท่านไม่ได้เป็นผู้ดำเนินการนี้ เมื่อได้รับอีเมล ท่านไม่จำเป็นต้องดำเนินการใด ๆ หรือคลิกลิงค์ใด ๆ ในอีเมล</label>
            </div>    
        </div> 
	  </div>
      <div class="modal-footer">
        <button type="submit" class="btn button_blue"><i class="icon-key-1"></i> ขอรหัสผ่านใหม่</button>
        <button type="button" class="btn button_dark_grey" data-dismiss="modal">ยกเลิก</button>
      </div>
    </div>
  </div>
</div>
</form>

<script src="<?php echo base_url('assets/js/jquery-2.1.1.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/config.js'); ?>"></script>
