

<?php
$attributes = array("id" => "add_slidebanner", "enctype"=>"multipart/form-data");
echo form_open(base_url('slidebanner/edit_slidebanner'), $attributes);
?>
<?php

  foreach($slidebanner_result as $row){
    $banner_id = $row->banner_id;
    $banner_name = $row->banner_name;
    $banner_url = $row->banner_url;
    $banner_hyperlink = $row->banner_hyperlink;
  }


?>
<input name="banner_id" type="text"  value="<?php echo $banner_id; ?>">
<div id="myModalEditSlidebanner" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
  <div class="modal-dialog modal-xs">
      <div class="modal-content">
          <div class="modal-header bg-header-modals">
              <h4 class="modal-title text-light" id="myModalLabel2">แก้ไข Slide banner</h4>
              <button type="button" class="close text-white" data-dismiss="modal" aria-hidden="true">×</button>
          </div>

          <!-- from modal  -->
          <div class="modal-body">
                  <div class="row p-l-20 p-r-10">
                    <!--  <div class="col-md-12 col-lg-12 pl-0">
                          <h5 class="text-themecolor text-lab">เพิ่มประเภทร้านค้า</h5>
                      </div> 
                    -->
                      <div class="col-md-12 col-lg-12 p-t-10 p-b-10 pl-0">
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-lg-12 pr-0">
                                    <label>ชื่อรูปภาพ : <a class="text-danger">*</a></label>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <input name="banner_name" type="text" class="form-control" value="<?php echo $banner_name; ?>" required>
                                </div>
                            </div>
                            <div class="row pt-2">
                                <div class="col-sm-12 col-md-12 col-lg-12 pr-0">
                                    <label>Hyperlink : <a class="text-danger">*</a></label>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <input name="banner_hyperlink" type="text" class="form-control" value="<?php echo $banner_hyperlink; ?>" required>
                                </div>
                            </div>
                            <div class="row pt-2">
                                <div class="col-sm-12 col-md-12 col-lg-12 pr-0">
                                    <label>อัพโหลดรูปภาพ : <a class="text-danger">*</a></label>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <input type="file"  name="banner_url[]" class="form-control" value="" id="exampleInputFile" aria-describedby="fileHelp">
                                    <label  class="pt-15" for="first_name" >รูปหน้าปก ความละเอียด 1140 x 385 พิกเซล</label>
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
                       <button type="submit" class="btn btn-info waves-effect btn-block">แก้ไข Slide banner</button>
                  </div>                 
              </div>
          </div>

      </div>
      <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
  </div>
  </form>


