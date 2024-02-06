<!-- ============================================================== -->
<!----------------- Modals เพิ่มประเภทร้านค้าและบริการ ------------------>
<!-- ============================================================== -->  
<?php
$attributes = array("id" => "add_promotions", "enctype"=>"multipart/form-data");
echo form_open(base_url('promotions/promo_website/add_promo_website'), $attributes);
?>
<div id="myModalAddPromoWeb" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
  <div class="modal-dialog modal-xs">
      <div class="modal-content">
          <div class="modal-header bg-header-modals">
              <h4 class="modal-title text-light" id="myModalLabel">เพิ่มโปรโมชั่นเว็บไซต์</h4>
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
                                    <label>เพิ่มชื่อโปรโมชั่น : <a class="text-danger">*</a></label>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <input name="promo_name" type="text" class="form-control" value="" required>
                                </div>
                            </div>
                            <div class="row pt-2">
                                <div class="col-sm-12 col-md-12 col-lg-12 pr-0">
                                    <label>Hyperlink : <a class="text-danger">*</a></label>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <input name="promo_url" type="text" class="form-control" value="" required>
                                </div>
                            </div>
                            <div class="row pt-2">
                                <div class="col-sm-12 col-md-12 col-lg-12 p-t-5">
                                    <div class="form-group mg-t-b-0">
                                        <label>อัพโหลดรูปโปรโมชั่น</label>
                                        <input type="file"  name="promo_image[]" class="form-control" id="exampleInputFile" aria-describedby="fileHelp" required>
                                    </div>
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
                       <button type="submit" class="btn btn-info waves-effect btn-block">เพิ่มโปรโมชั่นเว็บไซต์</button>
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
    $('.confirmdate').datepicker({
        format: 'dd-mm-yyyy',
        language: "th-th",
        todayHighlight: true,
        ignoreReadonly: true
    });
     $('.clockpicker ').clockpicker({
      donetext: 'Done',
      placement: 'top',
      align: 'left',
      autoclose: true,
    });
</script>
<!-- ============================================================== -->
<!--------------- End Modals เพิ่มประเภทร้านค้าและบริการ ---------------->
<!-- ============================================================== --> 