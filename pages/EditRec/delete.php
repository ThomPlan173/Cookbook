<?php

#----------------------------------------------ALEXANDRE___DEBUT------------------------------------------------------------

//page qui supprimer une recette de la base de données ainsi que les affiliation le concernant

session_start();
require ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();

$cb = new \cb\cookbookDB();

$id = $_GET["del"];
$cb->deleteRecette($id); // supprime la recette
$cb->deleteRecAttribution($id); // supprime les affiliations de la recette dans la table attribuer
$cb->deleteRecContenir($id); // supprime les affiliations de la recette dans la table contenir
header("Location: "."/Projet_Recettes/index.php");

#----------------------------------------------ALEXANDRE___FIN------------------------------------------------------------