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

echo "<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css'>
<link rel='stylesheet' href='style.css'>";
echo '<body>';

if ($db_found) {

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
        <a href="index.html"><button class="btn btn-outline-danger" type="submit">Se déconnecter</button></a>
      </div>
    </div></div>
  </nav></div><br><br>';

  echo '<div class="container" id="color">
  <h1>Mon compte :</h1>
  <div class="row g-0">
    <div class="col-6 col-md-8"><br><br>
      <h3 class="fw-bold">Pseudo : </h3><h4>'.$_SESSION['Pseudo'].'</h4><br><br>
      <h3 class="fw-bold">Adresse mail : </h3><h4>'.$_SESSION['Email'].'</h4><br><br>
      <h3 class="fw-bold">Description : </h3><h4>'.$_SESSION['Description'].'</h4>
      <a href="c_description.php"><button class="btn btn-primary">Changer la description</button></a><br><br><br>
      <h3 class="fw-bold">Image de fond : <br></h3>
      <form enctype="multipart/form-data" method="POST" action="c_fond.php">
          <input accept="Image/png, Image/jpeg" type="file" id="fond" name="fond" style="display: none"><label for="fond" id="fond" class="btn btn-dark">Choisir un fichier</label><br><br>
          <button type="submit" name="soumettre" value="soumettre" class="btn btn-primary">Soumettre</button></br></br>
      </form>
    </div>
    <div class="col-6 col-md-4">
        <h3 class="fw-bold">Photo : </h3><img src="'.$_SESSION['Photo'].'" class="img-thumbnail" width="200px" height="200px"><br>
        <form enctype="multipart/form-data" method="POST" action="c_photo.php">
          <input accept="Image/png, Image/jpeg" type="file" id="photo" name="photo" style="display: none"><label for="photo" id="photo" class="btn btn-dark">Choisir un fichier</label><br><br>
          <button type="submit" name="soumettre" value="soumettre" class="btn btn-primary">Soumettre</button></br></br>
        </form>
    </div>
  </div>
  </div>';


  echo '</br>';
  

  if($_SESSION['NC'] == 1){
    echo '<div class="container" id="color">
    <h3 class="text-center">Actions administrateur :</h3><br>
    <div class="row">
    <div class="col-sm-4">
      <center><a href="admin.php"><button class="btn btn-primary">Gérer les utilisateurs</button></a></center>
    </div>
    <div class="col-sm-4">
      <center><a href="admin_menu_emploi.php"><button class="btn btn-primary">Gérer les offres d\'emploi</button></a></center>
    </div>
    <div class="col-sm-4">
      <center><a href="admin.php"><button class="btn btn-primary">Gérer les utilisateurs</button></a></center>
    </div>
    </div>
    </div>';
  }

  echo '</br></br>';

  $sql = "SELECT * FROM `post` WHERE ID_Emetteur = '".$_SESSION['ID']."'";

  try{
    $result = mysqli_query($db_handle, $sql);
  }
  catch (Exception $e){
      $error = $e->getMessage();
      echo $error;
      exit();
  }

  echo '<div class="container" id="color">';
  echo '<br><center><h1><u>Mes publications :</u></h1></center><br><br>';
  while ($data = mysqli_fetch_assoc($result)){
    echo '<center><img src="'.$data['Lien'].'" class="img-thumbnail" width="250px" height="200px"><br></center><br>';

    if($$data['Description'] != NULL || $data['Date'] != NULL || $data['Heure'] != NULL || $data['Lieu'] != NULL){
      echo '<center><button type="button" class="btn btn-secondary" onclick="toggle_text(`span_txt'.$data['ID_Post'].'`);">Afficher description</button></center><br>
      <span id="span_txt'.$data['ID_Post'].'" style="display:none;">
      <div class="row">
        <div class="col-sm-4">';
      
      if($data['Description'] != NULL){echo '<center><h5>Decription du post : </h5>'.$data['Description'].'</center>';}
          
      echo '</div>
        <div class="col-sm-4">';

      if($data['Date'] != NULL){echo '<center><h5>Date du post : </h5>'.$data['Date'].'</center>';}

      if($data['Heure'] != NULL){echo '<center><h5>Heure du post : </h5>'.$data['Heure'].'</center>';}
        
      echo '</div>
        <div class="col-sm-4">';

      if($data['Lieu'] != NULL){echo '<center><h5>Lieu du post : </h5>'.$data['Lieu'].'</center>';}

      echo '</div>
      </div>';
      echo '<br><br>';

      echo '</span>
      
      <script type="text/javascript">
          function toggle_text(id) {
          var span = document.getElementById(id);
          if(span.style.display == "none") {
              span.style.display = "inline";
          } else {
              span.style.display = "none";
          }
          }
      </script>';
    }
    echo '<br><br>';
  }
  echo '</div><div class="container"><br><br><br><br><br><br></div></body>';
  echo '<footer>
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
  </footer>';
}
?>
