<?php 
/* Fichier affichant les informations juridique liés à la confidentialité  */
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
        <h1>POLITIQUE DE CONFIDENTIALITÉ</h1>
        <p>
        La protection de votre vie privée est primordiale aux yeux de Volpe (ci-après dénommé indifféremment « Nom du Magasin du Client » et « nous », « Responsable du traitement »). Nous veillons à la protection de votre vie privée lors de vos visites sur notre site Internet ou des commandes que vous passez en ligne.

        Volpe fournit des produits et services et agit en qualité de Responsable du traitement des données à caractère personnel que vous communiquez lorsque vous passez commande.

        Vous pouvez contacter le Délégué à la protection des données de Volpe grâce au formulaire de contact qui se trouve au bas de cette page.

        La présente Politique de confidentialité définit la manière dont les données à caractère personnel vous concernant sont collectées, traitées et partagées lorsque vous visitez le site ou passez commande sur nanouonly.fr (ci-après dénommé le « Site Internet »).
        </p>
        <h2>NATURE DES DONNÉES À CARACTÈRE PERSONNEL QUE NOUS COLLECTONS</h2>
        <p>Lorsque vous réalisez ou essayez de réaliser un achat via le Site Internet, nous collectons certaines données vous concernant, notamment votre nom, votre adresse de facturation, votre adresse de livraison, vos informations de paiement (y compris les numéros de carte de crédit), votre adresse e-mail et votre numéro de téléphone. Ces informations sont dénommées « Informations relatives à la commande ».

            Lorsque vous visitez le Site Internet, nous collectons automatiquement certaines informations sur votre appareil, y compris des données concernant votre navigateur Internet, votre adresse IP, votre fuseau horaire et certains cookies installés sur votre appareil. En outre, lorsque vous naviguez sur le Site Internet, nous collectons des informations sur les pages ou les produits spécifiques que vous consultez, les sites ou termes de recherche qui vous ont redirigés vers le Site Internet, ainsi que des données sur la manière dont vous interagissez avec le Site Internet. Ces données collectées de manière automatisée sont dénommées « Informations relatives à l'appareil ».

            Nous collectons des Informations relatives à l'appareil en utilisant les technologies suivantes :
            <ul>
                <li>
                Les « cookies » sont des fichiers de données qui sont placés sur votre appareil ou votre ordinateur ; ils contiennent généralement un identifiant unique anonyme. Pour plus d'informations relatives aux cookies et aux modalités de désactivation des cookies, consultez le site <a href= "https://allaboutcookies.org/">allaboutcookies.org</a>.
                </li>
                <li>
                Les « fichiers journaux » suivent les activités réalisées sur le Site Internet et collectent des données, y compris votre adresse IP, le type de navigateur que vous utilisez, votre fournisseur d'accès Internet, les pages d'entrée/de sortie et les horodatages.
                </li>
                <li>
                Les « balises » ou « pixels » sont des fichiers électroniques utilisés pour enregistrer des informations sur la manière dont vous naviguez sur le Site Internet.
                </li>
            </ul>
        </p>
        <h2>MODALITÉS DU TRAITEMENT DE VOS DONNÉES À CARACTÈRE PERSONNEL</h2>

        <p>
            Les Informations relatives à la commande sont généralement traitées aux fins de l'exécution des commandes passées sur le Site Internet (y compris aux fins du traitement de vos informations de paiement, de la gestion des modalités d'expédition et de l'émission des factures et/ou de la confirmation des commandes). De plus, ces Informations relatives à la commande sont traitées afin de :
            <ul>
                <li>   
                    communiquer avec vous ;
                </li>
                <li>
                    contrôler les commandes afin de détecter les risques ou fraudes éventuelles et
                </li>
                <li>
                    vous adresser des communications informatives ou publicitaires concernant nos produits et services si ces communications sont conformes aux préférences que vous nous avez partagées.
                </li>
                    Nous traitons vos données afin de remplir nos obligations contractuelles à votre égard (par exemple en cas de commande sur notre Site Internet), ou pour défendre de toute autre façon nos intérêts commerciaux légitimes tels qu'énumérés ci-dessus.
            </ul>
            La collecte des Informations relatives à l'appareil (en particulier votre adresse IP) nous permet de détecter des risques et fraudes éventuelles, et plus généralement d'améliorer et d'optimiser le Site Internet (en générant par exemple une analyse des données relatives à la manière dont nos utilisateurs naviguent et interagissent avec le Site Internet), et pour évaluer l'impact de nos campagnes marketing et publicitaires).
        </p>
        <h2>PARTAGE DES DONNÉES À CARACTÈRE PERSONNEL VOUS CONCERNANT</h2>
        Nous partageons les données à caractère personnel vous concernant avec des tiers afin de pouvoir les traiter conformément aux conditions définies ci-dessus. Nous utilisons Google Analytics pour comprendre la manière dont nos clients utilisent le Site Internet. Pour plus d'informations sur la façon dont Google utilise vos données à caractère personnel, cliquez <a href="https://policies.google.com/privacy?hl=en">ici</a>. Vous pouvez également désactiver Google Analytics en cliquant <a href="https://tools.google.com/dlpage/gaoptout">ici</a>.

        Nous sommes susceptibles de partager des données dans le cadre de contrats conclus avec des prestataires de services qui contribuent à certaines de nos activités. Ces contrats stipulent que les prestataires en question sont en droit de traiter les données vous concernant uniquement aux fins des prestations qu'ils exécutent pour notre compte et s'interdisent de les utiliser pour leur bénéfice propre.

        De même, nous sommes susceptibles de divulguer des données à caractère personnel vous concernant afin de répondre à une exigence légale ou réglementaire, à une citation à comparaître, à un mandat de perquisition et/ou à toute autre demande d'informations légitime que nous recevons, ou pour protéger nos droits de toute autre manière.

        <h2>TRANSFERT INTERNATIONAL DES DONNÉES</h2>
        <p>Nous sommes susceptibles de transférer les données collectées vous concernant à des tiers agissant pour notre compte situés dans des pays hors de l'Espace économique européen (« EEE ») ou dans des pays considérés par la Commission européenne comme offrant un niveau de protection des données adéquat. Il est possible que ces autres pays n'offrent pas le même niveau de protection aux données collectées vous concernant ; toutefois, nous continuerons à collecter, stocker et traiter les données vous concernant en tout temps conformément à la présente Politique de confidentialité et à la législation applicable en matière de protection des données. Nous veillerons à ce que les données ne soient partagées qu'avec des organisations offrant un niveau de protection des données approprié conformément à la législation applicable en matière de protection des données et à ce que des accords contractuels satisfaisants soient conclus avec ces parties.</p>
        <h2>VOS DROITS</h2>
        <p>Si vous êtes soumis au RGPD, vous disposez d'un droit d'accès aux données à caractère personnel que nous détenons vous concernant et d'un droit de rectification, de mise à jour et d'effacement de ces données ; vous disposez également du droit de demander l'arrêt du traitement des données vous concernant, de vous opposer au profilage et au traitement automatisé des données vous concernant ; vous disposez en outre du droit à la limitation du traitement et au transfert de vos données (droit à la portabilité) dans certaines circonstances. Pour exercer un de ces droits, veuillez nous contacter aux coordonnées figurant ci-dessous.

            Vous avez le droit à tout moment de retirer votre consentement au traitement des données vous concernant dont la base légale est votre consentement, en contactant le Délégué à la protection des données (DPO) à l'adresse indiquée.

            Pour exercer un de ces droits, veuillez nous contacter grâce au formulaire de contact figurant ci-dessous.

            Vous disposez également du droit d'introduire une réclamation auprès de l'autorité de contrôle compétente.

            La liste des autorités compétentes de chaque pays figure sur le <a href="https://ec.europa.eu/newsroom/article29/items/612080">site Internet de la Commission Européenne</a>.
        </p>
        <h2>CONSERVATION DES DONNÉES</h2>
        <p>Lorsque vous passez une commande via le Site Internet, nous conservons les Informations relatives à la commande aussi longtemps que nécessaire à l'exécution de nos prestations ou aussi longtemps que les lois en vigueur l'exigent. Au terme de cette période, les données à caractère personnel vous concernant seront effacées.</p>
        <h2>MODIFICATIONS</h2>
        <p>Nous sommes en droit de modifier ponctuellement la présente Politique de confidentialité, par exemple, afin de refléter des changements dans nos pratiques ou pour toute autre raison d'ordre opérationnel, légal ou réglementaire.</p>
        <h2>CONTACTEZ-NOUS</h2>
        <p>Pour plus d'informations sur nos pratiques en matière de confidentialité, pour toute question ou réclamation, veuillez nous contacter grâce au formulaire de contact ci-dessous.</p>
    </div>
</body>