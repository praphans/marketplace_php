<?php $this->load->view("templates/header"); ?>

		<!-- - - - - - - - - - - - - - Page Wrapper - - - - - - - - - - - - - - - - -->
		
		<div class="secondary_page_wrapper">

			<div class="container">

				<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

				<ul class="breadcrumbs">

					<li><a href="<?php echo base_url(); ?>" class="notcursor">หน้าหลัก</a></li>
					<li>บัญชีร้านค้า</li>

				</ul>

				<!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->

				<div class="row">

					<main class="col-md-12">

						<section class="theme_box shop_before_register">

							<h4>ท่านยังไม่ได้สร้างบัญชีร้านค้ากับ marketplace.com ต้องการลงทะเบียน <a href="<?php echo base_url('store/register') ?>">เดี๋ยวนี้</a></h4>

						</section><!--/ .theme_box -->

					</main><!--/ [col]-->

				</div><!--/ .row-->

			</div><!--/ .container-->

		</div><!--/ .page_wrapper-->
			
		<!-- - - - - - - - - - - - - - End Page Wrapper - - - - - - - - - - - - - - - - -->
<?php $this->load->view("templates/footer"); ?>
<?php $this->load->assets('js'); ?>
