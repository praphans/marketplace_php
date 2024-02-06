<?php $this->load->view("templates/header"); ?>

			<!-- - - - - - - - - - - - - - Page Wrapper - - - - - - - - - - - - - - - - -->
<div class="secondary_page_wrapper">

			<div class="container">

				<!-- - - - - - - - - - - - - - Breadcrumbs - - - - - - - - - - - - - - - - -->

				<ul class="breadcrumbs">

					<li><a href="<?php echo base_url(); ?>">หน้าหลัก</a></li>
					<li><a href="<?php echo base_url("news"); ?>">บทความ</a></li>
					<li><?php echo $tag_name_directory; ?></li>

				</ul>

				<!-- - - - - - - - - - - - - - End of breadcrumbs - - - - - - - - - - - - - - - - -->

				<div class="row">

					<aside class="col-md-3 col-sm-4">

						<!-- - - - - - - - - - - - - - Information - - - - - - - - - - - - - - - - -->

						<section class="section_offset">

							<ul class="theme_menu">
                            	<li><a href="<?php echo base_url("news"); ?>">รวมทุกหมวดหมู่</a></li>
								<?php
								foreach($category as $row){
									$id = $row->id;
									$category_name = $row->category_name;
									$category_name_url = $this->utils->urlClean($category_name);
								?>
								
								<li><a href="<?php echo base_url("news/".$id."/".$category_name_url); ?>"><?php echo $category_name; ?></a></li>
								
                                <?php } ?>
							</ul>

						</section>
						<!--/ .section_offset -->
						<section class="section_offset">

							<h4>Tag แนะนำ</h4>

							<div class="tags_container">

								<ul class="tags_cloud">

									<?php
									foreach($tags as $row){
										$tag_id = $row->tag_id;
										$tag_name = $row->tag_name;
										
									?>
									
									<li><a href="<?php echo base_url('news/tags/'.$tag_id.'/'.$tag_name); ?>" class="button_grey"><?php echo $tag_name; ?></a></li>
									
									<?php } ?>
                                
									


								</ul>
								<!--/ .tags_cloud-->

							</div>
							<!--/ .tags_container-->

						</section>
						<!-- - - - - - - - - - - - - - End of information - - - - - - - - - - - - - - - - -->

					</aside>
					<!--/ [col]-->

					<main class="col-md-9 col-sm-8">

						<!-- - - - - - - - - - - - - - List of entries - - - - - - - - - - - - - - - - -->

						<ul id="main_blog_list" class="list_of_entries grid_view">
                        	<?php
								foreach($news as $row){
									$new_id = $row->new_id;
									$new_cate_id = $row->new_cate_id;
									$new_header = $row->new_header;
									$new_content = $row->new_content;
									$new_image = $row->new_image;
									$timestamp = $row->timestamp;
									
									$new_header_url = $this->utils->urlClean($new_header);
									$new_content = strip_tags($new_content);
									$new_content = $this->utils->string_shorten($new_content,100,100);
								?>

							<li>

								<!-- - - - - - - - - - - - - - Entry - - - - - - - - - - - - - - - - -->
								
                                
								<div>
									<article class="entry">

										<a href="<?php echo base_url("news/info/".$new_id."/".$new_header_url); ?>" class="thumbnail entry_image">

											<img src="<?php echo base_url($new_image); ?>" alt="<?php echo $new_header; ?>">

										</a>

										<h5 class="entry_title"><a href="<?php echo base_url("news/info/".$new_id."/".$new_header_url); ?>"><b><?php echo $new_header; ?></b></a></h5>

										<div class="entry_meta">

											<span><i class="icon-calendar"></i> <?php echo $this->utils->getThaiDate($timestamp); ?></span>

										</div>
										
										<!--<p><?php echo $new_content; ?></p>-->

									</article>
									<!--/ .entry-->
								</div>
                                
								
								<!-- - - - - - - - - - - - - - End of entry - - - - - - - - - - - - - - - - -->

							</li>
							<?php } ?>
							

						</ul>

						<!-- - - - - - - - - - - - - - End of list of entries - - - - - - - - - - - - - - - - -->

						<footer class="bottom_box on_the_sides">
							<div class="row">
								<div class="col-md-12 col-md-offset-3 col-sm-12 col-sm-offset-1">
									

                                    <div class="right_side">
                                        <?php echo $pagination ?>  
                                        
                                    </div>
    
								</div>

							</div>
						</footer>


					</main>

				</div>
				<!--/ .row-->

			</div>
			<!--/ .container-->

		</div>
		<!--/ .page_wrapper-->
			
			<!-- - - - - - - - - - - - - - End Page Wrapper - - - - - - - - - - - - - - - - -->
<?php $this->load->view("templates/footer"); ?>
<?php $this->load->assets_by_name('News'); ?>
