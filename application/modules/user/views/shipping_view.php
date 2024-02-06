<?php $this->load->view("templates/header"); ?>

<div class="secondary_page_wrapper">

    <div class="container">

        <!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

        <ul class="breadcrumbs">

            <li><a href="<?php echo base_url(); ?>" class="notcursor">หน้าหลัก</a></li>
            <li><a href="<?php echo base_url("user"); ?>" class="notcursor">บัญชีผู้ซื้อ</a></li>
            <li>ตั้งค่าที่อยู่</li>

        </ul>

        <!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->

        <div class="row">

            <aside class="col-md-3 col-sm-4">

                <!-- - - - - - - - - - - - - - Information - - - - - - - - - - - - - - - - -->

                <?php $this->load->view("user/templates/left_tab"); ?>

                <!-- - - - - - - - - - - - - - End of information - - - - - - - - - - - - - - - - -->

            </aside><!--/ [col]-->

            <main class="col-md-9 col-sm-8 padding-l-0">
				
               <!-- Start สถานที่ -->
                <div class="theme_box">
                    <div class="row" style="float:right;">
                        <div class="col-md-12">
                          <button data-toggle="modal" data-target ="#modal_shop_add_address" class="btn-block button_blue middle_btn text-center"><i class="icon-plus"></i>เพิ่มสถานที่</button>
                        </div>
                    </div>
                    
                    <?php
                    
                    foreach($user_place as $row){
                        $place_id = $row->place_id;
                        $place_code = $row->place_code;
                        $store_id = $row->store_id;
                        $shipping_type_id = $row->shipping_type_id;
                        $place_name = $row->place_name;
                        $place_province = $row->place_province;
                        $place_amphur = $row->place_amphur;
                        $place_district = $row->place_district;
                        $place_address = $row->place_address;
                        $place_postcode = $row->place_postcode;
                        $place_mobile = $row->place_mobile;
                        $working_time_id = $row->working_time_id;
                        $place_lat = $row->place_lat;
                        $place_long = $row->place_long;
                        $place_condition = $row->place_condition;
						
						$name = $row->name;
						$identity_number = $row->identity_number;
                       
						if(empty($name))$name = '-';
						if(empty($identity_number))$identity_number = '-';
						
						$place_is_default = $row->place_is_default;
						$place_is_default_tax = $row->place_is_default_tax;
						
						$place_is_default = ($place_is_default)?"checked":"";
						$place_is_default_tax = ($place_is_default_tax)?"checked":"";
						
						/*echo $place_is_default."<br>";
						echo $place_is_default_tax."<br>";
						echo "---------------";*/
                        $working = $this->storemanager->working_time($place_id);
                    ?>
                    <div class="row">
                        <div class="col-xs-12">
                            <h5><?php echo $place_name; ?></h5>
                        </div>
                        
                        <!--<div class="col-md-3 form_group">
                            <label>รหัสสถานที่ :</label>
                        </div>
                        <div class="col-md-9 form_group">
                           <b> <?php echo $place_code; ?></b>
                        </div>-->
                        
                        <div class="col-md-3 form_group">
                            <label>ชื่อที่ใช้ในการออกใบเสร็จ :</label>
                        </div>
                        <div class="col-md-9 form_group">
                           <b> <?php echo $name; ?></b>
                        </div>
                        <div class="col-md-3 form_group">
                            <label>เลขบัตรประชาชน / นิติบุคคล :</label>
                        </div>
                        <div class="col-md-9 form_group">
                           <b> <?php echo $identity_number; ?></b>
                        </div>
                        
                        
                        <div class="col-md-3 form_group">
                            <label>ที่อยู่ :</label>
                        </div>
                        <div class="col-md-9 form_group">
                        
                            <?php echo $place_address; ?> 
                            <?php echo $this->storemanager->getDistrictName($place_district); ?>
                            <?php echo $this->storemanager->getAmphurName($place_amphur); ?>
                            <?php echo $this->storemanager->getProvinceName($place_province); ?>
                            <?php echo $place_postcode; ?>
                       </div>
                       
                        <div class="col-md-3 form_group">
                            <label>โทรศัพท์ :</label>
                        </div>
                        <div class="col-md-9 form_group">
                            <?php echo $place_mobile; ?>
                        </div>
                        <div class="col-md-3 form_group">
                            <label>อธิบายเส้นทาง :</label>
                        </div>
                        <div class="col-md-9 form_group">
                            <?php echo $place_condition; ?>
                        </div>
                        <div class="col-md-12 pt-10">
                            
                                <input <?php echo $place_is_default; ?> onchange="updatePlace_is_default(<?php echo $place_id; ?>,0);" type="checkbox" name="place_is_default" class="place_is_default" place_id="<?php echo $place_id; ?>" id="place_is_default<?php echo $place_id; ?>">
                                <label for="place_is_default<?php echo $place_id; ?>">ตั้งเป็นที่อยู่เริ่มต้นในการรับสินค้า</label>
                           
                                
                           
                        </div>
                        <div class="col-md-12 pt-10">
                            
                                <input <?php echo $place_is_default_tax; ?> onchange="updatePlace_is_default(<?php echo $place_id; ?>,1);" type="checkbox" name="place_is_default_tax" class="place_is_default_tax" place_id="<?php echo $place_id; ?>" id="place_is_default_tax<?php echo $place_id; ?>">
                                <label for="place_is_default_tax<?php echo $place_id; ?>">ตั้งเป็นที่อยู่เริ่มต้นในการออกใบเสร็จ / ใบกำกับภาษี</label>
                           
                        </div>
                        
                       <div class="col-md-12 pt-10">
                        
                            <a target="_blank" href="https://www.google.com/maps/search/?api=1&query=<?php echo $place_lat; ?>,<?php echo $place_long; ?>" class="button_blue">ดูแผนที่</a>
                       
                            <a href="<?php echo site_url("user/editShipping/".$place_id); ?>" class="button_blue">แก้ไขข้อมูล</a>
                       
                            <button type="button" onclick="onCancelPlace(<?php echo $place_id; ?>);" class="button_dark_grey">ยกเลิกสถานที่</button>
                      
                     </div>
                     </div>
                    <br />
                    <hr />
                    <br />
                    <?php } ?>
                    
                </div>
                <!-- End สถานที่ -->

                
            </main><!--/ [col]-->

            

        </div><!--/ .row-->

    </div><!--/ .container-->

</div><!--/ .page_wrapper-->
            
<?php $this->load->view("user/modals/modal_user_add_address"); ?>          
<?php $this->load->view("templates/footer"); ?>
<?php $this->load->assets_by_name('Shipping'); ?>
<?php $this->load->assets_by_name('Left_tab'); ?>
