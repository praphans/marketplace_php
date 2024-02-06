
<?php 
	$this->load->view("templates/header");
	$this->load->library('order/order_libs');
?>

<?php 
foreach($order_discription as $row){
			$order_id 						= $row->order_id;
			$order_shipping_type_id 		= $row->order_shipping_type_id;
			$order_store_shipping_charge 	= $row->order_store_shipping_charge;
			$order_code 					= $row->order_code;
			$coupon_id 						= $row->coupon_id;
			$order_place_id 				= $row->order_place_id;
			$order_buyer_place_is_hidden 	= $row->order_buyer_place_is_hidden;
			$cart_id 						= $row->cart_id;
			$member_id 						= $row->order_member_id;
			$store_id 						= $row->store_id;
			$sender_store_id 				= $row->depositor_store_id;
			$product_id 					= $row->product_id;
			$product_qty 					= $row->product_qty;
			$product_price_discount 		= $row->product_price_discount;
			$product_price_payment 			= $row->product_price_payment;
			$product_price_balance 			= $row->product_price_balance;
			$product_name 					= $row->product_name;
			// $order_name 					= $row->order_name;
			$order_tax 						= $row->order_tax;
			$order_branch 					= $row->order_branch;
			$order_address 					= $row->order_address;
			$order_use_coin_type 			= $row->order_use_coin_type;
			$order_use_coin 				= $row->order_use_coin;
			$order_payment 					= $row->order_payment;
			$order_status 					= $row->order_status;
			$timestamp 						= $row->timestamp;

			$tax_address = "";
												
			$tax_address .= $row->order_name." ";
			$tax_address .= "เลขประจำตัวผู้เสียภาษี ".$row->order_tax." ";
			if(!empty($order_branch)){
				$tax_address .= "รหัสสาขา ".$row->order_branch." ";
			}
			$tax_address .= $row->order_address." ";
			
	
		} 

		$store_result 					= $this->model_order->getStoreByID($store_id);
		$store_name						= $store_result[0]->store_name;

		$store_result 					= $this->model_order->getShipByID($order_shipping_type_id);
		$shipping_type_name				= $store_result[0]->type_name;

		$store_result 					= $this->model_order->getMemberByID($member_id);
		$first_name						= $store_result[0]->first_name;
		$last_name						= $store_result[0]->last_name;
		$member_name					= $first_name." ".$last_name;

		$store_result 					= $this->model_order->getOrderStatusByID($order_status);
		$status_name					= $store_result[0]->status_name;
		
		$thaidate 						= $this->order_libs->getThaiDate($timestamp);

		if($order_status == 1){
			$status_name = '<span class="label label-warning text-center">'.$status_name.'</span>';
		}else if($order_status == 2){
			$status_name = '<span class="label label-info text-center">'.$status_name.'</span>';
		}else if($order_status == 3){
			$status_name = '<span class="label label-success text-center">'.$status_name.'</span>';
		}else{
			$status_name = '<span class="label label-danger text-center">'.$status_name.'</span>';
		}

		if($order_buyer_place_is_hidden == 1){
			$tax_lable = '<span class="badge badge-success text-center text-white">ขอใบเสร็จรับเงิน</span>';
		}else{
			$tax_lable = '<span class="badge badge-warning text-center text-white">ไม่ขอใบเสร็จรับเงิน</span>';
		}

		$btn_view = '<button type="button" onClick="myModalView('.$order_id.');" class="btn btn-info text-light btn-block mdi mdi-eye"> ดูประวัติเปลี่ยนสถานะ</button>';
		
		$place_delivery = "";
		$place = $this->model_order->getPlaceByID($order_place_id);
		if(count($place)){
			$place_delivery .= $place[0]->place_name." ";
			$place_delivery .= " ที่อยู่ : ";
			$place_delivery .= $place[0]->place_address." ";
		
			$place_delivery .= " อ.";
			$place_delivery .= $this->model_order->getAmphurByID($place[0]->place_amphur)." ";
			$place_delivery .= " จ.";
			$place_delivery .= $this->model_order->getProvinceByID($place[0]->place_province)." ";
			$place_delivery .= $place[0]->place_postcode;
			$place_delivery .= " โทรศัพท์ ";
			$place_delivery .= $place[0]->place_mobile;
			$place_lat = $place[0]->place_lat;
			$place_long = $place[0]->place_long;
			
		}
		$member = $this->model_order->getStoreByID($sender_store_id);
		$sender_name = "-";	
		foreach($member as $s){
			$sender_name = $s->store_name;
		}
