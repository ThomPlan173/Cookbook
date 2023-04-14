<?php
session_start();

require ".." . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();



$cb = new \cb\CoobookDB();
$ed = new \Edit\Edit();


if (isset($_POST['submit'])) {

    $nom = $_POST['nom'];
    $img = "images/" . $_POST['image'];
    $description = $_POST['description'];
    $preparation = $_POST['preparation'];
    $response = $ed->verif($nom,$img,$description,$preparation);
    if ($response['granted']){
        $result = $cb->addRecette($img,$nom,htmlspecialchars($description, ENT_QUOTES),htmlspecialchars($preparation, ENT_QUOTES));
        header("Location: "."/Projet_Recettes/index.php");
        exit() ;
    }
}

ob_start() ;

if (!isset($response)) :
    $ed->generateform();
elseif (!$response['granted']) :
    echo "<div class='error'>" ."Empty !"."</div>" ;
    $ed->generateform($nom, $img, $description, $preparation,$response['error']);
endif;

$code = ob_get_clean() ;
Template::render($code);