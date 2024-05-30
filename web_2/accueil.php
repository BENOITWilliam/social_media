<?php

$database = "likedin";
$hostname = "localhost:3308";
$username = "root";
$password = "";
session_start();

try {
    $db_handle = mysqli_connect($hostname,$username,$password);
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

    echo '<div class="container" id="color"><h1>Connecté</h1>';
    echo $_SESSION['ID'].'</div>';

    echo "<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css'>
          <link rel='stylesheet' href='style.css'>";
    echo '<body>';

    echo '<div class="container-fluid">';
    echo '<div class="row">';

    echo '<div class="col-md-3">';
    echo '<div id="eventCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">';

    $sql_event = "SELECT * FROM event";
    $result_event = mysqli_query($db_handle, $sql_event);
    $active_class = 'active';

    while ($event = mysqli_fetch_assoc($result_event)) {
      $user_id = $event['Id_emetteur'];
      $sql_user = "SELECT * FROM utilisateur WHERE ID = $user_id";
      $result_user = mysqli_query($db_handle, $sql_user);
      $user = mysqli_fetch_assoc($result_user);
        echo '<div class="carousel-item ' . $active_class . '">
                <class="d-block w-100" alt="' . $event['lien'] . '">
                <div class="carousel-caption d-none d-md-block">
                    <h5>' . $event['date'] . '</h5>
                    <div class="post-body">
                    <p>' . $event['lien'] . '</p>
                    <p>' . $event['description'] . '</p>
                    <p>' . $event['date'] . '</p>
                    <p>' . $event['lieu'] . '</p>
                    <p>' . $event['heure'] . '</p>
                </div>
                    <p>' . $event['description'] . '</p>
                </div>
              </div>';
        $active_class = '';
    }

    echo '</div>
            <a class="carousel-control-prev" href="#eventCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#eventCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
          </div>';
    echo '</div>';

   
    echo '<div class="col-md-9">';
    echo '<div class="feed">';

    
    $sql_post = "SELECT * FROM post ORDER BY date DESC";
    $result_post = mysqli_query($db_handle, $sql_post);

    while ($post = mysqli_fetch_assoc($result_post)) {
      $user_id = $post['Id_emetteur'];
      $sql_user = "SELECT * FROM utilisateur WHERE ID = $user_id";
      $result_user = mysqli_query($db_handle, $sql_user);
      $user = mysqli_fetch_assoc($result_user);

        echo '<div class="post">
        <div class="post-header">
        <img src="' . $user['Photo'] . '" class="rounded-circle" width="50px" height="50px" alt="User Photo">
        <div class="post-info">
        <h5>' . $user['Pseudo'] . '</h5>
        <small>' . $post['date'] . '</small>
        </div>
        </div>
                <div class="post-body">
                    <p>' . $post['lien'] . '</p>
                    <p>' . $post['description'] . '</p>
                    <p>' . $post['date'] . '</p>
                    <p>' . $post['lieu'] . '</p>
                    <p>' . $post['heure'] . '</p>
                </div>
                <div class="post-footer-1">
                    <button class="btn btn-outline-primary">Aimer</button>
                </div>
                <div class="post-footer-2">
                    <button class="btn btn-outline-secondary">Commenter</button>
                    <button class="btn">Enregistrer</button>
                </div>
              </div>';
    }

    echo '</div>';
    echo '</div>';

    echo '</div>';
    echo '</div>';

    
    echo '</br><a href=index.html><button class="btn btn-primary fixed-bottom" id="addPostBtn">Ajouter un post</button>';
   
    echo '</br><a href=index.html><button class="btn btn-secondary fixed-bottom" id="chatBtn">Chat en ligne</button>';

    echo '</body>';
}
?>

