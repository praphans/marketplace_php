<script>
    var base_url = '<?php echo base_url(); ?>';
</script>
<script src="<?php echo base_url('assets/system/plugins/jquery/jquery.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/system/plugins/bootstrap/js/popper.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/system/plugins/bootstrap/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/system/js/jquery.slimscroll.js'); ?>"></script>
<script src="<?php echo base_url('assets/system/js/waves.js'); ?>"></script>
<script src="<?php echo base_url('assets/system/js/sidebarmenu.js'); ?>"></script>
<script src="<?php echo base_url('assets/system/plugins/sticky-kit-master/dist/sticky-kit.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/system//plugins/sparkline/jquery.sparkline.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/system/js/custom.min.js'); ?>"></script>

<script src="<?php echo base_url('assets/system/plugins/bootstrap-table/dist/bootstrap-table.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/system/plugins/bootstrap-table/dist/bootstrap-table.ints.js'); ?>"></script>
<script src="<?php echo base_url('assets/system/plugins/raphael/raphael-min.js'); ?>"></script>
<script src="<?php echo base_url('assets/system/plugins/morrisjs/morris.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/system/plugins/sparkline/jquery.sparkline.min.js'); ?>"></script>

<script src="<?php echo base_url('assets/system/plugins/styleswitcher/jQuery.style.switcher.js'); ?>"></script>
<!-- lightbox -->
<script src="<?php echo base_url('assets/system/dist/js/lightbox.min.js'); ?>"></script>

<!-- summernote -->
<script src="<?php echo base_url('assets/system/plugins/summernote/dist/summernote.min.js'); ?>"></script>

<!-- Sweet-Alert  -->
<script src="<?php echo base_url('assets/system/plugins/sweetalert/sweetalert.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/system/plugins/sweetalert/jquery.sweet-alert.custom.js'); ?>"></script>
    <!-- ============================================================== -->
<!-- Style switcher -->
<!-- ============================================================== -->

<!-- Theme files
    ============================================ -->
<script src="<?php echo base_url('assets/config.js'); ?>"></script>
<script src="<?php echo base_url('assets/system/plugins/styleswitcher/jQuery.style.switcher.js'); ?>"></script>
<script type="text/javascript">
  var S_amphures = '';//'<?php //if(isset($amphures)){//echo $amphures;} ?>';
  var S_districts = '';//'<?php //if(isset($districts)){//echo $districts;} ?>';
  

  var config = {};
  config.maxMb = 2;
  config.limitMb = (1024*1024)*config.maxMb;
  config.base_url = base_url;

	/* ============================================================== */
	/* START ฟังชั่น ALERT MESSAGE  */
    var error_title = "<?php if($this->session->flashdata('error_title') != "") echo $this->session->flashdata('error_title'); ?>";
    var error_message = "<?php if($this->session->flashdata('error_message') != "") echo $this->session->flashdata('error_message'); ?>";

    if(error_message != ""){
       Message(error_title,error_message);
    }
    /* END ฟังชั่น ALERT MESSAGE  */
   	/* ============================================================== */

   
</script>
