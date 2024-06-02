<?php
/* Affichage du profil utilisateur et donne accès à toutes ses menu de personalisation et de gestion de son comptes */
/* Et aussi un menu administrateur gestion emploi et compte */
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

require("importation.php");
importation();

if ($db_found) {
    
  echo '<div class="container" id="color">
  <div class="row g-0">
    <div class="col-6 col-md-8">
      <h1>Mon compte :</h1><br><br>
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
        <br><h3 class="fw-bold">Photo : </h3><img src="'.$_SESSION['Photo'].'" class="img-thumbnail" width="200px" height="200px"><br>
        <form enctype="multipart/form-data" method="POST" action="c_photo.php">
          <input accept="Image/png, Image/jpeg" type="file" id="photo" name="photo" style="display: none"><label for="photo" id="photo" class="btn btn-dark">Choisir un fichier</label><br>
          <button type="submit" name="soumettre" value="soumettre" class="btn btn-primary">Soumettre</button></br></br>
        </form>
        <br><a href="menu_event.php"><button class="btn btn-primary">Gérer les événements</button></a><br><br><br><br>
        <form enctype="multipart/form-data" method="POST" id="form_cv">
          <input accept="text/xml" type="file" onchange="document.getElementById(`form_cv`).submit()" id="cv" name="cv" style="display: none"><label for="cv" id="cv" class="btn btn-dark">Charger votre CV</label>
        </form>
        <a href="afficher_cv.php"><button name="affciher_cv" class="btn btn-primary">Afficher CV</button></a>
    </div>
  </div>
  </div>';

  if(isset($_FILES)){
    $nom_fichier = $_FILES['cv']['name'];
    if($nom_fichier!=NULL){
      $uploaddir = 'documents/cv/cv';
      $uploadfile = $uploaddir . $_SESSION['ID'].'.xml';
      rename($_FILES['cv']['tmp_name'],$uploadfile);
    }
    //echo '<input accept="text/xml" type="file" id="input_cv" name="input_cv" style="display: none">';
    //echo '<meta http-equiv="refresh" content="0; url=index.html">';
  }



  
  echo '</br>';  

  if($_SESSION['NC'] == 1){
    echo '
    <div class="container" id="color">
      <h3 class="text-center">Actions administrateur :</h3><br>
      <div class="row">
        <div class="col-sm-6">
          <center><a href="admin.php"><button class="btn btn-primary">Gérer les utilisateurs</button></a></center><br>
        </div>
        <div class="col-sm-6">
          <center><a href="admin_menu_emploi.php"><button class="btn btn-primary">Gérer les offres d\'emploi</button></a></center><br>
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
  echo '<br><center><h1><u>Mes publications :</u></h1></center><br>';
  while ($data = mysqli_fetch_assoc($result)){
    if (pathinfo($data['Lien'], PATHINFO_EXTENSION) == 'mp4') {echo "<center><video src='".$data['Lien']."' controls width='40%' height='26%'></video></center>";} 
    else {echo "<center><img src='".$data['Lien']."' alt='Image du post' class='img-fluid'></center>";}
    
    if($data['Description'] != NULL || $data['Date'] != NULL || $data['Heure'] != NULL || $data['Lieu'] != NULL){
      echo '<br><center><button type="button" class="btn btn-secondary" onclick="toggle_text(`span_txt'.$data['ID_Post'].'`);">Afficher description</button></center><br>
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
    echo '
    <div class="row">
        <div class="col-sm-6">
          <center><a href="modifier_post.php?ID_Post='.$data['ID_Post'].'"><button type="button" class="btn btn-primary">Modifier</button></a></center><br>
        </div>
        <div class="col-sm-6">
          <form method="post">
            <center><input type="submit" name="sup_'.$data['ID_Post'].'" class="btn btn-danger" value="Supprimer '.$data['ID_Post'].' 🗑️"></input></center><br>
          </form>
        </div>
      </div>
    <br><br>';

    if(array_key_exists('sup_'.$data['ID_Post'].'',$_POST)){
      $n_sql="DELETE FROM `post` WHERE ID_Post = '".$data['ID_Post']."'";

      try{
        $n_result = mysqli_query($db_handle, $n_sql);
      }
      catch (Exception $e){
          $error = $e->getMessage();
          echo $error;
          exit();
      }

      header("Refresh:0");
    }
  }
}
?>
