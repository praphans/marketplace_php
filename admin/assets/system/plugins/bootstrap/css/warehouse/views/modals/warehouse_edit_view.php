<!-- ============================================================== -->
<!----------------- Modals แก้ไขคลังเก็บสินค้า ------------------>
<!-- ============================================================== -->  
<?php
$attributes = array('id' => 'edit_warehouse');
echo form_open(base_url('warehouse/edit'), $attributes);
?>
<div id="myModalEditStock" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
  <div class="modal-dialog modal-xs">
      <div class="modal-content">
          <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel2">แก้ไขคลังเก็บสินค้า</h4>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          </div>
          <!-- from modal  -->
          <div class="modal-body">
              <from class="form-horizontal-opd33">
                  <div class="row p-l-20 p-r-10">
                      <div class="col-md-12 col-lg-12 pl-0">
                          <h5 class="text-themecolor text-lab">แก้ไขคลังเก็บสินค้า</h5>
                      </div> 

                      <div class="col-md-12 col-lg-12 pt-3 p-b-10 pl-0">
                          <div class="row">
                              <div class="col-sm-12 col-md-12 col-lg-12 pr-0">
                                  <label class="">ชื่อคลังเก็บสินค้า : <a class="text-danger">*</a></label>
                              </div>
                              <div class="col-sm-12 col-md-12 col-lg-12">
                                  <input name="warehouse" id="warehouse" type="text" class="form-control" placeholder="ระบุชื่อคลังเก็บสินค้า">
                                  <input type="hidden" name="id" id="warehouse_id">
                              </div>
                          </div>
                      </div>
                      <div class="col-md-12 col-lg-12 pt-3 p-b-10 pl-0">
                          <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12 pr-0">
                                <label class="">BP :</label>
                            </div>
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <select class="select2 form-control custom-select" name="warehouse_type_id" id="warehouse_type_id">
                                	<?php
										$CI =& get_instance();
										$type_list = $CI->model_warehouse->getWarehouseType();
										foreach($type_list as $row){
											$type_id = $row->id;
											$type = $row->type;
									?>
                                    	<option value="<?=$type_id;?>"><?=$type;?></option>
                                    <?php } ?>
                                </select>
                            </div>
                          </div>
                      </div>
                      <div class="col-md-12 col-lg-12 pt-4 p-b-10 pl-0">
                          <div class="row">
                              <div class="col-sm-12 col-md-12 col-lg-12 pr-0">
                                 <input name="default_warehouse" type="checkbox" id="basic_checkbox_default_warehouse" value="0" class="filled-in chk-col-light-green"/>
                                 <label for="basic_checkbox_default_warehouse" class="label-lab ">ตั้งป็นคลังเริ่มต้น</label>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-12 col-lg-12 pt-2 p-b-10 pl-0">
                          <div class="row">
                              <div class="col-sm-12 col-md-12 col-lg-12 pr-0">
                                  <label class="">รายละเอียด : </label>
                              </div>
                              <div class="col-sm-12 col-md-12 col-lg-12">
                                  <textarea name="warehouse_detail" id="warehouse_detail" type="text" class="form-control" rows="4" placeholder=""></textarea>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-12 col-lg-12 pt-3 p-b-10 pl-0">
                          <div class="row">
                              <div class="col-sm-12 col-md-12 col-lg-12 pr-0">
                                  <label class="">ตำแหน่ง : </label>
                              </div>
                              <div class="col-sm-12 col-md-12 col-lg-12">
                                  <textarea name="warehouse_location" id="warehouse_location" type="text" class="form-control" rows="4" placeholder=""></textarea>
                              </div>
                          </div>
                      </div>
                  </div>
              </from>
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
<!--------------- End Modals แก้ไขคลังเก็บสินค้า ---------------->
<!-- ============================================================== --> 