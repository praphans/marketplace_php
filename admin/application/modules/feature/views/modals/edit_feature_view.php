<?php
$attributes = array("update_feature", "enctype"=>"multipart/form-data");
echo form_open_multipart(base_url('feature/update_feature'), $attributes);

foreach($featured as $row){
  $featured_id  = $row->id;
  $featured_name  = $row->featured_name;
  $featured_type  = $row->featured_type;
  $starttime  = $row->starttime;
  $endtime  = $row->endtime;
}

$newDateStr = date("m-d-Y H:i:s", strtotime($starttime));
$newDate = date("m-d-Y H:i:s", strtotime($endtime));

$dateStr = substr($starttime,0,10);
$timeStr = substr($starttime,11,8);

$date = substr($endtime,0,10);
$time = substr($endtime,11,8);

$dateStr = date("d-m-Y", strtotime($dateStr));
$date = date("d-m-Y", strtotime($date));

?>

<div id="myModalEditFeature" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
<input type="hidden" name="featured_id" value="<?php echo $featured_id; ?>">
  <div class="modal-dialog modal-xs">
      <div class="modal-content">
          <div class="modal-header bg-header-modals">
              <h4 class="modal-title text-light" id="myModalLabel2">แก้ไข Feature</h4>
              <button type="button" class="close text-white" data-dismiss="modal" aria-hidden="true">×</button>
          </div>

          <!-- from modal  -->
          <div class="modal-body">
                  <div class="row p-l-20 p-r-10">

                      <div class="col-md-12 col-lg-12 p-t-10 p-b-10 pl-0">
                            
                            <div class="row pt-2">
                                <div class="col-sm-12 col-md-12 col-lg-12 pr-0">
                                    <label>Feature สินค้า : <a class="text-danger">*</a></label>
                                    <input type="hidden" name="id" value="">
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <input name="featured_name" type="text" class="form-control" value="<?php echo $featured_name; ?>" required>
                                </div>
                            </div>
                            <div class="row pt-2">
                                <div class="col-sm-12 col-md-12 col-lg-12 pr-0">
                                    <label>ประเภท : <a class="text-danger">*</a></label>
                                    <input type="hidden" name="id" value="">
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <select class="form-control custom-select" name="featured_type" id="featured_edit_type" onchange="hideTypyFeatureEdit();" >
                                      <!-- <option value="0">ไม่ระบุ</option> -->
                                      <?php
                                        $feature_list = $this->model_feature->getFeaturedType();
                                        foreach($feature_list as $row){
                                          $feature_type_id = $row->id;
                                          $type_name = $row->type_name;
                                      
                                      ?>
                                      <option value="<?php echo $feature_type_id;?>" <?php if($featured_type == $feature_type_id){echo 'selected';} ?>><?php echo $type_name; ?></option>
                                      <?php } ?>
                                  </select>
                                </div>
                            </div>
                            <div class="row pt-2 hideDivTimeEdit">
                              <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12 p-t-5 ">
                                            <label class="">วันเริ่มต้นโปรโมชั่น : <a class="text-danger">*</a></label>
                                        </div>
                                        <div class="col-sm-12 col-md-12 col-lg-12">
                                            <input type="text" class="form-control confirmdate" name="startdate" placeholder="-/-/-" value="<?php echo $dateStr; ?>" >
                                        </div>
                                  
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12 p-t-5">
                                            <div class="form-group mg-t-b-0">
                                                <label>เวลาเริ่มต้นโปรโมชั่น : <a class="text-danger">*</a></label>
                                                <div class="clockpicker col-md-12 pl-0 pr-0">
                                                    <input id="input-time-hr" type="text" class="form-control " name="starttime" placeholder="กรุณาระบุเวลา" value="<?php echo $timeStr; ?>">
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
                                            <input type="text" class="form-control confirmdate" name="enddate" placeholder="-/-/-" value="<?php echo $date; ?>">
                                        </div>
                                  
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-12 col-lg-12 p-t-5">
                                            <div class="form-group mg-t-b-0">
                                                <label>เวลาสิ้นสุดโปรโมชั่น : <a class="text-danger">*</a></label>
                                                <div class="clockpicker col-md-12 pl-0 pr-0">
                                                    <input id="input-time-hr" type="text" class="form-control " name="endtime" placeholder="กรุณาระบุเวลา" value="<?php echo $time; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row pt-2 hideDivTimeEdit">
                                <div class="col-sm-12 col-md-12 col-lg-12 text-danger">
                                    <span id="showRemain"></span>
                                </div>
                            </div>
                            <div class="row pt-3">
                                <div class="col-sm-12 col-md-12 col-lg-12 pr-0">
                                    <label>อัพโหลดรูปภาพ : <a class="text-danger">*</a></label>
                                    <input type="hidden" name="id" value="">
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <input type="file"  name="featured_image[]" class="form-control" id="exampleInputFile" aria-describedby="fileHelp">
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
                       <button type="submit" class="btn btn-info waves-effect btn-block">แก้ไข Feature</button>
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

    function hideTypyFeatureEdit(){
        var featured_type = $("#featured_edit_type").val();
        // console.log("featured_type | "+featured_type)

        if(featured_type == 1){
            $(".hideDivTimeEdit").show();
            $(".hideRemain").show();
            countDown();
        }else if(featured_type == 2){
            $(".hideDivTimeEdit").show();
            $(".hideRemain").hide();
        }else{
            $(".hideDivTimeEdit").hide();
            $(".hideRemain").hide();
        }


        // if(featured_type == 1){
        //     $(".hideDivTimeEdit").show();
        //     $(".hideRemain").show();
        //     countDown();
        // }else if(featured_type == 2){
        //     $(".hideDivTime").show();
        //     $(".hideRemain").hide();
        // }else{
        //     $(".hideDivTimeEdit").hide();
        //     $(".hideRemain").hide();
        // }
        // console.log("featured_type || "+featured_type);
    }
    hideTypyFeatureEdit();


    function countDown(){
        var timeA = new Date(); // วันเวลาปัจจุบัน
        var newDate = new Date("<?php echo $newDate; ?>"); // วันเวลาสิ้นสุด รูปแบบ เดือน/วัน/ปี ชั่วโมง:นาที:วินาที
       
        if(newDate == "" || newDate == "000-00-00 00:00:00" || newDate == "000-00-00 00:00:00.000000"){
          var timeB = new Date();
        }else{
          var timeB = newDate;
        }

        var timeDifference = timeB.getTime()-timeA.getTime();    
        if(timeDifference>=0){
            timeDifference=timeDifference/1000;
            timeDifference=Math.floor(timeDifference);
            var wan=Math.floor(timeDifference/86400);
            var l_wan=timeDifference%86400;
            var hour=Math.floor(l_wan/3600);
            var l_hour=l_wan%3600;
            var minute=Math.floor(l_hour/60);
            var showPart=document.getElementById('showRemain');
            showPart.innerHTML="เหลือเวลา "+wan+" วัน "+hour+" ชั่วโมง "
            +minute+" นาที "; 
                if(wan==0 && hour==0 && minute==0){
                    clearInterval(iCountDown); // ยกเลิกการนับถอยหลังเมื่อครบ
                    $(".hideRemain").hide();
                }
        }
    }
    // การเรียกใช้
    var iCountDown=setInterval("countDown()",1000); 

</script>





