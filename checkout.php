<?php
require 'inc/Autoloader.php';


$db = App::getDatabase();
$Auth = new Auth;
$id_ads = $_GET['id'];
$date = date("Y-m-d H:i:s");
$id_org = $db->query("SELECT * from advertisements where id=?",[$id_ads])->fetch()->id_organisaton;;
$rib = $db->query("SELECT * FROM payInfo WHERE id_org=?",[$id_org])->fetch()->RIB;

$num_to_bank = substr($rib,0,3);
$bank_name = "";
switch ($num_to_bank) {
  case '007':
    $bank_name = "Attijariwafa Bank";
    break;
  case '011':
    $bank_name = "BMCE Bank";
    break;
  case '021':
    $bank_name = "Credit du Maroc";
    break;
  case '230':
    $bank_name = "CIH";
    break;
  case '013':
    $bank_name = "BMCI BNP Paribas";
    break;
  default:
    $bank_name = "Banque Populaire";
    break;
}
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="assets/JS/jquery.payform.min.js" charset="utf-8"></script>
    <script src="assets/JS/checkout-validation.js"></script>
  
  </head>
 
<body>
    <!-- flash controle -->
  <?php if (Session::getInstance()->hasFlashes()) : ?>
  <?php foreach (Session::getInstance()->getFlashes() as $type => $message) : ?>
    <div class="alert alert-<?= $type; ?>">
      <div><?= $message; ?></div>
    </div>
  <?php endforeach; ?>
<?php endif; ?>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
<div class="container-fluid">
    <div class="creditCardForm">
        <div class="heading">
            <img class="mb-4 rounded-circle mx-auto d-block" src="assets/images/We-Share-logo.png" alt="" width="172" height="172" style="margin-top: 30px;">
            <h1>Confirm Purchase</h1>
        </div>
        <article class="card">
          <div class="payment">
            <ul class="nav bg-light nav-pills rounded nav-fill mb-3" role="tablist">
              <li class="nav-item">
                  <a class="nav-link" data-toggle="pill" href="#nav-tab-card">
                  <i class="fa fa-credit-card"></i> Credit Card</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" data-toggle="pill" href="#nav-tab-bank">
                  <i class="fa fa-university"></i> Bank Transfer </a>
              </li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane fade show active" id="nav-tab-card">
                <form method="POST" action="" id="myCheckoutForm">
                      <div class="form-group owner">
                          <label for="owner">Owner</label>
                          <input type="text" name="owner" class="form-control" id="owner">
                      </div> <!-- form-group.// -->

                      <div class="form-group CVV">
                          <label for="cvv">CVV</label>
                          <input type="text" name="cvv" class="form-control" id="cvv">
                      </div>

                      <div class="form-group" id="card-number-field">
                          <label for="cardNumber">Card Number</label>
                          <input type="text" name="cardNumber" class="form-control" id="cardNumber">
                      </div><!-- form-group.// -->

                      <div class="form-group" id="expiration-date">
                          <label>Expiration Date</label>
                          <select name="expMonth">
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
                          <select name="expDay">
                              <option value="16"> 2016</option>
                              <option value="17"> 2017</option>
                              <option value="18"> 2018</option>
                              <option value="19"> 2019</option>
                              <option value="20"> 2020</option>
                              <option value="21"> 2021</option>
                              <option value="22"> 2022</option>
                              <option value="23"> 2023</option>
                          </select>
                      </div> <!-- row.// -->
                      <div class="form-group" id="credit_cards">
                        <img src="assets/images/visa.jpg" id="visa">
                        <img src="assets/images/mastercard.jpg" id="mastercard">
                        <img src="assets/images/amex.jpg" id="amex">
                      </div>
                      <div class="form-group" id="pay-now">
                          <button type="button" class="btn btn-success" id="confirm-purchase">Vérifier</button>
                      </div>
                </form>
              </div> 
              <!-- tab-pane.// -->
              <div class="tab-pane fade show" id="nav-tab-bank">
                <p>Bank accaunt details</p>
                <dl class="param">
                  <dt>NOM DU BANK: </dt>
                  <dd><?=$bank_name;?></dd>
                </dl>
                <dl class="param">
                  <dt>RIB: </dt>
                  <dd><?=$rib;?></dd>
                </dl>
                <p><strong>Note:</strong> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. </p>
              </div> <!-- tab-pane.// -->
            </div> <!-- tab-content .// -->
          </div> <!-- card-body.// -->
        </article> <!-- card.// -->
      </aside> <!-- col.// -->
    </div> <!-- row.// -->
  </div> 
  <!--container end.//-->
</body>
</html>