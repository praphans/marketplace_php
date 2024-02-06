<?php $this->load->view("templates/header"); ?>
<style>
.input-group {
position: relative;
display: -webkit-box;
display: -ms-flexbox;
display: flex;
-ms-flex-wrap: wrap;
flex-wrap: wrap;
-webkit-box-align: stretch;
-ms-flex-align: stretch;
align-items: stretch;
width: 100%;
}
.input-group-prepend {
margin-right: -1px;
}
.input-group-append, .input-group-prepend {
	display: -webkit-box;
	display: -ms-flexbox;
	display: flex;
}
.input-group>.form-control {
position: relative;
-webkit-box-flex: 1;
-ms-flex: 1 1 auto;
flex: 1 1 auto;
width: 1%;
margin-bottom: 0;
}
.input-group-text{
	display: -webkit-box;
display: -ms-flexbox;
display: flex;
-webkit-box-align: center;
-ms-flex-align: center;
align-items: center;
padding: .375rem .75rem;
margin-bottom: 0;
font-size: 14px;
font-weight: 400;
line-height: 1.5;
color: #495057;
text-align: center;
white-space: nowrap;
background-color: #e9ecef;
border: 1px solid #ced4da;
border-radius: .25rem;
}
</style>
	
	<div class="secondary_page_wrapper">
		<div class="container">
			<ul class="breadcrumbs">

				<li><a href="index.html" class="notcursor">หน้าหลัก</a></li>
				<li>ลงทะเบียนเปิดร้านค้า</li>

			</ul>
			<section class="section_offset">
				<form id="form_register" action="<?php echo base_url('store/createStore'); ?>" method="post">
				<h3>บัญชีร้านค้า</h3>

				<div class="theme_box"> 

					
						<ul>
							
							<li class="row">
								
								<div class="col-xs-12">

									<label for="company_name">ตั้งชื่อร้าน</label>
									<input type="text" name="store_name" id="store_name" placeholder="กรุณาระบุชื่อร้านของคุณ" value="">
								
								</div><!--/ [col] -->

							</li><!--/ .row -->

							<li class="row pt-10">
								
                                
                                

								<div class="col-xs-12">
									
									<label for="url_name">URL ร้านค้า</label>
                                    <div class="input-group">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon3"><?php echo base_url()?></span>
                                      </div>
                                      <input type="text" class="form-control"name="store_url" id="store_url" placeholder="กรุณาตั้งชื่อ URL ร้านของคุณ" aria-describedby="basic-addon3">
                                      
                                    </div>
                                
									

								</div><!--/ [col] -->

							</li><!--/ .row -->

							
						</ul>

					<div class=" pt-20">
                    <?php echo $this->load->get_var('store_url_description'); ?>
 					<!--<ul class="list_type_5">
                        <li>URL ที่กำหนดเองต้องมีตัวอักษรภาษาอังกฤษและตัวเลขรวมกัน 5 - 40 ตัว ห้ามไม่ให้เว้นวรรค ใช้สัญลักษณ์และอักขระพิเศษ</li>
                        <li>เราแนะนำให้ใช้ชื่อของตนเอง แสดงอัตลักษณ์ โดดเด่นและแตกต่างจากผู้อื่นอย่างชัดเจน เพื่อวัตถุประสงค์ทางการสื่อสาร การสร้างแบรนด์ และแสดงความเป็นมืออาชีพ เพราะคุณต้องใช้ URL นี้ในการโฆษณาและแบ่งปันกับบุคคลอื่น</li>
                        <li>URL ใช้ได้ทั้งตัวอักษรพิมพ์เล็กและใหญ่ หมายความว่าการใช้ Somsak หรือ SOMSAK หรือ somsak ยังคงชี้ไปที่อยู่ URL เดียวกัน</li>
						<li>URL ที่คุณตั้งใหม่ต้องไม่ซ้ำกับ URL ที่สงวนไว้ หรือมีผู้อื่นใช้อยู่แล้ว</li>
                        <li>เมื่อตั้ง URL สำเร็จ คุณสามารถเปลี่ยน URL ใหม่ได้เพียงครั้งเดียว หากต้องการเปลี่ยน URL ใหม่อีกครั้งต้องรอเวลาอีก 6 เดือน การเปลี่ยน URL หลายครั้งอาจทำให้ผู้อื่นเข้าใจผิดและค้นหาคุณไม่พบ</li>
                    </ul>-->
                    </div>
				</div>
				
                
				<footer class="bottom_box on_the_sides">

					

					<div class="col-md-offset-4 col-md-4 col-xs-12">
						<button type="submit" id="submit" class="btn-block button_blue middle_btn "><i class="icon-town-hall"></i> ลงทะเบียนเปิดบัญชีร้านค้า</button>

					</div>

				</footer>
				</form>
			</section><!--/ .section_offset -->

			<!-- - - - - - - - - - - - - - End of ข้อมูลร้านค้า - - - - - - - - - - - - - - - - -->

		</div><!--/ .container-->
	</div><!--/ .page_wrapper-->
			
<?php $this->load->view("templates/footer"); ?>


<script>
$("#form_register").validate({
	 rules: {
		store_name: {
			required: true
		},
		store_url: {
			required: true,
			lettersonly: true
		}
		
	 }
 });
</script>
