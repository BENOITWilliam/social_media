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

    echo "<style>body { background-image : url('".$_SESSION['Image']."');background-size: cover;}</style>";

    echo '<div class="container" id="color"><div class="center_nav"><nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="accueil.php">Accueil</a>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="compte.php">Mon compte</a>
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
  </nav></div><br>';

    echo '<br>
    <div class="container" id="color">
    <h1>Mon compte :</h1>
    <div class="row g-0">
      <div class="col-sm-6 col-md-8"><br><br>
        <h3 class="fw-bold">Pseudo : </h3><h4>'.$_SESSION['Pseudo'].'</h4><br><br>
        <h3 class="fw-bold">Adresse mail : </h3><h4>'.$_SESSION['Email'].'</h4><br><br>
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
    echo '</body>';

    if($_SESSION['NC'] == 1){
      echo '<div class="center_compte"><div class="container" id="color">
      <h3 class="text-center">Actions administrateur :</h3><br>
      <a href="admin.php"><button class="btn btn-primary">Gérer les utilisateurs</button></a>
      </div>';
    }
}
?>