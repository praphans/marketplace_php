<form class="type_2" action="<?php echo site_url("store/delivery/saveDeposit"); ?>" method="post">
<div id="modal_delivery" class="modal fade" role="dialog">
  <div class="modal-dialog ">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">แจ้งค่าบริการฝากส่ง</h4>
      </div>
      <div class="modal-body col-md-12">

                <div class="row">
                    <div class="col-md-12 p-t-10 col-sm-12">
                        <label for="postcode" class="required">ค่าบริการฝากส่ง  :</label>
                        <input type="number" class="form-control" name="depositor_cost" id="depositor_cost" placeholder="ระบุจำนวนเงินสำหรับการฝากส่งของที่ร้านของท่าน" required>
                    </div>
                </div>
              
		</div>
      <div class="modal-footer">
        <button type="button" onclick="saveDepositCost();" class="btn btn-success">แจ้งบริการฝากส่งถึงผู้ขาย</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
      </div>
    </div>
  </div>
</div>
</form>

