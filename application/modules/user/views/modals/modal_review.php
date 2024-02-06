<form id="form_review" class="type_2" action="<?php echo site_url("user/addReview"); ?>" method="post" enctype="multipart/form-data">
<input type="hidden" name="review_rating" id="review_rating" value="0"/>
<input type="hidden" name="order_id" id="order_id"/>
<input type="hidden" name="store_id" id="store_id"/>
<input type="hidden" name="product_id" id="product_id"/>
<input type="hidden" name="review_type" id="review_type"/>

<div id="modal_review" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">เขียนรีวิว</h4>
      </div>
      <div class="modal-body col-md-12">

                <div class="row">
                    <div class="col-xs-12 entry_meta ">
                        <i class="star icon-star-empty-1 str-icon"></i>
                        <i class="star icon-star-empty-1 str-icon"></i>
                        <i class="star icon-star-empty-1 str-icon"></i>
                        <i class="star icon-star-empty-1 str-icon"></i>
                        <i class="star icon-star-empty-1 str-icon"></i>
                        <i class="">คลิกเพื่อให้ดาว</i>
                        
                    </div>
                    <div class="col-xs-12  ">
                     <textarea rows="4" name="review_content" id="review_content" placeholder="ใส่ข้อความรีวิว"></textarea>
                    </div>
                    <div class="col-xs-12 pt-10">
                    	<p><?php echo $this->load->get_var('store_review_description'); ?></p>
                    </div>
                    
                    
                </div>
        		
        
		</div>
      <div class="modal-footer">
      	<button type="button" class="btn button_dark_grey" data-dismiss="modal"><i class="icon-cancel-2"></i> ยกเลิก</button>
        
        <label for="review_images" class="btn button_blue custom-file-upload">
            <i class="icon-upload-cloud"></i> อัพโหลดไฟล์<span class="filename"></span>
        </label>
        <input type="file" name="review_images[]" id="review_images"  multiple accept="image/png,image/gif,image/jpeg">
        
        <button type="submit" class="btn button_blue"><i class="icon-paper-plane"></i> ส่งรีวิว</button>
      </div>
    </div>
  </div>
</div>
</form>

<script src="<?php echo base_url('assets/js/jquery-2.1.1.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/config.js'); ?>"></script>
<script>
$(".star").click(function() {
	var index = $( ".star" ).index(this);

	for (var i = 0; i < 5; i++) {
		if(i <= index){
			$('.star').eq(i).addClass('icon-star-1');
			$('.star').eq(i).removeClass('icon-star-empty-1');
		}else{
			$('.star').eq(i).addClass('icon-star-empty-1');
			$('.star').eq(i).removeClass('icon-star-1');
		}	
	}
	$("#review_rating").val(index+1);

}); 

// check ดาว
$("#form_review").submit(function(){
  var is_uploaded = true;

  if($("#review_rating").val() == 0){
    is_uploaded = false;
  }

  if(!is_uploaded){
    swal("เดี๋ยวก่อน","กรุณาให้ดาวเพื่อทำการรีวิว!","info");
    return false;
  }

  // alert("is_uploaded | "+is_uploaded);

  $(this).submit();
});
</script>