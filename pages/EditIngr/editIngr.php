<?php

#----------------------------------------------ALEXANDRE___DEBUT------------------------------------------------------------

session_start();
require  ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();

$cb = new \cb\cookbookDB();
$ed = new \Edit\Edit();
$up = new \Upload\Upload();

$_SESSION['nomIngr'] = $_POST['nomIngr'];
$response = $ed->verifIngredient($_SESSION['nomIngr']);
$_SESSION['responseEdit'] = $response;
$_SESSION['idIngr'] = $_POST['idIngr'];
$_SESSION['errortext'] = "Erreur lors de l'édition d'un ingrédient !";

if ($response['granted']) {
    $upload = $up->uploading("Ingredient");
    if ($upload != ""):
        $_SESSION['image'] = $upload;
        $cb->updateIngredient($_SESSION['idIngr'], $_SESSION['image'], htmlspecialchars($_SESSION['nomIngr'], ENT_QUOTES));
        $_SESSION['responseEdit'] = null;
        $_SESSION['nomIngr'] = null;
        $_SESSION['image'] =  null;
        $_SESSION['idIngr'] = null;
        $_SESSION['errortext'] = null;
        header("Location: ".$_SERVER['HTTP_REFERER']);
        exit();
    endif;
}

header("Location: " . $_SERVER['HTTP_REFERER']);
exit();

#----------------------------------------------ALEXANDRE___FIN------------------------------------------------------------