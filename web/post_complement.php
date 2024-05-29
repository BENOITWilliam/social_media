<?php

$database = "likedin";
session_start();

echo "<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css'>
<link rel='stylesheet' href='style.css'>";
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



if ($db_found) {
    $uploaddir = 'documents/post/';
    $uploadfile = $uploaddir . basename($_FILES['photo']['name']);

    $Id = $_SESSION['ID'];

    $taille = getimagesize($_FILES['photo']['tmp_name']);
    echo '<div class="container" id="color">';
    if($taille[2]==2){
        $im = imagecreatefromjpeg($_FILES['photo']['tmp_name']);
        $im_crop = imagecreatetruecolor(250, 200);
        imagecopyresampled($im_crop, $im, 0, 0, 0, 0, 250, 200, $taille[0], $taille[1]);
        if(imagejpeg($im_crop, 'documents/post/' . $_FILES['photo']['name'], 90))
        {
            echo "<br><h3 class='text-center'>Le contenu a bien été chargé !<br></h3>";
        }
        else
        {
            echo "<br><h3 class='text-center'>Echec du téléchargement de l'image !<br></h3>";
        }
    }
    if($taille[2]==3){
        $im = imagecreatefrompng($_FILES['photo']['tmp_name']);
        $im_crop = imagecreatetruecolor(250, 200);
        imagecopyresampled($im_crop, $im, 0, 0, 0, 0, 250, 200, $taille[0], $taille[1]);
        if(imagepng($im_crop, 'documents/post/' . $_FILES['photo']['name'], 9))
        {
            echo "<br><h3 class='text-center'>Le contenu a bien été chargé !<br></h3>";
        }
        else
        {
            echo "<br><h3 class='text-center'>Echec du téléchargement de l'image !<br></h3>";
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

    $sql = "SELECT ID_Emetteur,ID_Post,Lien  FROM post where ID_Emetteur = '$Id_emetteur' ORDER BY ID_Post DESC LIMIT 1;";
    $result = mysqli_query($db_handle, $sql);   
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $id_post = $row['ID_Post'];
            $id_emetteur = $row['ID_Emetteur'];
            $lien = $row['Lien'];
            echo "<h3 class='text-center'>ID du post: $id_post</h3>";
            echo "<h3 class='text-center'>ID de l'émetteur: $id_emetteur</h3>";
            echo "<div class='text-center'><img src='$lien' alt='Image du post' class='img-fluid'></div>";
        }   
    } else {
        echo "<br><h3 class='text-center'>Erreur lors de la récupération du post !<br></h3>";
    }
    echo '<div class="row">
            <div class="col-md-100 offset-md-5">
            <h3 class="card-title">Créer une publication</h3>
            <form method="POST" action="post_confirmation.php">
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" ><br><br>
                <label for="heure">Heure:</label>
                <input type="time" id="heure" name="heure" ><br><br>
                <label for="lieu">Lieu:</label> 
                <input type="text" id="lieu" name="lieu" ><br><br>
                <label for="description">description (maximum 200 caractères):</label>
                <br><textarea id="description" name="description" maxlength="200" style="resize: both;"></textarea><br><br>
                <button type="submit" name="confirmer" value="confirmer" class="btn btn-success">Valider les modifications</button></br></br>
            </form>
            </div>
        </div>';
}
?>