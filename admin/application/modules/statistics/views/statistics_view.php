<?php $this->load->view("templates/header"); ?>

	<?php
		foreach($store_count_result as $rows){
			$store_count = $rows->store_count;
		}
		foreach($product_count_result as $rowp){
			$product_count = $rowp->product_count;
		} 
		foreach($order_count_result as $rowo){
			$order_count = $rowo->order_count;
		} 
		foreach($member_count_result as $rowm){
			$member_count = $rowm->member_count;
		}  

		foreach($order_status_result_1 as $rows1){
			$order_status_1 = $rows1->order_status_1;
		}
		foreach($order_status_result_2 as $rows2){
			$order_status_2 = $rows2->order_status_2;
		}
		foreach($order_status_result_3 as $rows3){
			$order_status_3 = $rows3->order_status_3;
		}
		foreach($order_status_result_4 as $rows4){
			$order_status_4 = $rows4->order_status_4;
		}

        foreach($store_year_result_1 as $row1){
            $st_year_1 = $row1->store_year;
        }
        foreach($store_year_result_2 as $row2){
            $st_year_2 = $row2->store_year;
        }
        foreach($store_year_result_3 as $row3){
            $st_year_3 = $row3->store_year;
        }
        foreach($store_year_result_4 as $row4){
            $st_year_4 = $row4->store_year;
        }
        foreach($store_year_result_5 as $row5){
            $st_year_5 = $row5->store_year;
        }
        foreach($store_year_result_6 as $row6){
            $st_year_6 = $row6->store_year;
        }
        foreach($store_year_result_7 as $row7){
            $st_year_7 = $row7->store_year;
        }

        foreach($member_year_result_1 as $row1){
            $mb_year_1 = $row1->member_year;
        }
        foreach($member_year_result_2 as $row2){
            $mb_year_2 = $row2->member_year;
        }
        foreach($member_year_result_3 as $row3){
            $mb_year_3 = $row3->member_year;
        }
        foreach($member_year_result_4 as $row4){
            $mb_year_4 = $row4->member_year;
        }
        foreach($member_year_result_5 as $row5){
            $mb_year_5 = $row5->member_year;
        }
        foreach($member_year_result_6 as $row6){
            $mb_year_6 = $row6->member_year;
        }
        foreach($member_year_result_7 as $row7){
            $mb_year_7 = $row7->member_year;
        }

        foreach($review_store_result as $rows){
            $review_cont_store = $rows->review_cont_store;
        }
        foreach($review_ship_result as $rows){
            $review_cont_ship = $rows->review_cont_ship;
        }
        foreach($review_product_result as $rows){
            $review_cont_product = $rows->review_cont_product;
        }
        



	?>  
 

