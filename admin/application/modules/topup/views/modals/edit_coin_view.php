<!-- ============================================================== -->
<!----------------- Modals เพิ่มประเภทสินค้าและบริการ ------------------>
<!-- ============================================================== -->  
<?php
$attributes = array('id' => 'edit_topup');
echo form_open_multipart(base_url('topup/edit_topup'), $attributes);
?>

<?php
$coin_result = $this->model_topup->getCoinByID();
foreach($coin_result as $row){
    $coin_value = $row->coin_value;

}

?>
<div id="myModalSetCoin" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
  <div class="modal-dialog modal-xs">
      <div class="modal-content">
          <div class="modal-header bg-header-modals">
              <h4 class="modal-title text-light" id="myModalLabel2">ตั้งค่ามูลค่าเหรียญ</h4>
              <button type="button" class="close text-white" data-dismiss="modal" aria-hidden="true">×</button>
          </div>
       
          <!-- from modal  -->
          <div class="modal-body">
                  <div class="row p-l-20 p-r-10">
                      <div class="col-md-12 col-lg-12 p-t-10 p-b-10 pl-0">
                          <div class="input-group">
                              <div class="input-group-prepend">
                                  <span class="input-group-text" id="basic-addon1">เหรียญจำนวน 1 เหรียญ มีมูลค่าท่ากับ </span>
                              </div>
                              <input type="text" class="form-control" name="coin_value" aria-describedby="basic-addon3" value="<?php echo $coin_value; ?>">
                              <div class="input-group-append">
                                  <span class="input-group-text" id="basic-addon1">บาท</span>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-12 col-lg-12 p-t-10 p-b-10 pl-0 text-danger">
                          หมายเหตุ : การกำหนดมูลค่าของเหรียญมีผลต่อการซื้อเหรียญเท่านั้น ซึ่งมูลค่าในการใช้เหรียญจะไม่เปลี่ยนแปลงไปตามการตั้งค่า!
                      </div>
                  </div>
          </div>
          <!-- close from modal  -->

          <div class="modal-footer d-flex justify-content-center">
              <div class="row w-100">
                  <div class="col-sm-12 col-md-2 button-group text-center btn-footer">
                       <!-- contant -->
                  </div>

                  <div class="col-sm-12 col-md-4 button-group text-center btn-footer">
                      <button type="button" class="btn btn-default waves-effect btn-block" data-dismiss="modal">ยกเลิก</button>
                  </div>
                   <div class="col-sm-12 col-md-4 button-group text-center btn-footer ">
                       <button type="submit" class="btn btn-info waves-effect btn-block">บันทึก</button>
                  </div>                 
              </div>
          </div>

      </div>
      <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
  </div>
  </form>

<!-- ============================================================== -->
<!--------------- End Modals เพิ่มประเภทสินค้าและบริการ ---------------->
<!-- ============================================================== --> 