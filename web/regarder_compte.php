<?php
/* Permet de regarder le profil compte à partir de la photo profil de réseau */
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

$ID = $_GET['ID'];

if ($db_found) {
    
    $user_sql = "SELECT * FROM `utilisateur` WHERE ID LIKE '".$ID."'";

    try{
        $user_result = mysqli_query($db_handle, $user_sql);
    }
    catch (Exception $e){
        $error = $e->getMessage();
        echo $error;
        exit();
    }


    $user_data = mysqli_fetch_assoc($user_result);

    echo "<style>body { background-image : url('".$user_data['Image']."');background-size: cover;background-attachment: fixed;}</style>";

    echo '
    <div class="container" id="color">
        <div class="row g-0">
            <div class="col-6 col-md-8">
            <h1>Mon compte :</h1><br><br>
            <h3 class="fw-bold">Pseudo : </h3><h4>'.$user_data['Pseudo'].'</h4><br><br>
            <h3 class="fw-bold">Adresse mail : </h3><h4>'.$user_data['Email'].'</h4><br><br>
            <h3 class="fw-bold">Description : </h3><h4>'.$user_data['Description'].'</h4>
            </div>
            <div class="col-6 col-md-4">
                <br><h3 class="fw-bold">Photo : </h3><img src="'.$user_data['Photo'].'" class="img-thumbnail" width="200px" height="200px"><br>
            </div>
        </div>
        <br>
    </div>';

  echo '</br></br>';

  $sql = "SELECT * FROM `post` WHERE ID_Emetteur = '".$user_data['ID']."'";

  try{
    $result = mysqli_query($db_handle, $sql);
  }
  catch (Exception $e){
      $error = $e->getMessage();
      echo $error;
      exit();
  }

  echo '<div class="container" id="color">';
  echo '<br><center><h1><u>Mes publications :</u></h1></center>';
  while ($data = mysqli_fetch_assoc($result)){
    if($data['Privé']==1){continue;} //<-- permet de ne pas afficher les posts privés quand on regarde le compte  
    if (pathinfo($data['Lien'], PATHINFO_EXTENSION) == 'mp4') {echo "<br><br><center><video src='".$data['Lien']."' controls width='360' height='200'></video></center>";} 
    else {echo "<br><br><center><img src='".$data['Lien']."' alt='Image du post' class='img-fluid'></center>";}
    
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
