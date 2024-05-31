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

require("importation.php");
importation();


if ($db_found) {
    echo '<br><br><br><div class="container" id="color"><h1> rechercher un profil : </h1>
    <form method="POST">
    <input type="text" name="recherche" placeholder="recherche" class="form-control"/> <br>
    <button type="submit" name="soumettre" value="soumettre" class="btn btn-primary">Rechercher</button></br>
    <button type="submit" name="soumettre" value="soumettre" class="btn btn-primary">Rechercher</button></br>
    </form>
    <br>
    </div>';
  
    $sql = "SELECT * FROM `utilisateur`";
  
    if(array_key_exists('soumettre',$_POST)){
        $recherche = isset($_POST['recherche']) ? $_POST['recherche'] :'';
    
        $sql="SELECT * FROM `utilisateur` WHERE Pseudo LIKE '%$recherche%'";
    }
  
    try{
        $result = mysqli_query($db_handle, $sql);
    }
    catch (Exception $e){
        $error = $e->getMessage();
        echo $error;
        exit();
    }
  
    echo '<br><br><br><div class="container w-25" id="color">';
  
    echo "<table class='table'> <tbody>";
  
    while ($data = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo '<td><center><img src="'.$data['Photo'].'" class="img-thumbnail" width="100px" height="100px"></center></td>';
        echo "
        <td>
        <a href='chat.php?ID=".$data['ID']."' style='color:black;'>
        ". $data['Pseudo']."
        </a>
        </td>";
        echo "</tr>";
    }
    echo "</tbody> </table></div>";

}
?>
