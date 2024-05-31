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

    echo '<center><div class="container" id="color"><h2>ECEin, le social media professionnel pour la communauté ECE Paris</h2></center>';
    echo '</div>';

    echo '

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    ';

    echo "<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css'>
    
          <link rel='stylesheet' href='style.css'>";
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
  
    //echo 'data :'.$data_2['Lien'];
    
  
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
