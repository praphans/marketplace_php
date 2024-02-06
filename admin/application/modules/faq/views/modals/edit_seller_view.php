<!-- ============================================================== -->
<!----------------- Modals ------------------>
<!-- ============================================================== -->  
<?php

foreach($faq as $row){
    $faq_id = $row->faq_id;
    $faq_ask = $row->faq_ask;
    $faq_ans = $row->faq_ans;
    $faq_type = $row->faq_type;
    $faq_category = $row->faq_category;
}

?>
<form class="form-horizontal-opd33" method="post" action="<?php echo base_url("faq/updateFaq"); ?>">
<input type="hidden" name="faq_id" value="<?php echo $faq_id;?>">
<input type="hidden" name="faq_type" value="<?php echo $faq_type;?>">
<div id="myModalEditfaqSeller" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
<div class="modal-dialog modal-xs">
      <div class="modal-content">
          <div class="modal-header bg-header-modals">
              <h4 class="modal-title text-light" id="myModalLabel">แก้ไขคำถามที่พบบ่อย</h4>
              <button type="button" class="close text-white" data-dismiss="modal" aria-hidden="true">×</button>
          </div>
          <!-- from modal  -->
          <div class="modal-body">
                  <div class="row p-l-20 p-r-10">
                      <div class="col-md-12 col-lg-12 p-t-10 p-b-10 pl-0">
                          <div class="row">
                              <div class="col-sm-12 col-md-12 col-lg-12 pr-0">
                                  <label class="">คำถาม : <a class="text-danger">*</a></label>
                              </div>
                              <div class="col-sm-12 col-md-12 col-lg-12">
                                
                                  <textarea name="faq_ask" rows="3" type="text" class="form-control"><?php echo $faq_ask;?></textarea>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-12 col-lg-12 p-t-10 p-b-10 pl-0">
                          <div class="row">
                              <div class="col-sm-12 col-md-12 col-lg-12 pr-0">
                                  <label class="">คำตอบ : <a class="text-danger">*</a></label>
                              </div>
                              <div class="col-sm-12 col-md-12 col-lg-12">
                                  <textarea name="faq_ans" rows="4" type="text" class="form-control"><?php echo $faq_ans;?></textarea>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-12 col-lg-12 p-t-10 p-b-10 pl-0">
                          <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12 pr-0">
                                  <label class="">ประเภท : <a class="text-danger">*</a></label>
                              </div>
                              <div class="col-sm-12 col-md-12 col-lg-12">
                                  <select class="form-control custom-select" name="faq_category" id="faq_category">
                                      <option value="0">ไม่ระบุ</option>
                                      <?php
                                        $faq_cat_list = $this->model_faq->getFaqCategory();
                                        foreach($faq_cat_list as $row){
                                          $faq_cat_id = $row->id;
                                          $category_name = $row->category_name;
                                      
                                      ?>
                                    <option value="<?php echo $faq_cat_id;?>" <?php if($faq_category == $faq_cat_id){echo 'selected';} ?> ><?php echo $category_name; ?></option>
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

<!-- ============================================================== -->
<!--------------- End Modals  ---------------->
<!-- ============================================================== --> 