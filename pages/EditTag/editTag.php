<?php

#----------------------------------------------ALEXANDRE___DEBUT------------------------------------------------------------

//page permetttent de vérifier si l'edition d'un tag s'est bien passé ou non

session_start();
require  ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();

$cb = new \cb\cookbookDB();
$ed = new \Edit\Edit();

$_SESSION['nomTag'] = $_POST['nomTag'];// recupère le nom du tag
$response = $ed->verifTag($_SESSION['nomTag']); // vérifie si il n'y a pas d'erreur dans le formulaire de modification de tag
$_SESSION['responseEdit'] = $response; // sauvegarde du param $response ci dessus
$_SESSION['idTag'] = $_POST['idTag'];// récupère l'id de lu tag
$_SESSION['errortext'] = "Erreur lors de l'édition d'un tag !"; // sauvegarde le message d'erreur

if ($response['granted']) {// si il n'y a pas d'erreur dans le formulaire on modifie le tag dans la base de données
        $cb->updateTag($_SESSION['idTag'], htmlspecialchars($_SESSION['nomTag'], ENT_QUOTES));
        $_SESSION['responseEdit'] = null; // on nettoie les clés de $_SESSION utilisées
        $_SESSION['nomTag'] = null;
        $_SESSION['idTag'] = null;
        $_SESSION['errortext'] = null;
        header("Location: ".$_SERVER['HTTP_REFERER']); // renvoie vers la dernière page visité (Edit ou Add)
        exit();
}

header("Location: " . $_SERVER['HTTP_REFERER']); // renvoie vers la dernière page visité (Edit ou Add)
exit();

#----------------------------------------------ALEXANDRE___FIN------------------------------------------------------------
