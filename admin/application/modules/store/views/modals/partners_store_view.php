
<style type="text/css">
  .img-responsive{
    height: 200px !important;
    /*width: 100px !important;*/
  }
  .bg-modals{
    background-color: #f2f4f8;
  }
</style>
<div id="myModalPartner" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
<div class="modal-dialog modal-xlg">
      <div class="modal-content">
          <div class="modal-header bg-header-modals">
              <h4 class="modal-title text-light" id="myModalLabel2">คู่ค้าของร้านค้า</h4>
              <button type="button" class="close text-white" data-dismiss="modal" aria-hidden="true">×</button>
          </div>
          <!-- from modal  -->
          <div class="modal-body ">


              <div class="row p-l-20 p-r-10">
                <?php 
                  foreach($store_id_list as $k=>$v){
                    
                    $partner_store_id = $v;
                    
                    if($partner_store_id){
                      $store = $this->model_partner->getStoreByID($partner_store_id);
                      foreach($store as $row){
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
                        $address = $row->address;
                        $store_is_vat = $row->store_is_vat;
                        $zipcode = $row->zipcode;
                        $account_name = $row->account_name;
                        $account_number = $row->account_number;
                        $bank_name = $row->bank_name;
                        $timestamp = $row->timestamp;

                        $avatar = "../".$store_avatar;
                        $store_img = base_url($avatar);

                        $link = base_url("store/storeDescription/".$store_id);
                        
                      }
                    
                  
                ?>
                 <div class="col-lg-3 col-md-6">
                      <div class="card">
                          <!-- <img class="card-img-top img-responsive" src="../assets/images/big/img1.jpg" alt="Card image cap"> -->
                          <img class="card-img-top img-responsive" src="<?php echo $store_img; ?>" alt="<?php echo $store_name; ?>">
                          <div class="card-body bg-modals">
                              <h4 class="card-title"><?php echo $store_name; ?></h4>
                              <p class="card-text"><?php echo $store_category; ?></p>
                              <p class="card-text"><?php echo $store_follower; ?> ผู้ติดตาม</p>

                              <a href="<?php echo $link; ?>" class="btn btn-primary btn-block">ดูเพิ่มเติม</a>
                          </div>
                      </div>
                  </div>
                  <?php }} ?>
                  
              </div>
             
          </div>
          <!-- close from modal  -->

          <div class="modal-footer d-flex justify-content-center">
              <div class="row w-100">
                  <div class="col-sm-12 col-md-4 button-group text-center btn-footer">
                       <!-- contant -->
                  </div>

                  <div class="col-sm-12 col-md-4 button-group text-center btn-footer">
                      <button type="button" class="btn btn-default waves-effect btn-block" data-dismiss="modal">ปิด</button>
                  </div>
                               
              </div>
          </div>

      </div>
      <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
  </div>
  