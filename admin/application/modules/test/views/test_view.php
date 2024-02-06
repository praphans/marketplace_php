<?php $this->load->view("templates/header"); ?>
  
 <div class="page-wrapper mt-main-wrapper-70">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12">
					<div class="row">
						<div class="col-lg-12 ">
							<div class="card">
								<div class="card-body w-100">
									<?php
										$array=array('2','4','8','5','1','7','6','9','10','3');

										echo "ค่าที่รับมา : ";
										$ex_arr = implode(" | ",$array);
										echo $ex_arr;


										for($j = 0; $j < count($array); $j ++) {
										    for($i = 0; $i < count($array)-1; $i ++){

										        if($array[$i] > $array[$i+1]) {
										            $temp = $array[$i+1];
										            $array[$i+1]=$array[$i];
										            $array[$i]=$temp;
										        }      
										    }
										}

										echo "<br />";
										echo "<br />";
										echo "ค่าที่ได้ : ";
										$n_arr = implode(" | ",$array);
										echo $n_arr;



									;



									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<footer class="footer"> </footer>
	</div>
</div>



<?php $this->load->view("templates/footer"); ?>
<script src="<?php echo base_url("assets/system/plugins/datatables/jquery.dataTables.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/system/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/custom/js/locales/bootstrap-datepicker.th.js"); ?>"></script>



