<?php 
session_start();
require ".." . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();

$cb = new \cb\CoobookDB();
$d = new \Edit\Delete();

$id = $_GET["del"];
$d->generateform();
//$cb->deleteRecette($id);
//header("Location: "."/Projet_Recettes/index.php");