<?php

#----------------------------------------------ALEXANDRE___DEBUT------------------------------------------------------------

//page permetttent de vérifier si l'ajout d'un tag s'est bien passé ou non

session_start();
require  ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();

$cb = new \cb\cookbookDB();
$ad = new \Edit\Add();

$_SESSION['nomTag'] = $_POST['nomTag']; // recupère le nom du tag
$response = $ad->verifTag($_SESSION['nomTag']); // vérifie si il n'y a pas d'erreur dans le formulaire d'ajout de tag
$_SESSION['responseEdit'] = $response; // sauvegarde du param $response ci dessus
$_SESSION['errortext'] = "Erreur lors de l'ajout d'un tag !"; // sauvegarde le message d'erreur

if ($response['granted']) {// si il n'y a pas d'erreur dans le formulaire on ajoute de tag dans la base de données
        $cb->addTag(htmlspecialchars($_SESSION['nomTag'], ENT_QUOTES));
        $_SESSION['responseEdit'] = null;// on nettoie les clés de $_SESSION utilisées
        $_SESSION['nomTag'] = null;
        $_SESSION['errortext'] = null;
        header("Location: ".$_SERVER['HTTP_REFERER']); // renvoie vers la dernière page visité (Edit ou Add)
        exit();
}

header("Location: " . $_SERVER['HTTP_REFERER']); // renvoie vers la dernière page visité (Edit ou Add)
exit();

#----------------------------------------------ALEXANDRE___FIN------------------------------------------------------------