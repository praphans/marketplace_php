
<footer id="footer">
  <hr>
  <!-- - - - - - - - - - - - - - Footer section - - - - - - - - - - - - - - - - -->
  <div class="footer_section_3 align_center">
    <div class="container">
      <p class="footer_message"><?php echo $this->load->get_var('footer_description'); ?></p>
      <!-- - - - - - - - - - - - - - Payments - - - - - - - - - - - - - - - - -->
      <ul class="payments">
        <li> <a href="<?php echo $this->load->get_var('facebook_url'); ?>" target="_blank" class="icon_btn middle_btn social_facebook tooltip_container"><i class="icon-facebook-1"></i><span class="tooltip top">Facebook</span></a> </li>
        <li> <a href="<?php echo $this->load->get_var('twitter_url'); ?>" target="_blank" class="icon_btn middle_btn social_twitter tooltip_container"><i class="icon-twitter"></i><span class="tooltip top">Twitter</span></a> </li>
       
        <li> <a href="<?php echo $this->load->get_var('youtube_url'); ?>" target="_blank" class="icon_btn middle_btn social_youtube tooltip_container"><i class="icon-youtube"></i><span class="tooltip top">Youtube</span></a> </li>
       
        <li> <a href="<?php echo $this->load->get_var('instagram_url'); ?>" target="_blank" class="icon_btn middle_btn social_instagram tooltip_container"><i class="icon-instagram-4"></i><span class="tooltip top">Instagram</span></a> </li>
       
      </ul>
      <!-- - - - - - - - - - - - - - End of payments - - - - - - - - - - - - - - - - -->
      <!-- - - - - - - - - - - - - - Footer category navigation - - - - - - - - - - - - - - - - -->
      <nav class="footer_nav"> 
        <ul class="bottombar">
          <?php
		 
		  $categorys = $this->model_main->getStoreCategory();
		  foreach($categorys as $row){
			  $id = $row->id;
			  $category_name = $row->category_name;
			  $category_link = base_url("shop/category/".$id."/".$category_name);
			  $category_link = str_replace(" ","-",$category_link);
		  ?>
          <li><a href="<?php echo $category_link; ?>"><?php echo $category_name; ?></a></li>
          <?php } ?>
        </ul>
      </nav>
      <!-- - - - - - - - - - - - - - End of footer category navigation - - - - - - - - - - - - - - - - -->
      <!-- - - - - - - - - - - - - - Footer navigation - - - - - - - - - - - - - - - - -->
      <nav class="footer_nav">
        <ul class="bottombar">
          <li><a href="<?php echo base_url(); ?>">หน้าแรก</a></li>
          <li><a href="<?php echo base_url("shop"); ?>">รวมร้านค้า</a></li>
          <li><a href="<?php echo base_url("news"); ?>">บทความ</a></li>
          <li><a href="<?php echo base_url("faq"); ?>">ช่วยเหลือ</a></li>
          <li><a href="<?php echo base_url("message/create/4"); ?>">ร้องเรียน</a></li>
          <li><a href="<?php echo base_url("condition"); ?>">เงื่อนไข &amp; ข้อกำหนด</a></li>
          <li><a href="<?php echo base_url("contact"); ?>">ติดต่อเรา</a></li>
        </ul>
      </nav>
      <!-- - - - - - - - - - - - - - End of footer navigation - - - - - - - - - - - - - - - - -->
      <p class="copyright"><?php echo $this->load->get_var('copyright'); ?></p>
    </div>
    <!--/ .container-->
  </div>
  <!--/ .footer_section-->
  <!-- - - - - - - - - - - - - - End footer section - - - - - - - - - - - - - - - - -->
</footer>
<!-- - - - - - - - - - - - - - End Footer - - - - - - - - - - - - - - - - -->
</div>
<!--/ [layout]-->
<!-- - - - - - - - - - - - - - End Main Wrapper - - - - - - - - - - - - - - - - -->
<!-- Include Libs & Plugins
		============================================ -->
<script>
    var base_url = '<?php echo base_url(); ?>';
