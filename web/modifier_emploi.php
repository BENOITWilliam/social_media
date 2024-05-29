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

require("importation.php");
importation();

if ($db_found) {

  $sql = "SELECT *  FROM `emploi` WHERE ID_Emploi = '".$_SESSION['ID_Emploi']."'";

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
    <div class="col-sm-6 col-md-8"><br>
      <h3>Titre de l\'emploi :</h3><h4> <input type="text" class="form-control" maxlength="30" style="width: 700px;" name="Nom" value="'.$data['Nom'].'"/></h4><br><br>
      <h3 class="fw-bold">Description courte : </h3><textarea size="100" name="Desc_courte" class="form-control" maxlength="75" style="width: 700px;height: 100px;">'.$data['Desc_courte'].'</textarea><br><br>
      <h3 class="fw-bold">Description : </h3><textarea size="100" name="Description" class="form-control" style="width: 700px;height: 400px;">'.$data['Description'].'</textarea><br><br>
    </div>
    <div class="col-6 col-md-4">
        <br><h3 class="fw-bold">Photo : </h3><img src="'.$data['Image'].'" class="img-thumbnail" width="200px" height="200px"><br>
        <input accept="Image/png, Image/jpeg" type="file" id="photo" name="photo" style="display: none"><label for="photo" id="photo" class="btn btn-dark">Choisir un fichier</label>
    </div>
  </div>
  <button type="submit" name="soumettre" value="soumettre" class="btn btn-success">Valider les modifications</button></br>
  </form><br><a href=admin_menu_emploi.php><button class="btn btn-primary">Page de modification des offres d\'emploi</button></a>
  <br><br></div>';
  
  if(array_key_exists('soumettre',$_POST)){
    
    $Nom = isset($_POST['Nom']) ? $_POST['Nom'] :'';
    $Desc_courte = isset($_POST['Desc_courte']) ? $_POST['Desc_courte'] :'';
    $Description = isset($_POST['Description']) ? $_POST['Description'] :'';

    $uploaddir = 'documents/emploi/';
    $uploadfile = $uploaddir . basename($_FILES['photo']['name']);
    
    //move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile)
    if($uploadfile != $uploaddir){
      $taille = getimagesize($_FILES['photo']['tmp_name']);
      if($taille[2]==2){
        $im = imagecreatefromjpeg($_FILES['photo']['tmp_name']);
        $im_crop = imagecreatetruecolor(200, 200);
        imagecopyresampled($im_crop, $im, 0, 0, 0, 0, 200, 200, $taille[0], $taille[1]);
        imagejpeg($im_crop, 'documents/emploi/' . $_FILES['photo']['name'], 90);
    }
      if($taille[2]==3){
        $im = imagecreatefrompng($_FILES['photo']['tmp_name']);
        $im_crop = imagecreatetruecolor(200, 200);
        imagecopyresampled($im_crop, $im, 0, 0, 0, 0, 200, 200, $taille[0], $taille[1]);
        imagepng($im_crop, 'documents/emploi/' . $_FILES['photo']['name'], 9);
      }
      $sql='UPDATE `emploi` SET Nom = "'.$Nom.'", Desc_courte = "'.$Desc_courte.'", Description = "'.$Description.'", Image = "'.$uploadfile.'" WHERE ID_Emploi = "'.$_SESSION['ID_Emploi'].'"';
    }
    else{$sql='UPDATE `emploi` SET Nom = "'.$Nom.'", Desc_courte = "'.$Desc_courte.'", Description = "'.$Description.'" WHERE ID_Emploi = "'.$_SESSION['ID_Emploi'].'"';}
    
    try{
      $result = mysqli_query($db_handle, $sql);
    }
    catch (Exception $e){
      $error = $e->getMessage();
      echo $error;
      exit();
    }

    header("Location: http://localhost/web/admin_menu_emploi.php");

  }
}

?>
