<?php
session_start();
require ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();

$cb = new \cb\CoobookDB();
$ed = new \Edit\Edit();
$up = new \Upload\Upload();

$_SESSION['nom'] = $_POST['nom'];
$_SESSION['description'] = $_POST['description'];
$_SESSION['preparation'] =  $_POST['preparation'];

$response = $ed->verifRecette($_SESSION['nom'],$_SESSION['description'],$_SESSION['preparation']);
$_SESSION['response'] = $response ;
if($response['granted']){
    $upload = $up->uploading("Recette");
    if($upload!=""):
        $_SESSION['image'] = $upload;
        $cb->updateRecette($_SESSION['id'], $_SESSION['image'],htmlspecialchars($_SESSION['nom'],ENT_QUOTES),htmlspecialchars($_SESSION['description'],ENT_QUOTES),htmlspecialchars($_SESSION['preparation'], ENT_QUOTES));
        header("Location: "."/Projet_Recettes/index.php");
        $_SESSION['nom'] = null;
        $_SESSION['image'] =  null;
        $_SESSION['description'] = null;
        $_SESSION['preparation'] =  null;
        $_SESSION['id'] = null;
        exit() ;
    endif;
}
header("Location: ".$_SERVER['HTTP_REFERER']);
exit();