<div class="page-wrapper mt-main-wrapper-70">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
	<div class="row page-titles">
		<div class="col-md-5 align-self-center">
			<h3 class="text-themecolor">ผลรวมสถิติ </h3>
		</div>
		<div class="col-md-7 align-self-center">
			<ol class="breadcrumb">
			<li class="breadcrumb-item"> ผลรวมสถิติ  </li>
			</ol>
           <!--  <?php// echo "ปี1 ||".$st_year_1."<br>" ; ?>
            <?php //echo "ปี2 || ".$st_year_2."<br>" ; ?>
            <?php //echo "ปี3 || ".$st_year_3."<br>" ; ?>
            <?php //echo "ปี4 || ".$st_year_4."<br>" ; ?>
            <?php// echo "ปี5 || ".$st_year_5."<br>" ; ?>
            <?php// echo "ปี6 ||".$st_year_6."<br>" ; ?>
            <?php// echo "ปี7 ||".$st_year_7."<br><br>" ; ?>

            <?php //echo "ปี1 ||".$mb_year_1."<br>" ; ?>
            <?php //echo "ปี2 || ".$mb_year_2."<br>" ; ?>
            <?php //echo "ปี3 || ".$mb_year_3."<br>" ; ?>
            <?php// echo "ปี4 || ".$mb_year_4."<br>" ; ?>
            <?php //echo "ปี5 || ".$mb_year_5."<br>" ; ?>
            <?php //echo "ปี6 ||".$mb_year_6."<br>" ; ?>
            <?php //echo "ปี7 ||".$mb_year_7."<br>" ; ?> -->
		</div>
	</div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <!-- Column -->
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <!-- Row -->
                        <a href="<?php echo base_url("store/firstStore");?>">
                            <div class="row">
                                <div class="col-8">
                                	<h2><?php if(isset($store_count)) echo $store_count; ?>
                                	 	<!-- <i class="ti-angle-down font-14 text-danger"></i> -->
                                	</h2>
                                    <h6>ร้านค้าทั้งหมด</h6></div>
                                <div class="col-4 align-self-center text-right  p-l-0">
                                    <div id="sparklinedash3"></div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <!-- Row -->
                        <a href="<?php echo base_url("product");?>">
                            <div class="row">
                                <div class="col-8">
                                	<h2 class=""><?php if(isset($product_count)) echo $product_count; ?>
                                		<!-- <i class="ti-angle-up font-14 text-success"></i> -->
                                	</h2>
                                    <h6>รายการสินค้าทั้งหมด</h6></div>
                                <div class="col-4 align-self-center text-right p-l-0">
                                    <div id="sparklinedash"></div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <!-- Row -->
                        <a href="<?php echo base_url("order");?>">
                            <div class="row">
                                <div class="col-8">
                                	<h2><?php if(isset($order_count)) echo $order_count; ?>
                                		<!-- <i class="ti-angle-up font-14 text-success"></i> -->
                                	</h2>
                                    <h6>ใบสั่งซื้อทั้งหมด</h6></div>
                                <div class="col-4 align-self-center text-right p-l-0">
                                    <div id="sparklinedash2"></div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <!-- Row -->
                        <a href="<?php echo base_url("member/memberList");?>">
                            <div class="row">
                                <div class="col-8">
                                	<h2><?php if(isset($member_count)) echo $member_count; ?>
                                		<!-- <i class="ti-angle-down font-14 text-danger"></i> -->
                                	</h2>
                                    <h6>สมาชิกทั้งหมด</h6></div>
                                <div class="col-4 align-self-center text-right p-l-0">
                                    <div id="sparklinedash4"></div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Row -->
        <div class="row">
            <div class="col-lg-8 col-md-7">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-wrap">
                            <div>
                                <h4 class="card-title">การลงทะเบียน</h4>
                                <!-- <h6 class="card-subtitle">การลงทะเบียนร้านค้า และสมาชิก</h6> -->
                            </div>
                            <div class="ml-auto">
                                <ul class="list-inline">
                                    <li>
                                        <h6 class="text-muted text-success"><i class="fa fa-circle font-10 m-r-10 "></i>สมาชิก</h6> 
                                    </li>
                                    <li>
                                        <h6 class="text-muted text-secondary"><i class="fa fa-circle font-10 m-r-10"></i>ร้านค้า</h6> 
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div id="morris-area-chart2" style="height: 405px;"></div>

                    </div>
                </div>

                <div class="card card-default">
                    <div class="card-header">
                        <div class="card-actions">
                            <a class="" data-action="collapse"><i class="ti-minus"></i></a>
                            <a class="btn-minimize" data-action="expand"><i class="mdi mdi-arrow-expand"></i></a>
                            <a class="btn-close" data-action="close"><i class="ti-close"></i></a>
                        </div>
                        <h4 class="card-title m-b-0">ร้านค้ายอดนิยม</h4>
                    </div>
                    <div class="card-body collapse show">
                        <div class="table-responsive pr-3 pl-3">
                            <div id="myTable_wrapper" class="dataTables_wrapper no-footer">
                                <table id="str_datatable" class="table w-100 nowrap">
                                    <thead>
                                        <tr>
                                            <th class="font-weight-bold">ร้านค้า</th>
                                            <th class="font-weight-bold">รูปภาพ</th>
                                            <th class="font-weight-bold">เจ้าของร้าน</th>
                                            <th class="font-weight-bold">เบอร์โทร</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!--โหลดข้อมูล-->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-default">
                    <div class="card-header">
                        <div class="card-actions">
                            <a class="" data-action="collapse"><i class="ti-minus"></i></a>
                            <a class="btn-minimize" data-action="expand"><i class="mdi mdi-arrow-expand"></i></a>
                            <a class="btn-close" data-action="close"><i class="ti-close"></i></a>
                        </div>
                        <h4 class="card-title m-b-0">สินค้าขายดี</h4>
                    </div>
                    <div class="card-body collapse show">
                        <div class="table-responsive pr-3 pl-3">
                            <div id="myTable_wrapper" class="dataTables_wrapper no-footer">
                                <table id="stat_sale_datatable" class="table w-100 nowrap">
                                    <thead>
                                        <tr>
                                            <th class="font-weight-bold">สินค้า</th>
                                            <th class="font-weight-bold">รูปภาพ</th>
                                            <th class="font-weight-bold">จำนวน</th>
                                            <th class="font-weight-bold">ราคา</th>
                                            <th class="font-weight-bold">วันที่</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!--โหลดข้อมูล-->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-5">
                <!-- Column -->
                <div class="card card-default">
                    <div class="card-header">
                        <div class="card-actions">
                            <a class="" data-action="collapse"><i class="ti-minus"></i></a>
                            <a class="btn-minimize" data-action="expand"><i class="mdi mdi-arrow-expand"></i></a>
                            <a class="btn-close" data-action="close"><i class="ti-close"></i></a>
                        </div>
                        <h4 class="card-title m-b-0">สถานะใบสั่งซื้อ</h4>
                    </div>
                    <div class="card-body collapse show">
                    <div id="morris-donut-chart" class="ecomm-donute" style="height: 317px;"></div>
		                <ul class="list-inline m-t-20 text-center">
		                    <li >
		                        <h6 class="text-muted"><i class="fa fa-circle text-info"></i> กำลังดำเนินการ</h6>
		                        <h4 class="m-b-0"><?php if(isset($order_status_1)) echo $order_status_1; ?></h4>
		                    </li>
		                    <li>
		                        <h6 class="text-muted"><i class="fa fa-circle text-danger"></i> ชำระเงินแล้ว</h6>
		                        <h4 class="m-b-0"><?php if(isset($order_status_2)) echo $order_status_2; ?></h4>
		                    </li>
		                    <!--<li>
		                        <h6 class="text-muted"> <i class="fa fa-circle text-success"></i> ได้รับของแล้ว</h6>
		                        <h4 class="m-b-0"><?php if(isset($order_status_3)) echo $order_status_3; ?></h4>
		                    </li>-->
		                </ul>
                    </div>
                </div>

                <div class="card card-default">
                    <div class="card-header">
                        <div class="card-actions">
                            <a class="" data-action="collapse"><i class="ti-minus"></i></a>
                            <a class="btn-minimize" data-action="expand"><i class="mdi mdi-arrow-expand"></i></a>
                            <a class="btn-close" data-action="close"><i class="ti-close"></i></a>
                        </div>
                        <h4 class="card-title m-b-0">รีวิว</h4>
                    </div>
                    <div class="card-body collapse show">
                    <div id="morris-donut-chart-review" class="ecomm-donute" style="height: 317px;"></div>
                        <ul class="list-inline m-t-20 text-center">
                            <li >
                                <h6 class="text-muted"><i class="fa fa-circle text-info"></i> รีวิวร้านค้า</h6>
                                <h4 class="m-b-0"><?php if(isset($review_cont_store)) echo $review_cont_store; ?></h4>
                            </li>
                            <li>
                                <h6 class="text-muted"><i class="fa fa-circle text-danger"></i> รีวิวผู้ส่ง</h6>
                                <h4 class="m-b-0"><?php if(isset($review_cont_ship)) echo $review_cont_ship; ?></h4>
                            </li>
                            <li>
                                <h6 class="text-muted"> <i class="fa fa-circle text-success"></i> รีวิวสินค้า</h6>
                                <h4 class="m-b-0"><?php if(isset($review_cont_product)) echo $review_cont_product; ?></h4>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>


        </div>
        
    </div>

   <footer class="footer"> </footer>

