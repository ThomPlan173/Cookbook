<?php

#----------------------------------------------ALEXANDRE___DEBUT------------------------------------------------------------
//page qui supprimer un ingrédient de la base de données ainsi que les affiliation le concernant
session_start();
require  ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();

$cb = new \cb\cookbookDB();

$id = $_GET["del"];
$cb->deleteIngredient($id); // supprime l'ingrédient
$cb->deleteIngredientContenir($id); // supprime les affiliations de l'ingrédient
$_SESSION['errortext']=null; // nulifie la clé errortext car obsolète
header("Location: ".$_SERVER['HTTP_REFERER']);

#----------------------------------------------ALEXANDRE___FIN------------------------------------------------------------