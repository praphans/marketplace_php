<?php $this->load->view("templates/header"); ?>

<body>
<form name="checkoutForm" method="POST" action="checkout.php">
  <script id="pay" type="text/javascript" src="https://cdn.omise.co/omise.js"
    data-key="pkey_test_5f77edc0mdv5ycqkx9b"
    data-image="<?php echo base_url("assets/images/mc.png"); ?>"
    data-frame-label="บริษัท มีเมสเสจ จำกัด"
    data-button-label="Pay now"
    data-submit-label="เติมเงิน"
    data-location="no"
    data-amount="10025"
    data-currency="thb"
    >
  </script>
</form>
</body>
</html>
 
            
<?php $this->load->view("templates/footer"); ?>
