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