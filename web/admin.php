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
echo "<style>body { background-image : url('".$_SESSION['Image']."');background-size: cover;}</style>";
echo "<style>#color{background-color: white;}</style>";
echo '<body>';

if ($db_found) {

  echo '<div class="container" id="color"><ul class="nav justify-content-center"><ul class="nav nav-pills">
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="compte.php">Mon Compte</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Link</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="#">Link</a>
  </li>
  <li class="nav-item">
    <a class="nav-link disabled" aria-disabled="true">Disabled</a>
  </li>
  </ul></ul></div>';

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
  <th scope='col'>Supprimer</th> <tbody>";


  while ($data = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $data['ID'] . "</td>";
    echo "<td>" . $data['Pseudo'] . "</td>";
    echo "<td> " . $data['Email'] . "</td>";
    echo "<td>" . $data['NC'] . "</td>";
    echo '<td><form method="post">
    <input type="submit" name="sup_'.$data['ID'].'" class="btn btn-danger" value="Supprimer sup_'.$data['ID'].'">
    </form></td>';
    echo "</tr>";


    if(array_key_exists('sup_'.$data['ID'].'',$_POST)){

      $n_sql="DELETE FROM `utilisateur` WHERE ID = '".$data['ID']."'";

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