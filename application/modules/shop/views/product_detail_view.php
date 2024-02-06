


<?php

 foreach($product as $row){
    $product_id = $row->product_id;
    $store_id = $row->store_id;
    $product_name = $row->product_name;
    $product_brand = $row->product_brand;
    $product_version = $row->product_version;
    $product_rating = $row->product_rating;
	$product_code = $row->product_code;
	$product_review = $row->product_review;
    $product_category = $row->product_category;
    $product_subcategory = $row->product_subcategory;
    $product_description = $row->product_description;
    $product_price = $row->product_price;
    $product_price_discount = $row->product_price_discount;
    $product_recommend = $row->product_recommend;
    $product_show = $row->product_show;
	$product_qty = $row->product_qty;
    $product_type = $row->product_type;
    $product_mode = $row->product_mode;
    $product_status = $row->product_status;
    $timestamp = $row->timestamp;
    
	$product_type_name = "";
	$product_type_list = $this->model_productmanager->getProductTypeByID($product_type);
	if(count($product_type_list))$product_type_name = $product_type_list[0]->type_name;
	
    $product_name_url = $this->utils->urlClean($product_name);
    
    $number_relate = $this->model_productmanager->getNumberRelate($product_id);
    $images = $this->model_productmanager->getProductImageList($product_id);
    $default_image = (count($images))?$images[0]->image_url:$this->productmanager->default_image();
    
    $store_url = "";
	$store_shipping = "";
    $mystore = $this->model_shop->getShopByStoreID($store_id);
    if(count($mystore)){
		$store_url = $mystore[0]->store_url;
		$store_shipping = $mystore[0]->store_shipping;
	}
    
	$service_delivery = strrpos($store_shipping,'3');
	
    $product_category_name = "";
    $product_category_result = $this->model_shop->getCategoryProductByID($product_category);
    if(count($product_category_result))$product_category_name = $product_category_result[0]->category_name;
    
    $product_category_name = $this->utils->urlClean($product_category_name);
	
	
	$payment_setting = $this->model_setting->getGatewayTypeByID($product_id);
	$option1 = 0;
	$option2 = 0;
	$gateway_type_id = 0;
	foreach($payment_setting as $setting){
		$gateway_type_id = $setting->gateway_type_id;
		$option1 = $setting->option1;
		$option2 = $setting->option2;
	}
	
	
							
	
 }
 
 $reviews  = $this->model_review->getReviewByProductID($product_id);
 
$promo = $this->utils->promotion_in_time($product_id);
if($promo->promo_price > 0)$product_price_discount = $promo->promo_price;



$store_place = $this->model_shop->getPlaceById($store_id,1);
$agent_place = $this->model_shop->getPlaceById($store_id,2);
$service_place = $this->model_shop->getPlaceById($store_id,3);

$number_of_place = count($store_place)+count($agent_place)+count($service_place);
		
		
$prodcut_url = base_url($store_url."/products/".$product_category_name.'/'.$product_id."/".$product_name_url);

?>

<!doctype html>
<style type="text/css">
	.topbar > li:not(:last-child)::after{
		content:"" !important;
	}
	@media only screen and (max-width: 600px) {
		.mc-icon-size{
			width: 57px !important;
		}
		.hide-ko-img{
			display: none;
		}
		.ft-icon{
			font-size: 8px;
			color: #4b9cd3;
		}
		.mc-ml{
			margin-left: 20px;
		}
		.cart-position{
			position: absolute;
			top: 6px;
		}
		.color-user{
			color: #49c4fa !important;
		}
		.pd-sch{
			padding-left: 50px !important;
		}
		.pd-account{
			padding-left: 4px;
		}
		.pd-caet{
			padding-right: 30px !important;
		}
		.pr-pl-0{
			padding-left: 0px !important;
			padding-right: 0px !important;
		}
		.font-icon{
			font-size: 20px;
		}

		#navbar {
		  overflow: hidden;
		  background-color: #fff;
		  z-index: 999;
		}

		.sticky {
		  position: fixed;
		  top: 0;
  		  width: 100%;
		}
		.position_berger{
			position : absolute;
			left: 50px;
			top: -43px;
			
		}

		.icon-thailand{
			width: 25px;
		}
		.drawer-menu-item-userbar-non{
			padding-top: 5px !important;
		}
		.logo-home{
			font-size: 20px;
		}

    }

    /*overflow*/
	#menuwrapper {
	  position: relative;
	}
	#menuwrapper ul {
	  /*width:260px;*/
	  height:400px;
	  overflow-x: hidden !important;
	  overflow-y: auto;
	}
	#menuwrapper ::-webkit-scrollbar {
	    width: 0;
	}
	#menuwrapper ul, 
	#menuwrapper ul li{
	    margin:0;
	    padding:0;
	    list-style:none;
	}
	#menuwrapper ul li{
		position: static !important;
	  	background: #fff ;
	    border-bottom: solid 1px #eaeaea;
	    border-left: solid 1px #eaeaea;
	    border-right: solid 1px #eaeaea;
	    width:250px;
		cursor:pointer;
		color: #000 !important;
	}
	#menuwrapper a:hover, 
	#menuwrapper > li a.current, 
	#menuwrapper li:hover > a {
		background-color:#ee4d2d;
	    color: #fff !important;
	    position:relative;
	}
	/*#menuwrapper ul li:hover,
	#menuwrapper ul li.iehover{
	    background-color:#4ac4fa;
	    color: #fff !important;
	    position:relative;
	}*/
	#menuwrapper ul li a{
		min-width: 100%;
	    padding:10px 15px;
	    display:inline-block;
	    text-decoration:none;
	}
	#menuwrapper ul li ul{
	    position:absolute;
	    display:none;
	}
	#menuwrapper ul li:hover ul,
	#menuwrapper ul li.iehover ul{
	    left:150px;
	    top:0px;
	    display:block;
	}
	#menuwrapper a:hover,
	#menuwrapper a.iehover{
	    color: #fff !important;
	}
	
	.has_tello{
	    position: relative;
		float : right;
	}

	/* We style the color of level 2 links */
	ul.overflow{
	  height: 400px;
	  overflow-y: scroll;
	  overflow-x: hidden;
	  white-space: nowrap;
	}

    



</style>


