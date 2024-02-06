<?php $this->load->view("templates/header"); ?>
<style type="text/css">
    .tab_container{
        position: relative !important;
    }
</style>

<div class="secondary_page_wrapper">

    <div class="container">

        <!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

        <ul class="breadcrumbs">

            <li><a href="<?php echo base_url(); ?>" class="notcursor">หน้าหลัก</a></li>
            <li><a href="<?php echo base_url("user"); ?>" class="notcursor">บัญชีผู้ซื้อ</a></li>
            <li>เหรียญของฉัน</li>

        </ul>

        <!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->

        <div class="row">

            <aside class="col-md-3 col-sm-4">

                <!-- - - - - - - - - - - - - - Information - - - - - - - - - - - - - - - - -->

                <?php $this->load->view("user/templates/left_tab"); ?>

                <!-- - - - - - - - - - - - - - End of information - - - - - - - - - - - - - - - - -->

            </aside><!--/ [col]-->

            <main class="col-md-9 col-sm-8 padding-l-0">

                <div class="section_offset">

                    <div class="row">

                        <section class="col-sm-12">
                                
                            <h3>การใช้เหรียญ</h3>

                            <!-- - - - - - - - - - - - - - Tabs v2 - - - - - - - - - - - - - - - - -->

                            <div class="tabs type_2">

                                <ul class="tabs_nav clearfix">

                                    <?php
									$coin_active = "";
									$coin_top_up_active = "";
                                    $coin_his_active = "";
									if($this->router->fetch_method() == "coin"){
                                        $coin_active = "active";
                                    }else if($this->router->fetch_method() == "coin_use"){
                                        $coin_his_active = "active";
                                    }else{
                                        $coin_top_up_active = "active";
                                    }
									?>
                                    <li class="<?php echo $coin_active; ?>"><a href="<?php echo base_url("user/coin"); ?>">ประวัติ</a></li>
                                  <!--   <li class="<?php// echo $coin_his_active; ?>"><a href="<?php// echo base_url("user/coin_use"); ?>">การใช้เหรียญ</a></li> -->
                                    <li class="<?php echo $coin_top_up_active; ?>"><a href="<?php echo base_url("user/coin_top_up"); ?>">ซื้อเหรียญ</a></li>

                                </ul>
                                
                                <div class="tab_containers_wrap">

                                    <div id="cion_customer" class="tab_container">


                                        <div class="row pt-10">
                                            
                                            <div class="col-md-12 pb-xs-20">
                                                <div class="table_wrap">
                                                    <table class="table_type_1 shopping_cart_table">
                                                        <thead>
                                                            <tr>
                                                                <th width="20%" class="text-center">วันที่ เวลา</th>
                                                                <th width="60%" class="text-center">รายการ</th>
                                                                <th width="20%" class="text-center">ใช้เหรียญ</th>
                                                            </tr>

                                                        </thead>

                                                        <tbody>
                                                        	<?php
															foreach($coins as $row){
																$order_code = $row->order_code;
																$order_use_coin = $row->order_use_coin;
																$timestamp = $row->timestamp;
															?>
                                                            <tr>
                                                                <td data-title="วันที่ เวลา">
                                                                    <?php echo $this->utils->getThaiDate($timestamp); ?>
                                                                </td>
                                                                <td class="text-center" data-title="รายการ">
                                                                    <?php echo $order_code; ?>
                                                                </td>
                                                                <td class="total text-center" data-title="เติมเงิน">
                                                                    <?php echo number_format($order_use_coin,0); ?>
                                                                </td>
                                                            </tr>
                                                            <?php } ?>
                                                            
                                                        </tbody>
                                                    </table>
                                                </div><!--/ .table_wrap -->
                                            </div>
                                        </div>
                                    </div>


                                    



                                </div><!--/ .tab_containers_wrap -->

                            </div><!--/ .tabs-->
                            
                            <!-- - - - - - - - - - - - - - End of tabs v2 - - - - - - - - - - - - - - - - -->

                        </section><!--/ [col]-->
                    </div><!--/ .row -->
                    <footer class="bottom_box on_the_sides">

                        <div class="left_side">

                        </div>

                        <div class="right_side">

                            <?php echo $pagination; ?>

                        </div>

                    </footer>
                </div><!--/ .section_offset -->
                
            </main><!--/ [col]-->

        </div><!--/ .row-->

    </div><!--/ .container-->

</div><!--/ .page_wrapper-->
            
            
<?php $this->load->view("templates/footer"); ?>
<?php $this->load->assets_by_name("User"); ?>
<?php $this->load->assets_by_name('Left_tab'); ?>
<script src="<?php echo base_url("assets/js/bootstrap-datepicker.min.js"); ?>" type="text/javascript"></script>
<script src="<?php echo base_url("assets/js/locales/bootstrap-datepicker.th.js"); ?>"></script>
<script>
var status_id = "<?php if(isset($status_id) && !empty($status_id))echo $status_id; ?>";
var start_date = "<?php if(isset($start_date) && !empty($start_date))echo $start_date; ?>";
var end_date = "<?php if(isset($end_date) && !empty($end_date))echo $end_date; ?>";
$(function() {
		  
	if(status_id){
		$("#status_id").val(status_id);
	}
	if(start_date != "" && end_date != ""){
		$("#end_date, #start_date").datepicker({format: 'yyyy-m-d',
			language:"th-th",
			todayHighlight:true,
			ignoreReadonly: true
		});
	}else{
		$("#end_date, #start_date").datepicker({format: 'yyyy-m-d',
				language:"th-th",
				todayHighlight:true,
				ignoreReadonly: true
		}).datepicker("setDate", new Date());
	}

});
</script>