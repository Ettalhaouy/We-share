<?php
require 'inc/Autoloader.php';

$db = App::getDatabase();
$ads = $db->query('SELECT * FROM advertisements  WHERE id = ?', [$_GET['id']])->fetch();

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
        <title>A propose d'annonce</title>

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" integrity="sha384-DhY6onE6f3zzKbjUPRc2hOzGAdEf4/Dz+WJwBvEYL/lkkIsI3ihufq9hk9K4lVoK" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />


    </head>
<body>
    <div class="container">
        <div class="card mb-3  container">
            <img  style="margin: 20px 0px;" src="<?php echo $ads->photo; ?>" class="img card-img-top" alt="...">
            <div class="card-body">
            <h3 class="card-title"><?php echo $ads->title; ?></h3>
            <p class="card-text"><small class="text-muted"><?php echo $ads->date; ?></small></p>
            <p class="card-text">
            <?php echo $ads->Description; ?>
            </p>

            </div>
                <div style="margin: 20px 80px;">
                    <input type="text" id="id_ads" value="<?php echo $ads->id; ?>" hidden>
                    <button type="button" onclick="goToPay()" class="btn btn-primary btn-block" href="checkout.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="25" fill="currentColor" class="bi bi-cash" viewBox="0 0 16 16">
                            <path d="M8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/>
                            <path d="M0 4a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V4zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V6a2 2 0 0 1-2-2H3z"/>
                        </svg>
                        Faire un don
                    </button>
                    <script>

                    function goToPay() {
                    let id =  document.getElementById("id_ads").value;
                    let link = "http://localhost/We-share/checkout.php?id=" + id;
                    window.open(link,"_self");
                    }
                    </script>
                </form>
                </div>
            <div style="margin: 20px 80px;">
                <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-secondary btn-block">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-share-fill" viewBox="0 0 16 16">
                    <path d="M11 2.5a2.5 2.5 0 1 1 .603 1.628l-6.718 3.12a2.499 2.499 0 0 1 0 1.504l6.718 3.12a2.5 2.5 0 1 1-.488.876l-6.718-3.12a2.5 2.5 0 1 1 0-3.256l6.718-3.12A2.5 2.5 0 0 1 11 2.5z"/>
                    </svg>
                    Partager
                </button>
            </div>

      <style>
            .share-btn-container {
            background: #fff;
            display: flex;
            flex-direction: column;
            padding: 16px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            top: 50%;
            }

            .share-btn-container a i {
            font-size: 32px;
            }

            .share-btn-container a {
            margin: 12px 0;
            transition: 500ms;
            }
            .share-btn-container a:hover {
            transform: scale(1.2);
            }

            .share-btn-container .fa-facebook {
            color: #3b5998;
            }

            .share-btn-container .fa-twitter {
            color: #1da1f2;
            }


            .share-btn-container .fa-linkedin {
            color: #0077b5;
            }

            .share-btn-container .fa-whatsapp {
            color: #25d366;
            }
      </style>
  <!-- The Modal -->

  <div class="modal fade" id="myModal">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Pargater</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <center>
          <img style="width: 40%; height: 10%; border-radius: 50%;" class="mb-4 rounded-circle" src="assets/images/We-Share-logo.png" alt="">
          <br>
          <div class="share-btn-container">
            <a href="#" class="facebook-btn">
                <i class="fab fa-facebook"></i>
            </a>

            <a href="#" class="twitter-btn">
                <i class="fab fa-twitter"></i>
            </a>

            <a href="#" class="linkedin-btn">
                <i class="fab fa-linkedin"></i>
            </a>

            <a href="#" class="whatsapp-btn">
                <i class="fab fa-whatsapp"></i>
            </a>
         </div>
          <p class="mt-5 mb-3 text-muted">&copy; We Share 2021</p>
          </center>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">

          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>
</div>


<script>
        const facebookBtn = document.querySelector(".facebook-btn");
        const twitterBtn = document.querySelector(".twitter-btn");
        const linkedinBtn = document.querySelector(".linkedin-btn");
        const whatsappBtn = document.querySelector(".whatsapp-btn");

        function init() {
        const pinterestImg = document.querySelector(".img");

        let postUrl = encodeURI(document.location.href);
        let postTitle = encodeURI("Hi everyone, please check this out: ");
        let postImg = encodeURI(pinterestImg.src);

        facebookBtn.setAttribute(
            "href",
            `https://www.facebook.com/sharer.php?u=${postUrl}`
        );


        twitterBtn.setAttribute(
            "href",
            `https://twitter.com/share?url=${postUrl}&text=${postTitle}`
        );


        linkedinBtn.setAttribute(
            "href",
            `https://www.linkedin.com/shareArticle?url=${postUrl}&title=${postTitle}`
        );

        whatsappBtn.setAttribute(
            "href",
            `https://wa.me/?text=${postTitle} ${postUrl}`
        );
        }

        init();
      </script>
</body>
</html>