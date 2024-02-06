<?php $this->load->view("templates/header"); ?>




<form class="type_2" action="<?php echo base_url("cart/createorder"); ?>" method="post" id="create_order">
<input type="hidden" name="order_store_shipping_charge" id="order_store_shipping_charge" value="0" />
<div class="secondary_page_wrapper">
	
    <div class="container">
		

        <ul class="breadcrumbs">

            <li><a href="<?php echo base_url(); ?>">หน้าหลัก</a></li>
            <li><a href="<?php echo base_url("cart"); ?>">สั่งซื้อสินค้า</a></li>
            <li>เลือกช่องทางการรับสินค้า</li>

        </ul>
		
        
        <section class="section_offset">

            <h2 class="pt-10" >เลือกช่องทางการรับสินค้า</h2>

            <?php
				$radio = 0;
				$store_location_open = false;
				$agent_location_open = false;
				$user_location_open = false;
				
				foreach($shipping as $k=>$v){
					if($v == 1){
						$store_location_open = true;
					}else if($v == 2){
						$agent_location_open = true;
					}else if($v == 3){
						$user_location_open = true;
					}
				}
			?>
      		<dl class="accordion">
                
                <?php if($user_location_open){ ?>
                <dt class="no_icon">
                    <input type="radio" name="order_shipping_type_id" class="order_shipping_type_id" value="4" id="radio_1" checked>
                    <label for="radio_1"><div class="font-18">ส่งที่อยู่ผู้ซื้อ</div></label>
                </dt>
                <dd class="row" style="margin-right:0 !important; margin-left:0 !important;">
                    <div class="col-md-12 pb-20">
                        <?php if(count($usereplace) > 0){ 
							echo 'เลือกที่อยู่ในการจัดส่ง';
						}else{
							echo 'คุณยังไม่ได้เพิ่มที่อยู่ในการจัดส่งสินค้า ออกใบเสร็จ ใบกำกับภาษี กรุณาคลิกปุ่มด้านล่างเพื่อเพิ่มสถานที่จัดส่งสินค้า';
						}
						?>
                    </div>
                    <?php 
					
					$n = 0;
					foreach($usereplace as $row){
						$name = $row->name;
						$identity_number = $row->identity_number;
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
						$place_is_default = $row->place_is_default;
						$place_condition = $row->place_condition;
						
						$store_shipping_charge = $this->model_location->getStoreShippingCharge($current_store_id);
						
						$place_address .= $this->storemanager->getDistrictName($place_district).' ';
						$place_address .= $this->storemanager->getAmphurName($place_amphur);
						$place_address .= $this->storemanager->getProvinceName($place_province);
						$place_address .= $place_postcode;
						$checked = "";
						if($n == 0){
							$checked = "checked";
							$n++;
						}
						if($place_is_default == 1){
							$checked = "checked";
							
						}
						$radio++;
					?>
                    <div class="col-md-12 pb-20">
                        <input type="radio" name="order_place_id" class="order_place_id" id="radio_order_place_id<?php echo $radio; ?>" <?php echo $checked; ?> value="<?php echo $place_id; ?>" store_shipping_charge="<?php echo $store_shipping_charge; ?>">
                        <label for="radio_order_place_id<?php echo $radio; ?>"><?php echo $place_name; ?></label>
                        <p class="pl-34" style="margin-bottom:0px !important; color:#333;"><?php echo $name; ?></p>
                        <p class="pl-34"><a target="_blank" href="<?php echo base_url("place/info/".$place_id); ?>"><?php echo $place_address; ?></a>
                        <a href="https://www.google.com/maps/search/?api=1&query=<?php echo $place_lat; ?>,<?php echo $place_long; ?>" class="  " target="_blank"><i class="icon-location"></i> ดูแผนที่</a></p>
                       
                    </div>
                    
                   <?php } ?>
                   
                   
              		<div class="col-md-12"> 
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-3">
                                <a href="<?php echo base_url("user/shipping"); ?>" class="button_blue middle_btn icon-location"> เพิ่มที่อยู่การจัดส่ง</a>
                            </div>
                        </div>
                    </div>
                </dd>
				<?php } ?>
				<?php if($agent_location_open && count($agentplace) > 0){ //รับที่ตัวแทนผู้ขาย ?>
<dt class="no_icon"><input type="radio" name="order_shipping_type_id" class="order_shipping_type_id" value="2" id="radio_2">
                    <label for="radio_2"><div class="font-18">รับที่ตัวแทนผู้ขาย </div></label>
                </dt>
                <dd class="row" style="margin-right:0 !important; margin-left:0 !important;">
                    <div class="col-md-12  pb-20">
                        <b class="font-weight-bold">เลือกสถานที่รับของ</b> (นำรหัสคูปองที่ระบบออกให้ มาแลกรับสินค้าหรือบริการตามเงือนไขในการสั่งซื้อ)
                    </div>
                    
                    <?php 
					
					foreach($agentplace as $row){
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
						
						
						//$store_shipping_charge = $this->model_location->getStoreShippingCharge($store_id);
						
						$place_address .= $this->storemanager->getDistrictName($place_district);
						$place_address .= $this->storemanager->getAmphurName($place_amphur);
						$place_address .= $this->storemanager->getProvinceName($place_province);
						$place_address .= $place_postcode;
						$checked = "";
						
						$radio++;
					?>
                    
                    <div class="col-md-12 pb-20">
                        <input type="radio" name="order_place_id" class="order_place_id" id="radio_order_place_id<?php echo $radio; ?>" <?php echo $checked; ?> value="<?php echo $place_id; ?>" store_shipping_charge="0">
                        <label for="radio_order_place_id<?php echo $radio; ?>"><?php echo $place_name; ?></label>
                       <p class="pl-34"><a target="_blank" href="<?php echo base_url("place/info/".$place_id); ?>"><?php echo $place_address; ?></a>
                        <a href="https://www.google.com/maps/search/?api=1&query=<?php echo $place_lat; ?>,<?php echo $place_long; ?>" class="  " target="_blank"><i class="icon-location"></i> ดูแผนที่</a></p>
                    </div>
                    
                    <?php } ?>
                    
                    
                </dd>
				<?php } ?>
                <?php if($store_location_open && count($storeplace) > 0){ // รับที่ผู้ขาย ?> 
				<dt class="no_icon">
					<input type="radio" name="order_shipping_type_id" class="order_shipping_type_id" value="1" id="radio_3">
                    <label for="radio_3"><div class="font-18">รับที่ผู้ขาย</div></label>
                </dt>
                <dd class="row" style="margin-right:0 !important; margin-left:0 !important;">
                    <div class="col-md-12  pb-20">
                        <b class="font-weight-bold">เลือกสถานที่</b> (นำรหัสคูปองที่ระบบออกให้ มาแลกรับสินค้าหรือบริการตามเงือนไขในการสั่งซื้อ)
                    </div>
                    
                    <?php 
					
					
					foreach($storeplace as $row){
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
						
						//$store_shipping_charge = $this->model_location->getStoreShippingCharge($store_id);
						
						$place_address .= $this->storemanager->getDistrictName($place_district);
						$place_address .= $this->storemanager->getAmphurName($place_amphur);
						$place_address .= $this->storemanager->getProvinceName($place_province);
						$place_address .= $place_postcode;
						$checked = "";
						
						$radio++;
					?>
                   
                    <div class="col-md-12 pb-20"> 
                    	<input type="radio" name="order_place_id" class="order_place_id" id="radio_order_place_id<?php echo $radio; ?>" <?php echo $checked; ?> value="<?php echo $place_id; ?>" store_shipping_charge="0">
                        <label for="radio_order_place_id<?php echo $radio; ?>"><?php echo $place_name; ?></label>
                        <p class="pl-34"><a target="_blank" href="<?php echo base_url("place/info/".$place_id); ?>"><?php echo $place_address; ?></a>
                        <a href="https://www.google.com/maps/search/?api=1&query=<?php echo $place_lat; ?>,<?php echo $place_long; ?>" class="  " target="_blank"><i class="icon-location"></i> ดูแผนที่</a></p>
                    </div>
                    <?php } ?>
                    
                    
                
                </dd>
				<?php } ?>
                
                
                
                <!--กรณีไม่ติ๊กเลือกอะไรเลย-->
                <?php if(!$user_location_open && !$store_location_open && !$agent_location_open){ ?>
                    
                <dt class="no_icon">
					<input type="radio" name="order_shipping_type_id" class="order_shipping_type_id" value="1" id="radio_3"  checked="checked">
                    <label for="radio_3"><div class="font-18">รับที่ผู้ขาย</div></label>
                </dt>
                <dd class="row">
                    <div class="col-md-12  pb-20">
                        <b class="font-weight-bold">เลือกสถานที่</b> (นำรหัสคูปองที่ระบบออกให้ มาแลกรับสินค้าหรือบริการตามเงือนไขในการสั่งซื้อ)
                    </div>
                    
                    <?php 
					
					$n = 0;
					foreach($storeplace as $row){
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
						
						//$store_shipping_charge = $this->model_location->getStoreShippingCharge($store_id);
						
						$place_address .= $this->storemanager->getDistrictName($place_district);
						$place_address .= $this->storemanager->getAmphurName($place_amphur);
						$place_address .= $this->storemanager->getProvinceName($place_province);
						$place_address .= $place_postcode;
						$checked = "";
						
						$radio++;
						$checked_default = "";
						if($n == 0){
							$n++;
							$checked_default = "checked";	
						}
					?>
                   
                    <div class="col-md-12 pb-20"> 
                    	<input type="radio" name="order_place_id" class="order_place_id" id="radio_order_place_id<?php echo $radio; ?>" <?php echo $checked; ?> value="<?php echo $place_id; ?>" store_shipping_charge="0" <?php echo $checked_default; ?>>
                        <label for="radio_order_place_id<?php echo $radio; ?>"><?php echo $place_name; ?></label>
                        <p class="pl-34"><a target="_blank" href="<?php echo base_url("place/info/".$place_id); ?>"><?php echo $place_address; ?></a>
                        <a href="https://www.google.com/maps/search/?api=1&query=<?php echo $place_lat; ?>,<?php echo $place_long; ?>" class="  " target="_blank"><i class="icon-location"></i> ดูแผนที่</a></p>
                    </div>
                    <?php } ?>
                    
                    
                
                </dd>
				<?php } ?>
                
                
                    
            </dl>
           
            <br />
            <br />
 		<div class="theme_box">
            <div class="row ">
                <div class="col-md-12 pb-10 pt-10">
                    <div class="form_el">
                        <input checked type="radio" name="order_buyer_place_is_hidden" class="order_buyer_place_is_hidden" id="order_place_is_hidden1" value="0">
                        <label for="order_place_is_hidden1"><h4>ซ่อนชื่อ และ ที่อยู่ผู้ซื้อ</h4></label>
                    </div>
                </div>
               
                <div class="col-md-12 pb-10 ">
                    <div class="form_el">
                        <input  type="radio" name="order_buyer_place_is_hidden" class="order_buyer_place_is_hidden" id="order_place_is_hidden2" value="1">
                        <?php
						if($store_is_vat == 1){
							$msg_vat = '';
							$msg_vat1 = 'ส่งชื่อ และ ที่อยู่ในการออกใบกำกับภาษี';
						}else{
							$msg_vat = '( ผู้ขายรายนี้ไม่ได้เป็นผู้ประกอบการจดทะเบียนภาษีมูลค่าเพิ่ม )';
							$msg_vat1 = 'ส่งชื่อ และ ที่อยู่ในการออกใบเสร็จรับเงิน';
						}
						?>
                        <label for="order_place_is_hidden2"><h4><?php echo $msg_vat1; ?> </h4><span><small><?php echo $msg_vat; ?></small></span></label>
                    </div>
                </div>
            </div>

           
                <div class="row order_place_is_hidden_box">
                    <!--<div class="col-xs-12">
                        <h4>ชื่อและที่อยู่ในการออกใบเสร็จรับเงิน</h4>
                    </div>-->
                    <div class="col-xs-12">
                        <?php
						$member_id = $this->membermanager->member_id();
						$bill_address = $this->model_location->getAddressBillTax($member_id);
						foreach($bill_address as $row){
							$name = $row->name;
							$identity_number = $row->identity_number;
							$place_name = $row->place_name;
							$place_province = $row->place_province;
							$place_amphur = $row->place_amphur;
							$place_district = $row->place_district;
							$place_address = $row->place_address;
							$place_postcode = $row->place_postcode;
							$place_mobile = $row->place_mobile;
						}
						$my_address = "";
						if(count($bill_address)>0){
							$district = $this->storemanager->getDistrictName($place_district);
							$amphur = $this->storemanager->getAmphurName($place_amphur);
							$province = $this->storemanager->getProvinceName($place_province);
							$my_address = $place_address." ".$district." ".$amphur." ".$province." ".$place_postcode." โทร. ".$place_mobile;
						}
						//$name = $this->membermanager->first_name()." ".$this->membermanager->last_name();
						?>
                        <ul>
                            <li class="row pt-10">
                                <div class="col-xs-12">
                                    <label for="first_name" class="required">ชื่อบุคคล หรือ นิติบุคคล :</label>
                                    <input type="text" name="order_name" id="order_name" placeholder="กรุณาระบุชื่อบุคคล หรือ นิติบุคคล" value="<?php if(isset($name)) echo $name; ?>" >
                                </div>
                            </li>
                            <li class="row pt-10">
                                <div class="col-xs-12">
                                    <label for="first_name">เลขประจำตัวผู้เสียภาษี :</label>
                                    <input type="text" name="order_tax" id="order_tax" placeholder="000-000-000-0000" value="<?php if(isset($identity_number)) echo $identity_number; ?>" >
                                </div>
                            </li>
                            <li class="row pt-10">
                                <div class="col-xs-12">
                                    <label for="first_name" class="">รหัสสาขา :</label>
                                    <input type="text" name="order_branch" id="order_branch" placeholder="กรุณาระบุรหัสสาขา" >
                                </div>
                            </li>
                            <li class="row pt-10">
                                <div class="col-xs-12">
                                    
                                    <label for="order_address" class="required">ที่อยู่ และ เบอร์โทรศัพท์ :</label>
                                    <textarea id="order_address" name="order_address" placeholder="กรุณาระบุที่อยู่ และ เบอร์โทรศัพท์" ><?php if(isset($my_address)) echo $my_address; ?></textarea>
                                </div>
                            </li>
                        </ul>
                       
                  	</div>
                </div>
            </div>
           
            <br />
            <br />
            <?php if($coin > 0){ ?>
            <div class="theme_box coin_container">
                <div class="row">
                    <div class="col-xs-12">
                    	
                        <h4>จำนวนเหรียญในบัญชีของท่าน : <a class="total"> <?php echo number_format($coin); ?> </a> เหรียญ</h4>
                    </div>
                    <div class="col-xs-12">
                        <div class="row ">
                            <div class="col-md-12 pb-10 pt-10">
                                <div class="form_el">
                                    <input checked type="radio" class="order_use_coin_type"  name="order_use_coin_type" id="radio_11" value="1">
                                    <label for="radio_11">เก็บใว้ใช้ทีหลัง</label>
                                </div>
                            </div>
                            <?php
							if($product_price_payment <= $coin){
								
						
							?>
                            <div class="col-md-12 pb-10">
                                <div class="form_el">
                                    <input type="radio" class="order_use_coin_type" name="order_use_coin_type" id="radio_12" value="2" >
                                    <label for="radio_12">ใช้เหรียญจ่ายทั้งหมด</label>
                                </div>
                            </div>
                            <?php } ?>
                             <?php
							if($coin >0){
							?>
                            <div class="col-md-12 pb-10" >
                                <div class="form_el row" >
                                    <div class="col-sm-3 col-md-2 pr-0">
                                        <input type="radio" class="order_use_coin_type"  name="order_use_coin_type" id="radio_13" value="3">
                                        <label for="radio_13" >ใช้เหรียญในบัญชีจ่าย</label>
                                    </div>
                                    <div class="col-sm-4 col-md-3">
                                        <div class="form-group">
                                            <div class="input-group date" >
                                                <input onkeypress='return isNumberKey(event)' type='number' name="order_use_coin" id="order_use_coin" class="form-control" value="0" min="0"/>
                                                <span class="input-group-addon">
                                                    เหรียญ
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <?php } ?>
                            
                        </div>
                                        
                    </div>
                    
              	</div>
            </div>
			<?php } ?>
        </section>

        <div class="section_offset ">

            <div class="row">
				<section class="col-sm-6 col-md-8">
                    <!-- contant -->
                </section><!--/ [col] -->
                <section class="col-sm-6 col-md-4">
                    <div class="table_wrap">
                        <table class="zebra">
                            <tfoot>
                                <tr class="">
                                    <td>ราคาสินค้าทั้งหมด</td>
                                    <td class="text-right">฿<?php echo number_format($total_price,2); ?></td>
                                </tr>
                                <tr class="">
                                    <td>ค่าบริการจัดส่ง</td>
                                    <td class="text-right order_store_shipping_charge">฿0</td>
                                </tr>
                                <tr class="">
                                    <td>ใช้เหรียญ</td>
                                    <td class="text-right total_order_use_coin_type">0</td>
                                </tr>
                                <tr class="">
                                    <td>ยอดชำระคงเหลือ</td>
                                    <td class="text-right ">฿<?php echo number_format($product_price_balance,2); ?></td>
                                </tr>
                                <tr class="total">
                                    <td>ยอดชำระตอนนี้</td>
                                    <td class="text-right total_price_location">฿<?php echo number_format($product_price_payment,2); ?></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <footer class="bottom_box">
                    	 <input type="checkbox" name="term_condition" id="term_condition">
                         <label for="term_condition">ฉันได้อ่านและยอมรับ <a target="_blank" href="<?php echo base_url("condition"); ?>">ข้อกำหนดและเงื่อนไข</a> การใช้งานเรียบร้อยแล้ว</label>   
                         </br>
                    	<input type="hidden" name="product_price_payment" value="<?php echo $product_price_payment; ?>">
                        <input type="hidden" name="product_price_balance" value="<?php echo $product_price_balance; ?>"> 
                        
                        <button type="button" class="button_blue middle_btn btn-block icon-money omise-checkout-button-2"> ชำระเงิน</button>
                        <button type="submit" class="button_blue middle_btn btn-block icon-money omise-checkout-button-1"> ชำระเงิน</button>
                    </footer>
                </section>
            </div>
        </div>
        
    </div>

