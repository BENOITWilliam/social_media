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

echo "<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css'>";
echo '<body>';

if ($db_found) {

    echo "<style>body { background-image : url('".$_SESSION['Image']."');background-size: cover;}</style>";

    echo '<div class="container" id="color"><ul class="nav justify-content-center"><ul class="nav nav-pills">
    <li class="nav-item">
      <a class="nav-link active" aria-current="page" href="compte.php">Mon Compte</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Link</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="#">Link</a>
    </li>
    <li class="nav-item">
      <a class="nav-link disabled" aria-disabled="true">Disabled</a>
    </li>
    </ul></ul></div>';

    echo '<style>#color{background-color: white;}</style>
    <h1>Mon compte</h1><br>
    <div class="container" id="color">
    <div class="row g-0">
      <div class="col-sm-6 col-md-8"><br><br>
        <h3 class="fw-bold">Pseudo : </h3><h4>'.$_SESSION['Pseudo'].'</h4><br><br>
        <h3 class="fw-bold">Adresse mail : </h3><h4>'.$_SESSION['Email'].'</h4><br><br>
        <h3 class="fw-bold">Image de fond : <br></h3>
        <form enctype="multipart/form-data" method="POST" action="c_fond.php">
            <input accept="Image/png, Image/jpeg" type="file" id="fond" name="fond" ><br><br>
            <button type="submit" name="soumettre" value="soumettre" class="btn btn-primary">Soumettre</button></br></br>
        </form>
      </div>
      <div class="col-6 col-md-4">
          <h3 class="fw-bold">Photo : </h3><img src="'.$_SESSION['Photo'].'" class="img-thumbnail" width="200px" height="200px"><br>
          <form enctype="multipart/form-data" method="POST" action="c_photo.php">
            <input accept="Image/png, Image/jpeg" type="file" id="photo" name="photo" ><br><br>
            <button type="submit" name="soumettre" value="soumettre" class="btn btn-primary">Soumettre</button></br></br>
          </form>
      </div>
    </div>
    </div>';


    echo '</br><a href=index.html><button class="btn btn-dark">Se déconnecter</button></a>';
    echo '</body>';
}
?>