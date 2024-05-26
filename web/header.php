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

echo "<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css'>";
echo '<body>';

if ($db_found) {
    $pseudo = isset($_POST['pseudo']) ? $_POST['pseudo'] :'';
    $mdp = isset($_POST['mdp']) ? $_POST['mdp'] :'';

    if(empty($pseudo) || empty($mdp)){
        if(empty($pseudo)){echo 'Aucun Pseudo rentré</br>';}
        if(empty($mdp)){echo 'Aucun MDP rentré</br>';}

        echo '</br><a href=index.html><button class="btn btn-dark">Page Connexion</button></a>';
        exit();
    }
    
    $sql = "SELECT * FROM `utilisateur` WHERE Pseudo LIKE '$pseudo'";
    try{
        $result = mysqli_query($db_handle, $sql);
    }
    catch (Exception $e){
        $error = $e->getMessage();
        echo $error;
        exit();
    }


    $data = mysqli_fetch_assoc($result);

    if($data['MDP'] == $mdp){

        $_SESSION['ID'] = $data['ID'];
        $_SESSION['Pseudo'] = $data['Pseudo'];
        $_SESSION['MDP'] = $data['MDP'];
        $_SESSION['Image'] = $data['Image'];
        $_SESSION['Email'] = $data['Email'];
        $_SESSION['Photo'] = $data['Photo'];
        $_SESSION['NC'] = $data['NC'];

        echo 'connecté<meta http-equiv="refresh" content="0; url=http://localhost/web/compte.php">';

        exit();
    }
    else{echo "L'utilisateur rentré ou le mot de passe n'est pas le bon.";echo '</br><a href=index.html><button class="btn btn-dark">Page Connexion</button></a>';
        echo '</body>';}
}
?>