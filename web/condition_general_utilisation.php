<?php 
/* Fichier affichant les informations juridique liés condition général d'utilisation  */
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
?>


<!DOCTYPE html>
<body>
    <div style="background-color: rgba(245, 245, 245, 0.9);">
        <h1>Conditions Générales d’Utilisation de<img src="documents\site\logo_ece_in2-removebg.png" alt="logo_ece_in2.png" width="10%" height="10%"/></h1>
        <ol type="I" style="font-size: 20px;">
            <li>
                <h2>Acceptation des Conditions</h2>
                <p>En utilisant le réseau social fictif ECEIN, vous acceptez les présentes Conditions Générales d’Utilisation. Ces conditions régissent votre accès et votre utilisation du service, ainsi que vos droits et responsabilités.</p>
            </li>
            <li>
                <h2>Création de Compte</h2>
                <ul>
                    <li>
                        <p>Vous devez avoir au moins 13 ans pour créer un compte sur ECEIN.</p>
                    </li>
                    <li>
                        <p>Vous ne pouvez pas utiliser de contenu violent, obscène ou illégal dans votre profil ou vos publications.</p>
                    </li>
                </ul>
            </li>
            <li>
                <h2>Propriété du Contenu</h2>
                <ul>
                    <li>
                        <p>Vous conservez la propriété de tout contenu que vous publiez sur ECEIN.</p>
                    </li>
                    <li>
                        <p>Volpe dispose d’une licence non exclusive, libre de droits et transférable pour tout contenu publié sur la plateforme.</p>
                    </li>
                </ul>
            </li>
            <li>
                <h2>Confidentialité</h2>
                <ul>
                    <li>Votre vie privée est importante pour nous. Consultez notre politique de confidentialité pour en savoir plus sur la manière dont nous traitons vos données personnelles.</li>
                </ul>
            </li>
            <li>
                <h2>Responsabilité</h2>
                <ul>
                    <li>Vous êtes responsable de vos actions sur ECEIN. Ne publiez pas de contenu diffamatoire, discriminatoire ou illégal.</li>
                </ul>
                <ul>
                    <li>ECEIN et Volpe ne peuvent être tenus responsable des contenus publiés par les utilisateurs.</li>
                </ul>
            </li>
            <li>
                <h2>Arbitrage</h2>
                <ul>
                    <li>Tout litige entre vous et ECEIN ou Volpe sera résolu par arbitrage exécutoire et individuel. Vous renoncez à votre droit de participer à un recours collectif.</li>
                </ul>
            </li>
            <li>
                <h2>Modifications des Conditions</h2>
                <ul>
                    <li>Volpe se réserve le droit de modifier ces conditions à tout moment. Les utilisateurs seront informés des changements via une notification.</li>
                </ul>
            </li>
        </ol>
        <p>En utilisant ECEIN, vous acceptez ces conditions et vous vous engagez à respecter les règles du réseau. </p>
    </div>
</body>