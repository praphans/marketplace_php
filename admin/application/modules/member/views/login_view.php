<!--เริ่มต้น Header-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('assets/system/images/favicon.png'); ?>">
    <title><?php echo $title; ?></title>

    <link href="<?php echo base_url('assets/system/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">

     <!--alerts CSS -->
    <link href="<?php echo base_url('assets/system/plugins/sweetalert/sweetalert.css'); ?>" rel="stylesheet" type="text/css">

    
    <link href="<?php echo base_url('assets/system/plugins/bootstrap-table/dist/bootstrap-table.min.css'); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/system/css/style.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/system/css/colors/blue.css'); ?>" id="theme" rel="stylesheet">
    <link href="<?php echo base_url('assets/custom/css/main.css'); ?>" id="theme" rel="stylesheet">

    <!--alerts CSS -->
    <link href="<?php echo base_url('assets/system/plugins/sweetalert/sweetalert.css'); ?>" rel="stylesheet" type="text/css">
    
</head>

<body class="fix-header card-no-border">

    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>

    <div id="main-wrapper">
        <div class="login-register" style="background-image:url('<?php echo base_url('assets/system/images/background/login-register.jpg');  ?>');">
        	
            <div class="login-box card">
            <div class="card-header">
                            <?php echo $default_title ?>
                          </div>
                <div class="card-body">
                    <?php
                        $attributes = array('name' => 'form','class' => 'form-horizontal form-material','method'=>'post','id'=>'loginform');
                        echo form_open('member/loginMember', $attributes);
                                
                    ?>
                        <h4 class="box-title m-b-20 text-center"><i class="fa fa-lock"></i> เข้าสู่ระบบสมาชิก</h4>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" name="username" required="true" placeholder="ชื่อผู้ใช้งาน"> </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" type="password" name="password" required="true" placeholder="รหัสผ่าน"> </div>
                        </div>

                        <!-- HTML ลืมรหัสผ่าน และ จดจำการเข้าระบบ
                        <div class="form-group row">
                            <div class="col-md-12 font-14">
                                <div class="checkbox checkbox-primary pull-left p-t-0">
                                    <input id="checkbox-signup" type="checkbox">
                                    <label for="checkbox-signup"> จดจำการเข้าระบบ </label>
                                </div> 
                                <a href="javascript:void(0)" id="to-recover" class="text-dark pull-right">ลืมรหัสผ่าน ?</a> </div>
                        </div> -->

                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button class="btn btn-info btn-block text-uppercase waves-effect waves-light" type="submit">เข้าสู่ระบบ</button>
                            </div>
                        </div>
                        <div class="form-group m-b-0">
                            <div class="col-sm-12 text-center">
                                <div><?php echo $copyright ?></div>
                            </div>
                        </div>
                    </form>

                    <!-- ฟังก์ชั่น ลืมรหัสผ่าน ไม่ได้ใช้
                    <form class="form-horizontal" id="recoverform" action="index.html">
                        <div class="form-group">
                            <div class="col-xs-12">
                                <h3>กู้คืนรหัสผ่าน</h3>
                                <p class="text-muted">กรุณาระบุอีเมลของท่าน เพื่อรับการกู้คืนรหัสผ่าน ! </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" required="" placeholder="อีเมล"> </div>
                        </div>
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">ขอรหัสผ่านใหม่</button>
                            </div>
                        </div>
                    </form> -->

                </div>
            </div>
        </div> 
    </div>
   
    <script src="<?php echo base_url('assets/system/plugins/jquery/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/system/plugins/bootstrap/js/popper.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/system/plugins/bootstrap/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/system/js/jquery.slimscroll.js'); ?>"></script>
    <script src="<?php echo base_url('assets/system/js/waves.js'); ?>"></script>
    <script src="<?php echo base_url('assets/system/js/sidebarmenu.js'); ?>"></script>
    <script src="<?php echo base_url('assets/system/plugins/sticky-kit-master/dist/sticky-kit.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/system/plugins/sparkline/jquery.sparkline.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/system/js/custom.min.js'); ?>"></script>
    <!-- Sweet-Alert  --> 
    <script src="<?php echo base_url('assets/system/plugins/sweetalert/sweetalert.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/system/plugins/sweetalert/jquery.sweet-alert.custom.js'); ?>"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="<?php echo base_url('assets/system/plugins/styleswitcher/jQuery.style.switcher.js'); ?>"></script>

    <script type="text/javascript">
        var error_title = "<?php if($this->session->flashdata('error_title') != "") echo $this->session->flashdata('error_title'); ?>";
        var error_message = "<?php if($this->session->flashdata('error_message') != "") echo $this->session->flashdata('error_message'); ?>";

        if(error_message != ""){
           Message(error_title,error_message);
        }
    </script>

</body>
</html>