<?php
/* Permet de regarder l'offre d'emploi choisi */
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
    $ID_Emploi = $_GET['ID_Emploi'];

    $sql = "SELECT *  FROM `emploi` WHERE ID_Emploi = '".$ID_Emploi."'";

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
        <div class="col-sm-6 col-md-8"><br>
        <h3>Titre de l\'emploi :</h3><h4> '.$data['Nom'].'</h4><br><br>
        <h3 class="fw-bold">Description courte : </h3><h4>'.$data['Desc_courte'].'</h4><br><br>
        <h3 class="fw-bold">Description : </h3><h4>'.$data['Description'].'</h4><br><br>
        </div>
        <div class="col-6 col-md-4">
            <br><h3 class="fw-bold">Photo : </h3><img src="'.$data['Image'].'" class="img-thumbnail" width="200px" height="200px"><br>
        </div>
    </div>
    <br><a href=offre_emploi.php><button class="btn btn-primary">Page des offres d\'emploi</button></a><br><br></div>';
}

?>
