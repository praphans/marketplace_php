
<div id="myModalItemStoresInfo" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
  <div class="modal-dialog modal-xlg">
      <div class="modal-content">
          <div class="modal-header bg-header-modals">
              <h4 class="modal-title text-light" id="myModalLabel2">รายละเอียด</h4>
              <button type="button" class="close text-white" data-dismiss="modal" aria-hidden="true">×</button>
          </div>

          <!-- from modal  -->
          <div class="modal-body">
                  <div class="row p-l-20 p-r-10">

                      <div class="col-md-12 col-lg-12 p-t-10 p-b-10 pl-0">
                        <?php
                        
                          $amount_total = 0;
                          foreach($orders as $row){
                            $amount_total = $row->amount_total;
                          }
                        ?>
                          <div class="row">
                              <div class="col-sm-12 col-md-12 col-lg-12 pr-0">
                                  <label class="">ยอดคงเหลือสุทธิ : <?php echo number_format($amount_total,2); ?> บาท</label>
                              </div>
                          </div>
                         <!--  <div class="row">
                            <div class="col-sm-12 col-md-7 col-lg-9 pt-2">
                                <input type="text" name="setting_account" class="form-control val_setting_account">
                            </div>
                            <div class="col-sm-12 col-md-5 col-lg-3 pt-2">
                                <a href="javascript:void(0)" class="btn btn-warning btn-block text-white mdi mdi-pencil" onclick="setttingAccount();"> ปรับปรุงรายการทางบัญชี</a>
                            </div>
                          </div> -->
                      </div>
                      <div class="col-md-12 col-lg-12 p-b-10 pl-0">
                        <div class="table-responsive">
                          <div id="myTable_wrapper" class="dataTables_wrapper no-footer">
                            <table id="itemstores_info_datatable" class="table table-bordered table-striped nowrap w-100">
                              <thead>
                                <tr>
                                  <th>วันที่ เวลา</th>
                                  <th>รหัสคำสั่งซื้อ</th>
                                  <th>รายการ</th>
                                  <th>จำนวนเงิน</th>
                                  <!-- <th>xxx</th> -->
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
          <!-- close from modal  -->

      </div>
      <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
  </div>
<script>
  startDatatableInfo();
</script>