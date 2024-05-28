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

if ($db_found) {

    if ($db_found) {
      
        echo '<div class="container" id="color">';
      
        echo '<form enctype="multipart/form-data" method="POST"><div class="row g-0">
          <div class="col-sm-6 col-md-8"><br>
            <h3>Titre de l\'emploi :</h3><h4> <input type="text" class="form-control" maxlength="30" style="width: 700px;" name="Nom" value=""/></h4><br><br>
            <h3 class="fw-bold">Description courte : </h3><textarea size="100" name="Desc_courte" class="form-control" maxlength="75" style="width: 700px;height: 100px;"></textarea><br><br>
            <h3 class="fw-bold">Description : </h3><textarea size="100" name="Description" class="form-control" style="width: 700px;height: 400px;"></textarea><br><br>
          </div>
          <div class="col-6 col-md-4">
              <br><h3 class="fw-bold">Photo : </h3><img src="" class="img-thumbnail" width="200px" height="200px"><br>
              <input accept="Image/png, Image/jpeg" type="file" id="photo" name="photo" style="display: none"><label for="photo" id="photo" class="btn btn-dark">Choisir un fichier</label>
          </div>
        </div>
        <button type="submit" name="soumettre" value="soumettre" class="btn btn-success">Créer l\'offre d\'emploi</button></br>
        </form><br><a href=admin_menu_emploi.php><button class="btn btn-primary">Page de modification des offres d\'emploi</button></a>
        <br><br></div>';
        
        if(array_key_exists('soumettre',$_POST)){
          
          $Nom = isset($_POST['Nom']) ? $_POST['Nom'] :'';
          $Desc_courte = isset($_POST['Desc_courte']) ? $_POST['Desc_courte'] :'';
          $Description = isset($_POST['Description']) ? $_POST['Description'] :'';
      
          $uploaddir = 'documents/emploi/';
          $uploadfile = $uploaddir . basename($_FILES['photo']['name']);
      
          
          if($uploadfile != $uploaddir){
            $taille = getimagesize($_FILES['photo']['tmp_name']);
        
            //move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile)
        
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
            $sql = 'INSERT INTO `emploi` (Nom,Desc_courte,Description,Image) VALUES ("'.$Nom.'","'.$Desc_courte.'","'.$Description.'","'.$uploadfile.'")';
          }
          else{$sql = 'INSERT INTO `emploi` (Nom,Desc_courte,Description,Image) VALUES ("'.$Nom.'","'.$Desc_courte.'","'.$Description.'","documents/emploi/emploi")';}

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
    
}

?>