</div>
</form>

<?php $this->load->view("templates/footer"); ?>
<?php $this->load->assets_by_name('Cart'); ?>
<script type="text/javascript" src="https://cdn.omise.co/omise.js"></script>
<script>
var omise_key = "pkey_test_5f77edc0mdv5ycqkx9b";
var checkoutButton;
var coin = parseInt("<?php if(isset($coin)) echo $coin; ?>");
var total_price_location = parseInt("<?php if(isset($product_price_payment)) echo $product_price_payment; ?>");
var total_price_location_with_charge = total_price_location; 
$(".order_place_id").change(function(){
	var order_store_shipping_charge = parseInt($(this).attr("store_shipping_charge"));
	
	$("#order_store_shipping_charge").val(order_store_shipping_charge);
	$(".order_store_shipping_charge").text("฿"+order_store_shipping_charge);
	
	total_price_location_with_charge = total_price_location+order_store_shipping_charge;
	$(".total_price_location").text("฿"+numberWithCommas(total_price_location_with_charge));
	updateAmount();
	//if(checkoutButton)checkoutButton.show();
});

$("input[name='order_shipping_type_id']").change(function(){
	//console.log($(this).find(".order_place_id"));
	//$(this).find(".order_place_id").attr("checked",true);	
	$(".order_place_id").attr("checked",false);
	updateAmount();
	//if(checkoutButton)checkoutButton.hide();
});


