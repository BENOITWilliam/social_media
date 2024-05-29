<?php
echo "<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css'>
<link rel='stylesheet' href='style.css'>";

//le fichier xml est au même niveau que le fichier PHP qui le manipule
$fichier = 'cv.xml';
$contenu = simplexml_load_file($fichier);

echo '<div class="container" style="background-color: lightblue">';
foreach($contenu as $cv) {

    echo '
    <div class="row">
        <div class="col-sm-3">
            <center><br><br><img src="'.$cv->photo.'" class="img-thumbnail" width="200px" height="200px"><br></center>
        </div>
        <div class="col-sm-8">
            <br><br><br>
            <div class="row">
                <div class="col-sm-4">
                    <center>
                        <h4>Nom : <h5>'.$cv->nom.'</h5></h4>
                        <br>
                        <h4>Prenom : <h5>'.$cv->prenom.'</h5></h4>
                    </center>
                </div>
                <div class="col-sm-4">
                    <center>
                        <h4>Date de naissance : <h5>'.$cv->date_naissance.'</h5></h4>
                        <br>
                        <h4>Adresse : <h5>'.$cv->adresse.'</h5></h4>
                    </center>
                </div>
                <div class="col-sm-4">
                    <center>
                        <h4>Mail : <h5>'.$cv->mail.'</h5></h4>
                        <br>
                        <h4>Téléphone : <h5>'.$cv->telephone.'</h5></h4>
                    </center>
                </div>
            </div>
        </div>
    </div>
    Nom : '.$cv->nom.' | Prénom : '.$cv->prenom.' | Date de naissance : '.$cv->date_naissance.'
      | mail : '.$cv->mail.' | téléphone : '.$cv->telephone.'| étude : '.$cv->etude.' <br> compétences : 
      -codage : '.$cv->competences->codage.'
    ';
 }
echo '</div>';

?>