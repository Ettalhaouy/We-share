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

    if (!empty($_POST['price']) && !empty($_POST['paymentMethod']) && !empty($_POST['nameCard']) && !empty($_POST['cardNumber']) && !empty($_POST['expiration']) && !empty($_POST['CCV'])) {

        $paymensInfos = $db->query("UPDATE payInfo SET payMethod=? , NameCard=? , NumberCard=? , Expiration=? , CCV=? WHERE id_user=?", [$_POST['paymentMethod'], $_POST['nameCard'], $_POST['cardNumber'], $_POST['expiration'], $_POST['CCV'], $id_user]);

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
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css"
    integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">
</head>

<body class="bg-light">
  <div class="container">
    <main>
      <div class="py-5 text-center">
        <img class="mb-4 rounded-circle mx-auto d-block" src="assets/images/We-Share-logo.png" alt="" width="172"
          height="172" style="margin-top: 30px;">
        <h2>Checkout</h2>
      </div>
      <!-- flash controle -->
    <?php if (Session::getInstance()->hasFlashes()): ?>
     <?php foreach (Session::getInstance()->getFlashes() as $type => $message): ?>
       <div class="alert alert-<?=$type;?>"><li><?=$message;?> </li></div>
     <?php endforeach;?>
   <?php endif;?>
      <div class="row">
      <form class="needs-validation" method="POST" action="">
        <div class="col-md-7 col-lg-8">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="mb-3">Your Billing</span>
            <span class="badge bg-secondary rounded-pill"><?php echo $new_nb_donation; ?></span>
          </h4>
          <h4 class="mb-3">Prix</h4>
          <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between lh-sm">
              <div class="col-12">
                <input type="number" name="price" class="form-control" id="firstName" placeholder="0.00 DH" step=".5" min="0"
                  value="" required>
              </div>
            </li>
            <li class="list-group-item d-flex justify-content-between">
              <span>Total (DH)</span>
              <strong>12 DH</strong>
            </li>
          </ul>
        </div>
        <div class="col-md-7 col-lg-8">
              <h4 class="mb-3">Payment</h4>
              <div class="my-3">
                <div class="form-check">
                  <input id="credit" name="paymentMethod"  value="Credit Card" type="radio"  class="form-check-input" required>
                  <label class="form-check-label" for="credit">Credit card</label>
                </div>
                <div class="form-check">
                  <input id="debit" name="paymentMethod"  value="Debit Card" type="radio" class="form-check-input" required>
                  <label class="form-check-label" for="debit">Debit card</label>
                </div>
                <div class="form-check">
                  <input id="paypal" name="paymentMethod"  value="Paypal" type="radio"  class="form-check-input" required>
                  <label class="form-check-label" for="paypal">PayPal</label>
                </div>
              </div>
              <div class="row gy-3">
                <div class="col-md-6">
                  <label for="cc-name" class="form-label">Name on card</label>
                  <input type="text"  name="nameCard" placeholder="Cardholder Name"  class="form-control" id="cc-name" placeholder="" required>
                  <small class="text-muted">Full name as displayed on card</small>
                  <div class="invalid-feedback">
                    Name on card is required
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="cc-number" class="form-label">Credit card number</label>
                  <input type="text" name="cardNumber" placeholder="XXXX-XXXX-XXXX-XXXX"  class="form-control" id="cc-number" placeholder="" required>
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
                <div class="col-md-3">
                  <label for="cc-cvv" class="form-label">CCV</label>
                  <input type="text" name="CCV" placeholder="XXX"  class="form-control" id="cc-cvv" placeholder="" required>
                  <div class="invalid-feedback">
                    Security code required
                  </div>
                </div>
              </div>
              <br>
              <button class="w-100 btn btn-primary btn-lg" type="submit">Terminer</button>
          </form>
        </div>
      </div>
    </main>
    <footer class="my-5 pt-5 text-muted text-center text-small">
      <p class="mb-1">&copy; 2021 We-Share</p>
    </footer>
  </div>
</body>

</html>