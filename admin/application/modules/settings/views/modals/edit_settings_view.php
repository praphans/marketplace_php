<!-- ============================================================== -->
<!----------------- Modals เพิ่มประเภทร้านค้าและบริการ ------------------>
<!-- ============================================================== -->  
<?php
$attributes = array('id' => 'update_member');
echo form_open(base_url('settings/update_member'), $attributes);
foreach($admin as $row){
	$admin_id = $row->admin_id;
	$name = $row->name;
	$username = $row->username;
	$password = $row->password;
	$user_type = $row->user_type;

  if($admin_id == 1){
    $disabled = "disabled";
  }else{
    $disabled = "";
  }
}
?>

<div id="myModalEditSettings" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
<div class="modal-dialog modal-xs">
      <div class="modal-content">
          <div class="modal-header bg-header-modals">
              <h4 class="modal-title text-light" id="myModalLabel2">แก้ไขผู้ใช้งานระบบ</h4>
              <button type="button" class="close text-white" data-dismiss="modal" aria-hidden="true">×</button>
          </div>
          <!-- from modal  -->
          <div class="modal-body">
                  <div class="row p-l-20 p-r-10">
                      <div class="col-md-12 col-lg-12 pl-0">
                          <h5 class="text-themecolor text-lab">แก้ไขผู้ใช้งานระบบ</h5>
                      </div> 

                      <div class="col-md-12 col-lg-12 p-t-10 p-b-10 pl-0">
                          <div class="row">
                              <div class="col-sm-12 col-md-12 col-lg-12 pr-0">
                                  <label class="">ชื่อ - นามสกุล : <a class="text-danger">*</a></label>
                              </div>
                              <div class="col-sm-12 col-md-12 col-lg-12">
                                  <input name="name" type="text" class="form-control" value="<?php echo $name; ?>" required>
                                  <input name="admin_id" type="hidden" value="<?php echo $admin_id; ?>">
                              </div>
                          </div>
                      </div>
                      <div class="col-md-12 col-lg-12 p-t-10 p-b-10 pl-0">
                          <div class="row">
                              <div class="col-sm-12 col-md-12 col-lg-12 pr-0">
                                  <label class="">Username :</label>
                              </div>
                              <div class="col-sm-12 col-md-12 col-lg-12">
                                  <input name="username" type="text" class="form-control" value="<?php echo $username; ?>" required>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-12 col-lg-12 p-t-10 p-b-10 pl-0">
                          <div class="row">
                              <div class="col-sm-12 col-md-12 col-lg-12 pr-0">
                                  <label class="">Password :</label>
                              </div>
                              <div class="col-sm-12 col-md-12 col-lg-12">
                                  <input name="password" type="text" class="form-control" value="">
                              </div>
                          </div>
                      </div>
                      <div class="col-md-12 col-lg-12 p-t-10 p-b-10 pl-0">
                          <div class="row">
                              <div class="col-sm-12 col-md-12 col-lg-12 pr-0">
                                  <label class="">ประเภท : <a class="text-danger">*</a></label>
                              </div>
                              <div class="col-sm-12 col-md-12 col-lg-12">
                               <select class="form-control custom-select" name="user_type" id="user_type" <?php echo $disabled; ?>>
                                <?php
                                  $selected = "";
                                  $admin_type_result = $this->model_settings->getUserType();
                                  foreach($admin_type_result as $row){
                                    $user_type_id = $row->user_type_id;
                                    $user_type_name = $row->user_type_name;

                                    if($user_type_id == $user_type){
                                      $selected = "selected";
                                    }
                                    
                                ?>
                                  <option value="<?php echo $user_type_id; ?>" class="" <?php echo $selected; ?>><?php echo $user_type_name; ?></option>
                                <?php } ?>
                              </select>
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
                       <button type="submit" class="btn btn-warning waves-effect btn-block">แก้ไขผู้ใช้งาน</button>
                  </div>                 
              </div>
          </div>

      </div>
      <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
  </div>
  </form>
  <script>
  $("#user_type").val("<?php echo $user_type; ?>");
  </script>

<!-- ============================================================== -->
<!--------------- End Modals เพิ่มประเภทสินค้าและบริการ ---------------->
<!-- ============================================================== --> 