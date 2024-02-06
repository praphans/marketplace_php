<form action="<?php echo site_url("store/category/addCategory"); ?>" method="post">
<div id="modal_add_category_customer" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">เพิ่มหมวดหมู่ภายในร้าน</h4>
      </div>
      <div class="modal-body">
        <label for="category_name">ชื่อหมวดหมู่</label>
        
        <input id="category_name" maxlength="30" name="category_name" class="form-control" placeholder="ระบุชื่อหมวดหมู่ไม่เกิน 30 ตัวอักษร ตัวอย่างเช่น เสื้อในฤดูหนาว" required/>
      	
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn button_blue">เพิ่มหมวดหมู่</button>
        <button type="button" class="btn button_dark_grey" data-dismiss="modal">ยกเลิก</button>
      </div>
    </div>
  </div>
</div>
</form>