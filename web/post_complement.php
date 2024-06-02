<?php
/* Fichier permettant à l'utilisateur d'ajouter des détails à sa publication */
$database = "likedin";
session_start();

require("importation.php");
importation();

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



if ($db_found) {
    
    $Id_emetteur = $_SESSION['ID'];
    echo '<div class="container" id="color">';
    $sql = "SELECT ID_Emetteur,ID_Post,Lien  FROM post where ID_Emetteur = '$Id_emetteur' ORDER BY ID_Post DESC LIMIT 1;";
    
    $result = mysqli_query($db_handle, $sql);   
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $id_post = $row['ID_Post'];
            $id_emetteur = $row['ID_Emetteur'];
            $lien = $row['Lien'];
            if (pathinfo($lien, PATHINFO_EXTENSION) == 'mp4') {
                echo "<div class='text-center'><video src='$lien' controls></video></div>";
            } else {
                echo "<div class='text-center'><img src='$lien' alt='Image du post' class='img-fluid'></div>";
            }
    }
    echo '<div class="row">
            <div class="col-md-100 offset-md-5">
            <h3 class="card-title">rajouter des informations</h3>
            <form method="POST" action="post_confirmation.php">
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" ><br><br>
                <label for="heure">Heure:</label>
                <input type="time" id="heure" name="heure" ><br><br>
                <label for="lieu">Lieu:</label> 
                <input type="text" id="lieu" name="lieu" ><br><br>
                <label for="description">description (maximum 200 caractères):</label>
                <br><textarea id="description" name="description" maxlength="200" style="resize:none;"></textarea><br><br>
                <label for="prive">Privé:</label>
                <input type="checkbox" id="prive" name="prive"><br><br>
                <button type="submit" name="confirmer" value="confirmer" class="btn btn-success">Valider les modifications</button></br></br>
            </form>
            <form enctype="multipart/form-data" method="POST">
                <button type="submit" name="annuler" value="annuler" class="btn btn-primary">annuler la publication</button></br></br>
            </form>
            </div>
        </div>';

        if(array_key_exists('annuler',$_POST)){
            $sql_delete = "DELETE FROM post WHERE ID_Post = '$id_post'";
            $result_delete = mysqli_query($db_handle, $sql_delete);
            if ($result_delete) {
                echo "<br><h3 class='text-center'>Le post a été supprimé avec succès !<br></h3>";
                echo "<br><br><div class='mx-auto' style='width: 200px;'><a href=post_image.php><button class='btn btn-dark'>Retour à la publi</button></a></div><br><br>";
            } else {
                echo "<br><h3 class='text-center'>Erreur lors de la suppression du post !<br></h3>";
                echo "<br><br><div class='mx-auto' style='width: 200px;'><a href=post_image.php><button class='btn btn-dark'>Retour à la publi</button></a></div><br><br>";
            }

        }
    }
}

?>