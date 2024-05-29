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

  echo '<div class="container" id="color">
  <form enctype="multipart/form-data" method="POST">
  <h3 class="fw-bold">Description :</h3><br>
  <textarea size="100" name="Description" class="form-control" style="width: 1100px;height: 400px;">'.$_SESSION['Description'].'</textarea><br><br>
  <button type="submit" name="soumettre" value="soumettre" class="btn btn-success">Enregistrer la description</button><br><br>
  </form>
  </div>';

  if(array_key_exists('soumettre',$_POST)){
        
    $Description = isset($_POST['Description']) ? $_POST['Description'] :'';
    $Id = $_SESSION['ID'];
    
    $sql = 'UPDATE `utilisateur` SET Description = "'.$Description.'" WHERE ID = "'.$Id.'"';

    try{
      $result = mysqli_query($db_handle, $sql);
    }
    catch (Exception $e){
      $error = $e->getMessage();
      echo $error;
      exit();
    }

    $_SESSION['Description'] = $Description;

    header("Location: http://localhost/web/compte.php");

  }
}

?>
