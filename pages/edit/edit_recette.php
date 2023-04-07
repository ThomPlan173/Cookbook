<?php
session_start();

require ".." . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();

$cb = new \cb\CoobookDB();
$msg = $_POST['edit'] ;
$id = htmlspecialchars( utf8_encode($msg)) ;

$cb = new \cb\CoobookDB();
$data = $cb->getRecette($id);
$liste = $cb->getIngredients($id);
$tags = $cb->getTags($id);
$d= $cb->

$ed = new \AED\Edit();
$ed->editRecettes($data[0]->nomRecette,$data[0]->imgRecette,$data[0]->Description, $data[0]->Preparation);