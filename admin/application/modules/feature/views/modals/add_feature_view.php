<?php
$attributes = array("add_feature", "enctype"=>"multipart/form-data");
echo form_open_multipart(base_url('feature/add_feature'), $attributes);
?>
<div id="myModalAddFeature" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
  <div class="modal-dialog modal-xs">
      <div class="modal-content">
          <div class="modal-header bg-header-modals">
              <h4 class="modal-title text-light" id="myModalLabel2">เพิ่ม Feature</h4>
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
                            <div class="row pt-2">
                                <div class="col-sm-12 col-md-12 col-lg-12 pr-0">
                                    <label>Feature สินค้า : <a class="text-danger">*</a></label>
                                    <input type="hidden" name="id" value="">
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <input name="featured_name" type="text" class="form-control" value="" required>
                                </div>
                            </div>
                            <div class="row pt-2">
                                <div class="col-sm-12 col-md-12 col-lg-12 pr-0">
                                    <label>ประเภท : <a class="text-danger">*</a></label>
                                    <input type="hidden" name="id" value="">
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <select class="form-control custom-select" name="featured_type" id="featured_type" onchange="hideTypyFeature();" >
                                      <!-- <option value="0">ไม่ระบุ</option> -->
                                      <?php
                                        $feature_list = $this->model_feature->getFeaturedType();
                                        foreach($feature_list as $row){
                                          $feature_type_id = $row->id;
                                          $type_name = $row->type_name;
                                      
                                      ?>
                                      <option value="<?php echo $feature_type_id;?>"<?php if($feature_type_id == 3){echo "selected";}?>><?php echo $type_name; ?></option>
                                      <?php } ?>
                                  </select>
                                </div>
                            </div>
                            <div class="row pt-2 hideDivTime">
                              <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12 p-t-5 ">
                                            <label class="">วันเริ่มต้นโปรโมชั่น : <a class="text-danger">*</a></label>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <input type="text" class="form-control confirmdate" name="startdate" placeholder="-/-/-" >
                                        </div>
                                  
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12 p-t-5">
                                            <div class="form-group mg-t-b-0">
                                                <label>เวลาเริ่มต้นโปรโมชั่น : <a class="text-danger">*</a></label>
                                                <div class="clockpicker col-md-12 pl-0 pr-0">
                                                    <input id="input-time-hr" type="text" class="form-control " name="starttime" placeholder="กรุณาระบุเวลา" value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12 p-t-5 ">
                                            <label class="">วันสิ้นสุดโปรโมชั่น : <a class="text-danger">*</a></label>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <input type="text" class="form-control confirmdate" name="enddate" placeholder="-/-/-" >
                                        </div>
                                  
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12 p-t-5">
                                            <div class="form-group mg-t-b-0">
                                                <label>เวลาสิ้นสุดโปรโมชั่น : <a class="text-danger">*</a></label>
                                                <div class="clockpicker col-md-12 pl-0 pr-0">
                                                    <input id="input-time-hr" type="text" class="form-control " name="endtime" placeholder="กรุณาระบุเวลา" value="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row pt-3">
                                <div class="col-sm-12 col-md-12 col-lg-12 pr-0">
                                    <label>Feature สินค้า : <a class="text-danger">*</a></label>
                                    <input type="hidden" name="id" value="">
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <input type="file"  name="featured_image[]" class="form-control" id="exampleInputFile" aria-describedby="fileHelp" required>
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
                       <button type="submit" class="btn btn-info waves-effect btn-block">เพิ่ม Feature</button>
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

    function hideTypyFeature(){
        var featured_type = $("#featured_type").val();
        if(featured_type == 1){
            $(".hideDivTime").show();
        }else if(featured_type == 2){
            $(".hideDivTime").show();
        }else{
            $(".hideDivTime").hide();
        }
        console.log(featured_type);
    }
    hideTypyFeature();
</script>





