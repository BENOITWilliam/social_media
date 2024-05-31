<?php
echo "<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css'>
<link rel='stylesheet' href='style.css'>";
echo '<div class="container" style="background-color: lightblue">';

//le fichier xml est au même niveau que le fichier PHP qui le manipule
$fichier = 'documents/cv/cv1.xml';
$contenu = simplexml_load_file($fichier);


foreach($contenu as $cv) {

    echo '
    <div class="row">
        <div class="col-sm-3" style="background-color:aqua">
            <center>
            <br><br><img src="'.$cv->photo.'" class="img-thumbnail" width="200px" height="200px"><br>
            <br><br><br>
            <h4>Compétences :</h4><p>';
    
    if($cv->competences->packoffice!=''){echo 'packoffice : '.$cv->competences->packoffice.'<br>';}
    if($cv->competences->codage!=''){echo 'codage : '.$cv->competences->codage.'<br>';}
    if($cv->competences->autre!=''){echo 'autre : '.$cv->competences->autre.'<br>';}
    
    echo '</p><br>
    <h4>Langues :</h4><p>';

    if($cv->langue->francais!=''){echo 'français : '.$cv->langue->francais.'<br>';}
    if($cv->langue->anglais!=''){echo 'anglais : '.$cv->langue->anglais.'<br>';}
    if($cv->langue->espagnol!=''){echo 'espagnol : '.$cv->langue->espagnol.'<br>';}
    if($cv->langue->allemand!=''){echo 'allemand : '.$cv->langue->allemand.'<br>';}

    echo '</p><br>
    <h4>Centre d\'intérêt :</h4><p>';

    if($cv->centre_interet->sport!=''){echo 'sport : '.$cv->centre_interet->sport.'<br>';}
    if($cv->centre_interet->art!=''){echo 'art : '.$cv->centre_interet->art.'<br>';}
    if($cv->centre_interet->benevola!=''){echo 'bénévola : '.$cv->centre_interet->benevola.'<br>';}
    if($cv->centre_interet->autre!=''){echo 'autre : '.$cv->centre_interet->autre.'<br>';}

    echo '</p><br>
    <h4>Permis :</h4><p>';

    if($cv->permi->voiture!=''){echo 'voiture : '.$cv->permi->voiture.'<br>';}
    if($cv->permi->bateau!=''){echo 'art : '.$cv->permi->bateau.'<br>';}
    if($cv->permi->poids_lourds!=''){echo 'bénévola : '.$cv->permi->poids_lourds.'<br>';}
    if($cv->permi->moto!=''){echo 'autre : '.$cv->permi->moto.'<br>';}
    if($cv->permi->avion!=''){echo 'autre : '.$cv->permi->avion.'<br>';}

    echo'</p>
            </center>
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
            <br><br>
            <p>'.$cv->description.'</p>
            <br><br><br>
            <h4>Diplomes : <h5>'.$cv->diplome.'</h5></h4>
            <br>
            <h4>Etudes : <h5>'.$cv->etude.'</h5></h4>
            <br>
            <h4>Formations : <h5>'.$cv->formation.'</h5></h4>
            <br>
            <h4>Expériences professionel : <h5>'.$cv->parcours.'</h5></h4>
        </div>
    </div>
    ';
 }
echo '</div>';

?>