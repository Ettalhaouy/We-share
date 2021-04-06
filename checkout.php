<?php
require 'inc/Autoloader.php';


$db = App::getDatabase();
$Auth = new Auth;
$id_ads = $_GET['id'];
$date = date("Y-m-d H:i:s");

if (!empty($_POST)) {
    if($Auth->isValidInsertPaymentsInfos($db,$id_ads,$date)){
      App::redirect('layouts/payment-success.html');
  } else {
    Session::getInstance()->setFlash('danger', 'Vous devez remplir tous les champs correctement');
    App::redirect('checkout.php');
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="apple-touch-icon" sizes="180x180" href="assets/images/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="assets/images/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon-16x16.png">
  <link rel="mask-icon" href="assets/images/safari-pinned-tab.svg" color="#5bbad5">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="theme-color" content="#ffffff">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Noureddine Ettalhaouy, Ismail Chakrane , Faysal Belkhchicha ">
  <title>Checkout</title>
  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="assets/styles/checkout.css">
</head>

<body class="bg-light">
  <div class="container">
    <main>
      <div class="py-5 text-center">
        <img class="mb-4 rounded-circle mx-auto d-block" src="assets/images/We-Share-logo.png" alt="" width="172" height="172" style="margin-top: 30px;">
        <h2>Donation</h2>
      </div>
      <!-- flash controle -->
      <?php if (Session::getInstance()->hasFlashes()) : ?>
        <?php foreach (Session::getInstance()->getFlashes() as $type => $message) : ?>
          <div class="alert alert-<?= $type; ?>">
            <div><?= $message; ?></div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
      <div class="row">
        <form class="needs-validation" method="POST" action="">
          <div class="col-md-7 col-lg-8">
            <h3 class="d-flex justify-content-between align-items-center mb-3">
              <span class="mb-3">Votre enchère</span>
            </h3>
            <h4 class="mb-3">Prix</h4>
            <ul class="list-group mb-3">
              <li class="list-group-item d-flex justify-content-between lh-sm">
                <div class="col-12">
                  <input type="number" onchange="changePrice()" id="priceSelected" name="price" class="form-control" placeholder="0.00 DH" step=".5" min="0" value="" required>
                </div>
              </li>
              <li class="list-group-item d-flex justify-content-between">
                <span>Total (DH)</span>
                <span id="changeable">0.00</span>
                <script>
                  function changePrice() {
                    var x = document.getElementById("priceSelected").value;
                    document.getElementById("changeable").innerHTML =  x;
                  }
                </script>
              </li>
            </ul>
          </div>
          <div class="col-md-7 col-lg-8">
            <h4 class="mb-3">Informations de paiement</h4>
            <div class="row gy-3">
              <div class="col-md-6">
                <label for="cc-name" class="form-label">Name on card</label>
                <input type="text" name="nameCard" placeholder="Cardholder Name" class="form-control" id="cc-name" placeholder="" required>
                <small class="text-muted">Full name as displayed on card</small>
                <div class="invalid-feedback">
                  Name on card is required
                </div>
              </div>
              <div class="col-md-6">
                <label for="cc-number" class="form-label">Credit card number</label>
                <input type="text" name="cardNumber" placeholder="XXXX-XXXX-XXXX-XXXX" class="form-control" id="cc-number" placeholder="" required>
                <div class="invalid-feedback">
                  Credit card number is required
                </div>
              </div>
              <div class="col-md-3">
                <label for="cc-expiration" class="form-label">Expiration</label>
                <input type="text" name="expiration" placeholder="mm/AA" class="form-control" id="cc-expiration" placeholder="" required>
                <div class="invalid-feedback">
                  Expiration date required
                </div>
              </div>
              <div class="payment">
                      <div class="form-group owner">
                          <label for="owner">Owner</label>
                          <input type="text" class="form-control" name="nameCard" id="owner">
                      </div>
                      <div class="form-group CVV">
                          <label for="cvv">CVV</label>
                          <input type="text" class="form-control" name="CCV" id="cvv">
                      </div>
                      <div class="form-group" id="card-number-field">
                          <label for="cardNumber">Card Number</label>
                          <input type="text" class="form-control" name="cardNumber" id="cardNumber">
                      </div>
                      <div class="form-group" name="expiration" id="expiration-date">
                          <label>Expiration Date</label>
                          <select>
                              <option value="01">January</option>
                              <option value="02">February </option>
                              <option value="03">March</option>
                              <option value="04">April</option>
                              <option value="05">May</option>
                              <option value="06">June</option>
                              <option value="07">July</option>
                              <option value="08">August</option>
                              <option value="09">September</option>
                              <option value="10">October</option>
                              <option value="11">November</option>
                              <option value="12">December</option>
                          </select>
                          <select>
                              <option value="21"> 2021</option>
                              <option value="22"> 2022</option>
                              <option value="23"> 2023</option>
                              <option value="24"> 2024</option>
                              <option value="25"> 2025</option>
                              <option value="26"> 2026</option>
                              <option value="27"> 2027</option>
                          </select>
                      </div>
                      <div class="form-group" id="credit_cards">
                          <img src="assets/images/visa.jpg" id="visa">
                          <img src="assets/images/mastercard.jpg" id="mastercard">
                          <img src="assets/images/amex.jpg" id="amex">
                      </div>
                      <div class="form-group" id="pay-now">
                          <button type="submit" class="btn btn-default" id="confirm-purchase">Confirm</button>
                      </div>
              </div>
          </div>
    </div>
    </main>
    <footer class="my-5 pt-5 text-muted text-center text-small">
      <p class="mb-1">&copy; 2021 We-Share</p>
    </footer>
  </div>
  <scrip src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></scrip>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>  <script src="assets/JS/jquery.payform.min.js" charset="utf-8"></script>
  <script src="assets/JS/checkout-validation.js"></script>
</body>

</html>