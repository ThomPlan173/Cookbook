<?php

#----------------------------------------------ALEXANDRE___DEBUT------------------------------------------------------------


session_start();
require ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();

$cb = new \cb\cookbookDB();

$id = $_GET["del"];
$cb->deleteRecette($id);
$cb->deleteRecAttribution($id);
$cb->deleteRecContenir($id);
header("Location: "."/Projet_Recettes/index.php");

#----------------------------------------------ALEXANDRE___FIN------------------------------------------------------------