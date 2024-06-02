<?php
/* Fichier permettant la première étape de la publication (choisir son fichier photo, vidéo) */
$database = "likedin";
session_start();

try {
    $db_handle = mysqli_connect('localhost', 'root', 'root');
} catch (Exception $e) {
    $error = $e->getMessage();
    echo $error;
    exit();
}

try {
    $db_found = mysqli_select_db($db_handle, $database);
} catch (Exception $e) {
    $error = $e->getMessage();
    echo $error;
    exit();
}

require("importation.php");
importation();

if ($db_found) {
    echo '<div class="container" id="color">
    <div class="row">
        <div class="col-md-6 offset-md-3">
        <h3 class="card-title">Créer une publication</h>
            <br><h6 class="card-subtitle mb-2 text-muted">veuillez choisir le fichier à publier (photo ou vidéo)</h6>
        <form enctype="multipart/form-data" method="POST">
            <input accept="Image/png,Image/jpeg, Video/*" type="file" id="photo" required name="photo" style="display: none"><label for="photo" id="photo" class="btn btn-dark">Choisir un fichier</label><br><br>
            <button type="submit" name="soumettre" value="soumettre" class="btn btn-primary">Soumettre</button></br></br>
        </form>
        </div>
    </div>';

  if(array_key_exists('soumettre',$_POST)){


    $uploaddir = 'documents/post/';
    $uploadfile = $uploaddir . basename($_FILES['photo']['name']);
    $filename = $_FILES['photo']['name'];
    $file_extension = pathinfo($filename, PATHINFO_EXTENSION);

    $sql = "SELECT * FROM post WHERE lien LIKE '$uploadfile'";
    echo '<div class="container">';
    try{
        $result = mysqli_query($db_handle, $sql);
    }
    catch (Exception $e){
        $error = $e->getMessage();
        echo $error;
        exit();
    }
    while ($data= mysqli_fetch_assoc($result)) {
      echo "<h3>un post avec le même attaché existe déjà, nous n'autorisons pas les republication ici</h3>";
      echo "<br><br><div class='mx-auto' style='width: 200px;'><a href=accueil.php><button class='btn btn-dark'>Retour à la page d'accueil</button></a></div><br><br>";
      exit();
    }

    $Id = $_SESSION['ID'];
    $taille = getimagesize($_FILES['photo']['tmp_name']);
    if ($taille[2]==2 || $taille[2]==3){
        
        if($taille[2]==2){
            $im = imagecreatefromjpeg($_FILES['photo']['tmp_name']);
            $im_crop = imagecreatetruecolor(360, 200);
            imagecopyresampled($im_crop, $im, 0, 0, 0, 0, 360, 200, $taille[0], $taille[1]);
            if(imagejpeg($im_crop, 'documents/post/' . $_FILES['photo']['name'], 90))
            {
            }
            else
            {
            echo "<br><h3 class='text-center'>Echec du téléchargement de l'image !<br></h3>";
            echo "<br><br><div class='mx-auto' style='width: 200px;'><a href=post_image.php><button class='btn btn-dark'>Retour à la page d'accueil</button></a></div><br><br>";
            exit();
            }
        }
        if($taille[2]==3){
            $im = imagecreatefrompng($_FILES['photo']['tmp_name']);
            $im_crop = imagecreatetruecolor(360, 200);
            imagecopyresampled($im_crop, $im, 0, 0, 0, 0, 360, 200, $taille[0], $taille[1]);
            if(imagepng($im_crop, 'documents/post/' . $_FILES['photo']['name'], 9))
            {
            }
            else
            {
            echo "<br><h3 class='text-center'>Echec du téléchargement de l'image !<br></h3>";
            echo "<br><br><div class='mx-auto' style='width: 200px;'><a href=post_image.php><button class='btn btn-dark'>Retour à la page d'accueil</button></a></div><br><br>";
            exit();
            }
        }
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
        echo '<meta http-equiv="refresh" content="0; url=post_complement.php">';
    } else if($file_extension == 'mp4'){
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
        echo '<meta http-equiv="refresh" content="0; url=post_complement.php">';
    } else {
        echo "<br><h3 class='text-center'>Echec du téléchargement de la vidéo !<br></h3>";
        echo "<br><br><div class='mx-auto' style='width: 200px;'><a href=post_image.php><button class='btn btn-dark'>Retour à la page d'accueil</button></a></div><br><br>";
        exit();
    }
}
}
}
?>