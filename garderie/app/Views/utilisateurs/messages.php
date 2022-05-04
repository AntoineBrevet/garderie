<?php
session_start();
$bdd = new PDO('mysql:dbname=dm;host=localhost; charset=utf8;','root','');

if (!$_SESSION['pseudo']) {
    header('Location: connexion.php');
}

if (isset($_GET['id']) && !empty($_GET['id'])) {


    $getID = $_GET['id'];
    $ID = $_SESSION['id'];

    $recupUser = $bdd->prepare('SELECT * FROM users WHERE id = ?');
    $recupUser->execute(array($getID));

    if($recupUser->rowCount() > 0){

        if(isset($_POST['envoyer'])){

            $message = htmlspecialchars($_POST['message']);
            $insertMessage = $bdd->prepare('INSERT INTO messages(message, id_destinataire, id_auteur)VALUES(?,?,?)');
            $insertMessage->execute(array($message, $getID, $ID));

        }
    }else{
        echo "aucun utilisateur trouvé";
    }


}else{
    echo "aucun identifiant trouvé";
}