$(".order_shipping_type_id").each(function(){
	var order_shipping_type_id_checked = false;					   
	if($(this).prop("checked")){
		order_shipping_type_id_checked = true;
	}
	console.log("order_shipping_type_id_checked = "+order_shipping_type_id_checked);
	if(!order_shipping_type_id_checked){
		$(".order_shipping_type_id").eq(0).prop("checked","checked");
	}
});

$(".order_place_id").each(function(){
	var order_place_id_checked = false;					   
	if($(this).prop("checked")){
		order_place_id_checked = true;
	}
	console.log("order_place_id_checked = "+order_place_id_checked);
	if(!order_place_id_checked){
		//$(".order_place_id").eq(0).prop("checked","checked");
	}
});
$("input[name='order_place_id']:checked").trigger("change");

$(".order_place_is_hidden_box").hide();	
$(".order_buyer_place_is_hidden").change(function(){
											
	if(parseInt($(this).val())){
		$(".order_place_is_hidden_box").show();	
	}else{
		$(".order_place_is_hidden_box").hide();	
	}
});

var issubmitting = false;
$("#create_order").submit(function(e){
	
	var formdata = $(this).serializeArray();
	var dataObj = new Object();
	$(formdata).each(function(i, field){
		console.log(field.name);
     	dataObj[field.name] = field.value;
    });
	var order_place_id = dataObj['order_place_id'];	
	if(!order_place_id){
		swal("ไม่พบสถานที่","กรุณาเลือกช่องทางการรับสินค้า","info");
		return false;
	}
	
	var order_buyer_place_is_hidden = $("input[type='radio'][name='order_buyer_place_is_hidden']:checked").val();
		
	if(parseInt(order_buyer_place_is_hidden) == 1){
		var order_name = dataObj['order_name'];	
		var order_tax = dataObj['order_tax'];	
		var order_address = dataObj['order_address'];	
		
		if(!order_name){
			swal("ใบเสร็จรับเงิน","กรุณาระบุชื่อที่ใช้ในการออกใบเสร็จ","info");
			return false;	
		}
		/*if(!order_tax){
			swal("ใบเสร็จรับเงิน","กรุณาระบุเลขประจำตัวผู้เสียภาษี ","info");
			return false;	
		}*/
		if(!order_address){
			swal("ใบเสร็จรับเงิน","กรุณาระบุที่อยู่ที่ใช้ในการออกใบเสร็จรับเงิน","info");
			return false;	
		}
	}
		
		
	var is_read_term = $("#term_condition").prop("checked");
	if(!is_read_term){
		swal("ข้อกำหนดและเงื่อนไข","กรุณาเลือกที่ ฉันได้อ่านและยอมรับข้อกำหนดและเงื่อนไขการใช้งาน","info");
		return false;	
	}
	
	if(amount_cal <= 0){
		$("#omise-checkout-button-1").attr("disabled","disabled");
		var $form = $(this);
		if ($form.data('submitted') === true) {
		  e.preventDefault();
		} else {
		  $form.data('submitted', true);
		  $(this).submit();
		}
	
	}
});
var order_use_coin_type = 1;

