<?php
require 'inc/Autoloader.php';

if (empty(Session::getInstance()->read('id'))) {
  Session::getInstance()->setFlash('danger', 'Vous devez être connecté');
  App::redirect('signin.php');
}

$db = App::getDatabase();
$id_user = Session::getInstance()->read('id');
$id_ads = $_GET['id'];
$user = $db->query('SELECT * FROM users  WHERE id = ?', [$id_user])->fetch();
$date = date("Y-m-d H:i:s");
$new_nb_donation = (int) $user->nb_donation + 1;

if (!empty($_POST)) {

  if (!empty($_POST['price']) && !empty($_POST['nameCard']) && !empty($_POST['cardNumber']) && !empty($_POST['expiration']) && !empty($_POST['CCV'])) {

    $paymensInfos = $db->query("UPDATE payInfo SET NameCard=? , NumberCard=? , Expiration=? , CCV=? WHERE id_user=?", [$_POST['nameCard'], $_POST['cardNumber'], $_POST['expiration'], $_POST['CCV'], $id_user]);

    $donation = $db->query("INSERT INTO donations (id_events, id_user, amount, Date) VALUES (?,?,?,?)", [$id_ads, $id_user, $_POST['price'], $date]);

    $early_nb_donation_ads = $db->query('SELECT * FROM advertisements  WHERE id = ?', [$id_ads])->fetch();

    $new_nb_donation_ads = floatval($early_nb_donation_ads->nb_Donation) + floatval($_POST['price']);

    $ads_nb_donation = $db->query("UPDATE advertisements SET nb_Donation=?  WHERE id=?", [$new_nb_donation_ads, $id_ads]);

    $nb_donation_user = $db->query("UPDATE users SET nb_donation=? WHERE id=?", [$new_nb_donation, $id_user]);

    App::redirect('payment-success.html');
  } else {
    Session::getInstance()->setFlash('danger', 'Vous devez remplir tous les champs correctement');
    App::redirect('checkout.php');
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="apple-touch-icon" sizes="180x180" href="../assets/images/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../assets/images/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon-16x16.png">
  <link rel="mask-icon" href="../assets/images/safari-pinned-tab.svg" color="#5bbad5">
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
        <!-- flash controle -->
        <?php if (Session::getInstance()->hasFlashes()) : ?>
          <?php foreach (Session::getInstance()->getFlashes() as $type => $message) : ?>
            <div class="alert alert-<?= $type; ?>">
              <li><?= $message; ?> </li>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
        <div class="creditCardForm">
              <img class="mb-4 rounded-circle mx-auto d-block" src="assets/images/We-Share-logo.png" alt="" width="172" height="172" style="margin-top: 30px;">

              <div class="heading">
                  <h1>Confirm Purchase</h1>
              </div>
              <div class="payment">
                  <form>
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
                  </form>
              </div>
          </div>
    </div>
    </main>
    <footer class="my-5 pt-5 text-muted text-center text-small">
      <p class="mb-1">&copy; 2021 We-Share</p>
    </footer>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>  <script src="assets/JS/jquery.payform.min.js" charset="utf-8"></script>
  <script src="assets/JS/checkout-validation.js"></script>
</body>

</html>