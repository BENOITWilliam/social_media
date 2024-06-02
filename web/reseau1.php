<?php
/* Ce fichier prends en charge les liens entre utilisateur et est la porte d'accès au chat utilisateur */
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
    echo '<br><br><br><div class="container" id="color"><h1> rechercher un profil : </h1>
    <form method="POST">
    <input type="text" name="recherche" placeholder="recherche" class="form-control"/> <br>
    <button type="submit" name="soumettre" value="soumettre" class="btn btn-primary">Rechercher</button>
    <button type="submit" name="liste" value="liste" class="btn btn-primary">Ma liste d\'ami </button>
    <button type="submit" name="demande" value="demande" class="btn btn-primary">Demande d\'ami </button></br>
    </form>
    <br>
    </div>';
  
    $sql = "SELECT * FROM `utilisateur`";
  
    if(array_key_exists('soumettre',$_POST)){
        $recherche = isset($_POST['recherche']) ? $_POST['recherche'] :'';
    
        $sql="SELECT * FROM `utilisateur` WHERE Pseudo LIKE '%$recherche%'";
    }
    if(array_key_exists('liste',$_POST)){
        $sql="SELECT * FROM utilisateur,relation WHERE relation.ID_demandeur_ami=".$_SESSION['ID']." AND relation.ID_ami=utilisateur.ID";
    }
    if(array_key_exists('demande',$_POST)){
        $sql="SELECT * FROM utilisateur,relation WHERE relation.ID_ami=".$_SESSION['ID']." AND relation.ID_demandeur_ami=utilisateur.ID";
    }
    try{
        $result = mysqli_query($db_handle, $sql);
    }
    catch (Exception $e){
        $error = $e->getMessage();
        echo $error;
        exit();
    }
  
    echo '<br><br><br><div class="container w-25" id="color">';
  
    echo "<table class='table'> <tbody>";
  
    while ($data = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo'<td><center><a href="regarder_compte.php?ID='.$data["ID"].'"><img src="'.$data['Photo'].'" class="img-thumbnail" width="100px" height="100px"></a></center></td>';
        echo "
        <td>
        <a href='chat.php?ID=".$data['ID']."' style='color:black;'>
        ". $data['Pseudo']."
        </a>
        </td>";

        $sql_relation="SELECT * FROM relation,utilisateur WHERE ID_demandeur_ami= ".$_SESSION['ID']." AND ID_ami= ".$data['ID']." AND ID !=".$_SESSION['ID'];
        try{
            $result_relation = mysqli_query($db_handle, $sql_relation);
        }
        catch (Exception $e){
            $error = $e->getMessage();
            echo $error;
            exit();
        }
        if ($result_relation->num_rows>0)
        {
            echo '<td><form method="post"> 
            <input type="submit" name="NON_suivre_'.$data['ID'].'" class="btn btn-danger" value="Ne plus suivre"> 
            </input> 
            </form> 
            </td>';
        }
        else {
            echo '
            <td>
                <form method="post"> 
                    <input type="submit" name="suivre_'.$data['ID'].'" class="btn btn-success" value="Suivre"> 
                    </input> 
                </form> 
            </td>';
        }
        echo "</tr>";

        if(array_key_exists('suivre_'.$data['ID'].'',$_POST))
        {
            $sql_relation="INSERT INTO relation( ID_demandeur_ami, ID_ami) VALUES ('".$_SESSION['ID']."','".$data['ID']."')";
            try{
                $result_relation = mysqli_query($db_handle, $sql_relation);
            }
            catch (Exception $e){
                $error = $e->getMessage();
                echo $error;
                exit();
            }
            header("refresh:0");
        }
        if(array_key_exists('NON_suivre_'.$data['ID'].'',$_POST))
        {
            $sql_relation="DELETE FROM relation WHERE ID_demandeur_ami= ".$_SESSION['ID']." AND ID_ami= ".$data['ID'];
            try{
                $result_relation = mysqli_query($db_handle, $sql_relation);
            }
            catch (Exception $e){
                $error = $e->getMessage();
                echo $error;
                exit();
            }
            header("refresh:0");
        }

    }
    
    echo "</tbody> </table></div>";

}
?>
