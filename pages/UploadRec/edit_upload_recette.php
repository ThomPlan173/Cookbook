<?php
session_start();
require ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();

$cb = new \cb\CoobookDB();
$ed = new \Edit\Edit();
$up = new \Upload\Upload();
$_SESSION['id'] = $_POST['id'];
$_SESSION['nom'] = $_POST['nom'];
$_SESSION['description'] = $_POST['description'];
$_SESSION['preparation'] =  $_POST['preparation'];
$_SESSION['image'] = $_POST['image'];
$response = $ed->verifRecette($_SESSION['nom'],$_SESSION['description'],$_SESSION['preparation']);
$_SESSION['response'] = $response ;

if($response['granted'] && $_SESSION['image'] != null ){
    $upload = $up->uploading("Recette");
    if($upload!=""):
        $_SESSION['image'] = $upload;
        $cb->updateRecette($_SESSION['id'], $_SESSION['image'],htmlspecialchars($_SESSION['nom'],ENT_QUOTES),htmlspecialchars($_SESSION['description'],ENT_QUOTES),htmlspecialchars($_SESSION['preparation'], ENT_QUOTES));
        $_SESSION['response'] = null;
        $_SESSION['nom'] = null;
        $_SESSION['image'] =  null;
        $_SESSION['description'] = null;
        $_SESSION['preparation'] =  null;
        $_SESSION['id'] = null;
        $_SESSION['errortext']=null;
        header("Location: "."/Projet_Recettes/index.php");
        exit() ;
    endif;
}
header("Location: ".$_SERVER['HTTP_REFERER']);
exit();