$(".order_use_coin_type").change(function(){
	order_use_coin_type = $(this).val();	
	
	var order_use_coin = $("#order_use_coin").val();
	//console.log("order_use_coin = "+order_use_coin);
	//console.log("total_price_location = "+total_price_location);
	if(order_use_coin > total_price_location_with_charge){
		order_use_coin = total_price_location_with_charge;
	}
		
	if(order_use_coin_type == 1){
		$(".total_order_use_coin_type").text(0);
	}else if(order_use_coin_type == 2){
		if(coin > 0 && coin >= total_price_location_with_charge){
			$("#order_use_coin").val(total_price_location_with_charge);
			$(".total_order_use_coin_type").text(total_price_location_with_charge);
		}
		
	}else if(order_use_coin_type == 3){
		
		if(coin > 0 && coin > total_price_location_with_charge){
			$("#order_use_coin").val(total_price_location_with_charge);
		}
		order_use_coin = $("#order_use_coin").val();
		$(".total_order_use_coin_type").text(order_use_coin);
	}
	updateAmount();
});
$("#order_use_coin").mousedown(function(){
	$(".order_use_coin_type").filter('[value=3]').prop('checked', true);
	order_use_coin_type = 3;
	updateAmount();
});
$("#order_use_coin").change(function(){
	console.log("order_use_coin_type : "+order_use_coin_type);
	var order_use_coin = parseInt($(this).val());
	if(order_use_coin > total_price_location_with_charge){
		order_use_coin = total_price_location_with_charge;
	}
	$(this).val(order_use_coin);
	if(order_use_coin > coin){
		order_use_coin = coin;
		$(".total_order_use_coin_type").text(order_use_coin);
		$("#order_use_coin").val(order_use_coin);
		swal("คุณมี "+coin+" เหรียญ","ไม่สามารถใช้เหรียญเกินจำนวนที่มีอยู่ได้","info");	
	}
	if(order_use_coin_type == 3){
		if(order_use_coin > total_price_location_with_charge){
			order_use_coin = total_price_location_with_charge;
		}
		//console.log("total_price_location_with_charge : "+total_price_location_with_charge);
		//console.log("order_use_coin : "+order_use_coin);
		$(".total_order_use_coin_type").text(order_use_coin);
	}
	
	
	updateAmount();
});
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
function numberWithCommas(x) {
	console.log(x);
	x = x.toFixed(2);
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}



