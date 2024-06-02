<?php 
/* Fichier affichant les informations juridique liés aux cookies  */
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
        <h1>POLITIQUE DE COOKIES</h1>
        <p>
        Lorsque vous visitez ou interagissez avec nos sites, nous ou nos prestataires de services autorisés pouvons utiliser des cookies, balises Web et autres technologies similaires pour stocker des informations qui nous permettront de vous fournir une meilleure expérience, plus rapide et plus sécurisée, ainsi qu'à des fins publicitaires.

        La présente page est conçue pour vous aider à mieux comprendre lesdites technologies et l'utilisation que nous en faisons sur nos sites. Vous trouverez ci-après une synthèse des quelques points clés à connaître à propos de notre utilisation desdites technologies.
        </p>
        <h1>QUE SONT LES COOKIES, BALISES WEB ET TECHNOLOGIES SIMILAIRES ?</h1>
        <p>
            Comme la plupart des sites, nous utilisons des technologies qui sont des petits fichiers de données placés sur votre ordinateur, votre tablette, votre téléphone mobile ou tout autre appareil (ci-après collectivement désignés comme des « appareils ») qui nous permettent d'enregistrer un certain nombre d'informations lorsque vous visitez ou interagissez avec nos sites, services, applications, messageries et outils.

            Les types et noms spécifiques des cookies, balises et autres technologies similaires que nous utilisons peuvent varier à tout moment. Afin de mieux comprendre la présente Politique et notre utilisation desdites technologies, nous fournissons les définitions et la terminologie limitées suivantes :
        </p>
        <b><h3>Cookies :</h3></b>

        <p>
            petits fichiers texte (généralement composés de lettres et de chiffres) placés dans la mémoire de votre navigateur ou de votre appareil lorsque vous visitez un site Web ou affichez un message. Les cookies permettent à un site Web de reconnaître un appareil ou un navigateur spécifique.
        </p>
        <p>
            Il existe différents types de cookies:
            <b>Les cookies de session</b> expirent à la fin de votre session de navigation et nous permettent d'associer vos actions au cours de cette session.
        </p>
        <p>
            <b>Les cookies persistants</b> sont stockés sur votre appareil entre les sessions du navigateur, ce qui nous permet de conserver vos préférences ou actions sur plusieurs sites.
        </p>
        <p>
            <b>Les cookies internes</b> sont définis par le site que vous visitez.
        </p>
        <p>
            <b>Les cookies tiers</b> sont définis par un site tiers, différent du site que vous visitez.
        </p>
        <p>
            Les cookies peuvent être désactivés ou supprimés par des outils disponibles sur la plupart des navigateurs commerciaux. Les préférences de chaque navigateur que vous utilisez devront être définies séparément car chaque navigateur propose des fonctionnalités et options différentes.
        </p>
        <p>
            <b>Balises Web:</b>
            petites images graphiques (également connue sous le nom de « pixels espions » ou « GIF invisibles ») qui peuvent être ajoutées sur nos sites, services, applications, messageries et outils. Elles sont généralement utilisées avec des cookies pour identifier nos utilisateurs et leur comportement.
        </p>
        <p>
            <b>Autres technologies similaires:</b>
            technologies qui stockent des informations dans votre navigateur ou dans votre appareil à l'aide d'objets locaux partagés ou de stockage local, tels que des cookies ou témoins Flash ou HTML 5 et d'autres logiciels d'application Web. Ces technologies peuvent fonctionner sur l'ensemble de vos navigateurs. Dans certains cas, elles peuvent ne pas être entièrement gérées par les navigateurs et nécessiter une gestion directement par le biais de votre appareil ou de vos applications installées. Nous n'utilisons pas ces technologies pour stocker des informations en vue de cibler des publicités à votre intention sur ou en dehors de nos sites.
        </p>
        <p>
            Nous pourrons utiliser les termes « cookies » ou « technologies similaires » de manière interchangeable dans nos politiques pour nous référer à toutes les technologies que nous sommes susceptibles d'utiliser pour stocker des données dans votre navigateur ou appareil, collecter des informations ou nous aider à vous identifier de la manière susmentionnée.
        </p>
        <p>
            Cookies utilisés sur ce site Internet
            Ce site Internet utilise des cookies de performance. Vous trouverez ci-dessous davantage d'informations sur les cookies de performance utilisés sur ce site.
        </p>
        <p>
            Cookies de performance
            Ces cookies nous permettent de compter le nombre de visites et d'identifier les sources de traffic afin de mesurer et d'améliorer la performance de notre site. Ils nous aident à identifier les pages qui sont le plus populaires et celles qui le sont moins et nous permettent de voir comment les visiteurs naviguent sur le site. Toutes les informations collectées par ces cookies sont agrégées et donc anonymes. Si vous n'autorisez pas ces cookies, nous ne saurons pas quand vous avez visité notre site et nous ne pourrons pas contrôler sa performance.
        </p>
    </div>
</body>