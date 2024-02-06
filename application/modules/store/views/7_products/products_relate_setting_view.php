<?php $this->load->view("templates/header"); ?>
<link rel="stylesheet" href="<?php echo base_url('assets/js/clockpicker/clockpicker.css'); ?>">

<form id="form_product_setting" class="type_2" action="<?php echo base_url('store/products/createSetting'); ?>" method="post" enctype="multipart/form-data">
<div class="secondary_page_wrapper">

            <div class="container">

                <!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->
                <?php

                    
                    foreach($products as $row){
                        $product_id = $row->product_id;
                        $relate_id = $row->relate_id;
                        $store_id = $row->store_id;
                        $product_name = $row->product_name;
                        $product_brand = $row->product_brand;
                        $product_version = $row->product_version;
                        $product_category = $row->product_category;
                        $product_category_customer = $row->product_category_customer;
                        $product_subcategory = $row->product_subcategory;
                        $product_description = $row->product_description;
                        $product_price = $row->product_price;
                        $product_price_discount = $row->product_price_discount;
                        $product_percentage_discount = $row->product_percentage_discount;
                        $product_recommend = $row->product_recommend;
                        $product_is_relate = $row->product_is_relate;
                        $product_qty = $row->product_qty;
                        if($product_qty < 0 )$product_qty = 0;
                        $product_show = $row->product_show;
                        $product_type = $row->product_type;
                        $product_mode = $row->product_mode;
                        $product_status = $row->product_status;
                        $timestamp = $row->timestamp;
                        
                        $product_recommend_checked = ($product_recommend)?"checked":"";
                        $product_show_checked = ($product_show)?"checked":"";
                        
                        $images = $this->model_productmanager->getProductImageList($product_id);
                        $default_image = (count($images))?base_url($images[0]->image_url):$this->productmanager->default_image();
                    }

                    $origi_product_name ="";
                    $products_origi = $this->model_product->getProductByID($relate_id);
                    foreach($products_origi as $row){
                        $origi_product_name = $row->product_name;
                    }
                ?>
                <ul class="breadcrumbs">

                    <li><a href="<?php echo base_url(); ?>" class="notcursor">หน้าหลัก</a></li>
					<li><a href="<?php echo base_url("store"); ?>" class="notcursor">บัญชีร้านค้า</a></li>
                    <li><a href="<?php echo base_url("store/products"); ?>" class="notcursor">จัดการสินค้า</a></li>
                    <li><a href="<?php echo base_url("store/products/relate/".$relate_id); ?>" class="notcursor">ตัวเลือกสินค้า</a></li>
                    <li>ตั้งค่าการขาย</li>


                </ul>

                <!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->

                <div class="row">

                    <?php $this->load->view("store/templates/left_tab"); ?> 
					
                    <main class="col-md-9 col-sm-8 padding-l-0">

                        <h2>ตั้งค่าการขาย</h2>

                        <div class="theme_box">
                            <div class="row">
                            
                                <div id="product_image_container">
									<?php
                                        foreach($images as $row){
                                            $image_id = $row->id;
                                            $image_url = base_url($row->image_url);
                                        
                                    ?>
                                    <div class="col-md-3 col-sm-6 pd_add_img_box">
                                        <div class="image_wrap">
                                            <img src="<?php echo $image_url; ?>">
                                        </div>
                                    </div>
                                    
                                    <?php } ?>
                                    
                                </div>
                                    
                            </div>

                        </div>

                        <!-- ข้อมูลสินค้า -->
 
                        <div class="theme_box">      
                            <div class="row"> 
                                <div class="col-xs-12">
                                    <form class="type_2">

                                        <div>
                                            <!-- ----------------------------------------------ชื่อสินค้า------------------------------------------- -->

                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <h4><?php echo $origi_product_name; ?><h4>
                                                </div>
                                                <div class="col-xs-12">
                                                    <h4>ตัวเลือกสินค้า : <?php echo $product_name; ?><h4>
                                                </div>
                                            </div>
                                            <?php if($relate_id == 0){ //  ถ้าสินค้าเป็นสินค้าตัวเลือก ไม่ต้องกำหนดหมวดหมุ่ใหม่ ?>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label class="pt-10 ">หมวดหมู่ภายในร้าน:</label>
                                                </div>
                                                <div id="category_customer_container">
                                                	<?php
													$product_category_customer = explode(",",$product_category_customer);
													foreach($product_category_customer as $key=>$value){
															$current_product_category_customer_id = $value;
													?>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <div class='input-group'>
                                                                <div class="custom_select">
                                                                    <select class="form-control" id="length" name="product_category_customer[]">
                                                                        <?php
                                                                        $product_cate_cus = $this->model_productmanager->getProductCategoryCustomer();
                                                                        foreach($product_cate_cus as $row){
																			$selected = "";
                                                                            $id = $row->id;
                                                                            $category_name = $row->category_name;
																			if($id == $current_product_category_customer_id)$selected = "selected";
                                                                        ?>
                                                                        <option value="<?php echo $id; ?>" <?php echo $selected; ?>><?php echo $category_name; ?></option>
                                                                        
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                                <span class="input-group-addon">
                                                                        <button type="button" onClick="removeNewCategoryCustomer(this);" class="icon-trash"></button>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <?php } ?>
                                                    
												</div>
                                                
                                            </div>
                                            
                                            
                                            
                                            
                                            <div class="row">
                                                <div class="col-md-4   col-xs-12">
                                                    <button type="button" onClick="addNewCategoryCustomer();" class="btn-block button_dark_grey">+
                                                        เพิ่มการตั้งหมวดหมู่ภายในร้าน
                                                    </button>
                                                </div>

                                              
                                            </div>
                                            
                                            
                                            
                                            <div class="row">
                                               

                                                <div class="col-md-4 col-md-offset-8  col-xs-12">

                                                    <button type="button" onClick="saveNewCategoryCustomer(this);" class="btn-block button_blue">บันทึก</button>

                                                </div>
                                            </div>
                                            <?php } ?>
                                            <div class="row">
											<?php
												if(!$product_is_relate){
													$relate_active_one = "active";
													$relate_active_two = "";
													$relate_checked_one = "checked";
													$relate_checked_two = "";
												}else{
													$relate_active_one = "";
													$relate_active_two = "active";
													$relate_checked_one = "";
													$relate_checked_two = "checked";
												}
											?>
                                                <div class="row pt-10">
                                                    <div class="col-md-12">
                                                        <div class="">
                                                        	 <input type="hidden" name="product_is_relate" value="0" id="product_is_relat1" <?php echo $relate_checked_one; ?>>
                                                            
                                                            <div id="relate_container_one">
                                                                <div class="theme_box pb-5">
                                                                    <div class="row">
                                                                        <div class="col-xs-12">
                                                                            <h4>สินค้าในคลัง</h4>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-xs-12">
                                                                            <label class="product_qty"  for=" product_qty">จำนวนสินค้า:</label>
                                                                            <input onkeypress='return isNumberKey(event)' class="form-control" type="number" min="0" name="product_qty" id="product_qty" value="<?php echo $product_qty; ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row pt-5">
                               
                                                                        <div class="col-md-4 col-md-offset-8 col-xs-12">

                                                                            <button type="button" onclick="saveProductQty(this)" class="btn-block button_blue">บันทึก</button>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="theme_box pb-5">
                                                                    <div class="row pt-10">
                                                                        <div class="col-xs-12 ">
                                                                            <h4>ราคาสินค้า</h4>

                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-xs-12">
                                                                            <label class=" required" for="product_price">ราคาปกติ:</label>

                                                                        </div>
                                                                        <div class="col-xs-12 ">
                                                                            <input onkeypress='return isNumberKey(event)' class="form-control" type="number" min="0" onchange="calculatePercentPrice();"  name="product_price" id="product_price" value="<?php echo $product_price; ?>">
                                                                        </div>

                                                                    </div>
                                                                    <div class="row pt-10">
                                                                        <div class="col-md-12">
                                                                            <label class="" for="product_percentage_discount">ส่วนลด:</label>

                                                                        </div>
                                                                        <div class="col-md-3">
                                                                        <div class='input-group'>
                                                                            <input class="form-control" type="number" onchange="calculatePercentPrice();" onkeypress='return isNumberKey(event)' min="0" name="product_percentage_discount" id="product_percentage_discount" value="<?php echo $product_percentage_discount; ?>">
                                                                         	<div class='input-group-addon'>%</div>  
                                                                        </div>
                                                                        </div>
                                                                        <div class="col-md-1 pt-10">
                                                                                <label class="" for="product_price_discount">หรือ = </label>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div class='input-group'>
                                                                                    <input type="number" min="0" id="product_price_discount_disable" value="<?php echo ($product_price-$product_price_discount); ?>" disabled="disabled">
                                                                                    <input type="hidden" name="product_price_discount" id="product_price_discount" value="<?php echo $product_price_discount; ?>">
                                                                                    <div class='input-group-addon'>บาท</div>  
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="col-md-5 pt-10">
                                                                                <label>เว้นว่างไว้หากไม่ต้องการลดราคา</label>
                                                                        </div>
                                                                    </div>
                                                          
                                                                    <div class="row pt-10">
                                                                        <div class="col-md-12 pt-10">
                                                                            <label class="">ราคาที่ขายจริง: </label>
                                                                            <label id="product_price_discount_label" class="bold_font"><?php echo number_format($product_price_discount,2); ?></label>
                                                                        </div>
                                                                        <div class="col-md-3 pt-10">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4 col-xs-12">

                                                                        </div>

                                                                        <div class="col-md-4 col-xs-12">

                                                                        </div>

                                                                        <div class="col-md-4 col-xs-12">

                                                                            <button type="button" onclick="savePrice(this);" class="btn-block button_blue">บันทึก</button>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- ----------------------------------โปรโมชั่นร่วม------------------------------------------  -->
                                                                <div class="theme_box">
                                                                    <div class="row pt-10">
                                                                        <div class="col-xs-12 ">

                                                                            <h4>โปรโมชั่นร้านค้า</h4>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    
                                                                     <!--เริ่มต้นโปรโมชั่นปกติ-->
                                                                    <div id="promotion_container">
                                                                    	<?php
																			foreach($promotions_normal as $row){
																				$promo_id = $row->promo_id;
																				$relate_id = $row->relate_id;
																				$promo_name = $row->promo_name;
																				$promo_price = $row->promo_price;
																				$promo_startdate = $row->promo_startdate;
																				$promo_starttime = $row->promo_starttime;
																				$promo_enddate = $row->promo_enddate;
																				$promo_endtime = $row->promo_endtime;
																				
																				//if(!isset($promo_startdate))$promo_startdate = date("d/m/Y H:i:s");
																				//if(!isset($promo_enddate))$promo_enddate = date("d/m/Y H:i:s");
																				
																				
																		?>
                                                                    	<div class="promotion_child">
                                                                        <div class="row pt-10">
                                                                            <div class="col-xs-12 ">
                                                                                <label class=" required" for="first_name">ชื่อรายการโปรโมชั่น:</label>
                                                                            </div>
                                                                            <div class="col-xs-12 ">
                                                                                <input class="form-control" type="text" name="promo_name" id="promo_name" value="<?php echo $promo_name; ?>" placeholder="ตัวอย่าง : ปีใหม่ลด 10%">
                                                                                 <input type="hidden" name="promo_id" id="promo_id" value="<?php echo $promo_id; ?>">
                                                                            </div>
    
                                                                        </div>
                                                                        <div class="row pt-10">
                                                                            <div class="col-xs-12">
                                                                                <label class="" for="promo_startdate">เริ่มต้นวันที่:</label>
                                                                            </div>
                                                                            <div class="col-xs-6 ">
                                                                                <div class="form-group">
                                                                                    <div class="input-group promo_startdate">
                                                                                        <input type="text" name="promo_startdate" id="promo_startdate" class="form-control"  value="<?php echo $promo_startdate; ?>">
                                                                                        <span class="input-group-addon">
                                                                                            <span class="glyphicon glyphicon-calendar"></span>
                                                                                        </span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-xs-6 ">
                                                                                <div class="form-group">
                                                                                    <div class='input-group promo_starttime' data-placement="top" data-align="top" data-autoclose="true">
                                                                                        <input type='text' name="promo_starttime" value="<?php echo $promo_starttime; ?>" class="form-control" id="promo_starttime" />
                                                                                        <span class="input-group-addon">
                                                                                            <span class="glyphicon glyphicon-time"></span>
                                                                                        </span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row pt-10">
                                                                            <div class="col-xs-12 ">
                                                                                <label class="" for="promo_enddate">สิ้นสุดวันที่:</label>
                                                                            </div>
                                                                            <div class="col-xs-6 ">
                                                                                <div class="form-group">
                                                                                    <div class="input-group promo_enddate">
                                                                                            <input type="text" name="promo_enddate" id="promo_enddate"  class="form-control" value="<?php echo $promo_enddate; ?>">
                                                                                            <span class="input-group-addon">
                                                                                                <span class="glyphicon glyphicon-calendar"></span>
                                                                                            </span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-xs-6 ">
                                                                                <div class="form-group">
                                                                                    <div class='input-group promo_endtime' data-placement="top" data-align="top" data-autoclose="true">
                                                                                        <input type='text' name="promo_endtime" value="<?php echo $promo_endtime; ?>"  class="form-control" id="promo_endtime" />
                                                                                        <span class="input-group-addon">
                                                                                            <span class="glyphicon glyphicon-time"></span>
                                                                                        </span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row pt-10">
                                                                            <div class="col-xs-12 pt-10">
                                                                                <label class=" required">ราคาโปรโมชั่น:</label>
                                                                            </div>
                                                                            <div class="col-xs-4 ">
                                                                                <input  onkeypress='return isNumberKey(event)' class="form-control" type="text" name="promo_price" id="promo_price" placeholder="" value="<?php echo $promo_price; ?>">
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        
                                                                        <div class="row pt-10">
                                      
    
                                                                            <div class="col-md-4 col-md-offset-4 col-xs-12">
                                                                                <!--<button type="button" onclick="delPromotion(this);" class="btn-block button_blue">ลบโปรโมชั่นนี้</button>-->
                                                                            </div>
    
                                                                            <div class="col-md-4 col-xs-12 margin_m_t_0">
    
                                                                                <button type="button" onclick="savePromotion(this);" class="btn-block button_blue">บันทึกโปรโมชั่น</button>
    
                                                                            </div>
                                                                        </div>
                                                                        </div>
                                                                        
                                                                        <?php } ?>
                                                                        <!--โปรโมชั่นปกติ-->
                                                                        
                                                                        </div>
                                                                    
                                                                    
                                                                    
                                                                        <hr class="pt-5">
                                                                        <!--<div class="row">
                                       
                                                                            <div class="col-md-4 col-md-offset-4 col-xs-12 ">
                                                                            	<button type="button" onclick="addPromotion(this);" class="btn-block button_dark_grey">เพิ่มรายการโปรโมชั่นร้านค้า</button>
                                                                               
                                                                                    
                                                                                </a>
                                                                                
                                                                                
                                                                            </div>
    
                                                                    
                                                                        </div>-->
																	
                                                                    
                                                                    
                                                                </div>
																
                                                                
                                                               
                                                                <div class="theme_box">

																	<?php if(count($promotions_special)>0){ ?>
                                                                    <div class="row pt-10">
                                                                        <div class="col-xs-12">
                                                                            <h4>โปรโมชั่นร่วม</h4>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="theme_box pb-10">
                                                                    	<!--เริ่มต้นโปรโมรชั่นร่วม-->
                                                                    	<?php
																			foreach($promotions_special as $row){
																				$promo_id = $row->promo_id;
																				$join_id = $row->join_id;
																				$relate_id = $row->relate_id;
																				$promo_name = $row->promo_name;
																				$promo_price = $row->promo_price;
																				$promo_startdate = $row->promo_startdate;
																				$promo_starttime = $row->promo_starttime;
																				$promo_enddate = $row->promo_enddate;
																				$promo_endtime = $row->promo_endtime;
																				$promo_type = $row->promo_type;
																				$promo_status = $row->promo_status;
																				$status_name = $row->status_name;
																				$my_join_promo = $this->model_productmanager->getPromoJoinByJoinID($join_id);
																				foreach($my_join_promo as $row2){
																					$my_join_name = $row2->join_name;
																					$my_join_startdate = $row2->join_startdate;
																					$my_join_starttime = $row2->join_starttime;
																					$my_join_enddate = $row2->join_enddate;
																					$my_join_endtime = $row2->join_endtime;
																				}
																				if(count($my_join_promo) > 0){
																		?>
                                                                        <div class="row pt-10">
                                                                            <div class="col-xs-12">
                                                                                <label class="" >โปรโมชั่น :</label>
                                                                                <label><?php echo $my_join_name; ?></label>
                                                                            </div>
                                                                        </div>
                                                        
                                                                        <div class="row pt-10">
                                                                        
                                                                            <div class="col-md-12 col-sm-12 col-xs-12 ">
                                                                                <div class="row">
                                                                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                                                                        <label class="">เริ่มต้นวันที่:</label>
                                                                                        <label><?php echo $my_join_startdate; ?> เวลา <?php echo $my_join_starttime; ?></label>
                                                                                    </div>
                                                                                    <div class="col-md-6 col-sm-6 col-xs-6 mt-0">
                                                                                        <label class="" >สิ้นสุดวันที่:</label>
                                                                                        <label><?php echo $my_join_enddate; ?> เวลา <?php echo $my_join_endtime; ?></label>
                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row pt-10">
                                                                            <div class="col-xs-12 ">
                                                                                <label class="">ราคาโปรโมชั่น:</label>
                                                                                <label><b><?php echo $promo_price; ?></b> บาท</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row pt-10">
                                                                            <div class="col-xs-12 ">
                                                                                <label class="">สถานะ:</label>
                                                                                <label class="label label-success"><?php echo $status_name; ?></label>
                                                                            </div>

                                                                        </div>
                                                                        <hr />
                                                                        <!--สิ้นสุดโปรโมรชั่นร่วม-->
                                                                        <?php }} ?>
                                                                        
                                                                        
                                                                    </div>
                                                                    <hr class="pt-5">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <label class=" required">เลือกโปรโมชั่นที่ได้รับเชิญ:</label>
                                                                        </div>

                                                                    </div>
																	
                                                                    <?php } ?>
                                                                    <?php if(count($promotions_join)>0){ ?>
                                                                    
                                                                    <div id="promotion_join_container">
                                                                     <div class="promotion_child">
                                                                      <div class="row">
                                                                    <!-- โปรโมชั่นที่ได้รับเชิญ จะกลายไปเป็นโปรโมชั่นร่วม -->
                                                                    	<?php
																			$n = 0;
																			foreach($promotions_join as $row){
																				$checked = "";
																				$join_id = $row->join_id;
																				$join_name = $row->join_name;
																				$join_price = $row->join_price;
																				$join_image = $row->join_image;
																				$join_startdate = $row->join_startdate;
																				$join_starttime = $row->join_starttime;
																				$join_enddate = $row->join_enddate;
																				$join_endtime = $row->join_endtime;
																				$join_status = $row->join_status;
																				$timestamp = ($join_enddate." ".$join_endtime);
																				$join_image = base_url($join_image);
																				
																				if($n == 0){
																					//$checked = "checked";
																					$n++;
																				}
																		?>
                                                                       
                                                                       
                                                                        <div class="col-md-4 ">
                                                                            <div class="row pb-15">
                                                                                <div class="col-md-12 col-sm-12 col-xs-12 mg-t-10 pt-10 align_center ">
                                                                                <div class="countdown_container" timestamp="<?php echo $timestamp; ?>">
                                                                                
                                                                                </div>
                                                                                
                                                                                </div>
                                                                                <div class="col-md-12 ">
                                                                                    <div class="image_wrap">
                                                                                        <img src="<?php echo $join_image; ?>" alt="">

                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-12 pt-10">
                                                                                    <label class=""><?php echo $join_name; ?></label>

                                                                                </div>
                                                                                <div class="col-md-12 pt-5 ">
                                                                                    <label>ตั้งแต่ <?php echo $join_startdate; ?> ถึง <?php echo $join_enddate; ?></label>
                                                                                </div>
                                                                                <div class="col-md-12 pt-5 ">
                                                                                    <div class="form_el">
                                                                                        <input type="radio" name="join_id" id="join_id<?php echo $join_id; ?>" value="<?php echo $join_id; ?>" <?php echo $checked; ?>>
                                                                                        <label for="join_id<?php echo $join_id; ?>">เลือกโปรโมชั่นนี้</label>

                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <?php } ?>
                                                                        <!-- สิ้นสุด โปรโมชั่นที่ได้รับเชิญ จะกลายไปเป็นโปรโมชั่นร่วม -->
                                                                       
                                                                    </div>
                                                                    <div class="row pt-10">
                                                                        <div class="col-md-12 ">
                                                                            <div class="row pt-10">
                                                                                <div class="col-md-3 pt-5">
                                                                                    <label class=" required">ราคาที่จะร่วมโปรโมชั่น:</label>
                                                                                   
                                                                                </div>
                                                                                <div class="col-md-6 pt-5">
                                                                                        <input type="number"min="0" name="promo_price" id="promo_price" value="0">
                                                                                        <input type="hidden" name="join_id" id="join_id" value="<?php echo $join_id; ?>">
                                                                                    </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-4 col-xs-12 pt-5">

                                                                        </div>

                                                                        <div class="col-md-4 col-xs-12 pt-5">
                                                                            <button type="button" onclick="delPromotionJoin(this);" class="btn-block button_blue">ยกเลิก</button>
                                                                        </div>

                                                                        <div class="col-md-4 col-xs-12 pt-5 margin_m_t_0">

                                                                            <button type="button" onclick="savePromotionJoin(this);" class="btn-block button_blue">ขออนุมัติ</button>

                                                                        </div>
                                                                   
                                                                    </div>
                                                                    </div>
                                                                    
                                                                    </div>
                                                                    
                                                                    
                                                                    <!--<hr class="pt-5">
                                                                    <div class="row">
                                                                        <div class="col-md-4 col-xs-12">

                                                                        </div>
                                                                        <div class="col-md-4 col-xs-12">

                                                                            <button type="button" onclick="addPromotionJoin();" class="btn-block button_dark_grey">+
                                                                                เพิ่มคำขอร่วมรายการโปรโมชั่น
                                                                            </button>
                                                                        </div>

                                                                        <div class="col-md-4 col-xs-12">
                                                                        </div>
                                                                    </div>-->
                                                                    
                                                                    <?php } ?>
                                                                    
                                                                </div>
                                                                </div>
                                                                
                                                            
                                                            
                                                        </div>
                                                        <!-- -----------------------------------------------วิธีการชำระเงิน------------------------------------ -->
                                                      
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </form>
                                </div>
                            </div>
                                       
                            <div class="row pt-20">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <h4>วิธีการชำระเงิน</h4>
                                    </div>
                            </div>
                            <?php
								$payment_setting = $this->model_setting->getGatewayTypeByID($product_id);
								$option1 = 0;
								$option2 = 0;
								foreach($payment_setting as $setting){
									$gateway_type_id = $setting->gateway_type_id;
									$option1 = $setting->option1;
									$option2 = $setting->option2;
								}
							?>
                            <div class="row ">
                                <div class="col-md-12 col-xs-12">
                                    <label class="">เลือกวิธีชำระเงิน</label>
                                </div>
                                <div class="col-md-12 col-xs-12 pt-10">

                                    <div class="form_el">
                                        <input type="radio" name="gateway_type_id" class="gateway_type_id" id="radio_payment_1" value="1" checked>
                                        <label for="radio_payment_1">ไม่ต้องชำระตอนนี้จ่ายเมื่อได้รับมอบสินค้าหรือบริการ</label>
                                    </div>
                                </div>
                                <div class="col-md-12 col-xs-12 pt-10">
                                   
                                       
                                        <div class="row pt-10">
                                            <div class="col-md-3 col-sm-4 col-xs-12 pt-10">
                                                <input type="radio" name="gateway_type_id" class="gateway_type_id" id="radio_payment_2" value="2">
                                                <label for="radio_payment_2">ชำระล่วงหน้า</label>
                                            </div>
                                            <div class="col-md-2 col-sm-2 col-xs-12 ">
                                                <input type="number" min="0" name="option1" id="option1" onchange="calPayBefore();" value="<?php if(isset($option1)) echo $option1; ?>">
                                            </div>
                                            <div class="col-md-2 col-sm-3 col-xs-12 pt-10">
                                                <label for="first_name">จ่ายส่วนที่เหลือ</label>
                                            </div>
                                            <div class="col-md-2 col-sm-2 col-xs-12">
                                                <input type="number" min="0" name="option2" id="option2" onchange="calPayAfter();" value="<?php if(isset($option2)) echo $option2; ?>">
                                            </div>
                                            <div class="col-md-3 col-sm-12 col-xs-12 pt-10">
                                                <label for="first_name">เมื่อได้รับมอบสินค้าหรือบริการ</label>
                                            </div>
                                        </div>   

                                </div>
                                <div class="col-md-12 col-xs-12 pt-10">
                                    <div class="form_el pt-10">
                                        <input type="radio" name="gateway_type_id" class="gateway_type_id" id="radio_payment_3" value="3">
                                        <label for="radio_payment_3">ชำระเต็มจำนวน</label>
                                    </div>
                                </div>
                                <div class="col-md-12 col-xs-12">
                  
                                        <div class="col-md-4 col-md-offset-8 col-xs-12 pt-10">

                                            <button type="button" onclick="savePayment(this);" class="btn-block button_blue">บันทึกวิธีการชำระเงิน</button>

                                        </div>
                                </div>
                            </div>
                        
                        </div>

                    </main>
                    <!--/ [col]-->

                </div>
                <!--/ .row-->

            </div>
            <!--/ .container-->

        </div>
        <!--/ .page_wrapper-->
</form>
        


<?php //$this->load->view("store/modal/modal_add_category_customer"); ?>
<script>
var product_id = "<?php if(isset($product_id)) echo $product_id; ?>";
</script>
<?php $this->load->view("templates/footer"); ?>

<script src="<?php echo base_url('assets/js/bootstrap-datepicker.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/clockpicker/clockpicker.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/moment.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/moment-countdown.min.js'); ?>"></script>
<?php $this->load->assets_by_name("left_tab","js"); ?>
<?php $this->load->assets_by_name("ProductSetting"); ?>
<script>
var gateway_type_id = parseInt("<?php if(isset($gateway_type_id)) echo $gateway_type_id; ?>");
var promo_startdate = parseInt("<?php if(isset($promo_startdate)) echo $promo_startdate; ?>");
var promo_enddate = parseInt("<?php if(isset($promo_enddate)) echo $promo_enddate; ?>");
var promo_starttime = parseInt("<?php if(isset($promo_starttime)) echo $promo_starttime; ?>");
var promo_endtime = parseInt("<?php if(isset($promo_endtime)) echo $promo_endtime; ?>");

if(gateway_type_id){
	$('input:radio[name="gateway_type_id"]').each(function(){
		if(parseInt($(this).val()) == gateway_type_id){
			$(this).prop("checked",true);
		}
	});
}
console.log("promo_startdate : "+promo_startdate);
console.log("promo_enddate : "+promo_enddate);

if(!promo_startdate || !promo_enddate){
	$('#promo_startdate,#promo_enddate').datepicker({
				dateFormat: 'd-m-yy',
                inline: true,
                onSelect: function (dateText, inst) {
                    var date = $(this).datepicker('getDate'),
                        day = date.getDate(),
                        month = date.getMonth() + 1,
                        year = date.getFullYear();
                }
	}).datepicker("setDate", new Date());
}

function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
</script>
