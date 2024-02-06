<!-- เริ่มต้น Header -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('assets/custom/images/LogoDogCat.svg'); ?>">
    <title><?php echo $title; ?></title>

    <!-- summernotes CSS -->
    <link href="<?php echo base_url('assets/system/plugins/summernote/dist/summernote.css'); ?>" rel="stylesheet" type="text/css">

    <link href="<?php echo base_url('assets/system/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" media='screen,print'>

     <!--alerts CSS -->
    <link href="<?php echo base_url('assets/system/plugins/sweetalert/sweetalert.css'); ?>" rel="stylesheet" type="text/css">

    
    <link href="<?php echo base_url('assets/system/plugins/bootstrap-table/dist/bootstrap-table.min.css'); ?>" rel="stylesheet" media='screen,print' type="text/css" />
    
    <link href="<?php echo base_url('assets/system/plugins/tablesaw-master/dist/tablesaw.css'); ?>" rel="stylesheet" media='screen,print'>

    <link href="<?php echo base_url('assets/system/css/style.css'); ?>" rel="stylesheet" media='screen,print'>
    <link href="<?php echo base_url('assets/system/css/colors/blue.css'); ?>" id="theme" rel="stylesheet">
    <link href="<?php echo base_url('assets/custom/css/main.css'); ?>" id="theme" rel="stylesheet" media='screen,print'>
    
    <!--datetimepicker CSS -->
    <link href="<?php echo base_url('assets/system/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/system/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css'); ?>" rel="stylesheet">
    <!-- Page plugins css -->
    <link href="<?php echo base_url('assets/system/plugins/clockpicker/dist/jquery-clockpicker.min.css'); ?>" rel="stylesheet">

    <!--alerts CSS -->
    <link href="<?php echo base_url('assets/system/plugins/sweetalert/sweetalert.css'); ?>" rel='stylesheet' type="text/css">

    <!--alerts TIMELINE -->
    <link href="<?php echo base_url('assets/system/plugins/horizontal-timeline/css/horizontal-timeline.css" rel="stylesheet'); ?>" type="text/css">
    <link href="<?php echo base_url('assets/custom/css/jquery-ui.css'); ?>" rel="stylesheet" type="text/css">
    
    <link href="<?php echo base_url('assets/system/plugins/morrisjs/morris.css'); ?>" rel="stylesheet" type="text/css">
    
    <!-- lightbox -->
    <link href="<?php echo base_url('assets/system/dist/css/lightbox.min.css'); ?>" rel="stylesheet" type="text/css">
    
    
    

</head>

