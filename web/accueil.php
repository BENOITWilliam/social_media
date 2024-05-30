<?php

$database = "likedin";
session_start();
//
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

    echo '<div class="container" id="color"><h1>Connecté</h1>';
    echo $_SESSION['ID'].'</div>';
}

?>
