<?php
/* Permet la modification des publications après mise en ligne sur le réseau */
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
  $ID_Post = $_GET['ID_Post'];
  
  $sql = "SELECT *  FROM `post` WHERE ID_Post = '".$ID_Post."'";
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
      <h3>Description : </h3><textarea size="100" name="Desc" class="form-control" maxlength="75" style="width: 90%;height: 20%;">'.$data['Description'].'</textarea><br>
      <h3>Date : </h3><input type="date" size="50" name="Date" class="form-control"  style="width: 25%;height: 5%; value="'.$data['Date'].'"><br>
      <h3>Lieu : </h3><textarea size="100" name="Lieu" class="form-control" maxlength="75" style="width: 90%;height: 20%;">'.$data['Lieu'].'</textarea><br>
      <h3>Heure : </h3><input type="time" size="50" name="Heure" tyle="width: 25%;height: 5%class="form-control" value="'.$data['Heure'].'"><br><br>';
      echo "<div class='row'>";
      if($data['Privé'] == '1'){
        echo '<div class= "col-sm-2"><h5>Privé : </h5></div><div class= "col-sm-4"><input type="checkbox" id="prive" name="prive" class="form-control" checked style = " width:40%;height:40%"></div><br><br>';
    }else{
      echo '<div class= "col-sm-2"><h5>Privé : </h5></div><div class= "col-sm-4"><input type="checkbox" id="prive" name="prive" class="form-control"  style = " width:40%;height:40%"></div><br><br>';
    } 

    echo '</div></div>
    <div class=" col-md-4"><br><br>';
        if (pathinfo($data['Lien'], PATHINFO_EXTENSION) == 'mp4') {
            echo "<center><video src='".$data['Lien']."' controls width='90%' height=30%'></video></center>";
        } else {
            echo "<center><img src='".$data['Lien']."' alt='Image du post' class='img-fluid'></center>";
        }
        echo ' <br><center><input accept="Image/png, Video/*" type="file" id="photo" name="photo" style="display: none"><label for="photo" id="photo" class="btn btn-dark">Choisir un fichier</label></center>
    </div>  
  </div>
  <br><br><br><br>
  <button type="submit" name="soumettre" value="soumettre" class="btn btn-success">Valider les modifications</button></br>
  </form>
  <br><a href=compte.php><button class="btn btn-primary">retourner a mon compte</button></a>
  <br><br></div>';
  
  if(array_key_exists('soumettre',$_POST)){
    
    $Description = isset($_POST['Desc']) ? $_POST['Desc'] :'';
    $Date = isset($_POST['Date']) ? $_POST['Date'] :'';
    $Lieu = isset($_POST['Lieu']) ? $_POST['Lieu'] :'';
    $Heure = isset($_POST['Heure']) ? $_POST['Heure'] :'';
    $prive = isset($_POST["prive"]) ? $_POST["prive"] : "";
    if($prive){
      $prive = 1;
    }else{
        $prive = 0;
    }

    $uploaddir = 'documents/emploi/';
    $uploadfile = $uploaddir . basename($_FILES['photo']['name']);
    
    $file_extension = pathinfo($uploadfile, PATHINFO_EXTENSION);

    echo $file_extension; // affiche l'extension du fichier
    
    //move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile)
    if($uploadfile != $uploaddir){
        echo 'test';
    if ($file_extension == 'png'){
        echo 'test';
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
      $sql='UPDATE `post` SET Description = "'.$Description.'", Date = "'.$Date.'", Lieu = "'.$Lieu.'", Heure = "'.$Heure.'", Lien = "'.$uploadfile.'",Privé = "'.$prive.'" WHERE ID_Post = "'.$ID_Post.'"';
    }
    }else if($file_extension == 'mp4'){
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile)) {
            $Id_emetteur = $_SESSION['ID'];
            $sql = "INSERT INTO post (ID_Emetteur,Lien) VALUES ('$Id_emetteur','$uploadfile');";
            try{
                $result = mysqli_query($db_handle, $sql);
            }
            catch (Exception $e){
                $error = $e->getMessage();
                echo $error;
                exit();
            }
            $sql='UPDATE `post` SET Description = "'.$Description.'", Date = "'.$Date.'", Lieu = "'.$Lieu.'", Heure = "'.$Heure.'", Lien = "'.$uploadfile.'",Privé = "'.$prive.'"  WHERE ID_Post = "'.$ID_Post.'"';
        } else {
            echo "<br><h3 class='text-center'>Echec du téléchargement de la vidéo !<br></h3>";
            echo "<br><br><div class='mx-auto' style='width: 200px;'><a href=post_image.php><button class='btn btn-dark'>Retour à la page d'accueil</button></a></div><br><br>";
            exit();
        }
    }
    }
    else{
    $sql='UPDATE `post` SET Description = "'.$Description.'", Date = "'.$Date.'", Lieu = "'.$Lieu.'", Heure = "'.$Heure.'", Privé = "'.$prive.'" WHERE ID_Post = "'.$ID_Post.'"';
    }
    
    echo '<div class="container" id="color">';
    echo $sql;
    
    try{
      $result = mysqli_query($db_handle, $sql);
    }
    catch (Exception $e){
      $error = $e->getMessage();
      echo $error;
      exit();
    }

    header("Location: http://localhost/web/compte.php");

  }
}

?>
