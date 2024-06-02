<?php
/* Ce fichier prend en charge l'inscription d'un nouveau membre au réseau */
$database = "likedin";
$erreur = false;
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

echo "<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css'>
<link rel='stylesheet' href='style1.css'>";
echo "<style>body {background-image : url('documents/site/fond.jpg');background-size: cover;background-attachment: fixed;}</style>";
echo '<body>';

if ($db_found) {
    $mail = isset($_POST['adressemail']) ? $_POST['adressemail'] :'';
    $pseudo = isset($_POST['pseudo']) ? $_POST['pseudo'] :'';
    $mdp = isset($_POST['mdp']) ? $_POST['mdp'] :'';

    echo '<div class="error-container">';

    if(empty($mail) || empty($pseudo) || empty($mdp)){
        $erreur = true;
        if(empty($mail)){echo '<p class="error-message">Veuillez saisir une adresse mail</p>';}
        if(empty($pseudo)){echo '<p class="error-message">Veuillez saisir un pseudo</p>';}
        if(empty($mdp)){echo '<p class="error-message">Veuillez saisir un mot de passe</p>';}
    }

    // check si le pseudo existe déjà
    $sql = "SELECT * FROM `utilisateur` WHERE Pseudo LIKE '".$pseudo."'";
    $result = mysqli_query($db_handle, $sql);
    $res1 = mysqli_num_rows($result);
    if ( ($res1) > 0) {
        $erreur = true;
        echo '<p class="error-message">Ce pseudo existe déjà</p>';
    }

    // check si le mail existe déjà
    $sql = "SELECT * FROM `utilisateur` WHERE Email Like '".$mail."'";
    $result = mysqli_query($db_handle, $sql);
    $res2 = mysqli_num_rows($result);
    if ( ($res2) > 0) {
        $erreur = true;
        echo '<p class="error-message">Ce mail est déjà utilisé</p>';
    }

    if (($erreur) == true) {
        echo '</br><a href=crea.html><button class="btn btn-dark">Page De Création De Compte</button></a>';
    }
    

    /*$sql = "SELECT MAX(id) AS max_id FROM utilisateur";
    $resultid = mysqli_query($db_handle, $sql);
    $new_id = $resultid + 1;*/

    // Insert new user into the database with the new id
    if (!empty($mail) && !empty($pseudo) && !empty($mdp) && ($res1) == 0 && ($res2) == 0){
        $sql = "INSERT INTO `utilisateur` (Pseudo, Email, MDP,NC) VALUES ('".$pseudo."','".$mail."','".$mdp."','0')";

        try{
            $result = mysqli_query($db_handle, $sql);
          }
          catch (Exception $e){
            $error = $e->getMessage();
            echo $error;
            exit();
        }    
    echo '<div class="bienvenue-container">';
    echo '<p class="bienvenue-message">Bienvenue chez nous!</p></br>';
    echo '</br><a href=index.html><button class="btn btn-dark">Continuer en vous connectant</button></a>';
    }

}
?>
