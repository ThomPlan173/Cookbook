<?php
session_start();
require  ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();

$cb = new \cb\CoobookDB();
$ed = new \Edit\Edit();
$up = new \Upload\Upload();

$_SESSION['nom'] = $_POST['nom'];
$response = $ed->verifIngredient($_SESSION['nom']);
$_SESSION['responseEdit'] = $response;
$_SESSION['idIngr'] = $_POST['id'];

if ($response['granted']) {
    $upload = $up->uploading("Ingredient");
    if ($upload != ""):
        $_SESSION['image'] = $upload;
        $cb->updateIngredient($_SESSION['idIngr'], $_SESSION['image'], htmlspecialchars($_SESSION['nom'], ENT_QUOTES));
        $_SESSION['nom'] = null;
        $_SESSION['image'] = null;
        $_SESSION['idIngr'] = null;
        $_POST['id'] = null;
        $_SESSION['idIngr'] = null;
        header("Location: " . "/Projet_Recettes/pages/EditRec/add.php");
        exit();
    endif;
}
header("Location: " . $_SERVER['HTTP_REFERER']);
exit();
