<!-- ============================================================== -->
<!----------------- Modals เพิ่มประเภทสินค้าและบริการ ------------------>
<!-- ============================================================== -->  
<?php
$attributes = array('id' =>'update_product_subcategory');
echo form_open_multipart(base_url('category/update_product_subcategory'), $attributes);

?>
<div id="myModalEditProductSubcategory" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
  <div class="modal-dialog modal-xs">
      <div class="modal-content">
          <div class="modal-header bg-header-modals">
              <h4 class="modal-title text-light" id="myModalLabel2">แก้ไขหมวดหมู่สินค้าย่อย</h4>
              <button type="button" class="close text-white" data-dismiss="modal" aria-hidden="true">×</button>
          </div>
          <?php
            foreach($product_sub as $row){
                $category_name = $row->category_name;
                $category_id = $row->category_id;
                $id = $row->id;
            }
          
          ?>
          <!-- from modal  -->
          <div class="modal-body">
            <div class="row p-l-20 p-r-10">
                <div class="col-md-12 col-lg-12 p-t-10 p-b-10 pl-0">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 pr-0">
                            <label class="">ชื่อหมวดหมู่สินค้าย่อย : <a class="text-danger">*</a></label>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <input name="category_name" type="text" class="form-control" value="<?php echo $category_name; ?>" required>
                            <input name="id" type="hidden" value="<?php echo $id; ?>">
                            <input name="category_id" type="hidden" value="<?php echo $category_id; ?>">
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-lg-12 p-t-10 p-b-10 pl-0">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12 pr-0">
                            <label class="">อัพโหลดรูปภาพใหม่ : <a class="text-danger">*</a></label>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <input type="file"  name="category_image[]" class="form-control" id="exampleInputFile" aria-describedby="fileHelp" required>
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
                       <button type="submit" class="btn btn-info waves-effect btn-block">แก้ไขหมวดหมู่สินค้าย่อย</button>
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