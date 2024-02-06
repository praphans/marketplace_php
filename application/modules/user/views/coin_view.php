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
                                    data-target="#coin_tab" aria-expanded="false" aria-controls="coin_tab">
                                            เหรียญของฉัน<span class="caret"></span>
                                    </button>
                                </div>
                                <aside class="col-md-3 col-sm-4 collapse pl-0 pr-0" id="coin_tab">
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
                                    <li class="<?php echo $coin_top_up_active; ?>"><a href="<?php echo base_url("user/coin_top_up"); ?>">ซื้อเหรียญ</a></li>

                                </ul>
                                
                                <form action="<?php echo base_url("user/topup"); ?>" method="post" id="form_coin">
                                    <div class="tab_containers_wrap">
                                        <div id="cion_buy" class="tab_container" style="position: relative !important;">
                                            <div class="row pt-10">
                                                <div class="col-md-5 ">
                                                    <div class="row">
                                                        <div class="col-md-12 pb-3">
                                                            <label class="">กรุณาระบุเหรียญที่ต้องการซื้อ : </label>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <input type="number" min="20" onkeypress='return isNumberKey(event)' class="form-control" name="coin_top_up" id="coin_top_up" required onchange="updateAmount()" value="100">
                                                                    <span class="input-group-addon">
                                                                        เหรียญ
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-2 text-center pt-md-35">
                                                    <a class="icon-exchange font-icon"></a>
                                                </div>
                                                <div class="col-md-5 ">
                                                    <div class="row">
                                                        <div class="col-md-12 pb-3">
                                                            <label class="">จำนวนเงินที่ต้องชำระ : </label>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                	<input type="hidden" name="money_top_up" id="money_top_up" />
                                                                    <input type="text" class="form-control" name="money_top_up_view" id="money_top_up_view" disabled>
                                                                    <span class="input-group-addon">
                                                                        บาท
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 ">
                                                    <p>มูลค่าเหรียญนะปัจจุบัน 1 เหรียญเท่ากับ <?php echo $this->load->get_var('coin_value'); ?> บาท</p>
                                                </div>
                                            </div>
                                            <div class="row pt-20">
                                                <div class="col-md-4">
                                                </div>
                                                <div class="col-md-4">
                                                    <button type="button" class="w-100 button_blue middle_btn icon-money omise-checkout-button-2"> ชำระเงินซื้อเหรียญ</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                

                            </div><!--/ .tabs-->
                            
                            <!-- - - - - - - - - - - - - - End of tabs v2 - - - - - - - - - - - - - - - - -->

                        </section><!--/ [col]-->
                    </div><!--/ .row -->
                    <footer class="bottom_box on_the_sides">

                        <div class="left_side">

                        </div>

                        <div class="right_side">

                            

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
<script type="text/javascript" src="https://cdn.omise.co/omise.js"></script>
<script>
var coin_value = "<?php if($this->load->get_var('coin_value') != NULL) echo $this->load->get_var('coin_value'); ?>";
function updateAmount(){
	var coin_top_up = parseInt($("#coin_top_up").val());
	if(coin_top_up < 20){
		coin_top_up = 20;
		$("#coin_top_up").val(coin_top_up);
		
		swal({title:"เติมเงิน",html:true,text:"จำนวนเนินที่เติมต้องมากกว่า 20 บาท",type:"info"});
		return false;	
	}
	coin_top_up = coin_top_up*coin_value;
	$("#money_top_up_view").val(numberWithCommas(coin_top_up));
	coin_top_up = coin_top_up+"00";
	$("#money_top_up").val(coin_top_up);
	OmiseCard.configureButton('.omise-checkout-button-2', {
	  publicKey:		'pkey_test_5f77edc0mdv5ycqkx9b',
	  amount:           coin_top_up,
	  currency:         'thb',
	  image:            '<?php echo base_url("assets/images/mc.png"); ?>',
	  frameLabel:       'ME MESSAGE Co.,Ltd.',
	  frameDescription: 'บริษัท มีเมสเสจ จำกัด',
	  submitLabel:      'เติมเงิน',
	  buttonLabel:      'Pay with Omise',
	  location:         'no',
	  billingName:      '',
	  billingAddress:   '',
	  submitFormTarget: '#form_coin',
	});
	/*OmiseCard.open({
	  frameLabel: 'Esimo',
	  frameDescription: 'Invoice #3847',
	  amount: 100000,
	  onCreateTokenSuccess: (token) => {
		 
		
	  },
	  onFormClosed: () => {
		
	  },
	})*/
	
	//OmiseCard.configureButton('.omise-checkout-button-2');
	OmiseCard.attach();
}
updateAmount();

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
function numberWithCommas(x) {
	//console.log(x);
	x = x.toFixed(2);
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
</script>
