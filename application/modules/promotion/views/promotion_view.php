<?php $this->load->view("templates/header"); ?>

			<!-- - - - - - - - - - - - - - Page Wrapper - - - - - - - - - - - - - - - - -->
<div class="secondary_page_wrapper">

    <div class="container">
		<ul class="breadcrumbs">

            <li><a href="<?php echo base_url(); ?>">หน้าหลัก</a></li>
            <li><a href="<?php echo base_url("promotion"); ?>">โปรโมชั่น</a></li>

        </ul>
        <div class="row">
            <main class="col-md-12 col-sm-12 padding-l-0">
                <div class="row">
                	<?php
					foreach($promotions as $row){
						$promo_id = $row->promo_id;
						$promo_url = $row->promo_url;
						$promo_name = $row->promo_name;
						$promo_image = $row->promo_image;
						$timestamp = $row->timestamp;
					?>
                    <div class="col-md-12">
                        <a href="<?php echo $promo_url; ?>"  target="_blank" class="thumbnail entry_image_set">
                            <img class="size_image_h300"  src="<?php echo base_url($promo_image); ?>" alt="<?php echo $promo_name; ?>">
                        </a>
                    </div>
                    
                    <?php } ?>
                </div>
            </main>
            <!--/ [col]-->

        </div>
        <!--/ .row-->

    </div>
    <!--/ .container-->

</div>
<!--/ .page_wrapper-->
			
			<!-- - - - - - - - - - - - - - End Page Wrapper - - - - - - - - - - - - - - - - -->
<?php $this->load->view("templates/footer"); ?>
