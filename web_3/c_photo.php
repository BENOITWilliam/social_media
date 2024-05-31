<?php

$database = "likedin";
session_start();

require("importation.php");
importation();


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

echo '<div class="center_c_photo"><div class="container" id="color">';

if ($db_found) {
  $uploaddir = 'documents/photo/';
  $uploadfile = $uploaddir . basename($_FILES['photo']['name']);
  $Id = $_SESSION['ID'];

  $taille = getimagesize($_FILES['photo']['tmp_name']);

  //move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile)

  if($taille[2]==2){
      $im = imagecreatefromjpeg($_FILES['photo']['tmp_name']);
      $im_crop = imagecreatetruecolor(200, 200);
      imagecopyresampled($im_crop, $im, 0, 0, 0, 0, 200, 200, $taille[0], $taille[1]);
      if(imagejpeg($im_crop, 'documents/photo/' . $_FILES['photo']['name'], 90))
      {
          echo "<br><h3 class='text-center'>La photo de profil à bien été modifié !<br></h3>";
      }
      else
      {
          echo "<br><h3 class='text-center'>Echec du téléchargement de l'image !<br></h3>";
      }
  }
  if($taille[2]==3){
      $im = imagecreatefrompng($_FILES['photo']['tmp_name']);
      $im_crop = imagecreatetruecolor(200, 200);
      imagecopyresampled($im_crop, $im, 0, 0, 0, 0, 200, 200, $taille[0], $taille[1]);
      if(imagepng($im_crop, 'documents/photo/' . $_FILES['photo']['name'], 9))
      {
          echo "<br><h3 class='text-center'>La photo de profil à bien été modifié !<br></h3>";
      }
      else
      {
          echo "<br><h3 class='text-center'>Echec du téléchargement de l'image !<br></h3>";
      }
  }

  $sql = "UPDATE `utilisateur` SET Photo = '$uploadfile' WHERE ID = '$Id';";
  try{
      $result = mysqli_query($db_handle, $sql);
  }
  catch (Exception $e){
      $error = $e->getMessage();
      echo $error;
      exit();
  }

  $_SESSION['Photo'] = $uploadfile;
  
  echo '<h3 class="fw-bold">Photo : </h3><img src="'.$_SESSION['Photo'].'" class="img-thumbnail" width="200px" height="200px">';
  echo '<br><br><a href=compte.php><button class="btn btn-primary">Page utilisateur</button></a></div></div>';
}
?>
