<?php
session_start();
require  ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();

$cb = new \cb\CoobookDB();
$ad = new \Edit\Add();
$up = new \Upload\Upload();

$_SESSION['nomIngr'] = $_POST['nomIngr'];
$response = $ad->verifIngredient($_SESSION['nomIngr']);
$_SESSION['responseAdd'] = $response;
$_SESSION['errortext'] = "Erreur lors de l'ajout d'un ingrédient !";

if ($response['granted']) {
    $upload = $up->uploading("Ingredient");
    if ($upload != ""):
        $_SESSION['image'] = $upload;
        $cb->addIngredient($_SESSION['image'], htmlspecialchars($_SESSION['nomIngr'], ENT_QUOTES));
        $_SESSION['nomIngr'] = null;
        $_SESSION['image'] = null;
        $_SESSION['responseAdd'] = null;
        $_SESSION['errortext'] = null;
        header("Location: ".$_SERVER['HTTP_REFERER']);

        exit();
    endif;
}
header("Location: " . $_SERVER['HTTP_REFERER']);
exit();