<body class="fix-header card-no-border">
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!--เริ่มต้น main-wrapper-->
    <div id="main-wrapper">
        <header class="topbar head-top">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                
                <div class="navbar-collapse">
                	<ul class="navbar-nav mr-auto mt-md-0">
                		<li class="nav-item dropdown">
                            <div class="logobox">
                                <a href="<?php echo site_url("statistics"); ?>">  
                                    <?php 
                                    $img = "../".$this->load->get_var('default_logo');
                                    ?>
                                    <img src="<?php echo base_url($img); ?>" alt="" class="light-logo">
                                </a>
		                    </div>
		                    
                        </li>
                        <!-- This is  -->
                       
                        <li class="nav-item dropdown">
                            <div class="logonamebox">
		                    	<a class="navbar-brand" href="<?php echo site_url("home"); ?>">
		                    		<span class="hp-name" style="color:#ccc;"></span>
		                   		</a>
		                   </div>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                    
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu text-dark"></i></a> </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo base_url('assets/custom/images/asistencia-medica.svg'); ?>" alt="user" class="profile-pic" /></a>
                            <div class="dropdown-menu dropdown-menu-right scale-up">
                                <ul class="dropdown-user">
                                    <li>
                                        <div class="dw-user-box">
                                            <div class="u-img"><img src="<?php echo base_url('assets/custom/images/asistencia-medica.svg'); ?>" alt="user"></div>
                                            <div class="u-text">
                                                <h4></h4><?php echo $this->utils->name(); ?></h4>
                                                <p class="text-muted"></p>
                                                <!-- <a href="<?php //echo base_url("settings/firstSettings"); ?>" class="btn btn-rounded btn-danger btn-sm"><?php //echo $this->utils->user_type(); ?></a></div> -->
                                        </div>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="<?php echo base_url("settings/firstSettings"); ?>"><i class="ti-user"></i> ข้อมูลส่วนตัว</a></li>
                                    <li><a href="<?php echo site_url('member/logout'); ?>"><i class="fa fa-power-off"></i> ออกจากระบบ</a></li>
                                </ul>
                            </div>
                        </li>
                      
                    </ul>
                </div>
            </nav>
        </header>
      
        
        <aside class="left-sidebar mt-3">
            <!-- Sidebar scroll-->
            
            <div class="scroll-sidebar dropdown-menu-right">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="one-column"><a class="has-arrow waves-effect waves-dark" href="<?php echo site_url('statistics'); ?>" aria-expanded="false"><i class="mdi mdi-chart-pie"></i><span class="hide-menu">ผลรวมสถิติ</span></a>
                        </li>

                        <li class="one-column"> <a class="has-arrow waves-effect waves-dark" href="<?php echo site_url('store'); ?>" aria-expanded="false"><i class="mdi mdi-store"></i><span class="hide-menu">ร้านค้าและสมาชิก</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo site_url('store/firstStore'); ?>">รายการร้านค้า</a></li>
                                <li><a href="<?php echo site_url('member/memberList'); ?>">รายการสมาชิก</a></li>
                                <li><a href="<?php echo site_url('store/recomStore'); ?>">รายการร้านค้าแนะนำ</a></li>
                                <li><a href="<?php echo site_url('itemstores'); ?>">รายการทางบัญชี</a></li>
                                <li><a href="<?php echo site_url('place'); ?>">สถานที่ส่งสินค้า</a></li>
                            </ul>
                        </li>
                    

                      
                        <li class="one-column"><a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-shopping"></i><span class="hide-menu">สินค้า</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo site_url('product'); ?>">รายการสินค้า</a></li>
                                <li><a href="<?php echo site_url('productset'); ?>">สินค้าตั้งแสดง</a></li>
                                <li><a href="<?php echo site_url('popular'); ?>">จัดการ Popular products</a></li>
                                <li><a href="<?php echo site_url('feature'); ?>">Featured</a></li>
                            </ul>
                        </li>

                        <li class="one-column"> <a class="has-arrow waves-effect waves-dark" href="<?php echo site_url('category'); ?>" aria-expanded="false"><i class="mdi mdi-format-list-bulleted"></i><span class="hide-menu">หมวดหมู่</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo site_url('category/store_category'); ?>">หมวดหมู่ร้านค้า</a></li>
                                <li><a href="<?php echo site_url('category/product_category'); ?>">หมวดหมู่สินค้า</a></li>
                                <li><a href="<?php echo site_url('category/product_subcategory'); ?>">หมวดหมู่ย่อยสินค้า</a></li>
                            </ul>
                        </li>

                        <li class="one-column"> <a class="has-arrow waves-effect waves-dark" href="<?php echo site_url('promotion'); ?>" aria-expanded="false"><i class="mdi mdi-crown"></i><span class="hide-menu">โปรโมชั่น</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo site_url('promotions/firstPromotions'); ?>">โปรโมชั่นร่วม</a></li>
                                <li><a href="<?php echo site_url('promotions/promo_website/firstPromoWebsite'); ?>">รวมโปรโมชั่น</a></li>
                                <li><a href="<?php echo site_url('promotions/promo_request/firstPromoRequest'); ?>">คำขอเข้าร่วมโปรโมชั่น</a></li>
                            </ul>
                        </li>

                        <li class="one-column"> <a class="has-arrow waves-effect waves-dark" href="<?php echo site_url('order'); ?>" aria-expanded="false"><i class="mdi mdi-cart-outline"></i><span class="hide-menu">รายการคำสั่งซื้อ</span></a>
                        </li>

                        <li class="one-column"><a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-star"></i><span class="hide-menu">รีวิว</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo site_url('review'); ?>">รีวิวทั้งหมด</a></li>
                                <li><a href="<?php echo site_url('review/1'); ?>">รีวิวร้านค้า</a></li>
                                <li><a href="<?php echo site_url('review/2'); ?>">รีวิวผู้ส่ง</a></li>
                                <li><a href="<?php echo site_url('review/3'); ?>">รีวิวสินค้า</a></li>
                            </ul>
                        </li>
                        <li class="one-column"><a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-coin"></i><span class="hide-menu">เหรียญ</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo site_url('topup'); ?>">เติมเงิน</a></li>
                                <li><a href="<?php echo site_url('topup/account_topup'); ?>">บัญชีเหรียญ</a></li>
                            </ul>
                        </li>

                        <li class="one-column"> <a class="has-arrow waves-effect waves-dark" href="<?php echo site_url('inboxs'); ?>" aria-expanded="false"><i class="mdi mdi-facebook-messenger"></i><span class="hide-menu">Inbox</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo site_url('inboxs'); ?>">Inbox</a></li>
                                <li><a href="<?php echo site_url('news/massage'); ?>">ส่งข่าวสาร</a></li>
                            </ul>
                        </li>
                        
                        <li class="one-column"> <a class="has-arrow waves-effect waves-dark" href="<?php echo site_url('news'); ?>" aria-expanded="false"><i class="mdi mdi-newspaper"></i><span class="hide-menu">บทความ</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo site_url('news/firstNews'); ?>">จัดการบทความ</a></li>
                                <li><a href="<?php echo site_url('news/firstNewsCategory'); ?>">จัดการหมวดหมู่บทความ</a></li>
                                <li><a href="<?php echo site_url('news/firstNewsTags'); ?>">จัดการแท็กบทความ</a></li>
                            </ul>
                        </li>
                        <li class="one-column"> <a class="has-arrow waves-effect waves-dark" href="<?php echo site_url('news'); ?>" aria-expanded="false"><i class="mdi mdi-help-circle-outline"></i><span class="hide-menu">ช่วยเหลือ</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo site_url('faq/faqBuyer'); ?>">บัญชีผู้ซื้อ</a></li>
                                <li><a href="<?php echo site_url('faq/faqSeller'); ?>">บัญชีร้านค้า</a></li>
                                <li><a href="<?php echo site_url('faq/faqCategory'); ?>">หมวดหมู่คำถามคำตอบ</a></li>
                            </ul>
                        </li>


                        
                        <li class="one-column"> <a class="has-arrow waves-effect waves-dark" href="<?php echo site_url('settings'); ?>" aria-expanded="false"><i class="mdi mdi-settings"></i><span class="hide-menu">ตั้งค่า</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo site_url('settings/firstSettings'); ?>">จัดการผู้ใช้งานระบบ</a></li>
                                <li><a href="<?php echo site_url('settings/permissionUser'); ?>">ประเภทผู้ใช้และการเข้าถึง</a></li>
                                <li><a href="<?php echo site_url('settings/settingsGeneralWeb'); ?>">ตั้งค่าทั่วไปเว็บไซต์</a></li>
                                <li><a href="<?php echo site_url('settings/bank'); ?>">จัดการรายชื่อธนาคาร</a></li>
                                <li><a href="<?php echo site_url('slidebanner'); ?>">Slide banner</a></li>
                            </ul>
                        </li>
                        
                    </ul>
                    
                </nav>
            </div>
            
        </aside>

        

      <!--สิ้นสุด Header-->