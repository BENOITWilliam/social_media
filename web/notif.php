<?php
/* Affiche les notifications */
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

if ($db_found){

    $sql = "SELECT 'Emploi' AS Type, ID_Emploi AS ID, Date FROM Emploi UNION ALL SELECT 'Event' AS Type, ID_Event AS ID, Date FROM Event ORDER BY Date DESC";

    try{
        $result = mysqli_query($db_handle, $sql);
    }
    catch (Exception $e){
        $error = $e->getMessage();
        echo $error;
        exit();
    }

    echo '
    <div class="container-sm" id="color" style="width:85%;margin-left: auto;margin-right: auto;">';

    echo "<table class='table'> <thead class='thead-dark'> <tr> <th scope='col'>Type</th> <th scope='col'>Nom</th> <th scope='col'>Description</th> <th scope='col'>Image</th> 
    <th scope='col'>Date</th>  <tbody>";

    while($data = mysqli_fetch_assoc($result)){
        if($data['Type']=='Emploi'){
            $n_sql = "SELECT * From `emploi` WHERE ID_Emploi = ".$data['ID']."";

            try{
                $n_result = mysqli_query($db_handle, $n_sql);
            }
            catch (Exception $e){
                $error = $e->getMessage();
                echo $error;
                exit();
            }

            $n_data = mysqli_fetch_assoc($n_result);
            echo "<tr>";
            echo "<td>Emploi</td>";
            echo "<td>" . $n_data['Nom'] . "</td>";
            echo "<td> " . $n_data['Desc_courte'] . "</td>";
            echo '<td><img src="'.$n_data['Image'].'" class="img-thumbnail" width="100px" height="100px"></td>';
            echo "<td>" . $n_data['Date'] . "</td>";
            echo "</tr>";     
        }
        else if($data['Type']=='Event'){
            $n_sql = "SELECT * From `event` WHERE ID_Event = ".$data['ID']."";

            try{
                $n_result = mysqli_query($db_handle, $n_sql);
            }
            catch (Exception $e){
                $error = $e->getMessage();
                echo $error;
                exit();
            }

            $n_data = mysqli_fetch_assoc($n_result);
            echo "<tr>";
            echo "<td>Event</td>";
            echo "<td>" . $n_data['Nom'] . "</td>";
            echo "<td> " . $n_data['Description'] . "</td>";
            echo '<td><img src="'.$n_data['Lien'].'" class="img-thumbnail" width="100px" height="100px"></td>';
            echo "<td>" . $n_data['Date'] . "</td>";
            echo "</tr>";   
        }
    }
    echo "</tbody> </table></div>";
    echo'</div>';

}

?>