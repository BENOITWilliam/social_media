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

$iddetinataire= $_GET['ID'];
echo"<form method='POST'><input type='hidden' id= 'iddetinataire' name='iddetinataire' value='".$_GET['ID']."'>";
if ($iddetinataire==$_SESSION['ID'])
{
    ?> <meta http-equiv="refresh" content="0; url=http://localhost/web/reseau.php"><?php
}
else
{   if ($db_found)
    { if (isset($_GET['ID']) AND !empty($_GET['ID']))
        {
            $sql_user="SELECT * FROM utilisateur WHERE ID=".$iddetinataire;
            try{
                $result_user = mysqli_query($db_handle, $sql_user);
            }
            catch (Exception $e){
                $error = $e->getMessage();
                echo $error;
                exit();
            }
