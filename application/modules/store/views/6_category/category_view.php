<?php $this->load->view("templates/header"); ?>



<div class="secondary_page_wrapper">

            <div class="container">

                <!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

                <ul class="breadcrumbs">

                    <li><a href="<?php echo base_url(); ?>" class="notcursor">หน้าหลัก</a></li>
					<li><a href="<?php echo base_url('store'); ?>" class="notcursor">บัญชีร้านค้า</a></li>
                    <li>จัดการหมวดหมู่ในร้าน</li>



                </ul>

                <!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->

                <div class="row">

                    <?php $this->load->view("store/templates/left_tab"); ?>

                    <main class="col-md-9 col-sm-8 padding-l-0">

                        <div class="section_offset">

                            <div class="row">

                                <section class="col-sm-12">
                                    <div class="theme_box">
                                        <div class="row">
                                            <div class="col-md-8 col-sm-6 col-xs-12">
                                                    <h3>จัดการหมวดหมู่ในร้าน</h3>
                                            </div>
                                            <div class="col-md-4 col-sm-6 col-xs-12 pt-0">
                                                    <button type="button" data-toggle="modal" data-target ="#modal_add_category_customer" class="btn-block button_blue middle_btn text-center"><i class="icon-plus"></i>เพิ่มหมวดหมู่</button>
                                            </div>
                                        </div>
                               
                               		
                                        <div class="row"> 
                                        	<?php
											foreach($categorys as $row){
												$checked = "";
												$id = $row->id;
												$store_id = $row->store_id;
												$category_name = $row->category_name;
												$category_status = $row->category_status;
												if($category_status == 1){
													$checked = "checked";
												}else{
													$checked = "";
												}
											?>
                                            <div class="col-md-12 pt-10">
                                               
                                            </div>
                                            <div class="col-md-8 col-sm-6 col-xs-12">
                                                 <label><?php echo $category_name; ?></label>
                                            </div>
                                            <div class="col-md-2 col-sm-4 col-xs-12 pt-10">
                                                <div class="form_el"> 
                                                    <input type="checkbox" name="category_status" value="<?php echo $id; ?>" id="checkbox_<?php echo $id; ?>"  <?php echo $checked; ?>>
                                                    <label for="checkbox_<?php echo $id; ?>">เปิดใช้งาน</label>   
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <button type="button" onclick="delCategory(<?php echo $id; ?>)" class="button_dark_grey middle_btn icon-trash"></button>
                                            </div>
                                            
                                            <?php } ?>
                                            
                                            
                                        </div>
                                        

                                    </div>
                                </section>
                                <!--/ [col]-->
                            </div>
                            <!--/ .row -->
                            <footer class="bottom_box on_the_sides">
                                <div class="left_side">
                                   <p><?php echo $page_showing; ?></p>
                                </div>
                                <div class="right_side">
									<?php echo $pagination ?>  
                                </div>

                            </footer>

                        </div>
                        <!--/ .section_offset -->

                    </main>
                    <!--/ [col]-->

                </div>
                <!--/ .row-->

            </div>
            <!--/ .container-->

        </div>
        <!--/ .page_wrapper-->
        

<?php $this->load->view("store/6_category/modals/modal_add_category_customer"); ?>
<?php $this->load->view("templates/footer"); ?>
<?php $this->load->assets_by_name("left_tab","js"); ?>
<?php $this->load->assets_by_name("Category","js"); ?>