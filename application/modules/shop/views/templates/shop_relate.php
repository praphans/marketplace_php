<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->
<?php
foreach($mystore as $row){
	$store_id = $row->store_id;
	$store_category = $row->store_category;
}
?>
<section class="section_offset mobile_only_hide">

    <form class="type_2">
    
        <div class="table_layout list_view">
    
            <div class="table_row">
    
                <!-- - - - - - - - - - - - - - Manufacturer - - - - - - - - - - - - - - - - -->
    
                <div class="table_cell">
    
                    <fieldset>
    
                        <legend>ร้านค้าที่คุณอาจสนใจ</legend>
    
                        <ul class="checkboxes_list">
    
                            <?php
							
    						$related_store = $this->model_shop->getStoreRecommend($store_category);
                            foreach($related_store as $row){
                                $store_id = $row->store_id;
                                $member_id = $row->member_id;
                                $store_code = $row->store_code;
                                $store_name = $row->store_name;
                                $store_avatar = $row->store_avatar;
                                $store_cover = $row->store_cover;
                                $store_description = $row->store_description;
                                $store_url = $row->store_url;
								$store_rating = $row->store_rating;
								$store_follower = $row->store_follower;
								$store_code = $row->store_code;
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
                                
                               // $store_url = base_url('market/'.$store_url);
                                $store_avatar = base_url($store_avatar);
                                $store_cover = base_url($store_cover);
                                
                                $province = $this->storemanager->getDistrictName($province);
                                $amphur = $this->storemanager->getAmphurName($amphur);
                                $district = $this->storemanager->getProvinceName($district);
                            
								$store_name = $this->utils->string_shorten($store_name,20,40);
                            ?>

                            <li>
                                <a class="feature_list_shop_mini" href="<?php echo base_url($store_url); ?>">
                                    <div class="product_item ">
                                        <div class="image_wrap">
                                            <img src="<?php echo $store_avatar; ?>" alt="<?php echo $store_name; ?>">
                                        </div><!--/. image_wrap-->
                                        <div class="full_description">
                                            <span class="shop_title"><?php echo $store_name; ?></span>
                                            <div class="v_centered">
                                                
                                                    <div class="star-ratings">
                                                      <div class="fill-ratings" style="width: <?php echo $store_rating; ?>%;">
                                                        <span>★★★★★</span>
                                                      </div>
                                                      <div class="empty-ratings">
                                                        <span>★★★★★</span>
                                                      </div>
                                                    </div>
                                                
                                                                        
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            
                            <?php } ?>
                            
                        </ul>
    
                    </fieldset>
    
                </div><!--/ .table_cell -->
    
                <!-- - - - - - - - - - - - - - End manufacturer - - - - - - - - - - - - - - - - -->
    
            </div><!--/ .table_row -->
    
        </div><!--/ .table_layout -->
    
    </form>
    
    </section>