// omise
var amount_cal = 0;
$('.omise-checkout-button-2').show();
$('.omise-checkout-button-1').hide();
function updateAmount(){
	var order_use_coin = parseInt($(".total_order_use_coin_type").text());
	amount_cal = total_price_location_with_charge-order_use_coin;
	
	if(total_price_location_with_charge <= 0){
		$(".coin_container").hide();
	}
	if(amount_cal < 0){
		amount_cal = 0;
	}
	$(".total_price_location").text("฿"+numberWithCommas(amount_cal));
	//console.log("amount_cal : "+amount_cal);
	if(amount_cal > 0){
		$('.omise-checkout-button-2').show();
		$('.omise-checkout-button-1').hide();
		var amount = amount_cal+"00";
		OmiseCard.configure('.omise-checkout-button-2', {
		  publicKey:		omise_key,
		  amount:           amount,
		  currency:         'thb',
		  image:            '<?php echo base_url("assets/images/mc.png"); ?>',
		  frameLabel:       'ME MESSAGE Co.,Ltd.',
		  frameDescription: 'บริษัท มีเมสเสจ จำกัด',
		  submitLabel:      'ชำระ',
		  buttonLabel:      'Pay with Omise',
		  location:         'no',
		  billingName:      '',
		  billingAddress:   '',
		  submitFormTarget: '#create_order',
		});
		
		//OmiseCard.attach();
	}else{
		$('.omise-checkout-button-2').hide();
		$('.omise-checkout-button-1').show();
		
	}
}

