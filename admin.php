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

echo "<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css'>
<link rel='stylesheet' href='style.css'>";
echo "<style>body { background-image : url('".$_SESSION['Image']."');background-size: cover;background-attachment: fixed;}</style>";

echo '<body>';

if ($db_found) {

  echo '<div class="container" id="color"><div class="center_nav"><nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="accueil.php">Accueil</a>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="compte.php">Mon compte</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="offre_emploi.php">Offres d\'emploi</a>
          </li>
          <li class="nav-item">
            <div class="center_compte_notif">
              <a class="nav-link disabled" aria-disabled="true"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell-fill" viewBox="0 0 16 16">
              <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2m.995-14.901a1 1 0 1 0-1.99 0A5 5 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901"/>
              </svg>
              </a>
            </div>
          </li>
        </ul>
          <a href="index.html"><button class="btn btn-outline-danger" type="submit">Se déconnecter</button></a>
      </div>
    </div></div>
  </nav></div><br><br>';

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
    <input type="submit" name="sup_'.$data['ID'].'" class="btn btn-danger" value="Supprimer '.$data['ID'].' 🗑️"></input>
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