<html lang="en">
	<head>
		<!-- Basic page needs
		============================================ -->
		<title><?=$title;?></title>
		<meta charset="utf-8">
		<meta name="author" content="">
		<meta name="description" content="">
		<meta name="keywords" content="">

		<!-- Mobile specific metas
		============================================ -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<link rel="stylesheet" href="<?php echo base_url('assets/js/owlcarousel/owl.carousel.css'); ?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.3.3.7.min.css'); ?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/css/animate.css'); ?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/css/fontello.css'); ?>">
		
		
		<!-- Theme CSS
		============================================ -->

		<link rel="stylesheet" href="<?php echo base_url('assets/js/layerslider/css/layerslider.css'); ?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/js/owlcarousel/owl.carousel.css'); ?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/js/fancybox/source/jquery.fancybox.css'); ?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/js/fancybox/source/helpers/jquery.fancybox-thumbs.css'); ?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/js/arcticmodal/jquery.arcticmodal.css'); ?>">
		
		<link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/css/main.css'); ?>">
		<link rel="stylesheet" href="<?php echo base_url("assets/css/jquery-ui.css"); ?>">
        <link rel="stylesheet" href="<?php echo base_url("assets/js/sweetalert/sweetalert.css"); ?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-datepicker.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/drawer.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/jquery.toast.min.css'); ?>">
        
		<!-- JS Libs
		============================================ -->
		<script src="<?php echo base_url('assets/js/modernizr.js'); ?>"></script>

		<!-- Old IE stylesheet
		============================================ -->
		<!--[if lte IE 9]>
			<link rel="stylesheet" type="text/css" href="css/oldie.css">
		<![endif]-->
	</head>
    
    
	<body class="front_page drawer drawer--left">

        <header role="banner">
        
        <nav class="drawer-nav" role="navigation">
          <ul class="drawer-menu">

           	<div class="home_on_mobile">
           		<li class="drawer-menu-item">
	           		<span class="logo-ko">
		            	<i class="icon-home-circled logo-home"></i>
		            	<a href="<?php echo site_url(); ?>" class="title"><b>marketplace.com</b></a>
		            </span>
		        </li>
	            <li class="drawer-menu-item">
	            	<span><img src="<?php echo base_url('assets/images/thailand.png'); ?>" class="icon-thailand"></span>
	           		<a data-toggle="collapse" href="#province_mobile">
	                    <span class="title">นครราชสีมา</span>
	                    <span class="caret"></span>
	            	</a>

	            	<ul class="drawer-dropdown-menu" id="province_mobile">	                   
	                    <li class="drawer-menu-item"><a href="<?php echo site_url(); ?>">บุรีรัมย์</a></li>
	                    <li class="drawer-menu-item"><a href="<?php echo site_url(); ?>">สุรินทร์</a></li>
		            </ul>
	            </li>

	            


	            <li class="drawer-menu-item">
	            	<span><img src="<?php echo base_url('assets/images/delivery.png'); ?>" class="icon-thailand"></span>
	            	<?php
					 $CI =& get_instance();
					 $current_amphur_name = "ไม่ระบุพื้นที่รับสินค้า";
					
					 if(isset($current_amphur_id) && $current_amphur_id != 0){
					 	 $amphurs = $CI->model_main->getAmphurByID($current_amphur_id);  
	                     foreach($amphurs as $row){
	                        $current_amphur_name = $row->amphur_name;
						 }
					 }
					  if(isset($current_amphur_id) && $current_amphur_id == 0)$current_amphur_name = "ไม่ระบุพื้นที่รับสินค้า";
					?>
	           		<a data-toggle="collapse" href="#main_province_mobile">
	                    <span class="title"><?php echo $current_amphur_name; ?></span>
	                    <span class="caret"></span>
	            	</a>
	    
	            
	            	<ul class="drawer-dropdown-menu" id="main_province_mobile">
	                   
	                    
						<?php
						 if(!isset($current_amphur_id))$current_amphur_id = 0;
	                     if($current_amphur_id != 0){
						?>
							<li class="drawer-menu-item"><a href="<?php echo base_url("product")."?amphur=0"; ?>">ไม่ระบุพื้นที่รับสินค้า</a></li> 
                        <?php
						 }
	                     $provinces = $CI->model_main->getAmphurByProvinceID(19); 
	                     foreach($provinces as $row){
	                        $amphur_id = $row->amphur_id;
	                        $amphur_name = $row->amphur_name;
	                        $selected = "";
	                        if($amphur_id == $current_amphur_id){
	                            $selected = "selected";	
								$current_amphur_name = $amphur_name;
	                        }
							$amphur_link = base_url("product")."?amphur=".$amphur_id;
							
							$pos = strpos($amphur_name,"*");
							if(!is_numeric($pos) && $amphur_id != $current_amphur_id){
							
	                    ?>
	                    
	                    <li class="drawer-menu-item"><a href="<?php echo $amphur_link; ?>"><?php echo $amphur_name; ?></a></li>
	                    <?php }} ?>
                        
                        
	                </ul>
	            </li>

	            

	            <li class="drawer-menu-item">
	            	<a href="<?php echo site_url("promotion"); ?>">
		            	<span class="icon-tag font-icon"></span>โปรโมชั่น
		            </a>
		        </li>
	            <li class="drawer-menu-item">
	            	<a href="<?php echo site_url("shop"); ?>">
		            	<span class="icon-shop font-icon"></span>ร้านค้า
		            </a>
		        </li>
	            <li class="drawer-menu-item">
	            	<a href="<?php echo site_url("news"); ?>">
		            	<span class="icon-news font-icon"></span>ข่าวสาร
		            </a>
		        </li>
	            <li class="drawer-menu-item">
	            	<a href="<?php echo site_url("faq"); ?>">
		            	<span class="icon-help-circled font-icon"></span>ช่วยเหลือ
		            </a>
		        </li>
	            
	            <li class="drawer-menu-item">
	            	<a href="<?php echo site_url("contact"); ?>">
			            <span class="icon-comment font-icon"></span>ติดต่อเรา
			        </a>
		        </li>
		    </div>

		    <div class="regis_on_mobile">
		    	<?php if(!$this->membermanager->isLoggedIn()){ ?>
	            <li class="drawer-menu-item">
	            	<a href="<?php echo site_url("member/login"); ?>">
		            	<span class="icon-login-1 font-icon"></span>เข้าสู่ระบบ
		            </a>
		        </li>
	            <li class="drawer-menu-item">
	            	<a href="<?php echo site_url("member/register"); ?>">
		            	<span class="icon-key font-icon"></span>สมัครสมาชิก
		            </a>
	            </li>
	            <?php } ?>
		    </div>
		    <div class="ssearch_on_mobile pt-5">
				<?php
				$keyword = $this->input->get("keyword");
				?>
				<form class="clearfix search" action="<?php echo base_url("product"); ?>" method="get">

					<input type="text" name="keyword" tabindex="1" placeholder="ค้นหาสินค้า หรือ ร้านค้า" value="<?php if(isset($keyword)) echo $keyword; ?>" class="alignleft input-radius-10" required>

					<button type="submit" class="button_blue def_icon_btn alignleft btn-radius-10"></button>

				</form>
			</div>

	        <div class="catagory_on_mobile">
	           	<li class="drawer-menu-item">
	           		<a data-toggle="collapse" href="#cateogry_shop">
	           			<span class="icon-edit font-icon"></span>
	                    <span class="title">หมวดหมู่สินค้า</span>
	                    <span class="caret"></span>

	            	</a>
	    
	            
	            	<ul class="drawer-dropdown-menu" id="cateogry_shop">
	                	<li class="drawer-menu-item"> <a href="<?php echo base_url("product"); ?>">รวมทุกหมวดหมู่</a></li>
	                   
						<?php
	                      $categorys = $CI->model_main->getProductCategory();
						  foreach($categorys as $row){
							  $main_category_id = $row->id;
							  $category_name = $row->category_name;
							  $category_link = base_url("product/0/".$main_category_id);
							  $category_link = str_replace(" ","-",$category_link);
							  
	                          $subcategorys = $CI->model_main->getProductSubCategory($main_category_id);
						      
							  if(count($subcategorys)>0){
					     ?>
	                     <li class="drawer-menu-item">
	                        <a data-toggle="collapse" href="#sub_cateogry_shop<?=$main_category_id;?>">
	                            <span class="title"><?php echo $category_name; ?></span>
	                            <span class="caret"></span>
	                        </a>
	            
	                    
	                        <ul class="drawer-dropdown-menu" id="sub_cateogry_shop<?=$main_category_id;?>">
	                        	<?php
	                            foreach($subcategorys as $sub){
	                                $sub_id = $sub->id;
	                                $sub_category_id = $sub->category_id;
	                                $sub_category_name = $sub->category_name;
	                           ?>
	                    	   <li class="drawer-menu-item"><a href="<?php echo base_url("product/0/".$main_category_id."/".$sub_id); ?>"><?php echo $sub_category_name; ?></a></li>
						       <?php  } ?>
	                           
	                           
	                           
	                        </ul>
	                          <?php 
							   
							  }else{
							   ?>
							
	                                                                
	                    <li class="drawer-menu-item"><a href="<?php echo $category_link; ?>"><?php echo $category_name; ?></a></li>
	                    <?php }} ?>
	                </ul>
	            </li>
          	</div>

          	<div class="account_on_mobile">
          		<?php if($this->membermanager->isLoggedIn()){ ?>
          			<li class="drawer-menu-item">
		                <span class="logo-ko-login top-menu-login">
			            	<i class="icon-user"></i>
				            <a data-toggle="collapse">
				                <b class="title">ยินดีต้อนรับ</b>
				                <b class="total_price">
                                <?php 
								if($this->storemanager->store_name()){
										echo $this->storemanager->store_name(); 
								}else{
										echo $this->session->userdata("first_name");
								}
								
								?>
                                </b>
				            </a>
			            </span>
		            </li>
		            <li class="drawer-menu-item">
		                <a href="<?php echo base_url('user'); ?>">
		                    <div class="clearfix ">

		                        <span class="color-user font-icon"> <img src="<?php echo base_url('assets/images/shopping2.png'); ?>" class="icon-thailand"></span> บัญชีผู้ซื้อ
		                    </div>
		                </a>
		            </li>
		            <li class="drawer-menu-item">
		                <a href="<?php echo base_url('store'); ?>">
		                    <div class="clearfix ">
		                        <span class="icon-shop color-user font-icon"></span>บัญชีร้านค้า
                                <?php
								$store_status = $this->session->userdata('store_status');
								if($store_status == 1 || $store_status == 3 || $store_status == 4 || $store_status == 6){
									echo '<span style="color:#f00">( กำลังตรวจสอบ )</span>';
								}else{
									if($this->storemanager->store_name()){
										echo '( '.$this->storemanager->store_name().' )'; 
									}
								}						
							  ?>
		                    </div>
		                </a>
		            </li>
		            <li class="drawer-menu-item">
		                <a href="<?php echo base_url("wishlist"); ?>" >
		                    <span class="wishlist_button_mobile wishlist_number" data-amount="0"></span>รายการโปรด
		                </a>
		            </li>
		            <li class="drawer-menu-item">
		                <a href="<?php echo base_url("message/inbox"); ?>" >
		                    <span class="inbox_button_mobile inbox_number" data-amount="0"></span>Inbox
		                </a>
		            </li>
		            <li class="drawer-menu-item">
		                <a href="<?php echo base_url("user/setting"); ?>">
		                    <div class="clearfix ">
		                        <span class="icon-cog-alt color-user font-icon"></span>ตั้งค่าการใช้งาน
		                    </div>
		                </a>
		            </li>
		            <li class="drawer-menu-item">
		                <a href="<?php echo site_url("member/logout"); ?>">
		                    <div class="clearfix">
		                        <span class="icon-logout-2 color-user font-icon"></span>ออกจากระบบ
		                    </div>
		                </a>
		            </li>
		        <?php }?>
          	</div>


          </ul>
        </nav>
      </header>
      
      
      
		<div class="wide_layout panel" id="main">

			<!-- - - - - - - - - - - - - - Header - - - - - - - - - - - - - - - - -->

			<header id="header" class="type_4">

				<!-- - - - - - - - - - - - - - Bottom part - - - - - - - - - - - - - - - - -->

				<div class="bottom_part">

					<div class="container">

						<div class="row">
							<div id="navbar">
								<div class="row">

									<div class="col-sm-3 col-xs-5 hide-ko-img">

										<!-- - - - - - - - - - - - - - Logo - - - - - - - - - - - - - - - - -->

										<a href="<?php echo site_url(); ?>" class="logo">

											<img src="<?php echo base_url($this->load->get_var('default_logo')); ?>" alt="">

										</a>

										<!-- - - - - - - - - - - - - - End of logo - - - - - - - - - - - - - - - - -->

									</div><!--/ [col]-->


									<div class="col-xs-3 mo_tab_menu mobile_only_show mc-icon-size mc-ml">
										<a onClick="toggleHome();">
											<div class="row drawer-toggle">
												<div class="col-xs-12">
													<i class="icon-pin color-user"></i>
												</div>
												<div class="col-xs-12">
													<label class="ft-icon">เมนูหลัก</label>
												</div>
											</div>
										</a>
									</div>

									<div class="col-xs-3 mo_tab_menu mobile_only_show pd-sch">
										<a onClick="toggleSearchInput();">
											<div class="row drawer-toggle">
												<div class="col-xs-12">
													<div class="search_button_mobile color-user"></div>
												</div>
												<div class="col-xs-12 pr-pl-0">
													<label class="ft-icon">หมวดหมู</label>
												</div>
											</div>
										</a>
									</div>
									<div class="col-xs-3 mo_tab_menu mobile_only_show pd-sch">
										<a onClick="toggleLogin();">
											<div class="row drawer-toggle">
												<div class="col-xs-12">
													<div class="icon-user-outline color-user"></div>
												</div>
												<div class="col-xs-12 pr-pl-0">
													<div class="ft-icon pd-account"> บัญชีผู้ใช้</div>
												</div>
											</div>
										</a>
									</div>
									<div class="col-xs-3 mo_tab_menu mobile_only_show">
										<div class="row">
											<div class="col-xs-12 pd-caet">
												<a href="<?php echo base_url("cart"); ?>" id="open_shopping_cart_mobile" class="open_button cart_total_item color-user" data-amount="0">
											</a>
											</div>
											<div class="col-xs-12">
												<label class="ft-icon cart-position">รถเข็น</label>
											</div>
										</div>
									</div>
	                               <!--  <div class="col-xs-5ths mobile_only_show ">
										<button type="button" class="drawer-toggle drawer-hamburger"><span class="sr-only">toggle navigation</span> <span class="drawer-hamburger-icon"></span></button>
	                                </div> -->
	                                
									<div class="col-lg-9 col-sm-9 col-xs-12 mobile_only_hide">

										<div class="clearfix">

											<!-- <div class="google-t alignright" id="google_translate_element"></div> -->
											<!-- - - - - - - - - - - - - - location change - - - - - - - - - - - - - - - - -->
											
											<div class="alignright site_settings">
												
													<select name="main_province" id="main_province" class="" hidden>
	                                                	<option value="0" selected>ไม่ระบุพื้นที่รับสินค้า</option>
														<?php
	                                                     $CI =& get_instance();
	                                                     $provinces = $CI->model_main->getAmphurByProvinceID(19); 
	                                                     foreach($provinces as $row){
															$amphur_id = $row->amphur_id;
	                                                        $amphur_name = $row->amphur_name;
															$selected = "";
															if($amphur_id == $current_amphur_id){
																$selected = "selected";	
															}
														 	$pos = strpos($amphur_name,"*");
															if(!is_numeric($pos)){
																
	                                                    ?>
														<option value="<?php echo $amphur_id; ?>" <?php echo $selected; ?>><?php echo $amphur_name ?></option>
														<?php }} ?>
													</select>
	                                                


											</div><!--/ .alignright.site_settings-->


											<!-- - - - - - - - - - - - - - End of location change - - - - - - - - - - - - - - - - -->

										</div><!--/ .clearfix-->
										
										<!-- - - - - - - - - - - - - - Navigation of shop - - - - - - - - - - - - - - - - -->

										<nav class="main-nav mobile_only_hide">
											<ul class="topbar">
												<li><a href="<?php echo site_url("promotion"); ?>">โปรโมชั่น</a></li>
												<li><a href="<?php echo site_url("shop"); ?>">ร้านค้า</a></li>
												<li><a href="<?php echo site_url("news"); ?>">บทความ</a></li>
												<li><a href="<?php echo site_url("faq"); ?>">ช่วยเหลือ</a></li>
	                                            <?php if(!$this->membermanager->isLoggedIn()){ ?>
												<li><a href="<?php echo site_url("member/login"); ?>">เข้าสู่ระบบ</a></li>
												<li><a href="<?php echo site_url("member/register"); ?>">สมัครสมาชิก</a></li>
	                                            <?php } ?>
												<li><a href="<?php echo site_url("contact"); ?>">ติดต่อเรา</a></li>
											</ul>
										</nav>

										<!-- - - - - - - - - - - - - - End navigation of shop - - - - - - - - - - - - - - - - -->

									</div><!--/ [col]-->

								</div><!--/ .main_header_row-->

								
							</div><!--/navbar-->
						</div><!--/ .row-->

					</div><!--/ .container-->

				</div><!--/ .bottom_part -->

				<!-- - - - - - - - - - - - - - End of bottom part - - - - - - - - - - - - - - - - -->

				<!-- - - - - - - - - - - - - - Main navigation wrapper - - - - - - - - - - - - - - - - -->

				<div id="main_navigation_wrap">

					<div class="container">

						<div class="row">

							<div class="col-xs-12">

								<div class="sticky_inner">

									<!-- - - - - - - - - - - - - - Navigation item - - - - - - - - - - - - - - - - -->

									<div class="nav_item size_1">
										<button class="open_menu"></button>
										<ul class="theme_menu cats dropdown">
											<div id="menuwrapper">
												<ul>
													<li class="">
														<a class="text-muted" href="<?php echo base_url("product"); ?>">รวมทุกหมวดหมู่</a>
													</li>
													<?php
												 
													$categorys = $CI->model_main->getProductCategory();
													foreach($categorys as $row){
														$main_category_id = $row->id;
														$category_name = $row->category_name;
														$category_link = base_url("product/0/".$main_category_id);
														$category_link = str_replace(" ","-",$category_link);
														$subcategorys = $CI->model_main->getProductSubCategory($main_category_id);
															if(count($subcategorys)>0){
														?>

														<li>
															<a class="text-muted" href="<?php echo $category_link; ?>"><?php echo $category_name; ?><i class="icon-right-dir has_tello"></i></a>
															<ul>
																<?php
	                                                            foreach($subcategorys as $sub){
	                                                                $sub_id = $sub->id;
	                                                                $sub_category_id = $sub->category_id;
	                                                                $sub_category_name = $sub->category_name;
	                                                            ?>
																<li><a href="<?php echo base_url("product/0/".$main_category_id."/".$sub_id); ?>"><?php echo $sub_category_name; ?></a></li>
																
	                                                            <?php } ?>
															</ul>
														
														</li>

														<?php 
																}else{
														?>
			                           
														<li class="">
															<a class="text-muted" href="<?php echo $category_link; ?>"><?php echo $category_name; ?></a>
														</li>
			                                            <?php }} ?>
												</ul>
	                                           	
	                                        </div>

										</ul>
									</div>

									<!-- ต้นฉบับ -->
									<!-- <div class="nav_item size_1">
										<button class="open_menu"></button>
										<ul class="theme_menu cats dropdown overflow">
											<li class="animated_item">
												<a href="<?php echo base_url("product"); ?>">รวมทุกหมวดหมู่2</a>
											</li>
                                            <?php
											 
											  $categorys = $CI->model_main->getProductCategory();
											  foreach($categorys as $row){
												  $main_category_id = $row->id;
												  $category_name = $row->category_name;
												  $category_link = base_url("product/0/".$main_category_id);
												  $category_link = str_replace(" ","-",$category_link);
												  
												 $subcategorys = $CI->model_main->getProductSubCategory($main_category_id);
					      
						  						if(count($subcategorys)>0){
											  ?>
											 
                                             <li class="has_megamenu animated_item">
                                               <a href="<?php echo $category_link; ?>"><?php echo $category_name; ?></a>
                                               <div class="mega_menu clearfix">
													<div class="mega_menu_item">
													
														<ul class="list_of_links">
															<?php
                                                            foreach($subcategorys as $sub){
                                                                $sub_id = $sub->id;
                                                                $sub_category_id = $sub->category_id;
                                                                $sub_category_name = $sub->category_name;
                                                            ?>
															<li><a href="<?php echo base_url("product/0/".$main_category_id."/".$sub_id); ?>"><?php echo $sub_category_name; ?></a></li>
															
                                                            <?php } ?>

														</ul>

													</div>
												</div>
                                             
                                               </li>
											  <?php 
                                               
                                              }else{
                                                  
                                               ?>
                           
											<li class=" animated_item">

												<a href="<?php echo $category_link; ?>"><?php echo $category_name; ?></a>

												
											</li>
											
                                            <?php }} ?>

										</ul>
									</div> -->

									<!-- - - - - - - - - - - - - - End of main navigation - - - - - - - - - - - - - - - - -->

									<!-- - - - - - - - - - - - - - Navigation item - - - - - - - - - - - - - - - - -->

									<div class="nav_item inner_offset">

										<!-- - - - - - - - - - - - - - Search form - - - - - - - - - - - - - - - - -->
										<?php
										$keyword = $this->input->get("keyword");
										?>
										<form class="clearfix search" action="<?php echo base_url("product"); ?>" method="get">

											<input type="text" name="keyword" tabindex="1" placeholder="ค้นหาสินค้า หรือ ร้านค้า" value="<?php if(isset($keyword)) echo $keyword; ?>" class="alignleft input-radius-10" required>
											
											

											<button type="submit" class="button_blue def_icon_btn alignleft btn-radius-10"></button>

										</form><!--/ #search-->
										
										<!-- - - - - - - - - - - - - - End search form - - - - - - - - - - - - - - - - -->

									</div><!--/ .nav_item-->

									<!-- - - - - - - - - - - - - - End of main navigation - - - - - - - - - - - - - - - - -->

									<!-- - - - - - - - - - - - - - Navigation item - - - - - - - - - - - - - - - - -->

									<div class="nav_item nav_item_2 size_1">

										<a href="<?php echo base_url("wishlist"); ?>" class="wishlist_button wishlist_number" data-amount="0"></a>
										
									</div><!--/ .nav_item-->

									<!-- - - - - - - - - - - - - - End of main navigation - - - - - - - - - - - - - - - - -->

									<!-- - - - - - - - - - - - - - Navigation item - - - - - - - - - - - - - - - - -->

									<div class="nav_item nav_item_2 size_1">

										<a href="<?php echo base_url("message"); ?>" class="inbox_button wishlist_button inbox_number" data-amount="0"></a>
										
									</div><!--/ .nav_item-->

									<!-- - - - - - - - - - - - - - End of main navigation - - - - - - - - - - - - - - - - -->

									<!-- - - - - - - - - - - - - - Navigation item - - - - - - - - - - - - - - - - -->

									<div class="nav_item size_2">
										<?php if($this->membermanager->isLoggedIn()){ ?>
										<button id="open_profile" class="open_button">
											<b class="title">ยินดีต้อนรับ</b>
											<b class="total_price">
                                            <?php 
											if($this->storemanager->store_name()){
										echo $this->storemanager->store_name(); 
								}else{
										echo $this->session->userdata("first_name");
								}
											
											?>
                                            </b>
										</button>

										
										<div class="shopping_cart dropdown">

												<div class="animated_item">
													<a href="<?php echo base_url('user'); ?>">
														<div class="clearfix sc_product">

															บัญชีผู้ซื้อ  <?php if($this->membermanager->coin()) echo '( '.number_format($this->membermanager->coin()).' เหรียญ )'; ?>

														</div>
													</a>
												</div>
												<div class="animated_item">
													<a href="<?php echo base_url('store'); ?>">
														<div class="clearfix sc_product">
															บัญชีร้านค้า 
															<?php 
															$store_status = $this->session->userdata('store_status');
															if($store_status == 1 || $store_status == 3 || $store_status == 4 || $store_status == 6){
																echo '<span style="color:#f00">( กำลังตรวจสอบ )</span>';
															}else{
																if($this->storemanager->store_name()){
																	echo '( '.$this->storemanager->store_name().' )'; 
																}
															}
															
															?>
														</div>
													</a>
												</div>
												<div class="animated_item">
													<a href="<?php echo base_url("user/setting"); ?>">
														<div class="clearfix sc_product">
															ตั้งค่าการใช้งาน
														</div>
													</a>
												</div>
                                                <div class="animated_item">
													<a href="<?php echo site_url("member/logout"); ?>">
														<div class="clearfix sc_product">
															ออกจากระบบ
														</div>
													</a>
												</div>
												
											</div>
											<?php }else{ ?>
                                            <div class="login_box"><div class="login_box_inner"><a href="<?php echo site_url("member/login"); ?>">เข้าสู่ระบบ</a> หรือ <a href="<?php echo site_url("member/register"); ?>">สมัครสมาชิก</a></div></div>
                                            <?php } ?>
										<!-- - - - - - - - - - - - - - End of products list - - - - - - - - - - - - - - - - -->
										
									</div><!--/ .nav_item-->

									<!-- - - - - - - - - - - - - - End of main navigation - - - - - - - - - - - - - - - - -->

									<!-- - - - - - - - - - - - - - Navigation item - - - - - - - - - - - - - - - - -->
									<?php
									
									?>
									<div class="nav_item size_2">

										<button id="open_shopping_cart" class="open_button cart_total_item" data-amount="0">
											<b class="title">ตะกร้า</b>
											<b class="total_price cart_total_price"></b>
										</button>

										<!-- - - - - - - - - - - - - - Products list - - - - - - - - - - - - - - - - -->

										<div class="shopping_cart dropdown">

												<div class="cart_container"></div>

												<div class="col-md-12 animated_item cart_buy_item">
													<a href="<?php echo base_url("cart"); ?>" class="button_blue"><i class="icon-cart"></i> สั่งซื้อสินค้า</a>
												</div>

											</div><!--/ .shopping_cart.dropdown-->
										
										<!-- - - - - - - - - - - - - - End of products list - - - - - - - - - - - - - - - - -->
										
									</div><!--/ .nav_item-->

									<!-- - - - - - - - - - - - - - End of main navigation - - - - - - - - - - - - - - - - -->

								</div><!--/ .main_navigation-->

							</div><!--/ [col]-->

						</div><!--/ .row-->

					</div><!--/ .container-->

				</div><!--/ .main_navigation_wrap-->

				<!-- - - - - - - - - - - - - - End of main navigation wrapper - - - - - - - - - - - - - - - - -->

			</header>
            
			<!-- - - - - - - - - - - - - - End Header - - - - - - - - - - - - - - - - -->
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            
            

			<!-- - - - - - - - - - - - - - Page Wrapper - - - - - - - - - - - - - - - - -->
