<!-- ============================================================== -->
<!----------------- Modals เพิ่มประเภทร้านค้าและบริการ ------------------>
<!-- ============================================================== -->  
<?php
$attributes = array("id" => "add_permission", "enctype"=>"multipart/form-data");
echo form_open(base_url('settings/add_permission'), $attributes);


?>
<div id="myModalPermission" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
  <div class="modal-dialog modal-xs">
      <div class="modal-content">
          <div class="modal-header bg-header-modals">
              <h4 class="modal-title text-light" id="myModalLabel2">เพิ่มประเภทผู้ใช้และการเข้าถึง</h4>
              <button type="button" class="close text-white" data-dismiss="modal" aria-hidden="true">×</button>
          </div>
          <!-- from modal  -->
          <div class="modal-body">
                  <div class="row p-l-20 p-r-10">
                      <div class="col-md-12 col-lg-12 p-t-10 p-b-10 pl-0">
                          <div class="row">
                              <div class="col-sm-12 col-md-12 col-lg-12 pr-0">
                                  <label class="">ประเภท : <a class="text-danger">*</a></label>
                              </div>
                              <div class="col-sm-12 col-md-12 col-lg-12">
                                  <input name="user_type_name" type="text" class="form-control" placeholder="" required>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-12 col-lg-12 p-t-10 p-b-10 pl-0">
                        <div class="row">
                          <div class="col-sm-12 col-md-12 col-lg-12 pr-0">
                              <label class="">การเข้าถึง : </label>
                          </div>

                          <?php
                            $modulesList_result = $this->model_settings->getPermission();
                            foreach($modulesList_result as $row){
                              $per_id = $row->per_id;
                              $per_name_en = $row->per_name_en;
                              $per_name_th = $row->per_name_th;
                              $per_user_type = $row->per_user_type;
                              if($per_id == 19){
                                $display = 'style="display:none"';
                              }else{
                                $display = '';
                              }
                              $module = '<div class="col-md-6 col-lg-6"><input name="module[]" type="checkbox" id="basic_checkbox_'.$per_id.'" value="'.$per_id.'" class="filled-in chk-col-light-green" checked>
                                <label for="basic_checkbox_'.$per_id.'" '.$display.'>'.$per_name_th.'</label></div>';
                              echo $module;
                            }
                            
                         
                          ?>
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
                       <button type="submit" class="btn btn-info waves-effect btn-block">เพิ่มสิทธิ์ผู้ใช้</button>
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