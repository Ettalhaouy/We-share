<!DOCTYPE html>
<html lang="en">
    <?php
  require 'inc/Autoloader.php';
  ?>
  <?php include 'layouts/private_header.html'; ?>
    <div class="container">
        <div class="row justify-content-center text-center">
          <div class="col-10 py-5">
            <img src="assets/images/We-Share-logo.png" class="img-fluid rounded-circle" style="width:300px ; height : 300px;"><br><br>
            <h2>À propos de nous</h2>
            <br>
            <p class="lead text-justify"> 
            We-Share est un site web à but non lucratif  qui joue 
            le rôle de médiateur entre les donateurs et les associations, 
            tout en permettant aux associations de lister leurs appels aux dons et d'une façon 
            facile et protéger permet aux donateur d’effectuer leurs dons soit par carte  
            ou virement bancaire.

            </p>
          </div>
        </div>
      </div>
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="section-title mb-4 pb-2">
                        <h2>L'équipe de Développement </h2>
                    </div>
                </div><!--end col-->
            </div><!--end row col-md-6 col-10 mt-5 pt-2 -->
        
    <div class="row">
    <div class="col-4 mx-auto">
        <div class="team-list position-relative overflow-hidden float-right shadow rounded">
            <img src="assets/images/me2.jpeg" class="img-fluid float-left" alt="">
            <div class="content float-right p-4">
                <h5 class="title mb-0">Noureddine Ettalhaouy</h5>
                <small class="text-muted">Développeur Front-End</small>
                <p class="text-muted mt-3">Résponsable de la partie client : HTML / CSS et JS en utilisant Bootstrap</p>
            </div>
        </div>                        
    </div><!--end col-->
                
    <div class="col-4 mx-auto">
        <div class="team-list position-relative overflow-hidden shadow rounded">
            <center><img src="assets/images/ismail.jpg" class="img-fluid float-center" style="max-height: 350px;" alt=""></center>
            <div class="content float-right p-4">
                <h5 class="title mb-0">Chakrane Ismail</h5>
                <small class="text-muted">Développeur Backend-End</small>
                <p class="text-muted mt-3">Résponsable de la partie serveur (traitement de données) : PHP / MySQL</p>
            </div>
        </div>                        
    </div><!--end col-->
</div><!--end row-->
        </div>
        <div class="container" >
            <hr class="hr-text" data-content="Contact us">
            <form class="container">
              <h1>Contacter Nous</h1><br>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Prénom</label>
                        <input type="email" class="form-control" id="inputFirstName" placeholder="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Nom</label>
                        <input type="password" class="form-control" id="inputLastName" placeholder="">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Adresse Email</label>
                        <input type="email" class="form-control" id="inputEmail" placeholder="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Tél</label>
                        <input type="text" class="form-control" id="inputPhonNumber" placeholder="">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="inputAddress">Message</label>
                        <textarea type="text" class="form-control col-md-12"  id="inputMessage" placeholder="Votre message !"></textarea>
                    </div>
                <button class="btn btn-primary form-group col-md-6" type="submit" >Envoyer message</button>
                </div>
            </form>
          
        </div>
</body>
</html>