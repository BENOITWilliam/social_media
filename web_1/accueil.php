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


    echo '<center><div class="container" id="color"><h2>ECEin, le social media professionnel pour la communauté ECE Paris</h2></center>';
    echo '</div>';

    echo "<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css'>
          <link rel='stylesheet' href='style.css'>";
    echo '<body>';

    echo '<div class="container-fluid-accueil">';
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

   
    /*-------------------------------------------------------------------------------------------------------------------------------*/
    /*-------------------------------------------------------------------------------------------------------------------------------*/
   


    echo '<div class="col-md-8">';
    echo '<div class="feed">';

    
    $sql_post = "SELECT * FROM post ORDER BY date DESC";
    $result_post = mysqli_query($db_handle, $sql_post);

    $sql_relation = "SELECT * FROM `relation` WHERE ID_demandeur_ami = ".$_SESSION['ID']."";
    $result_relation = mysqli_query($db_handle, $sql_relation);
    $i = 0;

    while($amis = mysqli_fetch_assoc($result_relation)){
      $list_amis[$i] = "".$amis['ID_ami']."";
      $i +=1;
    }

    while ($post = mysqli_fetch_assoc($result_post)) {
      $user_id = $post['ID_Emetteur'];
      $sql_user = "SELECT * FROM utilisateur WHERE ID = $user_id";
      $result_user = mysqli_query($db_handle, $sql_user);
      $user = mysqli_fetch_assoc($result_user);

      if (in_array($post['ID_Emetteur'],$list_amis)){echo '<div class="post-amis">';}
      else if ($post['ID_Emetteur'] == $_SESSION['ID']){echo '<div class="post-vous">';}
      else{echo '<div class="post">';}
        echo '<div class="post-header">
            <img src="' . $user['Photo'] . '" class="rounded-circle" width="50px" height="50px" alt="User Photo">
            <div class="post-info">';            
            if (in_array($post['ID_Emetteur'],$list_amis)){
              echo '<h5>' . $user['Pseudo'] . " - " .'<small>Votre amis</small></h5>';
            }
            else if ($post['ID_Emetteur'] == $_SESSION['ID']){
              echo '<h5>' . $user['Pseudo'] . " - " .'<small>Vous</small></h5>';
            }
            else {
              echo '<h5>' . $user['Pseudo'] . '</h5>';
            }
            echo'<small>' . $post['Date'] . "  | " .$post['Heure'] . '</small>
            </div>
            </div>
                    <div class="post-body">
                      <div class="row">
                        <div class="col-sm-4">
                          <img src="' . $post['Lien'] . '" width="200px" height="200px" alt="Photo">
                        </div>
                        <div class="col-sm-8">
                          <div class="text-right">
                          <p>' . $post['Description'] . '</p>
                          </br></br>
                          <p>' . $post['Lieu'] . '</p>
                          </div>  
                          </div>
                          </div>
                        </div>
                    <div class="post-footer-1">
                        <button class="btn btn-outline-primary">Aimer</button>
                    </div>
                    <div class="post-footer-2">
                        <button class="btn btn-outline-secondary" onclick="afficher();">Commenter</button>
                        <button class="btn" onclick="affichercom();">Afficher les commentaires</button>
                    </div>
                    </br>
    <span id="comment-form">
        <div class="message-form">
            <textarea placeholder="Écrivez votre commentaire ici"></textarea></br></br>
            <button class="btn btn-outline-primary btn-block">Envoyer le commentaire</button>
        </div>
    </span>
    </div>';
    }
    
    echo '</div>
  
    <style>
    textarea {
      width: 100%;
      height: 150px;
      padding: 12px 20px;
      box-sizing: border-box;
      border: 2px solid #ccc;
      border-radius: 4px;
      background-color: #f8f8f8;
      font-size: 16px;
      resize: none;
    }


    <script type="text/javascript">
    function afficher(comment-form) {
        var commentForm = document.getElementById("comment-form");
        if (commentForm.style.display === "none") {
            commentForm.style.display = "inline";
        } else {
            commentForm.style.display = "none";
        }
    }
</script>

';
    echo '</div>';

    echo '</div>';
    echo '</div>';

    
    echo '</br><a href=index.html><button class="btn btn-primary fixed-bottom" id="addPostBtn">Ajouter un post</button>';
   
    echo '</br><a href=index.html><button class="btn btn-secondary fixed-bottom" id="chatBtn">Chat en ligne</button>';

    echo '</body>';
}

?>
