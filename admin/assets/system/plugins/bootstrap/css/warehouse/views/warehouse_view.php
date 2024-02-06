<?php $this->load->view("templates/header"); ?>
  <!-- สิ้นสุด Header-->
   <div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
      <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">จัดการคลังสินค้า</h3>
      </div>
      <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="javascript:void(0)">คลังสินค้า</a></li>
          <li class="breadcrumb-item">จัดการคลังสินค้า</li>
        </ol>
      </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
      <!-- ============================================================== -->
      <!-- Start Page Content -->
      <!-- ============================================================== -->
      <!-- Row -->
      <div class="row">

        <!-- Column -->
        <div class="col-lg-12 col-xlg-12 col-md-12">
          <div class="p-l-20 p-r-20">
          	
            <div class="row">
              <div class="col-lg-12 col-xlg-12 col-md-12 mt-3">
                <div class="card">
                  <div class="card-body">

		            <div class="row padding-mps">
		              <div class="col-lg-9 col-xlg-9 col-md-8 mt-3">
		                <div class="input-group">
		                  <input type="text" id="search_table" class="form-control" placeholder=" ใส่ข้อมูลคลังที่ต้องการค้นหา">
		                  <div class="input-group-append">
		                    <button class="btn btn-info" type="button">ค้นหา</button>
		                  </div>
		                </div>
		              </div>
		              <!----------------- Modals เพิ่มคลังเก็บสินค้า ------------------>
		              <div class="col-lg-3 col-xlg-3 col-md-4 mt-3">
		                <ul class="list-style-none">
		                    <li class="box-label">
		                      <button  href="javascript:void(0)" data-toggle="modal" data-target="#myModalAddStock" class="btn btn-success waves-effect waves-light btn-block d-flex justify-content-between" type="button"><span class="btn-label"><i class="fa fa-plus"></i></span>เพิ่มคลังเก็บสินค้า<a></a></button>
		                    </li>
		                </ul>  
		              </div>
		            </div>
		            <!-----------------End Modals เพิ่มคลังเก็บสินค้า ------------------>

                    <div class="table-responsive m-t-3">

                      <div id="myTable_wrapper" class="dataTables_wrapper no-footer p-l-20 p-r-20">
                        <table id="warehouse_datatable" class="table table-bordered table-striped dataTable nowrap" role="grid" aria-describedby="myTable_info"><thead>
                            <tr role="row" class="">
                              <th width="12%" class="" tabindex="0" aria-controls="myTable" rowspan="1" colspan="1">ชื่อคลัง</th>
                              <th width="12%" class="" tabindex="0" aria-controls="myTable" rowspan="1" colspan="1">ประเภทคลัง</th>
                              <th width="8%" class="" tabindex="0" aria-controls="myTable" rowspan="1" colspan="1">คลังเริ่มต้น</th>
                              <th width="" class="" tabindex="0" aria-controls="myTable" rowspan="1" colspan="1">รายละเอียด</th>
                              <th width=""class="" tabindex="0" aria-controls="myTable" rowspan="1" colspan="1">ตำแหน่ง</th>
                              <th width="15%" class="" tabindex="0" aria-controls="myTable" rowspan="1" colspan="1">ตัวเลือก</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
								$CI =& get_instance();
								
								foreach($warehouse_list as $row){
									$id = $row->id;
									$warehouse = $row->warehouse;
									$warehouse_type_id = $row->warehouse_type_id;
									$default_warehouse = $row->default_warehouse;
									
									$type_list = $CI->model_warehouse->getWarehouseTypeByID($warehouse_type_id);
									$type = $type_list[0]->type;
									
							?>
                            
                            <tr role="row" class="odd">
                              <td><?php echo $warehouse; ?></td>
                              <td><?php echo $type; ?></td>
                              <td> 
                                 <input type="checkbox" id="basic_checkbox_<?php echo $id; ?>" class="filled-in chk-col-light-green" <?php if($default_warehouse){ echo 'checked'; } ?> disabled="disabled">
                                 <label for="basic_checkbox_<?php echo $id; ?>" class="chk-mps"></label>
                              </td>
                              <td></td>
                              <td></td>
                              <td>                  
	                            <div class="row">
	                                <div class="col-md-12 col-lg-6 pr-lg-1 pb-1">
	                                    <div class="box-label">
	                                        <a onClick="edit(<?php echo $id; ?>);"  data-toggle="modal" data-target="#myModalEditStock" class="btn  btn-sm btn-warning fa fa-pencil text-light btn-block font-size-btn"> แก้ไข</a>
	                                    </div>
	                                </div>

	                                <div class="col-md-12 col-lg-6 pl-lg-1">
	                                    <div class="box-label">
	                                        <a onClick="del(<?php echo $id; ?>,<?php echo $default_warehouse; ?>);" class="btn  btn-sm btn-danger fa fa-close text-light btn-block font-size-btn"> ลบ</a>
	                                    </div>
	                                </div>
	                            </div><!-- row -->                               	
                              </td>
                            </tr>
                           <?php
								}
						   ?>
                            
                          </tbody>
                        </table>
                        
                        
                        
                    </div>
                  </div><!-- card-body -->
                </div><!-- card -->
              </div>
            </div><!-- row -->
          </div>
        </div>
      </div>
    </div>
    <footer class="footer"> <?php echo $this->setting->getFooterTitle() ?> </footer>
  </div>
  
  <?php $this->load->view("modals/warehouse_edit_view"); ?>
  <?php $this->load->view("modals/warehouse_add_view"); ?>
  <!--สิ้นสุด page-wrapper-->
  <!--เริ่มต้น Footer-->
 
  <?php $this->load->view("templates/footer"); ?>
   <script src="<?php echo base_url("assets/system/plugins/datatables/jquery.dataTables.min.js"); ?>"></script>
   <script>
  	var warehouse_table = $('#warehouse_datatable').DataTable({
		"dom": 'tpi',
		"columns": [
				{"width": "20%" },
				{"width": "20%" },
				{"width": "10%" },
				{"width": "10%" },
				{"width": "10%" },
				{"width": "15%" }
		 ]

	});
	$('#search_table').on('keyup change', function () {
    	warehouse_table.search(this.value).draw();
	});
	
	
	function del(id,default_warehouse){
		if(default_warehouse){
			swal({   
				title: "ข้อความจากระบบ ?",   
				text: "ไม่สามารถลบคลังเริ่มต้นได้",   
				type: "warning",   
				confirmButtonColor: "#DD6B55",   
				confirmButtonText: "รับทราบ",   
				closeOnConfirm: true 
			}, function(){   
				
			});
		}else{
			swal({   
				title: "กรุณาตรวจสอบ ?",   
				text: "ท่านแน่ใจหรือว่าต้องการลบข้อมูล ! \nอาจยังมีสินค้าที่ยังใช้งานอยู่คงเหลือในคลัง",   
				type: "warning",   
				showCancelButton: true, 
				cancelButtonText: "ยกเลิก",
				confirmButtonColor: "#DD6B55",   
				confirmButtonText: "ไช่, ต้องการลบ !",   
				closeOnConfirm: true 
			}, function(){   
				window.location = Config.base_url+"warehouse/del/"+id;
			});
		}
	}
	function edit(id){
		var modalEdit = $('#myModalEditStock');
		modalEdit.modal('show');
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url('warehouse/api/warehouse_api/geteditbyid'); ?>',
			data: {'id':id},
			success: function(json){
				var json = JSON.parse(json);
				console.log(json);
				var warehouse = json[0].warehouse;
				var warehouse_detail = json[0].warehouse_detail;
				var warehouse_type_id = json[0].warehouse_type_id;
				var warehouse_location = json[0].warehouse_location;
				var default_warehouse = json[0].default_warehouse;
				
				$("#warehouse_id").val(id);
				$("#warehouse").val(warehouse);
				$("#warehouse_detail").val(warehouse_detail);
				$("#warehouse_type_id").val(warehouse_type_id);
				$("#warehouse_location").val(warehouse_location);
				$("#basic_checkbox_default_warehouse").prop("checked", parseInt(default_warehouse));
			}
		});
	}
	
  </script>
