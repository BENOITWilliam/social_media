<?php
/* Assure la bonne déconection en mettant l'ensemble des variable session à NULL  */
session_start();

$_SESSION['ID'] = NULL;
$_SESSION['Pseudo'] = NULL;
$_SESSION['MDP'] = NULL;
$_SESSION['Image'] = NULL;
$_SESSION['Email'] = NULL;
$_SESSION['Photo'] = NULL;
$_SESSION['NC'] = NULL;
$_SESSION['Description'] = NULL;

echo'<meta http-equiv="refresh" content="0; url=http://localhost/web/index.html">';
?>