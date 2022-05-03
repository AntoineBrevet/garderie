<?php
$stripeCustom = "";
if ($stripeCustom !== ""){
  var_dump($stripeCustom);
  $stripeInvoice = new \Stripe\StripeClient(
    'sk_test_51KqedTGFqnMK1iszIFr79OxZ1CH2hUAFrL2t0yBcoLCJczQ34hu5Zr5wLltWLpOlvjIi7ebMiDH5WD2j0l9ejSc300Q95hDGvu'
  );
  $stripeInvoice->invoices->create([
    'customer' => $stripeCustom,
  ]);
}

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Integrate Stripe Payment Gateway in Codeigniter 4</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="container">

    <pre id="getTokenRes"></pre>
    <pre id="getTokenRes2"></pre>

    <div class="d-grid mb-3">
      <button class="btn btn-dark" onclick="handlePayment(50)">Pay $50</button>
    </div>
    <div class="d-grid mb-3">
      <button class="btn btn-danger" onclick="handlePayment(100)">Pay $100</button>
    </div>
    <div class="d-grid">
      <button class="btn btn-warning" onclick="handlePayment(200)">Pay $200</button>
    </div>
    
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <script src="https://checkout.stripe.com/checkout.js"></script>
  <script type="text/javascript">
    function handlePayment(amount) {
      var handler = StripeCheckout.configure({
        key: 'pk_test_51KqedTGFqnMK1isz6q448oTpoHKvWhFvKkGvSiTNow8iS3Awe8n0EJN5w0E47gkz6GeatHpZhWDuHNBy3l8BDPer00hxwyn4Se',
        locale: 'auto',
        token: function (token) {
          console.log('Token Generated' + token);
          $('#getTokenRes').html(JSON.stringify(token));
          $.ajax({
            url: "<?php echo base_url(); ?>StripeController/stripePayment",
            method: 'post',
            data: {
              tokenId: token.id,
              amount: amount
            },
            dataType: "json",
            success: function (response) {
              console.log(response.data);
              $('#getTokenRes').append('<br />' + JSON.stringify(response
                .data));
            }
          })
        }
      });
      handler.open({
        name: 'RS Shopping Commerce',
        description: '2 Widgets',
        amount: amount * 100
      });
    }
  </script>
</body>

</html>