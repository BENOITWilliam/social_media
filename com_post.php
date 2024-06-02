<?php
//
$database = "likedin";
session_start();

try {
    $db_handle = mysqli_connect('localhost', 'root', 'root');
} catch (Exception $e) {
    $error = $e->getMessage();
    echo $error;
    exit();
}

try {
    $db_found = mysqli_select_db($db_handle, $database);
} catch (Exception $e) {
    $error = $e->getMessage();
    echo $error;
    exit();
}


require("importation.php");
importation();

if ($db_found) {
echo '<div class="container" id="color">';
$query = "SELECT * FROM post WHERE ID_Post = '".$_SESSION['ID_Post']."' ";
$result = mysqli_query($db_handle, $query);
if ($result) {
    $row = mysqli_fetch_assoc($result);
    if ($row) {
        $id_post = $row['ID_Post'];
        $lien = $row['Lien'];
        $date = $row['Date'];
        $heure = $row['Heure'];
        $lieu = $row['Lieu'];
        $description = $row['Description'];
        $prive = $row['Privé'];
    } else {
        echo "No posts found.";
    }
} else {
    echo "Error retrieving posts.";
}
    echo '<div class="row">
        <div class="col-md-100 offset-md-3">
        <h3 class="card-title">Voici la publication créé</h3>';
            if (pathinfo($lien, PATHINFO_EXTENSION) == 'mp4') {
                echo "<div class='text-center'><video src='$lien' controls width='500' height='400'></video></div>";
            } else {
                echo "<div class='text-center'><img src='$lien' alt='Image du post' class='img-fluid'></div>";
            }
            if($date){
                echo "Date: " . $date . "<br>";
            }
            if($heure){
                echo "Heure: " . $heure . "<br>";
            }
            if($lieu){
                echo "Lieu: " . $lieu . "<br>";
            }
            if($description){
                echo "Description: " . $description . "<br>";
            }
    echo '</div></div>';

    $sql_post = "SELECT * FROM reaction WHERE ID_Post = '".$_SESSION['ID_Post']."' ";
    $result_post = mysqli_query($db_handle, $sql_post);
  
    while ($post = mysqli_fetch_assoc($result_post)) {
        
      echo '<div class="col-sm-3"></div>
      <div class="col-sm-9">
      ';
      echo '<div class="post">
      <div class="post-header">
          <img src="' . $user['Photo'] . '" class="rounded-circle" width="50px" height="50px" alt="User Photo">
          <div class="post-info">
          <h5>' . $user['Pseudo'] . '</h5>
          <small>' . $post['Date'] . "  | " .$post['Heure'] . '</small>
          </div>
          </div>
                  <div class="post-body">
                    <div class="row">
                      <div class="col-sm-5">';
                      if (pathinfo($post['Lien'], PATHINFO_EXTENSION) == 'mp4') {echo "<center><video src='".$post['Lien']."' controls width='360' height='200'></video></center>";} 
                      else {echo "<center><img src='".$post['Lien']."' alt='Image du post' class='img-fluid'></center>";}
                      echo' </div>
                      <div class="col-sm-7">
                        <div class="text-right">
                        <p>' . $post['Description'] . '</p>
                          <p>' . $post['Lieu'] . '</p>
                          </div>  
                        </div>
                      </div>
                  <div class="post-footer-1">
                    <form method="post">';
                      if ($like_ui == 0) {
                        echo '<center><input type="submit" name="like_' . $post['ID_Post'] . '" class="btn btn-primary" value=" ♡(' . $like . ')" ></input></center><br>';
                      } else {
                        echo '<center><input type="submit" name="like_' . $post['ID_Post'] . '" class="btn btn-danger" value=" ❤️(' . $like . ')" ></input></center><br>';
                      }
                    echo '</form>
                  </div>
                  <div class="post-footer-2">
                    <form method="post">
                      <center><input type="submit" name="com_' . $post['ID_Post'] . '" class="btn btn-primary" value="Commentaire" ></input></center><br>
                    </form>
                  </div>
                </div></div></div>';

    }

}
?>
