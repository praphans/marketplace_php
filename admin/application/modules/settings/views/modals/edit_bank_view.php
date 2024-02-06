<?php
$attributes = array("updateBank", "enctype"=>"multipart/form-data");
echo form_open(base_url('settings/updateBank'), $attributes);

foreach($bank_result as $row){
  $bank_id  = $row->id;
  $bank_name  = $row->bank_name;

}

?>

<div id="myModalEditBank" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
<input type="hidden" name="bank_id" value="<?php echo $bank_id; ?>">
  <div class="modal-dialog modal-xs">
      <div class="modal-content">
          <div class="modal-header bg-header-modals">
              <h4 class="modal-title text-light" id="myModalLabel2">แก้ไขข่าวสาร</h4>
              <button type="button" class="close text-white" data-dismiss="modal" aria-hidden="true">×</button>
          </div>

          <!-- from modal  -->
          <div class="modal-body">
              <div class="row p-l-20 p-r-10">
                  <div class="col-md-12 col-lg-12 p-t-10 p-b-10 pl-0">
                        <div class="row pt-2">
                            <div class="col-sm-12 col-md-12 col-lg-12 pr-0">
                                <label>ชื่อธนาคาร : <a class="text-danger">*</a></label>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <input name="bank_name" type="text" class="form-control" value="<?php echo $bank_name; ?>" required>
                            </div>
                        </div> 
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
                       <button type="submit" class="btn btn-info waves-effect btn-block">แก้ไข</button>
                  </div>                 
              </div>
          </div>

      </div>
      <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
  </div>
  </form>



