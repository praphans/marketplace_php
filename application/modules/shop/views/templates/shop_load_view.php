<div class="table_layout list_view list_view_products" id="products_container">

    <div class="table_row shop_list">

        <!-- - - - - - - - - - - - - - Shop - - - - - - - - - - - - - - - - -->
        <?php
        foreach($shop as $row){
            $store_id = $row->store_id;
            $member_id = $row->member_id;
            $store_name = $row->store_name;
            $store_avatar = $row->store_avatar;
            $store_cover = $row->store_cover;
            $store_description = $row->store_description;
			
			$store_rating = $row->store_rating;
			$store_follower = $row->store_follower;
			$store_code = $row->store_code;
			
            $store_url = $row->store_url;
            $store_type = $row->store_type;
            $store_category = $this->model_shop->getCategoryName($row->store_category);
            $store_status = $row->store_status;
            $first_name = $row->first_name;
            $last_name = $row->last_name;
            $identity_number = $row->identity_number;
            $tel = $row->tel;
            $province = $row->province;
            $amphur = $row->amphur;
            $district = $row->district;
            $address = $row->address;
            $store_is_vat = $row->store_is_vat;
            $zipcode = $row->zipcode;
            $account_name = $row->account_name;
            $account_number = $row->account_number;
            $bank_name = $row->bank_name;
            $timestamp = $row->timestamp;
            
            $store_url = base_url($store_url);
            
            $province = $this->storemanager->getDistrictName($province);
            $amphur = $this->storemanager->getAmphurName($amphur);
            $district = $this->storemanager->getProvinceName($district);
            
        ?>
        <a class="shop_list_box" href="<?php echo $store_url; ?>">
            <div class="table_cell col-md-4 col-sm-6 col-xs-6">

                <div class="product_item">

                    <!-- - - - - - - - - - - - - - Thumbmnail - - - - - - - - - - - - - - - - -->

                    <div class="image_wrap">

                        <img src="<?php echo base_url($store_avatar); ?>" alt="<?php echo $store_name; ?>">

                    </div><!--/. image_wrap-->

                    <!-- - - - - - - - - - - - - - End thumbmnail - - - - - - - - - - - - - - - - -->

                    <!-- - - - - - - - - - - - - - Full description (only for list view) - - - - - - - - - - - - - - - - -->

                    <div class="full_description">

                        <span class="shop_title"><?php echo $store_name; ?></span>
                        <span class="shop_title"><?php echo $store_category; ?></span>
                        <span class="shop_title"><?php echo $store_follower; ?> ผู้ติดตาม</span>

                        <div class="v_centered">

                            <!-- - - - - - - - - - - - - - Product rating - - - - - - - - - - - - - - - - -->
                       
                            <div class="star-ratings">
                              <div class="fill-ratings" style="width: <?php echo $store_rating; ?>%;">
                                <span>★★★★★</span>
                              </div>
                              <div class="empty-ratings">
                                <span>★★★★★</span>
                              </div>
                            </div>
                        
                                
                            <!-- - - - - - - - - - - - - - End of product rating - - - - - - - - - - - - - - - - -->

                        </div>

                    </div>

                    
                </div><!--/ .product_item-->

            </div>
        </a>

        <?php } ?>
        <!-- - - - - - - - - - - - - - End of shop - - - - - - - - - - - - - - - - -->
        

    </div><!--/ .table_row -->

</div><!--/ .table_layout -->

<footer class="bottom_box on_the_sides">

    <div class="left_side">
        <p><?php //echo $page_showing; ?></p>
    </div>

    <div class="right_side">
        <?php echo $pagination ?>  
    </div>

</footer>