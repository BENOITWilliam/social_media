<?php
/* Doonne accès à tous ses événements et donne accès aux menu de modification ajout ou suppression */
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
    echo '<br><br><br><div class="container" id="color"><h1>Recherche événement :</h1><br>
  <form method="POST">
  <input type="text" name="recherche" placeholder="recherche" class="form-control"/><br><br>
  <div class="row">
    <div class="col-sm-1">
      <button type="submit" name="soumettre" value="soumettre" class="btn btn-primary">Rechercher</button></br>
    </div></form>
  </div>
  <br><a href="ajouter_event.php"><button class="btn btn-success">Ajouter un event</button></a><br><br>
  </div>';

  $sql = "SELECT *  FROM `event`";

  if(array_key_exists('soumettre',$_POST)){
    $recherche = isset($_POST['recherche']) ? $_POST['recherche'] :'';

    $sql="SELECT * FROM `event` WHERE Nom LIKE '%$recherche%'";
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

  echo "<table class='table'> <thead class='thead-dark'> <tr> <th scope='col'>Nom</th> <th scope='col'>ID Emetteur</th> <th scope='col'>Description</th> <th scope='col'>Image</th> <th scope='col'>Date</th> 
  <th scope='col'>Heure</th> <th scope='col'>Lieu</th> <th scope='col'>Regarder</th> <th scope='col'>Modifier</th> <th scope='col'>Supprimer</th><tbody>";

  while ($data = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $data['Nom'] . "</td>";
    echo "<td> " . $data['ID_Emetteur'] . "</td>";
    echo "<td> " . $data['Description'] . "</td>";
    echo '<td><img src="'.$data['Lien'].'" class="img-thumbnail" width="100px" height="100px"></td>';
    echo "<td> " . $data['Date'] . "</td>";
    echo "<td> " . $data['Heure'] . "</td>";
    echo "<td> " . $data['Lieu'] . "</td>";
    echo '<td><a href="regarder_event.php?ID_Event='.$data['ID_Event'].'">
    <button type="submit" name="reg_'.$data['ID_Event'].'" class="btn btn-primary">Regarder</button>
    </a></td>';
    echo '<td><a href="modifier_event.php?ID_Event='.$data['ID_Event'].'">
    <button type="submit" name="modif_'.$data['ID_Event'].'" class="btn btn-success">Modifier</button>
    </a></td>';
    echo '<td><form method="post">
    <input type="submit" name="sup_'.$data['ID_Event'].'" class="btn btn-danger" value="Supprimer"></input>
    </form></td>';
    echo "</tr>";

    if(array_key_exists('sup_'.$data['ID_Event'].'',$_POST)){
      $n_sql="DELETE FROM `event` WHERE ID_Event = '".$data['ID_Event']."'";

      try{
          $n_result = mysqli_query($db_handle, $n_sql);
      }
      catch (Exception $e){
          $error = $e->getMessage();
          echo $error;
          exit();
      }

      header("Refresh:0");
    }
  }
  echo "</tbody> </table></div>";    

}

?>