</div>




<?php $this->load->view("templates/footer"); ?>
<script src="<?php echo base_url("assets/system/plugins/datatables/jquery.dataTables.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/system/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/custom/js/locales/bootstrap-datepicker.th.js"); ?>"></script>
<script src="<?php echo base_url('assets/system/plugins/clockpicker/dist/jquery-clockpicker.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/system/plugins/clockpicker/dist/bootstrap-clockpicker-custom.js'); ?>"></script>


<?php $this->load->assets_by_name('statistics'); ?>   
<script >
function MorrisChart(){
    var year1 = "<?php echo $year1 ?>";
    var year2 = "<?php echo $year2 ?>";
    var year3 = "<?php echo $year3 ?>";
    var year4 = "<?php echo $year4 ?>";
    var year5 = "<?php echo $year5 ?>";
    var year6 = "<?php echo $year6 ?>";
    var year7 = "<?php echo $year7 ?>";

    var st_year_1 = "<?php echo $st_year_1 ?>";
    var st_year_2 = "<?php echo $st_year_2 ?>";
    var st_year_3 = "<?php echo $st_year_3 ?>";
    var st_year_4 = "<?php echo $st_year_4 ?>";
    var st_year_5 = "<?php echo $st_year_5 ?>";
    var st_year_6 = "<?php echo $st_year_6 ?>";
    var st_year_7 = "<?php echo $st_year_7 ?>";

    var mb_year_1 = "<?php echo $mb_year_1 ?>";
    var mb_year_2 = "<?php echo $mb_year_2 ?>";
    var mb_year_3 = "<?php echo $mb_year_3 ?>";
    var mb_year_4 = "<?php echo $mb_year_4 ?>";
    var mb_year_5 = "<?php echo $mb_year_5 ?>";
    var mb_year_6 = "<?php echo $mb_year_6 ?>";
    var mb_year_7 = "<?php echo $mb_year_7 ?>";

    "use strict";
    Morris.Area({
        element: 'morris-area-chart2',
        data: [{
            period: year7,
            store: st_year_7,
            member: mb_year_7,
            
        }, {
            period: year6,
            store: st_year_6,
            member: mb_year_6,
            
        }, {
            period: year5,
            store: st_year_5,
            member: mb_year_5,
            
        }, {
            period: year4,
            store: st_year_4,
            member: mb_year_4,
            
        }, {
            period: year3,
            store: st_year_3,
            member: mb_year_3,
            
        }, {
            period: year2,
            store: st_year_2,
            member: mb_year_2,
            
        },
         {
            period: year1,
            store: st_year_1,
            member: mb_year_1,
           
        }],
        xkey: 'period',
        ykeys: ['store', 'member'],
        labels: ['ร้านค้า', 'สมาชิก'],
        pointSize: 0,
        fillOpacity: 0.4,
        pointStrokeColors:['#b4becb', '#01c0c8'],
        behaveLikeLine: true,
        gridLineColor: '#e0e0e0',
        lineWidth: 0,
        smooth: true,
        hideHover: 'auto',
        lineColors: ['#b4becb', '#01c0c8'],
        resize: true
        
    });
}

