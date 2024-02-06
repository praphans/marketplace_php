<!-- ============================================================== -->
<!----------------- Modals เพิ่มประเภทร้านค้าและบริการ ------------------>
<!-- ============================================================== -->  

<div id="myModalViewHistory" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
<div class="modal-dialog modal-xs">
      <div class="modal-content">
          <div class="modal-header bg-header-modals">
              <h4 class="modal-title text-light" id="myModalLabel2">ประวัติการเปลี่ยนสถานะ</h4>
              <button type="button" class="close text-white" data-dismiss="modal" aria-hidden="true">×</button>
          </div>
          <!-- from modal  -->
          <div class="modal-body">
              <div class="row p-l-20 p-r-10">
                  <div class="col-md-12 col-lg-12 p-t-10 p-b-10 pl-0">
                      <div class="row">
                        <div class="table-responsive pr-3 pl-3">
                            <div id="myTable_wrapper" class="dataTables_wrapper no-footer">
                              <table id="history_datatable" class="table table-bordered table-striped nowrap w-100">
                                  <thead>
                                      <tr>
                                          <th>วันที่</th>
                                          <th>สถานะ</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                          <!--โหลดข้อมูล-->
                                  </tbody>
                                </table>
                            </div><!-- myTable_wrapper -->
                          </div><!-- table-responsive -->   
                          
                      </div>
                  </div>
              </div>
                      
             
          </div>
          <!-- close from modal  -->

          <div class="modal-footer d-flex justify-content-center">
              <div class="row w-100">
                  <div class="col-sm-12 col-md-4 button-group text-center btn-footer">
                       <!-- contant -->
                  </div>

                  <div class="col-sm-12 col-md-4 button-group text-center btn-footer">
                      <button type="button" class="btn btn-default waves-effect btn-block" data-dismiss="modal">ปิด</button>
                  </div>          
              </div>
          </div>

      </div>
      <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
  </div>

<!-- ============================================================== -->
<!--------------- End Modals เพิ่มประเภทสินค้าและบริการ ---------------->
<!-- ============================================================== --> 

<script>
  startDatatableHistory();
  loadHistory("<?php echo $order_id ?>");
</script>