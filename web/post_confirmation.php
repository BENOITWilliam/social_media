<?php
/* Fichier permettant de confirmer à l'utilisateur la bonne publication sur le site */
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


require("importation.php");
importation();

if ($db_found) {
    echo '<div class="container" id="color">';
    $date = isset($_POST["date"]) ? $_POST["date"] : "";
    $heure = isset($_POST["heure"]) ? $_POST["heure"] : "";
    $lieu = isset($_POST["lieu"]) ? $_POST["lieu"] : "";
    $description = isset($_POST["description"]) ? $_POST["description"] : "";
    $prive = isset($_POST["prive"]) ? $_POST["prive"] : "";
    $query = "SELECT ID_Post, Lien FROM post WHERE ID_Emetteur = '".$_SESSION['ID']."' ORDER BY ID_Post DESC LIMIT 1";
    $result = mysqli_query($db_handle, $query);
    if($prive){
        $prive = 1;
    }else{
        $prive = 0;
    }

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            $id_post = $row['ID_Post'];
            $lien = $row['Lien'];
        } else {
            echo "No posts found.";
        }
    } else {
        echo "Error retrieving posts.";
    }

    $sql = "UPDATE post SET Date = '".$date."', Heure = '".$heure."', Lieu = '".$lieu."', Description = '".$description."',Privé = '".$prive."' WHERE ID_Post = '".$id_post."';";
        try{
            $result = mysqli_query($db_handle, $sql);
        }
        catch (Exception $e){
            $error = $e->getMessage();
            echo $error;
            exit();
        }

        echo '<br><br><center><h2 class="card-title">Voici la publication créé :</h2><center><br>';
        if (pathinfo($lien, PATHINFO_EXTENSION) == 'mp4') {
            echo "<center><div class='text-center'><video src='$lien' controls width='500' height='400'></video></div></center>";
        } else {
            echo "<center><div class='text-center'><img src='$lien' alt='Image du post' class='img-fluid'></div></center>";
        }
        echo '<br><br><div class="row">
                <div class="col-sm-4">';
        if($description){
            echo "<h5>Description: </h5>" . $description . "<br>";
        }
        echo '</div>
        <div class="col-sm-4">';
        if($date){
            echo "<h5>Date:</h5>" . $date . "<br>";
        }
        if($heure){
            echo "<br><h5>Heure:</h5>" . $heure . "<br>";
        }
        echo '</div>
        <div class="col-sm-4">';
        
        if($lieu){
            echo "<h5>Lieu: </h5>" . $lieu . "<br>";
        }
                
        echo '</div></div><br><br>';
        echo '<h5>Statut :</h5>';
        if($prive==0){echo 'Public 📢';}
        else{echo 'Privé 🔒';}
        echo '<br><br><br>
        <center><a href="accueil.php"><button type="button" class="btn btn-primary">Page Accueil</button></a></center>
        <br>
        </div>';
}
?>