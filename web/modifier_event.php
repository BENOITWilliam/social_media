<?php
/* Permet la modification des événements après mise en ligne sur le réseau */
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
    $ID_Event = $_GET['ID_Event'];

    $sql = "SELECT *  FROM `event` WHERE ID_Event = '".$ID_Event."'";

  try{
      $result = mysqli_query($db_handle, $sql);
  }
  catch (Exception $e){
      $error = $e->getMessage();
      echo $error;
      exit();
  }

  $data = mysqli_fetch_assoc($result);

  echo '<div class="container" id="color">';

  echo '<form enctype="multipart/form-data" method="POST"><div class="row g-0">
    <div class="col-sm-6 col-md-8"><br><br>
      <h3>Nom de l\'event :</h3><h4> <input type="text" class="form-control" maxlength="30" style="width: 700px;" name="Nom" value="'.$data['Nom'].'" required/></h4><br><br>
      <h3 class="fw-bold">Description : </h3><textarea size="100" name="Description" class="form-control" style="width: 700px;height: 400px;">'.$data['Description'].'</textarea><br><br>
    </div>
    <div class="col-6 col-md-4">
        <br><h3 class="fw-bold">Photo : </h3><img src="'.$data['Lien'].'" class="img-thumbnail" width="200px" height="200px"><br>
        <input accept="Image/png, Image/jpeg" type="file" id="photo" name="photo" style="display: none"><label for="photo" id="photo" class="btn btn-dark">Choisir un fichier</label><br>
        <h3>Date :</h3><h4> <input type="date" class="form-control" maxlength="30" style="width: 150px;" name="Date" value="'.$data['Date'].'"/></h4><br>
        <h3>Heure :</h3><h4> <input type="time" class="form-control" maxlength="30" style="width: 100px;" name="Heure" value="'.$data['Heure'].'"/></h4><br>
        <h3>Lieu :</h3><h4> <input type="text" class="form-control" maxlength="32" style="width: 300px;" name="Lieu" value="'.$data['Lieu'].'"/></h4><br>
    </div>
  </div>
  <button type="submit" name="soumettre" value="soumettre" class="btn btn-success">Valider les modifications</button></br>
  </form><br><a href=menu_event.php><button class="btn btn-primary">Page de modification des events</button></a>
  <br><br></div><br><br>';
  
  if(array_key_exists('soumettre',$_POST)){
    
    $Nom = isset($_POST['Nom']) ? $_POST['Nom'] :'';
    $Description = isset($_POST['Description']) ? $_POST['Description'] :'';
    $Date = isset($_POST['Date']) ? $_POST['Date'] :'';
    $Heure = isset($_POST['Heure']) ? $_POST['Heure'] :'';
    $Lieu = isset($_POST['Lieu']) ? $_POST['Lieu'] :'';

    $uploaddir = 'documents/event/';
    $uploadfile = $uploaddir . basename($_FILES['photo']['name']);
    
    if($uploadfile != $uploaddir){
      $taille = getimagesize($_FILES['photo']['tmp_name']);
      if($taille[2]==2){
        $im = imagecreatefromjpeg($_FILES['photo']['tmp_name']);
        $im_crop = imagecreatetruecolor(200, 200);
        imagecopyresampled($im_crop, $im, 0, 0, 0, 0, 200, 200, $taille[0], $taille[1]);
        imagejpeg($im_crop, 'documents/event/' . $_FILES['photo']['name'], 90);
    }
      if($taille[2]==3){
        $im = imagecreatefrompng($_FILES['photo']['tmp_name']);
        $im_crop = imagecreatetruecolor(200, 200);
        imagecopyresampled($im_crop, $im, 0, 0, 0, 0, 200, 200, $taille[0], $taille[1]);
        imagepng($im_crop, 'documents/event/' . $_FILES['photo']['name'], 9);
      }
      $sql='UPDATE `event` SET ID_Emetteur = "'.$_SESSION['ID'].'", Nom = "'.$Nom.'", Description = "'.$Description.'", Lien = "'.$uploadfile.'", Date = "'.$Date.'", Heure = "'.$Heure.'", Lieu = "'.$Lieu.'" WHERE ID_Event = "'.$ID_Event.'"';
    }
    else{$sql='UPDATE `event` SET ID_Emetteur = "'.$_SESSION['ID'].'", Nom = "'.$Nom.'", Description = "'.$Description.'", Date = "'.$Date.'", Heure = "'.$Heure.'", Lieu = "'.$Lieu.'" WHERE ID_Event = "'.$ID_Event.'"';}
    
    try{
      $result = mysqli_query($db_handle, $sql);
    }
    catch (Exception $e){
      $error = $e->getMessage();
      echo $error;
      exit();
    }

    header("Location: menu_event.php");

  }
}

?>
