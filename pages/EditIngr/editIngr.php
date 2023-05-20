<?php

#----------------------------------------------ALEXANDRE___DEBUT------------------------------------------------------------

//page permetttent de vérifier si l'edition d'un ingrédient s'est bien passé ou non

session_start();
require  ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();

$cb = new \cb\cookbookDB();
$ed = new \Edit\Edit();
$up = new \Upload\Upload();

$_SESSION['nomIngr'] = $_POST['nomIngr'];// recupère le nom de l'ingrédient
$response = $ed->verifIngredient($_SESSION['nomIngr']); // vérifie si il n'y a pas d'erreur dans le formulaire de modification d'ingrédient
$_SESSION['responseEdit'] = $response; // sauvegarde du param $response ci dessus
$_SESSION['idIngr'] = $_POST['idIngr'];// récupère l'id de l'ingrédient
$_SESSION['errortext'] = "Erreur lors de l'édition d'un ingrédient !"; // sauvegarde le message d'erreur

if ($response['granted']) {// si il n'y a pas d'erreur dans le formulaire (hors fichiers d'upload), on continue le process
    $upload = $up->uploading("Ingredient");// $upload correspond au message renvoyé qui diffère si il y a une erreur ou non
    if ($upload != ""):// si il n'y a pas d'erreur dans l'upload on modifie l'ingrédient dans la base de données
        $_SESSION['image'] = $upload;
        $cb->updateIngredient($_SESSION['idIngr'], $_SESSION['image'], htmlspecialchars($_SESSION['nomIngr'], ENT_QUOTES));
        $_SESSION['responseEdit'] = null; // on nettoie les clés de $_SESSION utilisées
        $_SESSION['nomIngr'] = null;
        $_SESSION['image'] =  null;
        $_SESSION['idIngr'] = null;
        $_SESSION['errortext'] = null;
        header("Location: ".$_SERVER['HTTP_REFERER']); // renvoie vers la dernière page visité (Edit ou Add)
        exit();
    endif;
}

header("Location: " . $_SERVER['HTTP_REFERER']); // renvoie vers la dernière page visité (Edit ou Add)
exit();

#----------------------------------------------ALEXANDRE___FIN------------------------------------------------------------