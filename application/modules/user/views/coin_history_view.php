<?php $this->load->view("templates/header"); ?>


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
                                
                            <h3>เหรียญของฉัน</h3>

                            <!-- - - - - - - - - - - - - - Tabs v2 - - - - - - - - - - - - - - - - -->

                            <div class="tabs type_2">
                                <div class="mobile_only_show">
                                    <button class="button_grey_outline btn-block text-left" type="button" data-toggle="collapse" 
                                    data-target="#coin_his_tab" aria-expanded="false" aria-controls="coin_his_tab">
                                            เหรียญของฉัน<span class="caret"></span>
                                    </button>
                                </div>
                                <aside class="col-md-3 col-sm-4 collapse pl-0 pr-0" id="coin_his_tab">
                                    <section class="section_offset">
                                        <ul class="theme_menu tabs_nav clearfix pb-5">
                                            <li><a href="<?php echo base_url("user/coin"); ?>">ประวัติ</a></li>
                                            <li><a href="<?php echo base_url("user/coin_top_up"); ?>">ซื้อเหรียญ</a></li>
                                        </ul>
                                    </section>
                                </aside>
                                <ul class="tabs_nav clearfix mobile_only_hide">

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
                                  <!--   <li class="<?php// echo $coin_his_active; ?>"><a href="<?php //echo base_url("user/coin_use"); ?>">การใช้เหรียญ</a></li> -->
                                    <li class="<?php echo $coin_top_up_active; ?>"><a href="<?php echo base_url("user/coin_top_up"); ?>">ซื้อเหรียญ</a></li>

                                </ul>
                                
                                <div class="tab_containers_wrap">
<!-- <h3 class="text-primary font-weight-bold"> -->
                                    <div id="cion_customer" class="tab_container">
                                        <div class="row">
                                            <div class="col-md-12 pt-10">
                                                <!-- <label class="">จำนวนเหรียญที่คุณมี </label> -->
                                                <span>จำนวนเหรียญที่คุณมี &nbsp&nbsp<strong class="text-primary font-icon"><?php echo number_format($this->membermanager->coin()); ?></strong> &nbsp&nbspเหรียญ</span>
                                                <!-- <label class=""> เหรียญ</label> -->
                                            </div>
                                            
                                        </div>
                                        

                                        <div class="row pt-10">
                                            
                                            <div class="col-md-12 pb-xs-20">
                                                <p class=" pt-10">รายการเคลื่อนไหวทางบัญชี</p>
                                                <div class="table_wrap">
                                                    <table class="table_type_1 shopping_cart_table">
                                                        <thead>
                                                            <tr>
                                                                <th width="20%" class="text-center">วันที่ เวลา</th>
                                                                <th width="60%" class="text-center">รายการ</th>
                                                                <th width="20%" class="text-center">จำนวนเหรียญ</th>
                                                            </tr>

                                                        </thead>

                                                        <tbody>
                                                        	<?php
															foreach($coins as $row){
																
                                                                $timestamp = $row->timestamp;
                                                                $code = $row->code;
                                                                $coin = $row->coin;
                                                                $main = $row->main;

                                                                if($main  == 'buy'){
                                                                    $order_coin = "<span class='text-primary'>+".number_format($coin,0)."</span>";
                                                                }else{
                                                                    $order_coin = "<span class='text-danger'>-".number_format($coin,0)."</span>";
                                                                }
                                                                
															?>
                                                            <tr>
                                                                <td data-title="วันที่ เวลา">
                                                                    <?php echo $this->utils->getThaiDate($timestamp); ?>
                                                                </td>
                                                                <td class="text-center" data-title="รายการ">
                                                                    <?php echo $code; ?>
                                                                </td>
                                                                <td class="total text-center" data-title="เติมเงิน">
                                                                    <?php echo $order_coin; ?>
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
                   <!--  <footer class="bottom_box on_the_sides">

                        <div class="left_side">

                        </div>

                        <div class="right_side">

                            <?php //echo $pagination; ?>

                        </div>

                    </footer> -->
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