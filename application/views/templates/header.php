<!doctype html>
<style type="text/css">
	label{
	    cursor: auto !important;
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
			color: #f53e2d !important;
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

	/*Scrollbar*/
	#menuwrapper ul {
		height:400px;
		overflow-x: hidden !important;
		overflow-y: auto;

		/*แสดงผล scrollbar ใน IE*/
		-ms-overflow-style: none !important;

		/*แสดงผล scrollbar ใน Firefox */
		scrollbar-width: none !important;
	}
	#menuwrapper ::-webkit-scrollbar {
		/*แสดงผล scrollbar ใน Chome*/
	     width: 0px !important;
	}
	/*End Scrollbar*/



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
		            	<a href="<?php echo site_url(); ?>" class="title"><b><?php echo base_url()?></b></a>
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
					 $current_amphur_id = $this->session->userdata("current_amphur_id");
					 
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

	            

	            <!-- <li class="drawer-menu-item">
	            	<a href="<?php //echo site_url("promotion"); ?>">
		            	<span class="icon-tag font-icon"></span>โปรโมชั่น
		            </a>
		        </li>
	            <li class="drawer-menu-item">
	            	<a href="<?php //echo site_url("shop"); ?>">
		            	<span class="icon-shop font-icon"></span>ร้านค้า
		            </a>
		        </li> -->
	            <li class="drawer-menu-item">
	            	<a href="<?php echo site_url("news"); ?>">
		            	<span class="icon-news font-icon"></span>บทความ
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
										$store_name =  $this->storemanager->store_name(); 
										if(strlen($store_name) > 20){
											$store_name = iconv_substr($store_name,0,15,"UTF-8")."...";
										}else{
											$store_name =  iconv_substr($store_name,0,15,"UTF-8");
										}
										echo $store_name;
								}else{
										$first_name =  $this->session->userdata("first_name");
										if(strlen($first_name) > 20){
											$first_name = iconv_substr($first_name,0,15,"UTF-8")."...";
										}else{
											$first_name =  iconv_substr($first_name,0,15,"UTF-8");
										}
										echo $first_name;
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
													<label class="ft-icon">ค้นหา</label>
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
													$store_name = $this->storemanager->store_name(); 
													if(strlen($store_name) > 20){
														$store_name = iconv_substr($store_name,0,15,"UTF-8")."...";
													}else{
														$store_name =  iconv_substr($store_name,0,15,"UTF-8");
													}
													echo $store_name;

											}else{
													$first_name = $this->session->userdata("first_name");
													if(strlen($first_name) > 20){
														$first_name = iconv_substr($first_name,0,15,"UTF-8")."...";
													}else{
														$first_name =  iconv_substr($first_name,0,15,"UTF-8");
													}
													echo $first_name;
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
            
            
            
            
            
            
            
            
            
            
            
            