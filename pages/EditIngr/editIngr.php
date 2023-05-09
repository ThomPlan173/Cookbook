<?php
session_start();
require  ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();


$cb = new \cb\CoobookDB();
$ed = new \Edit\Edit();

$id = $_POST['id'];

if (isset($_POST['submit'])) {

    $nom = $_POST['nom'];
    $img = "images/" . $_POST['image'];
    // $response = $ad->verifIngredient($nom,$img);
    //  if ($response['granted']){
        $result = $cb->updateIngredient($id, $img,htmlspecialchars($nom,ENT_QUOTES));
      //  header("Location: "."/Projet_Recettes/pages/add.php");
     //   exit() ;
    // }
}