function MorrisStatistics(){
    var order_status_1 = parseInt("<?php if(isset($order_status_1)) echo $order_status_1; ?>");
    var order_status_2 = parseInt("<?php if(isset($order_status_2)) echo $order_status_2; ?>");
    var order_status_3 = parseInt("<?php if(isset($order_status_3)) echo $order_status_3; ?>");

    Morris.Donut({
        element: 'morris-donut-chart',
        data: [/*{
             label: "ได้รับของแล้ว",
            value: order_status_3,

        }, */{
            label: "กำลังดำเนินการ",
            value: order_status_1,
        }, {
            label: "ชำระเงินแล้ว",
            value: order_status_2,
        }],
        resize: true,
        // colors:['#26c6da', '#1976d2', '#ef5350']
        colors:['#1976d2', '#ef5350']
    });
}

var sparklineLogin = function() { 

   $('#sparklinedash').sparkline([ 0, 5, 6, 10, 9, 12, 4, 9], {
        type: 'bar',
        height: '50',
        barWidth: '2',
        resize: true,
        barSpacing: '5',
        barColor: '#26c6da'
    });
     $('#sparklinedash2').sparkline([ 0, 5, 6, 10, 9, 12, 4, 9], {
        type: 'bar',
        height: '50',
        barWidth: '2',
        resize: true,
        barSpacing: '5',
        barColor: '#7460ee'
    });
      $('#sparklinedash3').sparkline([ 0, 5, 6, 10, 9, 12, 4, 9], {
        type: 'bar',
        height: '50',
        barWidth: '2',
        resize: true,
        barSpacing: '5',
        barColor: '#03a9f3'
    });
       $('#sparklinedash4').sparkline([ 0, 5, 6, 10, 9, 12, 4, 9], {
        type: 'bar',
        height: '50',
        barWidth: '2',
        resize: true,
        barSpacing: '5',
        barColor: '#f62d51'
    });
   
}
     var sparkResize;

        $(window).resize(function(e) {
        clearTimeout(sparkResize);
            sparkResize = setTimeout(sparklineLogin, 500);
        });
        sparklineLogin();

function MorrisReview(){
    var review_cont_store = parseInt("<?php if(isset($review_cont_store)) echo $review_cont_store; ?>");
    var review_cont_ship = parseInt("<?php if(isset($review_cont_ship)) echo $review_cont_ship; ?>");
    var review_cont_product = parseInt("<?php if(isset($review_cont_product)) echo $review_cont_product; ?>");

    Morris.Donut({
        element: 'morris-donut-chart-review',
        data: [{
             label: "รีวิวสินค้า",
             value: review_cont_product,

        }, {
            
            label: "รีวิวร้านค้า",
            value: review_cont_store,  

        }, {
            
            label: "รีวิวผู้ส่ง",
            value: review_cont_ship,
            
        }],
        resize: true,
        colors:['#26c6da', '#1976d2', '#ef5350']
    });
}

MorrisStatistics();
sparklineLogin();
MorrisChart();
MorrisReview();

</script>

