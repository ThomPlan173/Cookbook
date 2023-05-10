<?php
session_start();
require  ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();

$cb = new \cb\CoobookDB();
$ed = new \Edit\Edit();

$_SESSION['nomTag'] = $_POST['nomTag'];
$response = $ed->verifTag($_SESSION['nomTag']);
$_SESSION['responseEdit'] = $response;
$_SESSION['idTag'] = $_POST['idTag'];
$_SESSION['errortext'] = "Erreur lors de l'édition d'un tag !";

if ($response['granted']) {
        $cb->updateTag($_SESSION['idTag'], htmlspecialchars($_SESSION['nomTag'], ENT_QUOTES));
        $_SESSION['responseEdit'] = null;
        $_SESSION['nomTag'] = null;
        $_SESSION['idTag'] = null;
        $_SESSION['errortext'] = null;
        header("Location: ".$_SERVER['HTTP_REFERER']);
        exit();
}

header("Location: " . $_SERVER['HTTP_REFERER']);
exit();
