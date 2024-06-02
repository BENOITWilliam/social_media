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

/* Mise en place du carrousel pour les notifications */

if ($db_found) {

  echo '<center><div class="container" id="color"><h2>ECEin, le social media professionnel pour la communauté ECE Paris</h2></center>';
  echo '</div>';

  echo '

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  ';

  echo "<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css'>";
  
  echo '<body>';

  echo '<div class="container-fluid-accueil">';
  echo '<div class="row">';



  echo '<div class="col-md-3">';
  echo '<div class="carousel-inner">';
  echo '</div> </div>';


  $sql = "SELECT Lien,Nom FROM `event` ORDER BY Date DESC";
  try{
    $result = mysqli_query($db_handle, $sql);
  }
  catch (Exception $e){
    $error = $e->getMessage();
    echo $error;
    exit();
  }


  $data_1 = mysqli_fetch_assoc($result);
  $data_2 = mysqli_fetch_assoc($result);
  $data_3 = mysqli_fetch_assoc($result);
  $data_4 = mysqli_fetch_assoc($result);

  

  echo '
    <div class="container" id="carou">
      <div id="vertical-carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="false" data-bs-wrap="false">
        <ol class="carousel-indicators">
          <li data-bs-target="#vertical-carousel" data-bs-slide-to="0" class="active"></li>
          <li data-bs-target="#vertical-carousel" data-bs-slide-to="1"></li>
          <li data-bs-target="#vertical-carousel" data-bs-slide-to="2"></li>
          <li data-bs-target="#vertical-carousel" data-bs-slide-to="3"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active" style="background-image:url('.$data_1['Lien'].');">
            <div class="container">
              <a href="notif.php">
                <div class="row align-items-center" style="height: 100%"> 
                  <h1 class="text-center text-light"><br><br>
                    '.$data_1['Nom'].'
                  </h1>
                </div>
              </a>
            </div>
          </div>
          <div class="carousel-item" style="background-image:url('.$data_2['Lien'].');">
            <div class="container">
              <a href="notif.php">
                <div class="row align-items-center" style="height: 100%"> 
                  <h1 class="text-center text-light"><br><br>
                    '.$data_2['Nom'].'
                  </h1>
                </div>
              </a>
              </div>
          </div>
          <div class="carousel-item" style="background-image:url('.$data_3['Lien'].');">
            <div class="container">
              <a href="notif.php">
                <div class="row align-items-center" style="height: 100%"> 
                  <h1 class="text-center text-light"><br><br>
                    '.$data_3['Nom'].'
                  </h1>
                </div>
              </a>
              </div>
          </div>
          <div class="carousel-item" style="background-image:url('.$data_4['Lien'].');">
            <div class="container">
              <a href="notif.php">
                <div class="row align-items-center" style="height: 100%"> 
                  <h1 class="text-center text-light"><br><br>
                    '.$data_4['Nom'].'
                  </h1>
                </div>
              </a>
              </div>
          </div>
        </div>
      </div>

      <button class="unclickable carousel-control-prev" type="button" data-bs-target="#vertical-carousel" data-bs-slide="prev">
        <span class="clickable carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Précédent</span>
      </button>
      <button class="unclickable carousel-control-next" type="button" data-bs-target="#vertical-carousel" data-bs-slide="next">
        <span class="clickable carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Suivant</span>
      </button>
    
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
    crossorigin="anonymous"></script>
  <script src="index.js"></script>
  <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(["_setAccount", "UA-36251023-1"]);
  _gaq.push(["_setDomainName", "jqueryscript.net"]);
  _gaq.push(["_trackPageview"]);

  (function() {
    var ga = document.createElement("script"); ga.type = "text/javascript"; ga.async = true;
    ga.src = ("https:" == document.location.protocol ? "https://ssl" : "http://www") + ".google-analytics.com/ga.js";
    var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
    ';

  /*-------------------------------------------------------------------------------------------------------------------------------*/
  /*-------------------------------------------------------------------------------------------------------------------------------*/
  
  /* Mise en place du "feed" pour les postes sur les plaformes */


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
  if(is_null($list_amis)){$list_amis[0]='0';}

  while ($post = mysqli_fetch_assoc($result_post)) {
    $user_id = $post['ID_Emetteur'];
    $sql_user = "SELECT * FROM utilisateur WHERE ID = $user_id";
    $result_user = mysqli_query($db_handle, $sql_user);
    $user = mysqli_fetch_assoc($result_user);
    $like = 0;
    $reaction_sql = "SELECT COUNT(*) AS total FROM `reaction` WHERE ID_Post = '" . $post['ID_Post'] . "' AND aime = 1";
    $reaction_utilisateur = "SELECT aime FROM `reaction` WHERE ID_Post = '" . $post['ID_Post'] . "' AND ID_Emetteur = '" . $_SESSION['ID'] . "'";
    try {
      $reaction_result = mysqli_query($db_handle, $reaction_sql);
      $reaction_data = mysqli_fetch_assoc($reaction_result);
      $reaction_result_ui = mysqli_query($db_handle, $reaction_utilisateur);
      $reaction_data_ui = mysqli_fetch_assoc($reaction_result_ui);
      $like = $reaction_data['total'];
      $like_ui = $reaction_data_ui['aime'];
    } catch (Exception $e) {
      $error = $e->getMessage();
      echo $error;
      exit();
    }

    echo'<a name="'.$post['ID_Post'].'"></a>'; // <-- ancre pour pas revenir en haut de la page quand intéraction

    if (in_array($post['ID_Emetteur'],$list_amis)){echo '<div class="post-amis">';}
    else if ($post['ID_Emetteur'] == $_SESSION['ID']){echo '<div class="post-vous">';}
    else if($post['Privé']==0){echo '<div class="post">';}
    else{continue;}
      echo '<div class="post-header">';
      echo'
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
                      <div class="col-sm-5">';
                      if (pathinfo($post['Lien'], PATHINFO_EXTENSION) == 'mp4') {echo "<video src='".$post['Lien']."' controls width='100%' height='100%'></video>";} 
                      else {echo '<img src="' . $post['Lien'] . '" width="100%" height="100%" alt="Photo">';}
                        
                    echo '</div>
                      <div class="col-sm-7">
                        <div class="text-right">
                        <p>' . $post['Description'] . '</p>
                        </br></br>
                        <p>' . $post['Lieu'] . '</p>
                        </div>  
                        </div>
                        </div>
                      </div>
                  <div class="post-footer-1">
                  <form method="post">';
                    if ($like_ui == 0) {
                      echo '<center><input type="submit" name="like_' . $post['ID_Post'] . '" class="btn btn-outline-danger" value=" ♡ (' . $like . ')" ></input></center>';
                    } else {
                      echo '<center><input type="submit" name="like_' . $post['ID_Post'] . '" class="btn btn-danger" value=" ❤️ (' . $like . ')" ></input></center>';
                    }
                  echo '</form>
                  </div>
                  <div class="post-footer-2">
                      <form method="post">
                        <center><input type="submit" name="com_' . $post['ID_Post'] . '" class="btn btn-outline-primary" value="Commentaire" ></input></center><br>
                      </form>
                  </div>
                  </br>
  </div>';

    if (array_key_exists('like_' . $post['ID_Post'] . '', $_POST)) {
      echo '<div class="container" id="color">';
      echo 'test boutton';

      $n_sql = "SELECT * FROM `reaction` WHERE ID_Post = '" . $post['ID_Post'] . "' AND ID_Emetteur = '" . $_SESSION['ID'] . "'";
      echo $n_sql;
      try {
        $result = mysqli_query($db_handle, $n_sql);
      } catch (Exception $e) {
        $error = $e->getMessage();
        echo $error;
        exit();
      }

      if ($result) {
        $row = mysqli_fetch_assoc($result);
        echo "test 1";
        $id_post = $row['ID_Post'];
        $id_emetteur = $row['ID_Emetteur'];
        $id = $row['ID'];
        $aime = $row['aime'];
        if ($id == NULL) {
          $n_sql = "INSERT INTO `reaction` (`ID_Post`, `ID_Emetteur`, `aime`) VALUES ('" . $post['ID_Post'] . "', '" . $_SESSION['ID'] . "', '1')";
          try {
            $result = mysqli_query($db_handle, $n_sql);
          } catch (Exception $e) {
            $error = $e->getMessage();
            echo $error;
            exit();
          }
        } else {
          if ($aime == 1) {
            $n_sql = "UPDATE `reaction` SET `aime` = '0' WHERE ID_Post = '" . $post['ID_Post'] . "' AND ID_Emetteur = '" . $_SESSION['ID'] . "'";
          } else {
            echo "test 2.2";
            $n_sql = "UPDATE `reaction` SET `aime` = '1' WHERE ID_Post = '" . $post['ID_Post'] . "' AND ID_Emetteur = '" . $_SESSION['ID'] . "'";
          }
          try {
            $result = mysqli_query($db_handle, $n_sql);
          } catch (Exception $e) {
            $error = $e->getMessage();
            echo $error;
            exit();
          }
        }
      } else {
        $n_sql = "INSERT INTO `reaction` (`ID_Post`, `ID_Emetteur`, `aime`) VALUES ('" . $data['ID_Post'] . "', '" . $_SESSION['ID'] . "', '1')";
      }
      header("Location: accueil.php#".$post['ID_Post']."");
    }

    if(array_key_exists('com_' . $post['ID_Post'] . '',$_POST)){

      $n_sql = "SELECT * FROM `reaction` WHERE ID_Post = '" . $post['ID_Post'] . "' AND ID_Emetteur = '" . $_SESSION['ID'] . "'";
      echo $n_sql;
      try {
        $result = mysqli_query($db_handle, $n_sql);
      } catch (Exception $e) {
        $error = $e->getMessage();
        echo $error;
        exit();
      }

      if ($result) {
        $row = mysqli_fetch_assoc($result);
        echo "test 1";
        $id_post = $row['ID_Post'];
        $id_emetteur = $row['ID_Emetteur'];
        $id = $row['ID'];
        $aime = $row['aime'];
        if ($id == NULL) {
          $n_sql = "INSERT INTO `reaction` (`ID_Post`, `ID_Emetteur`, `aime`) VALUES ('" . $post['ID_Post'] . "', '" . $_SESSION['ID'] . "', '0')";
          try {
            $result = mysqli_query($db_handle, $n_sql);
          } catch (Exception $e) {
            $error = $e->getMessage();
            echo $error;
            exit();
          }
        }
        echo '<meta http-equiv="refresh" content="0; url=com_post.php?ID_Post='.$post['ID_Post'].'">';
        exit();
      }
    }
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
  </style>

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

  
  echo '</br><a href=post_image.php><button class="btn btn-primary fixed-bottom" id="addPostBtn">Ajouter un post</button>';
  
  echo '</br><a href=reseau.php><button class="btn btn-secondary fixed-bottom" id="chatBtn">Conversation</button>';

  echo '</body>';

  
}
?>