$(".omise-checkout-button-2").click(function(){
		
		
		var order_place_id_checked = false;			
		$(".order_place_id").each(function(){
			if($(this).prop("checked")){
				order_place_id_checked = true;
			}
		});
		
		if(!order_place_id_checked){
			swal({   
				title: "ไม่พบสถานที่รับหรือจัดส่งสินค้า",     
				type: "warning",   
				showCancelButton: true, 
				cancelButtonText: "ยกเลิก",
				confirmButtonColor: "#DD6B55",   
				confirmButtonText: "เพิ่มที่อยู่จัดส่งสินค้า",   
				closeOnConfirm: true 
			}, function(){  
				window.location = config.base_url+'user/shipping';
			});
			return false;	
		}
		
		var formdata = $('#create_order').serializeArray();
		var dataObj = new Object();
		$(formdata).each(function(i, field){
			dataObj[field.name] = field.value;
		});
	
		var order_buyer_place_is_hidden = $("input[type='radio'][name='order_buyer_place_is_hidden']:checked").val();
		
		if(parseInt(order_buyer_place_is_hidden) == 1){
			var order_name = dataObj['order_name'];	
			var order_tax = dataObj['order_tax'];	
			var order_address = dataObj['order_address'];	
			
			if(!order_name){
				swal("ใบเสร็จรับเงิน","กรุณาระบุชื่อที่ใช้ในการออกใบเสร็จ","info");
				return false;	
			}
			/*if(!order_tax){
				swal("ใบเสร็จรับเงิน","กรุณาระบุเลขประจำตัวผู้เสียภาษี ","info");
				return false;	
			}*/
			if(!order_address){
				swal("ใบเสร็จรับเงิน","กรุณาระบุที่อยู่ที่ใช้ในการออกใบเสร็จรับเงิน","info");
				return false;	
			}
		}
		
		
		var is_read_term = $("#term_condition").prop("checked");
		if(!is_read_term){
			swal("ข้อกำหนดและเงื่อนไข","กรุณาเลือกที่ ฉันได้อ่านและยอมรับข้อกำหนดและเงื่อนไขการใช้งาน","info");
			return false;	
		}
		
		
		
		
		var amount = amount_cal+"00";
		OmiseCard.open({
		  publicKey:		omise_key,
		  amount:           amount,
		  currency:         'thb',
		  image:            '<?php echo base_url("assets/images/mc.png"); ?>',
		  frameLabel:       'ME MESSAGE Co.,Ltd.',
		  frameDescription: 'บริษัท มีเมสเสจ จำกัด',
		  submitLabel:      'ชำระ',
		  buttonLabel:      'Pay with Omise',
		  location:         'no',
		  billingName:      '',
		  billingAddress:   '',
		 // otherPaymentMethods: ["internet_banking", "bill_payment_tesco_lotus", "alipay", "credit_card"],
		  submitFormTarget: '#create_order',
		  onCreateTokenSuccess: (token) => {
    			$('#create_order').submit();
  		  }
		});
		//OmiseCard.attach();
});

