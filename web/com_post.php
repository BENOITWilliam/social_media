<?php
/* Permet afficher le menu de l'ajout commentaire dans l'accueil */
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
    $ID_Post = $_GET['ID_Post'];

    $sql_relation = "SELECT * FROM `relation` WHERE ID_demandeur_ami = ".$_SESSION['ID']."";
    $result_relation = mysqli_query($db_handle, $sql_relation);
    $i = 0;

    while($amis = mysqli_fetch_assoc($result_relation)){
        $list_amis[$i] = "".$amis['ID_ami']."";
        $i +=1;
    }
    if(is_null($list_amis)){$list_amis[0]='0';}

    echo '<div class="container" id="color">';
    $query = "SELECT * FROM post WHERE ID_Post = '".$ID_Post."' ";
    $result = mysqli_query($db_handle, $query);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        if ($row) {
            $id_reac = $row['ID_reac'];
            $lien = $row['Lien'];
            $date = $row['Date'];
            $heure = $row['Heure'];
            $lieu = $row['Lieu'];
            $description = $row['Description'];
            $prive = $row['Privé'];
            $ID_Emetteur = $row['ID_Emetteur'];
        } else {
            echo "No reacs found.";
        }
    } else {
        echo "Error retrieving reacs.";
    }

    $sql = "SELECT Photo,Pseudo FROM `utilisateur` WHERE ID = ".$ID_Emetteur."";
    try{
        $result = mysqli_query($db_handle, $sql);
    }
    catch (Exception $e){
        $error = $e->getMessage();
        echo $error;
        exit();
    }
    $user_data = mysqli_fetch_assoc($result);

    $like = 0;
    $reaction_sql = "SELECT COUNT(*) AS total FROM `reaction` WHERE ID_Post = '" . $ID_Post . "' AND aime = 1";
    try {
        $reaction_result = mysqli_query($db_handle, $reaction_sql);
        $reaction_data = mysqli_fetch_assoc($reaction_result);
        $like = $reaction_data['total'];
    } catch (Exception $e) {
        $error = $e->getMessage();
        echo $error;
        exit();
    }

    echo '<br><h5><img src="' . $user_data['Photo'] . '" class="rounded-circle" width="50px" height="50px" alt="User Photo"> ' . $user_data['Pseudo'] . '</h5>
    <center><h3 class="card-title">La publication :</h3></center>';
    if (pathinfo($lien, PATHINFO_EXTENSION) == 'mp4') {
        echo "<center><video src='$lien' controls width='500' height='400'></video></center>";
    } else {
        echo "<div class='text-center'><img src='$lien' alt='Image du reac' class='img-fluid'></div>";
    }
    echo '<br><div class="row">
        <div class="col-sm-4">';
        if($description){
            echo "<center><h5>Description: </h5>" . $description . "</center><br>";
        }
    echo '</div><div class="col-sm-4">';
        if($date){
            echo "<center><h5>Date: </h5>" . $date . "</center><br>";
        }
        if($heure){
            echo "<center><h5>Heure: </h5>" . $heure . "</center><br>";
        }
    echo '</div><div class="col-sm-4">';
        if($lieu){
            echo "<center><h5>Lieu: </h5>" . $lieu . "</center><br>";
        }
            
    echo '</div></div>';
    echo "<center><h5>Nombre de likes: </h5>" . $like . "</center><br>";

    $sql_reac = "SELECT * FROM reaction WHERE ID_Post = '".$ID_Post."' AND Description IS NOT NULL";
    $result_reac = mysqli_query($db_handle, $sql_reac);

    while ($reac = mysqli_fetch_assoc($result_reac)) {

        $sql_user = "SELECT * FROM utilisateur WHERE ID = '".$reac['ID_Emetteur']."'";
        $result_user = mysqli_query($db_handle, $sql_user);
        $user = mysqli_fetch_assoc($result_user);

        if (in_array($reac['ID_Emetteur'],$list_amis)){echo '<div class="post-amis">';}
        else if ($reac['ID_Emetteur'] == $_SESSION['ID']){echo '<div class="post-vous">';}
        else{echo '<div class="post">';}

        echo '<div class="col-sm-9">
        <div class>
        <div class>
            <h5><img src="' . $user['Photo'] . '" class="rounded-circle" width="50px" height="50px" alt="User Photo"> ' . $user['Pseudo'] . '</h5>
            <div class>
            <p>' . $reac['Description'] . '</p>
            </div>
            </div>
            </div>
            </div>
        </div>';

    }

    $sql_reac = "SELECT * FROM reaction WHERE ID_Post = '".$ID_Post."' AND Description IS NOT NULL AND ID_Emetteur = '".$_SESSION['ID']."'";
    if(mysqli_query($db_handle, $sql_reac)->num_rows == 0){
    
    echo '<div class="comment-section">
        <h4>Ajouter un commentaire :</h4>
        <form method="post" action="ajout_com.php?ID_Post='.$ID_Post.'">
            <textarea class="form-control" name="commentaire" rows = 4 placeholder="Entrez votre commentaire ici"></textarea>
            <br>
            <input type="submit" class="btn btn-success" value="Envoyer commentaire">
        </form>
        <br>
    </div>';
    }
    echo '<a href="accueil.php#'.$ID_Post.'"><button class="btn btn-primary">Revenir à l\'accueil</button></a>
    <br><br>
    </div>';
}
?>