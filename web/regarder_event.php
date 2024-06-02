<?php
/* Permet de regarder l'événement choisi */
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
    $ID_Event = $_GET['ID_Event'];

    $sql = "SELECT *  FROM `event` WHERE ID_Event = '".$ID_Event."'";

    try{
        $result = mysqli_query($db_handle, $sql);
    }
    catch (Exception $e){
        $error = $e->getMessage();
        echo $error;
        exit();
    }

    $data = mysqli_fetch_assoc($result);

    echo '<div class="container" id="color">';

    echo '<div class="row g-0">
        <div class="col-sm-6 col-md-8"><br><br>
        <h3>Nom de l\'event  :</h3><h4> '.$data['Nom'].'</h4><br><br>
        <h3 class="fw-bold">Description : </h3><h4>'.$data['Description'].'</h4><br><br>
        </div>
        <div class="col-6 col-md-4">
            <br><h3 class="fw-bold">Photo : </h3><img src="'.$data['Lien'].'" class="img-thumbnail" width="200px" height="200px"><br>
            <h3>Date :</h3><h4>'.date("d-m-Y", strtotime($data['Date'])).'</h4><br>
            <h3>Heure :</h3><h4>'.$data['Heure'].'</h4><br>
            <h3>Lieu :</h3><h4>'.$data['Lieu'].'</h4><br>
        </div>
    </div>
    <br><a href=menu_event.php><button class="btn btn-primary">Page des événements</button></a><br><br></div>';
}

?>