$(document).ready(function(){
	//checkPlace();
});
function checkPlace(){
	
	var formdata = $('#create_order').serializeArray();
	var dataObj = new Object();
	$(formdata).each(function(i, field){
		
     	dataObj[field.name] = field.value;
    });
	
	var order_use_coin = parseInt($(".total_order_use_coin_type").text());
	var amount_cal = total_price_location_with_charge-order_use_coin;
	var order_place_id = dataObj['order_place_id'];	
	if(amount_cal > 0){
		checkoutButton = $('.omise-checkout-button-2');
	}else{
		checkoutButton = $('.omise-checkout-button-1');
	}
	
	if(!order_place_id){
		checkoutButton.hide();
		swal({   
			title: "ไม่พบสถานที่รับหรือจัดส่งสินค้า",     
			type: "warning",   
			showCancelButton: true, 
			cancelButtonText: "ยกเลิก",
			confirmButtonColor: "#DD6B55",   
			confirmButtonText: "เพิ่มที่อยู่จัดส่งสินค้า",   
			closeOnConfirm: true 
		}, function(){  
			window.location = config.base_url+'user/shipping';
		});
		//swal("ไม่พบสถานที่จัดส่งสินค้า","บัญชีของท่านยังไม่ได้เพิ่มที่อยู่ในการจัดส่งสินค้า \nกรุณาคลิกที่ 'เพิ่มที่อยู่การจัดส่ง' เพื่อระบุสถานที่จัดส่งสินค้า","info");
		return false;
	}else{
		checkoutButton.show();
	}
}
updateAmount();


</script>
