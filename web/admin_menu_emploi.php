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

  echo '<br><br><br><div class="container" id="color"><h1>Recherche travail :</h1><br>
  <form method="POST">
  <input type="text" name="recherche" placeholder="recherche" class="form-control"/><br><br>
  <div class="row">
    <div class="col-sm-1">
      <button type="submit" name="soumettre" value="soumettre" class="btn btn-primary">Rechercher</button></br>
    </div></form>
  </div>
  <br><a href="admin_ajouter_emploi.php"><button class="btn btn-success">Ajouter une offre</button></a><br><br>
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
  <th scope='col'>Regarder</th> <th scope='col'>Modifier</th> <th scope='col'>Supprimer</th><tbody>";

  while ($data = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $data['Nom'] . "</td>";
    echo "<td> " . $data['Desc_courte'] . "</td>";
    echo '<td><img src="'.$data['Image'].'" class="img-thumbnail" width="100px" height="100px"></td>';
    echo '<td><form method="post">
    <input type="submit" name="reg_'.$data['ID_Emploi'].'" class="btn btn-primary" value="Regarder"></input>
    </form></td>';
    echo '<td><form method="post">
    <input type="submit" name="modif_'.$data['ID_Emploi'].'" class="btn btn-success" value="Modifier"></input>
    </form></td>';
    echo '<td><form method="post">
    <input type="submit" name="sup_'.$data['ID_Emploi'].'" class="btn btn-danger" value="Supprimer"></input>
    </form></td>';
    echo "</tr>";

    if(array_key_exists('reg_'.$data['ID_Emploi'].'',$_POST)){
      $_SESSION['ID_Emploi'] = $data['ID_Emploi'];
      echo '<meta http-equiv="refresh" content="0; url=http://localhost/web/regarder_emploi.php">';
    }
    if(array_key_exists('modif_'.$data['ID_Emploi'].'',$_POST)){
        $_SESSION['ID_Emploi'] = $data['ID_Emploi'];
        echo '<meta http-equiv="refresh" content="0; url=http://localhost/web/modifier_emploi.php">';
    }
    if(array_key_exists('sup_'.$data['ID_Emploi'].'',$_POST)){
        $n_sql="DELETE FROM `emploi` WHERE ID_Emploi = '".$data['ID_Emploi']."'";

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
