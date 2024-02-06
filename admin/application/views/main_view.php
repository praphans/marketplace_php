<!--เริ่มต้น Header-->
<?php $this->load->view('templates/header'); ?>
<!-- สิ้นสุด Header-->
    <div class="page-wrapper">
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <!-- Row -->
            <div class="row">
                <!-- Column -->
                <div class="col-lg-12 col-xlg-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                      		<h2>รายการติดตั้ง Modules </h2>
                              <table class="table table-hover">
                              <thead>
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Modules</th>
                                  <th scope="col">URL</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                    				for($i = 0;$i<count($modulesList);$i++){
                    					$modules_name = $modulesList[$i];
                    					$modules_url = base_url("/".$modules_name);
                    					
                    					//Modules::run($modules_name.'/'.$modules_name.'/index');
                    			?>
                                <tr>
                                  <th><?php echo ($i+1); ?></th>
                                  <td><?php echo $modules_name; ?></td>
                                  <td><a href="<?php echo $modules_url; ?>" target="_blank"><?php echo $modules_url; ?></a></td>
                                </tr>
                    			
                    			<?php
                    				}
                    			?>
                              </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </div>
    <!--สิ้นสุด main-wrapper-->
    
    <!--เริ่มต้น footer -->
    <?php $this->load->view('templates/footer'); ?>
    <!--สิ้นสุด footer -->
</body>
</html>
<!--สิ้นสุด Footer-->