?>



 <div class="page-wrapper mt-main-wrapper-70">
		<!-- ============================================================== -->
		<!-- Bread crumb and right sidebar toggle -->
		<!-- ============================================================== -->
		<div class="row page-titles">
			<div class="col-md-5 align-self-center">
				<h3 class="text-themecolor">รายละเอียดคำสั่งซื้อ <?php if(isset($status_name)) echo $status_name; ?></h3>
			</div>
			<div class="col-md-7 align-self-center">
				<ol class="breadcrumb">
				<!-- <li class="breadcrumb-item"><a href='<?php echo base_url("order"); ?>'>สินค้า</a></li> -->
				<li class="breadcrumb-item"><a href='<?php echo base_url("order"); ?>'> รายการคำสั่งซื้อ </a></li>
				<li class="breadcrumb-item"> รายละเอียดคำสั่งซื้อ  </li>
				</ol>
			</div>
		</div>

		<div class="container-fluid">
			<!-- ============================================================== -->
			<!-- Start Page Content -->
			<!-- ============================================================== -->
			<!-- Row -->
			<div class="row pl-3 pr-3">
				<div class="col-lg-12 col-xlg-12 col-md-12">
					<div class="card">
						<div class="card-body"> 
							<div class="row">
								<div class="col-lg-12">
									<div class="ribbon-wrapper">
	                                	<h4 class="ribbon ribbon-bookmark ribbon-danger">รายละเอียดคำสั่งซื้อ</h4>
	                                </div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-4 col-lg-3">
									<small class="text-muted p-t-30 db">เลขใบสั่งซื้อ</small>
									<h6 class="pt-1 text-primary font-weight-bold"><?php if(isset($order_code)) echo $order_code; ?></h6>
								</div>
								<div class="col-md-4 col-lg-3">
									<small class="text-muted p-t-30 db">วันที่</small>
									<h6 class="pt-1"><?php if(isset($thaidate)) echo $thaidate; ?></h6> 
								</div>
								<div class="col-md-4 col-lg-3">
									<small class="text-muted p-t-30 db">ผู้ซื้อ</small>
									<h6 class="pt-1"><?php if(isset($first_name)) echo $first_name; ?></h6> 
								</div>
								<div class="col-md-4 col-lg-3">
									<small class="text-muted p-t-30 db">ผู้ขาย</small>
									<h6 class="pt-1"><?php if(isset($store_name)) echo $store_name; ?></h6> 
								</div>
								<div class="col-md-4 col-lg-3">
									<small class="text-muted p-t-30 db">เอเย่นต์</small>
									<h6 class="pt-1"><?php if(isset($sender_name)) echo $sender_name; ?></h6> 
								</div>
								<div class="col-md-4 col-lg-3">
									<small class="text-muted p-t-30 db">วิธีรับสินค้า</small>
									<h6 class="pt-1"><?php if(isset($shipping_type_name)) echo $shipping_type_name; ?></h6> 
								</div>
								<div class="col-md-4 col-lg-3">
									<small class="text-muted p-t-30 db">สถานที่ส่งสินค้า</small>
									<h6 class="pt-1"><?php if(isset($place_delivery)) echo $place_delivery; ?></h6> 
								</div>
								<div class="col-md-4 col-lg-3">
									<small class="text-muted p-t-30 db">การขอใบเสร็จรับเงิน</small>
									<h6 class="pt-1"><?php if(isset($tax_lable)) echo $tax_lable; ?></h6> 
								</div>

								<div class="col-md-12 col-lg-12">
									<small class="text-muted p-t-30 db">ข้อมูลออกใบเสร็จ</small>
									<h6 class="pt-1"><?php if(isset($tax_address)) echo $tax_address; ?></h6> 
								</div>

								<div class="col-md-4 col-lg-2 pt-3">
								</div>
								<div class="col-md-4 col-lg-2 pt-3">
								</div>
								<div class="col-md-4 col-lg-4 pt-3">
									<?php echo $btn_view; ?>
								</div>

							</div>
						</div>
					</div>

					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-lg-12">
									<div class="ribbon-wrapper">
	                                	<h4 class="ribbon ribbon-bookmark ribbon-danger">รายการสินค้า</h4>
	                                </div>
	                                <!-- <h4>สินค้า</h4> -->
		       						<table class="table">
										<thead>
											<tr width="100%">
												<th class="font-weight-bold" width="40%">รายการสินค้า</th>
												<th class="font-weight-bold" width="20%">จำนวน/ชิ้น</th>
												<th class="font-weight-bold" width="20%">ราคา/หน่วย</th>
												<th class="font-weight-bold" width="20%">รวมทั้งสิ้น</th>
											</tr>
										</thead>
										<tbody>
											<?php 
											$net_price = 0;
											foreach($order_discription as $row){

												$pro_name 			= $row->product_name;
												$pro_qty 			= $row->product_qty;
												$pro_price_discount = $row->product_price_discount;
												$pro_price_payment 	= $row->product_price_payment;
												$pro_order_store_shipping_charge 	= $row->order_store_shipping_charge;
												$pro_product_price_balance 	= $row->product_price_balance;
												$pro_order_status 	= $row->order_status;
												$pro_order_use_coin 	= $row->order_use_coin;

												$pro_qty  			= $pro_qty;

												$sum_price			= $pro_price_discount * $pro_qty;
												$total_price		= $sum_price - $pro_price_payment;

												$net_price			+= $total_price;


												$total_price_order = $pro_product_price_balance+$pro_price_payment+$pro_order_store_shipping_charge;
											?>
											<tr>
												<td><?php echo $pro_name; ?></td> <!-- รายการ -->
												<td><?php echo number_format($pro_qty); ?></td> <!-- จำนวน/ชิ้น -->
												
												<td><?php echo number_format($pro_price_discount,2); ?></td><!-- ราคา/หน่วย -->
												<td><?php echo number_format($pro_price_discount * $pro_qty,2); ?></td><!-- รวมทั้งสิ้น -->
											</tr>
											<?php } ?>
										</tbody>
										<tfoot>
								            <tr>
								            	<th></th>
								            	<th></th>
								            	<th></th>
								                <th><B >ค่าจัดส่ง : <?php echo number_format($pro_order_store_shipping_charge,2); ?> บาท</B></th>
								            </tr>
								            <tr>
								            	<th></th>
								            	<th></th>
								            	<th></th>
								                <th><B >ราคาสุทธิ : <?php echo number_format($total_price_order,2); ?> บาท</B>	</th>
								            </tr>
								            <tr>
								            	<th></th>
								            	<th></th>
								            	<th></th>
								                <th><B >ชำระด้วยเหรียญ : <?php echo number_format($pro_order_use_coin,2); ?> บาท</B>	</th>
								            </tr>
								            <tr>
								            	<th></th>
								            	<th></th>
								            	<th></th>
								                <th><B >ชำระแล้ว : <?php echo number_format(($pro_price_payment+$pro_order_store_shipping_charge)-$pro_order_use_coin,2); ?> บาท</B>	</th>
								            </tr>
								            <tr>
								            	<th></th>
								            	<th></th>
								            	<th></th>
								                <th><B >คงเหลือ : <?php echo number_format($pro_product_price_balance,2); ?> บาท</B>	</th>
								            </tr>
								        </tfoot>
									</table>       
								</div>
							</div>
						</div>
					</div>
					
					
                </div>
			
			</div><!-- row -->
		</div><!-- container-fluid -->
		<footer class="footer"> </footer>
	</div><!--สิ้นสุด page-wrapper-->
	<!--เริ่มต้น Footer-->
</div><!-- main-wrapper --> 
  <!--เริ่มต้น Footer-->

<div class="history_container"></div>

<?php $this->load->view("templates/footer"); ?>
<script src="<?php echo base_url("assets/system/plugins/datatables/jquery.dataTables.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/system/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/custom/js/locales/bootstrap-datepicker.th.js"); ?>"></script>
<script src="<?php echo base_url('assets/system/plugins/clockpicker/dist/jquery-clockpicker.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/system/plugins/clockpicker/dist/bootstrap-clockpicker-custom.js'); ?>"></script>

<?php $this->load->assets_by_name('order_admin'); ?>  
