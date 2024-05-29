<?php

$database = "likedin";
session_start();

try {
  $db_handle = mysqli_connect('localhost', 'root', 'root');
}
catch (Exception $e){
  $error = $e->getMessage();
  echo $error;
  exit();
}

try{
  $db_found = mysqli_select_db($db_handle, $database);
}
catch (Exception $e){
  $error = $e->getMessage();
  echo $error;
  exit();
}

if($_SESSION['ID']==NULL){echo'<meta http-equiv="refresh" content="0; url=http://localhost/web/index.html">';exit();}
echo "<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css'>
<link rel='stylesheet' href='style.css'>";
echo '<body>';
echo "<style>body { background-image : url('".$_SESSION['Image']."');background-size: cover;background-attachment: fixed;}</style>";
echo '<div class="container" id="color"><div class="center_nav"><nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="accueil.php">Accueil</a>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="compte.php">Mon compte</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="offre_emploi.php">Offres d\'emploi</a>
          </li>
          <li class="nav-item">
            <div class="center_compte_notif">
              <a class="nav-link disabled" aria-disabled="true"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell-fill" viewBox="0 0 16 16">
              <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2m.995-14.901a1 1 0 1 0-1.99 0A5 5 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901"/>
              </svg>
              </a>
            </div>
          </li>
        </ul>
          <a href="deconnexion.php"><button class="btn btn-outline-danger" type="submit">Se déconnecter</button></a>
      </div>
    </div></div>
  </nav></div><br><br>';

if ($db_found) {

    echo '<div class="container" id="color"><h1>Connecté</h1>';
    echo $_SESSION['ID'].'</div>';


    echo '<br><br><br>
    <footer>
        <div class="container" id="colorb"><br>
            <div class="row">
            <div class="col-sm-4">
                <center><p id="txt_color">Copyright © 2024 Volpe Inc. Tous droits réservés.</p></center>
                <center><p id="txt_color">France</p></center>
            </div>
            <div class="col-sm-4">
                <center><a href="#"><p id="txt_color">Politique de confidentialité</p></a></center>
                <center><a href="#"><p id="txt_color">Politique relative aux cookies</p></a></center>
            </div>
            <div class="col-sm-4">
                <center><a href="#"><p id="txt_color">Politique</p></a></center>
                <center><a href="#"><p id="txt_color">Conditions générales d\'utilisation</p></a></center>
            </div>
        </div>
    </footer>
  </body>';
}

?>
