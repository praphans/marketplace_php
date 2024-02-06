<aside class="col-md-3 col-sm-4 mobile_only_hide">
    <section class="section_offset">
        <ul class="theme_menu">
            <?php
                $store_status = $this->session->userdata('store_status');
                if($store_status == 1 || $store_status == 3 || $store_status == 4 || $store_status == 6){
            ?>  
                <li><a href="<?php echo site_url("store/registration"); ?>">ข้อมูลทะเบียนร้านค้า</a></li>
                <li><a href="<?php echo site_url("store/profile"); ?>">ข้อมูลโปรไฟล์ร้านค้า</a></li>
            <?php
                }else{
            ?>
                <li><a href="<?php echo site_url("store/dashboard"); ?>">ผลการดำเนินงาน</a></li>
                <li><a href="<?php echo site_url("store/saleitem"); ?>">รายการขาย</a></li>
                <li><a href="<?php echo site_url("store/deliverylist"); ?>">รายการจัดส่งสินค้า</a></li>
                <li><a href="<?php echo site_url("store/itemstores"); ?>">รายการระหว่างร้านค้า</a></li>
                <li><a href="<?php echo site_url("store/coupon"); ?>">จัดการคูปอง</a></li>
                <li><a href="<?php echo site_url("store/category"); ?>">จัดการหมวดหมู่ในร้าน</a></li>
                <li><a href="<?php echo site_url("store/products"); ?>">จัดการสินค้า</a></li>
                <li><a href="<?php echo site_url("store/shipping"); ?>">ช่องทางการส่งสินค้า</a></li>
                <li><a href="<?php echo site_url("store/requestplace"); ?>">รายการขอใช้สถานที่</a></li>
                <li><a href="<?php echo site_url("store/partner"); ?>">คู่ค้าของฉัน</a></li>
                <li><a data-toggle="collapse" href="#collapseExample">ส่งข่าวสาร <span class="caret"></span></a></li>
                <div class="collapse" id="collapseExample">
                  <div class="card card-body">
                    <ul class="theme_menu" style="text-indent:30px;">
                        <li><a href="<?php echo site_url("message/create/2/0/5"); ?>">ถึง ผู้ติดตาม</a></li>
                        <li><a href="<?php echo site_url("message/create/2/0/6"); ?>">ถึง คู่ค้า</a></li>
                    </ul>
                  </div>
                </div>

                <li><a href="<?php echo site_url("store/registration"); ?>">ข้อมูลทะเบียนร้านค้า</a></li>
                <li><a href="<?php echo site_url("store/profile"); ?>">ข้อมูลโปรไฟล์ร้านค้า</a></li>
            <?php     
                }                       
            ?>
            
            
        </ul>
    </section>
</aside>

<div class="container mobile_only_show">
<button class="button_grey_outline btn-block text-left" type="button" data-toggle="collapse" data-target="#left_tab" aria-expanded="false" aria-controls="left_tab">
        แผงควบคุมบัญชีร้านค้า <span class="caret"></span>
</button>
</div>
<aside class="col-md-3 col-sm-4 collapse" id="left_tab">
    <section class="section_offset">
        <ul class="theme_menu">
            <li><a href="<?php echo site_url("store/dashboard"); ?>">ผลการดำเนินงาน</a></li>
            <li><a href="<?php echo site_url("store/saleitem"); ?>">รายการขาย</a></li>
            <li><a href="<?php echo site_url("store/deliverylist"); ?>">รายการจัดส่งสินค้า</a></li>
            <li><a href="<?php echo site_url("store/itemstores"); ?>">รายการระหว่างร้านค้า</a></li>
            <li><a href="<?php echo site_url("store/coupon"); ?>">จัดการคูปอง</a></li>
            <li><a href="<?php echo site_url("store/category"); ?>">จัดการหมวดหมู่ในร้าน</a></li>
            <li><a href="<?php echo site_url("store/products"); ?>">จัดการสินค้า</a></li>
            <li><a href="<?php echo site_url("store/shipping"); ?>">ช่องทางการส่งสินค้า</a></li>
            <li><a href="<?php echo site_url("store/requestplace"); ?>">รายการขอใช้สถานที่</a></li>
            <li><a href="<?php echo site_url("store/partner"); ?>">คู่ค้าของฉัน</a></li>
            <li><a data-toggle="collapse" href="#collapseExample_2">ส่งข่าวสาร <span class="caret"></span></a></li>
            <div class="collapse" id="collapseExample_2">
              <div class="card card-body">
                <ul class="theme_menu" style="text-indent:30px;">
            		<li><a href="<?php echo site_url("message/create/2/0/5"); ?>">ถึง ผู้ติดตาม</a></li>
                	<li><a href="<?php echo site_url("message/create/2/0/6"); ?>">ถึง คู่ค้า</a></li>
                </ul>
              </div>
            </div>
            <li><a href="<?php echo site_url("store/registration"); ?>">ข้อมูลทะเบียนร้านค้า</a></li>
            <li><a href="<?php echo site_url("store/profile"); ?>">ข้อมูลโปรไฟล์ร้านค้า</a></li>
            
        </ul>
    </section>
</aside>
<div class="margin-t-10"></div>