</script>
<script src="<?php echo base_url('assets/js/jquery-2.1.1.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.validate.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/queryloader2.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.elevateZoom-3.0.8.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/fancybox/source/jquery.fancybox.pack.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/fancybox/source/helpers/jquery.fancybox-media.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/fancybox/source/helpers/jquery.fancybox-thumbs.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.appear.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.countdown.plugin.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.countdown.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.countdown-th.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/owlcarousel/owl.carousel.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/twitter/jquery.tweet.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/arcticmodal/jquery.arcticmodal.js'); ?>"></script>

<script src="<?php echo base_url('assets/js/theme.plugins.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/theme.core.js'); ?>"></script>


<script src="<?php echo base_url("assets/js/jssor.slider-27.5.0.min.js"); ?>" type="text/javascript"></script>
<script src="<?php echo base_url("assets/js/sweetalert/sweetalert.min.js");?>"></script>
<script src="<?php echo base_url("assets/js/bootstrap.min.js");?>"></script>
<script src="<?php echo base_url('assets/js/jquery.toast.min.js'); ?>"></script>

<!-- Theme files
		============================================ -->
<script src="<?php echo base_url('assets/config.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/utils.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url("assets/js/AddToCart.js"); ?>"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/iScroll/5.2.0/iscroll.min.js"></script>
<script src="<?php echo base_url('assets/js/drawer.js'); ?>"></script>

<script type="text/javascript">
var config = {};
config.base_url = base_url;
config.controller = "";




$(function() {
  // whenever we hover over a menu item that has a submenu
  $('#menuwrapper ul').children('li').on('mouseover', function() {
    var $menuItem = $(this),
        $submenuWrapper = $('> ul', $menuItem);
    
    console.log($menuItem, $submenuWrapper);
    
    // grab the menu item's position relative to its positioned parent
    var menuItemPos = $menuItem.position();
    
    // place the submenu in the correct position relevant to the menu item
    $submenuWrapper.css({
      top: menuItemPos.top,
      left: menuItemPos.left + Math.round($menuItem.outerWidth())
    });
  });
});


config.controller = "<?php echo $this->router->fetch_class(); ?>";
window.fbAsyncInit = function() {
	FB.init({
	  appId      : '280277022629911',
	  cookie     : true,
	  xfbml      : true,
	  version    : 'v3.2'
	});
  };

(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = "https://connect.facebook.net/th_TH/sdk.js";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));


function FBlogin(){
  FB.login(function(response) {
		if (response.authResponse) {
			var userID = response.authResponse.userID;
			FB.api('/me', {locale: 'en_US', fields: 'name,last_name,first_name, email' },
				function(response) {
					
					var user = {
						"facebook_user_id":userID,
						"first_name":response.first_name,
						"last_name":response.last_name,
						"email":response.email,
					}
					$.ajax({
						type: 'POST',
						url: config.base_url+'member/saveUser',
						data: user,
						success: function(json){
							console.log(json);
							var json = JSON.parse(json);
							
							if(json.success){
								var redirect_url = json.redirect_url;
								if(!json.redirect_url){
									redirect_url = "user";
								}else{
									redirect_url = json.redirect_url;	
								}
								window.location	= config.base_url+redirect_url;
							}
						}
					});
			});
			
		} else {
			console.log('User cancelled login or did not fully authorize.');
		}
  }, {scope: 'email'});
  
  
}

