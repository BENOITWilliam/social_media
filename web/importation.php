<?php
/* Fichier universel mise en page (barre de navigation et pied de page) */
function importation(){

  echo'<link rel="shortcut icon" type="image/png" href="documents\site\in2.png"/>';

  if($_SESSION['ID']==NULL){echo'<meta http-equiv="refresh" content="0; url=index.html">';exit();}

  echo "<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css'>
  <link rel='stylesheet' href='style2.css'>";
  echo '<body>';
  echo "<style>body { background-image : url('".$_SESSION['Image']."');background-size: cover;background-attachment: fixed;}</style>";
  echo '
  <div class="container" id="color">
<div class="center_nav">
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <img src="documents\site\logo_ece_in2-removebg.png" alt="logo_ece_in2.png" height="18%" width="18%">
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="navbar-brand" href="accueil.php" style="padding-left:110;">Accueil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="reseau.php">Réseau</a>
          </li>
          <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="offre_emploi.php">Offres d\'emploi</a>
          </li>
          <li class="nav-item">
            <div class="center_compte_notif">
              <a class="nav-link active" aria-current="page" href="notif.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell-fill" viewBox="0 0 16 16">
              <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2m.995-14.901a1 1 0 1 0-1.99 0A5 5 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901"/>
              </svg>
              </a>
            </div>
          </li>
          <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="compte.php">Mon compte</a>
          </li>
        </ul>
      </div>
      <a href="deconnexion.php"><button class="btn btn-outline-danger" type="submit">Se déconnecter</button></a>
    </div>
  </nav>
</div>
</div>';




  echo '<div class="container"><br><br></div></body>';
  echo '<footer><div class="container"><br><br></div>
  <div class="container" id="colorb"><br>
      <div class="row">
      <div class="col-sm-4">
          <center><p id="txt_color">Copyright © 2024 Volpe. Tous droits réservés.</p></center>
          <center><p id="txt_color">10 Rue Sextius Michel, 75015 Paris,France</p></center>
          <center><p id="txt_color">Ece.in@edu.ece.fr</p></center>
      </div>
      <div class="col-sm-4">
          <center><a href="#"><p id="txt_color"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5250.732589444211!2d2.2859856119375626!3d48.851225171211524!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e6701b4f58251b%3A0x167f5a60fb94aa76!2sECE%20-%20Ecole%20d&#39;ing%C3%A9nieurs%20-%20Campus%20de%20Paris!5e0!3m2!1sfr!2sfr!4v1717153274259!5m2!1sfr!2sfr" width="300" height="100" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></p></a></center>
      </div>
      <div class="col-sm-4">
          <center><a href="politique_confidentialite.php"><p id="txt_color">Politique de confidentialité</p></a></center>
          <center><a href="politique_relative_cookie.php"><p id="txt_color">Politique relative aux cookies</p></a></center>
          <center><a href="condition_general_utilisation.php"><p id="txt_color">Conditions générales d\'utilisation</p></a></center>
      </div>
  </div>
  </footer>';

}
?>