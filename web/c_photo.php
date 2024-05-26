<?php

$database = "likedin";
session_start();

echo "<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css'>";
echo "<style>body { background-image : url('".$_SESSION['Image']."');background-size: cover;}</style>";

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

echo '<style>#color{background-color: white;}
    .center {position: relative;top: 50%; left: 50%;transform: translate(-50%, -50%);}
    </style>
    <div class="center"><div class="container" id="color">';

if ($db_found) {
    $uploaddir = 'documents/photo/';
    $uploadfile = $uploaddir . basename($_FILES['photo']['name']);
    $Id = $_SESSION['ID'];

    if(move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile))
    {
        echo "<br><h3 class='text-center'>La photo de profil à bien été modifié !<br></h3>";
    }
    else
    {
        echo "<br><h3 class='text-center'>Echec du téléchargement de l'image !<br></h3>";
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
    echo '<br><br><a href=compte.php><button class="btn btn-dark">Page utilisateur</button></a></div></div>';
}
?>