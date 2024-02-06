<?php $this->load->view("templates/header"); ?>
<body>
    <div class="container" style="margin-top:50px;">
        <div class="card">
            <div class="col-md-12">
                <div class="card-body">
                    <h5 class="card-title">รายการติดตั้ง Modules </h5>
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
                                
                                Modules::run($modules_name.'/'.$modules_name.'/index');
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
</body>
<?php $this->load->view("templates/footer"); ?>
