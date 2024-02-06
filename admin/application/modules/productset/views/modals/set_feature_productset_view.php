<?php
$attributes = array("updateSetFeature", "enctype"=>"multipart/form-data");
echo form_open(base_url('productset/updateSetFeature'), $attributes);
?>
<div id="myModalSetFeature" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
<?php
  if(count($product_id_list)){
      for ($i=0; $i < count($product_id_list); $i++) { 
      $product_id = $product_id_list[$i];
  ?>
      <input type="hidden" name="product_id_list[]" value="<?php echo $product_id; ?>">
  <?php
      }
  }
?>
  <div class="modal-dialog modal-xs">
      <div class="modal-content">
          <div class="modal-header bg-header-modals">
              <h4 class="modal-title text-light" id="myModalLabel2">เพิ่มสินค้าเข้า Feature</h4>
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
                                    <label>ประเภท : <a class="text-danger">*</a></label>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <select class="form-control custom-select" name="product_featured" id="product_featured" >
                                      <option value="0">สินค้าทั่วไป</option>
                                      <?php
                                        $feature_list = $this->model_productset->getProductFeatured();
                                        foreach($feature_list as $row){
                                          $feature_id = $row->id;
                                          $featured_name = $row->featured_name;
                                      
                                      ?>
                                      <option value="<?php echo $feature_id;?>"><?php echo $featured_name; ?></option>
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
                       <button type="submit" id="submit_set_fearture" class="btn btn-info waves-effect btn-block">เพิ่มสินค้าเข้า Feature</button>
                  </div>                 
              </div>
          </div>

      </div>
      <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
  </div>
  </form>






