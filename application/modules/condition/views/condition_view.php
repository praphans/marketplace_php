<?php $this->load->view("templates/header"); ?>

			<!-- - - - - - - - - - - - - - Page Wrapper - - - - - - - - - - - - - - - - -->
<div class="secondary_page_wrapper">
      
<div class="row">
<div class="container">
       <div class="col-md-12 col-sm-12 col-xs-12 padding-l_0 pt-15 padding-r-0">
           <div class="col-md-12 col-sm-12 col-xs-12 padding-l_0">
                <ul class="breadcrumbs">
                        <li><a href="<?php echo base_url(); ?>">หน้าหลัก</a></li>
                        <li><a href="#">ข้อกำหนดและเงื่อนไข</a></li>				
                </ul>
                
           </div>
            <div class="col-md-12 col-sm-12 col-xs-12 mobile_padding-l-15 pt-5 padding-l_0">
                <div class="theme_box">
                    <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12 padding-l_0">
                               
                                <?php echo $this->load->get_var('term'); ?>
                                
                            </div>
                    </div>
                </div>
            </div>
            
       </div>
</div>
</div>
</div><!--/ .page_wrapper-->
			
			<!-- - - - - - - - - - - - - - End Page Wrapper - - - - - - - - - - - - - - - - -->
<?php $this->load->view("templates/footer"); ?>
