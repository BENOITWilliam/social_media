<?php
/* Affiche les offres d'emploi et permet de faire la sélection */
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

    echo '<br><br><br><div class="container" id="color"><h1>Recherche travail :</h1><br>
    <form method="POST">
    <input type="text" name="recherche" placeholder="recherche" class="form-control"/><br><br>
    <button type="submit" name="soumettre" value="soumettre" class="btn btn-primary">Rechercher</button></br>
    </form>
    <br>
    </div>';

    $sql = "SELECT *  FROM `emploi`";

    if(array_key_exists('soumettre',$_POST)){
        $recherche = isset($_POST['recherche']) ? $_POST['recherche'] :'';
    
        $sql="SELECT * FROM `emploi` WHERE Nom LIKE '%$recherche%'";
    }

    try{
        $result = mysqli_query($db_handle, $sql);
    }
    catch (Exception $e){
        $error = $e->getMessage();
        echo $error;
        exit();
    }

    echo '<br><br><br><div class="container-sm" id="color">';

    echo "<table class='table'> <thead class='thead-dark'> <tr> <th scope='col'>Nom</th> <th scope='col'>Description</th> <th scope='col'>Image</th> 
    <th scope='col'>Regarder</th> <tbody>";

    while ($data = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $data['Nom'] . "</td>";
        echo "<td> " . $data['Desc_courte'] . "</td>";
        echo '<td><img src="'.$data['Image'].'" class="img-thumbnail" width="100px" height="100px"></td>';
        echo '<td><a href="regarder_emploi.php?ID_Emploi='.$data['ID_Emploi'].'"><button type="submit" name="reg_'.$data['ID_Emploi'].'" class="btn btn-success" value="Regarder">Regarder</button></a>';
        echo "</tr>";
    }
    echo "</tbody> </table></div>";
}

?>
