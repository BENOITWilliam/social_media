<?php 
$database = "likedin";
session_start();
$iddetinataire = $_GET['ID'];

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
$recup_conv="SELECT * FROM message WHERE (id_auteur = '" .$iddetinataire."' AND id_destinataire='".$_SESSION['ID']."') OR (id_auteur = '" .$_SESSION['ID']."' AND id_destinataire='".$iddetinataire."')";
try{
    $result_recup = mysqli_query($db_handle, $recup_conv);
