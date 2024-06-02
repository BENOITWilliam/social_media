<?php

/* Permet l'ajout d'un commentaire à une publication */
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

$commentaire = isset($_POST["commentaire"]) ? $_POST["commentaire"] : "";
echo $commentaire;
echo "  id post :";
echo $_GET['ID_Post'];
$sql = 'UPDATE reaction SET description = "' . $commentaire . '" WHERE ID_Post = "' . $_GET['ID_Post'] . '" AND ID_Emetteur = "'. $_SESSION['ID'].'";';
echo $sql;
try {
    echo "test";
    $result5 = mysqli_query($db_handle, $sql);
    echo "test2";
} catch (Exception $e) {
$error = $e->getMessage();
echo $error;
exit();
}

echo '<meta http-equiv="refresh" content="0; url=com_post.php?ID_Post='.$_GET['ID_Post'].'">';


?>