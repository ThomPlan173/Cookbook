<?php
session_start();
require  ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();

$cb = new \cb\CoobookDB();
$ad = new \Edit\Add();
$up = new \Upload\Upload();

$_SESSION['nom'] = $_POST['nom'];
$response = $ad->verifIngredient($_SESSION['nom']);
$_SESSION['response'] = $response;

if ($response['granted']) {
    $upload = $up->uploading("Ingredient");
    if ($upload != ""):
        $_SESSION['image'] = $upload;
        $cb->addIngredient($_SESSION['image'], htmlspecialchars($_SESSION['nom'], ENT_QUOTES));
        header("Location: " . "/Projet_Recettes/pages/EditRec/add.php");
        $_SESSION['nom'] = null;
        $_SESSION['image'] = null;
        exit();
    endif;
}
//header("Location: " . $_SERVER['HTTP_REFERER']);
//exit();

