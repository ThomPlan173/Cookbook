<?php
session_start();
require  ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();

$cb = new \cb\CoobookDB();
$ad = new \Edit\Add();

$_SESSION['nomTag'] = $_POST['nomTag'];
$response = $ad->verifTag($_SESSION['nomTag']);
$_SESSION['responseEdit'] = $response;
$_SESSION['errortext'] = "Erreur lors de l'ajout d'un tag !";

if ($response['granted']) {
        $cb->addTag(htmlspecialchars($_SESSION['nomTag'], ENT_QUOTES));
        $_SESSION['responseEdit'] = null;
        $_SESSION['nomTag'] = null;
        $_SESSION['errortext'] = null;
        header("Location: ".$_SERVER['HTTP_REFERER']);
        exit();
}

header("Location: " . $_SERVER['HTTP_REFERER']);
exit();
