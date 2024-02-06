
<?php $this->load->assets_by_name('css/amsify.suggestags','css'); ?>   

<?php
$attributes = array("id" => "add_news", "enctype"=>"multipart/form-data");
echo form_open(base_url('news/add_news'), $attributes);
?>
<?php 
    foreach($news_category as $row){
        $id = $row->id;
    }

    $tag_id_arr = array();
    $tag_name_arr = array();
    $news_tag = $this->model_news->getNewsTage();
    foreach($news_tag as $row){
        $tag_id = $row->tag_id;
        $tag_name = $row->tag_name;
        array_push($tag_id_arr,$tag_id);
        array_push($tag_name_arr,$tag_name);
    }
    $json_id = json_encode($tag_id_arr);
    $json_name = json_encode($tag_name_arr);
    
?>
<style type="text/css">

.panel-heading{
    background-color: #FFFFFF;
}  
.note-editable{
    height: 520px !important;
}
</style>

<div id="myModalAddNews" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
  <div class="modal-dialog modal-xlg">
      <div class="modal-content">
          <div class="modal-header bg-header-modals">
              <h4 class="modal-title text-light" id="myModalLabel2">เพิ่มบทความ</h4>
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
                            <div class="row pt-3">
                                <div class="col-sm-12 col-md-12 col-lg-12 pr-0">
                                    <label>เพิ่มหัวข้อบทความ : <a class="text-danger">*</a></label>
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <input name="new_header" type="text" class="form-control" value="" required>
                                </div>
                            </div>
                            <div class="row pt-3">
                                <div class="col-sm-12 col-md-12 col-lg-12 pr-0">
                                    <label>หมวดหมู่บทความ : <a class="text-danger">*</a></label>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12 ">
                                    <select class="form-control" name="category_id" required>
                                        <option value="">ไม่ระบุ</option>
                                        <?php
                                            $category_list = $this->model_news->getCategory();
                                            foreach($category_list as $row){
                                                $category_id = $row->id;
                                                $category_name = $row->category_name;
                                        
                                        ?>
                                        <option value="<?php echo $category_id;?>"><?php echo $category_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row pt-3">
                                <div class="col-sm-12 col-md-12 col-lg-12 p-t-5">
                                    <label >เนื้อหาบทความ : <a class="text-danger">*</a></label>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <textarea class="summernote" name="new_content">
                                      
                                    </textarea>
                                    <!-- <textarea name="new_content" class="form-control" rows="4" required></textarea> -->
                                </div>
                            </div>
                            <div class="row pt-3">
                                <div class="col-sm-12 col-md-12 col-lg-12 p-t-5">
                                    <div class="form-group mg-t-b-0">
                                        <label>รูปภาพหน้าปก</label>
                                        <input type="file"  name="new_image[]" class="form-control" id="exampleInputFile" aria-describedby="fileHelp" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row pt-3">
                                <div class="col-sm-12 col-md-12 col-lg-12 p-t-5">
                                    <label >Tag : <a class="text-danger">*</a></label>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12">
                                    <input name="new_tags" type="text" class="new_tags" value="" required>
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
                       <button type="submit" class="btn btn-info waves-effect btn-block">เพิ่มบทความ</button>
                  </div>                 
              </div>
          </div>

      </div>
      <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
  </div>
  </form>




<?php $this->load->assets_by_name('js/jquery.amsify.suggestags'); ?> 

<script>
  
  // satrt summernote **********
jQuery(document).ready(function() {

    $('.summernote').summernote({
        height: 350, // set editor height
        minHeight: null, // set minimum height of editor
        maxHeight: null, // set maximum height of editor
        focus: false // set focus to editable area after initializing summernote
    });

    $('.inline-editor').summernote({
        airMode: true
    });

});

window.edit = function() {
        $(".click2edit").summernote()
    },
    window.save = function() {
        $(".click2edit").summernote('destroy');
    }

// satrt tag **********
  var tag_id_arr = JSON.parse('<?php echo $json_id; ?>');
  var tag_name_arr = JSON.parse('<?php echo $json_name; ?>');
  $('.new_tags').amsifySuggestags({
    type : 'amsify',
    suggestions: tag_name_arr,
    classes: ['bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white','bg-primary text-white','bg-success text-white'
    ,'bg-danger text-white','bg-warning text-white',],// สี tag
    whiteList: true
  });

</script>
