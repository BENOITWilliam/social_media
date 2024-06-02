<?php
/* Mise en place de l'affichage universel et du lien avec la base de donnée */
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

  echo '<br><br><br><div class="container" id="color"><h1>Recherche utilisateur :</h1><br>
  <form method="POST">
  <input type="text" name="recherche" placeholder="recherche" class="form-control"/><br>
  <select name="choix" id="choix">
  <option value="">--Option de recherche--</option>
  <option value="Pseudo">Pseudo</option>
  <option value="Email">Email</option>
  <option value="ID">ID</option>
  </select><br><br>
  <button type="submit" name="soumettre" value="soumettre" class="btn btn-primary">Rechercher</button></br>
  </form>
  <br>
  </div>';
  $sql = "SELECT ID,Pseudo,Email,NC FROM `utilisateur`";
  if(array_key_exists('soumettre',$_POST)){
    $recherche = isset($_POST['recherche']) ? $_POST['recherche'] :'';
    $choix = isset($_POST['choix']) ? $_POST['choix'] :'';

    if($choix == 'Pseudo'){$sql="SELECT ID,Pseudo,Email,NC FROM `utilisateur` WHERE Pseudo LIKE '%$recherche%'";}
    else if($choix == 'Email'){$sql="SELECT ID,Pseudo,Email,NC FROM `utilisateur` WHERE Email LIKE '%$recherche%'";}
    else if($choix == 'ID'){$sql="SELECT ID,Pseudo,Email,NC FROM `utilisateur` WHERE ID LIKE '$recherche%'";}
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

  echo "<table class='table'> <thead class='thead-dark'> <tr> <th scope='col'>ID</th> <th scope='col'>Pseudo</th> <th scope='col'>Email</th> <th scope='col'>NC</th> 
  <th scope='col'>Supprimer</th> <th scope='col'>Changer NC</th><tbody>";


  while ($data = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $data['ID'] . "</td>";
    echo "<td>" . $data['Pseudo'] . "</td>";
    echo "<td> " . $data['Email'] . "</td>";
    echo "<td>" . $data['NC'] . "</td>";
    echo '<td><form method="post">
    <input type="submit" name="sup_'.$data['ID'].'" class="btn btn-danger" value="Supprimer '.$data['ID'].' 🗑️"></input>
    </form></td>';
    echo '<td><form method="post">
    <input type="submit" name="nc_'.$data['ID'].'" class="btn btn-success" value="Changer NC '.$data['ID'].' ⚔️"></input>
    </form></td>';
    echo "</tr>";

    if(array_key_exists('sup_'.$data['ID'].'',$_POST)){
      echo 'bonjour';
      echo '
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
      ';
      echo '
      <div id="popup" class="modal">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <p>Confirmation supression</p>
            </div>
            <div class="modal-body">
              <p>Etes-vous sur de vouloir supprimer cet utilisateur : Sowgan</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-success" data-dismiss="modal">Confirmer</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
            </div>
          </div>
        </div>
      </div>
      ';

      /*$n_sql="DELETE FROM `utilisateur` WHERE ID = '".$data['ID']."'";

      try{
        $n_result = mysqli_query($db_handle, $n_sql);
      }
      catch (Exception $e){
        $error = $e->getMessage();
        echo $error;
        exit();
      }

      header("Refresh:0");*/
    }

    if(array_key_exists('nc_'.$data['ID'].'',$_POST)){

      $n_sql="SELECT NC FROM `utilisateur` WHERE ID = '".$data['ID']."'";

      try{
        $n_result = mysqli_query($db_handle, $n_sql);
      }
      catch (Exception $e){
        $error = $e->getMessage();
        echo $error;
        exit();
      }

      $n_data = mysqli_fetch_assoc($n_result);

      if($n_data['NC']=='1'){ 
        
        $nc_sql = "UPDATE `utilisateur` SET NC = '0' WHERE ID = '".$data['ID']."'";
        if($_SESSION['ID']==$data['ID']){

          $_SESSION['NC']='0';
          $nc_result = mysqli_query($db_handle, $nc_sql);
          echo'<meta http-equiv="refresh" content="0; url=http://localhost/web/compte.php">';
          exit();
        }
      }
      else{
        $nc_sql = "UPDATE `utilisateur` SET NC = '1' WHERE ID = '".$data['ID']."'";
        if($_SESSION['ID']==$data['ID']){$_SESSION['NC']='1';}
      }
      try{
        $nc_result = mysqli_query($db_handle, $nc_sql);
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
