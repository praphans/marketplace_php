<?php $this->load->view("templates/header"); ?>

			<!-- - - - - - - - - - - - - - Page Wrapper - - - - - - - - - - - - - - - - -->
<div class="secondary_page_wrapper">
               
    <div class="container">
            <ul class="breadcrumbs">
                    <li><a href="<?php echo base_url(); ?>">หน้าหลัก</a></li>
                    <li><a href="<?php echo base_url("faq"); ?>">ช่วยเหลือ</a></li>				
                
            </ul>
            <Label class="bold_font size_font">Q & A</Label>
           
        <div class="row pt-5">
          
            <div class="col-md-12 col-sm-12 col-xs-12 padding-l_0">
            
              <div class="col-md-12">
                    <ul class="tabs_nav clearfix margin-r-0">
                        <li class="active"><a class="col-md-6 col-sm-6 col-xs-12 text-center middle_btn " href="<?php echo base_url("faq/user"); ?>">บัญชีผู้ซื้อ</a></a></li>
                        <li><a class="col-md-6 col-sm-6 col-xs-12 text-center middle_btn " href="<?php echo base_url("faq/store"); ?>">บัญชีร้านค้า</a></li>
                    </ul>
              </div>
              <div class="tour_section type_2 initialized col-md-12 col-sm-12 col-xs-12 padding-l_0 pt-5">

                <!-- - - - - - - - - - - - - - Navigation of tour section - - - - - - - - - - - - - - - - -->

            <!--      <ul class="ts_nav clearfix ">
                    <li class="active"><a href="#tab-10" class="size_font-16">หัวข้อ</a></li>
                    <li><a href="#tab-11" class="size_font-16">หัวข้อ</a></li>
                    <li><a href="#tab-12" class="size_font-16">หัวข้อ</a></li>
                </ul> -->

                <div class="tour_section type_2 initialized col-md-3 col-sm-3 col-xs-12 ">
                <ul class="ts_nav width-245 width-250 width-150">
                	<?php 
					if(!isset($current_faq_category_id))$current_faq_category_id = 0;
					foreach($faq_category as $row){
						$faq_category_id = $row->faq_category;
						$category_name = $row->category_name;
						$active = "";
						if($current_faq_category_id == $faq_category_id){
							$active = "active";	
						}
					?>
                    <li class="<?php echo $active; ?>"><a class="size_font-16 pt-l-20 mb-pl-0 " href="<?php echo base_url("faq/user/".$faq_category_id); ?>"><?php echo $category_name; ?></a></li>
                    
                    <?php } ?>
                   
                </ul>
                </div>

                <div class="col-md-9 col-sm-9 col-xs-12 pt-5 " style="height: 300px; ">
                    <!-- 	ts_containers_wrap  style="height: 300px; " -->
                    <!-- - - - - - - - - - - - - - Tour section tab - - - - - - - - - - - - - - - - -->

                    <div id="tab-10" class="ts_container ">

                        <dl class="accordion">

                              
                              	<?php
								$isActive = 1;
								foreach($faqs as $row){
									$faq_ask = $row->faq_ask;
									$faq_ans = $row->faq_ans;
									$active = "";
									if($isActive){
										$active = "active";	
										$isActive = 0;
									}
								?>

                                <dt class="<?php echo $active; ?>">
                                        
                                        <label>
                                            <?php echo $faq_ask; ?>
                                        </label>
                                </dt>
                                <dd style="display: block;">
                                       <?php echo $faq_ans; ?>
                                </dd>

                              
                               <?php } ?>
                            

                        </dl>

                    </div><!--/ #tab-10-->

                    <!-- - - - - - - - - - - - - - End of tour section tab - - - - - - - - - - - - - - - - -->

                    <!-- - - - - - - - - - - - - - Tour section tab - - - - - - - - - - - - - - - - -->

                    

                    <!-- - - - - - - - - - - - - - End of tour section tab - - - - - - - - - - - - - - - - -->

                    

                    <!-- - - - - - - - - - - - - - End of tour section tab - - - - - - - - - - - - - - - - -->

                </div><!--/ .ts_containers_wrap -->
                
                <!-- - - - - - - - - - - - - - End of tour section containers - - - - - - - - - - - - - - - - -->
        
        
            </div>
        
      
            </div>  
        </div>
    </div>
</div><!--/ .page_wrapper-->
			
			<!-- - - - - - - - - - - - - - End Page Wrapper - - - - - - - - - - - - - - - - -->
<?php $this->load->view("templates/footer"); ?>
<?php $this->load->assets_by_name('Faq'); ?>
<script>
var _height = $(".accordion").height();
var _parent = $(".ts_container").parent();
_parent.css("height",_height);

$('.accordion').on('show.bs.collapse', function () {
	_height = $(".accordion").height();
	console.log(_height);
	$(".tab_containers_wrap").css("height",_height);
});

</script>