jQuery.extend(jQuery.validator.messages, {
	required: "ต้องระบุข้อมูล",
	remote: "โปรดแก้ไขข้อมูล",
	email: "กรุณาใส่อีเมล์ที่ถูกต้อง",
	url: "โปรดป้อน URL ที่ถูกต้อง",
	date: "โปรดป้อนวันที่ที่ถูกต้อง",
	dateISO: "โปรดป้อนวันที่ที่ถูกต้อง",
	number: "กรุณาใส่หมายเลขที่ถูกต้อง",
	digits: "กรุณาใส่ตัวเลขเท่านั้น",
	creditcard: "โปรดป้อนหมายเลขบัตรเครดิตที่ถูกต้อง",
	equalTo: "โปรดป้อนค่าเดิมอีกครั้ง",
	accept: "โปรดป้อนค่าพร้อมส่วนขยายที่ถูกต้อง",
	maxlength: jQuery.validator.format("กรุณากรอกไม่เกิน {0} ตัวอักษร."),
	minlength: jQuery.validator.format("กรุณากรอกอย่างน้อย {0} ตัวอักษร."),
	rangelength: jQuery.validator.format("กรุณาใส่ค่าระหว่าง {0} และ {1} อักขระ."),
	range: jQuery.validator.format("กรุณาใส่ค่าระหว่าง {0} และ {1}."),
	max: jQuery.validator.format("โปรดป้อนค่าน้อยกว่าหรือเท่ากับ {0}."),
	min: jQuery.validator.format("โปรดป้อนค่าที่มากกว่าหรือเท่ากับ {0}.")
});
jQuery.validator.addMethod("lettersonly", function(value, element) {

  return this.optional(element) || /^[_a-z0-9]+$/gi.test(value);
}, "กรุณาระบุเป็นภาษาอังกฤษเท่านั้น"); 

$.validator.setDefaults({ 
      ignore: []
});

var error_title = "ข้อความจากระบบ";
var error_message = "<?php if($this->session->flashdata('error_msg') != "") echo $this->session->flashdata('error_msg'); ?>";
if(error_message != ""){
	swal(error_title,error_message);
}

$(document).ready(function() {
  var star_rating_width = $('.fill-ratings span').width();
  $('.star-ratings').width(star_rating_width);
  $('.drawer').drawer();
  
  $(".tb_toggle_menu").click(function(){
	console.log("toggle");
	$('.drawer').drawer('toggle');					
   });
    
});

$("#main_province,#main_province_mobile").change(function(){
	var amphur_id = $(this).val();
	window.location = config.base_url+"product?amphur="+amphur_id;								
});
 
function googleTranslateElementInit() {
  new google.translate.TranslateElement({
		pageLanguage: 'th',
		layout: google.translate.TranslateElement.InlineLayout.SIMPLE
	}, 'google_translate_element');
}

function changeGoogleStyles() {
	if($('.goog-te-menu-frame').contents().find('.goog-te-menu2').length) {
		$('.goog-te-menu-frame').contents().find('.goog-te-menu2').css({
			'max-width':'100%',
			'overflow-x':'auto',
			'box-sizing':'border-box',
			'height':'auto'
		});
	} else {
		setTimeout(changeGoogleStyles, 50);
	}
}
changeGoogleStyles();

function toggleSearchInput(){
	// $(".ssearch_on_mobile").slideToggle();									  
	$(".ssearch_on_mobile").show();									  
	$(".catagory_on_mobile").show();
	$(".home_on_mobile").hide();
	$(".logo-ko").hide();
	$(".logo-ko-login").hide();	
	$(".regis_on_mobile").hide();
	$(".account_on_mobile").hide();
	// $(".top-menu").removeClass("drawer-menu-item-userbar");		
	// $(".top-menu").addClass("drawer-menu-item-userbar-non");		
	
}

function toggleHome(){
	$(".home_on_mobile").show();	
	$(".logo-ko").show();	
	$(".catagory_on_mobile").hide();
	$(".ssearch_on_mobile").hide();
	$(".logo-ko-login").hide();	
	$(".regis_on_mobile").hide();
	$(".account_on_mobile").hide();	
	// $(".top-menu").addClass("drawer-menu-item-userbar");
	// $(".top-menu").removeClass("drawer-menu-item-userbar-non");	
							  
}
function toggleLogin(){
	$(".logo-ko-login").show();	
	$(".home_on_mobile").hide();	
	$(".logo-ko").hide();	
	$(".catagory_on_mobile").hide();
	$(".ssearch_on_mobile").hide();	
	$(".regis_on_mobile").show();
	$(".account_on_mobile").show();
	// $(".top-menu").removeClass("drawer-menu-item-userbar");		
	// $(".top-menu").addClass("drawer-menu-item-userbar-non");
									  
}

</script>
        
<script>
window.onscroll = function() {myFunction()};

var navbar = document.getElementById("navbar");
var sticky = navbar.offsetTop;

function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}





</script>



<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</body></html>