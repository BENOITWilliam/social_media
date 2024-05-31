<?php

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

$iddetinataire= $_GET['ID'];
echo"<form method='POST'><input type='hidden' id= 'iddetinataire' name='iddetinataire' value='".$_GET['ID']."'>";
if ($iddetinataire==$_SESSION['ID'])
{
    ?> <meta http-equiv="refresh" content="0; url=http://localhost/web/reseau.php"><?php
}
else
{   if ($db_found)
    { if (isset($_GET['ID']) AND !empty($_GET['ID']))
        {
            $sql_user="SELECT * FROM utilisateur WHERE ID=".$iddetinataire;
            try{
                $result_user = mysqli_query($db_handle, $sql_user);
            }
            catch (Exception $e){
                $error = $e->getMessage();
                echo $error;
                exit();
            }
            if ($result_user->num_rows>0)
            {
                if (isset($_POST['envoyer']))
                {
                    $message= htmlspecialchars($_POST['message']);
                    $insertMessage="INSERT INTO message(Message, id_Destinataire, id_Auteur) VALUES ('".$message."','".$_SESSION['ID']."','" .$iddetinataire."')";
                    try{
                        $result = mysqli_query($db_handle, $insertMessage);
                    }
                    catch (Exception $e){
                        $error = $e->getMessage();
                        echo $error;
                        exit();
                    }
                    $insertMessage="";    
                }
            }
                        else
            {
                ?> <meta http-equiv="refresh" content="0; url=http://localhost/web/reseau.php"><?php
            }
        }
        else
        {
            ?> <meta http-equiv="refresh" content="0; url=http://localhost/web/reseau.php"><?php
        }  
    }
} ?>
<!DOCTYPE html>
    <html>
        <head> 
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        </head>
        <body>
            <div class="container w-50" id="color">
                <div >
                    <?php
                        $recup_pseudo="SELECT * FROM utilisateur WHERE  ID='".$iddetinataire."'" ;
                        try{
                            $result_pseudo = mysqli_query($db_handle, $recup_pseudo);
                        }
                        catch (Exception $e){
                            $error = $e->getMessage();
                            echo $error;
                            exit();
                        }
                        while ($data2 = mysqli_fetch_assoc($result_pseudo)) {
                            echo"<center><img src='".$data2['Photo']."' class='img-thumbnail' width='100px' height='100px'>";
                            echo"<h1>" . $data2['Pseudo'] . "</h1> </center>";
                        }
                        ?><section id="52"></section>
                    </div>
                
                    <form method="POST" action="">
                        <textarea name="message" minlength="1" maxlength="200" placeholder="Enter votre message" autofocus wrap required cols="50" rows="3" style="resize: none; border-radius: 20px; border: none; outline= none; padding-left: 10px; font-size: 16px width: 100%; padding-top: 15px; height=50px"></textarea>
                        </br></br>
                        <input type="submit" name="envoyer" value="Envoyer le message"/>
                        <a href="reseau.php" style="color:black; margin-left: 95%;"> <img src='documents\site\fleche-back.png' alt="fleche-back.png" class='img-thumbnail' width='50px' height='50px'></a>
                    </form>
                    
            </div>
                    </body>
        <script>
                setInterval('load_messages()',500);
                function load_messages(){
                    $("#52").load("chargement_messages.php");
                }
        </script>
    </html>
