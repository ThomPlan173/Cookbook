<?php
session_start();
require  ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();

$cb = new \cb\CoobookDB();
$ad = new \Edit\Add();
$up = new \Upload\Upload();

$_SESSION['nom'] = $_POST['nom'];
$response = $ad->verifIngredient($_SESSION['nom']);
$_SESSION['responseAdd'] = $response;

if ($response['granted']) {
    $upload = $up->uploading("Ingredient");
    if ($upload != ""):
        $_SESSION['image'] = $upload;
        $cb->addIngredient($_SESSION['image'], htmlspecialchars($_SESSION['nom'], ENT_QUOTES));
        $_SESSION['nom'] = null;
        $_SESSION['image'] = null;
        $_SESSION['responseAdd'] = null;
        header("Location: " . "/Projet_Recettes/pages/EditRec/add.php");

        exit();
    endif;
}
header("Location: " . $_SERVER['HTTP_REFERER']);
exit();