<div class="secondary_page_wrapper">

    <div class="container">

        <!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

        <ul class="breadcrumbs">

            <li><a href="<?php echo base_url(); ?>">หน้าหลัก</a></li> 
            <li><a href="<?php echo base_url($store_url."/".$product_category); ?>"><?php echo $product_category_name; ?></a></li>
            <li><?php echo $product_name; ?></li>

        </ul>

        <!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->

        <!-- - - - - - - - - - - - - - Product images & description - - - - - - - - - - - - - - - - -->

        <section class="section_offset">

            <div class="clearfix">

                <!-- - - - - - - - - - - - - - Product image column - - - - - - - - - - - - - - - - -->

                <div class="single_product">

                    <!-- - - - - - - - - - - - - - Image preview container - - - - - - - - - - - - - - - - -->

                    <div class="image_preview_container">

                        <img id="img_zoom" data-zoom-image="<?php echo base_url($default_image); ?>" src="<?php echo base_url($default_image); ?>" alt="<?php echo $product_name; ?>">

                        <button class="button_grey_2 icon_btn middle_btn open_qv"><i class="icon-resize-full-6"></i></button>

                    </div><!--/ .image_preview_container-->

                    <!-- - - - - - - - - - - - - - End of image preview container - - - - - - - - - - - - - - - - -->

                    <!-- - - - - - - - - - - - - - Prodcut thumbs carousel - - - - - - - - - - - - - - - - -->
                    
                    <div class="product_preview">

                        <div class="owl_carousel" id="thumbnails">
                            <?php
							foreach($images as $row){
								$image_url = base_url($row->image_url);
							?>
                            <a href="#" data-image="<?php echo $image_url; ?>" data-zoom-image="<?php echo $image_url; ?>">
                                <img src="<?php echo $image_url; ?>" data-large-image="<?php echo $image_url; ?>" alt="<?php echo $product_name; ?>">
                            </a>
							<?php } ?>
                            
                        </div><!--/ .owl-carousel-->

                    </div><!--/ .product_preview-->
                    
                    <!-- - - - - - - - - - - - - - End of prodcut thumbs carousel - - - - - - - - - - - - - - - - -->

                    <!-- - - - - - - - - - - - - - Share - - - - - - - - - - - - - - - - -->
                    
                    <div class="v_centered">

                        <span class="title">แชร์ไปที่ :</span>

                        <div class="addthis_widget_container">
                            <!-- AddThis Button BEGIN -->
                            <div class="addthis_toolbox addthis_default_style addthis_32x32_style">
                            <a class="addthis_button_preferred_1"></a>
                            <a class="addthis_button_preferred_2"></a>
                            <a class="addthis_button_preferred_3"></a>
                             <!--<a class="addthis_button_preferred_4"></a>
                            <a class="addthis_button_compact"></a>
                            <a class="addthis_counter addthis_bubble_style"></a>-->
                            </div>
                            <!-- AddThis Button END -->
                        </div>
                        
                    </div>
                    
                    <!-- - - - - - - - - - - - - - End of share - - - - - - - - - - - - - - - - -->

                </div>

                <!-- - - - - - - - - - - - - - End of product image column - - - - - - - - - - - - - - - - -->

                <!-- - - - - - - - - - - - - - Product description column - - - - - - - - - - - - - - - - -->

                <div class="single_product_description theme_box">

                    <h3 class="offset_title"><a href="#"><?php echo $product_name; ?></a></h3>
					
                    <?php if(!empty($product_brand) && !empty($product_version)){ ?>
                    <div class=" v_centered">
                        
                        <ul class="topbar">

                            <li><?php echo $product_brand; ?></li>
                            <li><?php echo $product_version; ?></li>

                        </ul>									

                    </div>
					<?php } ?>
                    <div class=" v_centered pt-10">

                        <!-- - - - - - - - - - - - - - Product rating - - - - - - - - - - - - - - - - -->
                    
                        <div class="star-ratings">
                      <div class="fill-ratings" style="width: <?php echo $product_rating; ?>%;">
                        <span>★★★★★</span>
                      </div>
                      <div class="empty-ratings">
                        <span>★★★★★</span>
                      </div>
                    </div>
                            
                        <!-- - - - - - - - - - - - - - End of product rating - - - - - - - - - - - - - - - - -->

                        <!-- - - - - - - - - - - - - - Reviews menu - - - - - - - - - - - - - - - - -->

                        <ul class="topbar">

                            <li><a href="#"><?php echo $product_review; ?> รีวิว</a></li>
                            <li>รหัส SKU : <?php echo $product_code; ?></li>

                        </ul>

                        <!-- - - - - - - - - - - - - - End of reviews menu - - - - - - - - - - - - - - - - -->

                    </div>

                    <div class="description_section v_centered pt-10">
						
                        <?php if($service_delivery || $product_type == 2){ ?>
                        <ul class="topbar">
							
                            <?php if($product_type == 2){ ?>
                            <li class="icon_pd_detail_1">
                            
                            <img src="<?php echo base_url("assets/images/recycling.svg"); ?>">
                            <?php echo $product_type_name; ?></li>
                            <?php } ?>
                             
                            
                            <?php if($service_delivery){ ?>
                            <li class="icon_pd_detail_1"><img src="<?php echo base_url("assets/images/shipped.svg"); ?>"> บริการจัดส่ง</li>
							<?php } ?>
                        </ul>
						<?php } ?>
                    </div>
					<?php
					if($gateway_type_id == 2){ // ชำระบางส่วน
						echo "<small class='main-blue'>* ชำระล่วงหน้า ".number_format($option1)." บาท จ่ายส่วนที่เหลือ ".number_format($option2)." บาท เมื่อได้รับสินค้าหรือบริการ</small>";
					}
					if($gateway_type_id == 1){ // ไม่ต้องชำระตอนนี้
						echo "<small class='main-blue'>* ไม่ต้องชำระตอนนี้ จ่ายเมื่อได้รับสินค้าหรือบริการ</small>";
					}
					?>
                    <p class="product_price product_price_detail pd_detail_price">
                    <?php if($product_price != $product_price_discount){ ?>
                    <s>฿<?php echo number_format($product_price,2); ?></s> 
                    <?php } ?> 
                    <b class="theme_color product_price_discount product_price_discount_detail">฿<?php echo number_format($product_price_discount,2); ?></b>
                    </p>


					<?php
					$product_relate = $this->model_shop->getProductRelate($product_id);
					if(count($product_relate) > 0){
					?>
                    <hr>

                    <div class="row pd_option">
                        <div class="col-md-2">
                            <span class="title">ตัวเลือกสินค้า:</span>
                        </div>
                        <div class="col-md-10">
                            <div class="row">
                                <?php 
								$n = 0;
								
								foreach($product_relate as $row){
									$relate_product_id = $row->product_id;
									$relate_store_id = $row->store_id;
									$relate_product_name = $row->product_name;
									$relate_product_price = $row->product_price;
									$relate_product_price_discount = $row->product_price_discount;
									$relate_product_qty = $row->product_qty;
									
									
									$promo = $this->utils->promotion_in_time($relate_product_id);
									if($promo->promo_price > 0)$relate_product_price_discount = $promo->promo_price;
						
									$checked = "";
									
									if($n == 0){
										$n++;
										$checked = "checked";
										
									}
									
								?>
                                <div class="col-md-4 col-xs-12 pb-10">
                                	<input type="radio" name="relate_product_id" class="relate_product_id" onChange="changeRelate(this);" id="radio_button_<?php echo $relate_product_id; ?>" relate_product_name="<?php echo $relate_product_name; ?>" relate_product_price="<?php echo $relate_product_price; ?>" relate_product_price_discount="<?php echo $relate_product_price_discount; ?>" relate_product_qty="<?php echo $relate_product_qty; ?>" value="<?php echo $relate_product_id; ?>" <?php echo $checked; ?>>
                        			<label for="radio_button_<?php echo $relate_product_id; ?>"><?php echo $relate_product_name; ?></label>
                            
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
					<?php } ?>
                    <hr>

                    

                    <!-- - - - - - - - - - - - - - Quantity - - - - - - - - - - - - - - - - -->
					 <?php if($product_qty > 0){ ?>
                    <div class="row pd_option">
                        <div class="col-md-2">
                            <span class="title">จำนวน:</span>
                        </div>
                        <div class="col-md-4">
                            <div class="qty clearfix">

                                <button class="theme_button" data-direction="minus">&#45;</button>
                                <input type="text" name="product_qty" class="product_qty" value="1">
                                <button class="theme_button" data-direction="plus">&#43;</button>

                            </div>
                        </div>
                        <?php if($product_qty <= 5 && $product_qty > 0){ 
							if($product_qty <= 0)$product_qty = 0;
						?>
                        <div class="col-md-6">
                            <span class="title main-blue product_qty product_qty_detail">คงเหลือเพียง <?php echo number_format($product_qty); ?></span>
                        </div>
                        <?php } ?>
                    </div>
					<?php } ?>
                    <!-- - - - - - - - - - - - - - End of quantity - - - - - - - - - - - - - - - - -->

                    <!-- - - - - - - - - - - - - - Product actions - - - - - - - - - - - - - - - - -->

                    <div class="margin-t-10 pull-right ">
						
                        <?php if($product_qty > 0){ ?>
                        <button type="button" id="add_to_cart_product_id" onClick="addToCart(this,1);" product_id="<?php echo $product_id; ?>" product_name="<?php echo $product_name; ?>" relate_product_name = "" product_image="<?php echo $default_image; ?>" store_id="<?php echo $store_id; ?>" product_price_discount="<?php echo $product_price_discount; ?>" product_qty="1" class="button_blue middle_btn margin_m_b_10 cart_item_default"><i class="icon-basket-1"></i>เพิ่มลงตะกร้า</button>
						<?php } ?>
                        
                        <button type="button" id="add_to_wishlist_product_id" onClick="addToCart(this,2);" product_id="<?php echo $product_id; ?>" product_name="<?php echo $product_name; ?>" relate_product_name = "" product_image="<?php echo $default_image; ?>" store_id="<?php echo $store_id; ?>" product_price_discount="<?php echo $product_price_discount; ?>" product_qty="0" class="button_blue middle_btn"><i class="icon-heart-3"></i>เพิ่มในรายการโปรด</button>

                    </div>

                    <!-- - - - - - - - - - - - - - End of product actions - - - - - - - - - - - - - - - - -->

                </div>

                <!-- - - - - - - - - - - - - - End of product description column - - - - - - - - - - - - - - - - -->

            </div>

        </section><!--/ .section_offset -->

        <!-- - - - - - - - - - - - - - End of product images & description - - - - - - - - - - - - - - - - -->

        <!-- - - - - - - - - - - - - - Seller Information - - - - - - - - - - - - - - - - -->

        <?php $this->load->view("shop/templates/shop_detail_no_cover",$mystore); ?>

        <!-- - - - - - - - - - - - - - End of seller information - - - - - - - - - - - - - - - - -->

        <!-- - - - - - - - - - - - - - Tabs - - - - - - - - - - - - - - - - -->

        <div class="section_offset">

            <div class="tabs type_2">
                <!-- - - - - - - - - - - - - - Navigation of tabs - - - - - - - - - - - - - - - - -->


				<div class="mobile_only_show">
					<button class="button_grey_outline btn-block text-left" type="button" data-toggle="collapse" data-target="#detail_tab" aria-expanded="false" aria-controls="detail_tab">
					        รายละเอียด<span class="caret"></span>
					</button>
				</div>

				<ul class="theme_menu tabs_nav clearfix pb-5 mobile_only_show" >
					<aside class="col-md-3 col-sm-4 collapse pl-0 pr-0" id="detail_tab">
					    <section class="section_offset">
					    	<ul class="theme_menu tabs_nav clearfix">
			                    <li><a href="#tab-1">รายละเอียดสินค้า</a></li>
			                    <?php if($number_of_place > 0){ ?>
			                    <li><a href="#tab-2">สถานที่ส่งสินค้า</a></li>
			                    <?php } ?>
			                    <?php if(count($reviews)>0){ ?>
			                    <li><a href="#tab-3">รีวิว (<?php echo count($reviews); ?>)</a></li>
			                    <?php } ?>
			                </ul>
		                </section>
	                </aside>
                </ul>
                <ul class="tabs_nav clearfix mobile_only_hide">
                    <li><a href="#tab-1">รายละเอียดสินค้า</a></li>
                    <?php if($number_of_place > 0){ ?>
                    <li><a href="#tab-2">สถานที่ส่งสินค้า</a></li>
                    <?php } ?>
                    <?php if(count($reviews)>0){ ?>
                    <li><a href="#tab-3">รีวิว (<?php echo count($reviews); ?>)</a></li>
                    <?php } ?>
                </ul>
                
                <!-- - - - - - - - - - - - - - End navigation of tabs - - - - - - - - - - - - - - - - -->

                <!-- - - - - - - - - - - - - - Tabs container - - - - - - - - - - - - - - - - -->

                <div class="tab_containers_wrap">

                    <!-- - - - - - - - - - - - - - Tab - - - - - - - - - - - - - - - - -->

                    <div id="tab-1" class="tab_container">

                        <?php echo $product_description; ?>

                    </div><!--/ #tab-1-->

					 <div id="tab-2" class="tab_container">

                        
                        
                        <?php if(count($store_place)>0){ ?> <h3>สถานที่ของผู้ขาย</h3> <?php } ?>
                                    
                                    
                                    <?php 
									$place_num = 0;
									
									foreach($store_place as $place){
										$place_id = $place->place_id;
										$place_code = $place->place_code;
										$place_name = $place->place_name;
										$place_province = $place->place_province;
										$place_amphur = $place->place_amphur;
										$place_district = $place->place_district;
										$place_address = $place->place_address;
										$place_postcode = $place->place_postcode;
										$place_mobile = $place->place_mobile;
										$working_time_id = $place->working_time_id;
										$place_lat = $place->place_lat;
										$place_long = $place->place_long;
										$place_condition = $place->place_condition;
										
										$province = $this->storemanager->getProvinceName($place_province);
										$amphur = $this->storemanager->getAmphurName($place_amphur);
										$district = $this->storemanager->getDistrictName($place_district);
										$map = 'https://www.google.com/maps/search/?api=1&query='.$place_lat.','.$place_long;
										$place_num++;
									?>
									<div class="single_shop_placebox margin-t-20">
										<div class="row">
                                        	<a target="_blank" href="<?php echo base_url("place/info/".$place_id); ?>">
											<div class="col-md-10">
												<div class="title_place">
												
												<?php echo $place_num; ?>. <?php echo $place_name; ?>
                                                
                                                </div>
												<p>
                                                
													<?php echo $place_address." ".$district." ".$amphur." ".$province." ".$place_postcode; ?><br><?php echo $place_condition; ?>
                                                
												</p>
											</div>
                                            </a>
											<div class="col-md-2">
												<a href="<?php echo $map; ?>" target="_blank" class="button_blue btn-block "><i class="icon-location-3"></i> ดูแผนที่</a>
											</div>
										</div>
										
									</div>
									<?php } ?>
                                    
                                    
                                    
                                    
									
									<div class="clear margin-t-20"></div>
									<?php if(count($agent_place)>0){ ?><h3>สถานที่ของตัวแทนผู้ขาย</h3> <?php } ?>
                                    
                                    
									<?php 
									$place_num = 0;
									
									foreach($agent_place as $place){
										$place_id = $place->place_id;
										$place_code = $place->place_code;
										$place_name = $place->place_name;
										$place_province = $place->place_province;
										$place_amphur = $place->place_amphur;
										$place_district = $place->place_district;
										$place_address = $place->place_address;
										$place_postcode = $place->place_postcode;
										$place_mobile = $place->place_mobile;
										$working_time_id = $place->working_time_id;
										$place_lat = $place->place_lat;
										$place_long = $place->place_long;
										$place_condition = $place->place_condition;
										
										$province = $this->storemanager->getProvinceName($place_province);
										$amphur = $this->storemanager->getAmphurName($place_amphur);
										$district = $this->storemanager->getDistrictName($place_district);
										$map = 'https://www.google.com/maps/search/?api=1&query='.$place_lat.','.$place_long;
										$place_num++;
									?>
									<div class="single_shop_placebox margin-t-20">
										<div class="row">
                                        	<a target="_blank" href="<?php echo base_url("place/info/".$place_id); ?>">
											<div class="col-md-10">
												<div class="title_place"><?php echo $place_num; ?>. <?php echo $place_name; ?></div>
												<p>
													<?php echo $place_address." ".$district." ".$amphur." ".$province." ".$place_postcode; ?><br><?php echo $place_condition; ?>
												</p>
											</div>
											<div class="col-md-2">
												<a href="<?php echo $map; ?>" target="_blank" class="button_blue btn-block "><i class="icon-location-3"></i> ดูแผนที่</a>
											</div>
                                            </a>
										</div>
										
									</div>
									<?php } ?>
                                    
                                    
                                    
                                    
                                    
									<div class="clear margin-t-20"></div>
									<?php if(count($service_place)>0){ ?><h3>เขตพื้นที่บริการจัดส่ง</h3><?php } ?>
									
                                    
                                    <?php 
									$place_num = 0;
									foreach($service_place as $place){
										$place_id = $place->place_id;
										$place_code = $place->place_code;
										$place_name = $place->place_name;
										$place_province = $place->place_province;
										$place_amphur = $place->place_amphur;
										$place_district = $place->place_district;
										$place_address = $place->place_address;
										$place_postcode = $place->place_postcode;
										$place_mobile = $place->place_mobile;
										$working_time_id = $place->working_time_id;
										$place_lat = $place->place_lat;
										$place_long = $place->place_long;
										$place_condition = $place->place_condition;
										
										$amphur = $this->storemanager->getAmphurName($place_amphur);
										$province = $this->storemanager->getProvinceName($place_province);
										if($amphur == '-'){
											$amphur = '';
										}
										$place_num++;
									?>
									<div class="single_shop_placebox margin-t-20">
										<div class="row">
											<div class="col-md-12">
												<div class="title_place"><?php echo $place_num; ?>. <?php echo $amphur.' '.$province; ?></div>
												<p>
													<?php echo $place_condition; ?>
												</p>
											</div>
											
										</div>
										
									</div>
									<?php } ?>
                                    
                                    

                    </div><!--/ #tab-1-->
                    <!-- - - - - - - - - - - - - - End tab - - - - - - - - - - - - - - - - -->

                    <!-- - - - - - - - - - - - - - Tab - - - - - - - - - - - - - - - - -->

                    <div id="tab-3" class="tab_container">

                        <section class="section_offset">

                            <ul class="reviews">
                            
                            	<?php 
								foreach($reviews as $row){
									$review_id = $row->review_id;
									$order_id = $row->order_id;
									$member_id = $row->member_id;
									$store_id = $row->store_id;
									$product_id = $row->product_id;
									$review_rating = $row->review_rating;
									$review_content = $row->review_content;
									$review_images = $row->review_images;
									$review_type = $row->review_type;
									$review_status = $row->review_status;
									$timestamp = $row->timestamp;
									
									$member = $this->model_review->getReviewMemberByID($member_id);
									$name = "-";
									if(count($member))$name = $member[0]->first_name;//$member[0]->last_name;
									// if($review_type == 3){}
								?>

								<li>

									<!-- - - - - - - - - - - - - - Review - - - - - - - - - - - - - - - - -->
									
									<article class="review">

										<!-- - - - - - - - - - - - - - Rates - - - - - - - - - - - - - - - - -->

										<ul class="review-rates">

											<!-- - - - - - - - - - - - - - Price - - - - - - - - - - - - - - - - -->

											<li class="v_centered">

												<ul class="rating">

													<?php
													for($i = 0;$i<5;$i++){
														if($i<$review_rating){
															echo '<li class="active"></li>';	
														}else{
															echo '<li></li>';
														}
													?>
													<?php } ?>

												</ul>

											</li>
										</ul>
										<div class="review-body">

											<div class="review-meta">

												รีวิวโดย <b><?php echo $name; ?></b> เมื่อ <?php echo $this->utils->getThaiDate($timestamp); ?>

											</div>

											<p> <?php echo $review_content; ?> </p>

										</div>

									</article>

								</li>

								
								<?php } ?>

                                

                            </ul>

                            <div class="review_pagenum v_centered">
                                <!--<ul class="pags">

                                    <li><a href="#"></a></li>
                                    <li class="active"><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#"></a></li>

                                </ul>-->
                            </div>

                        </section><!--/ .section_offset -->

                    </div><!--/ #tab-3-->

                    <!-- - - - - - - - - - - - - - End tab - - - - - - - - - - - - - - - - -->

                </div><!--/ .tab_containers_wrap -->

                <!-- - - - - - - - - - - - - - End of tabs containers - - - - - - - - - - - - - - - - -->

            </div><!--/ .tabs-->

        </div><!--/ .section_offset -->

        <!-- - - - - - - - - - - - - - End of tabs - - - - - - - - - - - - - - - - -->

        <!-- - - - - - - - - - - - - - Featured products - - - - - - - - - - - - - - - - -->

       

                <?php $PAGE['product_category'] = $product_category; ?>
                <?php $PAGE['cur_product_id'] = $product_id; ?>
				<?php $this->load->view("shop/templates/product_relate",$PAGE); ?>
                
                
              

        <!-- - - - - - - - - - - - - - End of featured products - - - - - - - - - - - - - - - - -->

    </div><!--/ .container-->

</div><!--/ .page_wrapper-->
			
			<!-- - - - - - - - - - - - - - End Page Wrapper - - - - - - - - - - - - - - - - -->
<?php $this->load->view("templates/footer"); ?>
<script type="text/javascript" src="<?php echo base_url("assets/js/addthis.js"); ?>"></script>
<script>
function changeRelate(_this){
	
	var relate_product_id = $(_this).val();
	var relate_product_name = $(_this).attr("relate_product_name");
	var relate_product_price = $(_this).attr("relate_product_price");
	var relate_product_price_discount = $(_this).attr("relate_product_price_discount");
	var relate_product_qty = $(_this).attr("relate_product_qty");
	
	if(relate_product_id != "" && relate_product_id != undefined && relate_product_id != "undefined"){
		/*console.log("relate_product_price : "+relate_product_price);
		console.log("relate_product_price_discount : "+relate_product_price_discount);
		console.log("relate_product_qty : "+relate_product_qty);*/
		
		$(".product_price_detail s").text("฿"+numberWithCommasFloat(relate_product_price));
		$(".product_price_discount_detail").text("฿"+numberWithCommasFloat(relate_product_price_discount));
		$(".product_qty_detail").text("คงเหลือเพียง "+relate_product_qty);
		
		$("#add_to_cart_product_id").attr("product_id",relate_product_id);
		$("#add_to_cart_product_id").attr("product_price_discount",relate_product_price_discount);
		$("#add_to_cart_product_id").attr("product_qty",relate_product_qty);
		
		$("#add_to_cart_product_id").attr("relate_product_name",relate_product_name);
		
		//$("#add_to_wishlist_product_id").attr("product_id",relate_product_id);
		
		//$("#add_to_cart_product_id").attr("product_id",relate_product_id);
		//$("#add_to_wishlist_product_id").attr("product_name",relate_product_name);
	}
	
}
$(document).ready(function(){
	var _this = $('input[name=relate_product_id]:checked');
	changeRelate(_this);
	//$(".relate_product_id").trigger("change");					   
});


$(".product_qty").change(function(){
	if($(this).val() <= 0){
		$(this).val(1);	
	}
});

function numberWithCommasFloat(x) {
	
	x = parseFloat(x).toFixed(2);
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

</script>